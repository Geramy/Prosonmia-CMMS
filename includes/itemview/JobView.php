<?php
///
/// JQluv.net, Inc. ("COMPANY") CONFIDENTIAL
/// Unpublished Copyright (c) 2015-2018 JQluv.net, Inc, All Rights Reserved.
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
$JobHandler = new JobAPI($dbCon);
$JobInfo = $JobHandler->JobInfo($id);
//$JobInfo->store_result();
?>
<script type="text/javascript">

$(document).ready(function() {
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
        setTimeout(function (){
            $("#view").JQluvAutoSave();
            SaveLoop();
        }, 1000);
    }
    SaveLoop();
});
</script>
<div class="formContainer">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#main">Job Information</a></li>
        <li><a data-toggle="tab" href="#checklist">Check List</a></li>
    </ul>
    <div class="tab-content">
        <div id="main" class="tab-pane fade in active">
            <div class="inputContainer">
                <form id="view" action="/Equipment/Search/" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Job Name:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="jobl_name" placeholder="" value="<?php echo $JobInfo->jobl_name; ?>" />
                            </div>
                            <label>Job Code:</label>
                            <div class="input-group input-group-lg edittable">
                                <input class="form-control input-sm proson-nochange" type="text" name="jobl_code" placeholder="" value="<?php echo $JobInfo->jobl_code; ?>" />
                            </div>
							<label>Job Rate Code:</label>
                            <div class="input-group input-group-lg edittable proson-item-search">
                            	<input class="form-control input-sm proson-nochange" type="text" name="ratecode" placeholder="" readonly="true" value="<?php echo $JobInfo->ratecode; ?>" />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                            <div class="input-group input-group-lg edittable">
                                <label>Job Description:</label>
                                <textarea class="" name="jobl_description" rows="6" /><?php echo $JobInfo->jobl_description; ?></textarea>
                            </div>
                    	</div>
                    </div>
                </form>
            </div>
        </div>
        <div id="checklist" class="tab-pane fade">
			<div class="table-responsive">
			<table class="table">
			    <thead>
			        <tr>
			        	<th>Item Name</th>
			            <th>Item Order</th>
						<th>Required Pass</th>
						<th>Enabled Notes</th>
			        </tr>
			    </thead>
			    <tbody class="selectable">
				       	<?php
						/*
			            include_once("api/JobAPI.php");
			            $id = $_GET["id"];
			            $JobHandler = new JobAPI($dbCon);
			            $tasks = $woAPI->TaskSearch($id == null ? "NULL" : $id, $id1 == null ? "NULL" : $id1, $id2 == null ? "NULL" : $id2, false);

						if(array_key_exists('id', $_GET))
					    	$id = $_GET["id"];
						*/
						//alert($id);

						//$JobInfoList = $JobHand->JobInfoList($id);
						//alert($JobInfoList);
						//echo"$JobInfoList";
            $results = $JobHandler->JobInfoList($JobInfo->jobl_pk);
            for($i = 0; $i < count($results); $i++)
						{
              $value = $results[$i];

			                ?>
			         		<tr id="<?php echo $value->jobli_pk; ?>">
			         			<td><?php echo $value->jobli_name; ?></td>
			                    <td><?php echo $value->jobli_order; ?></td>
			                    <td><?php echo ($value->jobli_pass_required == 1) ? "Yes" : "No"; ?></td>
			                    <td><?php echo ($value->jobli_notes == 1) ? "Yes" : "No"; ?></td>
							</tr>
			                <?php
			            }

			        ?>
			    </tbody>
			</table>
			</div>
        </div>
    </div>
</div>
