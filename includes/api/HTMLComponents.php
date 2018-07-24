<?php
class HTMLComponents
{
    public function __construct() {
        
    }
    
    public function GetSingleSelector($jsVarName, $Title, $textID, $plHolder) {
        
        return "var " . $jsVarName . "= \"" . $this->GetSingleSearchSelector($Title, $textID, $plHolder) . "\";"; 
    }
    
    private function GetSingleSearchSelector($message, $textID, $placeHolder) {
        ob_start();
        include "includes/components/SingleSelectorDialog.html";
        $Selector = ob_get_contents();
        ob_end_clean();
        
        $Selector = str_replace("%HEADER%", $message, $Selector);
        $Selector = str_replace(array("\n", "\r"), ' ', $Selector);
        $Selector = str_replace('"', "'", $Selector);
        $Selector = str_replace("%NAME%", $textID, $Selector);
        $Selector = str_replace("%ID%", $textID, $Selector);
        $Selector = str_replace("%PLACEHOLDER%", $placeHolder, $Selector);
        return $Selector;
    }
}
?>