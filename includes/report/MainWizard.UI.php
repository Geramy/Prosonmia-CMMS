<?php
include_once("Engine/ReportCache.php");
include_once("IDropDown.php");
class MainWizard extends IDropDown {
    /* Start of sub items */
    public static $SubNumber_ListItemOne = 0;
    /* End of sub items. */
    private $sItemList = array();
    private $redis = null;
    private $RWDMS = null;
    function __construct() {
        parent::__construct();
        $this->redis = new Redis();
        $this->redis->connect(ProsonmiaConfig::$RedisHost, ProsonmiaConfig::$RedisPort);
        $this->redis->auth(ProsonmiaConfig::$RedisAuth);
        $this->rCache = new ReportCache($this->redis);
    }

    public function Initialize($dbCon, $keyValue) {
        parent::Initialize($dbCon, $keyValue);
        $results[0]["id"] = "0";
        $results[0]["name"] = "Basic List";
        $results[1]["id"] = "1";
        $results[1]["name"] = "Advanced List";
        foreach($results as $liData) {
            parent::AddSubItem(IDropDown::$SubNumber_ListItemOne, array("id" => $liData["id"], "text" => $liData["name"]));
        }
    }

    public function HandleNetworkFunction($name, $value, $dbCon) {
        $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
        switch($name) {
            case "RWDMWS":
                $this->RWDMS = array("id" => $value["id1"], "report_name" => $value["id2"]);
                $this->redis->set("RWDMS" . $AcctID, $this->RWDMS);
                $this->redis->expireat("RWDMS" . $AcctID, strtotime("+2 day"));
                $this->rCache->SetReportName($value["id2"]);
                break;
        }
    }

    public function GetNetworkingShorthand() {
        return array("RWDMWS");
    }

    public function IsImplemented() { return true; }
}
?>
