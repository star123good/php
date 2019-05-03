<?php
	define('_MYBOARD_', "best365");
    require_once 'common.php';
    //require_once(__DIR__.'/common.php');
    $category='';
    if (isset($_POST['cate']))
		$category = $_POST['cate'];
	$start='';
    if (isset($_POST['start']))
		$start = $_POST['start'];
	$end='';
    if (isset($_POST['end']))
        $end = $_POST['end'];
    $list = array();
    $list1 = array();
    $sql = "SELECT no, category, time, place, players, f_r, f_d, t_r, t_d FROM `greyhounds_virtual` WHERE status='2' ";
    if ($category!='')
		$sql.=" and category='".$category."'";
	if ($start!='')
		$sql.=" and time>='".$start." 00:00:00'";
	if ($end!='')
		$sql.=" and time<='".$end." 23:59:59'";
	$sql.= " ORDER BY time desc;";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result,MYSQL_ASSOC))
	{
		$item = array();
		array_push($item, $row['no']);
		array_push($item, $row['category']);
		array_push($item, $row['time']);
		array_push($item, $row['place']);

		$t_r = $row['t_r'];
		
		$tmpList = explode('#', substr($row['players'], 1));
		for($i=0; $i<count($tmpList); $i++)
		{
			$tmpList[$i] = preg_replace('/(.*)\^(.*)/','<td>$1<br><span>$2</span></td>', $tmpList[$i]);
		}
		$ranks = explode('-',$t_r);		
		if (count($ranks)==3)
		{
			$rank1 = $ranks[0]-1;
			$rank2 = $ranks[1]-1;
			$rank3 = $ranks[2]-1;
			$tmpList[$rank1] = str_replace("<br><span>", "<i class='rank1'></i><br><span>", $tmpList[$rank1]);
			$tmpList[$rank2] = str_replace("<br><span>", "<i class='rank2'></i><br><span>", $tmpList[$rank2]);
			$tmpList[$rank3] = str_replace("<br><span>", "<i class='rank3'></i><br><span>", $tmpList[$rank3]);
		}
		array_push($item, substr(substr(implode($tmpList),4), 0, -5));
		array_push($item, $row['f_r']);
		array_push($item, $row['f_d']);
		array_push($item, $row['t_r']);
		array_push($item, $row['t_d']);
		array_push($list, $item);
	}

	//next round
	$sql = "SELECT no, category, time, players FROM `greyhounds_virtual` WHERE status='0' order by time asc;";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result,MYSQL_NUM))
	{
		array_push($list1, $row);
	}
	$result = array("store"=>$list, "next"=>$list1);
	echo (json_encode($result));
?>