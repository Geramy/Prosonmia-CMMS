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
class FacilityAPI
{
	private $TblName = "it_fac";
  private $IndexColumn = "";
  private $Prefix = "fac";
  private $ModuleID = 2;
	private $mapi;
	public function __construct($dbCon) {
			$this->mapi = new MySQLIAPI($dbCon);
	}

  public function CreateFacility($cli_pk, $fac_name, $fac_code, $fac_contact_name, $fac_email, $fac_phone, $fac_address1, $fac_address2, $fac_postal_code, $fac_city, $fac_county, $fac_state, $fac_country ) {
		$this->mapi->BeginProc();
		$this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
		$this->mapi->AddParameter("cli_fk", $cli_pk, "d");
		$this->mapi->AddParameter("facName", $fac_name, "s");
		$this->mapi->AddParameter("facCode", $fac_code, "s");
		$this->mapi->AddParameter("ContName", $fac_contact_name, "s");
		$this->mapi->AddParameter("ContEmail", $fac_email, "s");
		$this->mapi->AddParameter("Phone", $fac_phone, "s");
		$this->mapi->AddParameter("Address1", $fac_address1, "s");
		$this->mapi->AddParameter("Address2", $fac_address2, "s");
		$this->mapi->AddParameter("postal_code", $fac_postal_code, "s");
		$this->mapi->AddParameter("City", $fac_city, "s");
		$this->mapi->AddParameter("County", $fac_county, "s");
		$this->mapi->AddParameter("State", $fac_state, "s");
		$this->mapi->AddParameter("Country", $fac_country, "s");
		$row = $this->mapi->CallProc("itm_CreateFac");
		if(!is_null($row[0]))
		{
			$_SESSION['SuccessSubmission'] = 1;
		}
		else {
			$_SESSION['SuccessSubmission'] = -1;
		}
  }

  public function GetFacilityList($ClientID) {
		$this->mapi->BeginProc();
		$this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
		$this->mapi->AddParameter("ClientID", $ClientID, "d");
		$row = $this->mapi->CallProc("itm_GetFacilityList");
		return $row;
	}
	public function GetFacilityInformation($FacilityPK) {
		$this->mapi->BeginProc();
		$this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
		$this->mapi->AddParameter("FacPK", $FacilityPK, "d");
		$tableData = $this->mapi->CallProc("itm_GetFacilityInfo", "FacilityFields");
		return $tableData[0];
	}
}
class FacilityFields {

	public $fac_code;
	public $fac_acct_fk;
	public $fac_cli_fk;
	public $fac_name;

	public $fac_phone;
	public $fac_address1;
	public $fac_address2;
	public $fac_postal_code;
	public $fac_city;
	public $fac_county;
	public $fac_state;
	public $fac_country;
	public $fac_contact_name;
	public $fac_email;

}

?>
