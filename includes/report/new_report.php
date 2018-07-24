<?php
	//$rateCodeHTML = new UIRateCode();
	//$modAPI = new InventoryAPI($dbCon);

    $sub_alert = " ";
	$sub_alert_js = " ";
    if($_SESSION["SuccessSubmission"] == NULL) ;
    else if ($_SESSION["SuccessSubmission"] >= 0)
	{
		$sub_alert_js = "$('.submission_error').show(); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);";
		$sub_alert = "New Inventory has been successfully added";
	}
	else if ($_SESSION["SuccessSubmission"] < 0)
	{
		$sub_alert_js = "$('.submission_error').show(); $('.submission_error').css('background-color', '').css('background-color', '#F58476'); setTimeout(function(){ $('.submission_error').fadeOut() }, 3000);";
		if ($_SESSION["SuccessSubmission"] == -2)
            $sub_alert = "The code already exists please use a different inventory code.";
        else
            $sub_alert = "There was a problem with your submission. Please try again.";
	}

?>
<link href="/css/jquery.gridster.min.css" rel="stylesheet" type="text/css">
<script src="/js/jquery.gridster.min.js" type="text/javascript"></script>
<script src="/js/prosonmia-gridster.js" type="text/javascript"></script>
<script type="text/javascript">
$("#new_inventory").ready(function() {
    var Module = "";
    var DefaultClient = "Select Client";
    var DefaultFacility = "Select Facility";
    var DefaultDepartment = "Select Department";
    function complete( data, sItem ) {
        var def = "";
        var db_name = "";
        var name = "";
        var url_id = "";
        switch(sItem)
        {
            case 0:
                def = DefaultClient;
                db_name = "cli";
                url_id = "id";
                name = "company"
                $( "div > select[name='cli_pk']" ).empty();
                $( "div > select[name='fac_pk']" ).empty();
                $( "div > select[name='dep_pk']" ).empty();
                break;
            case 1:
                def = DefaultFacility;
                db_name = "fac";
                url_id = "id1";
                name = "name"
                $( "div > select[name='fac_pk']" ).empty();
                $( "div > select[name='dep_pk']" ).empty();
                break;
            case 2:
                def = DefaultDepartment;
                db_name = "dep";
                url_id = "id2";
                name = "name"
                $( "div > select[name='dep_pk']" ).empty();
                break;
        }
        <?php
        if(array_key_exists ('url_id', $_GET)) {
            echo "var SelectedID = ".$_GET['url_id'].";\r\n";
        }
        ?>
        $( "div > select[name='"+db_name+"_pk']" ).append("<option value=''>"+def+"</value>");
        for(i = 0; i < data.length; i++) {
            var value = data[i];
            if(value == null)
                continue;
            $( "div > select[name='"+db_name+"_pk']" ).append("<option value='"+value[db_name+"_pk"]+"'>"+value[db_name+"_"+name]+"</value>");
        }

    }
    var _id = "NULL";
    var _id1 = "NULL";
    var _id2 = "NULL";
    <?php
        if($id != null) {
            echo "_id = ".$id;
        }
        if($id1 != null) {
            echo "_id1 = ".$id1;
        }
        if($id2 != null) {
            echo "_id2 = ".$id2;
        }
    ?>
    $.ajax({
      type: "POST",
      url: "/includes/itasm.networking.php",
      data: { RQ: "CLM", Method: "GetClients" },
      success: function(data) { complete(data, 0) },
      dataType: "json"
    });
    $("div > select[name='cli_pk']").on("change", function() {
        $.ajax({
          type: "POST",
          url: "/includes/itasm.networking.php",
          data: { RQ: "FAM", Method: "GetFacilities", cli_pk: $("div > select[name='cli_pk']").val() },
          success: function(data) { complete(data, 1) },
          dataType: "json"
        });
    });
    $("div > select[name='fac_pk']").on("change", function() {
        $.ajax({
          type: "POST",
          url: "/includes/itasm.networking.php",
          data: { RQ: "DEM", Method: "GetDepartments", cli_pk: $("div > select[name='cli_pk']").val(), fac_pk: $("div > select[name='fac_pk']").val() },
          success: function(data) { complete(data, 2) },
          dataType: "json"
        });
    });
});


