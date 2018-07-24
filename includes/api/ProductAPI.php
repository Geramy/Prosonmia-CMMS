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
class ProductAPI
{
	private $TblName = "it_prod";
    private $IndexColumn = "";
    private $Prefix = "prod";
    private $ModuleID = 4;
    private $con;
		private $mapi;
		public function __construct($dbCon) {
				$this->mapi = new MySQLIAPI($dbCon);
		}
    //($_POST["cli_pk"], $_POST["fac_name"], $_POST["fac_address1"], $_POST["fac_phone"], $_POST["fac_contact_name"], $_POST["fac_email"] )

    public function OrganizationSearch($cli_pk, $dep_pk, $fac_pk, $ven_pk) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $cliID = mysqli_escape_string( $this->con, $cli_pk);
        $facID = mysqli_escape_string( $this->con, $dep_pk);
        $depID = mysqli_escape_string( $this->con, $fac_pk);
		$comID = mysqli_escape_string( $this->con, $ven_pk);
        $result = mysqli_query($this->con, "CALL itm_EquipmentSearch(".sprintf("%d, %s, %s, %s, %s", $AcctID, $cliID, $facID, $depID, $comID).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
		mysqli_free_result($result);
		mysqli_next_result($this->con);
        return $tableData;
    }

    public function GetProductInformation($ProductPK) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $prodfk = mysqli_escape_string($this->con, $ProductPK);

        $result = mysqli_query($this->con, "CALL itm_GetProdInfo(". sprintf("%d, %d", $AcctID, $prodfk) .")") or die(mysqli_error($this->con));
		$data = mysqli_fetch_object($result, "ProductFields");
        mysqli_free_result($result);
		mysqli_next_result($this->con);
        return $data;
    }

    public function CreateProduct($cli_pk, $fac_pk, $dep_pk, $ven_pk, $prod_name, $prod_description //$prod_parent_code, $prod_code, $prod_serial_number, $prod_item_type,
                                     /*$prod_manufacturer, $prod_model, $pur_itemType*/, $pur_cost, $pur_date, $pur_distributor, $pur_approver) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $CliID = mysqli_escape_string( $this->con, $cli_pk);
        $FacID = mysqli_escape_string( $this->con, $fac_pk);
        $DepID = mysqli_escape_string( $this->con, $dep_pk);
		$VenID = mysqli_escape_string( $this->con, $ven_pk);
        $prN = mysqli_escape_string( $this->con, $prod_name);
		$prD = mysqli_escape_string( $this->con, $prod_description);
        $purCO = mysqli_escape_string( $this->con, $pur_cost);
        $purDA = mysqli_escape_string( $this->con, $pur_date);
        $purDI = mysqli_escape_string( $this->con, $pur_distributor);
        $purAP = mysqli_escape_string( $this->con, $pur_approver);
        $result = mysqli_query($this->con, "CALL itm_CreateProduct(".
                sprintf("%d, %d, %d, %d, %d '%s', '%s', %d, '%s', '%s', '%s'",
                        $AcctID, $CliID, $FacID, $DepID, $VenID, $prN, $prD, $purCO, $purDA, $purDI, $purAP) .")") or die(mysqli_error($this->con));
        $row = mysqli_fetch_row($result);
		mysqli_free_result($result);
		mysqli_next_result($this->con);
        if(isset($row))
		{
			$_SESSION['SuccessSubmission'] = 1;
		}
		else {
			$_SESSION['SuccessSubmission'] = -1;
		}
        return $row[0];
        //echo "CALL itm_CreateEquipment(".  sprintf("%d, %d, %d, %d, '%s', '%s', '%s', '%s', '%s', '%s', %d, %d, '%s', '%s', '%s'",
        //                $AcctID, $CliID, $fPk, $dPk, $eqPCode, $eqC, $eqSN, $eqIT, $eqMA, $eqMO, $purIT, $purCO, $purDA, $purDI, $purAP) .")";

    }
    public function CreateNetworkEquipment($macAddress, $ipAddr, $subnetAddr) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $mAddr = mysqli_escape_string( $this->con, $macAddress);
        $ipa = mysqli_escape_string( $this->con, $ipAddr);
        $sNet = mysqli_escape_string( $this->con, $subnetAddr);
        $result = mysqli_query($this->con, "CALL itm_CreateNetworkEquipment(".
                sprintf("%d, '%s', '%s', '%s'",
                        $AcctID, $mAddr, $ipa, $sNet) .")") or die(mysqli_error($this->con));
        $row = mysqli_fetch_row($result);
		mysqli_free_result($result);
		mysqli_next_result($this->con);
        return $row[0];
        //echo "CALL itm_CreateEquipment(".  sprintf("%d, %d, %d, %d, '%s', '%s', '%s', '%s', '%s', '%s', %d, %d, '%s', '%s', '%s'",
        //                $AcctID, $CliID, $fPk, $dPk, $eqPCode, $eqC, $eqSN, $eqIT, $eqMA, $eqMO, $purIT, $purCO, $purDA, $purDI, $purAP) .")";

    }
    public function ProductSearch($cli_pk, $dep_pk, $fac_pk, $ven_pk) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $cliID = mysqli_escape_string( $this->con, $cli_pk);
        $facID = mysqli_escape_string( $this->con, $dep_pk);
        $depID = mysqli_escape_string( $this->con, $fac_pk);
		$venID = mysqli_escape_string( $this->con, $ven_pk);
        $result = mysqli_query($this->con, "CALL itm_GetEquipment(".sprintf("%d, %s, %s, %s, %s, %s", $AcctID, $cliID, $facID, $depID, $comID, "NULL").")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
		mysqli_free_result($result);
		mysqli_next_result($this->con);
        return $tableData;
    }
    public function GetRecordByMac($MacAddress) {
        //itm_GetEquipmentByMac
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $mAddr = mysqli_escape_string( $this->con, $MacAddress);

        $result = mysqli_query($this->con, "CALL itm_GetEquipmentByMac(".sprintf("%d, '%s'", $AcctID, $mAddr).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
		mysqli_free_result($result);
		mysqli_next_result($this->con);
        return $tableData;
    }
}
class ProductFields {
    public $prod_cli_fk;
    public $cli_code;
    public $cli_name;

    public $prod_fac_fk;
    public $fac_code;
    public $fac_name;

    public $prod_dep_fk;
    public $dep_code;
    public $dep_name;
    public $dep_desc;

    public $prod_ven_fk;
    public $ven_company;

    public $prod_name;
	public $prod_code;
	public $prod_description;
}
?>
