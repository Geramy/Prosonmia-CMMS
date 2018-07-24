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
   	$rcHand = new RateCodeAPI($dbCon);
	$sub_alert = " ";
	$sub_alert_js = " ";
	
	if ($_SESSION["SuccessSubmission"] > 0)
	{
		$sub_alert_js = "$('.submission_error').show(); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);";
		$sub_alert = "Rate Code has been successfully added";
	}
	else if ($_SESSION["SuccessSubmission"] < 0)
	{
		$sub_alert_js = "$('.submission_error').show(); $('.submission_error').css('background-color', '').css('background-color', '#F58476'); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);";
		$sub_alert = "There was a problem with your submission. Please try again.";
	}
?>

<div class="submission_error">
	<?php
		echo $sub_alert;
	?>
</div>

<div class="formContainer" id="new_ratecode">
    <form action="/includes/itasm.networking.php" method="post">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#main">New Rate Code</a></li>
        </ul>
        <div class="tab-content">
            <div id="main" class="tab-pane fade in active">
            	<div class="inputContainer">
            		<label class="required">Name:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="rateCode_name" placeholder="" required="true" />
                    </div>
                    <label class="required">Code:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="rateCode_code" placeholder="" required="true" />
                    </div>
                    <label>Hourly Cost:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="rateCode_hourly_cost" placeholder="" />
                    </div>
                    <label>Part Multiplier:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="rateCode_part_multiplier" placeholder="" />
                    </div>
                    <label>Labor Multiplier:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="rateCode_labor_multiplier" placeholder="" />
                    </div>
                    <label>Charge Multiplier:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="rateCode_charge_multiplier" placeholder="" />
                    </div>
                    
                    <input type="hidden" name="total_rows" id="total_rows" value="" />
                    <input type="hidden" name="RQ" value="RCM" />
                    <input type="hidden" name="Method" value="Create" />
                    
                    <button class="submit" name="rc_sub">Create Rate Code</button>
                </div>
            </div>
        </div>
    </form>
</div>