// $("#new_job").ready(function() {
//     $(".proson-item-search").on("click", function() { $(this).NewInvListItem(".proson-item-table"); });
// });


<?php
//$rateCodeHTML->GenerateAddonJavascript($RateCodeElementArray);
?>
$("#new_inventory").ready(function() {
    $(".proson-item-search").on("click", function() { $(this).NewJobListItem(".proson-item-table"); });  //i dont think this is right. it says "NewJobListItem" but this is Inv
<?php
	echo $sub_alert_js;
    //$rateCodeHTML->GenerateOnReadyJavascript($RateCodeElementArray);
?>
});
</script>
<div class="submission_error">
	<?php
		echo $sub_alert;
	?>
</div>
<div class="formContainer" id="new_inventory">
    <form action="/includes/itasm.networking.php" method="post" name="new_report">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#main">New Report</a></li>
            <li><a data-toggle="tab" href="#rptquery">Report Query</a></li>
        </ul>
        <div class="tab-content">
            <div id="main" class="tab-pane fade in active">
                <div class="inputContainer">
                    <div class="gridster pros-rpt-bckg">
                        <ul class="report-grid">
                        </ul>
                    </div>
                </div>
            </div>
            <div id="rptquery" class="tab-pane fade in">
                <div class="inputContainer">
                    
                </div>
            </div>
            <script type="text/javascript">
              $(function() {
                gridster = $(".gridster ul").gridster({
                    widget_margins: [10, 10],
                    widget_base_dimensions: [140, 80]
                }).data('gridster');
                $('.date').datepicker({});
              });
            </script>
        </div>
    </form>
</div>

<div class="formContainer" id="add_components">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#mcomp">Main Components</a></li>
        <li><a data-toggle="tab" href="#hcomp">Header Components</a></li>
        <li><a data-toggle="tab" href="#fcomp">Footer Components</a></li>
        <li><a data-toggle="tab" href="#ccomp">Content Components</a></li>
    </ul>
    <div class="tab-content">
        <div id="mcomp" class="tab-pane fade in active">
            <div class="row">
                <div class="col-md-2">
                    <input class="btn rpt-btn" type="submit" name="nrpth" value="New Report Header" />
                </div>
                <div class="col-md-2">
                    <input class="btn rpt-btn" type="submit" name="nrptf" value="New Report Footer" />
                </div>
                <div class="col-md-2">
                    <input class="btn rpt-btn" type="submit" name="nrptc" value="New Content Area" />
                </div>
            </div>
        </div>
        <div id="hcomp" class="tab-pane">
            <div class="row">
                <div class="col-md-2">
                    <input class="btn rpt-active-btn" type="submit" name="nrpthc" value="Add Column" />
                </div>
            </div>
        </div>
        <div id="fcomp" class="tab-pane fade in">
            <div class="row">
                <div class="col-md-2">
                    <input class="btn rpt-active-btn" type="submit" name="nrptfc" value="Add Column" />
                </div>
            </div>
        </div>
        <div id="ccomp" class="tab-pane fade in">
            <div class="row">
                <div class="col-md-2">
                    <input class="btn rpt-active-btn" type="submit" name="nrptcr" value="Add Query" />
                </div>
            </div>
        </div>
        <script type="text/javascript">
          $(function() {
            Prosonmia.Gridster.SetupGrid();
          });
        </script>
    </div>
</div>
<div id="trptt" style="visibility: hidden;">
    <div id="rpt-types">
        <li id="nrpth" class="rpt-header"><div><ul></ul></div><h1>HEADER</h1></li>
        <li id="nrptc" class="rpt-content"><h2>CONTENT</h2></li>
        <li id="nrptf" class="rpt-footer"><h1>FOOTER</h1></li>
        <li id="nrptf" class="rpt-footer"><a>FOOTER</a></li>
        <li id="nrptfc" class="rpt-ft-col">ColumnItem</li>
        <li id="nrpthc" class="rpt-hr-col">ColumnItem</li>
        <div id="nrptcol" class="rpt-col"></div>
    </div>
</div>
<?php
  //$rateCodeHTML->GenerateStaticAddonHtml($RateCodeElementArray);
?>