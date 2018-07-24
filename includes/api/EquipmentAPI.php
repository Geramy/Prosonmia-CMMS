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
class EquipmentAPI
{
		private $TblName = "it_equip";
    private $IndexColumn = "";
    private $Prefix = "equip";
    private $ModuleID = 4;
		private $mapi;
		public function __construct($dbCon) {
				$this->mapi = new MySQLIAPI($dbCon);
		}
    //($_POST["cli_pk"], $_POST["fac_name"], $_POST["fac_address1"], $_POST["fac_phone"], $_POST["fac_contact_name"], $_POST["fac_email"] )

    public function OrganizationSearch($cli_pk, $dep_pk, $fac_pk) {
			$this->mapi->BeginProc();
			$this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
			$this->mapi->AddParameter("ClientID", $cli_pk, "d");
			$this->mapi->AddParameter("FacilityID", $fac_pk, "d");
			$this->mapi->AddParameter("DepartmentID", $dep_pk, "d");
			$result = $this->mapi->CallProc("itm_EquipmentSearch");
			return $result;
    }

    public function GetEquipmentInformation($EquipmentPK) {
			$this->mapi->BeginProc();
			$this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
			$this->mapi->AddParameter("EquipmentPK", $EquipmentPK, "d");
			$result = $this->mapi->CallProc("itm_GetEquipInfo");
			return $result;
    }

    public function CreateEquipment($cli_pk, $fac_pk, $dep_pk, $eq_parent_code, $eq_code, $eq_serial_number, $eq_item_type,
                                     $eq_manufacturer, $eq_model, $pur_itemType, $pur_cost, $pur_date, $pur_distributor, $pur_approver) {
			 $this->mapi->BeginProc();
			 $this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
			 $this->mapi->AddParameter("ClientID", $cli_pk, "d");
			 $this->mapi->AddParameter("FacilityID", $fac_pk, "d");
			 $this->mapi->AddParameter("DepartmentID", $dep_pk, "d");
			 $this->mapi->AddParameter("ParentCode", $eq_parent_code, "s");
			 $this->mapi->AddParameter("EquipmentCode", $eq_code, "s");
			 $this->mapi->AddParameter("eq_serial_number", $eq_serial_number, "s");
			 $this->mapi->AddParameter("eq_item_type", $eq_item_type, "s");
			 $this->mapi->AddParameter("eq_manu", $eq_manufacturer, "s");
			 $this->mapi->AddParameter("eq_mod", $eq_model, "s");
			 $this->mapi->AddParameter("pur_itemType", $pur_itemType, "s");
			 $this->mapi->AddParameter("pur_cost", $pur_cost, "s");
			 $this->mapi->AddParameter("pur_date", $pur_date, "s");
			 $this->mapi->AddParameter("pur_distributor", $pur_distributor, "s");
			 $this->mapi->AddParameter("pur_approveby", $pur_approver, "s");
			 $result = $this->mapi->CallProc("itm_CreateEquipment");
			 if(!is_null($result[0])) {
				 $_SESSION['SuccessSubmission'] = 1;
			 }else {
				$_SESSION['SuccessSubmission'] = -1;
			 }
			 return $result;
        //echo "CALL itm_CreateEquipment(".  sprintf("%d, %d, %d, %d, '%s', '%s', '%s', '%s', '%s', '%s', %d, %d, '%s', '%s', '%s'",
        //                $AcctID, $CliID, $fPk, $dPk, $eqPCode, $eqC, $eqSN, $eqIT, $eqMA, $eqMO, $purIT, $purCO, $purDA, $purDI, $purAP) .")";
    }
    public function CreateNetworkEquipment($macAddress, $ipAddr, $subnetAddr) {
			//This stored proc does not exist
				$this->mapi->BeginProc();
				$this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
				$this->mapi->AddParameter("ClientID", $macAddress, "s");
				$this->mapi->AddParameter("FacilityID", $ipAddr, "s");
				$this->mapi->AddParameter("DepartmentID", $subnetAddr, "s");
				$result = $this->mapi->CallProc("itm_CreateNetworkEquipment");
				return $result;
        //echo "CALL itm_CreateEquipment(".  sprintf("%d, %d, %d, %d, '%s', '%s', '%s', '%s', '%s', '%s', %d, %d, '%s', '%s', '%s'",
        //                $AcctID, $CliID, $fPk, $dPk, $eqPCode, $eqC, $eqSN, $eqIT, $eqMA, $eqMO, $purIT, $purCO, $purDA, $purDI, $purAP) .")";

    }
    public function EquipmentSearch($cli_pk, $dep_pk, $fac_pk) {
				$this->mapi->BeginProc();
				$this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
				$this->mapi->AddParameter("ClientID", $cli_pk, "d");
				$this->mapi->AddParameter("FacilityID", $fac_pk, "d");
				$this->mapi->AddParameter("DepartmentID", $dep_pk, "d");
				$result = $this->mapi->CallProc("itm_GetEquipment");
				return $result;
    }

    public function EquipmentACSearch($cli_pk, $dep_pk, $fac_pk, $wildSearch) {
				$this->mapi->BeginProc();
				$this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
				$this->mapi->AddParameter("ClientID", $cli_pk, "d");
				$this->mapi->AddParameter("FacilityID", $fac_pk, "d");
				$this->mapi->AddParameter("DepartmentID", $dep_pk, "d");
				$this->mapi->AddParameter("wildSearch", $wildSearch, "s");
				$result = $this->mapi->CallProc("itm_GetEquipmentAC");
				return $result;
    }

    public function GetRecordByMac($MacAddress) {
        //itm_GetEquipmentByMac
				$this->mapi->BeginProc();
				$this->mapi->AddParameter("AccountID", $_SESSION['accountid'], "d");
				$this->mapi->AddParameter("MacAddress", $MacAddress, "d");
				$result = $this->mapi->CallProc("itm_GetEquipmentByMac");
				return $result;
    }
}
class EquipmentFields {
    public $eq_cli_fk;
    public $cli_code;
    public $cli_name;

    public $eq_fac_fk;
    public $fac_code;
    public $fac_name;

    public $eq_dep_fk;
    public $dep_code;
    public $dep_name;
    public $dep_desc;

    public $eq_code;
    public $eq_serial_number;
    public $eq_manufacturer;
    public $eq_model;
    public $eq_item_type;
    public $eq_mac_address;
    public $eq_ip_address;
    public $eq_subnet;
}
?>
