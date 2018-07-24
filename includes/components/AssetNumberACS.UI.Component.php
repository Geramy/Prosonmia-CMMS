<?php
require_once("AutoComplete.php");
class UIAssetNumberACS extends AutoComplete {
    /* Start of sub items */
    public static $SubNumber_ListItemOne = 0;
    /* End of sub items. */
    private $sItemList = array();
    
    public function HandleNetworkFunction($name, $value, $dbCon) {
        include_once("api/EquipmentAPI.php");
        switch($name) {
            case "ACANWO":
                $eqAPI = new EquipmentAPI($dbCon);
                $results = $eqAPI->EquipmentACSearch("NULL", "NULL", "NULL", $value["id1"]);
                foreach($results as $anCode) {
                    echo "<a id=\"".$anCode["eq_pk"]."\" class=\"list-group-item\">".$anCode["eq_code"]."</a>";//rateCode_code   
                }
                if(count($results) < 1) {
                    echo "<a class=\"list-group-item\">No results available.</a>";
                }
                //<a href=\"".$KeyValue["href"]."\" class=\"list-group-item\">".$KeyValue["text"]."</a>"
                break;   
        }
    }
    
    public function GetNetworkingShorthand() {
        return "ACANWO";   
    }
    
    public function IsImplemented() { return true; }
}
?>