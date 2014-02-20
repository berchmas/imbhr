<?php
include("headermanager.php");
?>
<!-- <script>
	$("#def").click(function() {
			$("#deform").show();
		});	
</script> -->
<script>
$(function(){ $('input[type="time"]').timepicker(); }
</script>

    
<script>
	$(function() {
		$("#deform").hide();	
		$("#custform").hide();	
		$("#prepform").hide();	
		$("#oneauthoform").hide();
                $("#deauthoform").hide();
                $("#setbusform").hide();
                $("#resetbusform").hide();
                $("#extrasbusform").hide();		
                $("#delform").hide();		
	});	
</script>
<script>
		//code bellow use checkboxes like radioboxes
$(function(){

$("input:checkbox.chkclass").click(function(){
$("input:checkbox.chkclass").not($(this)).removeAttr("checked");
$(this).attr("checked", $(this).attr("checked"));
});

$("#def").click(function(){
$("#deform").show();
$("#custform").hide();	
$("#prepform").hide();
$("#oneauthoform").hide();
$("#deauthoform").hide();
$("#setbusform").hide();
$("#resetbusform").hide();
 $("#extrasbusform").hide();	
  $("#delform").hide();
});

$("#cust").click(function(){
$("#custform").show();
$("#deform").hide();	
$("#prepform").hide();
$("#oneauthoform").hide();
$("#deauthoform").hide();
$("#setbusform").hide();
$("#resetbusform").hide();
 $("#extrasbusform").hide();	
   $("#delform").hide();			
});

$("#prep").click(function(){
$("#prepform").show();
$("#deform").hide();	
$("#custform").hide();	
$("#oneauthoform").hide();
$("#deauthoform").hide();
$("#setbusform").hide();
$("#resetbusform").hide();
 $("#extrasbusform").hide();		
   $("#delform").hide();			
});
$("#one").click(function(){
$("#oneauthoform").show();
$("#deform").hide();	
$("#custform").hide();	
$("#deauthoform").hide();
$("#prepform").hide();	
$("#setbusform").hide();
$("#resetbusform").hide();
 $("#extrasbusform").hide();		
   $("#delform").hide();		
});
$("#all").click(function(){
$("#deauthoform").show();
$("#deform").hide();	
$("#custform").hide();	
$("prepform").hide();
$("#oneauthoform").hide();
$("#setbusform").hide();	
$("#resetbusform").hide();
$("#extrasbusform").hide();		
  $("#delform").hide();		
});
$("#bus").click(function(){
$("#setbusform").show();
$("#deform").hide();	
$("#custform").hide();	
$("#oneauthoform").hide();
$("#deauthoform").hide();
$("#prepform").hide();
$("#custform").hide();
$("#resetbusform").hide();
 $("#extrasbusform").hide();	
 $("#delform").hide();			
			
});
$("#rbus").click(function(){
$("#resetbusform").show();
$("#deform").hide();	
$("#custform").hide();	
$("#oneauthoform").hide();
$("#deauthoform").hide();
$("#setbusform").hide();
$("#prepform").hide(); 
$("#extrasbusform").hide();	
$("#delform").hide();					
});
$("#extrasbus").click(function(){
$("#extrasbusform").show();
$("#deform").hide();	
$("#custform").hide();	
$("#oneauthoform").hide();
$("#deauthoform").hide();
$("#setbusform").hide();
$("#prepform").hide(); 
$("#resetbusform").hide();	
$("#delform").hide();					
});
$("#deletextrasbus").click(function(){
	$("#delform").show();				
$("#extrasbusform").hide();
$("#deform").hide();	
$("#custform").hide();	
$("#oneauthoform").hide();
$("#deauthoform").hide();
$("#setbusform").hide();
$("#prepform").hide(); 
$("#resetbusform").hide();	
});

});
</script>
<br><br>
<fieldset><legend><b>Add/Delete Other Inflow/Outflow </b> </legend>

<input type="checkbox" class="chkclass" id="one">Add Other Inflow/Outflow  <input type="checkbox" class="chkclass" id="all"> Delete Other Inflow/Outflow
<br><br>
<form method="post" action="endofday.php" name="autho" id="oneauthoform">

Date: <input type="text" name="opdate" size="8" id='datepicker2' onClick='GetDate(this)' title='Click to select date'> 
Currency: <select name="currency">
<?php
include("connectdb.php");
$queryrate=mysql_query("SELECT currency FROM rates");
while($row=mysql_fetch_array($queryrate)){
$rate=$row['currency'];
print("<OPTION VALUE=$rate>$rate</OPTION>");
}
?>
</select>
Opening Position: <input type="text" name="openpos" size="8">
Other Inflow: <input type="text" name="inflow" size="8"> 
Other Outflow: <input type="text" name="outflow" size="8">
<input type="submit" name="save" value="Save" size="6"  >
 
 </form>
 
 <?php
if(isset($_POST['save'])){
$opdate=$_POST['opdate'];
$currency=$_POST['currency'];
$openpos=$_POST['openpos'];
$inflow=$_POST['inflow'];
$outflow=$_POST['outflow'];
$operator=$_SESSION['usernamesession'];
include("connectdb.php");

$insertdayop=mysql_query("INSERT INTO dayclose (opid,opdate,currency,openpos,otherinflow,otheroutflow,operator) VALUES('','$opdate','$currency','$openpos','$inflow','$outflow','$operator')");
$checkupdatebuy=mysql_query("select SUM(amount)as amounts from buysale where currency='$currency' and transdate='$opdate' and transvoided=0 group by currency");
$checkupdatesale=mysql_query("select SUM(exchamount) as exchamounts  from buysale where exchcurrency='$currency' and transdate='$opdate' and transvoided=0 group by exchcurrency");
if($num1=mysql_num_rows($checkupdatebuy)){
$row1=mysql_fetch_array($checkupdatebuy);
$purchase=$row1['amounts'];
$updatebuy=mysql_query("update dayclose set purchase='$purchase' where opdate='$opdate' and currency='$currency'");
}

if($num2=mysql_num_rows($checkupdatesale)){
$row2=mysql_fetch_array($checkupdatesale);
$sale=$row2['exchamounts'];
$updatesale=mysql_query("update dayclose set sales='$sale' where opdate='$opdate' and currency='$currency'");
}
$updatebalance=mysql_query("update dayclose set balance=(openpos+purchase+otherinflow)-(otheroutflow+sales) where opdate='$opdate' and currency='$currency'");


print("Saved successfull");
}
?>
<form action="endofday.php" method="post" name="deautho" id="deauthoform" >
Date: <input type="text" name="opdate" size="8" id='datepicker3' onClick='GetDate(this)' title='Click to select date'>
Currency: <select name="currency">
<?php
include("connectdb.php");
$queryrate=mysql_query("SELECT currency FROM rates");
while($row=mysql_fetch_array($queryrate)){
$rate=$row['currency'];
print("<OPTION VALUE=$rate>$rate</OPTION>");
}
?>
</select>
<input type="submit" name="deleteops" value="Delete" size="6" > 
</form>

<?php
if(isset($_POST['deleteops'])){
$opdate=$_POST['opdate'];
$currency=$_POST['currency'];
include("connectdb.php");
$deletedayop=mysql_query("delete from dayclose where opdate='$opdate' and currency='$currency'");
print("Daily Operation Deleted");	
	}
?>
</fieldset>

<fieldset><legend><b>Last Day by Currency </b> </legend>
<?php
include("connectdb.php");
$lastdayop=mysql_query("select * from (select * from dayclose  order by opdate desc) as last group by last.currency");
print("<table width=100% border=1 style=border-collapse:collapse; class=jqueryclass>
<tr>
<td><b>Date</b></td>
<td><b>Currency</b></td>
<td><b>Opening Position</b></td>
<td><b>Purchase</b></td>
<td><b>Other Inflow</b></td>
<td><b>Sales</b></td>
<td><b>Other Outflow</b></td>
<td><b>Balance inflow and outflow</b></td>
</tr>");
while($row=mysql_fetch_array($lastdayop)){
$opdate=$row['opdate'];
$currency=$row['currency'];
$openpos=number_format($row['openpos']);
$purchase=number_format($row['purchase']);
$otherinflow=number_format($row['otherinflow']);
$otheroutflow=number_format($row['otheroutflow']);
$sales=number_format($row['sales']);
$balance=number_format($row['balance']);

print("<tr>
<td>$opdate</td>
<td>$currency</td>
<td><div align=right>$openpos</td>
<td><div align=right>$purchase</td>
<td><div align=right>$otherinflow</td>
<td><div align=right>$sales</td>
<td><div align=right>$otheroutflow</td>
<td><div align=right>$balance</td>
</tr>");
}
print("</table>");
	
?>
</fieldset>

 <br><br> <br><br> <br><br>
<table width="100%">
  <TR>
	<TD><?php include('copyright.html'); ?></TD>
  </TR>
  </TABLE></CENTER>	


	
 </BODY>
</HTML>
 </BODY>
</HTML>
