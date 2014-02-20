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

<?php
include("connectdb.php");
$queryratecheck=mysql_query("SELECT * FROM rates where currency='RWF'");
if(!$num=mysql_num_rows($queryratecheck)){
$mandatoryrecord=mysql_query("INSERT INTO rates (currency,locale,buy,sale) VALUES('RWF','RWF','1','1')");
}
?>

<HTML>
 <HEAD>
  <TITLE> EFS - Electronic Forex System-V1.0 </TITLE>
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
        $('#datepicker2').datepicker({
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
        $('#datepicker3').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat:'yy-mm-dd'
        });
        $('#datepicker4').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat:'yy-mm-dd'
        });
        $('#datepicker5').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat:'yy-mm-dd'
        });
	$('#datepicker6').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat:'yy-mm-dd'
        });
   $('#datepicker7').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat:'yy-mm-dd'
        });
        
   $('#datepicker8').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat:'yy-mm-dd'
        });      
});

</script>

<!-- jquery style -->

<style type="text/css">
    .alt { background-color: #CCCC99; }
    .hover { background-color: white; }
    .althover { background-color: white; } 
	.jqueryclass {border:1px solid black;border-collapse:collapse;}
</style>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.jqueryclass tr:even').addClass('alt');
	$('.jqueryclass tr:even').hover(
			function(){$(this).addClass('hover')},
			function(){$(this).removeClass('hover')}
	);	
	$('.jqueryclass tr:odd').hover(
			function(){$(this).addClass('althover')},
			function(){$(this).removeClass('althover')}
	);
	$('.jqueryclass tr').click(
			function(){$(this).addClass('althover')}
	);
});
</script>

<!-- end jquery style -->


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
<td><img src="ebus.gif" width="113" height="52" border="0" alt=""><div align="right"><small>You are loged as <?php echo $_SESSION['namesession']; ?><br>	 Forex:&nbsp;&nbsp;&nbsp;<B><?php echo $_SESSION['branchsession']; ?></div></small></td>
</tr>
</table>

<table width="100%" class="menu">
<tr bgcolor=#C0C0C0>
<TD><A HREF="management.php"><FONT SIZE="4" COLOR="#0000CC"><small><CENTER>Settings</CENTER></small></FONT></A></TD><td><A HREF="endofday.php"><FONT SIZE="4" COLOR="#0000CC"><small><CENTER>End of day</CENTER></small></FONT></A></TD><td><A HREF="report.php"><FONT SIZE="4" COLOR="#0000CC"><small><CENTER>Report</CENTER></small></FONT></A></TD></td><td><a href="logout.php">Logout</a></td>
</tr>
</table>
