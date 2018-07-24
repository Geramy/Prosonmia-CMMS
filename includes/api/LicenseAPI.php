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
class LicenseAPI //data needs to be filled in once table is created in db
{
	private $TblName = "it_";
    private $IndexColumn = "";
    private $Prefix = " ";
    private $ModuleID = 7;
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
        $result = mysqli_query($this->con, "CALL itm_EquipmentSearch(".sprintf("%d, %s, %s, %s", $AcctID, $cliID, $facID, $depID).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
		mysqli_free_result($result);
		mysqli_next_result($this->con);
        return $tableData;
    }
}
?>
