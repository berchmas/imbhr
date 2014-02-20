<?php
include("headermanager.php");
?>

<script type="text/javascript" src="jquery.print.js"></script>
	<script type="text/javascript"> 
		// When the document is ready, initialize the link so
		// that when it is clicked, the printable area of the
		// page will print.	
		$(
			function(){
 				$(".printable").hide();	
 					
				// Hook up the print link.
				$( ".print" ).click(
						function(){
							// Print the DIV.
							//$("#ticket").reset();
							$( ".printable" ).print(); 
							$( ".printable" ).remove();
							// Cancel click event.
							return( false );
						}						 
						);
						
						
						//$(".printable2").hide();	
 					
				// Hook up the print link.
				$( ".print" ).click(
						function(){
							// Print the DIV.
							//$("#ticket").reset();
							$( ".printable2" ).print(); 
							$( ".printable2" ).remove();
							// Cancel click event.
							return( false );
						}						 
						);
				 
			}
			); 
	</script>
	<script>
		//code bellow use checkboxes like radioboxes
$(function(){
$("input:checkbox.chkclass").click(function(){
$("input:checkbox.chkclass").not($(this)).removeAttr("checked");
$(this).attr("checked", $(this).attr("checked"));
});
});
</script>
<script>
	$(function() {
		$("#triprepone").hide();	
		$("#triprepall").hide();
		$("#provisionform").hide();
		$("#buysaleform").hide();	
				
	});	
</script>
<script>
		//code bellow use checkboxes like radioboxes
$(function(){

$("input:checkbox.chkclass").click(function(){
$("input:checkbox.chkclass").not($(this)).removeAttr("checked");
$(this).attr("checked", $(this).attr("checked"));
});

$("#onetrip").click(function(){
$("#triprepone").show();
$("#triprepall").hide();	
});
$("#alltrip").click(function(){
$("#triprepall").show();
$("#triprepone").hide();	
});

$("#provision").click(function(){
$("#provisionform").show();
$("#buysaleform").hide();	
});

$("#buysale").click(function(){
$("#buysaleform").show();
$("#provisionform").hide();	
});



});
</script>
<br><br>
<fieldset><legend><b>BNR reports</b>  </legend>
<input type="checkbox" class="chkclass" id="onetrip">Buy  <input type="checkbox" class="chkclass" id="alltrip"> Sale
<br><br>
<form action="report.php" method="post" id="triprepone">
From: <INPUT TYPE='text' SIZE='7' NAME='dateFrom' id='datepickerTo' onClick='GetDate(this)' title='Click to select date'>
To: <INPUT TYPE='text' SIZE='7' NAME='dateTo' id='datepickerFrom' onClick='GetDate(this)' title='Click to select date'>
<input type="submit" name="viewBuyRepo" value="View">
</form>
<form action="report.php" method="post" id="triprepall">
From: <INPUT TYPE='text' SIZE='7' NAME='dateFrom' id='datepicker' onClick='GetDate(this)' title='Click to select date'>
To: <INPUT TYPE='text' SIZE='7' NAME='dateTo' id='datepicker2' onClick='GetDate(this)' title='Click to select date'>
<input type="submit" name="viewSaleRepo" value="View">
</form>
</fieldset>
<br>




<fieldset><legend><b>Provision/Buy Sale reports</b>  </legend>
<input type="checkbox" class="chkclass" id="provision">Provision  <input type="checkbox" class="chkclass" id="buysale"> Buy Sale
<br><br>
<form action="report.php" method="post" id="provisionform">
From: <INPUT TYPE='text' SIZE='7' NAME='dateFrom' id='datepicker3' onClick='GetDate(this)' title='Click to select date'>
To: <INPUT TYPE='text' SIZE='7' NAME='dateTo' id='datepicker4' onClick='GetDate(this)' title='Click to select date'>
<input type="submit" name="proRepo" value="View">
</form>
<form action="report.php" method="post" id="buysaleform">
From: <INPUT TYPE='text' SIZE='7' NAME='dateFrom' id='datepicker5' onClick='GetDate(this)' title='Click to select date'>
To: <INPUT TYPE='text' SIZE='7' NAME='dateTo' id='datepicker6' onClick='GetDate(this)' title='Click to select date'>
<input type="submit" name="buySaleRepo" value="View">
</form>
</fieldset>
<br>

<fieldset><legend><b>Print Receipt</b>  </legend>
<form action="report.php" method="post">
<input type="text" name="transnobuysale" size="4">
<select name="transtype">
<option value="buy">Buy</option>
<option value="sale">Sale</option>
</select>
<input type="submit" name="search" value="Search">
<INPUT TYPE="submit" NAME="print" VALUE="Print" class="print" title="Click here to print slip">
</form>

