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
class VendorAPI
{
	private $TblName = "it_ven";
    private $IndexColumn = "";
    private $Prefix = "ven";
    private $ModuleID = 6;
		private $mapi;
		public function __construct($dbCon) {
				$this->mapi = new MySQLIAPI($dbCon);
		}
    //($_POST["cli_pk"], $_POST["fac_name"], $_POST["fac_address1"], $_POST["fac_phone"], $_POST["fac_contact_name"], $_POST["fac_email"] )

    public function OrganizationSearch($cli_pk, $fac_pk, $dep_pk) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $cliID = mysqli_escape_string( $this->con, $cli_pk);
        $facID = mysqli_escape_string( $this->con, $fac_pk);
        $depID = mysqli_escape_string( $this->con, $dep_pk);
		$org = 1;
        $result = mysqli_query($this->con, "CALL itm_GetVendorList(".sprintf("%d, %s, %s, %s, %s", $AcctID, $cliID, $facID, $depID, $org).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
		mysqli_free_result($result);
		mysqli_next_result($this->con);
        return $tableData;
    }

    public function GetVendorList($cli_pk, $fac_pk, $dep_pk) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $CliID = mysqli_escape_string( $this->con, $cli_pk);
        $FacID = mysqli_escape_string( $this->con, $fac_pk);
        $DepID = mysqli_escape_string( $this->con, $dep_pk);
		if(empty($CliID)) {
            $CliID = "NULL";
            $FacID = "NULL";
            $DepID = "NULL";
        } else if(empty($FacID)) {
            $FacID = "NULL";
            $DepID = "NULL";
        } else if(empty($DepID)) {
            $DepID = "NULL";
        }
		$org = 0;
        $result = mysqli_query($this->con, "CALL itm_GetVendorList(".sprintf("%d, %s, %s, %s, %s", $AcctID, $CliID, $FacID, $DepID, $org).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
		mysqli_free_result($result);
		mysqli_next_result($this->con);
        return $tableData;
    }

	public function GetVendorInformation($VendorPK) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $venfk = mysqli_escape_string($this->con, $VendorPK);

        $result = mysqli_query($this->con, "CALL itm_GetVenInfo(". sprintf("%d, %d", $AcctID, $venfk) .")") or die(mysqli_error($this->con));
        $data =  mysqli_fetch_object($result, "VendorFields");
        mysqli_free_result($result);
		mysqli_next_result($this->con);
        return $data;
    }

    public function CreateVendor($cli_pk, $fac_pk, $dep_pk, $ven_name, $ven_code) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $CliPk = mysqli_escape_string($this->con, $cli_pk);
        $FacPk = mysqli_escape_string($this->con, $fac_pk);
        $DepPk = mysqli_escape_string($this->con, $dep_pk);

        if(empty($CliPk)) {
            $CliPk = "NULL";
            $FacPk = "NULL";
            $DepPk = "NULL";
        } else if(empty($FacPk)) {
            $FacPk = "NULL";
            $DepPk = "NULL";
        } else if(empty($DepPk)) {
            $DepPk = "NULL";
        }

        $VenName = mysqli_escape_string($this->con, $ven_name);
        $VenCode = mysqli_escape_string($this->con, $ven_code);

        $result = mysqli_query($this->con, "CALL itm_CreateVendor(".sprintf("%d, %s, %s, %s, '%s', '%s'", $AcctID, $CliPk, $FacPk, $DepPk, $VenName, $VenCode).")") or die(mysqli_error($this->con));

        $row = mysqli_fetch_row($result);
		mysqli_free_result($result);
		mysqli_next_result($this->con);
        if(!is_null($row[0]))
		{
			$_SESSION['SuccessSubmission'] = 1;
		}
		else {
			$_SESSION['SuccessSubmission'] = -1;
		}

        return $row[0];
    }//while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;

    //not positive about this.
    public function QuickEditStart($FieldName) {
        $_SESSION["CurrentFieldID"] = VendorFields::GetFieldID($FieldName);
        $_SESSION["ParentFk"] = NULL;
    }

    public function QuickEdit($id, $Value) {
        //`itm_StartEditHistory`(IN AccountID INT,  IN UserID INT, IN ModuleID INT, IN FieldID INT, IN ValueData VARCHAR(760))
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
}//(?:.*?)(?:name\=\")(.*?)(?:\")(?:.*)

class VendorFields {
	public $ven_cli_fk;
    public $cli_code;
    public $cli_name;

    public $ven_fac_fk;
    public $fac_code;
    public $fac_name;

    public $ven_dep_fk;
    public $dep_code;
    public $dep_name;
    public $dep_desc;

	public $ven_con_fk;
	public $con_fname;
	public $con_lname;
	public $con_type;

	public $ven_name;
    public $ven_code;
    public $ven_company;

	public static function IsString($FieldID) {
        switch($FieldID) {
            case 0:
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
                return false;
            default:
                return true;
        }
    }

    public static function GetFieldID($FieldKey) {
        switch($FieldKey) {
            case "ven_pk":
                return 0;
            case "ven_acct_fk":
                return 1;
            case "ven_cli_fk":
                return 2;
            case "ven_fac_fk":
                return 3;
            case "ven_dep_fk":
                return 4;
            case "ven_con_fk":
                return 5;
            case "ven_name":
                return 6;
            case "ven_code":
                return 7;
            default:
                return -2;
        }
    }

    //Used regex to make below so there was no re-type.
    //http://regexr.com/3bres
    public static function GetFieldKey($FieldID) {
        switch($FieldID) {
            case 0:
                return "ven_pk";
            case 1:
                return "ven_acct_fk";
            case 2:
                return "ven_cli_fk";
            case 3:
                return "ven_fac_fk";
            case 4:
                return "ven_dep_fk";
            case 5:
                return "ven_con_fk";
            case 6:
                return "ven_name";
            case 7:
                return "ven_code";
            default:
                return -2;
        }
    }
}

?>
