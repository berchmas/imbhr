<?php
if(isset($_POST['sublogin'])){
$tdate=date("Y-m-d");
$time=date("H:i:s:a");
$userrole=$_POST['userrole'];
$userpsw=$_POST['userpsw'];
$userpsw=md5($userpsw);
include("../connect/connectdb.php");

$querylog="SELECT * FROM user WHERE username='$userrole' AND pword='$userpsw' AND access=1";
$reslog=mysql_query($querylog);
if($num=mysql_num_rows($reslog)){
while($row=mysql_fetch_array($reslog)){
	session_start();
//$_SESSION['timeout']=time();
$_SESSION['useridsession']=$row['userid'];
$_SESSION['usernamesession']=$row['username'];
$_SESSION['passwordsession']=$row['pword'];
$_SESSION['namesession']=$row['name'];
$_SESSION['rolesession']=$row['role'];
$_SESSION['telephonesession']=$row['telephone'];
$_SESSION['branchsession']=$row['department'];
$_SESSION['authorizedsession']=$row['authorized'];
}
}
if($_SESSION['rolesession']=="employee"){
header("location: ../leaverequest.php");
}
else if($_SESSION['rolesession']=="supervisor"){
header("location: management.php");
}
else if($_SESSION['rolesession']=="admin"){
header("location: administration.php");
}
else{
//$_SESSION['invalid']="Invalid username or password";
header("location: index2.php");
}
}
?>
