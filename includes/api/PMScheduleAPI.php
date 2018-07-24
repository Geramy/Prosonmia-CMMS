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
class PMScheduleAPI extends BaseAPI {

  private $mapi;
    public function __construct($dbCon) {
        $this->mapi = new MySQLIAPI($dbCon);
        $this->TblName = "it_pm_sechdule";
        $this->IndexColumn = "";
        $this->Prefix = "pms";
        $this->ModuleID = 9;
    }

    //This one is pretty important but we dont need it yet....
    public function GetItemDetails($ItemID)
    {

    }

    /*
    IN AccountID INT, IN UserID INT, IN ItemType INT, IN ItemID INT,
    IN IntervalType INT, IN IntervalID INT,
    IN daysPriorCreation INT, IN startDate DATETIME, IN nextPmDate DATETIME,
    IN wo_wtype_fk INT, IN wo_woss_fk INT, IN wo_rateCode_fk INT,
    IN wo_creator_fk INT, IN wo_assigned_fk INT, IN wo_requestor_fk INT
         */
    //We need this one...
    public function CreateRecord($pms_item_type, $pms_item_fk, $pms_interval_type, $pms_interval, $pms_daysPriorCreate, $pms_startDate,
                                    $pms_wo_wtype, $pms_wo_woss_fk, $pms_rateCode_fk, $pms_wo_creator_fk, $pms_wo_assigned_fk, $pms_wo_requestor_fk, $wo_jobl_fk)
    {
        $AcctID = mysqli_escape_string($this->con, $_SESSION["accountid"]);
        $UserID = mysqli_escape_string($this->con, $_SESSION["userid"]);
        $ItemType = mysqli_escape_string($this->con, $pms_item_type);
        $ItemID = mysqli_escape_string($this->con, $pms_item_fk);
        $IntervalType = mysqli_escape_string($this->con, $pms_interval_type);
        $IntervalID = mysqli_escape_string($this->con, $pms_interval);
        $daysPrior = mysqli_escape_string($this->con, $pms_daysPriorCreate);
        $startDate = mysqli_escape_string($this->con, $pms_startDate);//yyyy/mm/dd hh:mm:ss
        $Wtype_fk = mysqli_escape_string($this->con, $pms_wo_wtype);
        $WossID = mysqli_escape_string($this->con, $pms_wo_woss_fk);
        $WoRateCodeFk = mysqli_escape_string($this->con, $pms_rateCode_fk);
        $WoCreatorFk = mysqli_escape_string($this->con, $pms_wo_creator_fk);
        $WoAssignedFk = mysqli_escape_string($this->con, $pms_wo_assigned_fk);
        $WoRequestorFk = mysqli_escape_string($this->con, $pms_wo_requestor_fk);
        $WoTaskId = mysqli_escape_string($this->con, $wo_jobl_fk);
        $ItemID = mysqli_escape_string($this->con, $pms_item_fk);
        $ItemTypeID = mysqli_escape_string($this->con, $pms_item_type);

        if(sizeof($startDate) < 1)
            $startDate = null;
        $result = mysqli_query($this->con, "CALL itm_CreatePMSchedule(".sprintf(
                        "%d, %d, %d, %d, %d, %d, %d, %s, %d, %d, %d, %d, %d, %d, %d",
                        $AcctID, $UserID, $ItemType, $ItemID, $IntervalType, $IntervalID, $daysPrior, $startDate == null ? "NULL" : "'" . $startDate . "'", $Wtype_fk,
                        $WossID, $WoRateCodeFk, $WoCreatorFk, $WoAssignedFk, $WoRequestorFk, $WoTaskId).")") or die(mysqli_error($this->con));
        $row = mysqli_fetch_row($result);
        mysqli_fetch_all($result);
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        if(isset($row) && $row[0] >= 0)
        {
            $_SESSION['SuccessSubmission'] = 1;
        }
        else {
            $_SESSION['SuccessSubmission'] = -1;
        }
        return $row[0];
    }

    public function ItemIDSearch($AttachedItemID, $ItemType)//see mysql comments on pms_item_type.
    {
        $AcctID = mysqli_escape_string($this->con, $_SESSION["accountid"]);
        $UserID = mysqli_escape_string($this->con, $_SESSION["userid"]);
        $ItemID = mysqli_escape_string($this->con, $AttachedItemID);
        $ItemTypeID = mysqli_escape_string($this->con, $ItemType);
        $result = mysqli_query($this->con, "CALL itm_GetPMScheduleByItemID(".sprintf("%d, %d, %d, %d", $AcctID, $UserID, $ItemID, $ItemTypeID).")") or die(mysqli_error($this->con));
        $rDataArray = null;
        while($row = mysqli_fetch_assoc($result)) $rDataArray[] = $row;
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $rDataArray;
    }

    //We dont really need this one either yet....
    public function ResultSearch($dataArray) {

    }

    //Not working yet we dont really need a search....
    public function OrgSearch($dataArray) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $UserID = mysqli_escape_string($this->con, $_SESSION['userid']);
        $cliID = mysqli_escape_string( $this->con, $cli_pk);
        $facID = mysqli_escape_string( $this->con, $dep_pk);
        $depID = mysqli_escape_string( $this->con, $fac_pk);
        $result = mysqli_query($this->con, "CALL itm_PMScheduleOrgSearch(".sprintf("%d, %s, %s, %s, %s", $AcctID, $UserID, $cliID, $facID, $depID).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $tableData;
    }

    public function AutoCompleteSearch($dataArray) {

    }

