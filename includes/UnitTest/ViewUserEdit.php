<?php
include_once "../connect.php";
include_once('../session.class.php');
include_once("../api/UserAPI.php");
include_once("../api/AccountAPI.php");
$session = new session();
$session->start_session('_s', false);

$AcctH = new AcctHandler($dbCon);
echo var_dump($AcctH->LogIn("gloveless", "password")) . "\r\n";

$usr_api = new UserAPI($dbCon);

echo var_dump($usr_api->QuickEditStart("usr_title")) . "\r\n";
echo var_dump($usr_api->QuickEditStop(15, "Testing Edit")) . "\r\n";

echo var_dump($usr_api->QuickEditStart("usr_title")) . "\r\n";
echo var_dump($usr_api->QuickEditStop(15, "Software Engineer")) . "\r\n";

$time = microtime(TRUE);
$usr_api = new UserAPI($dbCon);
$usr_api->GetMyInformation();
$usr_api->GetDetailInformation($_SESSION['userid']);
print( microtime(TRUE) - $time );
?>