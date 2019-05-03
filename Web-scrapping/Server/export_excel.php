<?php
	define('_MYBOARD_', "best365");
    require_once 'common.php';//DB connection
    
    $list = array();
    $sql = " SELECT * FROM `shopify` WHERE 1=1 ";
    $sql.=" and no>8000 and no<=13000";
    $sql.=" order by no asc ";
    $result = mysql_query($sql);
    $i=1;
	while ($row = mysql_fetch_array($result,MYSQL_ASSOC))
	{
        $item = array();
        $item['Handle'] = $row['Handle'];
        $item['Title'] = $row['Title'];
        $item['Body (HTML)'] = $row['Body'];
        $item['Vendor'] = $row['Vendor'];
        $item['Type'] = $row['Type'];
        $item['Tags'] = $row['Tags'];
        $item['Published'] = "TRUE";

        $item['Option1 Name'] = "";
        $item['Option1 Value'] = "";
        $item['Option2 Name'] = "";
        $item['Option2 Value'] = "";
        $item['Option3 Name'] = "";
        $item['Option3 Value'] = "";

        $item['Variant SKU'] = $row['Handle'];
        $item['Variant Grams'] = 100;
        $item['Variant Inventory Tracker'] = "";
        $item['Variant Inventory Qty'] = 1;
        $item['Variant Inventory Policy'] = "deny";
        $item['Variant Fulfillment Service'] = "manual";
        $item['Variant Price'] = $row['Variant_Price'];
        $item['Variant Compare At Price'] = "";
        $item['Variant Requires Shipping'] = "TRUE";
        $item['Variant Taxable'] = "TRUE";
        $item['Variant Barcode'] = "";
        $item['Image Src'] = $row['Image_Src'];
        $item['Image Alt Text'] = $row['Image_Alt_Text'];
        $item['Gift Card'] = "FALSE";
        $item['Google Shopping / MPN'] = "";
        $item['Google Shopping / Age Group'] = "Adult";
        $item['Google Shopping / Gender'] = "Unisex";
        $item['Google Shopping / Google Product Category'] = $row['Google Shopping / Google Product Category'];
        $item['SEO Title'] = $row['Title'];
        $item['SEO Description'] = $row['SEO_Description'];
        $item['Google Shopping / AdWords Grouping'] = $row['Collection'];
        $item['Google Shopping / AdWords Labels'] = $row['Collection'];
        $item['Google Shopping / Condition'] = $row['Collection'];
        $item['Google Shopping / Custom Product'] = "FALSE";
        $item['Google Shopping / Custom Label 0'] = "";
        $item['Google Shopping / Custom Label 1'] = "";
        $item['Google Shopping / Custom Label 2'] = "";
        $item['Google Shopping / Custom Label 3'] = "";
        $item['Google Shopping / Custom Label 4'] = "";
        $item['Variant Image'] = $row['Variant_Image'];
        $item['Variant Weight Unit'] = "";
        $item['Collection'] = $row['Collection'];

        array_push($list, $item);
        $i++;
	}

    download_send_headers(date("Y-m-d") . ".csv");
    echo array3csv($list);
?>