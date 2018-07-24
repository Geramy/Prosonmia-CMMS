<?php
///
/// JQluv.net, Inc. ("COMPANY") CONFIDENTIAL
/// Unpublished Copyright (c) 2009-2010 [COMPANY NAME], All Rights Reserved.
///
/// NOTICE:  All information contained herein is, and remains the property of COMPANY. The intellectual and technical concepts contained
/// herein are proprietary to COMPANY and may be covered by U.S. and Foreign Patents, patents in process, and are protected by trade secret or copyright law.
/// Dissemination of this information or reproduction of this material is strictly forbidden unless prior written permission is obtained
/// from COMPANY.  Access to the source code contained herein is hereby forbidden to anyone except current COMPANY employees, managers or contractors who have executed
/// Confidentiality and Non-disclosure agreements explicitly covering such access.
///
/// The copyright notice above does not evidence any actual or intended publication or disclosure  of  this source code, which includes
/// information that is confidential and/or proprietary, and is a trade secret, of  COMPANY.   ANY REPRODUCTION, MODIFICATION, DISTRIBUTION, PUBLIC  PERFORMANCE,
/// OR PUBLIC DISPLAY OF OR THROUGH USE  OF THIS  SOURCE CODE  WITHOUT  THE EXPRESS WRITTEN CONSENT OF COMPANY IS STRICTLY PROHIBITED, AND IN VIOLATION OF APPLICABLE
/// LAWS AND INTERNATIONAL TREATIES.  THE RECEIPT OR POSSESSION OF  THIS SOURCE CODE AND/OR RELATED INFORMATION DOES NOT CONVEY OR IMPLY ANY RIGHTS
/// TO REPRODUCE, DISCLOSE OR DISTRIBUTE ITS CONTENTS, OR TO MANUFACTURE, USE, OR SELL ANYTHING THAT IT  MAY DESCRIBE, IN WHOLE OR IN PART.
///
?>
<?php
    $dbhost = 'DB_IP';
    $dbusername = 'DB_USER';
    $dbpassword = 'DB_PASSWORD';
    $dbdatabase = 'DB_NAME';
	$dbCon = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbdatabase) or die("Database Offline, please try again later!");
function CleanMysqliBuffer($con) {
    $res = null;
    while (mysqli_more_results($con))
    {
        if(mysqli_next_result($con))
            if(($res = mysqli_store_result($con)) instanceof mysqli_result) // added closing bracket
                mysqli_free_result($result);
    }
}

$coni = new mysqli($dbhost, $dbusername, $dbpassword, $dbdatabase, 3306) or die('Could not connect to the database server' . mysqli_connect_error());

class MySQLIAPI
{
    private $con = null;
    private $Variables = null;
    private $values = null;
    private $types = null;
    private $vQu = null;
    private $stmt = null;
    function __construct($dbc)
    {
        $this->con = $dbc;
 		    $this->Variables = [];
        $this->values = [];
        $this->types = [];
        $this->vQu = [];
    }
    function BeginProc()
    {
        $this->stmt = $this->con->stmt_init(); // initialize statement
    }

    function AddParameter($key, $val, $type)
    {
        $this->Variables[] = "@" . $key;
        $this->values[]    = $val;
        $this->types[]     = $type;
        $this->vQu[]       = "?";
    }

    //KeyPair is v = the value, t = the type s or d
    function CallProc($Proc) {
      $out_var = null;

      $call = "";
      if(sizeof($this->values) > 0)
        $call = "CALL ".$Proc."(".implode(",", (array)$this->vQu).")";
      else
        $call = "CALL ".$Proc."()";

     if($this->stmt->prepare($call));//call stored procedure with database server session variable
     {
       if(sizeof($this->values) > 0) {
         $params = array_merge(array(implode("", $this->types)), $this->values);
         call_user_func_array(array($this->stmt, 'bind_param'), $this->refValues($params));
       }

       $this->stmt->execute();
       $result = $this->stmt->get_result();

       /* Error Checking */
       $mySQLiError = mysqli_stmt_error($this->stmt);
       if ($mySQLiError != "") {
         $this->resetStmt();
         $this->stmt->close();
         $this->stmt = null;
         return array('mysql_error' => $mySQLiError);
       }

       while ($row = $result->fetch_array(MYSQLI_ASSOC))
       {
         $out_var[] = $row;
       }
       $result->free();
       $this->stmt->next_result();
       $this->resetStmt();
       $this->stmt->close();
       $this->stmt = null;
     }

     return $out_var;
    }
    public function FetchObjects($Proc, $class) {
      //fetch_object
      $out_var = null;

      $call = "";
      if(sizeof($this->values) > 0)
        $call = "CALL ".$Proc."(".implode(",", (array)$this->vQu).")";
      else
        $call = "CALL ".$Proc."()";

     if($this->stmt->prepare($call));//call stored procedure with database server session variable
     {
       if(sizeof($this->values) > 0) {
         $params = array_merge(array(implode("", $this->types)), $this->values);
         call_user_func_array(array($this->stmt, 'bind_param'), $this->refValues($params));
       }

       $this->stmt->execute();
       $result = $this->stmt->get_result();

       /* Error Checking */
       $mySQLiError = mysqli_stmt_error($this->stmt);
       if ($mySQLiError != "") {
         $this->resetStmt();
         $this->stmt->close();
         $this->stmt = null;
         return array('mysql_error' => $mySQLiError);
       }

       while ($row = $result->fetch_object($class))
       {
         //echo var_dump($row);
         $out_var[] = $row;
       }
       $result->free();
       while($this->stmt->more_results())
       {
         $this->stmt->next_result();
       }

       $this->resetStmt();
       $this->stmt->close();
       $this->stmt = null;
     }

     return $out_var;
    }
    private function refValues($arr)
    {
        if (strnatcmp(phpversion(), '5.3') >= 0) //Reference is required for PHP 5.3+
            {
            $refs = array();
            foreach ($arr as $key => $value)
                $refs[$key] =& $arr[$key];
            return $refs;
        }
        return $arr;
    }
    private function resetStmt()
    {
        //Reset Params
        $this->Variables = array();
        $this->values    = array();
        $this->types     = array();
        $this->vQu       = array();
    }
}
?>
