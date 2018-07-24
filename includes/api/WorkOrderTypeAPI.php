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
class WorkOrderTypeAPI {
    private $TblName = "it_workorderType";
    private $IndexColumn = "";
    private $Prefix = "wtype";
    private $ModuleID = 14;
    private $mapi;
		public function __construct($dbCon) {
				$this->mapi = new MySQLIAPI($dbCon);
		}

    public function GetInformation($wTypeID) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $wtypeFk = null;
        if($wTypeID != null) $wtypeFk = mysqli_escape_string($this->con, $wTypeID);

        $result = mysqli_query($this->con, "CALL itm_GetWOTypeDetail(". sprintf("%d, %d", $AcctID, $wtypeFk) .")") or die(mysqli_error($this->con));
        $data = mysqli_fetch_object($result, "WorkOrderTypeInformation");
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $data;
    }

    public function CreateWOType($parentFk, $wtName, $wtCode) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $ParentID = null;
        if($parentFk == null)
            $ParentID = mysqli_escape_string($this->con, $parentFk);
        $wTypeName = mysqli_escape_string( $this->con, $wtName);
        $wTypeCode = mysqli_escape_string( $this->con, $wtCode);

        $ParentID = empty($ParentID) ? "NULL" : $ParentID;
        $wTypeName = empty($wTypeName) ? "NULL" : "'" . $wTypeName . "'";
        $wTypeCode = empty($wTypeCode) ? "NULL" : "'" . $wTypeCode . "'";

        $result = mysqli_query($this->con, "CALL itm_CreateWOType(". sprintf("%d, %d, %s, %s",
                                            $AcctID, $ParentID, $wTypeName, $wTypeCode) .")") or die(mysqli_error($this->con));
        $data = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        if(isset($data))
        {
            $_SESSION['SuccessSubmission'] = 1;
        }
        else {
            $_SESSION['SuccessSubmission'] = -1;
        }
        return $data;
    }

    public function SearchACS($search) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $pSearch = null;
        if(!empty($search))
            $pSearch = "'" . mysqli_escape_string($this->con, $search) . "'";
        else
            $pSearch = "NULL";

        $result = mysqli_query($this->con, "CALL itm_GetWOTypeListACS(".sprintf("%d, %s", $AcctID, $pSearch).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $tableData;
    }
    /*`itm_GetUsersList`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT, IN OrgSearch boolean)*/
    public function Search($ParentID) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $parentFk = null;
        if($ParentID != null)
            $parentFk = mysqli_escape_string( $this->con, $ParentID);
        $parentFk = empty($parentFk) ? "NULL" : $parentFk;

        $result = mysqli_query($this->con, "CALL itm_GetWOTypeList(".sprintf("%d, %d", $AcctID, $parentFk).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $tableData;
    }

    //not positive about this.
    public function QuickEditStart($FieldName) {
        $_SESSION["CurrentFieldID"] = UserInformation::GetFieldID($FieldName);
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
        $fieldKey = UserInformation::GetFieldKey($_SESSION["CurrentFieldID"]);
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
class WorkOrderTypeInformation {
    public $wtype_pk;
    public $wtype_acct_fk;
    public $wtype_parent_fk;

    public $wtype_code;
    public $wtype_name;

    public static function IsString($FieldID) {
        switch($FieldID) {
            case 0:
            case 1:
            case 2:
                return false;
            case 3:
            case 4:
                return true;
            default:
                return true;
        }
    }

    public static function GetFieldID($FieldKey) {
        switch($FieldKey) {
            case "wtype_pk":
                return 0;
            case "wtype_acct_fk":
                return 1;
            case "wtype_parent_fk":
                return 2;
            case "wtype_code":
                return 3;
            case "wtype_name":
                return 4;
            default:
                return -2;
        }
    }

    //Used regex to make below so there was no re-type.
    //http://regexr.com/3bres
    public static function GetFieldKey($FieldID) {
        switch($FieldID) {
            case 0:
                return "wtype_pk";
            case 1:
                return "wtype_acct_fk";
            case 2:
                return "wtype_parent_fk";
            case 3:
                return "wtype_code";
            case 4:
                return "wtype_name";
            default:
                return -2;
        }
    }
}

?>
