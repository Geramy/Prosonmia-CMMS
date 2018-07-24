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

$InvHandler = new InventoryAPI($dbCon);
$InvInfo = $InvHandler->GetInformation($id);
?>
<script type="text/javascript">
$(document).ready(function() {
    $("#view").JQluvAutoSaveInit();
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
        setTimeout(function ()
        {
            $("#view").JQluvAutoSave();
            SaveLoop();
        }, 2000);
    }
    SaveLoop();
});
</script>
<div class="formContainer">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#main">Inventory Information</a></li>
    	<li><a data-toggle="tab" href="#invstock">Inventory Stock</a></li>
    	<li><a data-toggle="tab" href="#invren">Rent History</a></li>
    </ul>
    <div class="tab-content">
        <div id="main" class="tab-pane fade in active">
            <div class="inputContainer">
                <form id="view" action="/Rentable/Search/" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Rate Code:</label>
                            <div class="input-group input-group-lg">
                                <input class="form-control input-sm proson-nochange" type="text" name="inv_ratecode_fk" placeholder="" value="<?php echo $InvInfo->rateCode_code; ?>" />
                            </div>
                            <label>Code:</label>
                            <div class="input-group input-group-lg">
                                <input class="form-control input-sm proson-nochange" type="text" name="inv_code" placeholder="" value="<?php echo $InvInfo->inv_code; ?>" />
                            </div>
                            <label>Serial Number:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="inv_serial_number" placeholder="" value="<?php echo $InvInfo->inv_serial_number; ?>" />
                            </div>
                            <label>Manufacturer:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="inv_manufacturer" placeholder="" value="<?php echo $InvInfo->inv_manufacturer; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Model:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="inv_model" placeholder="" value="<?php echo $InvInfo->inv_model; ?>" />
                            </div>
                            <label>Item Type:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="inv_item_type" placeholder="" value="<?php echo $InvInfo->inv_item_type; ?>" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="invstock" class="tab-pane fade">
	        <h3></h3>
	        <p>
	        	<label>Quantity Left:</label>
                <div class="input-group input-group-lg edittable">
                    <input class="form-control input-sm proson-nochange" type="text" name="invst_quantity" placeholder="" value="<?php echo $InvInfo->invst_quantity; ?>" />
                </div>
	            <label>Last Price:</label>
                <div class="input-group input-group-lg edittable">
                    <input class="form-control input-sm proson-nochange" type="text" name="invst_cost" placeholder="" value="<?php echo $InvInfo->invst_cost; ?>" />
                </div>
				<label>Total Cost</label>
                <div class="input-group input-group-lg edittable">
                    <input class="form-control input-sm proson-nochange" type="text" name="invst_adjustment_type" placeholder="" value="<?php echo $InvInfo->invst_adjustment_type; ?>" />
                </div>
	        </p>
	    </div>
	    <div id="invren" class="tab-pane fade">
	        <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Inventory Code</th>
                            <th>Rent Start</th>
                            <th>Rent End</th>
                            <th>Shipped Start</th>
                            <th>Shipped End</th>
                        </tr>
                    </thead>
                    <tbody class="selectable">
                        <?php
                            $rentAPI = new RentAPI($dbCon);
                            $rent = $rentAPI->GetRented($id);
                            foreach($rent as $value) {
                                ?>
                                <tr>
                                    <td><?php echo $value["con_name"]; ?></td>
                                    <td><?php echo $value["inv_code"]; ?></td>
                                    <td><?php echo $value["ren_startDate"]; ?></td>
                                    <td><?php echo $value["ren_endDate"]; ?></td>
                                    <td><?php echo $value["ren_shippedDate"]; ?></td>
                                    <td><?php echo $value["ren_arrivedDate"]; ?></td>
                                    <td class="hidden"><?php echo $value["ren_pk"]; ?></td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
	    </div>
    </div>
</div>
