
<?php require_once ("../includes/header.php"); ?>
<div class="container">
  <!-- Components -->
        <?php
          // process form
          $builder = new Builder\Engine();

          // send message output
          Screen\Response::getMessage($statusMsgClass, $statusMsg);
        ?>

        <?php if (!empty($statusMsg)) {
            echo '<div class="alert ' . $statusMsgClass . '">' . $statusMsg . '</div>';
        } ?>
      <div class="row">
          <div id="build" class="col-lg-12">
          <form id="target" class="form-horizontal">
          </form>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-md-6">
          <div class="tabbable">
            <ul class="nav nav-tabs" id="formtabs">
              <!-- Tab nav -->
            </ul>
            <form class="form-horizontal" id="components" role="form">
              <fieldset>
                <div class="tab-content">
                  <!-- Tabs of snippets go here -->
                </div>
              </fieldset>
            </form>
          </div>
        </div>
        <!-- / Components -->

        <div class="col-md-6">
          <!-- area offices -->
            <div id="build-form" class="form-table">
              <?php
                $q = mysqli_query($GLOBALS["___mysqli_ston"], "select * from area_office order by area_office_name asc");
                if (!$q) {
                    print mysqli_error($GLOBALS["___mysqli_ston"]);
                    exit;
                }
                $offices = [];

                while ($r = mysqli_fetch_array($q)) {
                    $offices[$r['area_office_name']] = $r['id'];
                }

                $json = preg_replace('/["]/',"'",json_encode($offices));

                ?>
                <form action="" method="post">
                  <input type="hidden" name="area_offices" value="<?=$area_offices?>" data-offices="<?=$json?>" required/>
                  <input type="hidden" name="form_data">
                  <input type="hidden" name="form_name">
                  <section class="select-wrapper">
                      <section class="search-box">
                          <input class="form-control" data-search="search-offices" placeholder="Search for an area office">
                          <span class="select-info">
                              (<span>0</span>)
                          </span>
                          <span class="select-all"><i class="fa fa-plus"></i> Add All </span>
                      </section>

                      <section data-select="list" class="select-list">
                      </section>

                      <textarea style="margin-top: 10px;" name="remarks" class="form-control" placeholder="Please enter a remark."></textarea>
                  </section>
                  <br>
                  <input type="submit" value="Create Form" class="btn btn-success" id="build-form-btn">
              </form>
            </div>
        </div>
      </div>
    </div> <!-- /container -->

    <script type="text/javascript" src="../assets/js/itf_wekiwork.js"></script>

<?php require_once ("../includes/footer.php"); ?>