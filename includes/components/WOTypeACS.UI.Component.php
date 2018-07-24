<?php
require_once("AutoComplete.php");
class UIWOTypeACS extends AutoComplete {
    /* Start of sub items */
    public static $SubNumber_ListItemOne = 0;
    /* End of sub items. */
    private $sItemList = array();
    
    function __construct() {
        parent::__construct();
    }
    
    public function Initialize($dbCon) {
        include_once("includes/api/WorkOrderTypeAPI.php");
        $woAPI = new WorkOrderTypeAPI($dbCon);
        $results = $woAPI->SearchACS(null);
        foreach($results as $ssCode) {
            parent::AddSubItem(AutoComplete::$SubNumber_ListItemOne, array("id" => $ssCode["wtype_pk"], "text" => $ssCode["wtype_name"]));
        }   
    }
    
    public function HandleNetworkFunction($name, $value, $dbCon) {
        include_once("api/WorkOrderTypeAPI.php");
        switch($name) {
            case "ACSWOT":
                $woAPI = new WorkOrderTypeAPI($dbCon);
                $results = $woAPI->SearchACS($value["id1"]);
                foreach($results as $ssCode) {
                    echo "<a id=\"".$ssCode["wtype_pk"]."\" class=\"list-group-item\">".$ssCode["wtype_name"]."</a>";//rateCode_code   
                }
                if(count($results) < 1) {
                    echo "<a class=\"list-group-item\">No results available.</a>";
                }
                break;   
            case "ACSWOTN":
                $woAPI = new WorkOrderAPI($dbCon);
                $results = $woAPI->CreateWorkOrderType($value["id1"]);
                echo json_encode($results);
                break;
        }
    }
    
    public function GetNetworkingShorthand() {
        return array("ACSWOT", "ACSWOTN");   
    }
    
    public function IsImplemented() { return true; }
}
?>