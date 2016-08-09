<?php
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////

include("rpg_header.php");
echo "<img src=images/join.jpg><br>";
function dm_join_stop($locate,$userid,$password,$email) { joinform($locate,$userid,$password,$email); include("rpg_footer.php"); exit; }
if($_SESSION['logged_in']=="true") { echo "You are already a member... Logout if you want to create a new profile.\n"; include("rpg_footer.php"); exit; }
// connect to user database
$result = dm_query("select * from users where name = '$userid'");
if(mysql_num_rows($result) > 0 ){	echo "<h1>Sorry! There is already a user named $userid</h1>\n";	dm_join_stop($locate,$userid,$password,$email); }

// check email

if(dm_is_valid_email($email)) {     if(!empty($email)) echo "<p>Email address is invalid!</p>\n";     dm_join_stop($locate,$userid,$password,$email); }
if(dm_is_valid_name($userid)) {     echo "<p>Invalid characters in your userid. Characters allowed are: a-z, A-Z, 0-9, and _ (No spaces)</p>\n";     dm_join_stop($locate,$userid,$password,$email); }
$password=generate_password();
// create user account, then send an email confirmation
$time1=date("Y-m-d H:i:s"); if(empty($gender)) $gender="male"; if(!empty($userid)) $result=dm_query("INSERT INTO `users` (`name`, `pass`, `gender`, `email`, `first_login`) VALUES ('$userid', '$password', '$gender', '$email', '$time1');");
if($result)
{
    $message = "Defective Minds RPG.<br><br>Your new user account is: $userid.<br>Your new password is: $password<br><br>\n";
    $message .= "Click here to login: <a href=\"http://www.defectiveminds.com/login.php?userid=$userid&password=$password&action=logingo\">defectiveminds.com</a><br><br>\n";
    $message .= "Sincerely, The DefectiveMinds.com crew...\n";
    mailgo($email,$message,"New account setup!");
    // send email to admins
    $message  = "Sir(s),<br>A new user named [$userid] has joined defectiveminds.com<br>\n";
    $message .= "That is all, Ima Computa out!\n";
    mailgo("seth@defectiveminds.com",$message,"DeFeCtiVeMinDs.com new member: $userid");
    mailgo("will@defectiveminds.com",$message,"DeFeCtiVeMinDs.com new member: $userid");
	mailgo("seth_coder@hotmail.com",$message,"DeFeCtiVeMinDs.com new member: $userid");
	mailgo("2406196570@vtext.com",$message,"DeFeCtiVeMinDs.com new member: $userid");
    echo "<h1>You have just registered.</h1><h1>Now check your email to continue...</h1>\n";
	inform("You must confirm registration within one week or the account will be purged!");
	echo "<p><a href=index.php>Return to login page</a></p>";
    dm_log("****> $userid joined!");
}
else {    echo "<p>Woops! There was a fatal error saving your information! Please try again!</p>\n"; }
include("rpg_footer.php");
exit;

?>
