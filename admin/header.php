<?php
session_start();

if (!isset($_SESSION['user_id']))
	header("Location: ../index.php");

$id = $_SESSION['user_id'];
function isLogged(){
    if($_SESSION['user_name']){ # When logged in this variable is set to TRUE
        return TRUE;
    }else{
        return FALSE;
    }
}

# Log a user Out
function logOut(){
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
}

# Session Logout after in activity
function sessionX(){
    $logLength = 60; # time in seconds :: 1800 = 30 minutes
    $ctime = strtotime("now"); # Create a time from a string
    # If no session time is created, create one
    if(!isset($_SESSION['user_name'])){ 
        # create session time
        $_SESSION['user_name'] = $ctime; 
    }else{
        # Check if they have exceded the time limit of inactivity
        if(((strtotime("now") - $_SESSION['user_name']) > $logLength) && isLogged()){
            # If exceded the time, log the user out
            logOut();
            # Redirect to login page to log back in
            header("Location:../index.php");
            exit;
        }else{
            # If they have not exceded the time limit of inactivity, keep them logged in
            $_SESSION['user_name'] = $ctime;
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<meta name="robots" content="noindex">
<meta name="robots" content="nofollow"><title>INDUSTRIAL TRAINING FUND (ITF) DATABANK SYSTEM</title>

<link rel="shortcut icon" href="../old_assets/images/icon.gif" type="image/x-icon">

<link href="../old_assets/jqueryui.css" rel="stylesheet" type="text/css">

<link href="../old_assets/css/datepicker.css" rel="stylesheet" type="text/css" />

<link href="../old_assets/styles.css" rel="stylesheet" type="text/css">
<link type="text/css" href="../old_assets/css/validate.css" rel="stylesheet" />

<link rel="stylesheet" href="../old_assets/css/print.css" media="print" />

<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

<script type="text/javascript" src="../old_assets/jquery.min.js"></script>
<script type="text/javascript" src="../old_assets/jquery-ui.custom.min.js"></script>

<script type="text/javascript" src="../old_assets/jquery.appear-1.1.1.js"></script>
<script type="text/javascript" src="../old_assets/tooltip.min.js"></script>

<script type="text/javascript" src="../old_assets/tinymce.editor.js"></script>

<script type="text/javascript" src="../old_assets/core.js"></script>
<script type="text/javascript" src="../old_assets/ajax.js"></script>

<script type="text/javascript" src="../old_assets/js/datepicker.js"></script>
<script type="text/javascript">
	$(function() {
		$('#popupDatepicker').datepick();
	});
	
	$(function() {
		$('#popupDatepicker1').datepick();
	});
</script>

<body>
<div id="user_info">
<?php
	include("../includes/connections.php");
	
	$query = "SELECT * FROM staff_reg where id = $id";
	$result = mysqli_query( $connect, $query);
	
	while($row = mysqli_fetch_assoc($result)){
		$fullname = $row['first_name'] . " " . $row['last_name'];
		$title = $row['title_id'];
		$username = $row['username'];
		$office_type = $row['office_type'];
		$office_location = $row['office_location'];
		$access_right = $row['access_right'];
		$department = $row['department'];
		$section = $row['section_id'];
		$division = $row['div_id'];
		$unit = $row['unit'];
		$sub_unit = $row['sub_unit'];
	}
	
	$query_title = "SELECT * FROM title where title_id = $title";
	$result_title = mysqli_query( $connect, $query_title);
	
	while($row_title = mysqli_fetch_array($result_title)){
		$tit = $row_title[1];
	}
	
	echo "<p><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>WELCOME:</span> ". $tit . " " .$fullname. ".&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<span style='color:#1e69c7; font-size:13px; font-weight:bold;'>USERNAME:</span> ".$username. ".</p>";
	
	$query_office = "SELECT type FROM office_type where id = $office_type";
	$result_office = mysqli_query( $connect, $query_office);
	
	while($row_office = mysqli_fetch_assoc($result_office)){
		$office_name = $row_office['type'];
	}
	
	echo "<p><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>OFFICE TYPE:</span> ".$office_name. ".&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	
	$query_office = "SELECT * FROM area_office where office_type_id = $office_type and id = $office_location";
	$result_office = mysqli_query( $connect, $query_office);
	
	while($row_office = mysqli_fetch_array($result_office)){
		$office_loc = $row_office['2'];
	}
	
	echo "<span style='color:#1e69c7; font-size:13px; font-weight:bold;'>OFFICE LOCATION:</span> ".$office_loc. ".&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	
	$query_access = "SELECT * FROM assess_right where right_id = $access_right";
	$result_access = mysqli_query( $connect, $query_access);
	
	while($row_access = mysqli_fetch_array($result_access)){
		echo "<span style='color:#1e69c7; font-size:13px; font-weight:bold;'> ACCESS RIGHT:</span> " . $row_access[1] . ".</p>";
	}
?>
</div>
<a href="home.php"><img class="baj" src="../old_assets/images/logo1.png" /></a>
<div class="header-wrap">
<div id="header">
	<div id="logo">
    <p class="site_name">Industrial Training Fund</p>		
	</div>

	<div id="top_quick_links">
				<div class="nowrap">
<a href="signout.php"><span><b>Sign out</b></span></a><span class="top-signout" title="Sign out"></span>
	</div>
	</div>

	 
    <ul id="menu"><!-- open menu -->
    <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>

	<li>
			<a class="drop">MONTHLY REPORT</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
					<?php
		if($access_right !== '1' && $access_right !== '3'){
		
        echo '
				<li class="blank view_orders"><a href="report.php"><span>ADD REPORT</span>
						<span class="hint">Click here to add a new report.</span></a>
											</li>
									<li class="blank view_orders"><a href="vet_report.php"><span>EDIT REPORT</span>
						<span class="hint">Click here to vet report.</span></a>
											</li>
									 <li class="blank view_orders"><a href="view_report.php"><span>VIEW REPORT</span>
						<span class="hint">Click here to view report.</span></a>
											</li>';
		}
		?>
						<?php
						 if($access_right !== '1' && $access_right !== '2' & $access_right !== '3'){
				 	echo '
									<li class="blank view_orders"><a href="query_report.php"><span>QUERY REPORT</span>
						<span class="hint">Click here to query report.</span></a>
				  							</li>';
		}
		?>
									</ul>
				</div>
			</div>
		</li>
<?php
if($access_right == 4 OR ($access_right == 6 && $department == 1)){
	echo '							
			
			
			<li>
			<a class="drop" title="career development">CAREER DEV.</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
									<li class="blank view_orders"><a href="add_nominal.php"><span>ADD STAFF</span>
						<span class="hint">Click here to add staff details.</span></a>
				  					</li>
                                    <li class="blank view_orders"><a href="view_nominal.php"><span>VIEW STAFF</span>
						<span class="hint">Click here to view staff list.</span></a>
									</li>
									<li class="blank view_orders"><a href="view_archive.php"><span>VIEW ARCHIVE STAFF</span>
						<span class="hint">Click here to view archive staff list.</span></a>
									</li>
				  </ul>
				</div>
			</div>
			</li>
			';
}
?>
			
		<li>
			<a class="drop">USER'S C/PANEL</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
<?php
if($access_right == 4){
	echo '
		    		    <li class="blank view_orders"><a href="new_user.php"><span>NEW USER</span>
						<span class="hint">Click to add new user</span></a>
											</li>
											<li class="blank view_orders"><a href="manage_account.php"><span>MANAGE ACCOUNT</span>
						<span class="hint">Click here to manage your personal.</span></a>
											</li>';
}
?>
                                            <li class="blank view_orders"><a href="change_pword.php"><span>CHANGE PASSWORD</span>
						<span class="hint">Click here to change your password.</span></a>
											</li>
<?php
if($access_right == 4){
	echo '                                      
                                            <li class="blank view_orders"><a href="registered.php"><span>REGISTERED USERS</span>
						<span class="hint">all registered staffs.</span></a>
											</li>
											<li class="blank view_orders"><a href="admin_log.php"><span>MANAGE ADMIN</span>
						<span class="hint">all admin login.</span></a>
											</li>
                                             <li class="blank view_orders"><a href="pword_change.php"><span>RESET PASSWORD</span>
						<span class="hint">Change user\'s password.</span></a>
											</li>
                                             <li class="blank view_orders"><a href="db_backup.php"><span>BACKUP DB</span>
						<span class="hint">back up database.</span></a>
											</li>
												<li class="blank view_orders"><a href="log_latest.php"><span>LATEST LOG</span>
						<span class="hint">Click here to view latest log.</span></a>
				  					</li>
                                    <li class="blank view_orders"><a href="log_all.php"><span>ALL</span>
						<span class="hint">Click here to view all.</span></a>
									</li>
									<li class="blank view_orders"><a href="change_role.php"><span>CHANGE LOGIN ROLE </span>
						<span class="hint">Click here to view all.</span></a>
									</li>
											<li class="blank view_orders"><a href="UsersStatus.php"><span>USERS STATUS</span>
						<span class="hint">View Users Online.</span></a>
											</li>';

}
?>
                                             
				  </ul>
				</div>
			</div>
		</li>
        
 <?php
if($access_right == '4' ){
	echo '  
        <li>
			<a class="drop">WORK-PLAN</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
                      
		<li class="blank view_orders"><a href="itf_prog.php"><span>WORK-PLAN</span>
							<span class="hint">all ITF work-plan.</span></a>
												</li>
			        
			 <li class="blank view_orders"><a href="add_itf_programmes.php"><span>ITF TRAINING PROGRAMMES</span>
							<span class="hint">List of ITF Training Programmes</span></a>
												</li>
                </ul>
                </div>
           </div>
       </li>
      ';
	}
?>
 <?php
if($access_right == '6' && $department == '10' ){
	echo '  
        <li>
			<a class="drop">WORK-PLAN</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
                      
		<li class="blank view_orders"><a href="itf_prog.php"><span>WORK-PLAN</span>
							<span class="hint">all ITF work-plan.</span></a>
												</li>
                </ul>
                </div>
           </div>
       </li>
      ';
	}
?>
      
  <?php
if($access_right == '4' ){
	echo '   
       <li>
			<a class="drop">DEPARTMENTS/UNITS</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
                   
			<li class="blank view_orders"><a href="special_rpt.php?id=admin"><span>Administration and Human Resource</span>
							</a>
												</li>
	<li class="blank view_orders"><a href="special_rpt.php?id=biz"><span>Business Training & Development</span>
							</a>
												</li>											
		<li class="blank view_orders"><a href="special_rpt.php?id=plan"><span>Corporate Planning</span>
							</a>
												</li>											
	
		 <li class="blank view_orders"><a href="special_rpt.php?id=field"><span>Field Services</span>
							</a>
												</li>											
		 <li class="blank view_orders"><a href="special_rpt.php?id=finance"><span>Finance & Accounts</span>
							</a>
												</li>										
		 <li class="blank view_orders"><a href="special_rpt.php?id=ict"><span>Information & Communication Technology</span>
							</a>
												</li>										
		 <li class="blank view_orders"><a href="special_rpt.php?id=rcd"><span>Research & Curriculum Development</span>
							</a>
												</li>												
		 <li class="blank view_orders"><a href="special_rpt.php?id=ric"><span>Revenue, Inspectorate & Compliance</span>
							</a>
												</li>											
		 <li class="blank view_orders"><a href="special_rpt.php?id=proc"><span>Procurement</span>
							</a>
												</li>											
		 <li class="blank view_orders"><a href="special_rpt.php?id=tvst"><span>Technical & Vocational Skills Training</span>
							</a>
												</li>
 <li class="blank view_orders"><a href="special_rpt.php?id=audit"><span>Internal Audit</span>
							</a>
												</li>
 <li class="blank view_orders"><a href="special_rpt.php?id=legal"><span>Legal & Council Affairs</span>
							</a>
												</li>
 <li class="blank view_orders"><a href="special_rpt.php?id=pa"><span>Public Affairs</span>
							</a>
												</li																																		
 <li class="blank view_orders"><a href="special_rpt.php?id=servicom"><span>SERVICOM & Anti-Corruption</span>
							</a>
												</li>
                
                </ul>
                </div>
           </div>
       </li>       
    ';	
				  //}
				  
				  }
				?>   


<?php
if($access_right == '6' && $department == '1'){
	echo '   
  <li>
	<a class="drop">DEPARTMENTS/UNITS</a>
		<div class="dropdown-column">
			<div class="col">
				<ul>
                   <li class="blank view_orders"><a href="special_rpt.php?id=admin"><span>Administration and Human Resource</span>
							</a>
						</li>
                	</ul>
                </div>
           </div>
       </li>       
    ';	}?>   
<?php
if($access_right == '6' && $department == '2'){
	echo '   
  <li>
	<a class="drop">DEPARTMENTS/UNITS</a>
		<div class="dropdown-column">
			<div class="col">
				<ul>
                  <li class="blank view_orders"><a href="special_rpt.php?id=biz"><span>Business Training & Development</span>
							</a>
						</li>		
                	</ul>
                </div>
           </div>
       </li>       
    ';	}?>
<?php
if($access_right == '6' && $department == '3'){
	echo '   
  <li>
	<a class="drop">DEPARTMENTS/UNITS</a>
		<div class="dropdown-column">
			<div class="col">
				<ul>
                  <li class="blank view_orders"><a href="special_rpt.php?id=field"><span>Field Services</span>
							</a>
						</li>		
                	</ul>
                </div>
           </div>
       </li>       
    ';	}?>
<?php
if($access_right == '6' && $department == '4'){
	echo '   
  <li>
	<a class="drop">DEPARTMENTS/UNITS</a>
		<div class="dropdown-column">
			<div class="col">
				<ul>
                  <li class="blank view_orders"><a href="special_rpt.php?id=finance"><span>Finance & Accounts</span>
							</a>
						</li>		
                	</ul>
                </div>
           </div>
       </li>       
    ';	}?>
 <?php
if($access_right == '6' && $department == '5'){
	echo '   
  <li>
	<a class="drop">DEPARTMENTS/UNITS</a>
		<div class="dropdown-column">
			<div class="col">
				<ul>
                  <li class="blank view_orders"><a href="special_rpt.php?id=ict"><span>Information & Communication Technology</span>
							</a>
						</li>		
                	</ul>
                </div>
           </div>
       </li>       
    ';	}?>
<?php
if($access_right == '6' && $department == '6'){
	echo '   
  <li>
	<a class="drop">DEPARTMENTS/UNITS</a>
		<div class="dropdown-column">
			<div class="col">
				<ul>
                  <li class="blank view_orders"><a href="special_rpt.php?id=proc"><span>Procurement</span>
							</a>
						</li>		
                	</ul>
                </div>
           </div>
       </li>       
    ';	}?>
<?php
if($access_right == '6' && $department == '7'){
	echo '   
  <li>
	<a class="drop">DEPARTMENTS/UNITS</a>
		<div class="dropdown-column">
			<div class="col">
				<ul>
                  <li class="blank view_orders"><a href="special_rpt.php?id=rcd"><span>Research & Curriculum Development</span>
							</a>
						</li>		
                	</ul>
                </div>
           </div>
       </li>       
    ';	}?>
 <?php
if($access_right == '6' && $department == '8'){
	echo '   
  <li>
	<a class="drop">DEPARTMENTS/UNITS</a>
		<div class="dropdown-column">
			<div class="col">
				<ul>
                  <li class="blank view_orders"><a href="special_rpt.php?id=ric"><span>Revenue, Inspectorate & Compliance</span>
							</a>
						</li>		
                	</ul>
                </div>
           </div>
       </li>       
    ';	}?>
<?php
if($access_right == '6' && $department == '9'){
	echo '   
  <li>
	<a class="drop">DEPARTMENTS/UNITS</a>
		<div class="dropdown-column">
			<div class="col">
				<ul>
                  <li class="blank view_orders"><a href="special_rpt.php?id=tvst"><span>Technical & Vocational Skills Training</span>
							</a>
						</li>		
                	</ul>
                </div>
           </div>
       </li>       
    ';	}?>
<?php
if($access_right == '6' && $department == '10'){
	echo '   
  <li>
	<a class="drop">DEPARTMENTS/UNITS</a>
		<div class="dropdown-column">
			<div class="col">
				<ul>
                  <li class="blank view_orders"><a href="special_rpt.php?id=plan"><span>Corporate Planning</span>
							</a>
						</li>		
                	</ul>
                </div>
           </div>
       </li>       
    ';	}?>
 <?php
if($access_right == '10' && $unit == '2'){
	echo '   
  <li>
	<a class="drop">DEPARTMENTS/UNITS</a>
		<div class="dropdown-column">
			<div class="col">
				<ul>
                  <li class="blank view_orders"><a href="special_rpt.php?id=legal"><span>Legal & Council Affairs</span>
							</a>
						</li>		
                	</ul>
                </div>
           </div>
       </li>       
    ';	}?>
 <?php
if($access_right == '10' && $unit == '3'){
	echo '   
  <li>
	<a class="drop">DEPARTMENTS/UNITS</a>
		<div class="dropdown-column">
			<div class="col">
				<ul>
                  <li class="blank view_orders"><a href="special_rpt.php?id=pr"><span>Public Relations & Publicity</span>
							</a>
						</li>		
                	</ul>
                </div>
           </div>
       </li>       
    ';	}?>

 <?php
if($access_right == '10' && $unit == '4'){
	echo '   
  <li>
	<a class="drop">DEPARTMENTS/UNITS</a>
		<div class="dropdown-column">
			<div class="col">
				<ul>
                  <li class="blank view_orders"><a href="special_rpt.php?id=servicom"><span>SERVICOM & Anti-Corruption</span>
							</a>
						</li>		
                	</ul>
                </div>
           </div>
       </li>       
    ';	}?>
<?php
if($access_right == '10' && $unit == '1'){
	echo '   
  <li>
	<a class="drop">DEPARTMENTS/UNITS</a>
		<div class="dropdown-column">
			<div class="col">
				<ul>
                  <li class="blank view_orders"><a href="special_rpt.php?id=audit"><span>Internal Audit</span>
							</a>
						</li>		
                	</ul>
                </div>
           </div>
       </li>       
    ';	}?>
  <li>
  <?php
if($access_right !== '1' && $access_right !== '3' && $access_right !== '6' && $access_right !== '10'){
	echo '   
  <li>
	<a class="drop">AREA OFFICE / CENTRE REPORT</a>
		<div class="dropdown-column">
			<div class="col">
				<ul>
                 <li class="blank view_orders"><a href="arearep.php"><span>EXECUTIVE SUMMARY</span>
						<span class="hint"> Area Office Reports </span></a>
				  	</li>	
				  	  <li class="blank view_orders"><a href="meeting.php"><span>ADD MINUTES OF MEETING</span>
							<span class="hint">Submit Minutes for Meeting</span></a>
					<li class="blank view_orders"><a href="view_meeting.php"><span>VIEW MINUTES OF MEETING</span>
							<span class="hint">Submit Minutes for Meeting</span></a>
					  </li>
                	</ul>
                </div>
           </div>
       </li>       
    ';	

 } else{
		 echo ' ';
 }?>
  <li>  

   <?php
if($access_right !== '1' && $access_right !== '2' && $access_right !== '3' && $access_right !== '6' && $access_right !== '9' && $access_right !== '10'){
	echo '    	
<a class="drop">OTHER REPORTS</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
                <?php
                 
				 	<li class="blank view_orders"><a href="add_procurement.php"><span>PROCUREMENT REPORTS</span>
						<span class="hint"> Procurement Reports </span></a>
				  	</li>
				 
					 <!--<li class="blank view_orders"><a href="executive_summary.php"><span>OTHER REPORTS</span>
						<span class="hint"> Other Reports </span></a>
				  	</li>-->
				
                 <li class="blank view_orders"><a href="add_legal.php"><span>LEGAL REPORTS</span>
							<span class="hint">Legal Reports</span></a>
					 
					  </li><li class="blank view_orders"><a href="add_vehicle.php"><span>ITF UTILITY VEHICLES DATA</span>
							<span class="hint">ITF Utility Vehicles Data</span></a>
					  </li>
					  <li class="blank view_orders"><a href="meeting.php"><span>ADD MINUTES OF MEETING</span>
							<span class="hint">Submit Minutes for Meeting</span></a>
							</li>
					  <li class="blank view_orders"><a href="view_meeting.php"><span>MINUTES OF MEETING</span>
							<span class="hint">Submit Minutes for Meeting</span></a>
					  </li>
				  </ul> 
				</div>
			</div>
		</li>
	
</ul>
';
				  }
				  ?>
   <?php
if($access_right == '6' && $department == '1'){
	echo '    	
<a class="drop">OTHER REPORTS</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
                <?php
<li class="blank view_orders"><a href="add_vehicle.php"><span>ITF UTILITY VEHICLES DATA</span>
							<span class="hint">ITF Utility Vehicles Data</span></a>
	<li class="blank view_orders"><a href="view_meeting.php"><span>VIEW MINUTES OF MEETING</span>
							<span class="hint">Submit Minutes for Meeting</span></a>
					  </li>
				  </ul> 
				</div>
			</div>
		</li>
	
</ul>
';
				  }
				  ?>
   <?php
if($access_right == '6' && $department == '6'){
	echo '    	
<a class="drop">OTHER REPORTS</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
                <?php
<li class="blank view_orders"><a href="add_procurement.php"><span>PROCUREMENT REPORTS</span>
						<span class="hint"> Procurement Reports </span></a>
<li class="blank view_orders"><a href="view_meeting.php"><span>VIEW MINUTES OF MEETING</span>
							<span class="hint">Submit Minutes for Meeting</span></a>
				  	</li>
				  </ul> 
				</div>
			</div>
		</li>
	
</ul>
';
				  }
				  ?>
<?php
if($access_right == '6' && $department == '7'){
	echo '    	
<a class="drop">OTHER REPORTS</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
                <?php
					  </li>
<li class="blank view_orders"><a href="view_meeting.php"><span>VIEW MINUTES OF MEETING</span>
							<span class="hint">Submit Minutes for Meeting</span></a>
				  </ul> 
				</div>
			</div>
		</li>
	
</ul>
';
				  }
				  ?>
   <?php
if($access_right == '10' && $unit == '2'){
	echo '    	
<a class="drop">OTHER REPORTS</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
                <?php
 <li class="blank view_orders"><a href="add_legal.php"><span>LEGAL REPORTS</span>
							<span class="hint">Legal Reports</span></a>
					  </li>
<li class="blank view_orders"><a href="view_meeting.php"><span>VIEW MINUTES OF MEETING</span>
							<span class="hint">Submit Minutes for Meeting</span></a>
				  </ul> 
				</div>
			</div>
		</li>
	
</ul>
';
				  }
				  ?>
   <?php
if($access_right == '9'){
	echo '    	
<a class="drop">OTHER REPORTS</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
                <?php
 <li class="blank view_orders"><a href="view_meeting.php"><span>MINUTES OF MEETING</span>
							<span class="hint">Submit Minutes for Meeting</span></a>
					  </li>
				  </ul> 
				</div>
			</div>
		</li>
	
</ul>
';
				  }
				  ?>
<!--header--></div></div>