<?php
require_once("AutoComplete.php");
class UIJobLibrary extends AutoComplete {
    /* Start of sub items */
    public static $SubNumber_ListItemOne = 0;
    /* End of sub items. */
    private $sItemList = array();

    function __construct() {
        parent::__construct();
    }

    public function Initialize($dbCon) {
        include_once("includes/api/JobAPI.php");
        $jbAPI = new JobAPI($dbCon);
        $results = $jbAPI->JobListSearch(null);
        foreach($results as $jCode) {
            parent::AddSubItem(AutoComplete::$SubNumber_ListItemOne, array("id" => $jCode["jobl_pk"], "text" => $jCode["jobl_code"]));
        }
        if(count($results) < 1) {
            parent::AddSubItem(AutoComplete::$SubNumber_ListItemOne, array("id" => -1, "text" => "No results available."));
        }
    }

    public function HandleNetworkFunction($name, $value, $dbCon) {
        include_once("api/JobAPI.php");
        switch($name) {
            case "ACJOBCS":
                $jbAPI = new JobAPI($dbCon);
                $results = $jbAPI->JobListSearch($value["id1"]);
                foreach($results as $jCode) {
                    echo "<a id=\"".$jCode["jobl_pk"]."\" class=\"list-group-item\">".$jCode["jobl_code"]."</a>";//rateCode_code
                }
                if(count($results) < 1) {
                    echo "<a href=\"\" class=\"list-group-item\">No results available.</a>";
                }
                //<a href=\"".$KeyValue["href"]."\" class=\"list-group-item\">".$KeyValue["text"]."</a>"
                break;
        }
    }

    public function GetNetworkingShorthand() {
        return "ACJOBCS";
    }

    public function IsImplemented() { return true; }
}
?>
