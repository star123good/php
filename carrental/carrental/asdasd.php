<?php 
if ($days->format('%a') < "3") {
	$price=$price1;

} elseif ($days->format('%a') = '3') {
	$price=$price2;


} elseif ( '3' < $days->format('%a') < '7') {
	$price=$price3;

} elseif ($days->format('%a')='7') {
	$price=$price4;

} else {

	$price=$price5;
}
?>