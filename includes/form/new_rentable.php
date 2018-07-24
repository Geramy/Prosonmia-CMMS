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

        /* Contact Name */
    $conNameHTML = new UIContactACS();
    $conNameElementArray = array("header" => "Client name dialog.", "name" => "ren_con1_fk", 
                                    "id" => "ren_con_fk", "container-id" => "ren_con_content", 
                                    "placeholder" => "Begin typing a contact name here.", "title" => "Contact name dialog.",
                                    "success_label" => "Select Code", "onsave" => "", 
                                    "extra_button_label" => "", "onextrasave" => null,
                                    "onclick" => ".proson-rencon-code");//proson-reninv-code
                                    
    $invCodeHTML = new UIInventoryCodeACS();
    $invCodeElementArray = array("header" => "Inventory code dialog.", "name" => "ren_inv1_fk", 
                                    "id" => "ren_inv_fk", "container-id" => "ren_inv_content", 
                                    "placeholder" => "Begin typing a inventory code here.", "title" => "Inventory code dialog.",
                                    "success_label" => "Select Code", "onsave" => "", 
                                    "extra_button_label" => "", "onextrasave" => null,
                                    "onclick" => ".proson-reninv-code");//proson-reninv-code
    
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
?>
<script type="text/javascript">
<?php
$conNameHTML->GenerateAddonJavascript($conNameElementArray);
$invCodeHTML->GenerateAddonJavascript($invCodeElementArray);
?>
$("#new_rent").ready(function() {
<?php
    echo $sub_alert_js;
    $conNameHTML->GenerateOnReadyJavascript($conNameElementArray);
    $invCodeHTML->GenerateOnReadyJavascript($invCodeElementArray);
?>
});
</script>
<div class="submission_error">
    <?php
        echo $sub_alert;
    ?>
</div>
<div class="formContainer" id="new_rent">
    <form action="/includes/itasm.networking.php" method="post" name="new_rent">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#main">New Rent</a></li>
            <li><a data-toggle="tab" href="#extra">Extra Fields</a></li>
        </ul>
        <div class="tab-content">
            <div id="main" class="tab-pane fade in active">
                <div class="form-header">
                </div>
                <div class="inputContainer">
                    <div class="input-group input-group-md">
                        <label>Client Name:</label>
                        <div class="input-group proson-item-search proson-rencon-code">
                            <input class="form-control prosonmia-search-boxs" type="text" name="ren_con_fk" placeholder="" readonly="true" />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>
                    <div class="input-group input-group-md">
                        <label>Item Code:</label>
                        <div class="input-group proson-item-search proson-reninv-code">
                            <input class="form-control prosonmia-search-boxs" type="text" name="ren_inv_fk" placeholder="" readonly="true" />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>
                    <label>Rent Start:</label>
                    <div class="input-group input-group-lg date">
                        <input class="form-control" type="text" name="ren_startDate"/>
                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>
                    <label>Rent End:</label>
                    <div class="input-group input-group-lg date">
                        <input class="form-control" type="text" name="ren_endDate"/>
                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>
                    <label>Shipped Date:</label>
                    <div class="input-group input-group-lg date">
                        <input data-format="dd/MM/yyyy hh:mm" class="form-control" type="text" name="ren_shippedDate"/>
                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>
                    <label>Arrived Date:</label>
                    <div class="input-group input-group-lg date">
                        <input class="form-control" type="text" name="ren_arrivedDate"/>
                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>
                    <label>Tracking Number:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="ren_trackingNumber"/>
                    </div>
                    <input type="hidden" name="RQ" value="RIM" />
                    <input type="hidden" name="Method" value="Create" />
                    <button type="submit" class="submit" name="rent_sub">Rent Inventory</button>
                </div>
            </div>
            <script type="text/javascript">
              $(function() {
                $('.date').datepicker({});
              });
            </script>
            <div id="extra" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Some content in menu 2.</p>
            </div>
        </div>
    </form>
</div>
<?php
$conNameHTML->GenerateStaticAddonHtml($conNameElementArray);
$invCodeHTML->GenerateStaticAddonHtml($invCodeElementArray);
?>