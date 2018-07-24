<?php
require_once("AutoComplete.php");
class UIWOStatusACS extends AutoComplete {
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
        include_once("api/WorkOrderAPI.php");
        switch($name) {
            case "ACSSWO":
                $woAPI = new WorkOrderAPI($dbCon);
                $results = $woAPI->GetWorkOrderStatus($value["id1"]);
                foreach($results as $ssCode) {
                    echo "<a id=\"".$ssCode["woss_pk"]."\" class=\"list-group-item\" >".$ssCode["woss_name"]."</a>";//rateCode_code   
                }
                if(count($results) < 1) {
                    echo "<a class=\"list-group-item\">No results available.</a>";
                }
                break;   
            case "ACSSNWO":
                $woAPI = new WorkOrderAPI($dbCon);
                $results = $woAPI->CreateWorkOrderStatus($value["id1"]);
                echo json_encode($results);
                break;
        }
    }
    
    public function GetNetworkingShorthand() {
        return array("ACSSWO", "ACSSNWO");   
    }
    
    public function IsImplemented() { return true; }
}
?>