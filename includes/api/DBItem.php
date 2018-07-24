<?php
include_once '/includes/config.php';
class DBItem
{
    private $redis = null;
    private $criteriaList = array();
    private $columns = null;
    private $user_fk = null;
    private $acct_fk = null;
    private $mapi;
    public function __construct($acct_id, $user_id, $dbcon) {
        $this->redis = new Redis();
        $this->connect(ProsonmiaConfig::RedisHost, 6379);
        $this->auth(ProsonmiaConfig::RedisAuth);
        $this->acct_fk = $acct_id;
        $this->user_fk = $user_id;
        $this->mapi = new MySQLIAPI($dbCon);
    }

    public function GetColumns($TableName)
    {
        if($this->redis->exists("dbitem" . $this->acct_fk . $TableName))
            return $this->redis->get($this->acct_fk . $TableName);
        else {

            //$this->redis->set($this->acct_fk, );
            $AcctID = mysqli_escape_string($this->con, $_SESSION['accountid']);
            $sTableName = mysqli_escape_string( $this->con, $TableName);
            //itm_GetTableColumnData
            $result = mysqli_query($this->con, "CALL itm_GetTableColumnData(".sprintf("%d, '%s'", $AcctID, $sTableName).")") or die(mysqli_error($this->con));
            $tableData = array();
            while($row = mysqli_fetch_assoc($result)) $tableData[] = $row;
            mysqli_free_result($result);
            mysqli_next_result($this->con);
            $this->redis->set($this->acct_fk, $tableData);
            $redis->expireat("dbitem" . $this->acct_fk . $TableName, strtotime("+2 day"));
            return $tableData;
        }
    }

    public function AddCriteria($Criteria)
    {

    }

    public function UseColumn($ColumnName, $LabelName)
    {

    }

    public function GenerateData($Columns, $NewLabels)
    {

    }
}
class CriteriaItem
{
    public $RightCriteria = null;
    public $TableNameOne = "";
    public $CompareOne = "";
    public $TableNameTwo = "";
    public $CompareTwo = "";
    public $Operator = "";
    public $Addition = null;
}
?>
