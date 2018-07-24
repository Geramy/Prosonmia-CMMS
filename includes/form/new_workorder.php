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
    $WorkOrderUI = new UIWOTaskRG();

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
/* Work Order UI AutoComplete Elements */
/* Rate Code */
$anCodeHTML = new UIAssetNumberACS();
$anCodeElementArray = array("header" => "Asset code dialog.", "name" => "wo_eq1_fk",
                    "id" => "eq_fk", "container-id" => "eq_fk_content",
                    "placeholder" => "Begin typing a equipment code here.", "title" => "Asset code dialog.",
                    "success_label" => "Select Code", "onsave" => "alert(\"Success!\");",
                    "extra_button_label" => "<a href='/Rate Code/New'>Create Code</a>", "onextrasave" => null,
                    "onclick" => ".proson-woan-code");
$anCodeHTML->Initialize($coni);
/* WOStatus */
$wossCodeHTML = new UIWOStatusACS();
$wossElementArray = array("header" => "Workorder status dialog.", "name" => "wo_woss1_fk",
                    "id" => "wo_woss_fk", "container-id" => "woss_fk_content",
                    "placeholder" => "Begin typing a status name here.", "title" => "workorder status dialog.",
                    "success_label" => "Select Code", "onsave" => "alert(\"Success!\");",
                    "extra_button_label" => "<a>Create Code</a>", "onextrasave" => null, "extrasave_shorthand" => "ACSSNWO",
                    "onclick" => ".proson-woss-code");
$wossCodeHTML->Initialize($coni);
/* WOType */
$wtypeCodeHTML = new UIWOTypeACS();
$wtypeElementArray = array("header" => "Work order type dialog.", "name" => "wo_wtype1_fk",
                    "id" => "wo_wtype_fk", "container-id" => "wtype_fk_content",
                    "placeholder" => "Begin typing a work order type here.", "title" => "work order type dialog.",
                    "success_label" => "Select Code", "onsave" => "alert(\"Success!\");",
                    "extra_button_label" => "<a>Create Code</a>", "onextrasave" => null, "extrasave_shorthand" => "ACSWOT",
                    "onclick" => ".proson-wtype-code");
$wtypeCodeHTML->Initialize($coni);
/* Work Order Requestor Name */
$rnCodeHTML = new UIWOContactACS();
$rnElementArray = array("header" => "Workorder Requestor Name", "name" => "wo_requestor1_fk",
                "id" => "wo_requestor_fk", "container-id" => "wo_con_content",
                "placeholder" => "Begin Typeing a contact name here.", "title" => "Workorder requestor dialog",
                "success_label" => "Select Code", "onsave" => "alert(\"Success!\");",
                "extra_button_label" => "<a>Create Code</a>", "onextrasave" => null, "extrasave_shorthand" => "ACSSNWO",
                "onclick" => ".proson-worc-code");
$rnCodeHTML->Initialize($coni);
/* End Work Order UI AutoComplete Elements */
?>
<script type="text/javascript">
<?php
$anCodeHTML->GenerateAddonJavascript($anCodeElementArray);//array(container-id, title, success_label, onsave, extra_button_label, onextrasave));
$wossCodeHTML->GenerateAddonJavascript($wossElementArray);
$rnCodeHTML->GenerateAddonJavascript($rnElementArray);
$wtypeCodeHTML->GenerateAddonJavascript($wtypeElementArray);
$WorkOrderUI->GenerateAddonJavascript(1);
?>

<?php

?>
$(document).ready(function() {
<?php
    $WorkOrderUI->GenerateOnReadyJavascript(1);
?>
});


