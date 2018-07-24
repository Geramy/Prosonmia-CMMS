<?php
require_once("AutoComplete.php");
class UIRateCode extends AutoComplete {
    /* Start of sub items */
    public static $SubNumber_ListItemOne = 0;
    /* End of sub items. */
    private $sItemList = array();
    
    function __construct() {
        parent::__construct();
    }
    
    public function Initialize($dbCon) {
        include_once("includes/api/RateCodeAPI.php");
        $rcAPI = new RateCodeAPI($dbCon);
        $results = $rcAPI->RateCodeSearch();
        foreach($results as $rCode) {
            parent::AddSubItem(AutoComplete::$SubNumber_ListItemOne, array("id" => $rCode["rateCode_pk"], "text" => $rCode["rateCode_code"]));
        }
        if(count($results) < 1) {
            parent::AddSubItem(AutoComplete::$SubNumber_ListItemOne, array("id" => -1, "text" => "No results available."));
        }  
    }
    
    public function HandleNetworkFunction($name, $value, $dbCon) {
        include_once("api/RateCodeAPI.php");
        switch($name) {
            case "ACRCJL":
                $rcAPI = new RateCodeAPI($dbCon);
                $results = $rcAPI->RateCodeACSearch($value["id1"]);
                foreach($results as $rCode) {
                    echo "<a id=\"".$rCode["rateCode_pk"]."\" class=\"list-group-item\">".$rCode["rateCode_code"]."</a>";//rateCode_code   
                }
                if(count($results) < 1) {
                    echo "<a href=\"\" class=\"list-group-item\">No results available.</a>";
                }
                //<a href=\"".$KeyValue["href"]."\" class=\"list-group-item\">".$KeyValue["text"]."</a>"
                break;   
        }
    }
    
    public function GetNetworkingShorthand() {
        return "ACRCJL";   
    }
    
    public function IsImplemented() { return true; }
}
?>