<?php
interface IHTMLComponent
{
    public function GenerateStaticAddonHtml($KeyValue);
    public function GenerateAddonJavascript($KeyValue);
    public function GenerateOnReadyJavascript($KeyValue);
    public function AddSubItem($subNumber, $KeyValue);
    public function HandleNetworkFunction($fnName, $value, $dbCon);
    public function GetNetworkingShorthand();
    public function IsImplemented();
    public function Initialize($dbCon);
}
?>