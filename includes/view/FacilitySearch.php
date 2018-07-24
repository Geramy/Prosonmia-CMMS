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
    $("#fac_search").ready(function() {
        function complete( data ) {
            $( "#fac_search select[name='cli_pk']" ).append("<option value=''>Select Client</value>");
            var SelectedID = null;
            <?php
            if(array_key_exists ("id", $_GET) && sizeof($_GET["id"]) > 0) {
                echo "SelectedID = ".$_GET["id"].";\r\n";
            }
            ?>
            for(i = 0; i < data.length; i++) {
                var value = data[i];
                if(value == null)
                    continue;
                $( "#fac_search select[name='cli_pk']" ).append("<option value='/"+value["cli_pk"]+"'"+(SelectedID != null && value["cli_pk"] == SelectedID ? " selected" : "")+">"+value["cli_company"]+"</value>");
            }

        }
        $.ajax({
          type: "POST",
          url: "/includes/itasm.networking.php",
          data: { RQ: "CLM", Method: "GetClients" },
          success: complete,
          dataType: "json"
        });
        $("#fac_search select[name='cli_pk']").on("change", function() {
            $('#fac_search').attr('action', '/Facilities/ViewFacilities'+$(this).val());
            $('#fac_search').submit();
        });
        $(".table > tbody > tr").on('click', function() {
       		 $('#fac_search').attr('action', '/<?php echo $mod; ?>/ViewItem/' + $(this).find("td:last").html());
       		 $('#fac_search').submit();
    	});
    });
</script>
<div class="formContainer">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#main">Facility Search</a></li>
		<li><a data-toggle="tab" href="#advanced">Advanced Search</a></li>
	</ul>
	<div class="tab-content">
		<div id="main" class="tab-pane fade in active">
			<div class="form-header">
				Basic Search
			</div>

			<div class="input-container">
				<form id="fac_search" action="/Facilities/ViewFacilities/" method="post">
					<div class="col-md-13">
						<div class="row">
							<div class="col-lg-5">
								<div class="input-group input-group-lg">
									Select Client
									<select class="form-control" name="cli_pk"></select>
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
<table class="table">
    <thead>
        <tr>
            <th>Facility Name</th>
            <th>Facility Code</th>
        </tr>
    </thead>
    <tbody class="selectable">
        <?php
        if(array_key_exists ("id", $_GET)) {
            $id = $_GET["id"];
            $facHandler = new FacilityAPI($dbCon);
            $FacList = $facHandler->GetFacilityList($id);
            foreach($FacList as $value) {
                ?>
                <tr>
                    <td><?php echo $value["fac_name"]; ?></td>
                    <td><?php echo $value["fac_code"]; ?></td>
                    <td class="hidden"><?php echo $value["fac_pk"]; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
</div>
