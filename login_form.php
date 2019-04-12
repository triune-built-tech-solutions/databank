
<html style="height: 590px; margin-top: 34px !important;" toolbar_fixed="1">
<title>Login</title>
<link rel="shortcut icon" href="old_assets/images/icon.gif" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="old_assets/css/styles.css">

</head>
<body  bgcolor="#FFFFFF">
<br>
<p align="center"><a href="index.php">Back To Home Page.</a>
<form name="loginForm" method="post" action="admin/processlogin.php">
  <table width="800" height="450" cellspacing="0" cellpadding="0" background="old_assets/images/login.gif" align="center">
    
    <tbody><tr>
  <td width="20" height="60">&nbsp;</td>
  <td colspan="2">&nbsp;</td>
</tr>

<tr>
  <td width="20" height="40">&nbsp;</td>
  <td colspan="2" class="loginerror" align="left">&nbsp;
    
       
    </td>
</tr>

<tr>
  <td valign="top" colspan="3" height="180">
    <table cellspacing="0" cellpadding="0">
      <tbody><tr>
        <td width="250">
          <table>
            <tbody><tr>
              <td align="right" height="25" width="90" class="logintext">Username</td>
              <td><input type="text" name="username" size="20" maxlength="161" autocomplete="off"></td>
            </tr>
            <tr>
              <td align="right" height="25" width="90" class="logintext">Password</td>
              <td><input type="password" name="password" size="20" autocomplete="off"></td>
            </tr>
          <tr>
              <td height="25" width="90">&nbsp;</td>
              <td class="logintext2">
                <input type="checkbox" name="rememberPass">Remember Password</td>
            </tr>
          <tr>
              <td height="105" width="90">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </tbody></table>
        </td>
        <td valign="top" width="120">
          <table width="100%">
            <tbody><tr>
              <td height="40" align="center" class="logintext3">
              <input type="submit" name="login" Value="Login">
              </td></tr>
          </tbody></table>
        </td>
      </tr>
    </tbody></table>
  </td>
</tr>

<tr>
    <td width="20">&nbsp;</td>
    <td class="copyright" colspan="2" height="60"><br><br></td></tr>
</tbody></table>
</form>
<p align="center">Username and Password combination not correct</p>

</body></html>