<?php
require_once("RowGenerator.php");
class UIRentShipmentRG extends RowGenerator {
    public static $SubNumber_ListItemOne = 0;
    /* End of sub items. */
    private $sItemList = array();
    private $con = null;
    
    function __construct() {
        
    }
    
    public function Initialize($dbCon) {
        $this->con = $dbCon;
    }
    
    public function GenerateStaticAddonHtml($KeyValue)
    {
        
    }
    
    public function GenerateAddonJavascript($KeyValue)
    {
        ?>
        if($.fn.SaveRecordRSTRGSR == undefined) {
            $.fn.SaveRecordRSTRGSR = function() {
                var that = this;
                var MainID = <?php echo $KeyValue["id"]; ?>;
                var startDate = $(this).find("[name='stra_start_date']").val();
                var endDate = $(this).find("[name='stra_end_date']").val();
                var trackingNumber = $(this).find("[name='stra_tracking_number']").val();
                $.ajax({
                  method: "POST",
                  url: "/includes/itasm.networking.php",
                  data: { RQ: "HTMLC", Method: "RG", id: "RSTRGSR", stra_start_date: startDate, stra_end_date: endDate, stra_tracking_number: trackingNumber, item_fk: MainID }
                })
                .done(function( msg ) {
                    if(msg > -1) {
                        reload();
                        $(".submission_error").append("Tracking History has been successfully added");
                        $('.submission_error').show();
                        setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);
                        $(that).find("input").each()
                    }
                    else {
                        //error failure something went wrong
                    }
                });
            };
        }
        <?php
    }
    
    public function GenerateOnReadyJavascript($KeyValue) {
        ?>
        if($.fn.NewRecordRSTRGSR == undefined) {
            $.fn.NewRecordRSTRGSR = function(comp_mod, hasDate) {
                var action = "HTMLC";
                var module = "RG";
                var $this = this;
                $.ajax({
                  method: "POST",
                  url: "/includes/itasm.networking.php",
                  data: { RQ: action, Method: module, "id": comp_mod }
                })
                .done(function( msg ) {
                    $($this).append(msg);
                    if(hasDate)
                        $('.date').datepicker({});
                    $(".pros-save-record").on("click", function(evt) {
                       $(this).parent().parent().SaveRecordRSTRGSR(); 
                    });
                });
            };
        }
        <?php
    }
    
    public function AddSubItem($subNumber, $KeyValue)
    {
        
    }
    
    public function HandleNetworkFunctionPD($name, $value, $dbCon, $PostData)
    {
        switch($name) {
            case "RSTRG":
                ?>
                <tr class="pros_edit_row">
                    <td>
                        <div class="input-group date">
                            <input data-format="dd/MM/yyyy hh:mm" class="form-control input-sm col-xs-6 col-md-4" type="text" name="stra_start_date" placeholder="" value="" />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm date">
                            <input data-format="dd/MM/yyyy hh:mm" class="form-control input-sm col-xs-6 col-md-4" type="text" name="stra_end_date" placeholder="" value="" />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm pros_track_id">
                            <input class="form-control input-sm" type="text" name="stra_tracking_number" placeholder="" value="" />
                        </div>
                    </td>
                    <td>
                        <i class="fa fa-fw fa-minus-circle pros-minus-record"></i>
                    </td>
                    <td>
                        <i class="fa fa-fw fa-save pros-save-record"></i>
                    </td>
                </tr>
                <?php
                break; 
            case "RSTRGSR"://submit code to db
                include_once("api/ShippingAPI.php");
                include_once("api/ShipmentTrackingAPI.php");
                $ship_fk = NULL;
                $shipCore = new ShippingAPI($this->con);
                $details = $shipCore->GetDetails($PostData["item_fk"], 2);
                if($details != null && key_exists("ship_pk", $details)) {
                    $ship_fk = $details["ship_pk"];
                }
                else {
                    $ship_fk = $shipCore->itm_CreateShipmentDetails(2, $PostData["item_fk"], "");
                    $ship_fk = $ship_fk["ship_pk"];
                }
                $shiptrack = new ShipmentTrackingAPI($this->con);
                $recordSave = $shiptrack->itm_CreateShipTrack($ship_fk, $PostData["stra_start_date"], $PostData["stra_end_date"], $PostData["stra_tracking_number"], null);
                
                echo $recordSave["ship_sub_pk"];
                break; 
            default:
                echo $name . " Doesnt exist";
                break;
        }
    }
    
    public function GetNetworkingShorthand() {
        return array("RSTRG", "RSTRGSR");   
    }
    
    public function IsImplemented() { return true; }
}
?>