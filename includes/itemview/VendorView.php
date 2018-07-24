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
	$VenAPI = new VendorAPI($dbCon);
	$VenInfo = $VenAPI->GetVendorInformation($id);
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
        <li class="active"><a data-toggle="tab" href="#main">Vendor Information</a></li>
        <li><a data-toggle="tab" href="#software">Software Licenses</a></li>
    </ul>
    <div class="tab-content">
        <div id="main" class="tab-pane fade in active">
			<div class="inputContainer">
                <form id="view" action="/Equipment/Search/" method="post">
                    <div class="row">
                        <div class="col-md-6">
                        	<label>Vendor Name:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="ven_name" placeholder="" value="<?php echo $VenInfo->ven_name; ?>" />
                            </div>
                            <label>Total Products:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="ven_products" placeholder="" value="0" />
                            </div>
                            <label>Client:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="ven_client" placeholder="" value="<?php echo $VenInfo->ven_client; ?>" />
                            </div>
							<label>Department:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="ven_department" placeholder="" value="<?php echo $VenInfo->ven_department; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Vendor Code:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="ven_code" placeholder="" value="<?php echo $VenInfo->ven_code; ?>" />
                            </div>
                            <label>Total Licence:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="ven_total_licence" placeholder="" value="0" />
                            </div>
                        	<label>Facility:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="ven_facility" placeholder="" value="<?php echo $VenInfo->ven_facility; ?>" />
                            </div>
                        	<label>Contact:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="ven_contact" placeholder="" value="<?php echo $VenInfo->ven_contact; ?>" />
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