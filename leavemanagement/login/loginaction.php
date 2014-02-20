<?php
if(isset($_POST['sublogin'])){
$userrole=$_POST['userrole'];
$userpsw=$_POST['userpsw'];
$userpsw=md5($userpsw);
include("connectdb.php");
$querylog=("SELECT * FROM user WHERE username='$userrole' AND pword='$userpsw'");
$reslog=mysql_query($querylog);
if($num=mysql_num_rows($reslog)){
while($row=mysql_fetch_array($reslog))
{
session_start();
$_SESSION['useridsession']=$row['userid'];
$_SESSION['usernamesession']=$row['username'];
$_SESSION['passwordsession']=$row['password'];
$_SESSION['namesession']=$row['name'];
$_SESSION['rolesession']=$row['role'];
$_SESSION['tesession']=$row['tel'];
$_SESSION['branchsession']=$row['branch'];
}
}
if($_SESSION['rolesession']=="user"){
header("location: user.php");
}
else if($_SESSION['rolesession']=="admin"){
header("location: arrangement.php");
}
else if($_SESSION['rolesession']=="manager"){
header("location: manager.php");
}
else{
header("location:index.php");
}
}
?>
