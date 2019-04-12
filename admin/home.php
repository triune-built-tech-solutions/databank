<?php
require_once("header.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title><?php echo "$siteName"?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<style>
h3 {
  color:#F00;
  padding:0 10px;
}


</style>
<div id="content"><!-- open content -->
<div id="depart">
<?php
if(isset($department)){
  $query_dept = "SELECT * FROM department where id = $department";
  $result_dept = mysqli_query( $connect, $query_dept);
  
  while($row_dept = mysqli_fetch_array($result_dept)){
    $department = $row_dept[1];
    echo "<p><span style='color:#A80203; font-size:13px; font-weight:bold;'> DEPARTMENT:</span> " . $row_dept[1] . ".&nbsp;&nbsp;&nbsp;";
  }
} else {
  $query_unit = "SELECT * FROM unit where id = $unit";
  $result_unit = mysqli_query( $connect, $query_unit);
    
    while($row_unit = mysqli_fetch_array($result_unit)){
      $department = $row_unit[1];
      echo "<p><span style='color:#A80203; font-size:13px; font-weight:bold;'> UNIT:</span> " . $row_unit[1] . ".&nbsp;&nbsp;&nbsp;";
    }
}
if(isset($division)){
  $query_div = "SELECT * FROM division where id = $division";
  $result_div = mysqli_query( $connect, $query_div);
  
  while($row_div = mysqli_fetch_array($result_div)){
    echo "|&nbsp; <span style='color:#A80203; font-size:13px; font-weight:bold;'> DIVISION:</span> " . $row_div[2] . ".&nbsp;&nbsp;&nbsp;";
  }
}else {
  $query_div = "SELECT * FROM sub_unit where id = $sub_unit";
  $result_div = mysqli_query( $connect, $query_div);
  
  while($row_div = mysqli_fetch_array($result_div)){
    echo "|&nbsp; <span style='color:#A80203; font-size:13px; font-weight:bold;'> SUB-UNIT:</span> " . $row_div[2] . ".&nbsp;&nbsp;&nbsp;";
  }
}
if(isset($section)){
  $query_section = "SELECT * FROM section where section_id = $section";
  $result_section = mysqli_query( $connect, $query_section);
  
  while($row_section = mysqli_fetch_array($result_section)){
    echo "|&nbsp; <span style='color:#A80203; font-size:13px; font-weight:bold;'> SECTION:</span> " . $row_section[2] . ".</p>";
  }
}

$dash_sched = "SELECT sum(training), sum(participants) from scheduled_training";
$dash_res_sched = mysqli_query( $connect, $dash_sched);
while($dash_row_sched = mysqli_fetch_array($dash_res_sched)){
  $tot_sched = $dash_row_sched[0];
  $tot_sched_p = $dash_row_sched[1];
}

$dash_unsched = "SELECT sum(target), sum(participants) from unscheduled_training";
$dash_res_unsched = mysqli_query( $connect, $dash_unsched);
while($dash_row_unsched = mysqli_fetch_array($dash_res_unsched)){
  $tot_unsched = $dash_row_unsched[0];
  $tot_unsched_p = $dash_row_unsched[1];
}

$dash_staff = "SELECT count(*) as all_staff from nominal";
$dash_res_staff = mysqli_query( $connect, $dash_staff);
while($dash_row_staff = mysqli_fetch_array($dash_res_staff)){
  $tot_staff = $dash_row_staff[0];
}

$dash_staff_p = "SELECT count(*) as all_staff from staff_prog";
$dash_res_staff_p = mysqli_query( $connect, $dash_staff_p);
while($dash_row_staff_p = mysqli_fetch_array($dash_res_staff_p)){
  $tot_staff_p = $dash_row_staff_p[0];
}

$dash_train_cont = "SELECT sum(amount_coll) as all_coll from train_cont";
$dash_res_train_cont = mysqli_query( $connect, $dash_train_cont);
while($dash_row_train_cont = mysqli_fetch_array($dash_res_train_cont)){
  $tot_train_cont = $dash_row_train_cont[0];
}

$dash_comp_acct = "SELECT sum(amount) as amt_coll from ver_comp_acct";
$dash_res_comp_acct = mysqli_query( $connect, $dash_comp_acct);
if(!$dash_res_comp_acct){
  print mysqli_error($GLOBALS["___mysqli_ston"]);
  exit; 
}
while($dash_row_comp_acct = mysqli_fetch_array($dash_res_comp_acct)){
  $tot_comp_acct = $dash_row_comp_acct[0];
}

$dash_rev_c = "SELECT sum(amount_coll) as amt_coll from rev_fr_course";
$dash_res_rev_c = mysqli_query( $connect, $dash_rev_c);
while($dash_row_rev_c = mysqli_fetch_array($dash_res_rev_c)){
  $tot_rev_c = $dash_row_rev_c[0];
}

$dash_reimburse = "SELECT sum(amount_paid) as amt_coll from reimbursement";
$dash_res_reimburse = mysqli_query( $connect, $dash_reimburse);
while($dash_row_reimburse = mysqli_fetch_array($dash_res_reimburse)){
  $tot_reimburse = $dash_row_reimburse[0];
}

$dash_siwes = "SELECT sum(student_placed), sum(srudent_paid) from siwes_matters";
$dash_res_siwes = mysqli_query( $connect, $dash_siwes);
while($dash_row_siwes = mysqli_fetch_array($dash_res_siwes)){
  $tot_siwes_placed = $dash_row_siwes[0];
  $tot_siwes_paid = $dash_row_siwes[1];
}

$dash_incompany = "SELECT sum(survey_conducted), sum(prog_implemented) from incompany";
$dash_res_incompany = mysqli_query( $connect, $dash_incompany);
if(!$dash_res_incompany){
  print mysqli_error($GLOBALS["___mysqli_ston"]);
  exit; 
}
while($dash_row_incompany = mysqli_fetch_array($dash_res_incompany)){
  $tot_in_company = $dash_row_incompany[0];
  $tot_in_company1 = $dash_row_incompany[1];
}


$dash_nisdp = "SELECT * from nisdp_part";
$dash_res_nisdp = mysqli_query( $connect, $dash_nisdp);
$tot_trainee_n = mysqli_num_rows($dash_res_nisdp);

$dash_tsdp = "SELECT * from tsdp_part";
$dash_res_tsdp = mysqli_query( $connect, $dash_tsdp);
$tot_trainee_t = mysqli_num_rows($dash_res_tsdp);
?>
</div>



<?php include "../includes/subhead.php";?>

      <!-- /.row -->

       <div class="box box-solid bg-red-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title" style="color: #fff;">Calendar</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                  <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="#">Add new event</a></li>
                    <li><a href="#">Clear events</a></li>
                    <li class="divider"></li>
                    <li><a href="#">View calendar</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-black">
              <div class="row">
                <div class="col-sm-6">
                  <!-- Progress bars -->
                  <div class="clearfix">
                    <span class="pull-left">Task #1</span>
                    <small class="pull-right">90%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-red" style="width: 90%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Task #2</span>
                    <small class="pull-right">70%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-red" style="width: 70%;"></div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                  <div class="clearfix">
                    <span class="pull-left">Task #3</span>
                    <small class="pull-right">60%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-red" style="width: 60%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Task #4</span>
                    <small class="pull-right">40%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-red" style="width: 40%;"></div>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->


     
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
       
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!--footer-->
<p class="both" />
<div id="divi">

</div>
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
        <!--//footer-->
  <!-- Control Sidebar -->
  <?php include "includes/aside.php";?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->




<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

</body>
</head>
</html>
