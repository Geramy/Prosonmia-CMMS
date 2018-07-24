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
<div class="formContainer" id="fsug">
	<form action="/includes/itasm.networking.php" method="post">
		<ul class="nav nav-tabs">
        	<li class="active"><a data-toggle="tab" href="#main">New Suggestion</a></li>		
   		</ul>
    	<div class="tab-content">
        	<div id="main" class="tab-pane fade in active">
        		<div class="inputContainer">
        			<label class="required">Subject:</label>
					<div class="input-group input-group-lg">
	                	<input class="form-control" type="text" name="sug_subject" placeholder="" required="true">
	            	</div>
	            	<label class="required">Message:</label>
	            	<div class="input-group input-group-lg">
	                	<textarea  rows="12" name="sug_message" placeholder="" required="true"></textarea>
	            	</div>
	            
	            	<input type="hidden" name="RQ" value="SUM" />
	            	<input type="hidden" name="Method" value="Create" />
	            	<button class="submit" name="sug_sub" value="Submit">Submit</button>
	         	</div>
         	</div>
		</div>
	</form>
</div>