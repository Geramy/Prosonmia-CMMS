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
include_once("api/BaseAPI.php");
include_once("connect.php");
include_once('session.class.php');
include_once('config.php');
$session = new session();
$session->start_session('_s', false);
$_SESSION["SuccessSubmission"] = NULL;
$MysqlPOST = array();

include("api/ClientAPI.php");
include("api/EquipmentAPI.php");
foreach($_POST AS $key => $value) {
    if(!isset($value) || strlen($value) < 1) {
        $MysqlPOST[$key] = null;
    }
    else {
        $MysqlPOST[$key] = $value;
    }
}

$mod = null;
$act = null;
$id  = null;
$id1 = null;
$id2 = null;
$id3 = null;

if(array_key_exists ("module", $_REQUEST) && strlen($_REQUEST["module"]) > 0) {
    $mod = urldecode($_REQUEST['module']);
}
if(array_key_exists ("action", $_REQUEST) && strlen($_REQUEST["action"]) > 0) {
    $act = urldecode($_REQUEST["action"]);
}

if(!array_key_exists ("id", $_REQUEST) || strlen($_REQUEST["id"]) < 1) {
    $id = null;
    $id1 = null;
    $id2 = null;
	$id3 = null;
} else if(!array_key_exists ("id1", $_REQUEST) || strlen($_REQUEST["id1"]) < 1) {
    $id  = urldecode($_REQUEST['id']);
    $id1 = null;
    $id2 = null;
	$id3 = null;
} else if(!array_key_exists ("id2", $_REQUEST) || strlen($_REQUEST["id2"]) < 1) {
    $id  = urldecode($_REQUEST['id']);
    $id1 = urldecode($_REQUEST["id1"]);
    $id2 = null;
    $id3 = null;
} else if(!array_key_exists ("id3", $_REQUEST) || strlen($_REQUEST["id3"]) < 1) {
    $id  = urldecode($_REQUEST['id']);
    $id1 = urldecode($_REQUEST["id1"]);
    $id2 = urldecode($_REQUEST["id2"]);
	$id3 = null;
} else if(array_key_exists ("id3", $_REQUEST) || strlen($_REQUEST["id3"]) > 0) {
    $id  = urldecode($_REQUEST['id']);
    $id1 = urldecode($_REQUEST["id1"]);
    $id2 = urldecode($_REQUEST['id2']);
	$id3 = urldecode($_REQUEST['id3']);
}

$request = $_REQUEST["RQ"];
$method = $_REQUEST["Method"];

