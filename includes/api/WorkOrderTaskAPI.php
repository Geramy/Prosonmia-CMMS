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
class WordOrderTaskAPI {
  private $TblName = "it_workoderTask";
    private $IndexColumn = "";
    private $Prefix = "wotask";
    #private $ModuleID = 4;
    private $mapi;
		public function __construct($dbCon) {
				$this->mapi = new MySQLIAPI($dbCon);
		}

    public function CreateWorkOrderTask($wo_fk,$job_type, $start_date, $rate_code, $issue_code, $failed, $not_located, $completed) {
      $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
      $wOFK = mysqli_escape_string($this->con, $wo_fk);
      $JT = mysqli_escape_string($this->con, $job_type);
      $SD = mysqli_escape_string($this->con, $start_date);
      $RC = mysqli_escape_string($this->con, $rate_code);
      $IC = mysqli_escape_string($this->con, $issue_code);
      $F = mysqli_escape_string($this->con, $failed);
      $NL = mysqli_escape_string($this->con, $not_located);
      $CO = mysqli_escape_string($this->con, $completed);

      $result = mysql_query($this->con, "CALL itm_CreateWOTask(".sprintf().")") or die(mysqli_error($this->con));



    }
}

?>
