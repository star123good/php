<?php
    require_once 'config.php';//DB connection
    
    $connect_db = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
    @mysql_query(" set names utf8 ");
    $select_db = mysql_select_db(DB_NAME, $connect_db);
    if (!$select_db)
        die("<meta http-equiv='content-type' content='text/html; charset=$k3[charset]'><script type='text/javascript'> alert('DB Connection Failed'); </script>");
    unset($my);

    $_SERVER['PHP_SELF'] = htmlentities($_SERVER['PHP_SELF']);
    ini_set("session.use_trans_sid", 0);    // PHPSESSID
    ini_set("url_rewriter.tags","");
    
    function download_send_headers($filename) {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");
    
        // force download  
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
    
        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }
    function array2csv(array &$array)
    {
        if (count($array) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($array)), ";");
        foreach ($array as $row) {
            fputcsv($df, $row, ";");
        }
        fclose($df);
        return ob_get_clean();
    }
    function array3csv(array &$array)
    {
        if (count($array) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($array)), ",");
        foreach ($array as $row) {
            fputcsv($df, $row, ",");
        }
        fclose($df);
        return ob_get_clean();
    }
    function getLatLong($address){
        if(!empty($address)){
            //Formatted address
            $formattedAddr = str_replace(' ','+',$address);
            //Send request and receive json data by address
            $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false'); 
            $output = json_decode($geocodeFromAddr);
            //Get latitude and longitute from json data
            $data['latitude']  = $output->results[0]->geometry->location->lat; 
            $data['longitude'] = $output->results[0]->geometry->location->lng;
            //Return latitude and longitude of the given address
            if(!empty($data)){
                return $data;
            }else{
                return false;
            }
        }else{
            return false;   
        }
    }
    function get_location($address)
    {
        if (strlen($address)<5)
            return array('latitude'=>null, 'longitude'=>null);
        $location = getLatLong($address);
        $failed = 0;
        while ($location['latitude']==null)
        {
            sleep(3);
            $location = getLatLong($address);
            $failed++;
            if ($failed>3) break;
        }
        return $location;
    }
?>