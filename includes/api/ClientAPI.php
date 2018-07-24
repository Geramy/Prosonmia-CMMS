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
class ClientAPI
{
	private $TblName = "it_cli";
    private $IndexColumn = "";
    private $Prefix = "cli";
    private $ModuleID = 1;
		private $mapi;
		public function __construct($dbCon) {
				$this->mapi = new MySQLIAPI($dbCon);
		}

	public function CreateClient($coName, $code, $address1, $address2, $postal, $city, $phone, $contactName, $contactEmail, $county, $state, $country) {
		$this->mapi->BeginProc();
		$this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
		$this->mapi->AddParameter("cli_code", $code, "s");
		$this->mapi->AddParameter("Company", $coName, "s");
		$this->mapi->AddParameter("Address1", $address1, "s");
		$this->mapi->AddParameter("Address2", $address2, "s");
		$this->mapi->AddParameter("PostalCode", $postal, "s");
		$this->mapi->AddParameter("City", $city, "s");
		$this->mapi->AddParameter("Phone", $phone, "s");
		$this->mapi->AddParameter("ContName", $contactName, "s");
		$this->mapi->AddParameter("ContEmail", $contactEmail, "s");
		$this->mapi->AddParameter("County", $county, "s");
		$this->mapi->AddParameter("State", $state, "s");
		$this->mapi->AddParameter("Country", $country, "s");
		$row = $this->mapi->CallProc("itm_CreateClient");
		if(!is_null($row[0]))
		{
			$_SESSION['SuccessSubmission'] = 1;
		}
		else {
			$_SESSION['SuccessSubmission'] = -1;
		}
	}
	public function GetClientsList() {
				$this->mapi->BeginProc();
	      $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
	      $data = $this->mapi->CallProc("itm_GetClientList");
	      return $data;
	}
	public function GetClientInformation($ClientPK) {
				$this->mapi->BeginProc();
	      $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
	      $this->mapi->AddParameter("CliPK", $ClientPK, "d");
	      $data = $this->mapi->FetchObjects("itm_GetClientInfo", "ClientFields");
	      return $data[0];
	}
}

class ClientFields {

	public $cli_acct_fk;
	public $cli_code;
	public $cli_company;
	public $cli_address1;
	public $cli_address2;
	public $cli_postal_code;
	public $cli_city;
	public $cli_phone;
	public $cli_contact_name;
	public $cli_contact_email;
	public $cli_county;
	public $cli_state;
	public $cli_country;

}

?>
