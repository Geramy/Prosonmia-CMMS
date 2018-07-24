<?php
require_once("AutoComplete.php");
class UIWOContactACS extends AutoComplete {
    /* Start of sub items */
    public static $SubNumber_ListItemOne = 0;
    /* End of sub items. */
    private $sItemList = array();

    function __construct() {
        parent::__construct();
    }

    public function Initialize($dbCon) {
        include_once("includes/api/ContactAPI.php");
        $conAPI = new ContactAPI($dbCon);
        $results = $conAPI->ContactSearchACS(NULL);
        foreach($results as $ssCode) {
            parent::AddSubItem(AutoComplete::$SubNumber_ListItemOne, array("id" => $ssCode["con_pk"], "text" => $ssCode["con_fname"] . " " . $ssCode["con_lname"]));
        }
    }

    public function HandleNetworkFunction($name, $value, $dbCon) {
        include_once("api/ContactAPI.php");
        switch($name) {
            case "AWCCN":
                $conAPI = new ContactAPI($dbCon);
                $results = $conAPI->ContactSearchACS($value["id1"]);
                foreach($results as $ssCode) {
                    //var_dump($ssCode);
                    echo "<a id=\"".$ssCode["con_pk"]."\" class=\"list-group-item\">".$ssCode["con_fname"] . " " .
                    $ssCode["con_lname"] . "</a>" . "<ef class='extra_field' id='con_phone'>" . $ssCode['con_phone'] .
                    "</ef><ef class='extra_field' id='con_email'>". $ssCode['con_email'] . "</ef>";
                }
                if(count($results) < 1) {
                    echo "<a class=\"list-group-item\">No results available.</a>";
                }
                break;
        }
    }

    public function GetNetworkingShorthand() {
        return "AWCCN";
    }

    public function IsImplemented() { return true; }

////////////////////////////////////////////

    public function GenerateAddonJavascript($KeyValue)
    {
        ?>
        var <?php echo $KeyValue["container-id"]; ?>BOXObj = null;
        <?php echo $KeyValue["container-id"]; ?>AttatchToOAC = function() {
            $("#<?php echo $KeyValue["container-id"]; ?> > div > div > div > div > a").on('click', function() {
                $("<?php echo $KeyValue["onclick"]; ?> > input").val($(this).html());
                $("<?php echo $KeyValue["onclick"]; ?> > input").data("pk", $(this).attr('id'));
                $("[name='wo_requestor_phone']").val($("#<?php echo $KeyValue["container-id"]; ?> > div > div > div > div > #con_phone").html());
                $("[name='wo_requestor_email']").val($("#<?php echo $KeyValue["container-id"]; ?> > div > div > div > div > #con_email").html());
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
}
?>
