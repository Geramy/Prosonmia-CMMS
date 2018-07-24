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
<div class="reg_formContainer" id="fregister">
	<div class="reg_form-header">
		<a href="#" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-arrow-left"></span>
    </a>
	</div>
	<form action="includes/itasm.networking.php" method="post" id="registerForm">
		<ul class="nav nav-tabs">
	        <li class="active"><a data-toggle="tab" href="#main">Register</a></li>
	        <li><a data-toggle="tab" href="#profile">Profile Info</a></li>
			<li><a data-toggle="tab" href="#address">Address</a></li>
	    </ul>
    	<div class="tab-content">
	    	<div id="main" class="tab-pane fade in active">
				<div class="reg_inputContainer">
					<label class="required">Username:</label>
	           		<div class="input-group input-group-lg">
	            		<input class="form-control" type="text" name="fuser" placeholder="" required="true" />
	           		</div>
	           		<label class="required">Email:</label>
					<div class="input-group input-group-lg">
	              		<input class="form-control" type="text" name="femail" placeholder="" required="true" />
	           		</div>
					<label class="required">Password:</label>
					<div class="input-group input-group-lg">
	            		<input class="form-control" type="password" name="fpass" placeholder="" required="true" />
	           		</div>
         		</div>
         	</div>
         	<div id="profile" class="tab-pane fade">
         		<label>Company Name:</label>
         		<div class="input-group input-group-lg">
	            	<input class="form-control" type="text" name="fcomp" placeholder="" />
	           	</div>
	           	<label>First Name:</label>
         		<div class="input-group input-group-lg">
	           		<input class="form-control" type="text" name="ffirstname" placeholder=""  />
	           	</div>
	           	<label>Last Name:</label>
	            <div class="input-group input-group-lg">
	            	<input class="form-control" type="text" name="flastname" placeholder=""  />
	            </div>
	            <label>Phone Number:</label>
	   		   	<div class="input-group input-group-lg">
	            	<input class="form-control" type="text" name="fphone" placeholder=""  />
	       	 	</div>
           	</div>
         	<div id="address" class="tab-pane fade">
         		<label>Address 1:</label>
	        	<div class="input-group input-group-lg">
	            	<input class="form-control" type="text" name="faddress1" placeholder="" />
	           	</div>
	           	<label>Address 2:</label>
	           	<div class="input-group input-group-lg">
	            	<input class="form-control" type="text" name="faddress1" placeholder="" />
	           	</div>
	           	<label>City:</label>
	            <div class="input-group input-group-lg">
	            	<input class="form-control" type="text" name="fcity" placeholder=""  />
	           	</div>
	           	<label>Zip/Postal Code:</label>
	            <div class="input-group input-group-lg">
	            	<input class="form-control" type="text" name="fpostal" placeholder="" />
	           	</div>
	           	<label>State:</label>
	           	<div class="input-group input-group-lg">
	            	<input class="form-control" type="text" name="fstate" placeholder=""  />
	          	</div>
	          	<label>County:</label>
	          	<div class="input-group input-group-lg">
	            	<input class="form-control" type="text" name="fcounty" placeholder=""  />
	          	</div>
	          	<label>Country:</label>
	            <div class="input-group input-group-lg">
	     			<input class="form-control" type="text" name="fcountry" placeholder=""  />
	        	</div>
				<label></label>
	            <input type="hidden" name="RQ" value="ACCTM" />
	        	<input type="hidden" name="Method" value="Create" />
            </div>
        <button class="submit" name="reg_sub" value="Submit">Submit</button>
		</div>
	</form>
</div>