switch ($request) {
	case 'CLM':
	  $createClient = new ClientAPI($coni);
		switch ($method) {
			case "Create":
				$_SESSION["SuccessSubmission"] = $createClient->CreateClient($_POST["fcomp"], $_POST["fcode"], $_POST["faddress1"], $_POST["faddress2"], $_POST["fpostal"],
								$_POST["fcity"], $_POST["fphone"], $_POST["fname"], $_POST["femail"], $_POST["fcounty"], $_POST["fstate"], $_POST["fcountry"] );
				header('Location: ../Clients/NewClient');
				exit();
			case "Delete":
				break;
			case "Get":
				break;
            case "GetClients":
                echo json_encode($createClient->GetClientsList());
                exit();
                break;

		}
		break;
    case "FAM":
        include_once("api/FacilityAPI.php");
        $facHandler = new FacilityAPI($coni);
        switch($method) {
            case "Create":
                $_SESSION["SuccessSubmission"] = $facHandler->CreateFacility($_POST["cli_pk"], $_POST["fac_name"], $_POST["fac_code"], $_POST["fac_contact_name"], $_POST["fac_email"], $_POST["fac_phone"], $_POST["fac_address1"],
                								$_POST["fac_address2"], $_POST["fac_postal_code"], $_POST["fac_city"], $_POST["fac_county"], $_POST["fac_state"], $_POST["fac_country"] );
                //header('Location: ../Facilities/ViewFacilities/'.$_POST["cli_pk"]);
                header('Location: ../Facilities/NewFacility');
                break;
            case "GetFacilities":
                echo json_encode($facHandler->GetFacilityList($_POST["cli_pk"]));
                break;
        }
        break;
    case "DEM":
        include_once("api/DepartmentAPI.php");
        $depHandler = new DepartmentAPI($coni);
        switch($method) {
			case "Create":
				$_SESSION["SuccessSubmission"] = $depHandler->CreateDepartment($_POST["fac_pk"], $_POST["dep_name"], $_POST["dep_code"],
				$_POST["dep_contact_name"], $_POST["dep_phone"], $_POST["dep_email"], $_POST["dep_desc"],
				$_POST["dep_address1"],	$_POST["dep_address2"], $_POST["dep_city"], $_POST["dep_postal_code"],
				$_POST["dep_county"], $_POST["dep_state"], $_POST["dep_country"]);
				header('Location: ../Departments/NewDepartment');
				break;
            case "GetDepartments":
                echo json_encode($depHandler->GetDepartmentList($_POST["cli_pk"], $_POST["fac_pk"]));
                break;
        }
        break;
    case 'Equipment':
    case 'EQUIP':
        $equip = new EquipmentAPI($coni);
        $id = $_POST["id"];
        $id1 = $_POST["id1"];
        $id2 = $_POST["id2"];

        switch ($method) {
            case "EditItem":

                break;
            case "OrgSearch":
                echo json_encode($equip->OrganizationSearch($id, $id1, $id2));
                exit();
            case "EquipSearch":
                echo json_encode($equip->EquipmentSearch($_POST["id"], $_POST["id1"], $_POST["id2"]));
                exit();
            case "Create":
                //cli_pk=4&fac_pk=3&dep_pk=0&eq_parent_code=test&eq_code=test&eq_serial_number=test&eq_item_type=test
                //&eq_manufacturer=test&eq_model=test&pur_itemType=1&RQ=EQUIP&Method=Create&fac_sub=&pur_cost=100
                //&pur_date=07%2F07%2F2015&pur_distributor=test&pur_approver=test
                //$_SESSION["SuccessSubmission"] =
                $_SESSION["SuccessSubmission"] = $equip->CreateEquipment($_POST["cli_pk"], $_POST["fac_pk"], $_POST["dep_pk"], $_POST["eq_parent_code"], $_POST["eq_code"], $_POST["eq_serial_number"],
                    $_POST["eq_item_type"], $_POST["eq_manufacturer"], $_POST["eq_model"], $_POST["pur_itemType"], $_POST["pur_cost"], $_POST["pur_date"],
                    $_POST["pur_distributor"], $_POST["pur_approver"]);
                header("Location: ../Equipment/New");
                exit();
            case "NewNetEquip":
                echo json_encode($equip->CreateNetworkEquipment($_POST["eq_mac_address"], $_POST["eq_ip_addr"], $_POST["eq_subnet"]));
                break;
            case "GetByMac":
                echo json_encode($equip->GetRecordByMac($_POST["eq_mac_address"]));
                break;
        }
        break;
    case "PM":
        include_once("api/PMScheduleAPI.php");
        $pmAPI = new PMScheduleAPI($coni);
        switch($method) {
            case "QCreate":
            //CreateRecord($pms_item_type, $pms_item_fk, $pms_interval_type, $pms_interval, $pms_daysPriorCreate, $pms_startDate, $pms_nextDate,
            //$pms_wo_wtype, $pms_wo_woss_fk, $pms_rateCode_fk, $pms_wo_creator_fk, $pms_wo_assigned_fk, $pms_wo_requestor_fk)
                $_SESSION["SuccessSubmission"] = $pmAPI->CreateRecord($_POST["pms_item_type"], $_POST["pms_item_fk"], $_POST["pms_interval_type"], $_POST["pms_interval"],
                                                                        null, $_POST["pms_startDate"], $_POST["pms_wtype_fk"], $_POST["pms_wo_woss_fk"],
                                                                        $_POST["pms_wo_rateCode_fk"], $_SESSION["userid"], null, $_POST["pms_wo_requestor_fk"], $_POST["pms_jobl_fk"]);
                $_SESSION["SubmissionType"] = "PM Schedule";
                break;
        }
        break;
	case "RCM":
        include_once("api/RateCodeAPI.php");
        $RCHandler = new RateCodeAPI($coni);
        switch($method) {
			case "Create":
				$_SESSION["SuccessSubmission"] =  $RCHandler->CreateRateCode($_POST["rateCode_name"], $_POST["rateCode_code"], $_POST["rateCode_hourly_cost"],
				$_POST["rateCode_part_multiplier"], $_POST["rateCode_labor_multiplier"], $_POST["rateCode_charge_multiplier"]);
				header('Location: ../Rate Code/New');
				break;
            case "Search":
                echo json_encode($RCHandler->RateCodeSearch());
                break;
			case "View":
				echo json_encode($RCHandler->RateCodeInfo($_POST["id"]));
				break;
        }
        break;
	case "JLM":
        include_once("api/JobAPI.php");
        $JLHandler = new JobAPI($coni);
        switch($method) {
			case "Create":
                //jobl_ratecode_fk needs to be converted to the fk properly or well no lets do it in the mysql db :) nvm ignore this comment
                //but leave it here so we know.
				$JobID = $JLHandler->CreateJob($_POST["jobl_name"], $_POST["jobl_code"], $_POST["jobl_ratecode_fk"], $_POST["jobl_description"]);
				$ItemCount = $_POST["total_rows"];
				for($i = 0; $i < $ItemCount; $i++)
                {
                    $PassRequired = (array_key_exists('jobli_' . $i . '_pass_required', $_POST) ? '1' : '0');
                    $EnableNotes = (array_key_exists('jobli_' . $i . '_notes', $_POST) ? '1' : '0');
                    $RequireNotes = (array_key_exists('jobli_' . $i . '_require_notes', $_POST) ? '1' : '0');
                    $JLHandler->CreateJobItem($JobID, $i, $PassRequired, $EnableNotes, $RequireNotes, $_POST['jobli_' . $i . '_name']);
                }
				header('Location: ../Job Library/New');
				break;
            case "Search":
                echo json_encode($JLHandler->GetJobList());
                break;
			case "View":
				echo json_encode($JLHandler->JobInfo($_POST["id"]));
				break;
			case "ViewList":
				echo json_encode($JLHandler->JobInfoList($_POST["jobl_pk"]));
				break;
        }
        break;
    case "Users":
    case "USM":
        include_once("api/UserAPI.php");
        $usr_api = new UserAPI($coni);
        switch($method) {
            case "EditItem":
                $usr_api->QuickEditStart($_POST["key"]);
                echo json_encode($usr_api->QuickEditStop($_POST["pk"], $_POST["value"]));
                break;
            case "OrgSearch":
                echo json_encode($usr_api->UserSearch($_POST["id"], $_POST["id1"], $_POST["id2"], TRUE));
                break;
            case "Search":
                echo json_encode($usr_api->OrganizationSearch($_POST["id"], $_POST["id1"], $_POST["id2"]));
                $usr_api->UserSearch($_POST["id"], $_POST["id1"], $_POST["id2"], FALSE);
                break;
            case "NewItemSearch":
                echo json_encode($usr_api->UserSearch($_POST["cli_pk"], $_POST["fac_pk"], $_POST["dep_pk"], FALSE));
                break;
            case "Create":
                $_SESSION["SuccessSubmission"] = $usr_api->CreateUser($_POST["cli_pk"], $_POST["fac_pk"], $_POST["dep_pk"], $_POST["usr_username"], $_POST["usr_email"], $_POST["usr_fname"], $_POST["usr_lname"],
                                                $_POST["usr_password"], $_POST["usr_title"], $_POST["usr_hiredate"], $_POST["usr_manager"], $_POST["usr_address1"], $_POST["usr_address2"],
                                                $_POST["usr_city"], $_POST["usr_state"], $_POST["usr_postal_code"], $_POST["usr_country"], $_POST["usr_portal_access"]);
                header("Location: ../Users/NewUser");
                break;
            case "QEStart":
                echo json_encode($usr_api->QuickEditStart($_POST["id"], $_POST["key"], $_POST["value"]));
                break;
            case "QE":
                echo json_encode($usr_api->QuickEdit($_POST["id"], $_POST["key"], $_POST["value"]));
                break;
            case "QEStop":
                echo json_encode($usr_api->QuickEditStop($_POST["id"], $_POST["key"]));
                break;
        }
        break;
    case "Contacts":
    case "CONM":
        include_once("api/ContactAPI.php");
        $con_api = new ContactAPI($coni);
        switch($method) {
            case "EditItem":
                $con_api->QuickEditStart($_POST["name"]);
                echo json_encode($con_api->QuickEditStop($_POST["pk"], $_POST["value"]));
                break;
            case "OrgSearch":
                echo json_encode($con_api->OrganizationSearch($id, $id1, $id2));
                break;
            case "Search":
                echo json_encode($con_api->ContactSearch($_POST["id"], $_POST["id1"], $_POST["id2"]));
                break;
            case "NewItemSearch":
                echo json_encode($con_api->UserSearch($_POST["cli_pk"], $_POST["fac_pk"], $_POST["dep_pk"], FALSE));
                break;
            case "Create":
                $_SESSION["SuccessSubmission"] = $con_api->CreateContact
                (
                    $_POST["cli_pk"], $_POST["fac_pk"], $_POST["dep_pk"], $_POST["con_type"], $_POST["con_fname"],
                    $_POST["con_lname"], $_POST["con_phone"], $_POST["con_email"], $_POST["con_notes"], $_POST["con_address"],
                    $_POST["con_postal_code"], $_POST["con_city"], $_POST["con_county"], $_POST["con_state"], $_POST["con_country"]
                );
                header("Location: ../Contacts/NewContact");
                break;
            case "QEStart":
                echo json_encode($con_api->QuickEditStart($_POST["id"], $_POST["key"], $_POST["value"]));
                break;
            case "QE":
                echo json_encode($con_api->QuickEdit($_POST["id"], $_POST["key"], $_POST["value"]));
                break;
            case "QEStop":
                echo json_encode($con_api->QuickEditStop($_POST["id"], $_POST["key"]));
                break;
        }
        break;
    case "Vendor":
    case "VENM":
        /* needs to be re-written its all copied except for the include */
        $id = $_POST["id"];
        $id1 = $_POST["id1"];
        $id2 = $_POST["id2"];

        include_once("api/VendorAPI.php");
        $ven_api = new VendorAPI($coni);
        switch($method) {
        	case "EditItem":
                $ven_api->QuickEditStart($_POST["name"]);
                echo json_encode($ven_api->QuickEditStop($_POST["pk"], $_POST["value"]));
                break;
            case "OrgSearch":
                echo json_encode($ven_api->OrganizationSearch($id, $id1, $id2));
                break;
            case "Search":
                echo json_encode($ven_api->GetVendorList($id, $id1, $id2));
                break;
            case "Create":
                $_SESSION["SuccessSubmission"] = $ven_api->CreateVendor($_POST["cli_pk"], $_POST["fac_pk"], $_POST["dep_pk"], $MysqlPOST["ven_name"], $MysqlPOST["ven_code"]);
                header("Location: ../Vendor/New");
                break;
			case "GetVendors":
                echo json_encode($ven_api->GetVendorList($_POST["cli_pk"], $_POST["fac_pk"], $_POST["dep_pk"]));
                break;
        }
        break;
    case "LICM":
        /* needs to be re-written its all copied except for the include */
        include_once("api/LicenseAPI.php");
        $licm_api = new LicenseAPI($coni);
        switch($method) {
            case "OrgSearch":
                echo json_encode($licm_api->UserSearch($_POST["id"], $_POST["id1"], $_POST["id2"], TRUE));
                break;
            case "Search":
                echo json_encode($licm_api->OrganizationSearch($_POST["id"], $_POST["id1"], $_POST["id2"]));
                break;
            case "NewItemSearch":
                echo json_encode($licm_api->UserSearch($_POST["cli_pk"], $_POST["fac_pk"], $_POST["dep_pk"], FALSE));
                break;
            case "Create":
                $_SESSION["SuccessSubmission"] = $licm_api->CreateUser($_POST["cli_pk"], $_POST["fac_pk"], $_POST["dep_pk"], $_POST["usr_username"], $_POST["usr_email"], $_POST["usr_fname"], $_POST["usr_lname"],
                                                $_POST["usr_password"], $_POST["usr_title"], $_POST["usr_hiredate"], $_POST["usr_manager"], $_POST["usr_address1"], $_POST["usr_address2"],
                                                $_POST["usr_city"], $_POST["usr_state"], $_POST["usr_postal_code"], $_POST["usr_country"], $_POST["usr_portal_access"]);
                header("Location: ../Users/NewUser");
                break;
        }
        break;
	case 'SUM':
		include_once("api/SuggestionAPI.php");
        $suggestionAPI = new SuggestionAPI($coni);
        switch ($method) {
            case "Create":
                $_SESSION["SuccessSubmission"] = $suggestionAPI->CreateSuggestion($_POST["sug_subject"], $_POST["sug_message"]);
				header("Location: ../SuggestionBox/MySuggestions");
                exit();
            case "View":
            	echo $suggestionAPI->GetSuggestions($_POST["sug_parent_fk"], $_POST["sug_creator_fk"]);
                exit();
			case "ViewThread":
				echo json_encode($suggestionAPI->GetSuggestionThread($_POST["sug_pk"]));
				exit();
			case "Reply":
				echo $suggestionAPI->CreateSuggestion($_POST["sug_subject"], $_POST["sug_message"], $_POST["sug_parent_fk"]);
				exit();
			case "AdminViewThread":
				echo json_encode($suggestionAPI->AdminGetSuggestions($_POST["sug_parent_fk"]));
				exit();
        }
        break;

	case "WOM":
        include_once("api/WorkOrderAPI.php");
        include_once("api/WorkOrderTypeAPI.php");
        $workorderHandler = new WorkOrderAPI($coni);
        $wotype = new WorkOrderTypeAPI($coni);
        switch ($method) {
            case "NewWorkOrder":
                echo $workorderHandler->CreateWorkOrder($_POST['cli_pk'], $_POST['dep_pk'], $_POST['fac_pk'], $_POST['wo_number'],
                                                        $_POST['wo_eq_fk'], $_POST['wo_requestor_name'], $_POST['wo_requestor_phone'],
                                                        $_POST['wo_startDate'],$_POST['wo_completionDate'],$_POST['wo_wtype_fk'],
                                                        $_POST['wo_woss_fk'],$_POST['wo_requestor_email'],$_POST['wo_requestDate'],
                                                        $_POST['wo_endDate'],$_POST['wo_issue']);
                header("Location ../Work Order/Search");
                break;
            case "NewWOType":
                $_SESSION["SuccessSubmission"] = $wotype->CreateWOType(null, $_POST["wtype_name"], $_POST["wtype_code"]);
                header("Location ../Work Order/Types");
                break;
            case "OrgSearch":
                echo json_encode($workorderHandler->OrganizationSearch($_POST["id"], $_POST["id1"], $_POST["id2"]));
            break;
        }
        break;
    case 'RIM':
        include_once("api/RentAPI.php");
        $rentHandler = new RentAPI($coni);
        switch ($method) {
            case "Create":
                $_SESSION["SuccessSubmission"] = $rentHandler->CreateRentable($_POST['ren_inv_fk'],
                	 $_POST['ren_con_fk'], $_POST['ren_startDate'], $_POST['ren_endDate'], $_POST['ren_shippedDate'], $_POST['ren_arrivedDate']);
                 if($_SESSION["SuccessSubmission"] > -1) {
                    include_once("api/ShippingAPI.php");
                    include_once("api/ShipmentTrackingAPI.php");
                    $ship_fk = NULL;
                    $shipCore = new ShippingAPI($coni);
                    $details = $shipCore->GetDetails($_SESSION["SuccessSubmission"], 2);
                    if($details != null && key_exists("ship_pk", $details)) {
                        $ship_fk = $details["ship_pk"];
                    }
                    else {
                        $ship_fk = $shipCore->itm_CreateShipmentDetails(2, $_SESSION["SuccessSubmission"], "");
                        $ship_fk = $ship_fk["ship_pk"];
                    }
                    $shiptrack = new ShipmentTrackingAPI($this->con);
                    $recordSave = $shiptrack->itm_CreateShipTrack($ship_fk, $_POST['ren_shippedDate'], null, $_POST["ren_trackingNumber"], null);
                 }
				header("Location: ../Rent/Rent Item");
                break;
			case "OrgSearch":
                echo json_encode($rentHandler->OrganizationSearch($id));
                break;
            case "Search":

                break;
        }
        break;
    case 'INVM':
        include_once("api/InventoryAPI.php");
        $invHandler = new InventoryAPI($coni);
        switch ($method) {
            case "Create":
                $_SESSION["SuccessSubmission"] = $invHandler->CreateRecord($MysqlPOST['cli_pk'], $MysqlPOST['fac_pk'], $MysqlPOST['dep_pk'], $_POST["inv_code"],
                    $_POST["inv_ratecode_fk"], $_POST["inv_serial_number"], $_POST["inv_manufacturer"], $_POST["inv_model"]);
                header("Location: ../Inventory/New");
                break;
            case "GetStockInformation":

                break;
        }
        break;
    case 'MyAccount':
	case 'ACCTM':
		include_once("api/AccountAPI.php");
		$accountHand = new AcctHandler($coni);
		switch ($method) {
      case "EditItem":
              $accountHand->QuickEditStart($_POST["key"]);
              echo json_encode($accountHand->QuickEditStop($_SESSION['id'], $_POST["value"]));
          break;
			case "Create":
				$_SESSION["SuccessSubmission"] = $accountHand->CreateAccount($_POST["fcomp"], $_POST["fuser"], $_POST["femail"], $_POST["fpass"],
															$_POST["ffirstname"], $_POST["flastname"], $_POST["faddress1"],
															$_POST["faddress2"], $_POST["fcity"], $_POST["fstate"], $_POST["fcounty"],
															$_POST["fcountry"], $_POST["fphone"], $_POST["fpostal"]);
				header('Location: ../login.php');
				break;

			case "Delete":
				break;
			case "Login":
				echo $Login = $accountHand->LogIn($_POST["username"], $_POST["pass"]);
				//header('Location: ..\index.php');
				break;
			case "Logout":

				break;
			case "GetAll":
				echo $GetAll = $accountHand->GetAccountsList();
				break;
            // Link AutoSave/QuickEdit to module's own api
            case "QEStart":
                echo json_encode($con_api->QuickEditStart($_POST["id"], $_POST["key"], $_POST["value"]));
                break;
            case "QE":
                echo json_encode($con_api->QuickEdit($_POST["id"], $_POST["key"], $_POST["value"]));
                break;
            case "QEStop":
                echo json_encode($con_api->QuickEditStop($_POST["id"], $_POST["key"]));
                break;
            /////
		}
		break;
    case "ReportC":
      include_once("report/ReportCreator.php");
      switch($method) {
        case "getmainJs":
          header('Content-type: text/javascript');
          ReportCreator::GenerateJavascript($id);
          exit;
        case "GetFilterRow":
          $rpC = new ReportCreator($id, $coni);
          $rpC->GetFilterRow();
          break;
        case "GetParamRow":
          $rpC = new ReportCreator($id, $coni);
          $rpC->GetParamaterRow();
          break;
        case "GetColumns":
          $rpC = new ReportCreator($id, $coni);
          $rpC->GetColumnOptions($id1);
          break;
        case "GetOperations":
          $rpC = new ReportCreator($id, $coni);
          $rpC->GetOperations();
          break;
        case "SetColumn":
          $rpC = new ReportCreator($id, $coni);
          $rpC->SetColumn($id, $id1);
          break;

      }

      break;
    case "HTMLC":
        $ReportComponents = array();
        $HTMLComponents = array();
        foreach(glob("components/*.UI.Component.php") as $file) {
            require_once $file;

            $class = "UI" . basename($file, ".UI.Component.php");
            if(class_exists($class)) {
                $HTMLComponents[] = $class;
            }
        }
        foreach(glob("report/*.UI.php") as $file) {
            require_once $file;

            $class = basename($file, ".UI.php");
            if(class_exists($class)) {
                $ReportComponents[] = $class;
            }
        }
        switch($method)
        {
            case "AC":
                foreach($HTMLComponents as $name)
                {
                    $ComInstance = new $name();
                    if($ComInstance->IsImplemented() && $ComInstance instanceof AutoComplete) {
                        $shortHand = $ComInstance->GetNetworkingShorthand();
                        if(is_array($shortHand)) {
                            foreach($shortHand as $itemCode) {
                                if($itemCode == $id) {
                                    $ComInstance->HandleNetworkFunction($id, array("id1" => $id1), $coni);
                                }
                            }
                        }
                        else {
                            if($shortHand == $id) {
                                $ComInstance->HandleNetworkFunction($id, array("id1" => $id1), $coni);
                            }
                        }
                    }
                }
                break;
            case "RG":
                $found = false;
                foreach($HTMLComponents as $name)
                {
                    $ComInstance = new $name();
                    if($ComInstance->IsImplemented() && $ComInstance instanceof RowGenerator) {
                        $shortHand = $ComInstance->GetNetworkingShorthand();
                        if(is_array($shortHand)) {
                            foreach($shortHand as $itemCode) {
                                if($itemCode == $id) {
                                    $ComInstance->Initialize($dbCon);
                                    $ComInstance->HandleNetworkFunctionPD($id, array("id1" => $id1), $coni, $MysqlPOST);
                                    $found = true;
                                }
                            }
                        }
                        else {
                            if($shortHand == $id) {
                                $ComInstance->HandleNetworkFunctionPD($id, array("id1" => $id1), $coni, $MysqlPOST);
                                $found = true;
                            }
                        }
                    }
                }
                if(!$found)
                    echo "Not Found";
                break;
            case "RP":
                $found = false;
                foreach($ReportComponents as $name)
                {
                    $ComInstance = new $name();
                    if($ComInstance->IsImplemented() && $ComInstance instanceof IDropDown) {
                        $shortHand = $ComInstance->GetNetworkingShorthand();
                        if(is_array($shortHand)) {
                            foreach($shortHand as $itemCode) {
                                if($itemCode == $id) {
                                    $ComInstance->Initialize($coni, null);
                                    $ComInstance->HandleNetworkFunction($id, $MysqlPOST, $coni);
                                    $found = true;
                                }
                            }
                        }
                        else {
                            if($shortHand == $id) {
                                $ComInstance->HandleNetworkFunction($id, $MysqlPOST, $coni);
                                $found = true;
                            }
                        }
                    }
                }
                if(!$found)
                    echo "Not Found";
                break;
            default:
                echo $id . " Doesnt exist!";
                break;
        }
    break;
}
?>
