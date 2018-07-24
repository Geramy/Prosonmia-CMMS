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

$RentAPI = new RentAPI($dbCon);
$RentInfo = $RentAPI->GetDetails($id);
$ShipmentUI = new UIRentShipmentRG();
?>
<script type="text/javascript">
<?php
$ShipmentUI->GenerateAddonJavascript(array("id" => $id));
?>
$(document).ready(function() {
<?php
    $ShipmentUI->GenerateOnReadyJavascript(array("id" => $id));
?>
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
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<div class="submission_error">
</div>
<div class="formContainer">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#main">Rent Information</a></li>
        <li><a data-toggle="tab" href="#ships">Shipments</a></li>
    </ul>
    <div class="tab-content">
        <div id="main" class="tab-pane fade in active">
            <div class="inputContainer">
                <form id="view" action="/Rentable/Search/" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Created Date:</label>
                            <div class="input-group input-group-lg">
                                <input class="form-control input-sm proson-nochange" type="text" name="ren_createdDate" placeholder="" value="<?php echo $RentInfo->ren_createdDate; ?>" />
                            </div>
                            <label>Shipped Date:</label>
                            <div class="input-group input-group-lg date">
                                <input data-format="dd/MM/yyyy hh:mm" class="form-control input-sm proson-nochange" type="text" name="ren_shippedDate" placeholder="" value="<?php echo $RentInfo->ren_shippedDate; ?>" />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                            <label>Arrived Date:</label>
                            <div class="input-group input-group-lg date">
                                <input data-format="dd/MM/yyyy hh:mm" class="form-control input-sm proson-nochange" type="text" name="ren_arrivedDate" placeholder="" value="<?php echo $RentInfo->ren_arrivedDate; ?>" />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                            <label>Start Date:</label>
                            <div class="input-group input-group-lg date">
                                <input data-format="dd/MM/yyyy hh:mm" class="form-control input-sm proson-nochange" type="text" name="ren_startDate" placeholder="" value="<?php echo $RentInfo->ren_startDate; ?>" />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>End Date:</label>
                            <div class="input-group input-group-lg date">
                                <input data-format="dd/MM/yyyy hh:mm" class="form-control input-sm proson-nochange" type="text" name="ren_endDate" placeholder="" value="<?php echo $RentInfo->ren_endDate; ?>" />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                            <label>Completed Date:</label>
                            <div class="input-group input-group-lg date">
                                <input data-format="dd/MM/yyyy hh:mm" class="form-control input-sm proson-nochange" type="text" name="ren_completed" placeholder="" value="<?php echo $RentInfo->ren_completed; ?>" />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
        <div id="ships" class="tab-pane fade in">
            <div class="inputContainer">
                <div class="table-responsive">
                    <table class="table pros-renshiptrack">
                        <thead>
                            <tr>
                                <th>Shipment Start</th>
                                <th>Shipment End</th>
                                <th>Tracking ID</th>
                                <th><i class="fa fa-fw fa-plus-circle pros-add-record"></i></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="selectable">
                            <?php
                                $shipAPI = new ShippingAPI($dbCon);
                                $shipTrackingAPI = new ShipmentTrackingAPI($dbCon);
                                $shippingID = $shipAPI->GetDetails($id, 2);
                                $shipdrops = $shipTrackingAPI->GetTrackingHistory($shippingID["ship_pk"]);
                                //echo var_dump($shippingID);
                                foreach($shipdrops as $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value["stra_start_date"]; ?></td>
                                        <td><?php echo $value["stra_end_date"]; ?></td>
                                        <td><?php echo $value["stra_tracking_number"]; ?></td>
                                        <td><?php echo $value["stra_desc"]; ?></td>
                                        <td class="hidden"><?php echo $value["stra_pk"]; ?></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script type="text/javascript">
          $(function() {
            $(".pros-add-record").on("click", function(evt) {
                $(".pros-renshiptrack > tbody").NewRecordRSTRGSR("RSTRG", true);
            });
            $('.date').datepicker({});
          });
        </script>
    </div>
</div>
