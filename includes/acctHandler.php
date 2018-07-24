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
class AcctHandler_old
{
	private $TblName = "it_usr";
    private $IndexColumn = "";
    private $Prefix = "usr";
    private $ModuleID = 9;
	private $con;
	public function __construct($dbCon) {
		$this->con = $dbCon;
	}

	public function CreateAccount($coName, $userName, $email, $pass, $firstName, $lastName, $address1, $address2,
									$city, $state, $county, $country, $phone, $postal) {
		$CN = mysqli_escape_string( $this->con, $coName);
		$USRN = mysqli_escape_string( $this->con, $userName);
		$EM = mysqli_escape_string( $this->con, $email);
		$PA = mysqli_escape_string( $this->con, $pass);
		$FN = mysqli_escape_string( $this->con, $firstName);
		$LN = mysqli_escape_string( $this->con, $lastName);
		$AD1 = mysqli_escape_string( $this->con, $address1);
		$AD2 = mysqli_escape_string( $this->con, $address2);
		$CTY = mysqli_escape_string( $this->con, $city);
		$ST = mysqli_escape_string( $this->con, $state);
		$CONT = mysqli_escape_string( $this->con, $county);
		$CNTRY = mysqli_escape_string( $this->con, $country);
		$PH = mysqli_escape_string( $this->con, $phone);
		$PO = mysqli_escape_string( $this->con, $postal);

		$result = mysqli_query($this->con,
		"CALL itm_CreateCustomerAccount(". sprintf("'%s', NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', NULL, NULL, 0",
                                                                        $CN, $USRN, $EM, $PA, $FN, $LN, $AD1, $AD2, $CTY, $ST, $CONT, $CNTRY, $PH, $PO) .")") or die(mysqli_error($this->con));

	}

	public function LogIn($userName, $pass) {
		$USRN = mysqli_escape_string($this->con, $userName);
		$PAS = mysqli_escape_string($this->con, $pass);

		$result = mysqli_query($this->con, "CALL itm_LoginCustomer(". sprintf("NULL, '%s', '%s'", $USRN, $PAS) .")") or die(mysqli_error($this->con));
		$row = mysqli_fetch_array($result);
		if(!is_null($row[0]))
		{
		    $_SESSION['accountid'] = $row["AccountID"];
			$_SESSION['userid'] = $row["UserID"];
            $_SESSION['cusid'] = $row["CustomerID"];
			$_SESSION['LoggedIn'] = TRUE;
			return 1;
		}
		return -1;
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

	//public function GetAccountsList() {
	//	$result = mysqli_query($this->con, "CALL itm_GetAllAccounts()") or die(mysqli_error($this->con));


	//	while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
     //   return $tableData;

	//}


}

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
}
?>
