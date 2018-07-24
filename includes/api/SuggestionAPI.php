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
class SuggestionAPI
{
	private $TblName = "it_sug";
    private $IndexColumn = "";
    private $Prefix = "sug";
    private $ModuleID = 8;
		private $mapi;
		public function __construct($dbCon) {
				$this->mapi = new MySQLIAPI($dbCon);
		}

	public function CreateSuggestion($sug_subject, $sug_message, $sug_parent_fk) {
		$AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
		if(isset($sug_parent_fk)) {
			$PID = mysqli_escape_string($this->con, $sug_parent_fk);
		}
		else {
			$PID = 'NULL';
		}
		$CREID = mysqli_escape_string($this->con, $_SESSION['userid']);
		$SUB = mysqli_escape_string($this->con, $sug_subject);
		$MES = mysqli_escape_string($this->con, $sug_message);

		//echo "CALL itm_CreateSuggestion(". sprintf("%d, %s, %d, '%s', '%s'", $AcctID, $PID,
        //                                           $CREID, $SUB, $MES) .")";

		$result = mysqli_query($this->con, "CALL itm_CreateSuggestion(". sprintf("%d, %s, %d, '%s', '%s'", $AcctID, $PID,
                                                    $CREID, $SUB, $MES) .")") or die(mysqli_error($this->con));


	}

	public function GetSuggestions($sug_parent_fk) { 		//needs stuff to support user accounts
		$PID = mysqli_escape_string($this->con, $sug_parent_fk);
		$Acct = mysqli_escape_string($this->con, $_SESSION['accountid']);
		$CREID = mysqli_escape_string($this->con, $_SESSION['userid']);

		$result = mysqli_query($this->con, "CALL itm_GetSuggestions(". sprintf("%d, %s, %d", $Acct, $PID,
														$CREID) .")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
		mysqli_free_result($result);
		mysqli_next_result($this->con);
        return $tableData;

	}

	public function GetSuggestionThread($sug_parent_fk) {
		$PID = mysqli_escape_string($this->con, $sug_parent_fk);
        $Acct = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $CREID = mysqli_escape_string($this->con, $_SESSION['userid']);

        $result = mysqli_query($this->con, "CALL itm_GetSuggestions(". sprintf("%d, %s, %d", $Acct, $PID,
                                                        $CREID) .")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
		mysqli_free_result($result);
		mysqli_next_result($this->con);
        return $tableData;
	}

	public function AdminGetAllSuggestions() {
		$result = mysqli_query($this->con, "CALL itm_AdminGetAllSuggestions()") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
		mysqli_free_result($result);
		mysqli_next_result($this->con);
        return $tableData;
	}

	public function AdminGetSuggestions($sug_parent_fk) {
		$ParentFK = mysqli_escape_string($this->con, $sug_parent_fk);
		$result = mysqli_query($this->con, "CALL itm_AdminGetSuggestions(".
		sprintf("'%d'", $ParentFK) .")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
		mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $tableData;
	}

}
class SuggestionFields {

	public $sug_parent_fk;
	public $sug_acc_fk;
	public $sug_creator_fk;
	public $sug_subject;
	public $sug_message;
	public $sug_date;

}
?>
