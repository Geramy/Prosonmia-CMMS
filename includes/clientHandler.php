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
class ClientHandler
{
	private $TblName = "it_cli";
    private $IndexColumn = "";
    private $Prefix = "cli";
    private $ModuleID = 1;	
	private $con;
	public function __construct($dbCon) {
		$this->con = $dbCon;
	}
	
	public function CreateClient($coName, $code, $address1, $address2, $postal, $city, $phone, $contactName, $contactEmail, $county, $state, $country) {
	    $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
		$CN = mysqli_escape_string( $this->con, $coName);
		$CODE = mysqli_escape_string( $this->con, $code);
		$AD1 = mysqli_escape_string( $this->con, $address1);
		$AD2 = mysqli_escape_string($this->con, $address2);
		$POS = mysqli_escape_string($this->con, $postal);
		$CTY = mysqli_escape_string($this->con, $city);
		$PH = mysqli_escape_string( $this->con, $phone);
		$CON = mysqli_escape_string( $this->con, $contactName);
		$EM = mysqli_escape_string( $this->con, $contactEmail);
		$COY = mysqli_escape_string($tis->con, $county);
		$ST = mysqli_escape_string($this->con, $state);
		$CORY = mysqli_escape_string($this->con, $country);
		
		$result = mysqli_query($this->con, "CALL itm_CreateClient(". sprintf("%d, %d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'", $AcctID,
                                                                        $CODE, $CN, $AD1, $AD2, $POS, $CTY, $PH, $CON, $EM, $COY, $ST, $CORY) .")") or die(mysqli_error($this->con));
        $row = mysqli_fetch_row($result);
		if(!is_null($row[0]))
		{
			$_SESSION['SuccessSubmission'] = 1;
		}
		else {
			$_SESSION['SuccessSubmission'] = -1;
		}
	}
	public function GetClientsList() {
	    $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
		$result = mysqli_query( $this->con, "CALL itm_GetClientList(". sprintf("%d", $AcctID) .")") or die(mysqli_error($this->con));
		$tableData = array();
        while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
        return $tableData;
	}
}

class ClientFields {

	public $cli_acct_fk;
	public $cli_code;
	public $cli_name;
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