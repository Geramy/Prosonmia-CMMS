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
include("includes/connect.php");
include_once('includes/session.class.php');
$session = new session();
$session->start_session('_s', false);
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap-3size/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/itam_jqluv_css.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    <script type="application/javascript">
		$(document).ready(function(){
			$('#reg_sub').click(function(){ //submits the form on button click
				var username = $('#log_user').val();
				var pass = $('#log_pass').val();
				var request = "ACCTM";
				var method = "Login";
				$.post("includes/itasm.networking.php",  { "username" : username, "pass" : pass, "RQ" : request, "Method" : method })
					.done( function(data) {
						if (data > 0){
							//alert(data);
							window.location.href = "index.php";
						} else if (data < 0) {
							$('.submission_error').show();
							$('.submission_error').css('background-color', '').css('background-color', '#F58476');
							setTimeout(function(){
								$('.submission_error').fadeOut() }, 3000);

						}
					});
			});

			$('input').keydown(function(e) { //this allows form submit when pressing enter in either inputs
    			if (e.keyCode == 13) {
        			$('#reg_sub').trigger('click');
    			}
			});

			$('#reg_btn').click(function(){

				$('.loginContainer').slideUp("slow", function(){ //hides login, shows registrationform
					$('.registrationContainer').slideDown("slow")
				});

			});
			$('#reg_btl').click(function(){
				$('.registrationContainer').slideUp("slow", function(){ //hides registration, shows login. not intuitive, should prob be changed
					$('.loginContainer').slideDown("slow")
				});
			});
			$('.reg_form-header').click(function(){
				$('.registrationContainer').slideUp("slow", function(){ //hides registration, shows login. not intuitive, should prob be changed
					$('.loginContainer').slideDown("slow")
				});
			});

		});
	</script>
    <title>JQluv ITASM</title>
</head>
<body>
	<div class="submission_error">Login Failed. Please try again</div>
	<div class="loginContainer">
		<div class="logo">
			<img src="/images/newLogo.png" />
		</div>
		<form action="" method="post">
			<div class="input-group input-group-lg">
                <input class="form-control" type="text" name="log_user" placeholder="User Name" required="true" id="log_user">
            </div>
            <div class="input-group input-group-lg">
                <input class="form-control" type="password" name="log_pass" placeholder="Password" required="true" id="log_pass">
            </div>

		</form>
		<button class="submit" name="reg_sub" id="reg_sub">Login</button>
        <button class="submit" name="reg_btn" id="reg_btn">Register</button>
	</div>
	<div class="registrationContainer">
		<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/form/fregister.php') ?>
	</div>
</body>
</html>
