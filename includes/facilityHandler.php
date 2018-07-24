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
class FacilityHandler
{
	private $TblName = "it_fac";
    private $IndexColumn = "";
    private $Prefix = "fac";
    private $ModuleID = 2;	
    private $con;
    public function __construct($dbCon) {
        $this->con = $dbCon;
    }
    public function CreateFacility($cli_pk, $fac_name, $fac_code, $fac_contact_name, $fac_email, $fac_phone, $fac_address1, $fac_address2, $fac_postal_code, $fac_city, $fac_county, $fac_state, $fac_country ) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $CliID = mysqli_escape_string( $this->con, $cli_pk);
        $Name = mysqli_escape_string( $this->con, $fac_name);
		$Code = mysqli_escape_string($this->con, $fac_code);
		$CN = mysqli_escape_string( $this->con, $fac_contact_name);
		$Email = mysqli_escape_string($this->con, $fac_email);
		$Phone = mysqli_escape_string($this->con, $fac_phone);
        $Address1 = mysqli_escape_string( $this->con, $fac_address1);
		$Address2 = mysqli_escape_string($this->con, $fac_address2);
		$Postal = mysqli_escape_string($this->con, $fac_postal_code);
		$City = mysqli_escape_string($this->con, $fac_city);
		$County = mysqli_escape_string($this->con, $fac_county);
		$State = mysqli_escape_string($this->con, $fac_state);
		$Country = mysqli_escape_string($this->con, $fac_country);
        
        
        
        $result = mysqli_query($this->con, "CALL itm_CreateFac(". sprintf("'%d', '%d', '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s'", $AcctID, $CliID,
                                                                        $Name, $Code, $CN, $Email, $Phone, $Address1, $Address2, $Postal, $City, $County, $State, $Country) .")") or die(mysqli_error($this->con));
        $row = mysqli_fetch_row($result);
        if(!is_null($row[0]))
		{
			$_SESSION['SuccessSubmission'] = 1;
		}
		else {
			$_SESSION['SuccessSubmission'] = -1;
		}
    }
    public function GetFacilityList($ClientID) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        $cliID = mysqli_escape_string($this->con, $ClientID);
        $result = mysqli_query( $this->con, "CALL itm_GetFacilityList(". sprintf("%d, %d", $AcctID, $cliID) .")") or die(mysqli_error($this->con));
       
	    while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
        return $tableData;
	   
	   // $tableData = array();
        
       // while($tableData[] = mysqli_fetch_assoc($result));
       // return $tableData;
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