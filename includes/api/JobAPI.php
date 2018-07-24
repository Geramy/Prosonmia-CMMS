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
class JobAPI
{
	private $TblName = "it_jobLibrary";
    private $IndexColumn = "";
    private $Prefix = "jobl";
    private $ModuleID = 11;
		private $mapi;
		public function __construct($dbCon) {
				$this->mapi = new MySQLIAPI($dbCon);
		}
    //($_POST["cli_pk"], $_POST["fac_name"], $_POST["fac_address1"], $_POST["fac_phone"], $_POST["fac_contact_name"], $_POST["fac_email"] )

    public function JobListSearch($searchable) {
				$this->mapi->BeginProc();
				$this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
				$this->mapi->AddParameter("search", $searchable, "s");
				$tableData = $this->mapi->CallProc("itm_GetJobLibraryList");
        return $tableData;
    }

    public function GetJobList() {
				$this->mapi->BeginProc();
	      $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
				$this->mapi->AddParameter("search", NULL, "s");
	      $tableData = $this->mapi->CallProc("itm_GetJobLibraryList");
        return $tableData;
    }

    public function CreateJob($jobl_name, $jobl_code, $jobl_ratecode_fk, $jobl_description)
		{
				$this->mapi->BeginProc();
	      $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
				$this->mapi->AddParameter("UserID", $_SESSION['userid'], "d");
	      $this->mapi->AddParameter("joblName", $jobl_name, "s");
				$this->mapi->AddParameter("joblCode", $jobl_code, "s");
				$this->mapi->AddParameter("joblRateCode", $jobl_ratecode_fk, "d");
				$this->mapi->AddParameter("joblDesc", $jobl_description, "s");
	      $row = $this->mapi->CallProc("itm_CreateJob");
        if(isset($row) && $row[0] >= 0)
				{
					$_SESSION['SuccessSubmission'] = 1;
				}
				else {
					$_SESSION['SuccessSubmission'] = -1;
				}
        return $row[0];
    }
    public function CreateJobItem($JobID, $OrderNumber, $RequirePass, $EnableNotes, $RequireNotes, $ItemName) {
				$this->mapi->BeginProc();
	      $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
				$this->mapi->AddParameter("UserID", $_SESSION['userid'], "d");
	      $this->mapi->AddParameter("JobID", $JobID, "d");
				$this->mapi->AddParameter("JobOrder", $OrderNumber, "d");
				$this->mapi->AddParameter("PassRequired", $RequirePass, "b");
				$this->mapi->AddParameter("EnableNotes", $EnableNotes, "b");
				$this->mapi->AddParameter("NotesRequired", $RequireNotes, "b");
				$this->mapi->AddParameter("ItemName", $ItemName, "s");
	      $row = $this->mapi->CallProc("itm_CreateJobItem");
				echo $row;
        return $row[0];
    }

	public function JobInfo($JobLPK) {
				$this->mapi->BeginProc();
	      $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
				$this->mapi->AddParameter("JobLPK", $JobLPK, "d");
	      $tableData = $this->mapi->FetchObjects("itm_GetJobLibraryInfo", "JobLibraryFields");
        return $tableData[0];
	}

	public function JobInfoList($JobLPK) {
				$this->mapi->BeginProc();
	      $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
				$this->mapi->AddParameter("JobLPK", $JobLPK, "d");
	      $tableData = $this->mapi->FetchObjects("itm_GetJobLibraryInfoList", "JobLibraryFields");
        return $tableData;
	}

}

class JobLibraryFields {
  public $jobl_pk;
  public $jobl_name;
  public $jobl_acct_fk;
	public $jobl_code;
	public $jobl_ratecode_fk;
	public $jobl_description;

	public $jobli_pk;
	public $jobli_order;
	public $jobli_name;
	public $jobli_pass_required;
	public $jobli_notes;
	public $jobli_acct_fk;
}
?>
