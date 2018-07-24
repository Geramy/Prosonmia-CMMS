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
class UserAPI {
    private $TblName = "it_usr";
    private $IndexColumn = "";
    private $Prefix = "usr";
    private $ModuleID = 5;
    private $mapi;
		public function __construct($dbCon) {
				$this->mapi = new MySQLIAPI($dbCon);
		}

    public function GetDetailInformation($UserPk) {
      $this->mapi->BeginProc();
      $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
      $this->mapi->AddParameter("UserPk", $UserPk, "d");
      $data = $this->mapi->FetchObjects("itm_GetUserInfo", "UserInformation");
      return $data[0];
    }

    public function GetMyInformation() {
        $this->mapi->BeginProc();
        $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
        $this->mapi->AddParameter("UserPk", $_SESSION["userid"], "d");
        $data = $this->mapi->FetchObjects("itm_GetUserInfo", "UserInformation");
        if(count($data) > 0)
          return $data[0];
        return null;
    }

    public function CreateUser($_cli_pk, $_fac_pk, $_dep_pk, $_usr_username, $_usr_email, $_usr_fname, $_usr_lname,
                                $_usr_password, $_usr_title, $_usr_hiredate, $_usr_manager, $_usr_address1, $_usr_address2, $_usr_city,
                                $_usr_state, $_usr_postal_code, $_usr_country, $_usr_portal_access) {
        $this->mapi->BeginProc();
	      $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
        $this->mapi->AddParameter("ClientID", $_cli_pk, "d");
        $this->mapi->AddParameter("FacilityID", $_fac_pk, "d");
        $this->mapi->AddParameter("DepartmentID", $_dep_pk, "d");
        $this->mapi->AddParameter("username", $_usr_username, "s");
        $this->mapi->AddParameter("email_address", $_usr_email, "s");
        $this->mapi->AddParameter("Pwd", $_usr_password, "s");
        $this->mapi->AddParameter("title", $_usr_title, "s");
        $this->mapi->AddParameter("firstname", $_usr_fname, "s");
        $this->mapi->AddParameter("lastname", $_usr_lname, "s");
        $this->mapi->AddParameter("manager", $_usr_manager, "s");
        $this->mapi->AddParameter("hire_date", $_usr_hiredate, "d");
        $this->mapi->AddParameter("address1", $_usr_address1, "s");
        $this->mapi->AddParameter("address2", $_usr_address2, "s");
        $this->mapi->AddParameter("city", $_usr_city, "s");
        $this->mapi->AddParameter("state", $_usr_state, "s");
        $this->mapi->AddParameter("county", null, "s");
        $this->mapi->AddParameter("country", $_usr_country, "s");
        $this->mapi->AddParameter("post_code", $_usr_postal_code, "s");
        $this->mapi->AddParameter("Credits", 0, "d");
        $this->mapi->AddParameter("PortalLogin", $_usr_portal_access, "d");
        $this->mapi->AddParameter("ParentID", $_usr_portal_access, "d");
        $data = $this->mapi->CallProc("itm_CreateAccount");
        return $data;
    }
    /*`itm_GetUsersList`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT, IN OrgSearch boolean)*/
    public function UserSearch($ClientID, $FacilityID, $DepartmentID, $OrgSearchFunc) {
      $this->mapi->BeginProc();
      $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
      $this->mapi->AddParameter("ClientID", $ClientID, "d");
      $this->mapi->AddParameter("FacilityID", $FacilityID, "d");
      $this->mapi->AddParameter("DepartmentID", $DepartmentID, "d");
      $this->mapi->AddParameter("OrgSearch", $OrgSearchFunc ? 1 : 0, "d");
      $data = $this->mapi->CallProc("itm_GetUsersList");
      return $data;
    }

