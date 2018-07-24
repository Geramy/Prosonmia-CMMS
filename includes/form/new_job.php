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
    $rateCodeHTML = new UIRateCode();
    $JLHandler = new JobAPI($coni);
    $RateCodeElementArray = array("header" => "Rate code dialog.", "name" => "jobl_ratecode_fk",
                                    "id" => "jobl_rc_fk", "container-id" => "rc_fk_content",
                                    "placeholder" => "Begin typing a rate code here.", "title" => "Rate code dialog.",
                                    "success_label" => "Select Code", "onsave" => "alert(\"Success!\");",
                                    "extra_button_label" => "<a href='/Rate Code/New'>Create Code</a>", "onextrasave" => null,
                                    "onclick" => ".proson-rate-code");
	$sub_alert = " ";
	$sub_alert_js = " ";

	if ($_SESSION["SuccessSubmission"] > 0)
	{
		$sub_alert_js = "$('.submission_error').show(); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);";
		$sub_alert = "New Job has been successfully added";
	}
	else if ($_SESSION["SuccessSubmission"] < 0)
	{
		$sub_alert_js = "$('.submission_error').show(); $('.submission_error').css('background-color', '').css('background-color', '#F58476'); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);";
		$sub_alert = "There was a problem with your submission. Please try again.";
	}
?>
<script type="text/javascript">
<?php
$rateCodeHTML->GenerateAddonJavascript($RateCodeElementArray);//array(container-id, title, success_label, onsave, extra_button_label, onextrasave));
?>
$("#new_job").ready(function() {
    $(".proson-item-search").on("click", function() { $(this).NewJobListItem(".proson-item-table"); });
<?php
	echo $sub_alert_js;
    $rateCodeHTML->GenerateOnReadyJavascript($RateCodeElementArray);
?>
});
</script>
<div class="submission_error">
	<?php
		echo $sub_alert;
	?>
</div>
<div class="formContainer" id="new_job">
    <form action="/includes/itasm.networking.php" method="post">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#main">New Job</a></li>
            <li><a data-toggle="tab" href="#checklistinfo">Check List Info</a></li>
        </ul>
        <div class="tab-content">
            <div id="main" class="tab-pane fade in active">
                <div class="form-header">
                </div>
                <div class="inputContainer">
                	<label class="required">Job Name:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="jobl_name" placeholder="" required="true" />
                    </div>
                    <label class="required">Job Code:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="jobl_code" placeholder="" required="true" />
                    </div>
                    <label>Job Rate Code:</label>
                    <div class="input-group input-group-lg proson-item-search proson-rate-code">
	                    <input class="form-control" type="text" name="jobl_ratecode_fk" placeholder="" required="false" readonly="true" />
	                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>
                    <!-- Job Description needs a way to store the data into the db -->
                    <!-- <div class="row">
                    	<div class="input-group input-group-lg">
	                	<textarea  rows="12" name="sug_message" placeholder="" required="true"></textarea>
	            	</div> -->
	            </div>
            	<div class="row">
                    <div class="col-md-12">
                        <label>Job Description:</label>
                        <textarea name="jobl_description" rows="6" /></textarea>
                    </div>
                    <input type="hidden" name="RQ" value="JLM" />
                    <input type="hidden" name="Method" value="Create" />
                    <input type="hidden" name="total_rows" id="total_rows" value="" />
                    <button class="submit" name="jobl_sub">Create Job</button>
               	</div>
            </div>
            <div id="checklistinfo" class="tab-pane fade">
                <div class="row-divider"></div>
    			<div class="table-responsive">
				<table class="table proson-item-table">
				    <thead>
				        <tr>
				            <th>Item Name</th>
							<th>Require Pass</th>
							<th>Notes</th>
							<th>Require Notes</th>
							<th><div class="proson-item-search"><span class="glyphicon glyphicon-plus"></span></div></th>
						</tr>
				    </thead>
				    <tbody>
				    </tbody>
				</table>
				</div>
            </div>
            <script type="text/javascript">
              $(function() {
                $('.date').datepicker({});
              });
            </script>
        </div>
    </form>
</div>
<?php
$rateCodeHTML->GenerateStaticAddonHtml($RateCodeElementArray);
?>
