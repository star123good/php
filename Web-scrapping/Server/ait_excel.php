<?php
    define('_MYBOARD_', "best365");
    require_once 'common.php';//DB connection
    
    $category='item';
    if (isset($_GET['cate']))
        $category = $_GET['cate'];
    
    $list = array();
    if ($category == 'item_category')
    {
        $sql = " SELECT * FROM `item_category` WHERE 1=1;";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_array($result,MYSQL_ASSOC))
        {
            $item = array();
            $item['slug'] = $row['slug'];
            $item['name'] = $row['name'];
            $item['description'] = $row['description'];
            $item['parent'] = 0;
            $item['keywords'] = "";
            $item['icon'] = $row['icon'];
            $item['map_icon'] = $row['map_icon'];
            $item['header_type'] = "map";
            $item['header_image'] = "";
            $item['header_image_align'] = "image-left";
            $item['category_featured'] = 0;
            $item['header_height'] = "";
            array_push($list, $item);
        }
    }
    else if ($category == 'item_location')
    {
        $sql = " SELECT * FROM `item_location` WHERE 1=1;";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_array($result,MYSQL_ASSOC))
        {
            $item = array();
            $item['slug'] = $row['slug'];
            $item['name'] = $row['name'];
            $item['description'] = $row['description'];
            $item['parent'] = 0;
            $item['keywords'] = "";
            $item['icon'] = $row['icon'];
            $item['map_icon'] = $row['map_icon'];
            $item['header_type'] = "map";
            $item['header_image'] = "";
            $item['header_image_align'] = "image-left";
            $item['category_featured'] = 0;
            $item['header_height'] = "";
            array_push($list, $item);
        }
    }
    else
    {
        $sql = " SELECT * FROM `item` WHERE 1=1;";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_array($result,MYSQL_ASSOC))
        {
            $item = array();
            $item['post_name'] = "".$row['post_name']."";
            $item['post_title'] = $row['post_title'];
            $item['description'] = $row['description'];
            $item['post_status'] = "publish";
            $item['post_content'] = $row['post_content'];
            $item['post_excerpt'] = $row['post_excerpt'];
            $item['post_author'] = 1;
            $item['post_parent'] = 0;
            $item['post_date'] = date("Y-m-d h:i:s");
            $item['comment_status'] = "open";
            $item['ping_status'] = "closed";
            $item['post_image'] = "";
            $item['ait-items'] = $row['ait-items'];
            $item['ait-locations'] = $row['ait-locations'];
            $item['subtitle'] = "";
            $item['featuredItem'] = 0;
            $item['headerImage'] = "";
            $item['headerHeight'] = "";
            $item['address'] = $row['address'];
            $item['latitude'] = $row['latitude'];
            $item['longitude']= $row['longitude'];
            $item['streetview'] = 0;
            $item['telephone'] = $row['telephone'];
            $item['telephoneAdditional@number'] = "";
            $item['email'] = "";
            $item['showEmail'] = 0;
            $item['contactOwnerBtn'] = 0;
            if($row['web']=="")
                $item['web'] = "";
            else
                $item['web'] = "http://".$row['web'];
            $item['webLinkLabel'] = $row['web'];
            $item['displayOpeningHours'] = 0;
            $item['openingHoursMonday'] = "";
            $item['openingHoursTuesday'] = "";
            $item['openingHoursWednesday'] = "";
            $item['openingHoursThursday'] = "";
            $item['openingHoursFriday'] = "";
            $item['openingHoursSaturday'] = "";
            $item['openingHoursSunday'] = "";
            $item['displaySocialIcons'] = 0;
            $item['socialIconsOpenInNewWindow'] = 0;
            $item['socialIcons@icon'] = "";
            $item['socialIcons@link'] = "";
            $item['displayGallery'] = 0;
            $item['gallery@title'] = "";
            $item['gallery@image'] = "";
            $item['displayFeatures'] = 0;
            $item['features@icon'] = "";
            $item['features@text'] = "";
            $item['features@desc'] = "";
            array_push($list, $item);
        }
    }
    download_send_headers(date("Y-m-d-").$category. ".csv");
    echo "\"sep=;\"\n";
    echo array2csv($list);
?>