    public function ChangeLoginStatus($UserID, $CanLogin) {

    }
    //not positive about this.
    public function QuickEditStart($FieldName) {
        $_SESSION["CurrentFieldID"] = UserInformation::GetFieldID($FieldName);
      //  $_SESSION["ParentFk"] = NULL;
    }
    public function QuickEdit($id, $Value) {
        //`itm_StartEditHistory`(IN AccountID INT, IN UserID INT, IN ModuleID INT, IN FieldID INT, IN ValueData VARCHAR(760))
        $this->mapi->BeginProc();
        $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
        $this->mapi->AddParameter("UserID", $_SESSION['userid'], "d");
        $this->mapi->AddParameter("ModuleID", $this->ModuleID, "d");
        $this->mapi->AddParameter("FieldID", $_SESSION["CurrentFieldID"], "d");
        $this->mapi->AddParameter("ValueData", $Value, "s");
        $data = $this->mapi->CallProc("itm_StartEditHistory");
        return $data;
    }
    public function QuickEditStop($Id, $Value) {
        //`itm_StopEditHistory`(IN ParentPk INT, IN AccountID INT, IN UserID INT, IN RecordPk INT, IN ModuleID INT, IN FieldID INT,
        //IN TableName VARCHAR(78), IN FieldPrefix VARCHAR(10), IN FieldKey VARCHAR(45), IN ValueData VARCHAR(760), IN Svalue BIT)
        //$parent = $this->QuickEdit($Id, $Value);
        $fieldKey = UserInformation::GetFieldKey($_SESSION["CurrentFieldID"]);
        $PrefixLen = strlen($this->Prefix);
        $FieldLen = strlen($fieldKey);
        $key = substr($fieldKey, $PrefixLen + 1, $FieldLen - ($PrefixLen + 1));
        $this->mapi->BeginProc();
        $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
        $this->mapi->AddParameter("UserID", $_SESSION['userid'], "d");
        $this->mapi->AddParameter("RecordPk", $Id, "d");
        $this->mapi->AddParameter("ModuleID", $this->ModuleID, "d");
        $this->mapi->AddParameter("FieldID", $_SESSION["CurrentFieldID"], "d");
        $this->mapi->AddParameter("TableName", $this->TblName, "s"); 
        $this->mapi->AddParameter("FieldPrefix", $this->Prefix, "s");
        $this->mapi->AddParameter("FieldKey", $key, "s");
        $this->mapi->AddParameter("ValueData", $Value, "s");
        $this->mapi->AddParameter("Svalue", 1, "d");
        $data = $this->mapi->CallProc("itm_StopEditHistory");
        return $data;
    }
}
class UserInformation {
    public $usr_cli_fk;
    public $cli_code;
    public $cli_name;

    public $usr_fac_fk;
    public $fac_code;
    public $fac_name;

    public $usr_dep_fk;
    public $dep_code;
    public $dep_name;
    public $dep_desc;

    public $usr_pk;

    public $usr_fname;
    public $usr_lname;
    public $usr_address1;
    public $usr_address2;
    public $usr_postal_code;
    public $usr_city;
    public $usr_state;
    public $usr_county;
    public $usr_country;
    public $usr_username;
    public $usr_email;
    public $usr_password;
    public $usr_domain;
    public $usr_netbios;
    public $usr_ou;
    public $usr_portal_login;
    public $usr_title;
    public $usr_manager;
    public $usr_phonenumber;

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
            case "usr_pk":
                return 0;
            case "usr_acct_fk":
                return 1;
            case "usr_cli_fk":
                return 2;
            case "usr_fac_fk":
                return 3;
            case "usr_dep_fk":
                return 4;
            case "usr_fname":
                return 5;
            case "usr_lname":
                return 6;
            case "usr_address1":
                return 7;
            case "usr_address2":
                return 8;
            case "usr_postal_code":
                return 9;
            case "usr_city":
                return 10;
            case "usr_state":
                return 11;
            case "usr_county":
                return 12;
            case "usr_country":
                return 13;
            case "usr_username":
                return 14;
            case "usr_email":
                return 15;
            case "usr_password":
                return 16;
            case "usr_domain":
                return 17;
            case "usr_ou":
                return 18;
            case "usr_portal_login":
                return 19;
            case "usr_title":
                return 20;
            case "usr_manager":
                return 21;
            case "usr_phonenumber":
                return 21;
            default:
                return -2;
        }
    }

    //Used regex to make below so there was no re-type.
    //http://regexr.com/3bres
    public static function GetFieldKey($FieldID) {
        switch($FieldID) {
            case 0:
                return "usr_pk";
            case 1:
                return "usr_acct_fk";
            case 2:
                return "usr_cli_fk";
            case 3:
                return "usr_fac_fk";
            case 4:
                return "usr_dep_fk";
            case 5:
                return "usr_fname";
            case 6:
                return "usr_lname";
            case 7:
                return "usr_address1";
            case 8:
                return "usr_address2";
            case 9:
                return "usr_postal_code";
            case 10:
                return "usr_city";
            case 11:
                return "usr_state";
            case 12:
                return "usr_county";
            case 13:
                return "usr_country";
            case 14:
                return "usr_username";
            case 15:
                return "usr_email";
            case 16:
                return "usr_password";
            case 17:
                return "usr_domain";
            case 18:
                return "usr_ou";
            case 19:
                return "usr_portal_login";
            case 20:
                return "usr_title";
            case 21:
                return "usr_manager";
            case 21:
                return "usr_phonenumber";
            default:
                return -2;
        }
    }
}

?>
