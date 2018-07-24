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
    $equip = new EquipmentAPI($dbCon);
	$sub_alert = " ";
	$sub_alert_js = " ";

	if ($_SESSION["SuccessSubmission"] > 0)
	{
		$sub_alert_js = "$('.submission_error').show(); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);";
		$sub_alert = "Equipment has been successfully added";
	}
	else if ($_SESSION["SuccessSubmission"] < 0)
	{
		$sub_alert_js = "$('.submission_error').show(); $('.submission_error').css('background-color', '').css('background-color', '#F58476'); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);";
		$sub_alert = "There was a problem with your submission. Please try again.";
	}
?>
<script type="text/javascript">
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
<?php
	echo $sub_alert_js;
?>
});

</script>
<div class="submission_error">
	<?php
		echo $sub_alert;
	?>
</div>
<div class="formContainer" id="new_equipment">
    <form action="/includes/itasm.networking.php" method="post">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#main">New Equipment</a></li>
            <li><a data-toggle="tab" href="#pinfo">Purchase Info</a></li>
            <li><a data-toggle="tab" href="#pms">Maintenance Schedule</a></li>
        </ul>
        <div class="tab-content">
            <div id="main" class="tab-pane fade in active">
                <div class="form-header">
                </div>
                <div class="inputContainer">
                    <div class="input-group input-group-lg">
                        <select class="form-control" name="cli_pk"></select>
                    </div>
                    <div class="input-group input-group-lg">
                        <select class="form-control" name="fac_pk"></select>
                    </div>
                    <div class="input-group input-group-lg">
                        <select class="form-control" name="dep_pk"></select>
                    </div>
                    <label class="required">Asset Number:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="eq_code" placeholder="" required="true" />
                    </div>
                    <label>Parent Asset Number:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="eq_parent_code" placeholder="" />
                    </div>
                    <label class="required">Serial Number:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="eq_serial_number" placeholder="" required="true" />
                    </div>
                    <label class="required">Item Type:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="eq_item_type" placeholder="" required="true" />
                    </div>
                    <label class="required">Manufacturer:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="eq_manufacturer" placeholder="" required="true" />
                    </div>
                    <label class="required">Model:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="eq_model" placeholder="" required="true" />
                    </div>

                    <input type="hidden" name="pur_itemType" value="1" />
                    <input type="hidden" name="RQ" value="EQUIP" />
                    <input type="hidden" name="Method" value="Create" />
                    <button class="submit" name="eq_sub">Create Equipment</button>
                </div>
            </div>
            <div id="pinfo" class="tab-pane fade">
                <h3></h3>
                <p>
                	<label>Unit Cost:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="number" step="any" name="pur_cost" placeholder="" />
                    </div>
                    <label>Purchase Date:</label>
                    <div class="input-group date">
                        <input class="form-control" type="text" name="pur_date" placeholder=""></input>
                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>
                    <label>Distributor:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="pur_distributor" placeholder="" />
                    </div>
                    <label>Approved By:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="pur_approver" placeholder="" />
                    </div>
                </p>
            </div>
            <div id="pms" class="tab-pane fade">
                <p>

                </p>
            </div>
            <script type="text/javascript">
              $(function() {
                $('.date').datepicker({});
              });
            </script>
        </div>
    </form>
</div>
