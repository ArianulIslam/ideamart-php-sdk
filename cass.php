<?php


require 'ideamart-0.0.1.php';

$appid = "APP_000001";
$apppassword = "password";

try {


	$receiver = new SMSReceiver();

	$address = $receiver->getAddress();
	$message = $receiver->getMessage();

	// Setting up CAAS
	$cass = new DirectDebitSender("http://127.0.0.1:7000/caas/direct/debit",$appid,$apppassword);
	$sender = new SmsSender("http://localhost:7000/sms/send", $appid,$apppassword);


	try {
		$cass->cass("123","tel:94771122336","40");
		$sender->sms("Donation has been made",$address);
	} catch (CassException $e) {
		$sender->sms("You do not have money",$address);
	}

} catch (Exception $e) {
	
}


?>