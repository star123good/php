<?php
	define('_MYBOARD_', "best365");
    require_once 'common.php';//DB connection
    
    mysql_query("TRUNCATE `shopify`;");
    $row = 1;
    if (($handle = fopen("import.csv", "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row>1)
        {
            $body = "<h2>GeneralInformation</h2>".$data[9];
            if ($data[10]!=='') $body .="<h2>CommonUses</h2>".$data[10];
            if ($data[11]!=='') $body .="<h2>Warnings</h2>".$data[11];
            if ($data[12]!=='') $body .="<h2>Ingredients</h2>".$data[12];
            if ($data[13]!=='') $body .="<h2>Directions</h2>".$data[13];
            if ($data[14]!=='') $body .="<h2>Indications</h2>".$data[14];
            $body = str_replace("'", "`", $body);
            $body = str_replace('"', "\"", $body);

            $data[0] = str_replace("'", "`", $data[0]);
            $data[0] = str_replace('"', "\"", $data[0]);
            $categorys = explode(' / ', $data[0]);
            $collection = $categorys[0];
            $product_type = $categorys[1];

            $product_tag = "";
            for ($j=2; $j<count($categorys); $j++)
            {
                $product_tag = str_replace(" ", "_", $product_tag.$categorys[$j]).", ";
            }

            $Variant_Image = $data[5];
            if ($data[6]!=='') $Variant_Image.=", ". $data[6];
            if ($data[7]!=='') $Variant_Image.=", ". $data[7];
            if ($data[8]!=='') $Variant_Image.=", ". $data[8];
            $sql = " INSERT INTO `shopify` (`Handle`, `Title`, `Body`, `Vendor`, `Type`, `Tags`, `Variant_Price`, `Image_Src`, `Image_Alt_Text`, `Google_Shopping / Google Product_Category`, `SEO_Description`, `Variant_Image`, `Collection`) VALUES ("
            ." '".$data[3]."', '".str_replace("'", "`", $data[1])."', '".$body."', 'DaigouDownUnder', '".$product_type."', '".$product_tag."', '".str_replace("$", "", $data[2])."', '".$data[4]."', '".str_replace("'", "`", $data[1])."', '".str_replace(" / ", ">", $data[0])."', '".str_replace("'", "`", $data[9])."', '".$Variant_Image."', '".$collection."');";
            mysql_query($sql);
        }
        $row++;
      }
      fclose($handle);
    }
    else {
        echo 'failed';
        exit;
    }
    $result = mysql_query("SELECT DISTINCT(`Collection`) FROM `shopify` WHERE 1;");
    while($row = mysql_fetch_array($result))
    {
        echo $row[0];
        echo "<Br>";
    }
    include_once("export_excel.php");
?>