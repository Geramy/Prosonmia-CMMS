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
$sub_alert = " ";
$sub_alert_js = " ";

if ($_SESSION["SuccessSubmission"] > 0)
{
    $sub_alert_js = "$('.submission_error').show(); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);";
    $sub_alert = "Work order has been successfully added";
}
else if ($_SESSION["SuccessSubmission"] < 0)
{
    $sub_alert_js = "$('.submission_error').show(); $('.submission_error').css('background-color', '').css('background-color', '#F58476'); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);";
    $sub_alert = "There was a problem with your submission. Please try again.";
}
$PMSchAPI = new PMScheduleAPI($dbCon);
$EquipAPI = new EquipmentAPI($dbCon);

$EquipInfo = $EquipAPI->GetEquipmentInformation($id);
$ScheduleInfo = $PMSchAPI->ItemIDSearch($id, 1);
/* Work Order UI AutoComplete Elements */
/* Rate Code */
$pmrcCodeHTML = new UIRateCode();
$pmrcElementArray = array("header" => "Rate Code Selector", "name" => "pms_wo_rateCode_fk",
                                "id" => "pms_wo_rateCode_fk", "container-id" => "wo_rc_content",
                                "placeholder" => "Rate code search.", "title" => "Rate code dialog.",
                                "success_label" => "Select Code", "onsave" => "alert(\"Success!\");",
                                "extra_button_label" => "<a>Create Code</a>", "onextrasave" => null, "extrasave_shorthand" => "ACSSNWO",
                                "onclick" => ".proson-pmrc-code");
$pmrcCodeHTML->Initialize($dbCon);
/* WOStatus */
$wossCodeHTML = new UIWOStatusACS();
$wossElementArray = array("header" => "Workorder status dialog.", "name" => "pms_wo_woss1", 
                                "id" => "pms_wo_requestor_fk", "container-id" => "oms_woss_fk_content", 
                                "placeholder" => "Begin typing a status name here.", "title" => "workorder status dialog.",
                                "success_label" => "Select Code", "onsave" => "alert(\"Success!\");", 
                                "extra_button_label" => "<a>Create Code</a>", "onextrasave" => null, "extrasave_shorthand" => "ACSSNWO",
                                "onclick" => ".proson-pms-woss-code");
$wossCodeHTML->Initialize($dbCon);
/* Work order type */
$wtypeCodeHTML = new UIWOTypeACS();
$wtypeElementArray = array("header" => "Workorder type dialog.", "name" => "pms_wo_woss1", 
                                "id" => "pms_wtype_fk", "container-id" => "oms_wotype_fk_content", 
                                "placeholder" => "Begin typing a status name here.", "title" => "workorder type dialog.",
                                "success_label" => "Select Code", "onsave" => "alert(\"Success!\");", 
                                "extra_button_label" => "<a>Create Code</a>", "onextrasave" => null, "extrasave_shorthand" => "ACSWOTN",
                                "onclick" => ".proson-pms-woty-code");  
$wtypeCodeHTML->Initialize($dbCon);
/* Job Code */
$jobliCodeHTML = new UIJobLibrary();
$jobliElementArray = array("header" => "Job code dialog.", "name" => "pms_jobli_fk1", 
                                "id" => "pms_jobl_fk", "container-id" => "pms_jobli_content", 
                                "placeholder" => "Begin typing a status name here.", "title" => "Job code dialog.",
                                "success_label" => "Select Code", "onsave" => "alert(\"Success!\");", 
                                "extra_button_label" => "<a>Create Code</a>", "onextrasave" => null, "extrasave_shorthand" => "",
                                "onclick" => ".proson-pms-jobli-code");  
