
  <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>    <?php
            $countstaff = "SELECT count(admin_id) AS stf FROM admin_users";
            $staffResult = mysqli_query($GLOBALS["___mysqli_ston"], $countstaff);
            $staffCounting = mysqli_fetch_assoc($staffResult);
            echo $staffCounting['stf'];
            ?></h3>

              <p>User</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Staff <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
               <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>    <?php
            $countstaff = "SELECT count(admin_id) AS stf FROM admin_users";
            $staffResult = mysqli_query($GLOBALS["___mysqli_ston"], $countstaff);
            $staffCounting = mysqli_fetch_assoc($staffResult);
            echo $staffCounting['stf'];
            ?></h3>

              <p>User</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Training<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>  <?php
                $countmem = 'SELECT count(id) AS mem FROM new_pv_tbl';
            $memResult = mysqli_query($GLOBALS["___mysqli_ston"], $countmem);
            $memCounting = mysqli_fetch_assoc($memResult);
            $piv = $memCounting['mem'];
            echo $piv;
            ?><sup style="font-size: 20px"</sup></h3>

              <p>User</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
               <!-- ./col -->
               <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>    <?php
            $countstaff = "SELECT count(admin_id) AS stf FROM admin_users";
            $staffResult = mysqli_query($GLOBALS["___mysqli_ston"], $countstaff);
            $staffCounting = mysqli_fetch_assoc($staffResult);
            echo $staffCounting['stf'];
            ?></h3>

              <p>User</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Training<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <!-- ./col -->
         
      </div>
    <!-- Main content -->
    </section>
  