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
include_once("includes/report/ModuleSelector.UI.php");
include_once("includes/report/MainWizard.UI.php");
include_once("includes/report/Engine/ReportGenerator.php");
$sub_alert = " ";
$sub_alert_js = " ";
if($_SESSION["SuccessSubmission"] == NULL) ;
else if ($_SESSION["SuccessSubmission"] >= 0)
{
    $sub_alert_js = "$('.submission_error').show(); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);";
    $sub_alert = "New Inventory has been successfully added";
}
else if ($_SESSION["SuccessSubmission"] < 0)
{
    $sub_alert_js = "$('.submission_error').show(); $('.submission_error').css('background-color', '').css('background-color', '#F58476'); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);";
    if ($_SESSION["SuccessSubmission"] == -2)
        $sub_alert = "The code already exists please use a different inventory code.";
    else
        $sub_alert = "There was a problem with your submission. Please try again.";
}

$reportGen = new ReportGenerator($dbCon);

$msHtml = new ModuleSelector();
$msElementArray = array("header" => "Select Reportable Item.", "name" => "text",
                        "id" => "id", "container-id" => "module_selector",
                        "placeholder" => "Quick Search", "title" => "Report Item.",
                        "success_label" => "Next", "onsave" => "selected_item",
                        "extra_button_label" => "Cancel", "onextrasave" => null,
                        "onclick" => "msItem", "save_shorthand" => "RWMS");
$msHtml->Initialize($dbCon, $msElementArray);

$mwHtml = new MainWizard();
$mwElementArray = array("header" => "Report Wizard.", "name" => "name",
                        "id" => "id", "container-id" => "main_wizard",
                        "placeholder" => "Report Name", "title" => "Report Creator Wizard.",
                        "success_label" => "Next", "onsave" => $msHtml,
                        "extra_button_label" => "Cancel", "onextrasave" => null,
                        "onclick" => "mwItem",
                        "onload" => "#add_components", "extrasave_shorthand" => "RWDMWS");
$mwHtml->Initialize($dbCon, $mwElementArray);
?>
<script type="text/javascript">
<?php
$mwHtml->GenerateAddonJavascript();
$msHtml->GenerateAddonJavascript();
?>
$("#add_components").ready(function() {
    <?php echo $sub_alert_js; ?>
    <?php 
    $mwHtml->GenerateOnReadyJavascript(); 
    $msHtml->GenerateOnReadyJavascript();
    ?>
});
</script>
<div class="submission_error">
    <?php
        echo $sub_alert;
    ?>
</div>
<div class="formContainer" id="add_components">
    
</div>
<?php
$mwHtml->GenerateStaticAddonHtml();
$msHtml->GenerateStaticAddonHtml();
?>
