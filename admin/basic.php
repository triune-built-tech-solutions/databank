<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" style="height: 552px; margin-top: 34px !important;" toolbar_fixed="1">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta name="robots" content="noindex">
<meta name="robots" content="nofollow"><title>INDUSTRIAL TRAINING FUND (ITF) DATABANK SYSTEM</title>

<link rel="shortcut icon" href="../old_assets/images/icon.gif" type="image/x-icon">

<link href="old_assets/jqueryui.css" rel="stylesheet" type="text/css">

<link href="old_assets/styles.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="old_assets/jquery.min.js"></script>
<script type="text/javascript" src="old_assets/jquery-ui.custom.min.js"></script>

<script type="text/javascript" src="old_assets/jquery.appear-1.1.1.js"></script>
<script type="text/javascript" src="old_assets/tooltip.min.js"></script>

<script type="text/javascript" src="old_assets/tinymce.editor.js"></script>

<script type="text/javascript" src="old_assets/core.js"></script>
<script type="text/javascript" src="old_assets/ajax.js"></script>

<body>
<a href="old_assets/index.php"><img class="baj" src="../old_assets/images/logo1.png" /></a>
<div class="header-wrap">
<div id="header">
	<div id="logo">
    <p class="site_name">Industrial Training Fund</p>		
	</div>

	<div id="top_quick_links">
				<div class="nowrap">
			<a href="#"><span>Sign out</span></a><span class="top-signout" title="Sign out"></span>
	</div>
	</div>
	 
    <ul id="menu"><!-- open menu -->
		<li>
			<a class="drop">ADD REPORT</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
									<li class="blank view_orders"><a href="report.php?id=<?php echo $id ?>"><span>ADD REPORT</span>
						<span class="hint">Click here to add a new report.</span></a>
											</li>
									</ul>
				</div>
			</div>
		</li>
								<li>
			<a class="drop">VET/VIEW REPORT</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
									<li class="blank view_orders"><a href="vet_report.php?id=<?php echo $id ?>"><span>VET REPORT</span>
						<span class="hint">Click here to vet report.</span></a>
											</li>
                                            <li class="blank view_orders"><a href="view_report.php?id=<?php echo $id ?>"><span>VIEW REPORT</span>
						<span class="hint">Click here to view report.</span></a>
											</li>
				  </ul>
				</div>
			</div>
		</li>
							<li>
			<a class="drop">QUERY REPORT</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
									<li class="blank view_orders"><a href="query_report.php?id=<?php echo $id ?>"><span>QUERY REPORT</span>
						<span class="hint">Click here to query report.</span></a>
				  </li>
                                           
				  </ul>
				</div>
			</div>
		</li>
								<li>
			<a class="drop">USER LOG TRACK</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
									<li class="blank view_orders"><a href="log_latest.php?id=<?php echo $id ?>"><span>LATEST LOG</span>
						<span class="hint">Click here to view latest log.</span></a>
				  </li>
                                            <li class="blank view_orders"><a href="log_month.php?id=<?php echo $id ?>"><span>LAST MONTH</span>
						<span class="hint">Click here to view last month log.</span></a>
											</li>
                                            <li class="blank view_orders"><a href="log_all.php?id=<?php echo $id ?>"><span>ALL</span>
						<span class="hint">Click here to view all.</span></a>
											</li>
				  </ul>
				</div>
			</div>
		</li><li>
			<a class="drop">USER ACCOUNT</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
		    		    <li class="blank view_orders"><a href="news.php?id=<?php echo $id ?>"><span>NEWS</span>
						<span class="hint">latest news</span></a>
											</li>
                                            <li class="blank view_orders"><a href="account_manage.php?id=<?php echo $id ?>"><span>ACCOUTS</span>
						<span class="hint">Click here to manage your personal.</span></a>
											</li>
                                            <li class="blank view_orders"><a href="admin_log.php?id=<?php echo $id ?>"><span>ADMIN LOG</span>
						<span class="hint">all admin login.</span></a>
											</li>
                                             <li class="blank view_orders"><a href="pword_change.php?id=<?php echo $id ?>"><span>CHANGE PASSWORD</span>
						<span class="hint">Change your password.</span></a>
											</li>
                                             <li class="blank view_orders"><a href="db_backup.php?id=<?php echo $id ?>"><span>BACKUP DB</span>
						<span class="hint">back up database.</span></a>
											</li>
                                             <li class="blank view_orders"><a href="itf_prog.php?id=<?php echo $id ?>"><span>ITF PROGRAM</span>
						<span class="hint">all ITF Program.</span></a>
											</li>
				  </ul>
				</div>
			</div>
		</li>					
								
  <li>
			<a class="drop">EX-SUMMARY REPORT</a>
			<div class="dropdown-column">
				<div class="col">
				<ul>
