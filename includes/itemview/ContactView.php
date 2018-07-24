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
$ContactHandler = new ContactAPI($dbCon);
$ContactInfo = $ContactHandler->GetContactInfo($id);
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
        <li class="active"><a data-toggle="tab" href="#main">Contact Information</a></li>
        <li><a data-toggle="tab" href="#network">Address</a></li>
        <li><a data-toggle="tab" href="#software"></a></li>
    </ul>
    <div class="tab-content">
        <div id="main" class="tab-pane fade in active">
            <div class="inputContainer">
                <form id="view" action="/Contacts/ViewItem/" method="post">
                	<div class="row">
                        <div class="col-md-6">
                        	<label>First Name:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="con_fname" placeholder="" value="<?php echo $ContactInfo->con_fname; ?>" />
                            </div>
                             <label>Phone:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="con_phone" placeholder="" value="<?php echo $ContactInfo->con_phone; ?>" />
                            </div>               
                        </div>
                        <div class="col-md-6">
                            <label>Last Name:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="con_lname" placeholder="" value="<?php echo $ContactInfo->con_lname; ?>" />
                            </div>
                            <label>Email:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="con_email" placeholder="" value="<?php echo $ContactInfo->con_email; ?>" />
                            </div>
                        </div>           
                    </div>
                    <div class="row">
                    	<div class="col-md-12">
                        	<label>Notes:</label>
			            	<div class="input-group input-group-lg edittable">
			                	<textarea rows="12" name="con_notes" placeholder=""><?php echo $ContactInfo->con_notes; ?></textarea>
			    			</div>
			    		</div>
			       	</div>  
                </form>
            </div>
        </div>
        <div id="network" class="tab-pane fade">
            <div class="inputContainer">
                <form id="search" action="/Contacts/Search/" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Address:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="con_address" placeholder="" value="<?php echo $ContactInfo->con_address; ?>" />
                            </div>
                            <label>City:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="con_city" placeholder="" value="<?php echo $ContactInfo->con_city; ?>" />
                            </div>
                            <label>State:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="con_state" placeholder="" value="<?php echo $ContactInfo->con_state; ?>" />
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <label>Postal Code:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="con_postal_code" placeholder="" value="<?php echo $ContactInfo->con_postal_code; ?>" />
                            </div>
                            <label>County:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="con_county" placeholder="" value="<?php echo $ContactInfo->con_county; ?>" />
                            </div>
                            <label>Country:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="con_country" placeholder="" value="<?php echo $ContactInfo->con_country; ?>" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="software" class="tab-pane fade">
            <div class="form-header">
                Management & Portal Access
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