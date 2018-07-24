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
	$rateCodeHTML = new UIRateCode();
	//$modAPI = new InventoryAPI($dbCon);
    $RateCodeElementArray = array("header" => "Rate code dialog.", "name" => "inv_ratecode_fk",
                                    "id" => "inv_rc_fk", "container-id" => "inv_fk_content",
                                    "placeholder" => "Begin typing a rate code here.", "title" => "Rate code dialog.",
                                    "success_label" => "Select Code", "onsave" => "alert(\"Success!\");",
                                    "extra_button_label" => "<a href='/Inventory/New'>Create Code</a>", "onextrasave" => null,
                                    "onclick" => ".proson-rate-code");

    $sub_alert = " ";
	$sub_alert_js = " ";
    if($_SESSION["SuccessSubmission"] == NULL) ;
    else if ($_SESSION["SuccessSubmission"] >= 0)
	{
		$sub_alert_js = "$('.submission_error').show(); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);";
		$sub_alert = "New Inventory has been successfully added";
	}
	else if ($_SESSION["SuccessSubmission"] < 0)
	{
		$sub_alert_js = "$('.submission_error').show(); $('.submission_error').css('background-color', '').css('background-color', '#F58476'); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);";
		if ($_SESSION["SuccessSubmission"] == -2)
            $sub_alert = "The code already exists please use a different inventory code.";
        else
            $sub_alert = "There was a problem with your submission. Please try again.";
	}

?>
<script type="text/javascript">
$("#new_inventory").ready(function() {
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
        $( "div > select[name='"+db_name+"_pk']" ).append("<option value=''>"+def+"</value>");
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


// $("#new_job").ready(function() {
//     $(".proson-item-search").on("click", function() { $(this).NewInvListItem(".proson-item-table"); });
// });


<?php
$rateCodeHTML->GenerateAddonJavascript($RateCodeElementArray);
?>
$("#new_inventory").ready(function() {
    $(".proson-item-search").on("click", function() { $(this).NewJobListItem(".proson-item-table"); });  //i dont think this is right. it says "NewJobListItem" but this is Inv
<?php
	echo $sub_alert_js;
    $rateCodeHTML->GenerateOnReadyJavascript($RateCodeElementArray);
?>
});
</script>
<div class="submission_error">
	<?php
		echo $sub_alert;
	?>
</div>
<div class="formContainer" id="new_inventory">
    <form action="/includes/itasm.networking.php" method="post" name="new_inventory">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#main">New Inventory</a></li>
        </ul>
        <div class="tab-content">
            <div id="main" class="tab-pane fade in active">
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
                    <!-- <label class="required">Select Rentable:</label>
                    <div class="input-group input-group-lg">
                        <select class="form-control" name="ren_pk"></select>
                    </div> -->
                    <label class="required">Code:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="inv_code" placeholder="" required="true" />
                    </div>
                    <label class="required">Rate Code:</label>
                    <div class="input-group input-group-lg proson-item-search proson-rate-code">
	                    <input class="form-control" type="text" name="inv_ratecode_fk" placeholder="" required="true" readonly="true" />
	                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>
                    <label class="required">Serial Number:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="inv_serial_number" placeholder="" required="true" />
                    </div>
                    <label class="required">Manufacturer:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="inv_manufacturer" placeholder="" required="true" />
                    </div>
                    <label class="required">Model:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="inv_model" placeholder="" required="true" />
                    </div>
                    <!-- <label class="required">Item Type:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="inv_item_type" placeholder="" required="true" />
                    </div>                     -->

                    <input type="hidden" name="RQ" value="INVM" />
                    <input type="hidden" name="Method" value="Create" />
                    <button type="submit" class="submit" name="inv_sub">Create Inventory</button>
                </div>
            </div>
            <script type="text/javascript">
              $(function() {
                $('.date').datepicker({});
              });
            </script>
        </div>
    </form>
</div>
<?php
  $rateCodeHTML->GenerateStaticAddonHtml($RateCodeElementArray);
?>
