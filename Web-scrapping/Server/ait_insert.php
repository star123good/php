<?php
define('_MYBOARD_', "best365");
require_once 'common.php';//DB connection
require_once 'RequestCore.class.php';     
require_once 'simple_html_dom.php';     

$url = "https://data.brreg.no/enhetsregisteret/api/enheter/?size=10";
$page = 0;
if (isset($_POST['page']))  $page = (int)$_POST['page'];
$search = "";
if (isset($_POST['search']))  $search = $_POST['search'];
if ($search!='') $url = $url."&navn=".$search;

$kommunenummer = "";
if (isset($_POST['kommunenummer'])) $kommunenummer = $_POST['kommunenummer'];
if ($kommunenummer!='')  $url = $url."&kommunenummer=".$kommunenummer;

if ($page==0)
{
    //initialize
    mysql_query("TRUNCATE TABLE `item`;"); //truncate;
    mysql_query("TRUNCATE TABLE `item_location`;"); //truncate;
    mysql_query("TRUNCATE TABLE `item_category`;"); //truncate;
    $html = get_html($url);
    $data = json_decode($html);
    $totalpages = $data->page->totalPages;
    $result = array("totalpages"=>$totalpages);
    echo (json_encode($result));
}
else {
    $i_Count = 0;
    $url = $url."&page=".$page;
    $html = get_html($url);
    $data = json_decode($html);
    $list = $data->_embedded->enheter;          
    $no = 0;
    foreach($list as $row)
    {
        $category_id = str_replace(".", "_", strtolower($row->naeringskode1->kode));
        $category_name = $row->naeringskode1->beskrivelse;
        $category_description = $row->naeringskode1->kode;

        $land_id = $row->forretningsadresse->kommunenummer;
        $land_name = $row->forretningsadresse->kommune;

        
        $name = $row->navn;
        $code = $row->organisasjonsnummer;
        
        $address = $row->forretningsadresse->adresse[0].", ".$row->forretningsadresse->postnummer
            ." ".$row->forretningsadresse->poststed;
        $location = get_location($address);
        $website = $row->hjemmeside;
        $post_excerpt = $address."<br> [". $code ."]";

        $post_content = '';

        $post_content .= '<h2 class=\"stitle\">Basisopplysninger</h2>';
        $post_content .= '<div class=\"ai-item-row\"><div class=\"label\"><h3>Navn:</h3></div>'
        .'<div class=\"content\">'.$row->navn.'</div></div>';
        $post_content .= '<div class=\"ai-item-row\"><div class=\"label\"><h3>Organisasjonsnummer:</h3></div>'
                    .'<div class=\"content\">'.$code.'</div></div>';
        $post_content .= '<div class=\"ai-item-row\"><div class=\"label\"><h3>Organisasjonsform:</h3></div>'
                    .'<div class=\"content\">'.$row->organisasjonsform->beskrivelse.'</div></div>';
        $post_content .= '<div class=\"ai-item-row\"><div class=\"label\"><h3>Næringskode(r):</h3></div>'
                    .'<div class=\"content\">'.$row->naeringskode1->kode.'<br>'.$row->naeringskode1->beskrivelse.'</div></div>';
        $post_content .= '<div class=\"ai-item-row\"><div class=\"label\"><h3>Institusjonell sektorkode:</h3></div>'
                    .'<div class=\"content\">'.$row->institusjonellSektorkode->kode.'<br>'.$row->institusjonellSektorkode->beskrivelse.'</div></div>';
        $post_content .= '<div class=\"ai-item-row\"><div class=\"label\"><h3>Målform:</h3></div>'
                    .'<div class=\"content\">'.$row->maalform.'</div></div>';
        
        $post_content .= '<h2 class=\"stitle\">Adresser</h2>';
        $post_content .= '<div class=\"ai-item-row\"><div class=\"label\"><h3>Forretningsadresse:</h3></div>'
                    .'<div class=\"content\">'.$address.'</div></div>';
        $post_content .= '<div class=\"ai-item-row\"><div class=\"label\"><h3>Kommune:</h3></div>'
                    .'<div class=\"content\">'.$land_id.' '.$land_name.'</div></div>';
        $post_content .= '<div class=\"ai-item-row\"><div class=\"label\"><h3>Land:</h3></div>'
                    .'<div class=\"content\">'.$row->forretningsadresse->land.'</div></div>';

        $post_content .= '<h2 class=\"stitle\">Andre opplysninger</h2>';
        $post_content .= '<div class=\"ai-item-row\"><div class=\"label\"><h3>Stiftelsesdato:</h3></div>'
                    .'<div class=\"content\">'.$row->stiftelsesdato.'</div></div>';
        $post_content .= '<div class=\"ai-item-row\"><div class=\"label\"><h3>Registrert i Enhetsregisteret:</h3></div>'
                    .'<div class=\"content\">'.$row->registreringsdatoEnhetsregisteret.'</div></div>';

        //category
        if ($category_id!='')
        {
            $no = 0;
            $result = mysql_query(" SELECT `no` FROM `item_category` WHERE `slug`='".$category_id."';");
            while ($row = mysql_fetch_array($result))
            {
                $no = (int)($row['no']);
            }
            if ($no<1) 
            {
                $sql = " INSERT INTO `item_category` (`slug`, `name`, `description`, `icon`, `map_icon`) VALUES ('".$category_id."', '".$category_name."', '".$category_description."', 'https://beta.helgelandsguiden.no/wp-content/themes/businessfinder2/design/img/categories/business.png', 'https://beta.helgelandsguiden.no/wp-content/themes/businessfinder2/design/img/pins/business_pin.png');";
                mysql_query($sql);
            }
        }
        //location
        if ($land_id!='')
        {
            $no = 0;
            $result = mysql_query(" SELECT `no` FROM `item_location` WHERE `slug`='".$land_id."';");
            while ($row = mysql_fetch_array($result))
            {
                $no = (int)($row['no']);
            }
            if ($no<1) 
            {
                $sql = " INSERT INTO `item_location` (`slug`, `name`, `description`, `parent`, `keywords`, `icon`, `header_type`, `header_image`, `header_image_align`, `category_featured`, `header_height`, `taxonomy_image`) VALUES ('".$land_id."', '".$land_name."', '".$land_id."<br>".$land_name."', '0', '".$land_id."', '', '', '0', 'image-left', '0', '0', 'https://beta.helgelandsguiden.no/wp-content/uploads/bigstock-San-Geremia-Church-In-Venice-30877541.jpg');";
                mysql_query($sql);
            }
        }

        //item
        $sql1 = " INSERT INTO `item` (`post_name`, `post_title`, `post_content`, `post_excerpt`, `ait-items`, `ait-locations`, `address`, `latitude`, `longitude`, `telephone`, `website`) VALUES ('".$code."', '".$name."', '".$post_content."', '".$post_excerpt."', '".$category_id."', '".$land_id."', '".$address."', '".$location['latitude']."', '".$location['longitude']."', '".$code."', '".$website."');";
        mysql_query($sql1);
        $i_Count++;	
    }
    $page++;
    $result = array("insert"=>$i_Count, "page"=>$page);
    echo (json_encode($result));
}
?>