<?php
////////////////////////////////////////////////////
// bit4ge comments v2.o

function dm_numcomments($type, $nid)
{
	
    $comment_result = dm_query("select * from comments where type = '$type' and nid = '$nid'");
    return mysql_num_rows($comment_result);
}

function dm_getcommentdata($cid)
{
    $ftw=dm_query("select * from `comments` where `id`='$cid'");
    return mysql_fetch_object($ftw);
}

function dm_getcommentstats($headline,$type,$nid)
{
	$locate=$GLOBALS['locate'];
    $num_comments=dm_numcomments($type,$nid);
    $comstat="<table border=0><tr><td>\n";
    $comstat.="<img src=\"$locate/images/comments.gif\" border=\"0\" valign=middle> \n";
    $comstat.="</td><td>\n";

    $comstat.="<a href=\"$locate/$type.php?action=view&type=$type&nid=$nid&headline=$headline\">$num_comments comments</a> </td><td>&nbsp;</td>\n";

	if($_SESSION['logged_in']!="true")
	 $comstat.="<td>&nbsp;</td></tr></table>";
	else
	{
		$comstat.="<td>[<a href=\"$locate/$type.php?action=ad&type=$type&nid=$nid&headline=$headline\">add comment</a>]</td>\n";
		$comstat.="</tr></table>";
	}
    return $comstat;
}

function dm_showcomments($type,$nid)
{
    $locate=$GLOBALS['locate'];
    $dm_table_top_mid_1=$GLOBALS['dm_table_top_mid_1'];
    $dm_table_bot_mid_1=$GLOBALS['dm_table_bot_mid_1'];
    $comment_result = dm_query("select * from comments where type = '$type' and nid = '$nid' order by time");
    $num_comments=mysql_num_rows($comment_result);
    if($num_comments>0)
    {
        for($i=0;$i<$num_comments;$i++)
        {
            $der = mysql_fetch_array($comment_result);
            $header=$der['header'];
            $comment="$header</td><td nowrap class=dm_newsheader background=\"$locate/images/$dm_table_top_mid_1\" height=20 align=right>\n";
            $comment.=b4time($der['time']);
            $userdata=dm_getuserdata($der['poster']);
            table_top($comment);
            $comment="<table border=0 align=right><tr><td>\n";
            $comment.=dm_getuseravatar($userdata->id);
            $comment.="</td></tr><tr><td>";
            $comment.=dm_getawards($userdata->name);
            $comment.="</td></tr></table>\n";
            $message=smiles($der['message']);
            $comment.=stripslashes($message);
            table_middle($comment,"000000");
            $comment ="<table border=0 cellspacing=0 cellpadding=2><tr>\n";
            if($userdata->id!=999)
            {
                $comment.="<td class=dm_email>posted by <a href=\"$locate/showprofile.php?user=$userdata->name\">$userdata->name</a></td>\n";

                $comment.="<td class=dm_email><a href=\"".dm_getemailcode($userdata->email)."\"><img src=\"$locate/images/email2.gif\" border=\"0\" title=\"Send email to $userdata->name\" alt=\"Send email to $userdata->name\"></a></td>\n";
            }
            else $comment.="<td class=dm_email>posted by anonymous</td>\n";
            $comment.="</tr></table>\n";
            $comment.="<td colspan=2 background=\"$locate/images/$dm_table_bot_mid_1\" nowrap align=right height=20 class=dm_email>\n";
            $data=$GLOBALS['data'];
            if(($data->name==$userdata->name)||($data->access==255))
            {
                $jcid=$der['id'];
                $comment.="[<a href=\"$locate/comments_edit.php?action=edc&type=$type&nid=$nid&cid=$jcid\">edit</a>]\n";
                $comment.="[<a href=\"$locate/comments_edit.php?action=dec&type=$type&nid=$nid&cid=$jcid\">remove</a>]\n";
            }
            $comment.="</td>\n";
            table_bottom($comment);
            echo "<br>\n";
        }
    }
    // else dm_bar("There are no comments...");
}

function dm_showeditcommentform($type,$nid,$cid)
{
    $locate=$GLOBALS['locate'];
    
	if($_SESSION['logged_in']!="true")
	{
		echo "You must be logged in to add or edit comments.<br>";
	}
	else
	{

		$comment=dm_getcommentdata($cid);
		echo "Edit comment ($comment->header)";
		$news_stuff = "<table border=0 width=100%><tr><td>\n";
		$news_stuff.= "<form method=POST action=\"comments_edit.php\">\n";
		$news_stuff.= "<input type=hidden name=action value=edit>\n";
		$news_stuff.= "<input type=hidden name=type value=\"$type\">\n";
		$news_stuff.= "<input type=hidden name=return_url value=\"$type.php\">\n";
		$news_stuff.= "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"> \n";
		$news_stuff.= "<tr><td>Headline    </td><td><input type=\"text\" name=\"headline\" size=\"100\" value=\"".stripslashes($comment->header)."\"> </td></tr>\n";
		$news_stuff.= "<tr><td>Comment     </td><td><textarea cols=\"100\" rows=\"15\" name=\"posttext\">".stripslashes($comment->message)."</textarea></td></tr>\n";
		if($GLOBALS['logged_in']=="true")
		if($comment->userid=="999") $news_stuff.= "<tr><td>Anonymous?  </td><td><select name=anon><option>yes<option>no</select></td></tr>\n";
		else                        $news_stuff.= "<tr><td>Anonymous?  </td><td><select name=anon><option>no<option>yes</select></td></tr>\n";
    
		$news_stuff.= "<tr><td>Change User:</td><td><select name=changeuser><option>no<option>yes</select></td></tr>\n";
		$news_stuff.= "<tr><td>&nbsp;      </td><td><input class=\"dm_select_pic\" type=\"Image\" name=\"login\" src=\"$locate/images/log-n.gif\" border=\"0\" title=\"Submit your comment\" alt=\"Submit your comment\" align=center></td></tr>\n";
		$news_stuff.= "<input type=hidden name=cid value=$cid>\n";
		$news_stuff.= "<tr><td>&nbsp;      </td><td><input type=\"hidden\" name=\"nid\" value=\"$nid\"></td></tr>\n";
		$news_stuff.= "</table></form>\n";
		$news_stuff.= "</td></tr></table>\n";
		echo $news_stuff;
	}
}