<?php
if(isset($_POST['search'])){
$transtype=$_POST['transtype'];
$transnobuysale=$_POST['transnobuysale'];
include("connectdb.php");
$querychecktransno2=mysql_query("SELECT * FROM buysale where exchtype='$transtype' and transnobuysale='$transnobuysale' and transvoided=0");
if($num1=mysql_num_rows($querychecktransno2)){
$row2=mysql_fetch_array($querychecktransno2);
$clientNames=$row2['name'];
$cashierName=$row2['cashier'];
$transdate=$row2['transdate'];
print("Transaction available. Customer: <b>$clientNames</b> , Done by: <b>$cashierName</b> , On: <b>$transdate</b> ");
}else{
print("Transaction not available");
}
if($transtype=="sale"){
$querychecktransno=mysql_query("SELECT * FROM buysale where exchtype='$transtype' and transnobuysale='$transnobuysale' and transvoided=0");
if($num=mysql_num_rows($querychecktransno)){
$row=mysql_fetch_array($querychecktransno);
$transno=$row['transnobuysale'];
$amoun=$row['amount'];
$exchamoun=$row['exchamount'];
$amount=number_format($amoun);
$exchamount=number_format($exchamoun);
$currency=$row['currency'];
$exchcurrency=$row['exchcurrency'];
$branch=$_SESSION['branchsession'];
$tel=$_SESSION['telephonesession'];
$transdate=$row['transdate'];
$clientNames=$row['name'];
$rate=$row['rate'];
$identif=$row['identification'];
$country=$row['country'];
$reason=$row['reason'];
$cashierName=$row['cashier'];

print("<div class='printable'><br><TABLE  width=300>
<TR>
	<TD>");
print("<B><FONT SIZE=3>Forex Bureau: $branch</FONT></B><BR>");
print("<B><FONT SIZE=3>Tel.: $tel</FONT></B><BR><BR>");
//print("<B><FONT SIZE=3>P.O.Box: </FONT></B><BR><BR><BR>");

print("<B><FONT SIZE=3> <div align=center><U>SELLING RECEIPT</U></div> </FONT></B><BR><BR>");
print("TRANS DATE.: $transdate<BR>TRANS NO.: <B>$transno</B><BR>CLIENT NAMES: <B>$clientNames</B><BR>Money From Client: <B>$amount $currency</B><BR>Money From Forex: <B>$exchamount $exchcurrency</B><BR>Rate: <B>$rate</B><BR>ID: <B>$identif</B><BR>Country: <B>$country</B><BR>Reason: <B>$reason</B>");


print("<CENTER> WELCOME AGAIN! </CENTER>");
print("<BR><FONT SIZE=1><div align=left>Client signature</div><div align=right>Operator: $cashierName</div></FONT>
</TD>
</TR>
</TABLE>");



print("=======================<br><br><br>");
print("=======================");


print("<br><TABLE width=300>
<TR>
	<TD>");
print("<B><FONT SIZE=3>Forex Bureau: $branch</FONT></B><BR>");
print("<B><FONT SIZE=3>Tel.: $tel</FONT></B><BR><BR>");
//print("<B><FONT SIZE=3>P.O.Box: </FONT></B><BR><BR><BR>");

print("<B><FONT SIZE=3> <div align=center><U>SELLING RECEIPT</U></div> </FONT></B><BR><BR>");
print("TRANS DATE.: $transdate<BR>TRANS NO.: <B>$transno</B><BR>CLIENT NAMES: <B>$clientNames</B><BR>Money From Client: <B>$amount $exchcurrency</B><BR>Money From Forex: <B>$exchamount $currency</B><BR>Rate: <B>$rate</B><BR>ID: <B>$identif</B><BR>Country: <B>$country</B><BR>Reason: <B>$reason</B>");


print("<CENTER> WELCOME AGAIN! </CENTER>");
print("<BR><FONT SIZE=1><div align=left>Client signature</div><div align=right>Operator: $cashierName</div></FONT>
</TD>
</TR>
</TABLE></div>");
}
}

if($transtype=="buy"){
$querychecktransno=mysql_query("SELECT * FROM buysale where exchtype='$transtype' and transnobuysale='$transnobuysale' and transvoided=0");
if($num=mysql_num_rows($querychecktransno)){
$row=mysql_fetch_array($querychecktransno);
$transno=$row['transnobuysale'];
$amoun=$row['amount'];
$exchamoun=$row['exchamount'];
$amount=number_format($amoun);
$exchamount=number_format($exchamoun);
$currency=$row['currency'];
$exchcurrency=$row['exchcurrency'];
$branch=$_SESSION['branchsession'];
$tel=$_SESSION['telephonesession'];
$transdate=$row['transdate'];
$clientNames=$row['name'];
$rate=$row['rate'];
//$identif=$row['identification'];
//$country=$row['country'];
//$reason=$row['reason'];
$cashierName=$row['cashier'];

print("<div class='printable'><br><TABLE width=300>
<TR>
	<TD>");
print("<B><FONT SIZE=3>Forex Bureau: $branch</FONT></B><BR>");
print("<B><FONT SIZE=3>Tel.: $tel</FONT></B><BR><BR>");
//print("<B><FONT SIZE=3>P.O.Box: </FONT></B><BR><BR><BR>");

print("<B><FONT SIZE=3> <div align=center><U>BUYING RECEIPT</U></div> </FONT></B><BR><BR>");
print("TRANS DATE.: $transdate<BR>TRANS NO.: <B>$transno</B><BR>CLIENT NAMES: <B>$clientNames</B><BR>Money From Client: <B>$amount $currency</B><BR>Money From Forex: <B>$exchamount $exchcurrency</B><BR>Rate: <B>$rate</B>");


print("<CENTER> WELCOME AGAIN! </CENTER>");
print("<BR><FONT SIZE=1><div align=left>Client signature</div><div align=right>Operator: $cashierName</div></FONT>
</TD>
</TR>
</TABLE>");
print("=======================<br><br><br>");
print("=======================");
print("<br><TABLE width=300>
<TR>
	<TD>");
print("<B><FONT SIZE=3>Forex Bureau: $branch</FONT></B><BR>");
print("<B><FONT SIZE=3>Tel.: $tel</FONT></B><BR><BR>");
//print("<B><FONT SIZE=3>P.O.Box: </FONT></B><BR><BR><BR>");

print("<B><FONT SIZE=3> <div align=center><U>BUYING RECEIPT</U></div> </FONT></B><BR><BR>");
print("TRANS DATE.: $transdate<BR>TRANS NO.: <B>$transno</B><BR>CLIENT NAMES: <B>$clientNames</B><BR>Money From Client: <B>$amount $currency</B><BR>Money From Forex: <B>$exchamount $exchcurrency</B><BR>Rate: <B>$rate</B>");


print("<CENTER> WELCOME AGAIN! </CENTER>");
print("<BR><FONT SIZE=1><div align=left>Client signature</div><div align=right>Operator: $cashierName</div></FONT>
</TD>
</TR>
</TABLE></div>");
}
}
}
?>
</fieldset>

<fieldset><legend><b>Print Monthly Report</b>  </legend>
<form action="report.php" method="post">
From: <INPUT TYPE='text' SIZE='7' NAME='dateFrom' id='datepicker7' onClick='GetDate(this)' title='Click to select date'>
To: <INPUT TYPE='text' SIZE='7' NAME='dateTo' id='datepicker8' onClick='GetDate(this)' title='Click to select date'>
<input type="submit" name="view" value="View">
<INPUT TYPE="submit" NAME="print" VALUE="Print" class="print" title="Click here to print slip">
</form>

<?php
if(isset($_POST['view'])){
$dateFrom=$_POST['dateFrom'];
$dateTo=$_POST['dateTo'];
$branch=$_SESSION['branchsession'];
$tel=$_SESSION['telephonesession'];
include("connectdb.php");
$lastdayop=mysql_query("select * from dayclose where opdate>='$dateFrom' and opdate<='$dateTo' order by opdate,currency");
print("<div class='printable2'>
<B>FOREX BUREAU: $branch <BR>
TEL: $tel</B>
<br>
<br>
<br>
<br>
<CENTER><B>MONTHLY REPORT OF $dateFrom TO $dateTo</B></CENTER>
<br>
<br><table width=100% border=1 style=border-collapse:collapse; class=jqueryclass>
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
print("</table></div>");
}

?>






</fieldset>

<br>
<fieldset><legend><b>Day Rates/ Current CASHBOXES</b></legend>
<?php
include("connectdb.php");
$queryrate=mysql_query("SELECT currency,buy,sale FROM rates");
print("<table><tr><td><b><FONT COLOR=BLUE>RATES: </b></td>");
while($row=mysql_fetch_array($queryrate)){
$buy=$row['buy'];
$sale=$row['sale'];
$currency=$row['currency'];
print("<td><b>$currency</b></td><td>$buy</td><td>$sale</td>");
}
print("</tr></table>");
?>

<?php
$cashierName=$_SESSION['usernamesession'];
include("connectdb.php");
$queryrate=mysql_query("SELECT currency,sum(amount) as sumamount FROM cashbox group by currency");
print("<table><tr><td><b><FONT COLOR=BLUE>CASHBOXES: </b></td>");

while($row=mysql_fetch_array($queryrate)){
$amount=$row['sumamount'];
$currency=$row['currency'];
$amount=number_format($amount);
print("<td><b>$currency</b></td><td>$amount</td>");
}
print("</tr></table>");
?>





<form action="report.php" method="post" name="deautho" id="deauthoform" >

By Cashier: <select name="cashier"><OPTION VALUE=""></OPTION>
<?php
include("connectdb.php");
$queryCashier=mysql_query("SELECT username FROM user where role='cashier'");
while($row=mysql_fetch_array($queryCashier)){
$cashier=$row['username'];
print("<OPTION VALUE=$cashier>$cashier</OPTION>");
}
?> 
</select>
<input type="submit" name="cashboxCashier" value="View" size="6" > 

<?php 
if(isset($_POST['cashboxCashier'])){
$cashier=$_POST['cashier'];
include("connectdb.php");
$queryrate=mysql_query("SELECT currency,sum(amount) as sumamount FROM cashbox where name='$cashier' group by currency");
print("<table><tr><td><b><FONT COLOR=BLUE>$cashier's CASHBOX: </b></td>");

while($row=mysql_fetch_array($queryrate)){
$amount=$row['sumamount'];
$currency=$row['currency'];
$amount=number_format($amount);
print("<td><b>$currency</b></td><td>$amount</td>");
}
print("</tr></table>");
}
?>

</form>





</fieldset>

<br>




<div style="height:350px;overflow:auto;">


<?php

$_SESSION['report_header']=null;
$_SESSION['report_values']=null;
?>


<?php
if(isset($_POST['viewBuyRepo'])){
//session_start();	
$dateFrom=$_POST['dateFrom'];
$dateTo=$_POST['dateTo'];
$nameOfUser=$_SESSION['namesession'];
//$timestamp = strtotime('2009-12-09 13:32:15');
//echo date('d/m/Y', $timestamp);

$dateFromconv=date('d/m/Y', strtotime($dateFrom));
$dateToconv=date('d/m/Y', strtotime($dateTo));
$branch=$_SESSION['branchsession'];
include('connectdb.php');
$queryreportbuy=mysql_query("select * from buysale where transdate>='$dateFrom' and transdate<='$dateTo' and exchtype='buy' and transvoided=0");
if($num=mysql_num_rows($queryreportbuy)){
unset($_SESSION['report_header']);
unset($_SESSION['report_values']);
print("<br><a href=export_report.php?fn=member_report style=width:150px;color:#0000FF;><b>Export to Excel</b></a><br>");
print("<br><div align=center><b>Buy Report From $dateFromconv To $dateToconv </b></div><br>");
	print("<table width=100% border=1 style=border-collapse:collapse; class=jqueryclass><tr><td rowspan=2><b>DATE</b></td><td rowspan=2><b>NO TRANSACTION</b></td><td rowspan=2><b>Devise</b></td><td colspan=2><b>Montant</b></td><td rowspan=2><b>C/V en FRW</b></td><td><b>CLIENT VENDEUR</b></td><td rowspan=2><b>R/NR(*)</b></td></tr>");
print("<tr><td>Billet</td><td>COURS</td><td>NOM</td></tr>");

$_SESSION['report_header']=array(" ");
//$_SESSION['report_header']=array("DATE DU ".$dateFromconv." AU ".$dateToconv);
$_SESSION['report_values'][0][0]="";
$_SESSION['report_values'][1][0]=" ";
$_SESSION['report_values'][1][1]="RELEVE  DES OPERATIONS DE CHANGE MANUEL-ACHAT";
$_SESSION['report_values'][2][0]=" ";
$_SESSION['report_values'][2][1]="NOM DU BUREAU DE CHANGE : ".$branch;
$_SESSION['report_values'][3][0]=" ";
$_SESSION['report_values'][4][0]=" ";
$_SESSION['report_values'][4][1]="DATE DU ".$dateFromconv." AU ".$dateToconv;
$_SESSION['report_values'][5][0]=" ";


$_SESSION['report_values'][6][0]=" ";
$_SESSION['report_values'][6][1]="DATE";
$_SESSION['report_values'][6][2]="NO TRANSACTION";
$_SESSION['report_values'][6][3]="Devise";
$_SESSION['report_values'][6][4]="Montant";
$_SESSION['report_values'][6][5]="";
$_SESSION['report_values'][6][6]="C/V en FRWS";
$_SESSION['report_values'][6][7]="CLIENT VENDEUR";
$_SESSION['report_values'][6][8]="";

$_SESSION['report_values'][7][0]=" ";
$_SESSION['report_values'][7][1]=" ";
$_SESSION['report_values'][7][2]=" ";
$_SESSION['report_values'][7][3]=" ";
$_SESSION['report_values'][7][4]="Billet";
$_SESSION['report_values'][7][5]="COURS";
$_SESSION['report_values'][7][6]=" ";
$_SESSION['report_values'][7][7]="NOM";
$_SESSION['report_values'][7][8]="R/NR(*)";

$i=8;
	while($rowreport=mysql_fetch_array($queryreportbuy)) {
	
		$date=$rowreport['transdate'];
		$datecov=date('d/m/Y', strtotime($date));
		$slipno=$rowreport['transnobuysale'];
		$name=$rowreport['name'];
		$country=$rowreport['country'];
		$amount=$rowreport['amount'];
		$currency=$rowreport['currency'];
		$exchamount=$rowreport['exchamount'];
		$rate=$rowreport['rate'];
		$amountf=number_format($amount);
		$exchamountf=number_format($exchamount);
		
		$_SESSION['report_values'][$i][0]=" ";
		$_SESSION['report_values'][$i][1]=$datecov;
		$_SESSION['report_values'][$i][2]=$slipno;
		$_SESSION['report_values'][$i][3]=$currency;
		$_SESSION['report_values'][$i][4]=$amountf;
		$_SESSION['report_values'][$i][5]=$rate;
		$_SESSION['report_values'][$i][6]=$exchamountf;
		$_SESSION['report_values'][$i][7]=$name;
		$_SESSION['report_values'][$i][8]=$country;
				
		
		$i=$i+1;
		print("<tr><td>$date</td><td>$slipno</td><td>$currency</td><td><div align=right>$amountf</div></td><td>$rate</td><td><div align=right>$exchamountf</div></td><td>$name</td><td>$country</td></tr>");
	
	}
	
	$_SESSION['report_values'][$i][0]=" ";
	$i=$i+1;
	$_SESSION['report_values'][$i][0]=" ";	
	$i=$i+1;
	$_SESSION['report_values'][$i][0]=" ";	
	$i=$i+1;
	$_SESSION['report_values'][$i][0]=" ";
	$_SESSION['report_values'][$i][1]="(*)R : Resident";	
	$_SESSION['report_values'][$i][2]="NR : non  Resident";
	$_SESSION['report_values'][$i][3]=" ";
	$_SESSION['report_values'][$i][4]=" ";
	$_SESSION['report_values'][$i][5]=" ";
	$_SESSION['report_values'][$i][6]=" ";
	$_SESSION['report_values'][$i][7]="DIRECTEUR GERANT";
	$i=$i+1;
	$_SESSION['report_values'][$i][0]=" ";
	$_SESSION['report_values'][$i][1]=" ";	
	$_SESSION['report_values'][$i][2]=" ";
	$_SESSION['report_values'][$i][3]=" ";
	$_SESSION['report_values'][$i][4]=" ";
	$_SESSION['report_values'][$i][5]=" ";
	$_SESSION['report_values'][$i][6]=" ";
	$_SESSION['report_values'][$i][7]=$nameOfUser;
		
	
}else{
?>
<script>
alert('Report not available during the selected period');
</script>
<?php
}

mysql_close();	
	
	}
	?>
	
	
	
	
	
	<?php
if(isset($_POST['viewSaleRepo'])){
//session_start();	
$dateFrom=$_POST['dateFrom'];
$dateTo=$_POST['dateTo'];
$nameOfUser=$_SESSION['namesession'];
//$timestamp = strtotime('2009-12-09 13:32:15');
//echo date('d/m/Y', $timestamp);

$dateFromconv=date('d/m/Y', strtotime($dateFrom));
$dateToconv=date('d/m/Y', strtotime($dateTo));
$branch=$_SESSION['branchsession'];
include('connectdb.php');
$queryreportsale=mysql_query("select * from buysale where transdate>='$dateFrom' and transdate<='$dateTo' and exchtype='sale'and transvoided=0");
if($num=mysql_num_rows($queryreportsale)){
unset($_SESSION['report_header']);
unset($_SESSION['report_values']);
print("<br><a href=export_report.php?fn=member_report style=width:150px;color:#0000FF;><b>Export to Excel</b></a><br>");
print("<br><div align=center><b>Sale Report From $dateFromconv To $dateToconv </b></div><br>");
	print("<table width=100% border=1 style=border-collapse:collapse; class=jqueryclass><tr><td rowspan=2><b>DATE</b></td><td rowspan=2><b>NO TRANSACTION</b></td><td rowspan=2><b>Devise</b></td><td colspan=2><b>Montant</b></td><td rowspan=2><b>C/V en FRW</b></td><td rowspan=2><b>Nom du Client</b></td><td rowspan=2><b>Motif</b></td><td rowspan=2><b>Code</b></td><td rowspan=2><b>Piece Justificative</b></td><td rowspan=2><b>Pays de Destination</b></td></tr>");
print("<tr><td><b>Billet</b></td><td><b>COURS</b></td></tr>");

$_SESSION['report_header']=array(" ");
//$_SESSION['report_header']=array("DATE DU ".$dateFromconv." AU ".$dateToconv);
$_SESSION['report_values'][0][0]="";
$_SESSION['report_values'][1][0]=" ";
$_SESSION['report_values'][1][1]="RELEVE  DES OPERATIONS DE CHANGE MANUEL-VENTE";
$_SESSION['report_values'][2][0]=" ";
$_SESSION['report_values'][2][1]="NOM DU BUREAU DE CHANGE : ".$branch;
$_SESSION['report_values'][3][0]=" ";
$_SESSION['report_values'][4][0]=" ";
$_SESSION['report_values'][4][1]="DATE DU ".$dateFromconv." AU ".$dateToconv;
$_SESSION['report_values'][5][0]=" ";

$_SESSION['report_values'][6][0]=" ";
$_SESSION['report_values'][6][1]="DATE";
$_SESSION['report_values'][6][2]="NO TRANSACTION";
$_SESSION['report_values'][6][3]="Devise";
$_SESSION['report_values'][6][4]="Montant";
$_SESSION['report_values'][6][5]="";
$_SESSION['report_values'][6][6]="C/V en FRW";
$_SESSION['report_values'][6][7]="Nom du Client";
$_SESSION['report_values'][6][8]="Motif";
$_SESSION['report_values'][6][9]="Code";
$_SESSION['report_values'][6][10]="Piece Justificative";
$_SESSION['report_values'][6][11]="Pays de Destination";

$_SESSION['report_values'][7][0]=" ";
$_SESSION['report_values'][7][1]=" ";
$_SESSION['report_values'][7][2]=" ";
$_SESSION['report_values'][7][3]=" ";
$_SESSION['report_values'][7][4]="Billet";
$_SESSION['report_values'][7][5]="COURS";
$_SESSION['report_values'][7][6]=" ";
$_SESSION['report_values'][7][7]=" ";
$_SESSION['report_values'][7][8]=" ";
$_SESSION['report_values'][7][9]=" ";
$_SESSION['report_values'][7][10]=" ";
$_SESSION['report_values'][7][11]=" ";

$i=8;
	while($rowreport=mysql_fetch_array($queryreportsale)) {
	
		$date=$rowreport['transdate'];
		$datecov=date('d/m/Y', strtotime($date));
		$slipno=$rowreport['transnobuysale'];
		$name=$rowreport['name'];
		$country=$rowreport['country'];
		$amount=$rowreport['amount'];
		$currency=$rowreport['exchcurrency'];
		$exchamount=$rowreport['exchamount'];
		$rate=$rowreport['rate'];
		$reason=$rowreport['reason'];
		$code=$rowreport['code'];
		$identification=$rowreport['identification'];
		 
		$amountf=number_format($amount);
		$exchamountf=number_format($exchamount);
			 			
		$_SESSION['report_values'][$i][0]=" ";
		$_SESSION['report_values'][$i][1]=$datecov;
		$_SESSION['report_values'][$i][2]=$slipno;
		$_SESSION['report_values'][$i][3]=$currency;
		$_SESSION['report_values'][$i][4]=$exchamountf;
		$_SESSION['report_values'][$i][5]=$rate;
		$_SESSION['report_values'][$i][6]=$amountf;
		$_SESSION['report_values'][$i][7]=$name;
		$_SESSION['report_values'][$i][8]=$reason;
				$_SESSION['report_values'][$i][9]=$code;
		$_SESSION['report_values'][$i][10]=$identification;
		$_SESSION['report_values'][$i][11]=$country;
				
		
		$i=$i+1;
		print("<tr><td>$date</td><td>$slipno</td><td>$currency</td><td><div align=right>$exchamountf</div></td><td>$rate</td><td><div align=right>$amountf</div></td><td>$name</td><td>$reason</td><td>$code</td><td>$identification</td><td>$country</td></tr>");
	
	}	
	$_SESSION['report_values'][$i][0]=" ";
	$i=$i+1;
	$_SESSION['report_values'][$i][0]=" ";
	$_SESSION['report_values'][$i][1]=" ";
	$_SESSION['report_values'][$i][2]="AVOIRS EN CAISSE";
	$_SESSION['report_values'][$i][3]=" ";
	$_SESSION['report_values'][$i][4]=" ";
	$_SESSION['report_values'][$i][5]=" ";
	$_SESSION['report_values'][$i][6]=" ";
	$_SESSION['report_values'][$i][7]="EN BANQUE ";
	$i=$i+1;
	$_SESSION['report_values'][$i][0]=" ";
	$i=$i+1;
	$_SESSION['report_values'][$i][0]=" ";
	$_SESSION['report_values'][$i][1]=" ";
	$_SESSION['report_values'][$i][2]="USD";
	$_SESSION['report_values'][$i][3]=" ";
	$_SESSION['report_values'][$i][4]=" ";
	$_SESSION['report_values'][$i][5]=" ";
	$_SESSION['report_values'][$i][6]=" ";
	$_SESSION['report_values'][$i][7]="USD";
	$_SESSION['report_values'][$i][8]=" ";
	$_SESSION['report_values'][$i][9]=" ";
	$_SESSION['report_values'][$i][10]="DIRECTEUR GERANT";
	$i=$i+1;
	$_SESSION['report_values'][$i][0]=" ";
	$_SESSION['report_values'][$i][1]=" ";
	$_SESSION['report_values'][$i][2]="EUR";
	$_SESSION['report_values'][$i][3]=" ";
	$_SESSION['report_values'][$i][4]=" ";
	$_SESSION['report_values'][$i][5]=" ";
	$_SESSION['report_values'][$i][6]=" ";
	$_SESSION['report_values'][$i][7]="EUR";
	$_SESSION['report_values'][$i][8]=" ";
	$_SESSION['report_values'][$i][9]=" ";
	$_SESSION['report_values'][$i][10]=$nameOfUser;
	$i=$i+1;
	$_SESSION['report_values'][$i][0]=" ";
	$_SESSION['report_values'][$i][1]=" ";
	$_SESSION['report_values'][$i][2]="GBP";
	$_SESSION['report_values'][$i][3]=" ";
	$_SESSION['report_values'][$i][4]=" ";
	$_SESSION['report_values'][$i][5]=" ";
	$_SESSION['report_values'][$i][6]=" ";
	$_SESSION['report_values'][$i][7]="GBP";
	$i=$i+1;
	$_SESSION['report_values'][$i][0]=" ";
	$_SESSION['report_values'][$i][1]=" ";
	$_SESSION['report_values'][$i][2]="Autre";
	$_SESSION['report_values'][$i][3]=" ";
	$_SESSION['report_values'][$i][4]=" ";
	$_SESSION['report_values'][$i][5]=" ";
	$_SESSION['report_values'][$i][6]=" ";
	$_SESSION['report_values'][$i][7]="Autre";
	
	
}else{
?>
<script>
alert('Report not available during the selected period');
</script>
<?php
}

mysql_close();	
	
	}
	?>
	
	
	
	

<?php
if(isset($_POST['proRepo'])){
//session_start();	
$dateFrom=$_POST['dateFrom'];
$dateTo=$_POST['dateTo'];

//$timestamp = strtotime('2009-12-09 13:32:15');
//echo date('d/m/Y', $timestamp);

$dateFromconv=date('d/m/Y', strtotime($dateFrom));
$dateToconv=date('d/m/Y', strtotime($dateTo));

include('connectdb.php');
$queryreportprovision=mysql_query("select * from provision where date>='$dateFrom' and date<='$dateTo' order by name,date");
if($num=mysql_num_rows($queryreportprovision)){
print("<br><div align=center><b>Provision report From $dateFromconv To $dateToconv </b></div><br>");
	print("<table width=100% border=1 style=border-collapse:collapse; class=jqueryclass><tr><td><b>DATE</b></td><td><b>TIME</b></td><td><b>NAME</b></td><td><b>CURRENCY</b></td><td><b>AMOUNT</b></td><td><b>REASON</b></td></tr>");


	while($rowreport=mysql_fetch_array($queryreportprovision)) {
	
		$date=$rowreport['date'];
		$time=$rowreport['time'];
		$datecov=date('d/m/Y', strtotime($date));
		$name=$rowreport['name'];
		$amount=$rowreport['amount'];
		$currency=$rowreport['currency'];
		$reason=$rowreport['reason'];
		$amount=number_format($amount); 	 			
		
		print("<tr><td>$datecov</td><td>$time</td><td>$name</td><td>$currency</td><td><div align=right>$amount</div></td><td><b>$reason</b></td></tr>");

	}	
	
	print("</table>");
		
}else{
?>
<script>
alert('Report not available during the selected period');
</script>
<?php
}

mysql_close();	
	
	}
	?>	
	
	
	

<?php
if(isset($_POST['buySaleRepo'])){
	
$dateFrom=$_POST['dateFrom'];
$dateTo=$_POST['dateTo'];	
	
$cashierName=$_SESSION['usernamesession'];
//$date=date('Y-m-d');
include('connectdb.php');
$queryreport1=mysql_query("select transdate,currency,sum(amount) as totalAmount,exchcurrency,sum(exchamount) as totalExchAmount,exchcurrency from buysale where transdate>='$dateFrom' and transdate<='$dateTo' and exchtype='buy'and transvoided=0 group by currency order by currency");
if($num=mysql_num_rows($queryreport1)){

print("<b><h3><div align=center>Buy Report</div></h3></b>");

	print("<table width=100% border=1 style=border-collapse:collapse; class=jqueryclass><tr><td><b>No</b></td><td><b>Amount</b></td><td><b>Currency</b></td><td><b>Given Amount</b></td><td><b>Given currency</b></td></tr>");
$no=1;
$totalexchamount=0;
	while($rowreport=mysql_fetch_array($queryreport1)) {
		$amount=$rowreport['totalAmount'];
		$currency=$rowreport['currency'];
		$exchamount=$rowreport['totalExchAmount'];
		$exchcurrency=$rowreport['exchcurrency'];
		$amountf=number_format($amount);
		$exchamountf=number_format($exchamount);
		
		$totalexchamount=$totalexchamount+$exchamount;
		
		print("<tr><td>$no</td><td><div align=right>$amountf</div></td><td>$currency</td><td><div align=right>$exchamountf</div></td><td>$exchcurrency</td></tr>");
	$no=$no+1;
	}
	$totalexchamountf=number_format($totalexchamount);
		print("<tr><td colspan=3><div align=center><b>Total</b></div></td><td><b><div align=right>$totalexchamountf</div></b></td><td><b>$exchcurrency</b></td></tr></table>");

}
else{
print("<b><div align=center>Buy report not available during the selected</div></b> <br><br>");
}




$queryreport2=mysql_query("select transdate,currency,sum(amount) as totalAmount,exchcurrency,sum(exchamount) as totalExchAmount,exchcurrency from buysale where transdate>='$dateFrom' and transdate<='$dateTo' and exchtype='sale' and transvoided=0 group by exchcurrency order by exchcurrency");
if($num=mysql_num_rows($queryreport2)){

print("<b><h3><div align=center>Sale Report</div></h3></b>");

	print("<table width=100% border=1 style=border-collapse:collapse; class=jqueryclass><tr><td><b>No</b></td><td><b>Amount</b></td><td><b>Currency</b></td><td><b>Given Amount</b></td><td><b>Given currency</b></td></tr>");
$no=1;
$totalamount=0;
	while($rowreport=mysql_fetch_array($queryreport2)) {
		$amount=$rowreport['totalAmount'];
		$currency=$rowreport['currency'];
		$exchamount=$rowreport['totalExchAmount'];
		$exchcurrency=$rowreport['exchcurrency'];
		$amountf=number_format($amount);
		$exchamountf=number_format($exchamount);
		$totalamount=$totalamount+$amount;
		print("<tr><td>$no</td><td><div align=right>$amountf</div></td><td>$currency</td><td><div align=right>$exchamountf</div></td><td>$exchcurrency</td></tr>");
	$no=$no+1;
	}
		$totalamountf=number_format($totalamount);
		print("<tr><td><div align=center><b>Total</b></div></td><td><div align=right><b>$totalamountf</b></div></td><td><b>$currency</b></td></tr></table>");

}
else{
print("<b><div align=center>Sale report not available during the selected</div></b>");
}
mysql_close();
}
?>

	
</div>
<?php include('copyright.html'); ?>	
</BODY>
</HTML>
