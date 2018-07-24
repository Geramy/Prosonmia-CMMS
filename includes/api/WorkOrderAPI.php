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
class WorkOrderAPI
{
	private $TblName = "it_workorder";
    private $IndexColumn = "";
    private $Prefix = "wo";
    private $ModuleID = 4;
		private $mapi;
		public function __construct($dbCon) {
				$this->mapi = new MySQLIAPI($dbCon);
		}
    //($_POST["cli_pk"], $_POST["fac_name"], $_POST["fac_address1"], $_POST["fac_phone"], $_POST["fac_contact_name"], $_POST["fac_email"] )
    public function OrganizationSearch($cli_pk, $dep_pk, $fac_pk) {
				$this->mapi->BeginProc();
	      $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
	      $this->mapi->AddParameter("ClientID", $cli_pk, "d");
				$this->mapi->AddParameter("FacilityID", $dep_pk, "d");
				$this->mapi->AddParameter("DepartmentID", $fac_pk, "d");
	      $data = $this->mapi->CallProc("itm_WorkOrderSearch");
	      return $data;
    }

    public function GetWorkOrderStatus($wildSearch) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $sData = "NULL";
        if($wildSearch != null)
            $sData = mysqli_escape_string($this->con, $wildSearch);
        $result = mysqli_query($this->con, "CALL itm_GetWOStatusAC(".sprintf("%d, ".($wildSearch == null ? "%s" : "'%s'"), $AcctID, $sData).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $tableData;
    }

    public function CreateWorkOrderStatus($StatusCode) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $sData = mysqli_escape_string($this->con, $StatusCode);
        $result = mysqli_query($this->con, "CALL itm_CreateWOStatus(".sprintf("%d, '%s'", $AcctID, $sData).")") or die(mysqli_error($this->con));
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return array("completed" => $row["wossID"]);
    }

    public function CreateWorkOrder($cli_pk, $dep_pk, $fac_pk, $wo_number, $asset_number, $requestor_name,
                                    $requestor_phone, $start_date, $completion_date, $wo_type, $wo_status,
                                    $requestor_email, $requestor_date,  $end_date, $request_issue)
    {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $cliID = mysqli_escape_string($this->con, $cli_pk);
        $facID = mysqli_escape_string($this->con, $fac_pk);
        $depID = mysqli_escape_string($this->con, $dep_pk);
        $woID = mysqli_escape_string($this->con, $wo_number);
        $woType = mysqli_escape_string($this->con, $wo_type);
        $assNum = mysqli_escape_string($this->con, $asset_number);
        $woStat = mysqli_escape_string($this->con, $wo_status);
        $reqName = mysqli_escape_string($this->con, $requestor_name);
        $reqEmail = mysqli_escape_string($this->con, $requestor_email);
        $reqPhone = mysqli_escape_string($this->con, $requestor_phone);
        $reqDate = mysqli_escape_string($this->con, $requestor_date);
        $startDate = mysqli_escape_string($this->con, $start_date);
        $endDate= mysqli_escape_string($this->con, $end_date);
        $completionDate = mysqli_escape_string($this->con, $completion_date);
        $RI = mysqli_escape_string($this->con, $request_issue);

        $creatorID = 0; //temporary for a test
        $contactID = 0; //temporary for a test

        $charge = NULL;
        $Notify = NULL;

        $result = mysqli_query($this->con, "CALL itm_CreateWorkOrder(".sprintf("%d, %d, %d, %d, %d, %d, %d, %d, %d, %d, '%s', '%s', '%s', '%s', %d,'%s','%s'",
                                                                                $AcctID,$cliID,$facID,$depID,$woStat,$woID,$assNum,$charge,$Notify,$woType,
                                                                                $reqDate,$startDate,$endDate,$RI,$contactID,$completionDate,$creatorID).")") or die(mysqli_error($this->con));
        //needs more code to call WOtask api
        echo(var_dump($result));
    }
}
?>
