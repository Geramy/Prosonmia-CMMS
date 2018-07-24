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
	$AAPI = new AcctHandler($coni);
	$BIData = $AAPI->GetBillableStatistics();
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
    });
});


</script>
<div class="formContainer" id="AccOverview">
    <form id ='view' action="/includes/itasm.networking.php" method="post" name="AccOverview">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#main">Account Overview</a></li>
            <li><a data-toggle="tab" href="#extra">Extra Fields</a></li>
            <li><a data-toggle="tab" href="#WorkOrder">Work Order Settings</a></li>

        </ul>
        <div class="tab-content">
            <div id="main" class="tab-pane fade in active">
                <div class="inputContainer">
                    <div class="row">
                        <?php
                        $EquipPercent = $BIData["cequipment"] / $BIData["mequipment"] * 100;
                        $UserPercent = $BIData["cusers"] / $BIData["musers"] * 100;
                        ?>
                        <div class="input-group-md col-md-6">
                        	<label>Billable Equipment:</label>
                            <div class="progress">
        						<div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
        				           aria-valuenow="<?php echo $EquipPercent; ?>" style="width: <?php echo $EquipPercent; ?>%;" aria-valuemin="0" aria-valuemax="<?php echo $BIData["mequipment"]; ?>">
        						</div>
        						<span class="show">Equipment: <?php echo $BIData["cequipment"]; ?> used of <?php echo $BIData["mequipment"]; ?></span>
        					</div>
    					</div>
    					<div class="input-group-md col-md-6">
                            <label>Billable Users:</label>
                            <div class="progress">
                                <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
                                   aria-valuenow="<?php echo $UserPercent; ?>" style="width: <?php echo $UserPercent; ?>%;" aria-valuemin="0" aria-valuemax="<?php echo $BIData["musers"]; ?>">
                                </div>
                                <span class="show">Users: <?php echo $BIData["cusers"]; ?> used of <?php echo $BIData["musers"]; ?></span>
                            </div>
                        </div>
                        <div class="input-group-md col-md-6">
                            <label>Active Network Scanners:</label>
                            <div class="progress">
                                <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
                                   aria-valuenow="60" style="width: 60%;" aria-valuemin="0" aria-valuemax="100">
                                </div>
                                <span class="show">Licensed Scanners: 10/1000</span>
                            </div>
                        </div>
                        <div class="input-group-md col-md-6">
                            <label>Active Network Monitors:</label>
                            <div class="progress">
                                <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
                                   aria-valuenow="60" style="width: 60%;" aria-valuemin="0" aria-valuemax="100">
                                </div>
                                <span class="show">Licensed Monitors: 10/1000</span>
                            </div>
                        </div>
                        <div class="input-group-md col-md-12">
                            <button class="submit">Upgrade Account</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="extra" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Some content in menu 2.</p>
            </div>
            <div id="WorkOrder" class="tab-pane fade">
                <h3></h3>
                <p></p>
                <div class='row'>
                    <div class="input-group-md col-md-6 edittable">
                        <label>Work Order Number Prefix:</label>
                        <input class="form-control input-sm proson-nochange" type="text" name="acct_wo_prefix" placeholder="" required="false" value="<?php echo($BIData['woprefix']); ?>" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
