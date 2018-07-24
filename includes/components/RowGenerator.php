<?php
require_once("IHTMLComponent.php");
abstract class RowGenerator implements IHTMLComponent {
    public static $SubNumber_ListItemOne = 0;
    /* End of sub items. */
    private $sItemList = array();
    
    function __construct() {
        
    }
    
    public function Initialize($dbCon) {
        
    }
    
    public function GenerateStaticAddonHtml($KeyValue)
    {
        
    }
    
    public function GenerateAddonJavascript($KeyValue)
    {
        
    }
    
    public function GenerateOnReadyJavascript($KeyValue) {
        
    }
    
    public function AddSubItem($subNumber, $KeyValue)
    {
        
    }
    public function HandleNetworkFunction($name, $value, $dbCon)
    {
        $this->HandleNetworkFunctionPD($name, $value, $dbCon, null);    
    }
    public function HandleNetworkFunctionPD($name, $value, $dbCon, $PostData)
    {
        
    }
    public function GetNetworkingShorthand() {
        return "RG";   
    }
    //If this is a module that is implemented and usable make sure to change this to true so it looks through the module.
    public function IsImplemented() { return false; }
}
?>