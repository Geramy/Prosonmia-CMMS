<?php
///
/// JQluv.net, Inc. ("COMPANY") CONFIDENTIAL
/// Unpublished Copyright (c) 2010-2016 [COMPANY NAME], All Rights Reserved.
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
class ShipmentTrackingAPI {
    //itm_GetContactInfo
    private $TblName = "it_shiptrack";
    private $IndexColumn = "";
    private $Prefix = "stra";
    private $ModuleID = 23;
    private $mapi;
		public function __construct($dbCon) {
				$this->mapi = new MySQLIAPI($dbCon);
		}

    public function itm_CreateShipTrack($ship_fk, $startDate, $endDate, $trackNumber, $desc) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $shipDetPk = mysqli_escape_string( $this->con, $ship_fk);
        $start = mysqli_escape_string( $this->con, $startDate);
        $end = mysqli_escape_string( $this->con, $endDate);
        $track = mysqli_escape_string( $this->con, $trackNumber);
        $desc = mysqli_escape_string( $this->con, $desc);

        $result = mysqli_query($this->con,
                    "CALL itm_CreateShipTrack(".
                        sprintf("%d, %d, %s, %s, %s, %s",
                            $AcctID,
                            $shipDetPk,
                            strlen($start) < 1 ? "NULL" : "'" . $start . "'",
                            strlen($end) < 1 ? "NULL" : "'" . $end . "'",
                            strlen($track) < 1 ? "NULL" : "'" . $track . "'",
                            strlen($desc) < 1 ? "NULL" : "'" . $desc . "'"
                        ).")")
                    or die(mysqli_error($this->con));
        $data = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $data;
    }

    public function GetTrackingHistory($ship_fk) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $shipDetPk = null;
        if($ship_fk != null)
            $shipDetPk = mysqli_escape_string( $this->con, $ship_fk);

        $result = mysqli_query($this->con,
                    "CALL itm_GetTrackingHistory(".
                        sprintf("%d, %d",
                            $AcctID,
                            $shipDetPk
                        ).")")
                    or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $tableData;
    }

    /*public function OrganizationSearch($cli_pk, $dep_pk, $fac_pk) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $cliID = mysqli_escape_string( $this->con, $cli_pk);
        $facID = mysqli_escape_string( $this->con, $dep_pk);
        $depID = mysqli_escape_string( $this->con, $fac_pk);
        $result = mysqli_query($this->con, "CALL itm_GetContactOrgs(".sprintf("%d, %s, %s, %s", $AcctID, $cliID, $facID, $depID).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $tableData;
    }*/

    /*public function ContactSearch($cli_pk, $dep_pk, $fac_pk) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $cliID = mysqli_escape_string( $this->con, $cli_pk);
        $facID = mysqli_escape_string( $this->con, $dep_pk);
        $depID = mysqli_escape_string( $this->con, $fac_pk);
        $result = mysqli_query($this->con, "CALL itm_GetContactList(".sprintf("%d, %s, %s, %s", $AcctID, $cliID, $facID, $depID).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $tableData;
    }
    public function ContactSearchACS($WildSearch) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $UsrID = mysqli_escape_string($this->con, $_SESSION['userid']);
        $wsearch = mysqli_escape_string( $this->con, $WildSearch);
        $result = mysqli_query($this->con, "CALL itm_GetContactACS(".sprintf("%d, %d, '%s'", $AcctID, $UsrID, $wsearch).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $tableData;
    }
    public function GetContactInfo($ContactID) {
        $AccountID = mysqli_escape_string($this->con, $_SESSION["accountid"]);
        $UserID = mysqli_escape_string($this->con, $_SESSION["userid"]);
        $RecordID = mysqli_escape_string($this->con, $ContactID);

        $result = mysqli_query($this->con, "CALL itm_GetContactInfo(".sprintf("%d, %d, %d", $AccountID, $UserID, $RecordID).");");
        $data = mysqli_fetch_object($result, "ContactInformation");
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $data;
    }
    public function QuickEditStart($FieldName) {
        $_SESSION["CurrentFieldID"] = ContactInformation::GetFieldID($FieldName);
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
        $fieldKey = ContactInformation::GetFieldKey($_SESSION["CurrentFieldID"]);
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
    }*/
}
/*class ShippmentInformation {
    //Start here
    //http://regexr.com/3c5iv
    public $con_pk;
    public $con_acct_fk;

    public $con_cli_fk;
    public $con_fac_fk;
    public $con_dep_fk;

    public $con_type;

    public $con_fname;
    public $con_lname;
    public $con_phone;
    public $con_email;

    public $con_address;
    public $con_postal_code;
    public $con_city;
    public $con_county;
    public $con_state;
    public $con_country;

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

    //then here
    //http://regexr.com/3c5j2
    public static function GetFieldID($FieldKey) {
        switch($FieldKey) {
            case "con_pk":
                return 0;
            case "con_acct_fk":
                return 1;
            case "con_cli_fk":
                return 2;
            case "con_fac_fk":
                return 3;
            case "con_dep_fk":
                return 4;
            case "con_type":
                return 5;
            case "con_fname":
                return 6;
            case "con_lname":
                return 7;
            case "con_phone":
                return 8;
            case "con_email":
                return 9;
            case "con_address":
                return 10;
            case "con_postal_code":
                return 11;
            case "con_city":
                return 12;
            case "con_county":
                return 13;
            case "con_state":
                return 14;
            case "con_country":
                return 15;
            default:
                return -2;
        }
    }

    //and finally this
    //http://regexr.com/3c5is
    public static function GetFieldKey($FieldID) {
        switch($FieldID) {
            case 0:
                return "con_pk";
            case 1:
                return "con_acct_fk";
            case 2:
                return "con_cli_fk";
            case 3:
                return "con_fac_fk";
            case 4:
                return "con_dep_fk";
            case 5:
                return "con_type";
            case 6:
                return "con_fname";
            case 7:
                return "con_lname";
            case 8:
                return "con_phone";
            case 9:
                return "con_email";
            case 10:
                return "con_address";
            case 11:
                return "con_postal_code";
            case 12:
                return "con_city";
            case 13:
                return "con_county";
            case 14:
                return "con_state";
            case 15:
                return "con_country";
            default:
                return -2;
        }
    }
}*/
?>
