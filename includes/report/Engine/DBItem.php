<?php
class DBItem
{
    public $Filter = null;
    public $Parameter = null;
    
    
    public $row = null;
    public $column = null;
    
    public $cola_pk = null;
    public $acct_fk = null;
    
    private $conn = null;
    
    public function __construct($dbCon) {
        
    }
    
    public function __destruct() {
        
    }
}
?>