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
    $modAPI = new DepartmentAPI($dbCon);
?>
<script type="text/javascript">
$("#new_department").ready(function() {
    var Module = "";
    var DefaultClient = "Select Client";
    var DefaultFacility = "Select Facility";
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
                break;
            case 1:
                def = DefaultFacility;
                db_name = "fac";
                url_id = "id1";
                name = "name"
                $( "div > select[name='fac_pk']" ).empty();
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
    <?php
        if($id != null) {
            echo "_id = ".$id;
        }
        if($id1 != null) {
            echo "_id1 = ".$id1;
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
});
</script>

<div class="submission_error">
	<?php
		if ($_SESSION["SuccessSubmission"] > 0)
		{
			echo "<script type='text/javascript'>$('.submission_error').show(); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);</script>";
			echo "Department has been successfully added";
		}
		else if ($_SESSION["SuccessSubmission"] < 0)
		{
			echo "<script type='text/javascript'>$('.submission_error').show(); $('.submission_error').css('background-color', '').css('background-color', '#F58476'); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);</script>";
			echo "There was a problem with your submission. Please try again.";
		}
	?>
</div>
<div class="formContainer" id="fdep">
		<form action="/includes/itasm.networking.php" method="post" name="new_department">
			<ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#main">New Department</a></li>
			<li><a data-toggle="tab" href="#address">Address</a></li>
			<li><a data-toggle="tab" href="#extra">Extra Fields</a></li>
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
            		<label class="required">Department Name:</label>
					<div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="dep_name" placeholder="" required="true">
		            </div>
		            <label class="required">Department Code:</label>
		            <div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="dep_code" placeholder="" required="true">
		            </div>
		            <label class="required">Contact Name:</label>
		            <div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="dep_contact_name" placeholder="" required="true">
		            </div>
		            <label class="required">Phone:</label>
		            <div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="dep_phone" placeholder="" required="true">
		            </div>
		            <label>Email:</label>
					<div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="dep_email" placeholder="">
		            </div>
		            <!-- Department Description needs a way to store the data into the db -->
		            <div class="row">
                        <div class="col-md-12">
                            <label>Description:</label>
                            <textarea name="dep_desc" rows="6" /></textarea>
                        </div>
                    </div>
		            <input type="hidden" name="RQ" value="DEM" />
		            <input type="hidden" name="Method" value="Create" />
		            <button class="submit" name="dep_sub" value="Submit">Submit</button>
		         </div>
	         </div>
	         <div id="address" class="tab-pane fade">
	         	<div class="inputContainer">
	         		<label>Address 1:</label>
		            <div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="dep_address1" placeholder="">
		            </div>
		            <label>Address 2:</label>
		            <div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="dep_address2" placeholder="">
		            </div>
		            <label>City:</label>
		            <div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="dep_city" placeholder="">
		            </div>
		            <label>Zip/Postal Code:</label>
		            <div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="dep_postal_code" placeholder="">
		            </div>
		            <label>County:</label>
		            <div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="dep_county" placeholder="">
		            </div>
		            <label>State:</label>
		            <div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="dep_state" placeholder="">
		            </div>
		            <label>Country:</label>
		            <div class="input-group input-group-lg">
		                <input class="form-control" type="text" name="dep_country" placeholder="">
		            </div>
		    	</div>
	        </div>
	        <div id="extra" class="tab-pane fade">
	         	<div class="inputContainer">
		         	 <h3>extra menu</h3>
	                <p>Some content.</p>
            	</div>
	    	</div>
		</div>
	</form>
</div>
<?php
	$_SESSION["SuccessSubmission"] = 0;
 ?>