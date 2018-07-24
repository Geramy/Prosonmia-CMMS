<?php
require_once("AutoComplete.php");
class UIContactACS extends AutoComplete {
    /* Start of sub items */
    public static $SubNumber_ListItemOne = 0;
    /* End of sub items. */
    private $sItemList = array();
    
    function __construct() {
        parent::__construct();
    }
    
    public function Initialize($dbCon) {
        include_once("includes/api/ContactAPI.php");
        $conAPI = new ContactAPI($dbCon);
        $results = $conAPI->ContactSearchACS(null);
        foreach($results as $ssCode) {
            parent::AddSubItem(AutoComplete::$SubNumber_ListItemOne, array("id" => $ssCode["con_pk"], "text" => $ssCode["con_fname"] . " " . $ssCode["con_lname"]));
        }   
    }
    
    public function HandleNetworkFunction($name, $value, $dbCon) {
        include_once("api/ContactAPI.php");
        switch($name) {
            case "ACCN":
                $conAPI = new ContactAPI($dbCon);
                $results = $conAPI->ContactSearchACS($value["id1"]);
                foreach($results as $ssCode) {
                    echo "<a id=\"".$ssCode["con_pk"]."\" class=\"list-group-item\">".$ssCode["con_fname"] . " " . $ssCode["con_lname"] ."</a>";//rateCode_code   
                }
                if(count($results) < 1) {
                    echo "<a class=\"list-group-item\">No results available.</a>";
                }
                break;
        }
    }
    
    public function GetNetworkingShorthand() {
        return "ACCN";
    }
    
    public function IsImplemented() { return true; }
}
?>