    public function QuickEditStart($FieldName) {
        $_SESSION["CurrentFieldID"] = PMScheduleInformation::GetFieldID($FieldName);
        $_SESSION["ParentFk"] = NULL;
    }
    public function QuickEdit($id, $Value) {
        //`itm_StartEditHistory`(IN AccountID INT, IN UserID INT, IN ModuleID INT, IN FieldID INT, IN ValueData VARCHAR(760))
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $user_fk = mysqli_escape_string($this->con, $_SESSION['userid']);
        $escaped_data = mysqli_escape_string($this->con, $NewVal);
        $fieldid = mysqli_escape_string($this->con, $_SESSION["CurrentFieldID"]);
        $parentfk = mysqli_escape_string($this->con, $_SESSION["ParentFk"]);

        $result = mysqli_query($this->con, "CALL itm_StartEditHistory(".
                    sprintf("%d, %d, %d, %d, '%s', %d", $AcctID, $user_fk, $this->ModuleID, $fieldid, $escaped_data, $parentfk) .")")
                        or die(mysqli_error($this->con));
        $data =  mysqli_fetch_row($result);
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $data;
    }
    public function QuickEditStop($Id, $Value) {
        //`itm_StopEditHistory`(IN ParentPk INT, IN AccountID INT, IN UserID INT, IN RecordPk INT, IN ModuleID INT, IN FieldID INT,
        //IN TableName VARCHAR(78), IN FieldPrefix VARCHAR(10), IN FieldKey VARCHAR(45), IN ValueData VARCHAR(760), IN Svalue BIT)
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $user_fk = mysqli_escape_string($this->con, $_SESSION['userid']);
        $escaped_data = mysqli_escape_string($this->con, $Value);
        $fieldid = mysqli_escape_string($this->con, $_SESSION["CurrentFieldID"]);
        $parentfk = mysqli_escape_string($this->con, $_SESSION["ParentFk"]);
        $recordPk = mysqli_escape_string($this->con, $Id);
        $fieldKey = PMScheduleInformation::GetFieldKey($_SESSION["CurrentFieldID"]);
        $PrefixLen = strlen($this->Prefix);
        $FieldLen = strlen($fieldKey);
        $key = substr($fieldKey, $PrefixLen + 1, $FieldLen - ($PrefixLen + 1));
        $result = mysqli_query($this->con, "CALL itm_StopEditHistory(".
                    sprintf("%s, %d, %d, %d, %d, %d, '%s', '%s', '%s', '%s', %d", "NULL", $AcctID, $user_fk, $recordPk, $this->ModuleID, $fieldid,
                            $this->TblName, $this->Prefix, $key, $escaped_data, "1") .")")
                        or die(mysqli_error($this->con));
        $_SESSION["ParentFk"] = NULL;
        $_SESSION["CurrentFieldID"] = NULL;
        $data =  mysqli_fetch_row($result);
        mysqli_free_result($result);
		mysqli_next_result($this->con);
        return $data;
    }
}
class PMScheduleInformation {
    public $pms_pk;
    public $pms_acct_fk;
    public $pms_item_fk;
    public $pms_item_type;
    public $pms_interval_type;
    public $pms_interval;
    public $pms_daysPriorCreate;
    public $pms_startDate;
    public $pms_nextDate;
    public $pms_wo_wtype_fk;
    public $pms_wo_woss_fk;
    public $pms_wo_rateCode_fk;
    public $pms_wo_creator_fk;
    public $pms_wo_assigned_fk;
    public $pms_wo_requestor_fk;

    public static function IsString($FieldID) {
        switch($FieldID) {
            case 0:
            case 1:
            case 2:
            case 3:
            case 4:
            case 19:
                return false;
            default:
                return true;
        }
    }

    public static function GetFieldID($FieldKey) {
        switch($FieldKey) {
            case "pms_pk":
                return 0;
            case "pms_acct_fk":
                return 1;
            case "pms_item_fk":
                return 2;
            case "pms_item_type":
                return 3;
            case "pms_interval_type":
                return 4;
            case "pms_interval":
                return 5;
            case "pms_daysPriorCreate":
                return 6;
            case "pms_startDate":
                return 7;
            case "pms_nextDate":
                return 8;
            case "pms_wo_wtype_fk":
                return 9;
            case "pms_wo_woss_fk":
                return 10;
            case "pms_wo_rateCode_fk":
                return 11;
            case "pms_wo_creator_fk":
                return 12;
            case "pms_wo_assigned_fk":
                return 13;
            case "pms_wo_requestor_fk":
                return 14;
            default:
                return -2;
        }
    }

    //Used regex to make below so there was no re-type.
    //http://regexr.com/3bres
    public static function GetFieldKey($FieldID) {
        switch($FieldID) {
            case 0:
                return "pms_pk";
            case 1:
                return "pms_acct_fk";
            case 2:
                return "pms_item_fk";
            case 3:
                return "pms_item_type";
            case 4:
                return "pms_interval_type";
            case 5:
                return "pms_interval";
            case 6:
                return "pms_daysPriorCreate";
            case 7:
                return "pms_startDate";
            case 8:
                return "pms_nextDate";
            case 9:
                return "pms_wo_wtype_fk";
            case 10:
                return "pms_wo_woss_fk";
            case 11:
                return "pms_wo_rateCode_fk";
            case 12:
                return "pms_wo_creator_fk";
            case 13:
                return "pms_wo_assigned_fk";
            case 14:
                return "pms_wo_requestor_fk";
            default:
                return -2;
        }
    }
}

?>
