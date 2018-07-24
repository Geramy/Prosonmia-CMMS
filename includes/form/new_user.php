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
    $modAPI = new UserAPI($coni);
?>
<script type="text/javascript">
$("#new_user").ready(function() {
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
<div class="formContainer" id="new_user">
    <form action="/includes/itasm.networking.php" method="post" name="new_user">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#main">New User</a></li>
            <li><a data-toggle="tab" href="#pinfo">Profile Information</a></li>
            <li><a data-toggle="tab" href="#extra">Extra Fields</a></li>
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
                    <label class="required">Username:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="usr_username" placeholder="" required="true" />
                    </div>
                    <label class="required">Email Address:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="usr_email" placeholder="" required="true" />
                    </div>
                    <label class="required">First Name:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="usr_fname" placeholder="" required="true" />
                    </div>
                    <label class="required">Last Name:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="usr_lname" placeholder="" required="true" />
                    </div>
                    <label class="required">Password:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="usr_password" placeholder="" required="true" />
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="usr_portal_access" />
                            Portal Login
                        </label>
                    </div>

                    <input type="hidden" name="pur_itemType" value="1" />
                    <input type="hidden" name="RQ" value="USM" />
                    <input type="hidden" name="Method" value="Create" />
                    <button type="submit" class="submit" name="eq_sub">Create User</button>
                </div>
            </div>
            <div id="pinfo" class="tab-pane fade">
                <h3></h3>
                <p>
                	<label>Title:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="usr_title" placeholder="" />
                    </div>
                    <label>Hire Date:</label>
                    <div class="input-group input-group-lg date">
                        <input class="form-control" type="text" name="usr_hiredate" placeholder="" />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>
                    <label>Manager:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="usr_manager" placeholder="" />
                    </div>
                    <label>Address 1:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text"name="usr_address1" placeholder="" />
                    </div>
                    <label>Address 2:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="usr_address2" placeholder="" />
                    </div>
                    <label>City:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="usr_city" placeholder="" />
                    </div>
                    <label>State:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="usr_state" placeholder="" />
                    </div>
                    <label>Postal Code:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="usr_postal_code" placeholder=""/>
                    </div>
                    <label>Country:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="usr_country" placeholder=""/>
                    </div>
                </p>
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
