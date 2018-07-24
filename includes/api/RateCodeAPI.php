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
class RateCodeAPI
{
	private $TblName = "it_rateCode";
    private $IndexColumn = "";
    private $Prefix = "rateCode";
    private $ModuleID = 13;
		private $mapi;
		public function __construct($dbCon) {
				$this->mapi = new MySQLIAPI($dbCon);
		}
    //($_POST["cli_pk"], $_POST["fac_name"], $_POST["fac_address1"], $_POST["fac_phone"], $_POST["fac_contact_name"], $_POST["fac_email"] )

    public function CreateRateCode($rateCode_name, $rateCode_code, $rateCode_hourly_cost,
    $rateCode_part_multiplier, $rateCode_labor_multiplier, $rateCode_charge_multiplier) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $RCName = mysqli_escape_string( $this->con, $rateCode_name);
		$RCCode = mysqli_escape_string( $this->con, $rateCode_code);
		$RCHourlyCost = mysqli_escape_string( $this->con, $rateCode_hourly_cost);
		$RCPartMult = mysqli_escape_string( $this->con, $rateCode_part_multiplier);
		$RCLaborMult = mysqli_escape_string( $this->con, $rateCode_labor_multiplier);
		$RCChargeMult = mysqli_escape_string( $this->con, $rateCode_charge_multiplier);
		/*echo "CALL itm_CreateRateCode(".
                sprintf("%d, '%s', '%s', '%d', '%d', '%d', '%d'",
                        $AcctID, $RCName, $RCCode, $RCHourlyCost, $RCPartMult, $RCLaborMult,
                        $RCChargeMult) .")";*/
        $result = mysqli_query($this->con, "CALL itm_CreateRateCode(".
                sprintf("%d, '%s', '%s', '%.2f', '%.2f', '%.2f', '%.2f'",
                        $AcctID, $RCName, $RCCode, $RCHourlyCost, $RCPartMult, $RCLaborMult,
                        $RCChargeMult) .")") or die(mysqli_error($this->con));
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
    public function RateCodeSearch() {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $result = mysqli_query($this->con, "CALL itm_GetRateCodeList(".sprintf("%d, %s", $AcctID, "NULL").")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $tableData;
    }
    public function RateCodeACSearch($searchData) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $sData = mysqli_escape_string($this->con, $searchData);
        $result = mysqli_query($this->con, "CALL itm_GetRateCodeList(".sprintf("%d, '%s'", $AcctID, $sData).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $tableData;
    }
	public function RateCodeInfo($RateCodePk) {
		$AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $rateCode_fk = mysqli_escape_string($this->con, $RateCodePk);

        $result = mysqli_query($this->con, "CALL itm_GetRateCodeInfo(". sprintf("%d, %d", $AcctID, $rateCode_fk) .")") or die(mysqli_error($this->con));
        $data = mysqli_fetch_object($result, "RateCodeFields");
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $data;
	}
}
class RateCodeFields {
	public $rateCode_acct_fk;
    public $rateCode_name;
	public $rateCode_code;
	public $rateCode_hourly_cost;
	public $rateCode_part_multiplier;
	public $rateCode_labor_multiplier;
	public $rateCode_charge_multiplier;
}
?>