$jobliCodeHTML->Initialize($dbCon);
/* Work Order UI AutoComplete Elements */
?>
<script type="text/javascript">
<?php
$wossCodeHTML->GenerateAddonJavascript($wossElementArray);
$wtypeCodeHTML->GenerateAddonJavascript($wtypeElementArray);
$pmrcCodeHTML->GenerateAddonJavascript($pmrcElementArray);
$jobliCodeHTML->GenerateAddonJavascript($jobliElementArray);
?>
$(document).ready(function() {
    $(".formContainer > input").each(function() {
        $(this).JQluvSaveInit();
    });
    $("input").prop('disabled', true);
    //$("#view").JQluvEditables();
    $( ".edittable" ).hover(
      function() {
        $(this).find("input").prop('disabled', false);
        $(this).find("input").focus();
        $(this).find("input").click();
        $(this).find("input").setCursorPosition();
      }, function() {
        $(this).find("input").prop('disabled', true);
      }
    );
    
    $(window).on("beforeunload", function() {
        $("#view").JQluvAutoSave();
    });
    function SaveLoop() {
        setTimeout(function (){
            $("#view").JQluvAutoSave();
            SaveLoop();
        }, 1000);   
    }
    $("form").submit(function(e){
        var form = $(this);
        var nData = form.serializeArray();
        for(item in nData) {
            var pk = $("input[name="+nData[item]["name"]+"]").data("pk");
            if(pk != undefined) {
                nData[item].value = pk;
            }
        }
        $.ajax({ 
             url   : form.attr('action'),
             type  : form.attr('method'),
             //We use serializeArray because some of our fields are readonly and wont get serialized.
             data  : nData, // data to be submitted
             success: function(response){
                alert(response); // do what you like with the response
             }
        });
        return false;
    });
    SaveLoop();
<?php
echo $sub_alert_js;
$wossCodeHTML->GenerateOnReadyJavascript($wossElementArray);
$wtypeCodeHTML->GenerateOnReadyJavascript($wtypeElementArray);
$pmrcCodeHTML->GenerateOnReadyJavascript($pmrcElementArray);
$jobliCodeHTML->GenerateOnReadyJavascript($jobliElementArray);
?>
});
</script>
<div class="submission_error">
    <?php
        echo $sub_alert;
    ?>
