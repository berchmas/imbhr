<?php
session_start();
?>
<HTML>
<HEAD>
<?php
include('../headers/title.html');
?>
<script language="JavaScript" type="text/javascript">

var win = null;
function newWindow(mypage,myname,w,h,features) {
  var winl = (screen.width-w)/2;
  var wint = (screen.height-h)/2;
  if (winl < 0) winl = 0;
  if (wint < 0) wint = 0;
  var settings = 'height=' + h + ',';
  settings += 'width=' + w + ',';
  settings += 'top=' + wint + ',';
  settings += 'left=' + winl + ',';
  settings += features;
  win = window.open(mypage,myname,settings);
  win.window.focus();
}

function NoConfirm ()
{
window.close()
//win = top;
//win.opener = top;
//setTimeout("self.close()", 100);
}
function closeWin()
{
myWindow.close();
}
</script>
</HEAD>
 
 <!-- <BODY bgcolor=#C0C0C0> -->
  <BODY bgcolor=#D0D0D0><center>
 <!-- <div align=right><h6><font color=#FF0000><?php $msg=$_SESSION['invalid']; print("$msg"); ?></font></h6></div> 
<div align="right"> <FORM METHOD=POST ACTION="login.php">Username:<INPUT TYPE="text" SIZE="17" NAME="userrole" STYLE="width:5em;">Password:<INPUT TYPE="password" SIZE="17" NAME="userpsw" STYLE="width:5em;"><INPUT TYPE="submit" NAME="sublogin" value="Login" STYLE="width:4em;"></FORM></div>-->
 
 <BR><BR><BR><BR><BR><BR>
<!--<img src="images/logo/pihHands3.gif" width="226" height="104" border="0" alt=""> -->
<img src="images/logo/pihHands4.gif" width="265" height="267" border="0" alt="">
<h6>Welcome to</h6><h6>IMB Leave Management System</h6><BR><BR>
<!--<a href="#null" onClick="newWindow('index1.php','','1366','860','scrollbars=yes,statusbar=no');">Click Here to Start</a> --><BR>
<a href="#null" onClick="newWindow('login/index1.php','','','','scrollbars=yes,statusbar=no');">Start from here</a>
  <!-- Menu -->

<!-- Content area -->

	
 </BODY> 
 
</HTML>
