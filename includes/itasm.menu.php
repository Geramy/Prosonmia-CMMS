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
class MenuItem
{
    public $Img;
    public $ID;
    public $Name;
    public $Link;

    public function __construct($HtmlID, $ItemName, $Location) {
        $this->Img = null;
        $this->ID = $HtmlID;
        $this->Name = $ItemName;
        $this->Link = $Location;
    }
}
class MenuSystem
{
    public $MenuItems = array();
    public $MenuArray = array();
    public function __construct() {
    }

    public function UpdateMenu() {
        $this->MenuItems["My Account"]["Index"] = 1;
        $this->MenuItems["My Account"]["menu"] = new MenuItem("ID", "My Account", "/MyAccount/");
        $this->MenuItems["My Account"]["sub_menu"]["My Profile"]['Index'] = 1;
        $this->MenuItems["My Account"]["sub_menu"]["My Profile"]["menu"] = new MenuItem("ID", "My Profile", "/Users/MyProfile");
		$this->MenuItems["My Account"]["sub_menu"]["Plan Details"]['Index'] = 1;
        $this->MenuItems["My Account"]["sub_menu"]["Plan Details"]["menu"] = new MenuItem("ID", "Plan Details", "/MyAccount/PlanDetails");
        $this->MenuItems["My Account"]["sub_menu"]["Logout"]['Index'] = 2;
        $this->MenuItems["My Account"]["sub_menu"]["Logout"]["menu"] = new MenuItem("ID", "Logout", "/MyAccount/logout");


        $this->MenuItems["Transactions"]["Index"] = 2;
        $this->MenuItems["Transactions"]["menu"] = new MenuItem("ID", "Transactions", "Transactions");
        $this->MenuItems["Transactions"]["sub_menu"]["Work Order"]['Index'] = 1;
        $this->MenuItems["Transactions"]["sub_menu"]["Work Order"]["menu"] = new MenuItem("ID", "Work Order", "Work Order");
        $this->MenuItems["Transactions"]["sub_menu"]["Work Order"]["sub_menu"]["Search"]["menu"] = new MenuItem("ID", "Search", "/Work Order/Search");
        $this->MenuItems["Transactions"]["sub_menu"]["Work Order"]["sub_menu"]["New"]["menu"] = new MenuItem("ID", "New", "/Work Order/New");
        $this->MenuItems["Transactions"]["sub_menu"]["Work Order"]["sub_menu"]["Types"]["menu"] = new MenuItem("ID", "Types", "/Work Order/Types");

        $this->MenuItems["Transactions"]["sub_menu"]["Rent"]['Index'] = 3;
        $this->MenuItems["Transactions"]["sub_menu"]["Rent"]["menu"] = new MenuItem("ID", "Rent", "Rent");
        $this->MenuItems["Transactions"]["sub_menu"]["Rent"]["sub_menu"]["Rent Item"]["menu"] = new MenuItem("ID", "Rent Item", "/Rent/Rent Item");
        $this->MenuItems["Transactions"]["sub_menu"]["Rent"]["sub_menu"]["View Rented"]["menu"] = new MenuItem("ID", "View Rented", "/Rent/View Rented");

        #$this->MenuItems["Transactions"]["sub_menu"]["PM Schedule"]['Index'] = 4;
        #$this->MenuItems["Transactions"]["sub_menu"]["PM Schedule"]["menu"] = new MenuItem("ID", "PM Schedule", "PM Schedule");
        #$this->MenuItems["Transactions"]["sub_menu"]["PM Schedule"]["sub_menu"]["New Schedule"]["menu"] = new MenuItem("ID", "New Schedule", "/PM Schedules/New Schedule");


        $this->MenuItems["Material"]["Index"] = 3;
        $this->MenuItems["Material"]["menu"] = new MenuItem("ID", "Material", "Material");
        $this->MenuItems["Material"]["sub_menu"]["Vendor"]['Index'] = 1;
        $this->MenuItems["Material"]["sub_menu"]["Vendor"]["menu"] = new MenuItem("ID", "Vendor", "Vendor");
        $this->MenuItems["Material"]["sub_menu"]["Vendor"]["sub_menu"]["Search"]["menu"] = new MenuItem("ID", "Search", "/Vendor/Search");
        $this->MenuItems["Material"]["sub_menu"]["Vendor"]["sub_menu"]["New"]["menu"] = new MenuItem("ID", "New", "/Vendor/New");

        $this->MenuItems["Material"]["sub_menu"]["Product"]['Index'] = 2;
        $this->MenuItems["Material"]["sub_menu"]["Product"]["menu"] = new MenuItem("ID", "Product", "Product");
        $this->MenuItems["Material"]["sub_menu"]["Product"]["sub_menu"]["Products"]["menu"] = new MenuItem("ID", "Products", "/Product/Products");
        $this->MenuItems["Material"]["sub_menu"]["Product"]["sub_menu"]["New Product"]["menu"] = new MenuItem("ID", "New Product", "/Product/New Product");

        $this->MenuItems["Material"]["sub_menu"]["Equipment"]['Index'] = 2;
        $this->MenuItems["Material"]["sub_menu"]["Equipment"]["menu"] = new MenuItem("ID", "Equipment", "Equipment");
        $this->MenuItems["Material"]["sub_menu"]["Equipment"]["sub_menu"]["Search"]["menu"] = new MenuItem("ID", "Search", "/Equipment/Search");
        $this->MenuItems["Material"]["sub_menu"]["Equipment"]["sub_menu"]["New"]["menu"] = new MenuItem("ID", "New", "/Equipment/New");

        $this->MenuItems["Material"]["sub_menu"]["Inventory"]['Index'] = 4;
        $this->MenuItems["Material"]["sub_menu"]["Inventory"]["menu"] = new MenuItem("ID", "Inventory", "Inventory");
        $this->MenuItems["Material"]["sub_menu"]["Inventory"]["sub_menu"]["View Inventory"]["menu"] = new MenuItem("ID", "Inventory", "/Inventory/Search");
        $this->MenuItems["Material"]["sub_menu"]["Inventory"]["sub_menu"]["New Inventory Item"]["menu"] = new MenuItem("ID", "New Inventory", "/Inventory/New");

        $this->MenuItems["Material"]["sub_menu"]["IT License"]['Index'] = 3;
        $this->MenuItems["Material"]["sub_menu"]["IT License"]["menu"] = new MenuItem("ID", "IT License", "IT License");
        $this->MenuItems["Material"]["sub_menu"]["IT License"]["sub_menu"]["View Keys"]["menu"] = new MenuItem("ID", "Keys", "/IT License/ViewKeys");
        $this->MenuItems["Material"]["sub_menu"]["IT License"]["sub_menu"]["New Key"]["menu"] = new MenuItem("ID", "New Key", "/IT License/NewKey");


        $this->MenuItems["Organization"]["Index"] = 4;
        $this->MenuItems["Organization"]["menu"] = new MenuItem("ID", "Organization", "Organization");
        $this->MenuItems["Organization"]["sub_menu"]["Clients"]['Index'] = 1;
        $this->MenuItems["Organization"]["sub_menu"]["Facilities"]['Index'] = 2;
        $this->MenuItems["Organization"]["sub_menu"]["Departments"]['Index'] = 3;
        $this->MenuItems["Organization"]["sub_menu"]["Contacts"]['Index'] = 4;

        $this->MenuItems["Organization"]["sub_menu"]["Clients"]["menu"] = new MenuItem("ID", "Clients", "Clients");
        $this->MenuItems["Organization"]["sub_menu"]["Facilities"]["menu"] = new MenuItem("ID", "Facilities", "Facilities");
        $this->MenuItems["Organization"]["sub_menu"]["Departments"]["menu"] = new MenuItem("ID", "Departments", "Departments");
        $this->MenuItems["Organization"]["sub_menu"]["Contacts"]["menu"] = new MenuItem("ID", "Contacts", "Contacts");

        $this->MenuItems["Organization"]["sub_menu"]["Clients"]["sub_menu"]["Clients"]["menu"] = new MenuItem("ID", "Clients", "/Clients/ViewClients");
        $this->MenuItems["Organization"]["sub_menu"]["Clients"]["sub_menu"]["New Client"]["menu"] = new MenuItem("ID", "New Client", "/Clients/NewClient");
        //ViewFacilities
        //ViewClients
        $this->MenuItems["Organization"]["sub_menu"]["Facilities"]["sub_menu"]["Facilities"]["menu"] = new MenuItem("ID", "Facilities", "/Facilities/ViewFacilities");
        $this->MenuItems["Organization"]["sub_menu"]["Facilities"]["sub_menu"]["New Facility"]["menu"] = new MenuItem("ID", "New Facility", "/Facilities/NewFacility");

		$this->MenuItems["Organization"]["sub_menu"]["Departments"]["sub_menu"]["Departments"]["menu"] = new MenuItem("ID", "Departments", "/Departments/ViewDepartments");
        $this->MenuItems["Organization"]["sub_menu"]["Departments"]["sub_menu"]["New Department"]["menu"] = new MenuItem("ID", "New Department", "/Departments/NewDepartment");

        $this->MenuItems["Organization"]["sub_menu"]["Contacts"]["sub_menu"]["View Contacts"]["menu"] = new MenuItem("ID", "Search", "/Contacts/ViewContacts");
        $this->MenuItems["Organization"]["sub_menu"]["Contacts"]["sub_menu"]["New Contacts"]["menu"] = new MenuItem("ID", "New", "/Contacts/NewContact");

        $this->MenuItems["Administration"]["Index"] = 5;
        $this->MenuItems["Administration"]["menu"] = new MenuItem("ID", "Administration", "Administration");

        $this->MenuItems["Administration"]["sub_menu"]["Work Order Type"]['Index'] = 2;
        $this->MenuItems["Administration"]["sub_menu"]["Work Order Type"]["menu"] = new MenuItem("ID", "Work Order Type", "Work Order Type");
        $this->MenuItems["Administration"]["sub_menu"]["Work Order Type"]["sub_menu"]["Search"]["menu"] = new MenuItem("ID", "Search", "/Work Order Type/Search");

        $this->MenuItems["Administration"]["sub_menu"]["Job Library"]['Index'] = 3;
        $this->MenuItems["Administration"]["sub_menu"]["Job Library"]["menu"] = new MenuItem("ID", "Job Library", "Job Library");
        $this->MenuItems["Administration"]["sub_menu"]["Job Library"]["sub_menu"]["Search"]["menu"] = new MenuItem("ID", "Search", "/Job Library/Search");
        $this->MenuItems["Administration"]["sub_menu"]["Job Library"]["sub_menu"]["New"]["menu"] = new MenuItem("ID", "New", "/Job Library/New");

        $this->MenuItems["Administration"]["sub_menu"]["Rate Code"]['Index'] = 4;
        $this->MenuItems["Administration"]["sub_menu"]["Rate Code"]["menu"] = new MenuItem("ID", "Rate Code", "Rate Code");
        $this->MenuItems["Administration"]["sub_menu"]["Rate Code"]["sub_menu"]["Search"]["menu"] = new MenuItem("ID", "Search", "/Rate Code/Search");
        $this->MenuItems["Administration"]["sub_menu"]["Rate Code"]["sub_menu"]["New"]["menu"] = new MenuItem("ID", "New", "/Rate Code/New");

        $this->MenuItems["Administration"]["sub_menu"]["Users"]['Index'] = 5;
        $this->MenuItems["Administration"]["sub_menu"]["Users"]["menu"] = new MenuItem("ID", "Users", "Users");
        $this->MenuItems["Administration"]["sub_menu"]["Users"]["sub_menu"]["View Users"]["menu"] = new MenuItem("ID", "View Users", "/Users/ViewUsers");
        $this->MenuItems["Administration"]["sub_menu"]["Users"]["sub_menu"]["New User"]["menu"] = new MenuItem("ID", "New User", "/Users/NewUser");

		$this->MenuItems["Administration"]["sub_menu"]["Reports"]['Index'] = 6;
        $this->MenuItems["Administration"]["sub_menu"]["Reports"]["menu"] = new MenuItem("ID", "Reports", "Reports");
        $this->MenuItems["Administration"]["sub_menu"]["Reports"]["sub_menu"]["View Reports"]["menu"] = new MenuItem("ID", "View Reports", "/Reports/View");
        $this->MenuItems["Administration"]["sub_menu"]["Reports"]["sub_menu"]["New Report"]["menu"] = new MenuItem("ID", "New Report", "/Reports/New");

        $this->MenuItems["Support"]["Index"] = 6;
        $this->MenuItems["Support"]["menu"] = new MenuItem("ID", "Support", "Support");
        $this->MenuItems["Support"]["sub_menu"]["Suggestion Box"]['Index'] = 1;
        $this->MenuItems["Support"]["sub_menu"]["Suggestion Box"]["menu"] = new MenuItem("ID", "Suggestion Box", "Suggestion Box");
        $this->MenuItems["Support"]["sub_menu"]["Suggestion Box"]["sub_menu"]["New Suggestion"]["menu"] = new MenuItem("ID", "New Suggestion", "/SuggestionBox/NewSuggestion");
        $this->MenuItems["Support"]["sub_menu"]["Suggestion Box"]["sub_menu"]["My Suggestions"]["menu"] = new MenuItem("ID", "My Suggestions", "/SuggestionBox/MySuggestions");
		$this->MenuItems["Support"]["sub_menu"]["Suggestion Box"]["sub_menu"]["Admin"]["menu"] = new MenuItem("ID", "Admin", "/SuggestionBox/Admin");

        //$this->MenuItems["Company Accounts"]["Children"][] = ["icn_add_user", "ID", "Add User", "AddUser"];
        //$this->MenuItems["Users"]["Children"][] = ["icn_view_users", "ID", "View Users", "ViewUser"];
    }

