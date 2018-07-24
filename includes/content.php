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
include_once 'includes/config.php';
include_once("includes/api/BaseAPI.php");
	if(isset($_GET['module']))
	{
		$_SESSION['man'] = $_GET['module'];
	}
?>
<div class="content">
	<div class="intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
	<?php
switch($mod) {
case "Admin":
	include_once("includes/api/AdminAPI.php");
	switch($act)
	{
		case "Acct":
			include_once("includes/view/AcctAdmin.php");
			break;
	}
	break;
case "Clients":
	include_once('includes/api/ClientAPI.php');
	switch($act)
			{
	    case "NewClient":
	        include_once("includes/form/fcomp.php");
	        break;
	    case "ViewClients":
	        include_once("includes/cliList.php");
	  			break;
			case "ViewItem":
	        include_once("includes/itemview/ClientView.php");
	        break;
	      }
	  	break;
case "Facilities":
			include_once("includes/api/FacilityAPI.php");
			switch($act)
            {
						case "NewFacility":
							include_once("includes/form/ffac.php");
							break;
						case "ViewFacilities":
							include_once("includes/view/FacilitySearch.php");
							break;
						case "ViewItem":
							include_once("includes/itemview/FacilityView.php");
							break;
            }
            break;
case "Departments":
				include_once("includes/api/DepartmentAPI.php");
				switch($act)
				{
					case "NewDepartment":
						include_once("includes/form/fdep.php");
						break;
					case "ViewDepartments":
						include_once("includes/view/DepartmentSearch.php");
						break;
					case "ViewItem":
						include_once("includes/itemview/DepView.php");
						break;
				}
				break;
        case "Contacts":
            include_once("includes/api/ContactAPI.php");
            switch($act)
            {
                case "NewContact":
                    include("includes/form/new_contact.php");
                    break;
                case "ViewContacts":
                    include_once("includes/view/ContactSearch.php");
                    break;
                case "ViewItem":
                    include_once("includes/itemview/ContactView.php");
                    break;
            }
            break;
        case "Reports":
            include_once("includes/api/ReportsAPI.php");
            switch($act)
            {
                case "New":
                    if($id != NULL)
                    {
                        include_once("includes/report/ReportCreator.php");
                        $rpCreatorGen = new ReportCreator($id, $coni);
                        ?>
                    </div>
                </div>
                        <div class="row">
                        <?php
												$rpCreatorGen->CreateJSLink();
                        $rpCreatorGen->DisplaySideBar();
                        $rpCreatorGen->DisplayReportBody();
                        $rpCreatorGen->DisplayReportModules();
                        ?>
                        </div>
                <div class="container">
                    <div class="row">
                        <?php

                    }
                    else
                        include_once("includes/form/new_report.php");
                    break;
                case "View":
                    include_once("includes/view/report_selector.php");
                    break;
            }
            break;
		case "Rate Code":
			include_once("includes/api/RateCodeAPI.php");
			switch($act)
			{
				case "New":
					include_once("includes/form/new_ratecode.php");
					break;
				case "Search":
					include_once("includes/view/RateCodeSearch.php");
					break;
				case "ViewItem":
					include_once("includes/itemview/RateCodeView.php");
					break;
			}
			break;
        case "Work Order":
			include_once("includes/api/WorkOrderAPI.php");
	        switch($act)
	        {
	            case "New":
                    	include_once("components/AssetNumberACS.UI.Component.php");
                    	include_once("components/WOStatusACS.UI.Component.php");
                        include_once("components/WOTypeACS.UI.Component.php");
                        include_once("components/WOContactACS.UI.Component.php");
                        include_once("components/WOTaskRG.UI.Component.php");
	                include_once("includes/form/new_workorder.php");
	                break;
	            case "Search":
	                include_once('includes/view/WorkOrderSearch.php');
	                break;
				case "ViewItem":
	                include_once("includes/itemview/WorkOrderView.php");
	                break;
                case "Types":
                    include_once("includes/api/WorkOrderTypeAPI.php");
                    include_once("includes/itemview/WorkOrderTypeView.php");
                    break;
	        }
            break;
        case "Equipment":
            include_once("includes/api/WorkOrderTypeAPI.php");
						include_once("includes/api/EquipmentAPI.php");
            include_once("includes/api/PMScheduleAPI.php");
            switch($act)
            {
                case "New":
                    include_once("includes/form/new_equipment.php");
                    break;
                case "Search":
                    include_once("includes/view/EquipmentSearch.php");
                    break;
                case "ViewItem":
                    include_once("components/JobLibrary.UI.Component.php");
                    include_once("components/WOStatusACS.UI.Component.php");
                    include_once("components/WOTypeACS.UI.Component.php");
                    include_once("components/RateCode.UI.Component.php");
                    include_once("includes/itemview/EquipmentView.php");
                    break;
            }
            break;
        case "Inventory":
            include_once("includes/api/RentAPI.php");
            include_once("includes/api/InventoryAPI.php");
            switch($act)
            {
                case "New":
                    include_once("components/RateCode.UI.Component.php");
                    include_once("includes/form/new_inventory.php");
                    break;
                case "Search":
                    include_once("includes/view/InventorySearch.php");
                    break;
                case "ViewItem":
                    include_once("includes/itemview/InventoryView.php");
                    break;
            }
            break;
        case "Rent":
            include_once("includes/api/ShippingAPI.php");
            include_once("includes/api/ShipmentTrackingAPI.php");
            include_once("includes/api/RentAPI.php");
            switch($act)
            {
                case "Rent Item":
                    include_once("components/InventoryCodeACS.UI.Component.php");
                    include_once("components/ContactACS.UI.Component.php");
                	include_once("includes/form/new_rentable.php");
                    break;
                case "View Rented":
                    include_once("includes/view/RentableSearch.php");
                    break;
                case "ViewItem":
                    include_once("components/RentShipmentRG.UI.Component.php");
                    include_once("includes/itemview/RentableView.php");
                    break;
            }
            break;
        case "Job Library":
			include_once("includes/api/JobAPI.php");
            switch($act)
            {
                case "New":
                    include_once("components/RateCode.UI.Component.php");
                    include_once("includes/form/new_job.php");
                    break;
                case "Search":
                    include_once("includes/view/JobSearch.php");
                    //-----------------DELETE THIS API AFTER JOB LIBRARY IS FIXED-------------------------
                    include_once("includes/api/FacilityAPI.php");
                    break;
                case "ViewItem":
                    include_once("includes/itemview/JobView.php");
                    break;
            }
            break;
        case "Users":
        	include_once("includes/api/UserAPI.php");
            switch($act)
            {
								case "MyProfile":
                    include_once("includes/itemview/my_profile.php");
                    break;
                case "NewUser":

                    include_once("includes/form/new_user.php");
                    break;
                case "ViewItem":
                    include_once("includes/itemview/UsersView.php");
                    break;
                case "ViewUsers":
                    include_once("includes/view/UserSearch.php");
                    break;
            }
            break;
        case "0":
            include_once('includes/dashboard.php');
            break;
        case "MyAccount":
			include_once("includes/api/UserAPI.php");
            switch($act)
            {
            	case "MyProfile":
                    include_once("includes/itemview/my_profile.php");
                    break;
                case "PlanDetails":
                	include_once("includes/api/AccountAPI.php");
                    include_once("includes/itemview/PlanDetails.php");
                    break;
                case "logout":
                     $_SESSION["LoggedIn"] = "FALSE";
                    session_destroy();
					include("includes/logout_redirect.php");
                    break;
            }
            break;
		case "SuggestionBox":
			include_once("includes/api/SuggestionAPI.php");
            switch($act)
            {
                case "NewSuggestion":
                    include_once("includes/form/new_suggestion.php");
                    break;
                case "MySuggestions":
                    include("includes/view/MySuggestionSearch.php");
                    break;
				case "Admin":
					include("includes/view/SuggestionAdmin.php");
					break;
            }
			break;
		case "Product":
			include ("includes/api/ProductAPI.php");
			switch($act)
			{
				case "New Product":
					include("includes/form/new_product.php");
					break;
			}
			break;
        case "IT License":
			include ("includes/api/LicenseAPI.php");
			switch ($act) {
                case 'NewKey':
                    include("includes/form/New License.php");
                    break;
                case "ViewKeys":
                    include("includes/view/ViewKeys.php");
                    break;
                default:

                    break;
            }
            break;
        case "Vendor":
			include_once("includes/api/VendorAPI.php");
            switch($act)
            {
                case "New":
                    include_once("includes/form/New Vendor.php");
                    break;
                case "Search":
                    include_once("includes/view/Vendors.php");
                    break;
				case "ViewItem":
					include_once("includes/itemview/VendorView.php");
                    break;
            }
            break;
        case null:
            include_once("includes/view/Dashboard.php");
            break;
    }
	?>
                <div class="bootbox-holder" style="display: none;"></div>
                </div>
            </div>
        </div>
	</div>
</div>
}
