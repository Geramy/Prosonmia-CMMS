<?php
include_once("Engine/ReportCache.php");
include_once("Engine/ReportGenerator.php");
class ReportCreator {
    private $ReportIDType = null;
    private $mapi = null;
    private $rGenerator = null;
    private $redis = null;
    private $rCache = null;
    public function __construct($reportCode, $dbCon) {
        $this->redis = new Redis();
        $this->redis->connect(ProsonmiaConfig::$RedisHost, 6379);
        $this->redis->auth(ProsonmiaConfig::$RedisAuth);

        $this->ReportIDType = $reportCode;
        $this->mapi = new MySQLIAPI($dbCon);
        $this->rGenerator = new ReportGenerator($this->mapi, $this->redis);
        $this->rCache = new ReportCache($this->redis);
        //$tableName = $this->rCache->SetMainReportTable();
    }

    public function CreateJSLink() {
      ?>
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
      <script type="text/javascript" src="/includes/itasm.networking.php/?RQ=ReportC&Method=getmainJs&id=<?php echo $this->ReportIDType; ?>"></script>
      <?php
    }

    public function SetColumn($dbItem, $htmlID) {
      $this->rCache->SetReportColumn($dbItem, $htmlID);
    }

    public static function GenerateJavascript($id) {
        ?>
$(document).ready(function () {
    $(".draggable-element").JQluvToolbox(".drop-zone", function(sItem, dItem) {
      pageAreaID = $(dItem).attr("item");
      field_fk = $(sItem).attr("id");
      Prosonmia.Report.SaveColumn(pageAreaID, field_fk);
    });
    $(".pros-add-filter").on("click", function() {
      $($(this).attr("body")).JQluvGetBody("ReportC", "GetFilterRow", <?php echo $id; ?>, null, function(that) {
        $(that).find(".table-sel").change(function() {
          $(this).parent().parent().parent().find("[data=column]").empty().JQluvGetBody("ReportC", "GetColumns", <?php echo $id; ?>, $(this).val());
        });
      });
    });
    $(".pros-add-param").on("click", function() {
      $($(this).attr("body")).JQluvGetBody("ReportC", "GetParamRow", <?php echo $id; ?>, null, function() {

      });
    });
});
        <?php
    }

    public function GetOperations() {
      ?>
      <div class="col-md-2">
        <select class="operator-sel">
          <optgroup>
            <option selected="selected">Operator - None</option>
            <option>Contains</option>
            <option>More Than</option>
            <option>Less Than</option>
            <option>Equal To</option>
          </optgroup>
        </select>
      </div>
      <?php
    }

    public function GetFilterRow() {
      $tbDef = $this->rGenerator->GetTables();
      $tables = "";
      foreach($tbDef as $tbl) {
        $tables .= "<option>".$tbl."</option>";
      }
      ?>
      <tr>
        <td><div class="col-md-2"><select class="table-sel"><optgroup><option selected="selected">Table - None</option><?php echo $tables; ?></optgroup></select></div></td>
        <td data="column">Column Name</td>
        <td><?php echo $this->GetOperations(); ?></td>
        <td><input class="val-param" type="text" /></td>
        <td></td>
        <td></td>
      </tr>
      <?php
    }

    public function GetParamRow() {

    }

    public function GetColumnOptions($tbl) {
      $colmns = $this->rGenerator->GetColumns($tbl);
      $columns = "";
      foreach($colmns as $columnV) {
        $lbl = strlen($columnV->cola_user_label) < 1 ? $columnV->cola_label : $columnV->cola_user_label;
        $columns .= "<option>".$lbl."</option>";
      }
      ?>
      <div class="col-md-1"><select class="column-sel"><optgroup><option selected="selected">Column - None</option><?php echo $columns; ?></optgroup></select></div>
      <?php
    }

    public function DisplaySideBar() {
        //We need to figure out what table we are, grab that info fromt he report cache.

        //First we need to grab all the columns associated with this table
        //$columns is a array of it_column_labels;
        $tableName = $this->rCache->GetMainReportTable();
        $columns = $this->rGenerator->GetColumns($tableName);
?>
  </div>
</div>
        <div class="col-md-3 pros-rp-sidebar">
            <div class="formContainer">
                <label>Columns</label>
                <div class="list-group">
<?php
        foreach($columns as $item) {
?>
            <div class="row">
                <div class="col-md-8 draggable-element">
                    <p class="text-center" id="<?php echo $item->cola_pk; ?>"><?php echo $item->cola_label; ?></p>
                </div>
            </div>
<?php
        }
?>
                </div>
            </div>
        </div>
      <div class="container">
        <div class="row">
<?php
    }

    public function DisplayReportBody() {
        ?>
        <div class="col-md-11">
            <div class="formContainer report-area">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#main">Main Report</a></li>
                    <li><a data-toggle="tab" href="#filters">Filters</a></li>
                    <li><a data-toggle="tab" href="#parameters">Parameters</a></li>
                </ul>
                <div class="tab-content">
                    <div id="main" class="tab-pane fade in active">
                        <div class="inputContainer">
                            <form id="view" action="/Rate Code/ViewItem/" method="post">
                                <div class="drop-zone">
                                    <div class="row">
                                        <div class="drop-column-highlight col-md-1">
                                            <p item="col-1" class="text-center">Drop Here</p>
                                        </div>
                                        <div class="drop-column-highlight col-md-1">
                                            <p item="col-2" class="text-center">Drop Here</p>
                                        </div>
                                        <div class="drop-column-highlight col-md-1">
                                            <p item="col-3" class="text-center">Drop Here</p>
                                        </div>
                                        <div class="drop-column-highlight col-md-1">
                                            <p item="col-4" class="text-center">Drop Here</p>
                                        </div>
                                        <div class="drop-column-highlight col-md-1">
                                            <p item="col-5" class="text-center">Drop Here</p>
                                        </div>
                                        <div class="drop-column-highlight col-md-1">
                                            <p item="col-6" class="text-center">Drop Here</p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="filters" class="tab-pane fade">
                        <div class="inputContainer">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Table Name</th>
                                            <th>Column Name</th>
                                            <th>Operation</th>
                                            <th>Value/Parameter</th>
                                            <th><i body="#filter-body" class="fa fa-fw fa-plus-circle pros-add-filter"></i></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="filter-body" class="selectable">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="parameters" class="tab-pane fade in">
                      <div class="inputContainer">
                          <div class="table-responsive">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>Parameter Name</th>
                                          <th>Default Value</th>
                                          <th><i body="#param-body" class="fa fa-fw fa-plus-circle pros-add-param"></i></th>
                                          <th></th>
                                      </tr>
                                  </thead>
                                  <tbody id="param-body" class="selectable">

                                  </tbody>
                              </table>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function DisplayReportModules() {
        ?>

        <?php
    }
}
?>
