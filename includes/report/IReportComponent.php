<?php
interface IReportComponent
{
    public function Initialize($dbCon, $keyValue);
    public function GenerateStaticAddonHtml();
    public function GenerateAddonJavascript();
    public function GenerateOnReadyJavascript();
    public function AddSubItem($subNumber, $items);
    public function HandleNetworkFunction($fnName, $value, $dbCon);
    public function GetNetworkingShorthand();
    public function IsImplemented();
}
?>