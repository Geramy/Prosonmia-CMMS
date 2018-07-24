<?php
abstract class BaseAPI {

    protected $TblName = "";
    protected $IndexColumn = "";
    protected $Prefix = "";
    protected $ModuleID;
    private $mapi;
    public function __construct($dbCon) {
        //$this->con = $dbCon;
				$this->mapi = new MySQLIAPI($dbCon);

    }

    public function GetItemDetails($ItemID) { }

    public function ResultSearch($dataArray) { }
    public function OrgSearch($dataArray) { }
    public function ItemIDSearch($AttachedItemID, $ItemType) { }

    public function AutoCompleteSearch($dataArray) { }

    public function QuickEditStart($FieldName) { }
    public function QuickEdit($id, $Value) { }
    public function QuickEditStop($Id, $Value) { }
}
?>
