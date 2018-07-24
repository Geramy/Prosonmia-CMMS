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
?>

<script type="text/javascript">
	$(document).ready(function(){
	  $("tbody > tr").hover(function(){
	    $(this).css("background","white");
	  },function(){
	    $(this).css("background","");
	  });
	  
	  $("tbody > tr").click(function() {
	  		//var rowID = $(this).attr("id");
	  	
	  		$(".suggestion_single").slideDown();
	  		
	  		
		  		$("#suggestion_thread > tbody").html(" ");
		  		$('#suggestion_subject > p').html(" ");
		  		
				parentFK = $(this).attr("id");
				subject = $(this).attr("class");
				//alert(parentFK);
				var request = "SUM";
				var method = "ViewThread";
				$.post("/includes/itasm.networking.php",  { "sug_pk" : parentFK, "RQ" : request, "Method" : method })
					.done( function(data) {
							//alert(data);
							var sug = JSON.parse(data);	
							//subject = sug[0].sug_subject;
							$('#suggestion_subject > p').append(sug[0].sug_subject);
							for(i = 0, n = sug.length; i < n; i++) {
								
								$('#suggestion_thread > tbody').append('<tr id="' + sug[i].sug_parent_fk + '"><td>' 
								+ sug[i].usr_username + '</td><td>' 
								+ sug[i].sug_message 
									+ '</td><td>' + sug[i].sug_date + '</td></tr>');
							}
					})	
			
			
	  });
  	$("#close").click(function() {
  		$(".suggestion_single").slideUp();
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


<h2>My Suggestions</h2> 

<div class="suggestion_single" style="display:none">
	<div id="suggestion_subject">Subject: <p> </p></div>
		<table class="table" id="suggestion_thread">
			<thead>
				<tr>
					<th>Sender</th>
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
		<button class="submit" id="submit" name="sug_sub" value="Submit" >Submit</button>
		
	</div>
</div>

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
			
			foreach($getSuggestion->GetSuggestions('NULL') as $key => $value) {
?>
				<tr id="<?php echo $value["sug_pk"]; ?>" class="<?php echo $value["sug_subject"]; ?>">
					<td><?php echo $value["sug_subject"];  ?></td>
					<td><?php echo $value["sug_message"]; ?></td>
					<td><?php echo $value["sug_date"]; ?></td>
				</tr>
<?php			
			}
?>
				
			</tbody>	
		</table>
	</div>

