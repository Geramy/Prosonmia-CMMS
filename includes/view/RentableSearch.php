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
<script type="text/javascript">
    $("#search").ready(function() {
        var Module = "";
        var DefaultClient = "Select Contact";
        var SelectedID = 0;
        function complete( data, sItem ) {
            var def = "";
            var db_name = "";
            var url_id = "";
            switch(sItem)
            {
                case 0:
                    def = DefaultClient;
                    db_name = "con";
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
                $( "#search select[name='"+db_name+"_pk']" ).append("<option value='"+value[db_name+"_pk"]+"'"+(SelectedID == value[db_name+"_pk"] ? " selected" : "")+">"+value[db_name+"_name"]+"</value>");
            }
            
        }
        function SubmitSearch(sT, _id, _id1, _id2) {
            $.ajax({
              type: "POST",
              url: "/includes/itasm.networking.php",
              data: {RQ: "RIM", Method: "OrgSearch", id: _id},
              success: function(data) { complete(data, sT) },
              dataType: "json"
            });
        }
<?php
        echo "SubmitSearch(0, 'NULL', 'NULL', 'NULL');\r\n";
?>
        $("#search select[name='con_pk']").on("change", function() {
            $('#search').attr('action', '/<?php echo $mod; ?>/<?php echo $act; ?>/'+$(this).val());
            $('#search').submit();
        });
        $(".table > tbody > tr").on('click', function() {
            $('#search').attr('action', '/<?php echo $mod; ?>/ViewItem/' + $(this).find("td:last").html());
            $('#search').submit();
        });
    });
</script>
<div class="formContainer">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#main">Rentable Search</a></li>
        <li><a data-toggle="tab" href="#advanced">Advanced Search</a></li>
    </ul>
    <div class="tab-content">
        <div id="main" class="tab-pane fade in active">
            <div class="inputContainer">
                <form id="search" action="/Users/ViewRentable/" method="post">
                    <div class="col-md-16">
                        <div class="input-group input-group-lg">
                            Select Contact
                            <select class="form-control" name="con_pk"></select>
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
<table class="table">
    <thead>
        <tr>
        	<th>Name</th>
        	<th>Inventory Code</th>
            <th>Rent Start</th>
            <th>Rent End</th>
            <th>Shipped Start</th>
            <th>Shipped End</th>
        </tr>
    </thead>
    <tbody class="selectable">
        <?php
        	$rentAPI = new RentAPI($dbCon);
            $rent = $rentAPI->Search($id);
            foreach($rent as $value) {
                ?>
                <tr>
		 			<td><?php echo $value["con_name"]; ?></td>
		 			<td><?php echo $value["inv_code"]; ?></td>
                    <td><?php echo $value["ren_startDate"]; ?></td>
                    <td><?php echo $value["ren_endDate"]; ?></td>
                    <td><?php echo $value["ren_shippedDate"]; ?></td>
                    <td><?php echo $value["ren_arrivedDate"]; ?></td>
                    <td class="hidden"><?php echo $value["ren_pk"]; ?></td>
                </tr>
                <?php
            }
        ?>
    </tbody>
</table>
</div>