</div>
<div class="formContainer">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#main">Equipment Information</a></li>
        <li><a data-toggle="tab" href="#new_pm">New PM</a></li>
        <li><a data-toggle="tab" href="#pm_schedules">PM Schedules</a></li>
        <li><a data-toggle="tab" href="#network">Network Info</a></li>
        <li><a data-toggle="tab" href="#software">Software Licenses</a></li>
    </ul>
    <div class="tab-content">
        <div id="main" class="tab-pane fade in active">
            <div class="inputContainer">
                <form id="view" action="/Equipment/Search/" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Equipment Code:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_code" placeholder="" value="<?php echo $EquipInfo->eq_code; ?>" />
                            </div>
                            <label>Device Type:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_item_type" placeholder="" value="<?php echo $EquipInfo->eq_item_type; ?>" />
                            </div>
                            <label>Model:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_model" placeholder="" value="<?php echo $EquipInfo->eq_model; ?>" />
                            </div>
                            <label>Serial Number:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_serial_number" placeholder="" value="<?php echo $EquipInfo->eq_serial_number; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Parent Asset Number:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_parent_code" placeholder="" />
                            </div>
                            <label>Manufacturer:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_manufacturer" placeholder="" value="<?php echo $EquipInfo->eq_manufacturer; ?>" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="new_pm" class="tab-pane fade">
            <div class="form-header">
            </div>
            <div class="inputContainer">
                <form id="new_pm_form" role="form" data-toggle="validator" action="/includes/itasm.networking.php" method="POST">
                   <div class="row">
                        <div class="col-md-6">
                            <div>
                                <label class="required">Job Code:</label>
                                <div class="input-group input-group-md proson-pms-jobli-code">
                                    <input class="form-control proson-nochange" type="text" name="pms_jobl_fk" placeholder="" required="true" readonly="true" />
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                            <div class="input-group input-group-md">
                                <label class="required">PM Interval Type</label>
                                <select class="form-control" name="pms_interval_type">
                                    <option value="1">Meter</option>
                                    <option value="2">Days</option>
                                    <option value="3">Month</option>
                                    <option value="4">Quarter</option>
                                    <option value="5">Years</option>
                                </select>
                            </div>
                            <div class="edittable">
                                <label class="required">PM Interval:</label>
                                <div class="input-group input-group-md">
                                    <input class="form-control" type="text" name="pms_interval" placeholder="" required="true" />
                                </div>
                            </div>
                            <div class="input-group input-group-md">
                                <label>Requestor Name:</label>
                                <div class="input-group proson-item-search">
                                    <input class="form-control prosonmia-search-boxs" type="text" name="pms_wo_requestor_fk" placeholder="" readonly="true" />
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                            <div class="input-group input-group-md">
                                <label>Start Date:</label>
                                <div class="input-group date">
                                    <input class="form-control" type="text" name="pms_startDate" placeholder="" required="false" />
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <div>
                                    <label class="required">Work Order Status:</label>
                                    <div class="input-group input-group-md proson-pms-woss-code">
                                        <input class="form-control proson-nochange" type="text" name="pms_wo_woss_fk" placeholder="" required="true" readonly="true" />
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                    </div>
                                </div>
                                <div>
                                    <label class="required">Work Order Type:</label>
                                    <div class="input-group input-group-md proson-pms-woty-code">
                                        <input class="form-control proson-nochange" type="text" name="pms_wtype_fk" placeholder="" required="true" readonly="true" />
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                    </div>
                                </div>
                                <div class="input-group input-group-md">
                                    <label>Work Order Rate Code:</label>
                                    <div class="input-group proson-item-search proson-pmrc-code">
                                        <input class="form-control prosonmia-search-boxs" type="text" name="pms_wo_rateCode_fk" placeholder="" readonly="true" />
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                    </div>
                                </div>
                                <div class="input-group input-group-md">
                                    <label>End Date:</label>
                                    <div class="input-group date">
                                        <input class="form-control" type="text" name="pms_endDate" placeholder="" required="false" />
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="pms_item_type" value="1" />
                            <input type="hidden" name="pms_item_fk" value="<?php echo $id; ?>" />
                            <input type="hidden" name="RQ" value="PM" />
                            <input type="hidden" name="Method" value="QCreate" />
                            <button class="submit" name="pms_sub">Create PM</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="pm_schedules" class="tab-pane fade">
            <div class="form-header">
                PM Schedules.
            </div>
            <div class="inputContainer">
                <form id="search" action="/Equipment/PMView/" method="post">
                    <div class="col-md-16">
                    </div>
                    <div class="col-md-16">
                        <div id="checklistinfo" class="tab-pane fade active in">
                            <div class="row-divider"></div>
                            <div class="table-responsive">
                                <table class="table proson-item-table">
                                    <thead>
                                        <tr>
                                            <th>Job Code</th>
                                            <th>Last WO Number</th>
                                            <th>Next PM Date</th>
                                            <th>Last PM Date</th>
                                            <th><div class="proson-new-item"><span class="glyphicon glyphicon-plus"></span></div></th>
                                            <th><div class="proson-item-search"><span class="glyphicon glyphicon-minus"></span></div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for($i = 0; $i < sizeof($ScheduleInfo); $i++) {
                                            ?>
                                            <tr>
                                                <td><?php echo $ScheduleInfo[$i]["jobl_code"]; ?></td>
                                                <td></td>
                                                <td><?php echo $ScheduleInfo[$i]["pms_nextDate"]; ?></td>
                                                <td><?php echo $ScheduleInfo[$i]["jobl_code"]; ?></td>
                                                <td></td>
                                                <td><div class="proson-item-search"><span class="glyphicon glyphicon-minus"></span></div></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="network" class="tab-pane fade">
            <div class="form-header">
                Network Information.
            </div>
            <div class="inputContainer">
                <form id="search" action="/Equipment/Search/" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-lg edittable">
                            	<label>IP Address:</label>
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_ip_address" placeholder="" value="<?php echo $EquipInfo->eq_ip_address; ?>" />
                            </div>
                            <div class="input-group input-group-lg edittable">
                            	<label>Gateway:</label>
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_gateway" placeholder="" />
                            </div>
                            <div class="input-group input-group-lg edittable">
                            	<label>Subnet:</label>
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_subnet" placeholder="" value="<?php echo $EquipInfo->eq_subnet; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-lg edittable">
                            	<label>Mac Address:</label>
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_mac_address" placeholder="" value="<?php echo $EquipInfo->eq_mac_address; ?>" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="software" class="tab-pane fade">
            <div class="form-header">
                Software Licenses.
            </div>
            <div class="inputContainer">
                <form id="search" action="/Equipment/Search/" method="post">
                    <div class="col-md-16">
                    </div>
                    <div class="col-md-16">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$wossCodeHTML->GenerateStaticAddonHtml($wossElementArray);
$wtypeCodeHTML->GenerateStaticAddonHtml($wtypeElementArray);
$pmrcCodeHTML->GenerateStaticAddonHtml($pmrcElementArray);
$jobliCodeHTML->GenerateStaticAddonHtml($jobliElementArray);
?>