<li class="blank view_orders"><a href="staff_info.php?id=<?php echo $id ?>"><span>STAFF INFORMATION</span>
						<span class="hint">Staff information</span></a>
				  </li>
                                            <li class="blank view_orders"><a href="training_prog.php?id=<?php echo $id ?>"><span>TRAINING PROGRAMME</span>
						<span class="hint">Training Programmes.</span></a>
											</li>
                                            <li class="blank view_orders"><a href="course_approval.php?id=<?php echo $id ?>"><span>COURSE APPROVAL</span>
						<span class="hint">Courses.</span></a>
											</li>
                                             <li class="blank view_orders"><a href="reimbursement.php?id=<?php echo $id ?>"><span>REIMBURSEMENT</span>
						<span class="hint">Reimbursement issues</span></a>
											</li>
                                             <li class="blank view_orders"><a href="siwes_matters.php?id=<?php echo $id ?>"><span>SIWES MATTERS</span>
						<span class="hint">SIWES</span></a>
											</li>
                                             <li class="blank view_orders"><a href="revenue_gen.php?id=<?php echo $id ?>"><span>REVENUE GENERATION</span>
						<span class="hint">ITF REVENUE.</span></a>
											</li>
                                             <li class="blank view_orders"><a href="emp_stat.php?id=<?php echo $id ?>"><span>EMPLOYER'S STATISTICS</span>
						<span class="hint">all ITF Program.</span></a>
											</li>
                                             <li class="blank view_orders"><a href="zone.php?id=<?php echo $id ?>"><span>ZONE</span>
						<span class="hint">all ITF zones.</span></a>
											</li>
				  </ul> 
				</div>
			</div>
		</li>

		<form method="get" action="old_assets/index.php">
			<label><input type="text"  name="q" value="" autocomplete="off"></label>
            <label><input type="submit" value="Search" name="go" class="button" /></label>
		</form>
	</ul>
<!--header--></div></div>
<div id="content"><!-- open content -->
    <div id="main_content"><!-- open main_content -->
    <span style="float:left; padding:5px; margin:5px; border:1px #A80203 solid"><img src="../old_assets/images/itf_home.jpg" /></span>
     <p class="story">Established in 1971, the Industrial Training Fund has operated consistently and painstakingly within the context of its enabling laws, i.e. Decree 47 of 1971. The objective for which the Fund was established has been pursued vigorously and efficaciously.</p>
     <p>&nbsp;&nbsp;Over the years, pursuant to its statutory responsibility, the ITF has expanded its structures, developed training programmes, reviewed its strategies, operations and services in order to meet the expanding, and changing demands for skilled manpower in the economy. Beginning as a Parastatal <b>B</b> in 1971, headed by a Director, the ITF became a Parastatal <b>A</b> in 1981, with a Director-General as the Chief Executive under the aegis of the Ministry of Industry.</p>
     <p class="story">The Fund has a 13 member Governing Council and operates with 6 Departments and 3