function dm_showdeletecommentform($nid,$cid)
{
    $locate=$GLOBALS['locate'];
    
    
	if($_SESSION['logged_in']!="true")
	{
		echo "You must be logged in to add or edit comments.<br>";
	}
	else
	{
		echo "Delete comment";
		$comment=dm_getcommentdata($cid);
		$news_stuff = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100%> \n";
		$news_stuff.= "<form method=POST action=\"comments_edit.php\">\n";
		$news_stuff.= "<input type=hidden name=action value=delete>\n";
		$news_stuff.= "<input type=hidden name=cid value=$cid>\n";
		$news_stuff.= "<input type=hidden name=return_url value=\"$type.php\">\n";
		$news_stuff.= "<input type=hidden name=nid value=$nid>\n";
		$news_stuff.= "<tr><td><center>".stripslashes($comment->message)."</center></td></tr>\n";
		$news_stuff.= "<tr><td class=\"dm_warning\" ><center>".smiles("%X")."<br>WARNING!<br>Are you sure you want to delete this comment?</center></td></tr>\n";
		$news_stuff.= "<tr><td align=right><input type=submit name=submit value=\"Fuck Yeah!\">\n"; // </td></tr>\n";
		//$news_stuff.= "<tr><td align=right>
		$news_stuff.= "<input type=button name=no value=\"No, Just kiddin!\"></td></tr>\n";
		$news_stuff.= "</form></table>\n";
        echo $news_stuff;
	}
}

function dm_showaddcommentform($header,$type,$nid)
{
    $locate=$GLOBALS['locate'];

	if($_SESSION['logged_in']!="true")
	{
        echo "You must be logged in to add or edit comments.<br>";
	}
	else
	{
        echo "Add comment:<br>";
		$news_stuff = "<table border=0 width=100%><tr><td>\n";
		$news_stuff.= "<form method=POST action=\"comments_edit.php\">\n";
		$news_stuff.= "<input type=hidden name=action value=add>\n";
		$news_stuff.= "<input type=hidden name=return_url value=\"$type.php\">\n";
		$news_stuff.= "<input type=hidden name=type value=\"$type\">\n";
		$news_stuff.= "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"> \n";
		$news_stuff.= "<tr><td>Headline    </td><td><input type=\"text\" name=\"title\" size=\"100\" value=\"re: $header\"> </td></tr>\n";
		$news_stuff.= "<tr><td>Comment     </td><td><textarea cols=\"100\" rows=\"15\" name=\"posttext\"></textarea></td></tr>\n";
		if($GLOBALS['logged_in']=="true")
		$news_stuff.= "<tr><td>Anonymous?  </td><td><select name=anon><option>no<option>yes</select> <input type=submit name=\"go\" value=\"go\"></td></tr>\n";
		$news_stuff.= "<tr><td>&nbsp;      </td><td><input type=\"hidden\" name=\"nid\" value=\"$nid\"></td></tr>\n";
		$news_stuff.= "</table></form>\n";
		$news_stuff.= "</td></tr></table>\n";
        echo $news_stuff;

	}
}

function dm_addcommentgo($type,$nid,$header,$message,$userid)
{
	if($_SESSION['logged_in']!="true")
	{
		echo "You must be logged in to add or edit comments.<br>";
	}
	else
	{
		if(empty($userid)) $userid=999;
		$time    = date("Y-m-d H:i:s");
		$header  = addslashes($header);
		$message = addslashes($message);
		$result  = dm_query("INSERT INTO comments VALUES ('$type', '$nid', '$userid', '$header', '$message', '0', '$time');");
		if($userid!=999){ $data=$GLOBALS['data']; addsp($data->name,10); addcomments($data->name,1); }
	}
}

function dm_updatecommentgo($type,$cid,$headline,$posttext,$changeuser,$userid)
{
    
	if($_SESSION['logged_in']!="true")
	{
		table_top("Log in!");
		table_middle("You must be logged in to add or edit comments.<br>",1);
		table_bottom("Log in!");
	}
	else
	{
		$p=addslashes($headline); dm_query("UPDATE comments SET header ='$p' where id = '$cid'");
		$p=addslashes($posttext); dm_query("UPDATE comments SET message ='$p' where id = '$cid'");
		$p=addslashes($type);     dm_query("UPDATE comments SET type ='$p' where id = '$cid'");
		if($changeuser=="yes")    dm_query("UPDATE comments SET poster ='$userid' where id = '$cid'");
		echo "<p class=dm_locater>comment [$cid] has been updated...</p>\n";
	}
}

function dm_deletecommentgo($nid,$cid)
{
    
	if($_SESSION['logged_in']!="true")
	{
		table_top("Log in!");
		table_middle("You must be logged in to add or edit comments.<br>",1);
		table_bottom("Log in!");
	}
	else
	{
		dm_query("DELETE FROM comments where id = '$cid'");
		echo "<p class=dm_locater>comment [$cid] has been deleted...</p>\n";
	}
}
?>
