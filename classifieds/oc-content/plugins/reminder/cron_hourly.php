<?php
require_once dirname(__FILE__).'/../../../oc-load.php';
echo "Notifier running".PHP_EOL;
error_reporting(E_ALL);



$notifier = new Notifier();
$notifier->checkReminders();