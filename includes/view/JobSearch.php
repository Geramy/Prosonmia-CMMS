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
    $(document).ready(function () {
    $(".table > tbody > tr").on('click', function() {
        $('#search').attr('action', '/<?php echo $mod; ?>/ViewItem/' + $(this).find("td:last").html());
        $('#search').submit();
    });
});
</script>

<div class="formContainer">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#main">Job List</a></li>
        <li><a data-toggle="tab" href="#jobsearch">Job Search</a></li>
    </ul>
    <div class="tab-content">
    	<div id="main" class="tab-pane fade in active">
        	<div class="table-responsive">
        		<form id="search" action="/Job Library/Search" method="POST">
	        		<table class="table">
					    <thead>
					        <tr>
					            <th>Job Name</th>
					            <th>Job Code</th>
					            <th>Job Rate Code</th>
					        </tr>
					    </thead>
					    <tbody class="selectable">
					        <?php
					        	$id = null;
					            if(array_key_exists('id', $_GET))
					                $id = $_GET["id"];
					            $jobHandler = new JobAPI($dbCon);
					            $jobList = $jobHandler->GetJobList();
					            foreach($jobList as $value) {
					                ?>
					                <tr>
					                    <td><?php echo $value["jobl_name"]; ?></td>
					                    <td><?php echo $value["jobl_code"]; ?></td>
					                    <td><?php echo $value["jobl_ratecode"]; ?></td>
					                    <td class="hidden"><?php echo $value["jobl_pk"]; ?></td>
					                </tr>
					                <?php
					            }
					        ?>
					    </tbody>
					</table>
				</form>
			</div>
        </div>
        <div id="jobsearch" class="tab-pane fade">
            <h3>Advanced Search</h3>
            <p>Some content in menu 2.</p>
        </div>
    </div>
</div>