$("#new_equipment").ready(function() {
    var Module = "";
    var DefaultClient = "Select Client";
    var DefaultFacility = "Select Facility";
    var DefaultDepartment = "Select Department";
    function complete( data, sItem ) {
        var def = "";
        var db_name = "";
        var name = "";
        var url_id = "";
        switch(sItem)
        {
            case 0:
                def = DefaultClient;
                db_name = "cli";
                url_id = "id";
                name = "company"
                $( "div > select[name='cli_pk']" ).empty();
                $( "div > select[name='fac_pk']" ).empty();
                $( "div > select[name='dep_pk']" ).empty();
                break;
            case 1:
                def = DefaultFacility;
                db_name = "fac";
                url_id = "id1";
                name = "name"
                $( "div > select[name='fac_pk']" ).empty();
                $( "div > select[name='dep_pk']" ).empty();
                break;
            case 2:
                def = DefaultDepartment;
                db_name = "dep";
                url_id = "id2";
                name = "name"
                $( "div > select[name='dep_pk']" ).empty();
                break;
        }
        <?php
        if(array_key_exists ('url_id', $_GET)) {
            echo "var SelectedID = ".$_GET['url_id'].";\r\n";
        }
        ?>
        $( "div > select[name='"+db_name+"_pk']" ).append("<option value='0'>"+def+"</value>");
        for(i = 0; i < data.length; i++) {
            var value = data[i];
            if(value == null)
                continue;
            $( "div > select[name='"+db_name+"_pk']" ).append("<option value='"+value[db_name+"_pk"]+"'>"+value[db_name+"_"+name]+"</value>");
        }

    }
    var _id = "NULL";
    var _id1 = "NULL";
    var _id2 = "NULL";
    <?php
        if($id != null) {
            echo "_id = ".$id;
        }
        if($id1 != null) {
            echo "_id1 = ".$id1;
        }
        if($id2 != null) {
            echo "_id2 = ".$id2;
        }
    ?>
    $.ajax({
      type: "POST",
      url: "/includes/itasm.networking.php",
      data: { RQ: "CLM", Method: "GetClients" },
      success: function(data) { complete(data, 0) },
      dataType: "json"
    });
    $("div > select[name='cli_pk']").on("change", function() {
        $.ajax({
          type: "POST",
          url: "/includes/itasm.networking.php",
          data: { RQ: "FAM", Method: "GetFacilities", cli_pk: $("div > select[name='cli_pk']").val() },
          success: function(data) { complete(data, 1) },
          dataType: "json"
        });
    });
    $("div > select[name='fac_pk']").on("change", function() {
        $.ajax({
          type: "POST",
          url: "/includes/itasm.networking.php",
          data: { RQ: "DEM", Method: "GetDepartments", cli_pk: $("div > select[name='cli_pk']").val(), fac_pk: $("div > select[name='fac_pk']").val() },
          success: function(data) { complete(data, 2) },
          dataType: "json"
    });
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
             url : form.attr('action'),
             type : form.attr('method'),
             //We use serializeArray because some of our fields are readonly and wont get serialized.
             data : nData, // data to be submitted
             success: function(response){
                alert(response); // do what you like with the response
             }
        });
        return true;
    });
});
<?php
	echo $sub_alert_js;
    $anCodeHTML->GenerateOnReadyJavascript($anCodeElementArray);
    $wossCodeHTML->GenerateOnReadyJavascript($wossElementArray);
    $rnCodeHTML->GenerateOnReadyJavascript($rnElementArray);
    $wtypeCodeHTML->GenerateOnReadyJavascript($wtypeElementArray);
?>
});

</script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<div class="submission_error">
	<?php
		echo $sub_alert;
	?>
