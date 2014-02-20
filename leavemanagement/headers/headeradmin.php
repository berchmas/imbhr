<?php
session_start();
if($_SESSION['usernamesession']==null and $_SESSION['passwordsession']==null and $_SESSION['rolesession']==null){
header('location: index1.php');
$inactive = 60;
$session_life = time() - $_SESSION['timeout'];
if($session_life < $inactive)
{ 
session_destroy(); 
header("location: index1.php"); 
}
$_SESSION['timeout']=time();
}
?>

<HTML>
  <TITLE> EBTS - Electronic Bus Ticketing System-V1.0 </TITLE>
  <meta name="generator" content="Bluefish 1.0.7">
  <meta name="author" content="jberchmas">
  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="">

<style type="text/css">
a{display:block;color:black;}
a:link {text-decoration:none;}    /* unvisited link */
a:visited {text-decoration:none;} /* visited link */
a:hover {background:#E8E8E8;}     /* mouse over link */
a:active {background:#E8E8E8;}    /* selected link */
</style>
<link rel="shortcut icon" href="favicon.ico">  
        <link type="text/css" href="ui.theme.css" rel="stylesheet" />
        <script type="text/javascript" src="jquery-1.3.2.js"></script>
        <script type="text/javascript" src="ui.core.js"></script>
        <script type="text/javascript" src="ui.datepicker.js"></script>
<script type="text/javascript">
$(function() {
       $('#datepicker').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat:'yy-mm-dd'
        });
        $('#datepickerFrom').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat:'yy-mm-dd'
        });
	$('#datepickerTo').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat:'yy-mm-dd'
        });
});
</script>

<script>
function validateForm()
{
var x=document.forms["settingcar"]["drivername"].value;
if (x==null || x=="")
  {
  alert(" Driver name  must be filled out");
  return false;
  }
  var y=document.forms["settingcar"]["heure"].value;
if (y==null || y=="")
{
  alert(" Departure time must be filled out");
  return false;
  }
  var t=document.forms["settingcar"]["route"].value;
if (t==null || t=="")
{
  alert(" Trip must be filled out");
  return false;
  }
   var d=document.forms["settingcar"]["carid"].value;
if (d==null || d=="")
{
  alert("Car ID must be filled out");
  return false;
  }
}
</script>

 <!-- <BODY bgcolor=#C0C0C0> -->
  <BODY bgcolor=#D0D0D0>
  <table width="100%">
<tr bgcolor=#C0C0C0>
<td><img src="ebus.gif" width="113" height="52" border="0" alt=""><div align="right"><small>You are loged as <?php echo $_SESSION['namesession']; ?><br>	 Branch:&nbsp;&nbsp;&nbsp;<B><?php echo $_SESSION['branchsession']; ?></div></small></td>
</tr>
</table>

<table width="100%" class="menu">
<tr bgcolor=#C0C0C0>
<TD><A HREF="administration.php"><FONT SIZE="4" COLOR="#0000CC"><small><CENTER>Set  a bus</CENTER></small></FONT></A></TD>		<TD><A HRE=".php"><FONT SIZE="4" COLOR="#0000CC"><small><CENTER>Cancel a ticket</CENTER></small></FONT></A></TD><td>Pay Reservation</td><td>Re-Print ticket</td><td><A HREF="report.php"><FONT SIZE="4" COLOR="#0000CC"><small><CENTER>Report</CENTER></small></FONT></A></TD></td><td><a href="logout.php">Logout</a></td>
</tr>
</table>
