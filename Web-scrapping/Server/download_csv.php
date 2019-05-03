<?php
	define('_MYBOARD_', "best365");
    require_once 'common.php';//DB connection
    
    $category='';
    if (isset($_GET['cate']))
		$category = $_GET['cate'];
	$start='';
    if (isset($_GET['start']))
		$start = $_GET['start'];
	$end='';
    if (isset($_GET['end']))
        $end = $_GET['end'];

    $list = array();
    $sql = "SELECT * FROM `greyhounds_virtual` WHERE 1=1 and status='2' ";
    if ($category!='')
		$sql.=" and category='".$category."'";
	if ($start!='')
		$sql.=" and time>='".$start." 00:00:00'";
	if ($end!='')
        $sql.=" and time<='".$end." 23:59:59'";
    $sql.=" order by time desc;";
    $result = mysql_query($sql);
    $i=1;
	while ($row = mysql_fetch_array($result,MYSQL_ASSOC))
	{
        $item = array();
        $item['no'] = $i;
        $item['Category'] = $row['category'];
        $item['Date-Time'] = $row['time'];
        $item['status'] = $row['status']==2?"Ended":"Preserved";
        $item['ran'] = $row['ran'];
        $item['place'] = $row['place'];

        $tmpList = explode('#', substr($row['players'], 1));
        $trapNames = array(); $trapOdds = array();
		for($i=0; $i<count($tmpList); $i++)
		{
            $tmpRow = explode("^", $tmpList[$i]);
            array_push($trapNames, $tmpRow[0]);
            array_push($trapOdds, $tmpRow[1]);
		}
		$ranks = explode('-',$row['t_r']);		
		if (count($ranks)==3)
		{
			$rank1 = $ranks[0]-1;
			$rank2 = $ranks[1]-1;
			$rank3 = $ranks[2]-1;
        }
        $item['1st Number'] = $rank1+1;
        $item['1st Name'] = $trapNames[$rank1];
        $item['1st Odd'] = $trapOdds[$rank1];

        $item['2nd Number'] = $rank2+1;
        $item['2nd Name'] = $trapNames[$rank2];
        $item['2nd Odd'] = $trapOdds[$rank2];

        $item['3rd Number'] = $rank3+1;
        $item['3rd Name'] = $trapNames[$rank3];
        $item['3rd Odd'] = $trapOdds[$rank3];

        $item['Forecast Result'] = str_replace("-", "_", $row['f_r']);
        $item['Forecast Dividend'] = $row['f_d'];
        $item['Tricast Result'] = str_replace("-", "_", $row['t_r']);
        $item['Tricast Dividend'] = $row['t_d'];
        array_push($list, $item);
        $i++;
	}

    download_send_headers(date("Y-m-d") . ".csv");
    echo array2csv($list);
?>