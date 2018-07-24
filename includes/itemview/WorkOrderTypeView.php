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

$WTypeAPI = new WorkOrderTypeAPI($dbCon);
?>
<script type="text/javascript">
    $("#search").ready(function() {
        var Module = "";
        var DefaultOption = "Select Work Order Type";
        var SelectedID = 0;
        function complete( data, sItem ) {
            var def = "";
            var db_name = "";
            var url_id = "";
            switch(sItem)
            {
                case 0:
                    def = DefaultOption;
                    db_name = "wtype";
                    url_id = "id";
                    SelectedID = <?php echo $id == null ? "null" : $id; ?>;
                    break;
            }
            $("#search select[name='"+db_name+"_pk']").empty();
            $( "#search select[name='"+db_name+"_pk']" ).append("<option value=''>"+def+"</value>");
            for(i = 0; i < data.length; i++) {
                var value = data[i];
                if(value == null)
                    continue;
                $( "#search select[name='"+db_name+"_pk']" ).append("<option value='"+value[db_name+"_pk"]+"'"+(SelectedID == value[db_name+"_pk"] ? " selected" : "")+">"+value[db_name+"_code"]+"</value>");
            }
            
        }
        function SubmitSearch(sT, _id) {
            $.ajax({
              type: "POST",
              url: "/includes/itasm.networking.php",
              data: {RQ: "WOTM", Method: "Search", id: _id},
              success: function(data) { complete(data, sT) },
              dataType: "json"
            });
        }
<?php
        echo "SubmitSearch(0, 'NULL', 'NULL', 'NULL');\r\n";
?>
        $("#search select[name='wtype_pk']").on("change", function() {
            $('#search').attr('action', '/<?php echo $mod; ?>/<?php echo $act; ?>/'+$(this).val());
            $('#search').submit();
        });
        $(".circle-j").on('click', function() {
            $('#search').attr('action', '/<?php echo $mod; ?>/ViewItem/' + $(this).find("dl").attr("id"));
            $('#search').submit();
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
<div class="formContainer">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#search">Search</a></li>
        <li><a data-toggle="tab" href="#new">New</a></li>
    </ul>
    <div class="tab-content">
        <div id="search" class="tab-pane fade in active">
            <div class="inputContainer">
                <div class="inputContainer">
                    <form id="search" action="/Work Order Type/Search/" method="post">
                        <div class="col-md-16">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group input-group-lg">
                                        Select Work Order Type
                                        <select class="form-control" name="wtype_pk"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Type Name</th>
                                            <th>Type Code</th>
                                        </tr>
                                    </thead>
                                    <tbody class="selectable">
                                        <?php
                                            $wtypeList = $WTypeAPI->Search($id);
                                            foreach($wtypeList as $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $value["wtype_name"]; ?></td>
                                                    <td><?php echo $value["wtype_code"]; ?></td>
                                                    <td class="hidden"><?php echo $value["wtype_pk"]; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="new" class="tab-pane fade">
            <h3>New Work Order Type Form</h3>
            <form action="/includes/itasm.networking.php" method="post">
                <div class="inputContainer">
                    <label class="required">Name:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="wtype_name" placeholder="" required="true" />
                    </div>
                    <label class="required">Code:</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="wtype_code" placeholder="" required="true" />
                    </div>
                    <input type="hidden" name="RQ" value="WOM" />
                    <input type="hidden" name="Method" value="NewWOType" />
                    <button class="submit" name="wot_create">Create Type</button>
                </div>
            </form>
        </div>
    </div>
</div>