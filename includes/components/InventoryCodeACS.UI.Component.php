<?php
require_once("AutoComplete.php");
class UIInventoryCodeACS extends AutoComplete {
    /* Start of sub items */
    public static $SubNumber_ListItemOne = 0;
    /* End of sub items. */
    private $sItemList = array();
    
    function __construct() {
        parent::__construct();
    }
    
    public function Initialize($dbCon) {
        include_once("includes/api/WorkOrderAPI.php");
        $woAPI = new WorkOrderAPI($dbCon);
        $results = $woAPI->GetWorkOrderStatus("");
        foreach($results as $ssCode) {
            parent::AddSubItem(AutoComplete::$SubNumber_ListItemOne, array("id" => $ssCode["woss_pk"], "text" => $ssCode["woss_name"]));
        }   
    }
    
    public function HandleNetworkFunction($name, $value, $dbCon) {
        include_once("api/InventoryAPI.php");
        switch($name) {
            case "ACIC":
                $conAPI = new InventoryAPI($dbCon);
                $results = $conAPI->ACSearch($value["id1"]);
                foreach($results as $ssCode) {
                    echo "<a id=\"".$ssCode["inv_pk"]."\" class=\"list-group-item\">" . $ssCode["inv_code"] . "</a>";//rateCode_code   
                }
                if(count($results) < 1) {
                    echo "<a class=\"list-group-item\">No results available.</a>";
                }
                break;
        }
    }
    
    public function GetNetworkingShorthand() {
        return "ACIC";
    }
    
    public function IsImplemented() { return true; }
}
?>