<?php
require_once("../includes/header.php");
//session_start();
require_once("checkUser.php");
//include("../includes/auto_logout.php");
?>

	<script type="text/JavaScript">

        function AutoRefresh(t) {
            setTimeout("location.reload(true);", t);
        }

	</script>

	<div id="content"><!-- open content -->
		<div id="depart">

			<div onload="AutoRefresh(50000);">

				<table width="1000" border="0" align="center" id="searchBorder2" height="39">
					<tr>
						<td height="33" valign="top">
							<form action="" method="post">
								<table width="1000" border="0" align="center" height="80" cellpadding="5"
								       cellspacing="5">
									<tr bgcolor="#EFEFEF">
										<td height="20" colspan="7">
											<div align="center">Users Status</div>
										</td>
									</tr>
									<tr>
										<td width="28" height="20" bgcolor="#FFCC99"><strong>S/N</strong></td>
										<td width="99" bgcolor="#FFCC99"><strong>First Name</strong></td>
										<td width="124" bgcolor="#FFCC99"><strong>Last Name</strong></td>
										<td width="79" bgcolor="#FFCC99"><strong>Username</strong></td>

										<td width="78" bgcolor="#FFCC99"><strong>Access Right</strong></td>
										<td width="58" bgcolor="#FFCC99">Online <strong>Status</strong></td>
									</tr>
									<?php
									$sql = "SELECT * FROM staff_reg WHERE logged_users='1'";
									$res = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
									$cnt = 0;
									while ($row = mysqli_fetch_assoc($res)) {
										$cnt++;
										?>
										<tr id="<?php if ($cnt % 2 == 0) echo "odd"; else echo "even"; ?>"
										    class="record">
											<td height="20"><?php echo $cnt; ?></td>
											<td><?php echo $row['first_name']; ?></td>
											<td><?php echo $row['last_name']; ?></td>
											<td><?php echo $row['username']; ?></td>

											<td><?php if ($row['access_right'] == 1) {
													echo "Director";
												} else if ($row['access_right'] == 2) {
													echo "Scheduled officer";
												} else if ($row['access_right'] == 3) {
													echo "Area Manager";
												} else if ($row['access_right'] == 4) {
													echo "Super Administrator";
												} else if ($row['access_right'] == 5) {
													echo "Administrator";
												} else echo "";
												?></td>
											<td><?php if ($row['logged_users'] == 1) {
													echo '<font color="#6c0">Online</font>';
												} else {
													echo '<font color="#f00">Offline</font>';
												} ?></td>
										</tr>
										<?php
									}
									?>
								</table>
								<table width="1000" border="0" align="center" id="searchBorder3" height="38">
									<tr>
										<td height="34"></td>
									</tr>
								</table>
							</form>
						</td>
					</tr>
				</table>

			</div>
		</div>
	</div>

<?php require_once("../includes/footer.php") ?>