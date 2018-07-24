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
class ContactAPI {
    //itm_GetContactInfo
    private $TblName = "it_con";
    private $IndexColumn = "";
    private $Prefix = "con";
    private $ModuleID = 10;
    private $mapi;
		public function __construct($dbCon) {
				$this->mapi = new MySQLIAPI($dbCon);
		}

    public function CreateContact($PD_con_cli_fk, $PD_con_fac_fk, $PD_con_dep_fk, $PD_con_type, $PD_con_fname,
    							$PD_con_lname, $PD_con_phone, $PD_con_email, $PD_con_notes, $PD_con_address,
                                $PD_con_postal_code, $PD_con_city, $PD_con_county, $PD_con_state, $PD_con_country) {
        $this->mapi->BeginProc();
	      $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
				$this->mapi->AddParameter("con_acct_fk", $PD_con_acct_fk, "d");
	      $this->mapi->AddParameter("con_cli_fk", $PD_con_cli_fk, "s");
				$this->mapi->AddParameter("joblCode", $PD_con_fac_fk, "s");
				$this->mapi->AddParameter("joblRateCode", $PD_con_dep_fk, "d");
				$this->mapi->AddParameter("joblDesc", $PD_con_type, "s");
        $this->mapi->AddParameter("UserID", $PD_con_fname, "d");
	      $this->mapi->AddParameter("joblName", $PD_con_lname, "s");
				$this->mapi->AddParameter("joblCode", $PD_con_phone, "s");
				$this->mapi->AddParameter("joblRateCode", $PD_con_email, "d");
				$this->mapi->AddParameter("joblDesc", $PD_con_notes, "s");
        $this->mapi->AddParameter("UserID", $PD_con_address, "d");
	      $this->mapi->AddParameter("joblName", $PD_con_postal_code, "s");
				$this->mapi->AddParameter("joblCode", $PD_con_city, "s");
				$this->mapi->AddParameter("joblRateCode", $PD_con_county, "d");
				$this->mapi->AddParameter("joblDesc", $PD_con_state, "s");
        $this->mapi->AddParameter("joblDesc", $PD_con_country, "s");
	      $result = $this->mapi->CallProc("itm_CreateContact");




        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $FLcon_acct_fk = mysqli_escape_string( $this->con, $PD_con_acct_fk);
        $FLcon_cli_fk = mysqli_escape_string( $this->con, $PD_con_cli_fk);
        $FLcon_fac_fk = mysqli_escape_string( $this->con, $PD_con_fac_fk);
        $FLcon_dep_fk = mysqli_escape_string( $this->con, $PD_con_dep_fk);
        $FLcon_type = mysqli_escape_string( $this->con, $PD_con_type);
        $FLcon_fname = mysqli_escape_string( $this->con, $PD_con_fname);
        $FLcon_lname = mysqli_escape_string( $this->con, $PD_con_lname);
        $FLcon_phone = mysqli_escape_string( $this->con, $PD_con_phone);
        $FLcon_email = mysqli_escape_string( $this->con, $PD_con_email);
		$FLcon_notes = mysqli_escape_string( $this->con, $PD_con_notes);
        $FLcon_address = mysqli_escape_string( $this->con, $PD_con_address);
        $FLcon_postal_code = mysqli_escape_string( $this->con, $PD_con_postal_code);
        $FLcon_city = mysqli_escape_string( $this->con, $PD_con_city);
        $FLcon_county = mysqli_escape_string( $this->con, $PD_con_county);
        $FLcon_state = mysqli_escape_string( $this->con, $PD_con_state);
        $FLcon_country = mysqli_escape_string( $this->con, $PD_con_country);
        $result = mysqli_query($this->con,
                    "CALL itm_CreateContact(".
                        sprintf("%d, %s, %s, %s, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'",
                            $AcctID,
                            strlen($FLcon_cli_fk) < 1 ? "NULL" : $FLcon_cli_fk,
                            strlen($FLcon_fac_fk) < 1 ? "NULL" : $FLcon_fac_fk,
                            strlen($FLcon_dep_fk) < 1 ? "NULL" : $FLcon_dep_fk,
                            $FLcon_type, $FLcon_fname, $FLcon_lname, $FLcon_phone, $FLcon_email, $FLcon_notes,
                            $FLcon_address, $FLcon_postal_code, $FLcon_city,
                            $FLcon_county, $FLcon_state, $FLcon_country
                        ).")")
                    or die(mysqli_error($this->con));
        $data = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $data;
    }
    public function OrganizationSearch($cli_pk, $dep_pk, $fac_pk) {
        $this->mapi->BeginProc();
        $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
        $this->mapi->AddParameter("ClientID", $cli_pk, "d");
        $this->mapi->AddParameter("FacilityID", $dep_pk, "d");
        $this->mapi->AddParameter("DepartmentID", $fac_pk, "d");
        $data = $this->mapi->CallProc("itm_GetContactOrgs");
        return $data;
    }
    public function ContactSearch($cli_pk, $dep_pk, $fac_pk) {
        $this->mapi->BeginProc();
        $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
        $this->mapi->AddParameter("ClientID", $cli_pk, "d");
        $this->mapi->AddParameter("FacilityID", $dep_pk, "d");
        $this->mapi->AddParameter("DepartmentID", $fac_pk, "d");
        $data = $this->mapi->CallProc("itm_GetContactList");
        return $data;
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
    }
}
class ContactInformation {
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
}
?>
