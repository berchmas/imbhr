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
<fieldset><legend><b>Create/Delete Cashier </b> </legend>

<input type="checkbox" class="chkclass" id="one">Create cashier  <input type="checkbox" class="chkclass" id="all"> Delete cashier
<br><br>
<form method="post" action="management.php" name="autho" id="oneauthoform">

Names: <input type="text" name="name" size="8"> 
UserName: <input type="text" name="username" size="8"> 
Password: <input type="password" name="pswd" size="8">
Tel: <input type="text" name="tel" size="8">
<input type="submit" name="createCashier" value="Create" size="6"  >
 
 </form>
 
 <?php
if(isset($_POST['deleteCashier'])){
$cashier=$_POST['cashier'];	
include("connectdb.php");
$delcash=mysql_query("delete from user WHERE username='$cashier' ");
	}
?>
<form action="management.php" method="post" name="deautho" id="deauthoform" >

Cashier: <select name="cashier">
<?php
include("connectdb.php");
$queryCashier=mysql_query("SELECT username FROM user where role='cashier'");
while($row=mysql_fetch_array($queryCashier)){
$cashier=$row['username'];
print("<OPTION VALUE=$cashier>$cashier</OPTION>");
}
?> 
</select>

<input type="submit" name="deleteCashier" value="Delete" size="6" > 
</form>
</fieldset>

<?php
if(isset($_POST['createCashier'])){
$name=$_POST['name'];
$username=$_POST['username'];
$pswd=$_POST['pswd'];
$pswd=md5($pswd);
$tel=$_POST['tel'];
$branch=$_SESSION['branchsession'];
include("connectdb.php");
$queryCashier=mysql_query("SELECT username FROM user where username='$username'");
if($num=mysql_num_rows($queryCashier)){
?>
<script>
alert('This UserName has been taken.');
</script>
<?php
}
else{
$insertcash=mysql_query("INSERT INTO user (userid,name,username,pword,branch,role,telephone,code,authorized) VALUES('','$name','$username','$pswd','$branch','cashier','$tel','','1')");
?>
<script>
alert('Cashier has been created.');
</script>
<?php
}	
	}
?>

<br><br>
<fieldset><legend><b>Provision/Delete Transaction </b> </legend>
<input type="checkbox" class="chkclass" id="bus" >Provision <input type="checkbox" class="chkclass" id="rbus" >Delete Transaction
<br><br>
<form METHOD=POST  Name='settingcar' ACTION="management.php" id="setbusform"> 
Cashier: <select name="cashier">
<?php
include("connectdb.php");
$queryCashier=mysql_query("SELECT username FROM user where role='cashier'");
while($row=mysql_fetch_array($queryCashier)){
$cashier=$row['username'];
print("<OPTION VALUE=$cashier>$cashier</OPTION>");
}
?> 
</select>
Amount: <input type="text" name="amount">(+ or -)
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
Reason: <input type="text" name="reason">
<input type="submit" name="addremove" value="AddRemove">
 </form>
 

<form METHOD=POST  Name='settingcar' ACTION="management.php" id="resetbusform"> 
TransNo.: <input type="text" name="transno" size="6"> Reason: <input type="text" name="reason"> <select name="exchtype"><OPTION VALUE="">Select Trans. type</OPTION><OPTION VALUE="buy">Buy</OPTION><OPTION VALUE="sale">Sale</OPTION></select>
<input type="submit" name="deleteTrans" value="Delete">
 </form> 
 
 




 
<?php 
 if(isset($_POST['deleteTrans'])){
 $transno=$_POST['transno'];
 $reason=$_POST['reason'];
 $exchtype=$_POST['exchtype'];
 include("connectdb.php");
 $querydelchek=mysql_query("select * from buysale where transnobuysale='$transno' and exchtype='$exchtype'"); 
 if($num=mysql_num_rows($querydelchek) && ($reason!=null or $reason!="" or $reason!=" ") && $exchtype!=""){
$row=mysql_fetch_array($querydelchek);
$amount=$row['amount'];
$currency=$row['currency'];	
$exchamount=$row['exchamount'];	
$exchcurrency=$row['exchcurrency'];  
$exchtype=$row['exchtype'];   
$cashier=$row['cashier'];

if($exchtype=="buy"){
$queryupdate=mysql_query("update cashbox set amount=amount+'$exchamount' where currency='RWF'");
$queryupdate=mysql_query("update cashbox set amount=amount-'$amount' where currency='$currency'");
}else{
$queryupdate=mysql_query("update cashbox set amount=amount+'$exchamount' where currency='$exchcurrency'");
$queryupdate=mysql_query("update cashbox set amount=amount-'$amount' where currency='RWF'");

}

//$querydeltrans=mysql_query("delete from buysale where transno='$transno'");
$querydeltrans=mysql_query("update buysale set transvoided='1',voidedreason='$reason' where transnobuysale='$transno' and exchtype='$exchtype'");

?>
<script>
alert('Transaction has been deleted ');
</script>
<?php 
}else{
?>
<script>
alert('Check if the form is well filled or Transaction does not exist');
</script>
<?php
}
 }
 
 ?>
 
 
 
 
 
 
 
 </fieldset>
