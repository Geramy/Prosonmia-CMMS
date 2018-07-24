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

$RCHandler = new RateCodeAPI($dbCon);
$RCInfo = $RCHandler->RateCodeInfo($id);
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
        <li class="active"><a data-toggle="tab" href="#main">Rate Code Information</a></li>
        <li><a data-toggle="tab" href="#extra">Extra Tab</a></li>
    </ul>
    <div class="tab-content">
        <div id="main" class="tab-pane fade in active">
            <div class="inputContainer">
                <form id="view" action="/Rate Code/ViewItem/" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="rateCode_name" placeholder="" value="<?php echo $RCInfo->rateCode_name; ?>" />
                            </div>
                            <label>Hourly Cost:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="rateCode_hourly_cost" placeholder="" value="<?php echo $RCInfo->rateCode_hourly_cost; ?>" />
                            </div>
                            <label>Part Multiplier:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="rateCode_part_multiplier" placeholder="" value="<?php echo $RCInfo->rateCode_part_multiplier; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                        	<label>Code:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="rateCode_code" placeholder="" value="<?php echo $RCInfo->rateCode_code; ?>" />
                            </div>                       		
                            <label>Labor Multiplier:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="rateCode_labor_multiplier" placeholder="" value="<?php echo $RCInfo->rateCode_labor_multiplier; ?>" />
                            </div>
                            <label>Charge Multiplier:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="rateCode_charge_multiplier" placeholder="" value="<?php echo $RCInfo->rateCode_charge_multiplier; ?>" />
                            </div>
                       	</div>
                	</div>
                </form>
            </div>
        </div>
        <div id="extra" class="tab-pane fade">
            <h3>Advanced Search</h3>
            <p>Some content in menu 2.</p>
        </div>
    </div>
</div>