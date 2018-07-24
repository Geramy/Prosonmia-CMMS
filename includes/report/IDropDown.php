<?php
require_once("IReportComponent.php");
abstract class IDropDown implements IReportComponent {
    public static $SubNumber_ListItemOne = 0;
    /* End of sub items. */
    private $sItemList = array();
    public $keyValue = null;
    protected $con = null;
    function __construct() {
        
    }
    
    public function Initialize($dbCon, $KeyValue) {
        $this->con = $dbCon;
        $this->keyValue = $KeyValue;
    }
    
    public function GenerateStaticAddonHtml()
    {
        if($this->keyValue["onsave"] == "selected_item") {
            ?>
            <form id="<?php echo $this->keyValue["container-id"]; ?>form" style="display: none;", action="" method="POST">
                
            </form>
            <?php
        }
        ?>
        <div id="<?php echo $this->keyValue["container-id"]; ?>" style="display: none;">
            <?php echo $this->keyValue["header"]; ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                          <div class="input-group input-group-sm">
                                <label><?php echo $this->keyValue["placeholder"]; ?></label>
                                <input type="text" class="form-control input-sm" name="<?php echo $this->keyValue["name"]; ?>" id="<?php echo $this->keyValue["id"]; ?>" placeholder="<?php echo $this->keyValue["placeholder"]; ?>" />
                            </div>
                        </div>
                        <div class="list-group">
                            <?php
                            if(array_key_exists(IDropDown::$SubNumber_ListItemOne, $this->sItemList)) {
                                foreach($this->sItemList[IDropDown::$SubNumber_ListItemOne] as $element) {
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
    
    public function GenerateAddonJavascript()
    {
        //AttachToOAC is the onclick setter of the dialog items.
        ?>
        var <?php echo $this->keyValue["container-id"]; ?>BOXObj = null;
        <?php echo $this->keyValue["container-id"]; ?>AttatchToOAC = function() {
            $("#<?php echo $this->keyValue["container-id"]; ?> > div > div > div > div > a").on('click', function() {
                $(this).parent().find(".active").each(function(i) {
                    $(this).removeClass("active");
                });
                $(this).addClass("active");
            });
        };
        <?php
        //call function rpivate
        $this->CreateNetworkingSnippet("save_shorthand", $this->keyValue["name"], $this->keyValue["container-id"]);
        $this->CreateNetworkingSnippet("extrasave_shorthand", $this->keyValue["name"], $this->keyValue["container-id"]);
        ?>
        $.fn.<?php echo $this->keyValue["container-id"]; ?>OAC = function() {
            $("#<?php echo $this->keyValue["container-id"]; ?>").css("display", "");
            <?php echo $this->keyValue["container-id"]; ?>BOXObj = bootbox.dialog({
              onEscape: function() { $(".bootbox-holder").append($("#<?php echo $this->keyValue["container-id"]; ?>")); },
              message: $("#<?php echo $this->keyValue["container-id"]; ?>"),
              title: "<?php echo $this->keyValue["title"]; ?>",
              buttons: {
                success: {
                  label: "<?php echo $this->keyValue["success_label"]; ?>",
                  className: "btn-success",
                  callback: function() {
                    <?php
                        if($this->keyValue["onsave"] instanceof IDropDown) {
                    ?>
                            <?php echo $this->keyValue["extrasave_shorthand"]; ?>CreateOAC();
                            $(this).<?php echo $this->keyValue["onsave"]->keyValue["container-id"]; ?>OAC();
                    <?php
                        }
                        else if($this->keyValue["onsave"] == "selected_item") {
                            if(array_key_exists("save_shorthand", $this->keyValue)) 
                                echo $this->keyValue["save_shorthand"]; ?>CreateOAC();
                            $("#<?php echo $this->keyValue["container-id"];?>form").prop("action", "New/" + $("#<?php echo $this->keyValue["container-id"];?> .active").prop("id"));
                            $("#<?php echo $this->keyValue["container-id"];?>form").submit();
                            <?php
                        }
                        else {
                            echo $this->keyValue["onsave"];
                    ?>
                            $(".bootbox-holder").append($("#<?php echo $this->keyValue["container-id"]; ?>"));
                    <?php
                        }
                    ?>
                  }
                },
                create: {
                  label: "<?php echo $this->keyValue["extra_button_label"]; ?>",
                  className: "btn-cancel",
                    callback: function() { 
                        <?php
                            if($this->keyValue["onextrasave"] instanceof IDropDown) {
                                echo "$(this)." . $this->keyValue["extrasave_shorthand"]; ?>CreateOAC();
                                echo "$(this)." . $this->keyValue["onextrasave"]->keyValue["container-id"]."OAC();";
                            }
                            else if($this->keyValue["onextrasave"] != null) {
                            ?>
                                <?php echo $this->keyValue["onextrasave"]; ?> 
                                <?php
                            } else if(array_key_exists("extrasave_shorthand", $this->keyValue)) {
                                echo $this->keyValue["extrasave_shorthand"]; ?>CreateOAC();
                                <?php echo $this->keyValue["container-id"] ?>AttatchToOAC();
                            <?php
                            }
                        ?>
                        $(".bootbox-holder").append($("#<?php echo $this->keyValue["container-id"] ?>")); 
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
            $("#<?php echo $this->keyValue["id"]; ?>").ready(function() {
                <?php echo $this->keyValue["container-id"] ?>AttatchToOAC();
                <?php
                if(array_key_exists("autocomplete", $this->keyValue) && $this->keyValue["autocomplete"] == true) {
                    ?>
                    $("#<?php echo $this->keyValue["id"]; ?>").on('input', function(e) { 
                        $.ajax({
                          method: "POST",
                          url: "/includes/itasm.networking.php",
                          data: { RQ: "HTMLC", Method: "RP", id: "<?php echo $ShortHandRQList; ?>", id1: $(this).val() }
                        })
                        .done(function( hdata ) {
                            $("#<?php echo $this->keyValue["container-id"] ?> .list-group").html(hdata);
                            <?php echo $this->keyValue["container-id"] ?>AttatchToOAC();
                        });
                    });
                    <?php
                }
                ?>
            });
        };
        <?php
    }
    
    public function GenerateOnReadyJavascript() {
        if(array_key_exists("onclick", $this->keyValue)) {
            ?>
            $("<?php echo $this->keyValue["onclick"]; ?>").on("click", function() {
                $(this).<?php echo $this->keyValue["container-id"] ?>OAC();
            });
            <?php
        }
        if(array_key_exists("onload", $this->keyValue)) {
            ?>
            $("<?php echo $this->keyValue["onload"]; ?>").ready(function() {
                $(this).<?php echo $this->keyValue["container-id"] ?>OAC();
            });
            <?php
        }
    }
    
    public function AddSubItem($subNumber, $items)
    {
        switch($subNumber) {
            case IDropDown::$SubNumber_ListItemOne:
                $this->sItemList[$subNumber][] = "<a id=\"".$items["id"]."\" class=\"list-group-item\">".$items["text"]."</a>";
                break;
                
        }
    }
    public function HandleNetworkFunction($name, $value, $dbCon)
    {
        
    }
    private function CreateNetworkingSnippet($key, $name, $containerId) {
       if(array_key_exists($key, $this->keyValue)) {
        ?>
            var <?php echo $this->keyValue[$key]; ?>CreateOAC = function() {
            $.ajax({
                      type: "POST",
                      url: "/includes/itasm.networking.php",
                      data: { RQ: "HTMLC", Method: "RP", id: "<?php echo $this->keyValue[$key]; ?>", 
                                id1: $("input[name=<?php echo $name; ?>]").val(),
                                id2: $("#<?php echo $containerId; ?> .active").prop("id") },
                      success: function(data) { },
                      dataType: "json"
                    });
            }
            <?php
        }
    }
    
    public function GetNetworkingShorthand() {
        return "RP";   
    }
    
    public function IsImplemented() { return false; }
}
?>