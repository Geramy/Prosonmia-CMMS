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
class AcctHandler
{
	private $TblName = "it_acct";
    private $IndexColumn = "";
    private $Prefix = "acct";
    private $ModuleID = 9;
		private $mapi;
		public function __construct($dbCon) {
				//$this->con = $dbCon;
				$this->mapi = new MySQLIAPI($dbCon);

		}

	public function CreateAccount($coName, $userName, $email, $pass, $firstName, $lastName, $address1, $address2,
									$city, $state, $county, $country, $phone, $postal) {
		$this->mapi->BeginProc();
		$this->mapi->AddParameter("companyName", $coName, "s");
		$this->mapi->AddParameter("parent_fk", NULL, "d");
		$this->mapi->AddParameter("username", $userName, "s");
		$this->mapi->AddParameter("email_address", $email, "s");
		$this->mapi->AddParameter("Pwd", $pass, "s");
		$this->mapi->AddParameter("firstname", $firstName, "s");
		$this->mapi->AddParameter("lastname", $lastName, "s");
		$this->mapi->AddParameter("address1", $address1, "s");
		$this->mapi->AddParameter("address2", $address2, "s");
		$this->mapi->AddParameter("city", $city, "s");
		$this->mapi->AddParameter("state", $state, "s");
		$this->mapi->AddParameter("county", $county, "s");
		$this->mapi->AddParameter("country", $country, "s");
		$this->mapi->AddParameter("post_code", $postal, "s");
		$this->mapi->AddParameter("MaximumUsers", 5, "d");
		$this->mapi->AddParameter("MaximumEquipment", 5, "d");
		$this->mapi->AddParameter("Credits", 0, "d");
		$data = $this->mapi->CallProc("itm_CreateCustomerAccount");
		return $data;
	}

	public function LogIn($userName, $pass) {
		$this->mapi->BeginProc();
		$this->mapi->AddParameter("email_address", $userName, "s");
		$this->mapi->AddParameter("username", $userName, "s");
		$this->mapi->AddParameter("_password", $pass, "s");
		$row = $this->mapi->CallProc("itm_LoginCustomer");
		if(!is_null($row[0]))
		{
			$_SESSION['accountid'] = $row[0]["AccountID"];
			$_SESSION['userid'] = $row[0]["UserID"];
			$_SESSION['cusid'] = $row[0]["CustomerID"];
			$_SESSION['LoggedIn'] = TRUE;
			return 1;
		}
		return -1;
	}

    public function GetBillableStatistics() {
			$this->mapi->BeginProc();
			$this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
			$data = $this->mapi->CallProc("itm_GetBillableStatistics");
			return $data;
    }


	//public function GetAccountsList() {
	//	$result = mysqli_query($this->con, "CALL itm_GetAllAccounts()") or die(mysqli_error($this->con));


	//	while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
     //   return $tableData;

	//}

	// The Following is for the AutoSave/QuickEdit plugin to connect to the DB
		public function QuickEditStart($FieldName) {
					$_SESSION["CurrentFieldID"] = AccountInformation::GetFieldID($FieldName);
					$_SESSION["ParentFk"] = NULL;
		}
		public function QuickEdit($id, $Value) {
				//`itm_StartEditHistory`(IN AccountID INT, IN UserID INT, IN ModuleID INT, IN FieldID INT, IN ValueData VARCHAR(760))
				//Need to check to make sure working

				$this->mapi->BeginProc();
				$this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
				$this->mapi->AddParameter("UserID", $_SESSION['userid'], "d");
				$this->mapi->AddParameter("ValueData", $NewVal, "s");
				$this->mapi->AddParameter("FieldID", $_SESSION['CurrentFieldID'], "d");
				$this->mapi->AddParameter("ModuleID", $_SESSION['ParentFk'], "d");
				$result = $this->mapi->CallProc("itm_StartEditHistory");
				return $result;
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
				$fieldKey = AccountInformation::GetFieldKey($_SESSION["CurrentFieldID"]);
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
//// End QuickEdit/AutoSave api

class AccountInformation {
	//Start here
	//http://regexr.com/3c5iv
	public $acct_pk;
	public $acct_creator_fk;
	public $acct_companyname;
	public $acct_maximum_users;
	public $acct_maximum_equipment;
	public $acct_credit;
	public $acct_wo_prefix;

	public static function IsString($FieldID) {
			switch($FieldID) {
					case 0:
					case 1:
					case 3:
					case 4:
					case 5:
							return false;
					default:
							return true;
			}
	}

	//then here
	//http://regexr.com/3c5j2
	public static function GetFieldID($FieldKey) {
			switch($FieldKey) {
				case "acct_pk":
					return 0;
				case "acct_creator_fk":
					return 1;
				case "acct_companyname":
					return 2;
				case "acct_maximum_users":
					return 3;
				case "acct_maximum_equipment":
					return 4;
				case "acct_credit":
					return 5;
				case "acct_wo_prefix":
					return 6;
				default:
					return -2;
			}
	}

	//and finally this
	//http://regexr.com/3c5is
	public static function GetFieldKey($FieldID) {
			switch($FieldID) {
				case 0:
					return "acct_pk";
				case 1:
					return "acct_creator_fk";
				case 2:
					return "acct_companyname";
				case 3:
					return "acct_maximum_users";
				case 4:
					return "acct_maximum_equipment";
				case 5:
					return "acct_credit";
				case 6:
					return "acct_wo_prefix";
				default:
					return -2;
			}
	}
}
?>
