<?php
class ReportGenerator {
    private $tableDefs = array();
    private $con = null;
    private $redis = null;
    public function __construct($dbCon) {
        $thisredis = new Redis();
        $thisredis->connect(ProsonmiaConfig::$RedisHost, ProsonmiaConfig::$RedisPort);
        $thisredis->auth(ProsonmiaConfig::$RedisAuth);
        $this->Initialize($dbCon, $thisredis);
    }
    private function Initialize($dbCon, $_redis) {
        $this->con = $dbCon;
        $this->redis = $_redis;

        $cache = unserialize($this->redis->get("TGTD" . $_SESSION['accountid']));
        if($cache == null) {
            $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
            $result = mysqli_query($this->con, "CALL itm_GetReportTables(". sprintf("%d", $AcctID) .")") or die(mysqli_error($this->con));
            $tables = array();
            while($row = mysqli_fetch_assoc($result)) $tables[] = $row["cola_table"];
            mysqli_free_result($result);
            mysqli_next_result($this->con);
            foreach ($tables as $value) {
                $columns = array();
                $result = mysqli_query($this->con, "CALL itm_GetTableColumnData(". sprintf("%d, '%s'", $AcctID, $value) .")") or die(mysqli_error($this->con));
                while($row = mysqli_fetch_assoc($result)) $columns[] = $row;
                mysqli_free_result($result);
                mysqli_next_result($this->con);
                $this->tableDefs[$value] = $columns;
            }
            $this->redis->set("TGTD" . $_SESSION['accountid'], serialize($this->tableDefs));
            $this->redis->expireat("TGTD" . $_SESSION['accountid'], strtotime("+2 day"));
        }
        else {
            $this->tableDefs = $cache;
        }
    }

    public function GetTables() {
      $tables = array();
      foreach($this->tableDefs as $key=>$val)
        $tables[] = $key;
      return $tables;
    }

    public function GetColumns($table) {
        $columns = array();
        foreach($this->tableDefs[$table] as $key => $value) {
            $itCola = new it_column_labels();
            $itCola->cola_pk = $value["cola_pk"];
            $itCola->cola_acct_fk = $value["cola_acct_fk"];
            $itCola->cola_column = $value["cola_column"];
            $itCola->cola_label = $value["cola_label"];
            $itCola->cola_user_label = $value["cola_user_label"];
            $itCola->cola_table = $value["cola_table"];
            $columns[] = $itCola;
        }
        return $columns;
    }
}
class it_column_labels {
    public $cola_pk = null;
    public $cola_acct_fk = null;
    public $cola_column = null;
    public $cola_label = null;
    public $cola_user_label = null;
    public $cola_table = null;
}
?>
