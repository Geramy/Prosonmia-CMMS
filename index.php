<?php
///
/// JQluv.net, Inc. ("COMPANY") CONFIDENTIAL
/// Unpublished Copyright (c) 2009-2010 [COMPANY NAME], All Rights Reserved.
///
/// NOTICE:  All information contained herein is, and remains the property of COMPANY. The intellectual and technical concepts contained
/// herein are proprietary to COMPANY and may be covered by U.S. and Foreign Patents, patents in process, and are protected by trade secret or copyright law.
/// Dissemination of this information or reproduction of this material is strictly forbidden unless prior written permission is obtained
/// from COMPANY.  Access to the source code contained herein is hereby forbidden to anyone except current COMPANY employees, managers or contractors who have executed 
/// Confidentiality and Non-disclosure agreements explicitly covering such access.
///
/// The copyright notice above does not evidence any actual or intended publication or disclosure  of  this source code, which includes  
/// information that is confidential and/or proprietary, and is a trade secret, of  COMPANY.   ANY REPRODUCTION, MODIFICATION, DISTRIBUTION, PUBLIC  PERFORMANCE, 
/// OR PUBLIC DISPLAY OF OR THROUGH USE  OF THIS  SOURCE CODE  WITHOUT  THE EXPRESS WRITTEN CONSENT OF COMPANY IS STRICTLY PROHIBITED, AND IN VIOLATION OF APPLICABLE 
/// LAWS AND INTERNATIONAL TREATIES.  THE RECEIPT OR POSSESSION OF  THIS SOURCE CODE AND/OR RELATED INFORMATION DOES NOT CONVEY OR IMPLY ANY RIGHTS  
/// TO REPRODUCE, DISCLOSE OR DISTRIBUTE ITS CONTENTS, OR TO MANUFACTURE, USE, OR SELL ANYTHING THAT IT  MAY DESCRIBE, IN WHOLE OR IN PART.                
///
?>
<?php
include_once("includes/connect.php");
include_once('includes/session.class.php');
$session = new session();
$session->start_session('_s', false);
if (!isset($_SESSION['LoggedIn']))
{
	header("Location: /login.php"); 
	exit();
}
$mod = null;
$act = null;
$id  = null;
$id1 = null;
$id2 = null;
if(array_key_exists ("module", $_GET) && strlen($_GET["module"]) > 0) {
    $mod = urldecode($_GET['module']);
}
if(array_key_exists ("action", $_GET) && strlen($_GET["action"]) > 0) {
    $act = urldecode($_GET["action"]);
}

if(!array_key_exists ("id", $_GET) || strlen($_GET["id"]) < 1) {
    $id = null;
    $id1 = null;
    $id2 = null;
} else if(!array_key_exists ("id1", $_GET) || strlen($_GET["id1"]) < 1) {
    $id  = urldecode($_GET['id']);
    $id1 = null;
    $id2 = null;
} else if(!array_key_exists ("id2", $_GET) || strlen($_GET["id2"]) < 1) {
    $id  = urldecode($_GET['id']);
    $id1 = urldecode($_GET["id1"]);
    $id2 = null;
} else if(array_key_exists ("id2", $_GET) || strlen($_GET["id2"]) > 0) {
    $id  = urldecode($_GET['id']);
    $id1 = urldecode($_GET["id1"]);
    $id2 = urldecode($_GET['id2']);
}

//Before any html output
switch($mod) {
    case "MyAccount":
        switch($act)
        {
            case "logout":
                 $_SESSION["LoggedIn"] = "FALSE";
                session_destroy();
                include("includes/logout_redirect.php");
                break;
        }
        break;
}
$_SESSION['man'] = '0';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap-3size/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/itam_jqluv_css.css" rel="stylesheet" type="text/css">
    <link href="/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" type="text/css">
    <!--<link href="/css/stylesheet.css" rel="stylesheet" type="text/css">
    <link href="/css/dashboard.css" rel="stylesheet" type="text/css">-->
    <script type="text/javascript">
    ProsonmiaCore = {
        mod: "<?php echo $mod; ?>",
        act: "<?php echo $act; ?>",
        id: "<?php echo $id; ?>",
        id1: "<?php echo $id1; ?>",
        id2: "<?php echo $id2; ?>"
    };
    </script>
    <script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="/js/bootbox.min.js"></script>
    <script type="text/javascript" src="/js/prosonmia-plugins.js"></script>
    <title>IT Management</title> 
</head>
<body>
<?php
set_error_handler(function ($errorNumber, $message, $errfile, $errline) {
    switch ($errorNumber) {
        case E_ERROR :
            $errorLevel = 'Error';
            break;

        case E_WARNING :
            $errorLevel = 'Warning';
            break;

        case E_NOTICE :
            $errorLevel = 'Notice';
            break;

        default :
            $errorLevel = 'Undefined';
    }

    echo '<br/><b>' . $errorLevel . '</b>: ' . $message . ' in <b>'.$errfile . '</b> on line <b>' . $errline . '</b><br/>';
});
?>
	<div class="wrapper">
		<?php include('includes/header.php') ?><!-- include header another-->
		<?php include('includes/content.php') ?><!-- include content  -->
		<?php include('includes/footer.php') ?><!-- include footer -->
	</div>
</body>
</html>
<?php
//need to remove this so we dont have two popups for one reason
$_SESSION["SuccessSubmission"] = NULL;
?>