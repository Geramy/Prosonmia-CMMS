<?php
include_once "../connect.php";
include_once('../session.class.php');
$session = new session();
$session->start_session('_s', false);
include "../api/AccountAPI.php";
$AcctH = new AcctHandler($dbCon);
$AcctH->LogIn("gloveless", "password");
?>