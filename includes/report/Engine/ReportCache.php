<?php
class ReportCache {
    private $_redis = null;
    private $reportDb = null;
    public function __construct($redis) {
        $this->_redis = $redis;
    }

    public function SetReportName($nm) {
      if($this->reportDb == null)
        $this->GetMainReportTable();
      $this->reportDb["ReportName"] = $nm;
    }

    public function GetMainReportTable() {
        if($this->reportDb == null)
            $this->reportDb = unserialize($this->_redis->get("ReportWizard" . $_SESSION["userid"]));
        return $this->reportDb["MainReport"]["table"];
    }

    public function SetReportColumn($dbID, $htmlID) {
      if($this->reportDb == null)
        $this->GetMainReportTable();
      $this->reportDb["mapped-column"][$htmlID] = $dbID;
    }

    public function SetMainReportTable($TableName) {
        if($this->reportDb == null)
            $this->reportDb = array();
        $this->reportDb["MainReport"]["table"] = $TableName;
        $this->_redis->set("ReportWizard" . $_SESSION["userid"], serialize($this->reportDb));
        $this->_redis->expireat("ReportWizard" . $_SESSION["userid"], strtotime("+2 day"));
    }
}

?>
