<?php 
	session_start();
    include("includes/connect.php");

?>
<html>
	<head>
		<link href="css/login.css" rel="stylesheet" type="text/css">
		<link rel="import" href="ui/bower_components/paper-button/paper-button.html">
		<link rel="import" href="ui/bower_components/paper-input/paper-input.html">
		<link rel="import" href="ui/bower_components/core-input/core-input.html">
		<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="js/jquery.validate.min.js"></script>
		<script type="application/javascript">
		$(document).ready(function(){
			$('#reg_sub').click(function(){
				var username = $('#log_user').val();
				var pass = $('#log_pass').val();
				var request = "ACCTM";
				var method = "Login";
				$.post("includes/itasm.networking.php",  { "username" : username, "pass" : pass, "RQ" : request, "Method" : method })
					.done( function(data) {
						if (data > 0){
							//alert(data);
							window.location.href = "index.php";
						}
					})	
			});
			
			$('#reg_btn').click(function(){
				
				$('#loginContainer').slideUp("slow", function(){
					$('#registrationContainer').slideDown("slow")
				});
				
			});
			$('.form-header').click(function(){
				$('#registrationContainer').slideUp("slow", function(){
					$('#loginContainer').slideDown("slow")
				});
			});
			
			
    
		});	
	
		</script>
	</head>
	<body>
		
		<div id="loginContainer">
			<div id="loginHead">
				<font>Login</font>
			</div>
			<div id="loginBody">
				
				<div id="inputContainer">
					<div class="input-group input-group-lg">
               			 <input class="form-control" type="text" name="log_user" placeholder="Login" required="true">
         		   	</div>
					<div class="input-group input-group-lg">
               			 <input class="form-control" type="text" name="log_pass" placeholder="password" required="true">
            		</div>
				</div>
				
				<div id="btnBar">
					<paper-button raised class="paperbtn" id="reg_sub">Login</paper-button>
					<paper-button raised class="paperbtn" id="reg_btn">Register</paper-button>
				</div>
			</div>
		</div>
		<div id="registrationContainer">
			<?php include('includes/form/fregister.php') ?>
		</div>
	</body>
</html>