 <?php
include('config.php');
$session_uid='';
$session_googleCode='';
$_SESSION['uid']=''; 
$_SESSION['googleCode']='';
if(empty($session_uid) && empty($_SESSION['uid']))
{
$url=BASE_URL.'index.php';
header("Location: $url");
}
?>