Units at the Headquarters, 27 Area Offices, 2 Skills Training Centres, and a Centre for Industrial Training Excellence. As part of its responsibilities, the ITF provides Direct Training, Vocational and Apprentice Training, Research and Consultancy Service, Reimbursement of up to 60% Levy paid by employers of labour registered with it, and administers the Students Industrial Work Experience Scheme (SIWES).</p>

<p>&nbsp;&nbsp;It also provides human resource development information and training technology service to industry and commerce to enhance their manpower capacity and in-house training delivery effort. The main thrust of ITF programmes and services is to stimulate human performance, improve productivity, and induce value-added production in industry and commerce. Through its SIWES and Vocational and Apprentice Training Programmes, the Fund also builds capacity for graduates and youth self-employment, in the context of Small Scale Industrialisation, in the economy. </p>
<div id="link">
<fieldset style="float:left;">
              <legend><fieldset class="red"> Our Other Websites</fieldset></legend>
              <br>
				<img src="../old_assets/images/itf_download.jpg" align="absbottom">
               <a class="anchor" href="http://www.itf-nigeria.com" class="unnamed1" target="_blank"><strong>ITF NIGERIA</strong></a>
              </fieldset>
              
              <fieldset style="float:left; margin-left:20px;">
              <legend><fieldset class="red"> Download Mozillar Browser</fieldset></legend>
              <img src="../old_assets/images/Firefox.jpg" align="absbottom">
              <a class="anchor" href="http://dc108.4shared.com/download/d1nv7AxT/Mozila_firefox_35.rar?tsid=20100831-174136-f61f44f0
" target="_blank"> <strong> Direct Link</strong> </a>

              </fieldset>
              <fieldset style="float:left; margin-left:20px;">
              <legend><fieldset class="red"> Download Chrome Browser</fieldset></legend>
              <img src="../old_assets/images/chrome.jpg" align="absbottom">
              <a class="anchor" href="http://www.softpedia.com/dyn-postdownload.php?p=108363&t=4&i=1" target="_blank"> <strong> Direct Link</strong> </a>
   </fieldset>
</div>
    <div id="news">
    	<h2>NEWS/ EVENTS</h2>
    </div>
</div><!-- close main_content -->
<div id="side_bar"><!-- open side_content -->
<div id="login">
    <h2 align="center"> Staff Login </h2>
    <form name="signin" method="post" action="../processlogin.php">
	<p class="ques"><strong>Username :</strong> <input type="text" size="25" name="username" /></p>
    <p class="ques"><b>Password :</b> <input type="password" size="25" name="password" /></p>
    <p align="center"><input type="submit" value="Sign_in" name="login" /></p>
    </form>
</div>
    <div id="about">
    <fieldset class="a1">
<legend><fieldset class="a1"><span style="font-size:13px; font-weight:bold; color:#03C">About The Databank</span></fieldset></legend>

<p class="story">This Databank has the ability to collate the ITF Data(information) from their various office, ranging from the Departments, Area Office, Training Center and units in a secured and computerized manner for flexible data flow.</p>
</fieldset>
    </div>
    <div id="peri">
    <fieldset class="a1">
        <legend><fieldset class="a1"><span style="font-size:13px; font-weight:bold; color:#03C">Prerequisites</span></fieldset></legend>
        <p>For this Application to run well, You need the following:</p>
        <ul type="disc">
        <li>Any Internet Enabled Device </li>
        <li>Java Runtime Environment </li>
        <li>Java Enabled Web browsers </li>
        <li>Browser </li>
        <ol type="i" style="margin-left:10px;">
        <li>Internet Explorer </li>
        <li>Netscape</li>
        <li>Mozilla Firefox (Better)</li> 
        <li>Google Chrome (Good)</li>  
        </ol>
        </ul>
	</fieldset>

    </div><!-- close side_content -->
</div><!-- close content -->
<div id="divi">

</div>
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
</body>
</head>
</html>