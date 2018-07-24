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
class RentAPI
{
	private $TblName = "it_rentable";
	private $IndexColumn = "";
	private $Prefix = "rentable";
	private $ModuleID = 11;
	private $mapi;
	public function __construct($dbCon) {
			$this->mapi = new MySQLIAPI($dbCon);
	}

	public function CreateRentable($PD_ren_inv_fk, $PD_ren_con_fk, $PD_ren_startDate,
									$PD_ren_endDate, $PD_ren_shippedDate, $PD_ren_arrivedDate, $PD_ren_tracknum) {
		$AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
		$FLren_inv_fk = mysqli_escape_string($this->con, $PD_ren_inv_fk);
		$FLren_con_fk = mysqli_escape_string($this->con, $PD_ren_con_fk);
		$FLren_startDate = mysqli_escape_string($this->con, $PD_ren_startDate);
		$FLren_endDate = mysqli_escape_string($this->con, $PD_ren_endDate);
		$FLren_shippedDate = mysqli_escape_string($this->con, $PD_ren_shippedDate);
		$FLren_arrivedDate = mysqli_escape_string($this->con, $PD_ren_arrivedDate);
        $FLren_tracknum = mysqli_escape_string($this->con, $PD_ren_tracknum);

        if(empty($FLren_inv_fk))
            $FLren_inv_fk = "NULL";
        else
            $FLren_inv_fk = "'" . $FLren_inv_fk . "'";

        if(empty($FLren_con_fk))
            $FLren_con_fk = "NULL";
        else
            $FLren_con_fk = "'" . $FLren_con_fk . "'";

        if(empty($FLren_startDate))
            $FLren_startDate = "NULL";
        else
            $FLren_startDate = "'" . $FLren_startDate . "'";

        if(empty($FLren_endDate))
            $FLren_endDate = "NULL";
        else
            $FLren_endDate = "'" . $FLren_endDate . "'";

        if(empty($FLren_shippedDate))
            $FLren_shippedDate = "NULL";
        else
            $FLren_shippedDate = "'" . $FLren_shippedDate . "'";

        if(empty($FLren_arrivedDate))
            $FLren_arrivedDate = "NULL";
        else
            $FLren_arrivedDate = "'" . $FLren_arrivedDate . "'";
		$result = mysqli_query($this->con,
			"CALL itm_CreateRentable(".
				sprintf("%d, %s, %s, %s, %s, %s, %s",
					$AcctID, $FLren_inv_fk,
					$FLren_con_fk, $FLren_startDate,
					$FLren_endDate, $FLren_shippedDate,
					$FLren_arrivedDate
					).")") or die(mysqli_error($this->con));
		$data = mysqli_fetch_assoc($result);
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
	}

    public function GetRented($inv_pk) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $invID = mysqli_escape_string($this->con, $inv_pk);
        if(empty($invID))
            $invID = "NULL";
        $result = mysqli_query($this->con, "CALL itm_GetRented(".sprintf("%d, %s", $AcctID, $invID).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $tableData;
    }

    public function Search($con_pk) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $conID = mysqli_escape_string($this->con, $con_pk);
        if(empty($conID))
            $conID = "NULL";
        $result = mysqli_query($this->con, "CALL itm_GetRentList(".sprintf("%d, %s", $AcctID, $conID).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $tableData;
    }

	public function OrganizationSearch($con_pk) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $conID = mysqli_escape_string( $this->con, $con_pk);
        if(empty($conID))
            $conID = "NULL";
        $result = mysqli_query($this->con, "CALL itm_GetRentOrgs(".sprintf("%d, %s", $AcctID, $conID).")") or die(mysqli_error($this->con));
        $tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $tableData;
    }

    public function GetDetails($ren_fk) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $renID = mysqli_escape_string($this->con, $ren_fk);

        $result = mysqli_query($this->con, "CALL itm_GetRentInfo(". sprintf("%d, %d", $AcctID, $renID) .")") or die(mysqli_error($this->con));
        $data = mysqli_fetch_object($result, "RentFields");
        mysqli_free_result($result);
        mysqli_next_result($this->con);
        return $data;
    }
	//public function OrganizationSearch($cli)
}

class RentFields {

	public $ren_acct_fk;
	public $ren_inv_fk;
	public $ren_invst_fk;
	public $ren_con_fk;
	public $ren_createdDate;
	public $ren_shippedDate;
	public $ren_arrivedDate;
	public $ren_startDate;
	public $ren_endDate;
	public $ren_completed;

}
?>
