<?php
include_once("IDropDown.php");
include_once("Engine/ReportCache.php");
class ModuleSelector extends IDropDown {
    /* Start of sub items */
    public static $SubNumber_ListItemOne = 0;
    private $redis = null;
    /* End of sub items. */
    private $sItemList = array();
    private $rCache = null;
    
    function __construct() {
        parent::__construct();
        $this->redis = new Redis();
        $this->redis->connect(ProsonmiaConfig::$RedisHost, 6379);
        $this->redis->auth(ProsonmiaConfig::$RedisAuth);
        $this->rCache = new ReportCache($this->redis);
    }
    
    public function Initialize($dbCon, $keyValue) {
        parent::Initialize($dbCon, $keyValue);
        $results[0]["id"] = 0;
        $results[0]["name"] = "Equipment";
        
        $results[1]["id"] = 1;
        $results[1]["name"] = "Work Order";
        
        $results[2]["id"] = 2;
        $results[2]["name"] = "Inventory";
        
        $results[3]["id"] = 3;
        $results[3]["name"] = "Shipping";
        
        $results[4]["id"] = 4;
        $results[4]["name"] = "Rent";
        
        foreach($results as $liData) {
            parent::AddSubItem(IDropDown::$SubNumber_ListItemOne, array("id" => $liData["id"], "text" => $liData["name"]));
        }   
    }
    
    public function HandleNetworkFunction($name, $value, $dbCon) {
        switch($name) {
            case "RWMS":
                switch($value["id2"]) {
                    case "0":
                        $this->rCache->SetMainReportTable("it_equip");
                        break;
                    case "1":
                        $this->rCache->SetMainReportTable("it_workorder");
                        break;
                }
                break;
        }
    }
    
    public function GetNetworkingShorthand() {
        return array("RWMS");   
    }
    
    public function IsImplemented() { return true; }
}
?>