<br><br>
<fieldset><legend><b>Rates Managment </b> </legend>
<input type="checkbox" class="chkclass" id="def">Add new Rate  <input type="checkbox" class="chkclass" id="cust"> Update Existing Rate <input type="checkbox" class="chkclass" id="prep">Delete old Rate
<br><br>

<form action="management.php" method="post" id="deform">
Currency: <input type="text" name="currency" size="8">
Buy: <input type="text" name="amountbuy" size="8">
Sale: <input type="text" name="amountsale" size="8">
<input type="submit" name="addrate" value="Add">
</form>
<form action="management.php" method="post" id="custform">
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
Buy: <input type="text" name="amountbuy" size="8">
Sale: <input type="text" name="amountsale" size="8">
<input type="submit" name="updaterate" value="Update">

</form>
<form action="management.php" method="post" id="prepform">

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
<input type="submit" name="deleterate" value="Delete">
</form>
</fieldset>

<?php
if(isset($_POST['addrate'])){
$amountbuy=$_POST['amountbuy'];
$amountsale=$_POST['amountsale'];
$currency=$_POST['currency'];
include("connectdb.php");
$queryratecheck=mysql_query("SELECT * FROM rates where currency='$currency'");
if($num=mysql_num_rows($queryratecheck)){
?>
<script>
alert('The Currency Exist. Please try update');
</script>
<?php
}
else{
$insertcash=mysql_query("INSERT INTO rates (rateid,currency,locale,buy,sale) VALUES('','$currency','RWF','$amountbuy','$amountsale')");
?>
<script>
alert('New Rate has been inserted ');
</script>
<?php
}	
	}
?>

<?php
if(isset($_POST['updaterate'])){
$amountbuy=$_POST['amountbuy'];
$amountsale=$_POST['amountsale'];
$currency=$_POST['currency'];
include("connectdb.php");
$queryratecheck=mysql_query("SELECT * FROM rates where currency='$currency'");
if($num=mysql_num_rows($queryratecheck)){

$queryratecheck=mysql_query("update rates set buy='$amountbuy',sale='$amountsale' where currency='$currency'");

?>
<script>
alert('The rate has been updated. ');
</script>
<?php
}
else{
?>
<script>
alert(The Currency does not exist. Please try  add new currency'');
</script>
<?php
}	
	}
?>


<?php
if(isset($_POST['deleterate'])){
$currency=$_POST['currency'];
include("connectdb.php");
$queryratecheck=mysql_query("SELECT * FROM rates where currency='$currency'");
if($num=mysql_num_rows($queryratecheck)){

$queryratecheck=mysql_query("delete from rates where currency='$currency'");

?>
<script>
alert('The rate has been deleted');
</script>
<?php
}
else{
?>
<script>
alert(The rate does not exist');
</script>
<?php
}	
	}
?>





<?php
if(isset($_POST['addremove'])){
$cashier=$_POST['cashier'];
$amount=$_POST['amount'];
$currency=$_POST['currency'];
$reason=$_POST['reason'];
$date=date('Y-m-d');
$time=date('H:i:s');
if($amount < 0){
if($reason==null || $reason==" " || $reason==""){
?>
<script>
alert('Reason is required on negative amount');
</script>
<?php
exit();
}
}
include("connectdb.php");
$queryprovision=mysql_query("INSERT INTO provision (proid,date,time,name,currency,amount,reason ) VALUES('','$date','$time','$cashier','$currency','$amount','$reason')");
$queryCashierprovision=mysql_query("SELECT name FROM cashbox where name='$cashier' and currency='$currency'");
if($num=mysql_num_rows($queryCashierprovision)){
$queryUpdateprovision=mysql_query("update cashbox set amount=amount+$amount where name='$cashier' and currency='$currency'");
?>
<script>
alert('Provision record has been updated');
</script>
<?php
}
else{
$insertcash=mysql_query("INSERT INTO cashbox (cashid,name,currency,amount) VALUES('','$cashier','$currency','$amount')");
?>
<script>
alert('New provision record has been inserted ');
</script>
<?php
}	
	}
?>







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