</div>
<div class="formContainer" id="new_workorder">
    <form action="/includes/itasm.networking.php" method="post">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#main">New Work Order</a></li>
            <li><a data-toggle="tab" href="#tasks">Tasks</a></li>
            <li><a data-toggle="tab" href="#costs">Costs</a></li>
            <li><a data-toggle="tab" href="#extra">Extra Fields</a></li>
        </ul>
        <div class="tab-content">
            <div id="main" class="tab-pane fade in active">
                <div class="form-header">
                </div>
                <div class="inputContainer">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-md">
                                <select class="form-control" name="cli_pk" ></select>
                            </div>
                            <div class="input-group input-group-md">
                                <select class="form-control" name="dep_pk"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-md">
                                <select class="form-control" name="fac_pk"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-md">
                            	<label class="required">Work Order Number:</label>
                                <input class="form-control" type="text" name="wo_number" placeholder=""  readonly="true" />
                            </div>
                            <div class="input-group input-group-md">
                            	<label>Asset Number:</label>
                                <div class="input-group proson-item-search proson-woan-code">
                                    <input class="form-control" type="text" name="wo_eq_fk" placeholder="" readonly="true" />
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                            <div class="input-group input-group-md">
                            	<label>Requestor Name:</label>
                            	<div class="input-group proson-item-search proson-worc-code">
                                    <input class="form-control prosonmia-search-boxs" type="text" name="wo_requestor_name" placeholder="" readonly="true" />
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                            <div class="input-group input-group-md">
                            	<label>Requestor Phone:</label>
                                <input class="form-control" type="text" name="wo_requestor_phone" placeholder="" readonly="true" />
                            </div>
                            <div class="input-group input-group-md">
                            	<label>Start Date:</label>
                                <div class="input-group date">
                                    <input class="form-control" type="text" name="wo_startDate" placeholder="" />
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                            <div class="input-group input-group-md">
                                <label>Completion Date:</label>
                                <div class="input-group date">
                                    <input class="form-control" type="text" name="wo_completionDate" placeholder="" />
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-md">
                            	<label class="required">Work Order Type:</label>
                                <div class="input-group proson-item-search proson-wtype-code">
                                    <input class="form-control prosonmia-search-box" type="text" name="wo_wtype_fk" placeholder="" readonly="true" />
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                            <div class="input-group input-group-md">
                            	<label>Work Order Status:</label>
                                <div class="input-group pro3son-item-search proson-woss-code">
                                    <input class="form-control prosonmia-search-box" type="text" name="wo_woss_fk" placeholder="" readonly="true" />
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                            <div class="input-group input-group-md">
                            	<label>Requestor Email:</label>
                                <input class="form-control" type="text" name="wo_requestor_email" placeholder="" readonly="true" />
                            </div>
                            <div class="input-group input-group-md">
                            	<label class="required">Requestor Date:</label>
                                <div class="input-group date">
                                    <input class="form-control" type="text" name="wo_requestDate" placeholder="" />
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                            <div class="input-group input-group-md">
                            	<label>End Date:</label>
                            	<div class="input-group date">
                                    <input class="form-control" type="text" name="wo_endDate" placeholder="" />
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="pur_itemType" value="1" />
                        <input type="hidden" name="RQ" value="WOM" />
                        <input type="hidden" name="Method" value="NewWorkOrder" />
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Issue/Request:</label>
                            <textarea rows="6" name="wo_issue"></textarea>
                        </div>
                    </div>
                    <button class="submit" name="new_workorder">Create Work Order</button>
                </div>
            </div>
            <div id="tasks" class="tab-pane fade">
    			<div class="table-responsive">
				<table class="table pros-workordertask">
				    <thead>
				        <tr>
				        	<th>Job Type</th>
                            <th>Start Date</th>
							<th>Rate Code</th>
							<th>Issue Code</th>
							<th>Failed</th>
							<th>Not Located</th>
							<th>Completed</th>
                            <th><i class="fa fa-fw fa-plus-circle pros-add-record"></i></th>
                            <th></th>
				        </tr>
				    </thead>
				    <tbody class="selectable">
					       	<?php
                            /*
				            include_once("api/WorkOrderAPI.php");
				            $id = $_GET["id"];
				            $woAPI = new WorkOrderAPI($dbCon);
				            $tasks = $woAPI->TaskSearch($id == null ? "NULL" : $id, $id1 == null ? "NULL" : $id1, $id2 == null ? "NULL" : $id2, false);
				            foreach($users as $value) {
				                ?>
				                <tr>
				                	<td><?php echo $value["wotask_wo_fk"]; ?></td>
				                	<td><?php echo $value["wotask_rateCode_fk"]; ?></td>
				                	<td><?php echo $value["wotask_issueCode_fk"]; ?></td>
				                	<td><?php echo $value["wotask_failed"]; ?></td>
				                	<td><?php echo $value["wotask_notlocated"]; ?></td>
				                    <td><?php echo $value["wotask_completionDate"]; ?></td>
				                    <td class="hidden"><?php echo $value["wotask_pk"]; ?></td>
				                </tr>
				                <?php
				            }*/
				        ?>
				    </tbody>
				</table>
				</div>
            </div>
            <div id="costs" class="tab-pane fade">
                <div class="table-responsive">
				<table class="table">
				    <thead>
				        <tr>
				        	<th>Rate Code</th>
							<th>Description</th>
							<th>Quantity</th>
							<th>Total Charge</th>
							<th>Completed Date</th>
				        </tr>
				    </thead>
				    <tbody class="selectable">
					       	<?php
                             /*
				            include_once("api/WorkOrderAPI.php");
				            $id = $_GET["id"];
				            $woAPI = new WorkOrderAPI($dbCon);
				            $tasks = $woAPI->TaskSearch($id == null ? "NULL" : $id, $id1 == null ? "NULL" : $id1, $id2 == null ? "NULL" : $id2, false);
				            foreach($users as $value) {
				                ?>
				                <tr>
				                	<td><?php echo $value["wocost_costType_fk"]; ?></td>
				                	<td><?php echo $value["[CHANGE DESCRIPTION]"]; ?></td>
				                	<td><?php echo $value["wocost_quantity"]; ?></td>
				                	<td><?php echo $value["workorderLabor+workorderParts+workorderCost"]; ?></td>
				                    <td><?php echo $value["wotask_completionDate"]; ?></td>
				                    <td class="hidden"><?php echo $value["wocost_pk"]; ?></td>
				                </tr>
				                <?php
				            }*/
				        ?>
				    </tbody>
				</table>
				</div>
            </div>
            <div id="extra" class="tab-pane fade">
                <h3>Menu 4</h3>
                <p>Some content in menu 4.</p>
            </div>
        </div>
        <script type="text/javascript">
          $(function() {
              $(".pros-add-record").on("click", function(evt) {
                  $(".pros-workordertask > tbody").NewRecordWOTRGSR("WOTRG", true);
              });
              $(".pros-minus-record").on("click", function(evt){
                  $(".pros-workordertask > tbody").NewRecordWOTRGSR("WOTRG", false);
              });
            $('.date').datepicker({});
          });
        </script>
        </script>
    </form>
</div>
<?php
$anCodeHTML->GenerateStaticAddonHtml($anCodeElementArray);
$wossCodeHTML->GenerateStaticAddonHtml($wossElementArray);
$rnCodeHTML->GenerateStaticAddonHtml($rnElementArray);
$wtypeCodeHTML->GenerateStaticAddonHtml($wtypeElementArray);
?>
