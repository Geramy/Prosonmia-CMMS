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
<div class="submission_error">
	<?php
		if ($_SESSION["SuccessSubmission"] > 0)
		{
			echo "<script type='text/javascript'>$('.submission_error').show(); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000); </script>";
			echo "Client has been successfully added";
		}
		else if ($_SESSION["SuccessSubmission"] < 0)
		{
			echo "<script type='text/javascript'>$('.submission_error').show(); $('.submission_error').css('background-color', '').css('background-color', '#F58476'); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);</script>";
			echo "There was a problem with your submission. Please try again.";
		}
	?>
</div>
<div class="formContainer" id="fcomp">
	<form action="/includes/itasm.networking.php" method="post">
		<ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#main">New Company</a></li>
			<li><a data-toggle="tab" href="#address">Address</a></li>
			<li><a data-toggle="tab" href="#extra">Extra Fields</a></li>
        </ul>
        <div class="tab-content">
	            <div id="main" class="tab-pane fade in active">
	            	<div class="inputContainer">
	            		<label class="required">Company Name:</label>
						<div class="input-group input-group-lg">
			                <input class="form-control" type="text" name="fcomp" placeholder="" required="true">
			            </div>
			            <label>Client Code:</label>
			            <div class="input-group input-group-lg">
			                <input class="form-control" type="text" name="fcode" placeholder="">
			            </div>
			            <label class="required">Phone Number:</label>
			            <div class="input-group input-group-lg">
			                <input class="form-control" type="text" name="fphone" placeholder="" required="true">
			            </div>
			            <label class="required">Contact Name:</label>
						<div class="input-group input-group-lg">
			                <input class="form-control" type="text" name="fname" placeholder="" required="true">
			            </div>
			            <label class="required">Email:</label>
			            <div class="input-group input-group-lg">
			                <input class="form-control" type="text" name="femail" placeholder="" required="true">
			            </div>
			            <input type="hidden" name="RQ" value="CLM" />
						<input type="hidden" name="Method" value="Create" />
						<button class="submit" name="cli_sub" value="Submit">Submit</button><br>
					</div>
	          	</div>
	          	<div id="address" class="tab-pane fade">
	          		<label>Address 1:</label>
		            <div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="faddress1" placeholder="">
		            </div>
		            <label>Address 2:</label>
		            <div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="faddress2" placeholder="">
		            </div>
		            <label>Zip/Postal Code:</label>
		            <div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="fpostal" placeholder="">
		            </div>
		            <label>City:</label>
		            <div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="fcity" placeholder="">
		            </div>
		            <label>County:</label>
		             <div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="fcounty" placeholder="">
		            </div>
		            <label>State:</label>
		            <div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="fstate" placeholder="">
		            </div>
		            <label>Country:</label>
		            <div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="fcountry" placeholder="">
		            </div>
		        </div>
		        <div id="extra" class="tab-pane fade">
		        	<p>Some Extra Stuff</p>
		        </div>
		</form>
	</div>
</div>
<?php
	$_SESSION["SuccessSubmission"] = 0;
 ?>