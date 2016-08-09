<?php
$title="Private Messages";
include("rpg_header.php");
$data=getuserdata($_SESSION['valid_user']);

if(empty($to)) if(!empty($sto)) $to=$sto;
if(empty($subject)) if(!empty($sj)) $subject=$sj;

echo "<h1>Private Messages</h1>";

if($action=="mark as unread")
{
	dm_query("update `pmsg` set `read` = 'no' where `id` = '$id'");
	//echo "<p>Marked message as unread</p>";
	unset($action);
}

if($action=="delete")
{
	echo "<p><h1>Are you sure you want to delete the message?</h1></p>";
	echo "<form action=pmsg.php method=post><input type=hidden name=id value=$id>";
	echo "<input type=submit name=action value=\"delete message\"></form>";
}

if($action=="delete message")
{
	dm_query("delete from `pmsg` where `id`='$id'");
	//echo "<p><h1>Message deleted</h1></p>";
	unset($action);
}

if($action=="reply")
{
	$result=dm_query("select * from `pmsg` where `id`='$id'"); $msg=mysql_fetch_object($result);
	echo "<p><form action=pmsg.php method=post>";
	echo "To: <input name=to value=\"$msg->from\">";
	echo "Subject: <input name=subject value=\"re: $msg->subject\"><br>";
	echo "<textarea name=message cols=80 rows=20>$msg->message</textarea><br>";
	echo "<input type=submit name=go value=go>";
	echo "<input type=hidden name=action value=messagego>";	
	echo "</form> </p>";	
}

if($action=="new message")
{
	echo "<p><form action=pmsg.php method=post>";
    if(!empty($to))
    echo "To:<select name=to><option>$to";
    else
	echo "To:<select name=to>";

	$res=dm_query("select * from users where `rpg`='yes' order by `rpg_name` asc");	
	$count=mysql_num_rows($res);

	for($i=0;$i<$count;$i++)
	{
			$userdata=mysql_fetch_object($res);
    		echo "<option>$userdata->rpg_name";
    }

	echo "</select><br>";
    if(!empty($subject))
    {
        $subject=str_replace("_"," ",$subject);
        echo "Subject: <input name=subject value=\"$subject\" size=80><br>";
    }
    else
	{
		echo "Subject: <input name=subject><br>";
	}
	echo "<textarea name=message cols=80 rows=20></textarea><br>";
	echo "<input type=submit name=go value=go>";
	echo "<input type=hidden name=action value=messagego>";	
	echo "</form> </p>";
}

if($action=="messagego")
{
	$fdate=date("Y-m-d"); $ftime=date("H:i:s");
	dm_query("insert into `pmsg` (`to`, `from`, `subject`, `message`, `date`, `time`, `read`) VALUES ('$to','$data->rpg_name','$subject','$message','$fdate','$ftime', 'no');");
	echo "<p>Message to $to sent!</p>";
	unset($action);
}

if($action=="read")
{
	dm_query("update `pmsg` set `read` = 'yes' where `id` = '$id'");
	$urresult=dm_query("select * from `pmsg` where `id` = '$id'");
	$msg=mysql_fetch_object($urresult);
	$userdatar=dm_query("select * from users where `rpg_name`='$msg->from'");
	$userdata=mysql_fetch_object($userdatar);


	echo "<table><tr><td>";

	echo "[<a href=\"pmsg.php?action=new message&id=$msg->id\">New Message</a>] ";
	echo "</td><td>";

	echo "[<a href=pmsg.php?action=delete&id=$msg->id>Delete</a>] ";
	echo "</td><td>";
	
	echo "[<a href=\"pmsg.php?action=mark as unread&id=$msg->id\">Mark Unread</a>] ";
	echo "</td><td>";
	
	echo "[<a href=\"pmsg.php?action=reply&id=$msg->id\">Reply</a>] ";
	
	echo "</td><td>";
	
	echo "[<a href=pmsg.php>Inbox</a>] ";
	echo "</td><td>";
	

	echo "&nbsp;</td></tr></table>";	

	echo "<br>";
	echo "<table width=100% border=0 cellspacing=0 cellpadding=0><tr><td>";
	
 	echo "<a href=$locate/rpg_profile.php?id=$userdata->id>";

	$result=dm_query("select * from rpg_classes where id=$userdata->rpg_class");
	$class=mysql_fetch_object($result);

	echo imgn("images/$class->image",$class->name);

	echo "</a>";

 	echo "</td><td width=100%>";	
 	
	echo "<table width=100% border=0 cellspacing=0 cellpadding=5> <tr><td bgcolor=#333333 width=100%> From: $msg->from</td></tr></table>";
	echo "<table width=100% border=0 cellspacing=0 cellpadding=5> <tr><td bgcolor=#444444 width=100%> Sent: $msg->date @ $msg->time</td></tr></table>";	
	echo "<table width=100% border=0 cellspacing=0 cellpadding=5> <tr><td bgcolor=#555555 width=100%> Subject: <font class=black>$msg->subject</font></td></tr></table>";
	
	echo "</td></tr></table>";
	
	echo "<table width=100% border=0 cellspacing=0 cellpadding=10><tr><td bgcolor=#666666 width=100%>".nl2br($msg->message)."</td></tr></table>";

	echo "<table width=100% border=0 cellspacing=0 cellpadding=10><tr><td width=100%>";

	echo "</td></tr></table>";
	echo "<p>&nbsp;</p>";
}


if(empty($action))
{
	$urresult=dm_query("select * from `pmsg` where `to` = '$data->rpg_name' and `read` = 'no'");
	$numunread=mysql_num_rows($urresult); if(empty($numunread)) $numunread=0;
	$result=dm_query("select * from `pmsg` where `to` = '$data->rpg_name' order by id desc ;");
	$numpmsg=mysql_num_rows($result); if(empty($numpmsg)) $numpmsg=0;

	echo "<table border=0><tr><td>[<a href=\"pmsg.php?action=new message\">New Message</a>]</td></tr></table><br>";
	
	if($numpmsg>0)
	{
		//echo "You have $numpmsg private messages! ($numunread unread messages)";
		echo "<table border=0 cellspacing=0 cellpadding=0 width=100%>";
		echo "<tr><td width=50>&nbsp;</td><td width=100>From</td><td width=100>Date</td><td width=100>Time</td><td>Subject</td></tr>";
		
		for($i=0;$i<$numpmsg;$i++)
		{
			$msg=mysql_fetch_object($result);
			$lnk="<a href=pmsg.php?action=read&id=$msg->id>";
			
			if(strcmp($msg->read,"yes"))	{ echo "<tr bgcolor=#666666><td>"; echo "<img border=0 width=16 height=16 src=images/mail.gif>";}
			else				{ echo "<tr bgcolor=#333333><td>"; echo "<img border=0 width=16 height=16 src=images/mailopen.gif>"; }

//./ 			echo "&nbsp;"; //reserve for importance?

			echo "</td>";
			echo "<td>$lnk$msg->from</a></td><td>$lnk$msg->date</a></td><td>$lnk$msg->time</a></td><td>$lnk$msg->subject</a></td></tr>";
		}
		echo "</table>";
	}
	else
	{
		echo "<p>You have no private messages!</p>";
	}
}

			rpg_refresh("charpane","rpg_character.php");
include("rpg_footer.php");

?>