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
class InventoryAPI
{
	private $TblName = "it_inventory";
    private $IndexColumn = "";
    private $Prefix = "inv";
    private $ModuleID = 8;
		private $mapi;
		public function __construct($dbCon) {
				$this->mapi = new MySQLIAPI($dbCon);
		}
    //($_POST["cli_pk"], $_POST["fac_name"], $_POST["fac_address1"], $_POST["fac_phone"], $_POST["fac_contact_name"], $_POST["fac_email"] )

    public function OrganizationSearch($cli_pk, $dep_pk, $fac_pk) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $cliID = mysqli_escape_string( $this->con, $cli_pk);
        $facID = mysqli_escape_string( $this->con, $dep_pk);
        $depID = mysqli_escape_string( $this->con, $fac_pk);
        if(empty($cliID)) {
            $cliID = "NULL";
            $facID = "NULL";
            $depID = "NULL";
        } else if(empty($facID)) {
            $facID = "NULL";
            $depID = "NULL";
        } else if(empty($depID)) {
            $depID = "NULL";
        }
        $result = mysqli_query($this->con, "CALL itm_InventorySearch(".sprintf("%d, %s, %s, %s", $AcctID, $cliID, $facID, $depID).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
        mysqli_free_result($result);
		mysqli_next_result($this->con);
        return $tableData;
    }

    public function GetInformation($InvPk) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $invfk = mysqli_escape_string($this->con, $InvPk);

        $result = mysqli_query($this->con, "CALL itm_GetInventoryInfo(". sprintf("%d, %d", $AcctID, $invfk) .")") or die(mysqli_error($this->con));
        $data =  mysqli_fetch_object($result, "InventoryFields");
        mysqli_free_result($result);
		mysqli_next_result($this->con);
        return $data;
    }

    public function CreateRecord($cli_pk, $fac_pk, $dep_pk, $inv_code, $inv_rateCode_fk, $inv_serial_number,
                                     $inv_manufacturer, $inv_model) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $CliID = mysqli_escape_string( $this->con, $cli_pk);
        $fPk = mysqli_escape_string( $this->con, $fac_pk);
        $dPk = mysqli_escape_string( $this->con, $dep_pk);
        if(empty($CliID)) {
            $CliID = "NULL";
            $fPk = "NULL";
            $dPk = "NULL";
        } else if(empty($fPk)) {
            $fPk = "NULL";
            $dPk = "NULL";
        } else if(empty($dPk)) {
            $dPk = "NULL";
        }
        $invCode = mysqli_escape_string( $this->con, $inv_code);
        $invSnum = mysqli_escape_string( $this->con, $inv_serial_number);
        $invrCode = mysqli_escape_string( $this->con, $inv_rateCode_fk);
        $invManu = mysqli_escape_string( $this->con, $inv_manufacturer);
        $invMod = mysqli_escape_string( $this->con, $inv_model);
        $result = mysqli_query($this->con, "CALL itm_CreateInventory(".
                sprintf("%d, ".($CliID . ", " . $fPk .", ".$dPk).", '%s', '%s', '%s', '%s', '%s'",
                        $AcctID, $invCode, $invrCode, $invSnum, $invManu, $invMod) .")") or die(mysqli_error($this->con));
        $row = mysqli_fetch_row($result);
		mysqli_free_result($result);
		mysqli_next_result($this->con);
        return $row[0];
        //echo "CALL itm_CreateEquipment(".  sprintf("%d, %d, %d, %d, '%s', '%s', '%s', '%s', '%s', '%s', %d, %d, '%s', '%s', '%s'",
        //                $AcctID, $CliID, $fPk, $dPk, $eqPCode, $eqC, $eqSN, $eqIT, $eqMA, $eqMO, $purIT, $purCO, $purDA, $purDI, $purAP) .")";

    }
    public function Search($cli_pk, $dep_pk, $fac_pk) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $cliID = mysqli_escape_string( $this->con, $cli_pk);
        $facID = mysqli_escape_string( $this->con, $dep_pk);
        $depID = mysqli_escape_string( $this->con, $fac_pk);
        if(empty($cliID)) {
            $cliID = "NULL";
            $facID = "NULL";
            $depID = "NULL";
        } else if(empty($facID)) {
            $facID = "NULL";
            $depID = "NULL";
        } else if(empty($dPk)) {
            $depID = "NULL";
        }
        $result = mysqli_query($this->con, "CALL itm_GetInventory(".sprintf("%d, %s, %s, %s", $AcctID, $cliID, $facID, $depID).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
		mysqli_free_result($result);
		mysqli_next_result($this->con);
        return $tableData;
    }

    public function ACSearch($wildSearch) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $UsrID = mysqli_escape_string( $this->con, $_SESSION['userid']);
        $wldS = mysqli_escape_string($this->con, $wildSearch);
        $result = mysqli_query($this->con, "CALL itm_GetInventoryAC(".sprintf("%d, %d, '%s'", $AcctID, $UsrID, $wldS).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $tableData;
    }
}
class InventoryFields {
    public $inv_cli_fk;
    public $cli_code;
    public $cli_name;

    public $inv_fac_fk;
    public $fac_code;
    public $fac_name;

    public $inv_dep_fk;
    public $dep_code;
    public $dep_name;
    public $dep_desc;

    public $inv_code;
    public $inv_ratecode_fk;
    public $rateCode_code;
    public $inv_serial_number;
    public $inv_manufacturer;
    public $inv_model;
    public $inv_item_type;
}
?>
