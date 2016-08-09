<?php
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////

include("rpg_header.php");

echo "<html><head><title>Login</title></head><body 
style='background-color: #f90; color: #000;'><font face=verdana size=1><b>\n";
       
echo "<img src=images/dm_left.gif>";
echo "<img src=images/dm_banner.gif height=135><br>";
echo "<img src=images/pa.gif><br>";

$action=$_REQUEST['action'];

if(empty($action)) $action="loginform";

function forgotform($locate) {
    echo "<p>You forgot your password!</p>";
    echo "<table border=0 cellspacing=0 cellpadding=0>\n";
    echo "<form method=post action=\"$locate/login.php?action=sendpass\">\n";
    echo "<tr>\n";
    echo "<td>Enter email &nbsp;</td>\n";
    echo "<td><input type=textbox name=email>&nbsp;</td>\n";
    echo "<td><input type=\"submit\" name=\"Get Password\" value=\"Get Password\"></td>\n";
    echo "</form></table>";
}

function loginform($locate) {
    echo "<p>Login below. If you haven't got an account, you may <a href=join.php>Register</a> now.</p>";
    echo "<form method=post action=\"$locate/login.php\">";
    echo "<input type=hidden name=outpage value=\"$thispage\">";
    echo "<input type=hidden name=action value=\"logingo\">";
    echo "<table border=0 cellspacing=0 cellwidth=0 cellpadding=0 valign=middle>\n";
    echo "<tr valign=middle>\n";
    echo "<td>Login &nbsp;</td>";
    echo "<td><input type=text name=userid size=10 class=\"b4text\"></td>";
    echo "</tr><tr>";
    echo "<td>Password &nbsp;</td>";
    echo "<td><input type=password name=password size=10 class=\"b4text\"></td>\n";
    echo "</tr><tr>";
    echo "<input type=hidden name=outpage value=index.php>";
    echo "<input type=hidden name=login value=fo_shnizzle>\n";
    echo "<td valign=middle></td><td valign=middle>\n";
    echo "<input type=\"submit\" name=\"Login\" value=\"Login\">\n";
    echo "</form>\n</tr></table>\n";
}

if($action=="loginform") {
    loginform($locate);
    include("rpg_footer.php");
    exit;
}

if($action=="logingo") {
    echo "LOGGING IN...";
    $mysql = odb();
    $userid=$_REQUEST['userid'];
    $password=$_REQUEST['password'];
    $result = mysql_query("select * from users where name = '$userid' and pass = '$password'", $mysql);
    if(mysql_num_rows($result) > 0)    {
        $_SESSION["valid_user"] = $userid;
        $_SESSION["logged_in"]  = true;
        $data=dm_getuserdata($userid);
        dm_setuservar($userid,"last_login",$data->last_activity);
        dm_setuservar($userid,"last_activity",date("Y-m-d H:i:s"));
         if($outpage=="") $outpage="pro.php";
        echo "<p>$data->name logged in.</p>";
        echo "</body></html>\n";
        dm_log("***********************> $data->name logged in!");
        gotopage("index.php");
        exit();
    }
    else    {
      $_SESSION["valid_user"] = "invalid_user";
    }
}

if($action=="sendpass") {
    if(empty($email)) {
        echo "<p>You must enter a password!</p>\n";
        forgotform($locate);
    }
    else {
        $user=getuserdatabyfield("email",$email);
        if(empty($user)) {
            echo "<br><p>That email address is not in our records! You must <a href=join.php>JOIN</a>!</p><br>\n";
        }
        else {
            $subject="You dun wint an fergot yer passwerd on defectiveminds.com";
            $message="Yer username is:$user->name<br>Yer passwerd is:$user->pass<br>\n";
            $message.="<p style=\"color: black\">Cick <a href=\"$locate/login.php?userid=$user->name&password=$user->pass&action=login&login=fo_shnizzle\">here</a> to login!</p><br>\n";
            mailgo($user->email,$message,$subject);
            echo "<br><p>Password sent to $email</p><br>\n";
        }
    }
    include("rpg_footer.php");
    exit;
}

if($action=="forgot") {
    forgotform($locate);
    include("rpg_footer.php");
    exit;
}

$hi=$_SESSION["valid_user"];

if(($hi=="invalid_user")||($join=="true")||(empty($hi))) {
    if(($hi=="invalid_user") || (empty($hi))  )
        if($join!="true")
            echo "<p>Invalid username or password! Did you <a href=\"$locate/login.php?action=forgot\">forget</a>?</p>\n";
    loginform($locate);
    joinform($locate,$userid,$password,$email);
    include("rpg_footer.php");
    exit;
}

if($_SESSION['logged_in']!="true") {
    echo "$userid $password";
    echo "<form method=post action=\"$locate/login.php\">";
    echo "<table border=0 cellspacing=0 cellwidth=0 cellpadding=0>\n";
    echo "<tr>\n";
    echo "<td><img src=\"$locate/images/keys.gif\" border=\"0\" width=34> &nbsp;</td>\n";
    echo "<td><img src=\"$locate/images/lg_username.gif\" border=\"0\"></td>\n";
    echo "<td><input type=text name=userid size=10 class=\"b4text\"></td>";
    echo "<td><img src=\"$locate/images/lg_password.gif\" border=\"0\"></td>\n";
    echo "<td><input type=password name=password size=10 class=\"b4text\"></td>\n";
    echo "<td><table border=0><tr><td align=\"center\"><center><input type=hidden name=login value=fo_shnizzle>\n";
    echo "<input class=\"dm_select_pic_bg\" type=\"Image\" name=\"\" src=\"$locate/images/log-n.gif\" border=\"0\" alt=\"LOGIN!\" align=center>\n";
    echo "</center></td></form><td align=\"center\"><center>\n";
    echo "<form method=post action=\"$locate/login.php\"><input type=hidden name=join value=true>\n";
    echo "<input class=\"dm_select_pic_bg\" type=\"Image\" name=\"join\" src=\"$locate/images/join.gif\" border=\"0\" alt=\"Not a member? JOIN IMMEDIATELY!\" value=\"true\" align=center>\n";
    echo "</center></td></form></tr></table></td></tr></table>\n";
}
include("rpg_footer.php");
