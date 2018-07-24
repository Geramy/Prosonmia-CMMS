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

?>
<script type="text/javascript">
    $("#search").ready(function() {
        var Module = "";
        var DefaultClient = "Select Client";
        var DefaultFacility = "Select Facility";
        var DefaultDepartment = "Select Department";
        var SelectedID = 0;
        function complete( data, sItem ) {
            var def = "";
            var db_name = "";
            var url_id = "";
            switch(sItem)
            {
                case 0:
                    def = DefaultClient;
                    db_name = "cli";
                    url_id = "id";
                    SelectedID = <?php echo $id == null ? "null" : $id; ?>;
                    break;
                case 1:
                    def = DefaultFacility;
                    db_name = "fac";
                    url_id = "id1";
                    SelectedID = <?php echo $id1 == null ? "null" : $id1; ?>;
                    break;
                case 2:
                    def = DefaultDepartment;
                    db_name = "dep";
                    url_id = "id2";
                    SelectedID = <?php echo $id2 == null ? "null" : $id2; ?>;
                    break;
            }
            $("#search select[name='"+db_name+"_pk']").empty();
            $( "#search select[name='"+db_name+"_pk']" ).append("<option value=''>"+def+"</value>");
            for(i = 0; i < data.length; i++) {
                var value = data[i];
                if(value == null)
                    continue;
                $( "#search select[name='"+db_name+"_pk']" ).append("<option value='"+value[db_name+"_pk"]+"'"+(SelectedID == value[db_name+"_pk"] ? " selected" : "")+">"+value[db_name+"_name"]+"</value>");
            }

        }
        function SubmitSearch(sT, _id, _id1, _id2) {
            $.ajax({
              type: "POST",
              url: "/includes/itasm.networking.php",
              data: {RQ: "EQUIP", Method: "OrgSearch", id: _id, id1: _id1, id2: _id2},
              success: function(data) { complete(data, sT) },
              dataType: "json"
            });
        }
<?php
        echo "SubmitSearch(0, 'NULL', 'NULL', 'NULL');\r\n";
        if($id != null)
            echo "SubmitSearch(1, ".$id.", 'NULL', 'NULL');\r\n";
        if($id1 != null)
            echo "SubmitSearch(2, ".$id.", ".$id1.", 'NULL');\r\n";
        if($id2 != null)
            echo "SubmitSearch(3, ".$id.", ".$id1.", ".$id2.");\r\n";
?>
        $("#search select[name='cli_pk']").on("change", function() {
            if($("#search select[name='fac_pk']").val() == "") {
                $('#search').attr('action', '/<?php echo $mod; ?>/<?php echo $act; ?>');
                $('#search').submit();
                return;
            }
            $('#search').attr('action', '/<?php echo $mod; ?>/<?php echo $act; ?>/'+$(this).val());
            $('#search').submit();
        });
        $("#search select[name='fac_pk']").on("change", function() {
            if($("#search select[name='fac_pk']").val() == "") {
                $('#search').attr('action', '/<?php echo $mod; ?>/<?php echo $act; ?>/<?php echo $id; ?>');
                $('#search').submit();
                return;
            }
            $('#search').attr('action', '/<?php echo $mod; ?>/<?php echo $act; ?>/<?php echo $id; ?>/'+$(this).val());
            $('#search').submit();
        });
        $("#search select[name='dep_pk']").on("change", function() {
            if($("#search select[name='dep_pk']").val() == "") {
                $('#search').attr('action', '/<?php echo $mod; ?>/<?php echo $act; ?>/<?php echo $id; ?>/<?php echo $id1; ?>');
                $('#search').submit();
                return;
            }
            $('#search').attr('action', '/<?php echo $mod; ?>/<?php echo $act; ?>/<?php echo $id; ?>/<?php echo $id1; ?>/'+$(this).val());
            $('#search').submit();
        });
        $(".circle-j").on('click', function() {
            $('#search').attr('action', '/<?php echo $mod; ?>/ViewItem/' + $(this).find("dl").attr("id"));
            $('#search').submit();
        });
    });
</script>
<div class="formContainer">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#main">Equipment Search</a></li>
        <li><a data-toggle="tab" href="#advanced">Advanced Search</a></li>
    </ul>
    <div class="tab-content">
        <div id="main" class="tab-pane fade in active">
            <div class="form-header">
                Basic Search
            </div>
            <div class="inputContainer">
                <form id="search" action="/Equipment/Search/" method="post">
                    <div class="col-md-16">
                      <div class="row">
                        <div class="col-lg-5">
                            <div class="input-group input-group-lg">
                                Select Client
                                <select class="form-control" name="cli_pk"></select>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="input-group input-group-lg">
                                Select Facility
                                <select class="form-control" name="fac_pk"></select>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-16">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="input-group input-group-lg">
                                    Select Department
                                    <select class="form-control" name="dep_pk"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="advanced" class="tab-pane fade">
            <h3>Advanced Search</h3>
            <p>Some content in menu 2.</p>
        </div>
    </div>
</div>
<div class="table-responsive">



<?php
if(array_key_exists ("id", $_GET)) {
    $equip = new EquipmentAPI($dbCon);
    $equipList = $equip->EquipmentSearch(array_key_exists("id", $_GET) ? $id : "NULL", array_key_exists("id1", $_GET) ? $id1 : "NULL", array_key_exists("id2", $_GET) ? $id2 : "NULL");

    $total_count = count($equipList);
    $total_rows = $total_count / 3;
    $row = 0;
    $count_item = 0;
    while($row < $total_rows)
    {
        ?>
        <div class="divider"></div>
        <div class="row">
        <?php
        $i = 0;
        while($i < 3 && $count_item < $total_count) {
            ?>
            <div class="col-md-3 circle-j">
                <div class="text-center round">EQ</div>
                <dl id="<?php echo $equipList[$count_item]["eq_pk"]; ?>">
                    <dt class="text-center"><?php echo $equipList[$count_item]["eq_code"]; ?></dt>
                    <dt class="text-center"><?php echo $equipList[$count_item]["eq_item_type"]; ?></dt>
                    <dt class="text-center"><?php echo $equipList[$count_item]["eq_manufacturer"]; ?></dt>
                    <dt class="text-center"><?php echo $equipList[$count_item]["eq_model"]; ?></dt>
                </dl>
            </div>
            <?php
            $count_item++;
            $i++;
        }
        ?>
        </div>
        <?php
        $row++;
    }
}
?>
</div>
<script type="text/javascript">
  $(function() {
    $( ".button_placeholder" ).button({
    icons: { primary: "ui-icon-pencil", secondary: "ui-icon-triangle-1-s" }
    });
  });
</script>
