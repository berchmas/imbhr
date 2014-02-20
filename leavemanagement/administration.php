<?php
include("headeradmin.php");
?>
<fieldset><legend>Fill the form carefully to set a car  </legend>
</TABLE></TD>
  </TR>
  <TR>
<TD><CENTER><FORM METHOD=POST  Name='settingcar' ACTION="administration.php" onsubmit="return validateForm()">
		<TABLE>
	<TR>
		<TD><INPUT TYPE="text" NAME="date" size="7" value="<?php $date=date('Y-m-d'); print("$date")?>" title="Date" readonly="on"></TD>

		<TD><SELECT NAME="heure" STYLE="width:5.5em" title="Time">
		<OPTION VALUE="" selected></OPTION>
		<?php
		
		include("connectdb.php");
                                       
						$querroute=mysql_query("SELECT DISTINCT schedule_time FROM car_schedule");
						while($row=mysql_fetch_array($querroute)){
					    $scheduletime=$row['schedule_time'];
					    print("<OPTION VALUE=$scheduletime>$scheduletime</OPTION>");
					    }
						?>
	</td>	

		
	<TD><SELECT NAME="carid" title="Car ID">	<OPTION VALUE="" SELECTED>

	<?php
	include('connectdb.php');
    $query=("Select carid from cars ORDER BY carid");
    $result= mysql_query($query); 
	while($row=mysql_fetch_array($result)){
	$car=$row['carid'];
    print("<OPTION VALUE=$car>$car");		
	}
	mysql_close();
	?>	
</TD>
<TD><SELECT NAME="route" STYLE="width:13.5em" title="Trip">
		<OPTION VALUE="" selected></OPTION>
		<?php
		$branch=$_SESSION['branchsession'];
		include("connectdb.php");
                                       
						$querroute=mysql_query("SELECT DISTINCT route FROM trip_price where branch='$branch' ORDER BY route");
						while($row=mysql_fetch_array($querroute)){
					    $route=$row['route'];
					    print("<OPTION VALUE=$route>$route</OPTION>");
					    }
						?></TD>
	


	<TD><SELECT NAME="drivername" title="Driver name">
	<OPTION VALUE="" SELECTED>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php
	include('connectdb.php');
    $query=("Select drivername from drivers ORDER BY drivername");
    $result= mysql_query($query); 
	while($row=mysql_fetch_array($result)){
	$drivername=$row['drivername'];
    print("<OPTION VALUE=$drivername>$drivername");		
	}
	mysql_close();
	?>	
</SELECT></TD>
<td><input type="number" name="limit" value="" size="5"  title="fix number of passenger" /> </td>

		<TD colspan=2><CENTER><INPUT TYPE="submit" NAME="submit2" VALUE=Set onClick="if(confirm('Do you really want to do this operation?'))
alert('click ok!');
else alert('Do this once in hour!')"> <INPUT TYPE="reset" value=DELETE></CENTER></TD>
	</TR>
	</TABLE>
	</FORM></CENTER>
  </TR></fieldset>
 <?php
//to update car Id and driver
if(isset($_POST['submit2'])){
$date=$_POST['date'];
$heure=$_POST['heure'];
$route=$_POST['route'];
$carid=$_POST['carid'];
$drivername=$_POST['drivername'];
$limit=$_POST['limit'];
$settime=date('H:i:s');
if($heure=="" or $carid=="" or $drivername==""){
print("<FONT SIZE=6 COLOR=#0000CC><CENTER><B>Please, one or more fields is empty <BR>fill it.</B></CENTER></FONT>");
print("<BR><BR><BR><BR><CENTER><FORM METHOD=POST ACTION=administration.php>
	<INPUT TYPE=submit VALUE=BACK>
</FORM></CENTER>");
exit();
}
if($date==""){
$date=date("Y-m-d");
}
else {
include('connectdb.php');
//session_start();
$branch=$_SESSION['branchsession'];
$cashierId=$_SESSION['useridsession'];
$heure=$_POST['heure'];
$query=("SELECT ticket_date FROM sale_ticket WHERE ticket_date='$date' AND ticket_time='$heure' ");
$results=mysql_query($query);
$rows=mysql_num_rows($results); 
$rate=($rows/29)*100;
$querupdate=mysql_query("UPDATE `sale_ticket` SET `carid`='$carid',`drivername`='$drivername'  WHERE `ticket_date`='$date' AND `ticket_time`='$heure' and route='$route' AND `branch`='$branch' AND carid='' AND drivername=''  limit $limit");
/*$insertquery=mysql_query("INSERT INTO carset (opid,date,optime,setedtime,carid,drivername,pnumber,rate,branch,operatorid) VALUES ('','$date','$settime','$heure','$carid','$drivername','$rows','$rate','$branch','$cashierId')");*/
//$result=mysql_query($querupdate);

print("<BR><BR><BR><BR><BR><CENTER><FONT SIZE=4 COLOR=#000099>Operation saved</FONT></CENTER>");
print("<BR><BR><BR><BR><CENTER><FORM METHOD=POST ACTION=administration.php>
	<INPUT TYPE=submit VALUE=BACK>
</FORM></CENTER>");
	}
	mysql_close();
	}
?>
<div style="height:300px;overflow:auto;">
<?php
$branch=$_SESSION['branchsession'];
$cashierId=$_SESSION['useridsession'];
$date=date('Y-m-d');
include('connectdb.php');
$queryreport=mysql_query("SELECT * FROM `carset` WHERE `branch` ='$branch'AND `date`='$date' order by setedtime desc ");
if($num=mysql_num_rows($queryreport)){
	print("<table width=100% border=1 style=border-collapse:collapse;><tr><td> Date</td><td>Time</td><td>Car ID</td><td>Driver name</td><td>number of passanger</td><td>filling rates</td></tr>");

	while($rowreport=mysql_fetch_array($queryreport)) {
		$drivername=$rowreport['drivername'];
		$date=$rowreport['date'];
		$time=$rowreport['setedtime'];
		$carid=$rowreport['carid'];
		$numb=$rowreport['pnumber'];
		$percentage=$rowreport['rate'];	
		 	
		
		print("<tr><td>$date</td><td>$time</td><td>$carid</td><td>$drivername</td><td><div align=right>$numb</td><td><div align=right>$percentage</td></tr>");
	print("</table>");	
	}}
	mysql_close();
	?>
</div>

 <br><br> <br><br> <br><br>
<table width="100%">
  <TR>
	<TD><CENTER><FONT SIZE="2" COLOR=""> COPYRIHGT &copy; <B>VIRUNGA EXPRESS LTD</B>: ALL RIGHTS RESERVED</FONT></CENTER></TD>
  </TR>
  </TABLE></CENTER>	


	
 </BODY>
</HTML>
 </BODY>
</HTML>