    public function GenerateHeader() {
        ?>
        <?php
    }
    /*
     * <div class="btn"><a href="index.php?action=addcomp">link1</a></div>
        <div class="btn"><a href="index.php?action=addfac">link2</a></div>
        <div class="btn"><a href="index.php?action=adddep">link3</a></div>
        <div class="btn"><a href="index.php?action=viewComp">View Company</a></div>
        <div class="btn"><a href="index.php?action=logout">Logout</a></div>
     */

    private function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
        $sort_col = array();
        foreach ($arr as $key=> $row) {
            $sort_col[$key] = $row[$col];
        }

        array_multisort($sort_col, $dir, $arr);
    }

    public function GenerateMenu() {
        foreach($this->MenuItems as $key => $menu) {
            if($key == "Index")
                continue;
            if(!empty($menu['sub_menu'])) {
                ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown" data-target="#" href="#"><?php echo $menu["menu"]->Name; ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <?php
                    foreach($menu as $subKey => $subValue) {
                        if($subKey == "sub_menu")
                            $this->GenerateMenuItems($subValue); //or whatever you are calling the generic array
                    }
                    ?>
                    </ul>
                </li>
                <?php
            }
            else {
                ?>
            <li><a href="<?php echo $menu["menu"]->Link; ?>"><?php echo $menu["menu"]->Name; ?></a></li>
                <?php
            }
        }
    }

    public function GenerateMenuItems($menus) {
        foreach($menus as $key => $menu) {
            if($key == "Index")
                continue;
            if(!empty($menu['sub_menu'])) {
                ?>
                <li class="dropdown-submenu"><a class="dropdown-toggle" role="button" data-toggle="dropdown" data-target="#" href="#"><?php echo $menu["menu"]->Name; ?></a>
                    <ul class="dropdown-menu">
                    <?php
                    foreach($menu as $subKey => $subValue) {
                        if($subKey == "sub_menu")
                            $this->GenerateMenuItems($subValue); //or whatever you are calling the generic array
                    }
                    ?>
                    </ul>
                </li>
                <?php
            }
            else {
                ?>
            <li><a href="<?php echo $menu["menu"]->Link; ?>"><?php echo $menu["menu"]->Name; ?></a></li>
                <?php
            }
        }
    }
}
?>
