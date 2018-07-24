<?php
require_once("IHTMLComponent.php");
class NewRecordItem {
    public static $TextView = 0;
    public static $EditText = 1;
    public static $CheckBox = 2;
    public static $DateTime = 3;
    public static $Button = 4;
    public $FieldName = "";
    public $DefaultValue = "";
    public $FieldID = "";
    public $FieldName = "";
    public $FieldType = 0;
}
abstract class NewRecordDialog implements IHTMLComponent {
    public static $SubNumber_ListItemOne = 0;
    /* End of sub items. */
    private $sItemList = array();
    
    function __construct() {
        
    }
    
    public function Initialize($dbCon) {
        
    }
    
    public function GenerateStaticAddonHtml($KeyValue)
    {
        ?>
        <div id="<?php echo $KeyValue["container-id"]; ?>" style="display: none;">
            <?php echo $KeyValue["header"]; ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                          <div class="input-group input-group-sm">
                                <input type="text" class="form-control input-sm" name="<?php echo $KeyValue["name"]; ?>" id="<?php echo $KeyValue["id"]; ?>" placeholder="<?php echo $KeyValue["placeholder"]; ?>" />
                            </div>
                        </div>
                        <div class="list-group">
                            <?php
                            if(array_key_exists(AutoComplete::$SubNumber_ListItemOne, $this->sItemList)) {
                                foreach($this->sItemList[AutoComplete::$SubNumber_ListItemOne] as $element) {
                                    echo $element;   
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    public function GenerateAddonJavascript($KeyValue)
    {
        ?>
        var <?php echo $KeyValue["container-id"]; ?>BOXObj = null;
        <?php echo $KeyValue["container-id"]; ?>AttatchToOAC = function() {
            $("#<?php echo $KeyValue["container-id"]; ?> > div > div > div > div > a").on('click', function() {
                $("<?php echo $KeyValue["onclick"]; ?> > input").val($(this).html());
                $("<?php echo $KeyValue["onclick"]; ?> > input").data("pk", $(this).attr('id'));
                $(".bootbox-close-button").click();
            });
        };
        <?php
        if(array_key_exists("extrasave_shorthand", $KeyValue)) {
            echo $KeyValue["extrasave_shorthand"]; ?>CreateOAC = function() {
                $.ajax({
                  type: "POST",
                  url: "/includes/itasm.networking.php",
                  data: { RQ: "HTMLC", Method: "AC", id: "<?php echo $KeyValue["extrasave_shorthand"]; ?>", id1: $("input[name=<?php echo $KeyValue["name"]; ?>]").val() },
                  success: function(data) { if(data["completed"] >= 0) alert("Record Created!"); },
                  dataType: "json"
                });
            };
            <?php
        }
        ?>
        $.fn.<?php echo $KeyValue["container-id"]; ?>OAC = function() {
            $("#<?php echo $KeyValue["container-id"]; ?>").css("display", "");
            <?php echo $KeyValue["container-id"]; ?>BOXObj = bootbox.dialog({
              onEscape: function() { $(".bootbox-holder").append($("#<?php echo $KeyValue["container-id"]; ?>")); },
              message: $("#<?php echo $KeyValue["container-id"]; ?>"),
              title: "<?php echo $KeyValue["title"]; ?>",
              buttons: {
                success: {
                  label: "<?php echo $KeyValue["success_label"]; ?>",
                  className: "btn-success",
                  callback: function() {
                      <?php echo $KeyValue["onsave"]; ?>
                      $(".bootbox-holder").append($("#<?php echo $KeyValue["container-id"]; ?>"));
                  }
                },
                create: {
                  label: "<?php echo $KeyValue["extra_button_label"]; ?>",
                  className: "btn-cancel",
                    callback: function() { 
                        <?php
                        if($KeyValue["onextrasave"] != null) {
                        ?>
                            <?php echo $KeyValue["onextrasave"]; ?> 
                            <?php
                        } else if(array_key_exists("extrasave_shorthand", $KeyValue)) {
                            echo $KeyValue["extrasave_shorthand"]; ?>CreateOAC();
                            <?php echo $KeyValue["container-id"] ?>AttatchToOAC();
                        <?php
                        }
                        ?>
                        $(".bootbox-holder").append($("#<?php echo $KeyValue["container-id"] ?>")); 
                    }
                }
              }
            });
            <?php
            $ShortHandRQList = $this->GetNetworkingShorthand();
            if(is_array($ShortHandRQList )) {
                $ShortHandRQList = $ShortHandRQList[0];
            }
            ?>
            $("#<?php echo $KeyValue["id"]; ?>").ready(function() {
                $("#<?php echo $KeyValue["id"]; ?>").on('input', function(e) { 
                    $.ajax({
                      method: "POST",
                      url: "/includes/itasm.networking.php",
                      data: { RQ: "HTMLC", Method: "AC", id: "<?php echo $ShortHandRQList; ?>", id1: $(this).val() }
                    })
                    .done(function( hdata ) {
                        $("#<?php echo $KeyValue["container-id"] ?> .list-group").html(hdata);
                        <?php echo $KeyValue["container-id"] ?>AttatchToOAC();
                    });
                });
            });
        };
        <?php
    }
    
    public function GenerateOnReadyJavascript($KeyValue) {
        ?>
        $("<?php echo $KeyValue["onclick"]; ?>").on("click", function() {
            $(this).<?php echo $KeyValue["container-id"] ?>OAC();
        });
        <?php
    }
    
    public function AddSubItem($NRItem)
    {
        switch($NRItem->FieldType) {
            case NewRecordItem::$TextView:
                $this->sItemList[$subNumber][] = "<a id=\"".$KeyValue["id"]."\" class=\"list-group-item\">".$KeyValue["text"]."</a>";
                break;
            case NewRecordItem::$EditText:
                break;
            case NewRecordItem::$DateTime:
                break;
            case NewRecordItem::$CheckBox:
                break;
            case NewRecordItem::$Button:
                break;
        }
    }
    public function HandleNetworkFunction($name, $value, $dbCon)
    {
        
    }
    
    public function GetNetworkingShorthand() {
        return "AC";   
    }
    
    public function IsImplemented() { return false; }
}
?>