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
/*eq_pk int(11) AI PK 
eq_acct_fk int(11) 
eq_parent_fk int(11) 
eq_cli_fk int(11) 
eq_fac_fk int(11) 
eq_dep_fk int(11) 
eq_code varchar(20) 
eq_serial_number varchar(137) 
eq_manufacturer varchar(120) 
eq_model varchar(120) 
eq_item_type varchar(138) 
eq_mac_address varbinary(6) 
eq_ip_address varchar(15) 
eq_subnet varchar(15)*/
$EquipAPI = new EquipmentAPI($dbCon);
$EquipInfo = $EquipAPI->GetEquipmentInformation($id);
?>
<script type="text/javascript">

$(document).ready(function() {
    $("#view input").each(function() {
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
    SaveLoop();
});
</script>
<div class="formContainer">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#main">Work Order Information</a></li>
        <li><a data-toggle="tab" href="#tasks">Tasks</a></li>
        <li><a data-toggle="tab" href="#costs">Costs</a></li>
    </ul>
    <div class="tab-content">
        <div id="main" class="tab-pane fade in active">
            <div class="inputContainer">
                <form id="view" action="/Equipment/Search/" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Work Order Number:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_code" placeholder="" value="<?php echo $EquipInfo->eq_code; ?>" />
                            </div>
                            <label>Asset Number:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_item_type" placeholder="" value="<?php echo $EquipInfo->eq_item_type; ?>" />
                            </div>
                            <label>Requestor Name:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_model" placeholder="" value="<?php echo $EquipInfo->eq_model; ?>" />
                            </div>
                            <label>Start Date:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_serial_number" placeholder="" value="<?php echo $EquipInfo->eq_serial_number; ?>" />
                            </div>
                            <label>Completion Date:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_serial_number" placeholder="" value="<?php echo $EquipInfo->eq_serial_number; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Work Order Type:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_parent_code" placeholder="" />
                            </div>
                            <label>Work Order Status:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_serial_number" placeholder="" value="<?php echo $EquipInfo->eq_serial_number; ?>" />
                            </div>
                            <label>Requestor Date:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_serial_number" placeholder="" value="<?php echo $EquipInfo->eq_serial_number; ?>" />
                            </div>
                            <label>End Date:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_serial_number" placeholder="" value="<?php echo $EquipInfo->eq_serial_number; ?>" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="tasks" class="tab-pane fade">
        	<div class="inputContainer">
                <form id="view" action="/Equipment/Search/" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Creator:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_item_type" placeholder="" value="<?php echo $EquipInfo->eq_item_type; ?>" />
                            </div>
                            <label>Created Date:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_model" placeholder="" value="<?php echo $EquipInfo->eq_model; ?>" />
                            </div>
                            <label>Completion Date:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_serial_number" placeholder="" value="<?php echo $EquipInfo->eq_serial_number; ?>" />
                            </div>
                            <label>Due Date:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_serial_number" placeholder="" value="<?php echo $EquipInfo->eq_serial_number; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Rate Code:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_code" placeholder="" value="<?php echo $EquipInfo->eq_code; ?>" />
                            </div>
                            <label>Issue Code:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_parent_code" placeholder="" />
                            </div>
                            <label>Not Located:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_serial_number" placeholder="" value="<?php echo $EquipInfo->eq_serial_number; ?>" />
                            </div>
                            <label>Failed:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_serial_number" placeholder="" value="<?php echo $EquipInfo->eq_serial_number; ?>" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
			<div class="table-responsive">
			<table class="table">
			    <thead>
			        <tr>
						<th>Job Type</th>
						<th>Rate Code</th>
						<th>Issue Code</th>
						<th>Failed</th>
						<th>Not Located</th>
						<th>Completed</th>
			        </tr>
			    </thead>
			    <tbody class="selectable">
				       	<?php/*
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
        	<div class="inputContainer">
                <form id="view" action="/Equipment/Search/" method="post">
                    <div class="row">
                    	<div class="col-md-6">
                            <label>Work Order Task:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_code" placeholder="" value="<?php echo $EquipInfo->eq_code; ?>" />
                            </div>
                            <label>Rate Code:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_item_type" placeholder="" value="<?php echo $EquipInfo->eq_item_type; ?>" />
                            </div>
                            <label>Cost Type:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_model" placeholder="" value="<?php echo $EquipInfo->eq_model; ?>" />
                            </div>
                            <label>Account:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_serial_number" placeholder="" value="<?php echo $EquipInfo->eq_serial_number; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Creator:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_parent_code" placeholder="" />
                            </div>
                            <label>Quantity:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_serial_number" placeholder="" value="<?php echo $EquipInfo->eq_serial_number; ?>" />
                            </div>
                            <label>Created Date:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_serial_number" placeholder="" value="<?php echo $EquipInfo->eq_serial_number; ?>" />
                            </div>
                            <label>Completion Date:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="eq_serial_number" placeholder="" value="<?php echo $EquipInfo->eq_serial_number; ?>" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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
				       	<?php/*
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
    </div>
</div>