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
	$getSuggestion = new SuggestionAPI($dbCon);
	//$SugList = $getSuggestion->AdminGetAllSuggestions();
	$sub_alert = " ";
	$sub_alert_js = " ";
	
	if ($_SESSION["SuccessSubmission"] > 0)
	{
		$sub_alert_js = "$('.submission_error').show(); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);";
		$sub_alert = "Message has been successfully sent";
	}
	else if ($_SESSION["SuccessSubmission"] < 0)
	{
		$sub_alert_js = "$('.submission_error').show(); $('.submission_error').css('background-color', '').css('background-color', '#F58476'); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);";
		$sub_alert = "There was a problem with your submission. Please try again.";
	}
?>

<div class="submission_error">
	<?php
		echo $sub_alert;
	?>
</div>

<script type="text/javascript">

	$(document).ready(function(){
		$("tbody > tr").hover(function(){
			$(this).css("background","white");
		},function(){
    	$(this).css("background","");
  		});
	  
		$("tbody > tr").click(function() {
			//var rowID = $(this).attr("id");
		
			$(".table-responsive").slideUp();
			$(".suggestion_single").slideDown();
			
		  		$("#suggestion_thread > tbody").html(" ");
		  		$('#suggestion_subject > p').html(" ");
		  		$('#suggestion_companyname > p').html(" ");
				parentFK = $(this).attr("id");
				subject = $(this).attr("class");
				var request = "SUM";
				var method = "AdminViewThread";
				$.post("/includes/itasm.networking.php",  { 
					"sug_parent_fk" : parentFK, 
					"RQ" : request, 
					"Method" : method 
					})
					.done( function(data) {
							//alert(data);
							var sug = JSON.parse(data);	
							//subject = sug[0].usr_username;
							$('#suggestion_subject > p').append(sug[0].sug_subject);
							$('#suggestion_companyname > p').append(sug[0].acct_companyname);
							for(i = 0, n = sug.length; i < n; i++) {
								
								$('#suggestion_thread > tbody').append(
									'<tr id="' + sug[i].sug_pk + 
									'"><td>' + sug[i].usr_username + '</td><td>' 
									+ sug[i].sug_message + '</td><td>'
									+ sug[i].sug_date + '</td></tr>');
							}
					})	
			
			
	  	});
	  	$("#close").click(function() {
	  		$(".suggestion_single").slideUp();
	  		$(".table-responsive").slideDown();
	  	});
	  	
	  	$("#submit").click(function() {
		var request = "SUM";
		var method = "Reply";
	  	//var parentFK = $("#suggestion_thread > tbody > row").attr("id");
	  	var reply = $("textarea").val();
		
	  	if (reply.length > 10){
			$.post("/includes/itasm.networking.php", { "sug_subject" : subject, "sug_message" : reply, "sug_parent_fk" : parentFK, "RQ" : request, "Method" : method })
				.done( function(data) {
					window.location.href = "/SuggestionBox/Admin/";
       			})
		} 
		else {
			alert("Please enter a reply length of 10 characters or more.");
      		return;
     	}

	 });
	});
</script> 
<div><h2>Suggestion Admin</h2></div>

<div class="suggestion_single" style="display:none">
	<div id="suggestion_subject">Subject: <p> </p></div>
	<div id="suggestion_companyname">Company Name: <p> </p></div>
		
		<table class="table" id="suggestion_thread">
			<thead>
				<tr>
					<th>User</th>
					<th>Message</th>
					<th>Date</th>	
				</tr>
			</thead>
				
			<tbody>
			
					
		
			</tbody>
		</table> 
		
	<div class="reply_box">
		<font>Reply:</font>
		<textarea name="sug_message" rows="8" required="true"></textarea>
		<button class="submit" id="close" value="Close" style="float: left">Close</button>
		<button class="submit" id="submit" name="sug_sub" value="Submit">Submit</button>
		
	</div>
</div>
<!--
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>Subject</th>
				<th>Message</th>
				<th>Date</th>	
			</tr>
		</thead>
		<tbody class="selectable">
		<?php
		/*
		foreach($getSuggestion->GetSuggestions('NULL') as $key => $value) {
		?>
			<tr id="<?php echo $value["sug_pk"]; ?>" class="<?php echo $value["sug_subject"]; ?>">
				<td><?php echo $value["sug_subject"];  ?></td>
				<td><?php echo $value["sug_message"]; ?></td>
				<td><?php echo $value["sug_date"]; ?></td>
			</tr>
		<?php			
		}*/
		?>
		</tbody>	
	</table>
</div>
-->

<div class="table-responsive">
	<table class="table">
		<thead>
        <tr>
            
            <th>Company Name</th>
			<th>User Name</th>
			<th>Subject</th>
        </tr>
    </thead>
    <tbody class="selectable">
        <?php

            foreach(//$SugList as $value) {
            	$getSuggestion->AdminGetAllSuggestions() as $key => $value) {
            
                ?>
                <tr id="<?php echo $value["sug_pk"]; ?>" class="<?php echo $value["sug_subject"]; ?>">
                    <td><?php echo $value["acct_companyname"]; ?></td>
					<td><?php echo $value["usr_username"]; ?></td>
					<td><?php echo $value["sug_subject"]; ?></td>
					
                </tr>
                <?php
            }
        ?>
    </tbody>
</table>

