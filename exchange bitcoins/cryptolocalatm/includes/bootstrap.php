<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

include("function.validation.php");
include("function.messages.php");
include("function.pagination.php");
include("function.language.php");
include("function.user.php");
include("function.gateway.php");
include("function.exchange.php");
include("phpmailer/phpmailer.class.php");
include("function.mail.php");
include("function.post.php");
include("function.payment_form.php");
include("function.web.php");
include("NexmoAccount.php");
include("NexmoMessage.php");
include("NexmoReceipt.php");
include("payment_src/block_io.php");
include("class.template.php");
include("version.php");
?>