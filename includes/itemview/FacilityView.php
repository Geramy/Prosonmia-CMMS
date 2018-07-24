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
	$FacilityHandler = new FacilityAPI($dbCon);
	$FacInfo = $FacilityHandler->GetFacilityInformation($id);
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
        <li class="active"><a data-toggle="tab" href="#main">Facility Information</a></li>
        <li><a data-toggle="tab" href="#address">Address Information</a></li>
        <li><a data-toggle="tab" href="#extra">Extra Tab</a></li>
    </ul>
    <div class="tab-content">
        <div id="main" class="tab-pane fade in active">
            <div class="inputContainer">
                <form id="view" action="/Facilities/ViewItem/" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Facility Name:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="fac_name" placeholder="" value="<?php echo $FacInfo["fac_name"]; ?>" />
                            </div>
                            <label>Contact Name:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="fac_contact_name" placeholder="" value="<?php echo $FacInfo["fac_contact_name"]; ?>" />
                            </div>
                            <label>Email Address:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="fac_email" placeholder="" value="<?php echo $FacInfo["fac_email"]; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                        	<label>Facility Code:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="fac_code" placeholder="" value="<?php echo $FacInfo["fac_code"]; ?>" />
                            </div>
                            <label>Phone Number:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="fac_phone" placeholder="" value="<?php echo $FacInfo["fac_phone"]; ?>" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="address" class="tab-pane fade">
            <div class="inputContainer">
                <form id="search" action="/Facilities/ViewItem/" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Address 1:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="fac_address1" placeholder="" value="<?php echo $FacInfo["fac_address1"]; ?>" />
                            </div>
                            <label>City:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="fac_city" placeholder="" value="<?php echo $FacInfo["fac_city"]; ?>" />
                            </div>
                            <label>County:</label>
				            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="fac_county" placeholder="" value="<?php echo $FacInfo["fac_county"]; ?>" />
				            </div>
				            <label>Zip/Postal Code:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="fac_postal_code" placeholder="" value="<?php echo $FacInfo["fac_postal_code"]; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Address 2:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="fac_address2" placeholder="" value="<?php echo $FacInfo["fac_address2"]; ?>" />
                            </div>
                            <label>State:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="fac_state" placeholder="" value="<?php echo $FacInfo["fac_state"]; ?>" />
                            </div>
                            <label>Country:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="fac_country" placeholder="" value="<?php echo $FacInfo["fac_country"]; ?>" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="extra" class="tab-pane fade">
            <div class="inputContainer">
                <form id="search" action="/Facility/ViewItem/" method="post">
                    <div class="col-md-16">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
