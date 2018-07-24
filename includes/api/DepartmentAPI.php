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
class DepartmentAPI
{
	private $TblName = "it_dep";
    private $IndexColumn = "";
    private $Prefix = "dep";
    private $ModuleID = 3;
		private $mapi;
		public function __construct($dbCon) {
				$this->mapi = new MySQLIAPI($dbCon);
		}

	public function CreateDepartment($fac_pk, $dep_name, $dep_code, $dep_contact_name, $dep_phone,
																		$dep_email, $dep_desc, $dep_address1, $dep_address2, $dep_city,
																		$dep_postal_code, $dep_county, $dep_state, $dep_country) {
		$this->mapi->BeginProc();
		$this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
		$this->mapi->AddParameter("FacilityID", $fac_pk, "d");
		$this->mapi->AddParameter("DepartmentName", $dep_name, "s");
		$this->mapi->AddParameter("DepartmentCode", $dep_code, "s");
		$this->mapi->AddParameter("contact_name", $dep_contact_name, "s");
		$this->mapi->AddParameter("phone", $dep_phone, "s");
		$this->mapi->AddParameter("contact_email", $dep_email, "s");
		$this->mapi->AddParameter("Description", $dep_desc, "s");
		$this->mapi->AddParameter("Address1", $dep_address1, "s");
		$this->mapi->AddParameter("Address2", $dep_address2, "s");
		$this->mapi->AddParameter("City", $dep_city, "s");
		$this->mapi->AddParameter("postal_code", $dep_postal_code, "s");
		$this->mapi->AddParameter("County", $dep_county, "s");
		$this->mapi->AddParameter("State", $dep_state, "s");
		$this->mapi->AddParameter("Country", $dep_country, "s");
		$row = $this->mapi->CallProc("itm_CreateDepartment");
		if(!is_null($row[0]))
		{
			$_SESSION['SuccessSubmission'] = 1;
		}
		else {
			$_SESSION['SuccessSubmission'] = -1;
		}

	}

	public function GetDepartmentList($cli_pk, $fac_pk) {
		$this->mapi->BeginProc();
		$this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
		$this->mapi->AddParameter("ClientID", $cli_pk, "d");
		$this->mapi->AddParameter("FacilityID", $fac_pk, "d");
		$tableData = $this->mapi->CallProc("itm_GetDepartmentList");
    return $tableData;
	}

//(IN AccountID INT, IN DepPK INT)

	public function GetDepartmentInformation($DepartmentPK) {
		$this->mapi->BeginProc();
		$this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
		$this->mapi->AddParameter("DepPK", $DepartmentPK, "d");
		$tableData = $this->mapi->CallProc("itm_GetDepartmentInfo", "DepartmentFields");
    return $tableData[0];
}

}
class DepartmentFields {

	public $dep_acct_fk;
	public $dep_cli_fk;
	public $dep_fac_fk;
	public $fac_code;
	public $fac_name;

	public $dep_code;
	public $dep_name;
	public $dep_desc;
	public $dep_phone;
	public $dep_contact_name;
	public $dep_contact_email;
	public $dep_address1;
	public $dep_address2;
	public $dep_city;
	public $dep_postal_code;
	public $dep_county;
	public $dep_state;
	public $dep_country;

}
?>
