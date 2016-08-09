<?php

include("rpg_header.php");

$title=$_REQUEST['title'];
$message=$_REQUEST['message'];
$reply=$_REQUEST['reply'];
$forum_showposts=$_REQUEST['forum_showposts'];
$forum_which=$_REQUEST['forum_which'];

$data = getuserdata($_SESSION['valid_user']);
@include("dm_time.php");

function forum_put_buttons($forum_which)
{
    $locate=$GLOBALS['locate'];
    $data=$GLOBALS['data'];
    $thispage=$GLOBALS['thispage'];
    $forum_list=$GLOBALS['forum_list'];
   
    
    if($forum_list!="yes")
    {
		echo "<p>";
        echo "[<a href=\"forum.php?forum_list=yes\">List Forums</a>]";
        echo "[<a href=\"forum.php?forum_showposts=yes&forum_which=$forum_which\">List Threads</a>]";
        echo "[<a href=\"forum.php?action=start_thread&forum_which=$forum_which&forum_showposts=no\">Start New Thread</a>]";
		echo "</p>";
    }
    
    if($data->access=="255")
    {
        
//        if($_SESSION['forum_admin']=="yes")
//			echo "[<a href=\"forum.php?action=forum_admin_off&outpage=$thispage\">Forum Admin Off</a>]";
//        else
//			echo "[<a href=\"forum.php?action=forum_admin_on&outpage=$thispage\">Forum Admin On</a>]";
    }
    
    
}

$message=str_replace("<meta","(meta tags are unauthorized)<no ",$message);
$message=str_replace("<input","(form tags are unauthorized)<no ",$message);
$message=str_replace("<form","(form tags are unauthorized)<no ",$message);
$message=str_replace("<textarea","(form tags are unauthorized)<no ",$message);
$message=str_replace("<select","(form tags are unauthorized)<no ",$message);

function bumpthread($id)
{
    $bumptime=date("Y-m-d H:i:s");
    // 0000-00-00 00:00:00
    dm_query("update forum_posts set `bumptime`='$bumptime' where id='$id'");
}

if($action=="forum_admin_on")
{
    $_SESSION['forum_admin']="yes";
    gotopage($outpage);
}
if($action=="forum_admin_off")
{
    $_SESSION['forum_admin']="no";
    gotopage($outpage);
}

if($_SESSION['forum_admin']=="yes")
{
    if($data->access!=255) echo "<p> ".smiles(":X")." You do not have access to the Forum Administration Panel (FAP)!</p>";
}


$der=mysql_fetch_object(dm_query("select * from `forum_list` where `id`='$forum_which';"));
// echo "<p>&nbsp;</p>";
forum_put_buttons($der->id);

if($action=="start_thread")
{
    if($logged_in=="true")
    {
	    $der=mysql_fetch_object(dm_query("select * from `forum_list` where `id`='$forum_which';"));	
        echo "<table width=100% border=0 cellpadding=1 cellspacing=1 bgcolor=#000000><tr><td>";

        echo "<table width=100% bgcolor=$forum_color[4] cellspacing=0 cellpadding=0>";
        echo "<tr><td valign=top>\n";

	    echo "<table width=100% border=0><th align=center>Start a new thread in $der->name</th></table>";
        echo "<table width=100%>\n";
        echo "<form action=\"forum.php\" method=post>\n";
        echo "<input type=hidden name=action value=start_thread_go>\n";
        echo "<input type=hidden name=forum_which value=\"$forum_which\">\n";
        echo "<tr><td align=right valign=top>Title:</td><td><input type=text name=header value=\"\" size=78></td></tr>\n";
        echo "<tr><td align=right valign=top>Message:</td><td><textarea name=reply cols=78 rows=10></textarea></td></tr>\n";
        if($data->name=="Visitor")
        { 
            echo "<tr><td align=right valign=top>Name:</td><td><input name=name></td></tr>";
            echo "<input type=hidden name=visitor value=true>";
        }
        else
            echo "<tr><td align=right valign=top>Anonymous:</td><td><select name=anonymous><option>no<option>yes</select> &nbsp;<input type=submit name=submit value=\"Go!\"> </td> </tr>\n";
        echo "<tr><td>&nbsp;</td><td></td></tr>\n";
        echo "</form>\n";
        echo "</table>\n";   
    }
    else echo "<p class=dm_locater>You must be logged in to post!</p>\n";
    
    echo "</td></tr></table>\n";
    echo "</td></tr></table>\n";
}

if($action=="start_thread_go")
{
    if($logged_in=="true")
    {
        $user=$data->id;
        if($anonymous=="yes") $user=999;
        if($data->name=="Visitor") $user=666;
        $time=date("Y-m-d H:i:s");
        dm_query("INSERT INTO `forum_posts` (`id`, `title`) VALUES ('', '__chkdel');");
        $fart=dm_query("select * from `forum_posts` where `title`='__chkdel'");
        $lick=mysql_fetch_array($fart);
        $id=$lick['id'];
        $thread=$id;
        $header=addslashes($header);
        $reply=addslashes($reply);
        dm_query("UPDATE `forum_posts` set `poster`       = '$user' where `id`='$id';");
        if($user==666)
        dm_query("UPDATE `forum_posts` set `poster_name`  = '$name' where `id`='$id';");
        dm_query("UPDATE `forum_posts` set `title`        = '$header' where `id`='$id';");
        dm_query("UPDATE `forum_posts` set `message`      = '$reply' where `id`='$id';");
        dm_query("UPDATE `forum_posts` set `thread`       = '$thread' where `id`='$id';");
        dm_query("UPDATE `forum_posts` set `forum`        = '$forum_which' where `id`='$id';");
        dm_query("UPDATE `forum_posts` set `time`         = '$time' where `id`='$id';");
        dm_query("UPDATE `forum_posts` set `thread_top`   = 'yes' where `id`='$id';");
        dm_query("DELETE from `forum_posts` where `title` ='__chkdel'");
        rpg_setvar("forumposts",$data->forumposts+1);
		//addforumposts($data->name,1);
        dm_query("UPDATE `forum_list` set `last_post` = '$id' where `id` = '$forum_which';");
        bumpthread($id);
        dm_log("*****> $data->name started a new thread! [$header]");
    }
    else echo "<p class=dm_locater>You must be logged in to post or reply!</p>\n";
    get_thread($thread,$forum_which);

}

function dm_forum_modification_panel($forum_name)
{
    
    $mysql=odb();
    $forum_name=addslashes($forum_name);
    $result=mysql_query("select * from forum_list where name='$forum_name';",$mysql);
    $der=mysql_fetch_array($result);
    $name=stripslashes($der['name']);
    $comment=stripslashes($der['comment']);
    echo "<p> Modify [<i>$name</i>] description [<i>$comment</i>]</p>\n";
    echo "<form action=\"".$GLOBALS['locate']."/forum.php\" method=post>\n";
    echo "<input type=hidden name=action value=modify_forum>\n";
    echo "<input type=hidden name=forum_admin value=yep>\n";
    echo "<input type=hidden name=forum_clear value=1>\n";
    echo "<input type=hidden name=old_name value=\"$name\">\n";
    echo "<table>\n";
    echo "<tr>\n";
    echo "<td>Name:</td>\n";
    echo "<td><input type=text name=forum_name value=\"$name\" size=80></td>\n";
    echo "</tr><tr>\n";
    echo "<td>Description:</td>\n";
    echo "<td><input type=text name=forum_desc value=\"$comment\" size=80></td>\n";
    echo "</tr><tr>\n";
    echo "<td>Use Password:</td>\n";
    echo "<td><select name=forum_usepass value=\"".$der['usepass']."\"><option>no<option>yes</select></td>\n";
    echo "</tr><tr>\n";
    echo "<td>Password:</td>\n";
    echo "<td><input type=password name=forum_pass1 value=\"".$der['password']."\"> </td>\n";
    echo "</tr><tr>\n";
    echo "<td>Password (confirm):</td>\n";
    echo "<td><input type=password name=forum_pass2 value=\"".$der['password']."\"> </td>\n";
    echo "</tr><tr>\n";
    echo "<td>Private:</td>\n";
    echo "<td><select name=forum_private value=\"".$der['private']."\"><option>no<option>yes</select></td>\n";
    echo "</tr><tr>\n";
    echo "<td>Moderated:</td>\n";
    echo "<td><select name=forum_moderated><option>".$der['moderated']."<option>no<option>yes</select></td>\n";
    echo "</tr><tr>\n";
    $userlist=dm_getuserlist();
    $userdata=dm_getuserdata($der['moderator']);
    echo "<td>Moderator:</td>\n";
    echo "<td><select name=forum_moderator value=\"".$userdata->rpg_name."\">\n";
    for($i=0;$i<count($userlist);$i++) echo "<option>".$userlist[$i];
    echo "</select></td>\n";
    echo "</tr>";
    echo "<tr><td>BGCOLOR</td><td><input name=forum_bgcolor value=\"".$der['bgcolor']."\"></td></tr>";
    echo "<tr><td>Priority</td><td><input name=forum_priority value=\"".$der['priority']."\"></td></tr>";
    echo "<tr>\n";
    echo "<td>&nbsp;</td>\n";
    echo "<td>";
    
    /*
    $yag=explode(",",$der['access_groups']);
    $yagc=count($yag);
    $tym=dm_query("select * from `access_groups`");
    $tymr=mysql_num_rows($tym);
    for($tymi=0;$tymi<$tymr;$tymi++)
    {
        $tyag=mysql_fetch_object($tym);
        echo "$tyag->name <input name=\"agcb_$tymi\" class=\"buttonz\" type=\"checkbox\" value=\"$tyag->id\" ";
        $yagd=0;
        for($yagci=0;$yagci<$yagc;$yagci++) if($yag[$yagci]==$tyag->id) $yagd=1;
        if($yagd==1) echo "checked>";
        else echo ">";
    }
    */

    echo "</td></tr><tr>";
    echo "<td><input type=submit name=submit value=\"modify it!\"></td>\n";
    echo "</tr><tr>\n";
    echo "</tr></table>\n";
    echo "</form>\n";
}

function show1message($post,$gx)
{
    $data=$GLOBALS['data'];
    $forum_color=$GLOBALS['forum_color'];
    $locate=$GLOBALS['locate'];
    $pster=dm_getuserdata($post['poster']);
    $logged_in=$GLOBALS['logged_in'];

    $forum=mysql_fetch_object(dm_query("select * from forum_list where id=".$post['forum']));         

    if( ($forum->private=="yes") && ( ($logged_in!="true") || ($data->access!=255) ))
    {
        echo "<p>You don't have access to this forum.</p>";
    }
    else
    {

        echo "<table width=100% border=0 cellpadding=1 cellspacing=1 bgcolor=#000000><tr><td>";

        echo "<table width=100% bgcolor=$forum_color[$gx] cellspacing=0 cellpadding=0>";
        echo "<tr><td valign=top width=100 align=center bgcolor=".$forum_color[$gx-1].">\n";
        echo "<table bgcolor=".$forum_color[$gx-1].">";

        if($post['poster']==666)
        {
            $pname=$post['poster_name'];
            echo "<tr><td valign=top width=140>";
            echo "$pname";
            echo "</td></tr>";
        }
        else
        {
            $pname=$pster->rpg_name;
            echo "<tr><td valign=top align=center>";

            // dm_useravatar($pster->name);
			echo "<img src=images/".rpg_getclassobj($pster->rpg_class)->image.">";

            echo "</td></tr>";
            echo "<tr><td valign=top align=left>";
            echo "<a href=rpg_profile.php?id=$pster->id>$pname</a>";
            echo "</td></tr>";
            echo "<tr><td  valign=top>";
            echo "posts:$pster->forumposts<br>replies:$pster->forumreplies";
            echo "</td></tr>";
        }

        echo "</table>";
        echo "</td><td align=left valign=top width=100%>\n";

        echo "<table border=0 cellspacing=5 cellpadding=5 width=100%><tr><td>";

        echo "<h1>".$post['title']."</h1>";

        echo smiles(stripslashes($post['message']));

        echo "</td></tr></table>";

        echo "</td></tr>";
        echo "<tr><td bgcolor=".$forum_color[$gx-1].">&nbsp;</td><td align=right>";

        $time=b4time($post['time']);
    
        echo "posted $time by <a href=rpg_profile.php?id=$pster->id>$pster->rpg_name</a>";
        if($logged_in=="true")
        {
            if( ($pster->name==$data->name) || ($data->access=="255")  )
            {
                $thread=$post['thread'];
                $whichrep=$post['id'];
                $forum_witch=$post['forum'];
				if($post['thread_top']=="yes")
					echo " [<a href=\"forum.php?action=delete_post_s&forum_which=$forum_witch&reply=$whichrep&thread=$thread\">delete</a>]";
				else
					echo " [<a href=\"forum.php?action=delete_reply_s&forum_which=$forum_witch&reply=$whichrep&thread=$thread\">delete</a>]";
                echo "[<a href=\"forum.php?action=edit_reply&forum_which=$forum_witch&reply=$whichrep&thread=$thread\">edit</a>]";
            }
        }

        echo "</td></tr></table>\n";

        echo "</td></tr></table>\n";
        echo "<br>\n";
    }
}

function get_thread($thread,$forum_which)
{    
    $expand=$GLOBALS['expand'];
    $expand_all=$GLOBALS['expand_all'];
    $data=$GLOBALS['data'];
    $logged_in=$GLOBALS['logged_in'];
    $locate=$GLOBALS['locate'];
    $breadcrumb=$GLOBALS['breadcrumb'];
    $forum_color=$GLOBALS['forum_color'];
    $gt=1; $gx=4+$gt;
    $result = dm_query("select * from `forum_posts` where `thread_top`='yes' and `thread`='".$thread."' order by time limit 0,30");
    if($result) $numposts=mysql_num_rows($result);
    if($numposts>0) $post=mysql_fetch_array($result);
    if($forum_which!=$post['forum']) { echo "<p>Error! This post or reply has been moved or deleted.</p>"; return; }
    $forum_which=$post['forum'];
    $der=mysql_fetch_array(dm_query("select * from `forum_list` where `id`='$forum_which';"));
    $title=stripslashes($post['title']);
    $thread=$post['id'];
    $GLOBALS['forum_showposts']="no";
    $GLOBALS['forum_list']="no";

    if($numposts>0)
    {
        $views=$post['views']+1;
        dm_query("update forum_posts set views ='$views' where thread_top='yes' and thread=$thread");
        
        show1message($post,$gx);                

        $fart = dm_query("select * from forum_posts where `forum`='".($forum_which)."' and `thread`='".$thread."' and `thread_top`='no' order by time limit 0,30");
        if($fart) $numreplies=mysql_num_rows($fart);
        if($numreplies>0)
        {
            for($i=0;$i<$numreplies;$i++)
            {
                $gt++; if($gt>2) $gt=1; $gx=4+$gt;
                $post = mysql_fetch_array($fart);
                show1message($post,$gx);
            }
        }

        // form to add another reply
        if($logged_in=="true")
        {
            echo "<table width=100% border=0 cellpadding=1 cellspacing=1 bgcolor=#000000><tr><td>";

            echo "<table width=100% bgcolor=$forum_color[$gx] cellspacing=0 cellpadding=0>";
            echo "<tr><td valign=top>\n";

            echo "<table width=100% >\n";
            echo "<form action=\"forum.php\" method=post>\n";
            echo "<input type=hidden name=action value=reply_to_thread>\n";
            echo "<input type=hidden name=forum_which value=\"$forum_which\">\n";
            echo "<input type=hidden name=thread value=\"".$thread."\">\n";
            echo "<tr><td align=right valigh=top>Title:</td><td><input type=text name=header value=\"re:";
			echo stripslashes($title);
			echo "\" size=78></td></tr>\n";
            echo "<tr><td align=right valigh=top>Reply:</td><td><textarea name=reply cols=78 rows=10></textarea></td></tr>\n";
            echo "<tr><td align=right valigh=top>Anonymous:</td><td><select name=anonymous><option>no<option>yes</select> &nbsp;<input type=submit name=submit value=\"Go!\"></td></tr>\n";
            echo "<tr><td>&nbsp;</td><td></td></tr>\n";
            echo "</form>\n";
            echo "</table>\n";

            echo "</td></tr></table>\n";

            echo "</td></tr></table>\n";
        }
        else
        {
            echo "<p class=dm_locater><a href=login.php>Login</a> to reply to this post!</p>\n";
        }
    }
    echo "<br>\n";
}


if($action=="move_thread")
{
    $tofor=dm_query("select * from forum_list where name='$move'");
    $toforum=mysql_fetch_object($tofor);
    dm_query("update forum_posts set forum='$toforum->id' where id='$id'");
    dm_query("update forum_posts set forum='$toforum->id' where thread='$id'");
    echo "<p>Move thread $id to $move ($toforum->id)</p>";
    $action="get_thread";
}

if($action=="delete_post_s")
{
    if($logged_in=="true")
    {
        echo "<table border=\"0\" align=center><tr><td class=\"dm_warning\"><center>".smiles(":X")."\n";
        echo "<br>WARNING:<br>The forum post and ALL replies will be completely removed are you sure?</center>\n";
        echo "</td></tr></table>\n";
        echo "<table align=center><tr><td><form action=\"forum.php\">\n";
        echo "<input type=hidden name=action value=delete_post>";
		echo "<input type=hidden name=thread value=$thread>";
		echo "<input type=hidden name=reply value=$reply>\n";
        echo "<input type=\"submit\" name=\"submit\" value=\"Yes delete it\"></form></td>\n";
        echo "<td><form action=\"forum.php\"><input type=\"submit\" name=\"no\" value=\"No\"></form></td></tr></table>\n";    
    }
}


if($action=="delete_post")
{
    if($logged_in=="true")
    {
        dm_query("delete from forum_posts where thread='$thread';");
        echo "<h2><font color=red>Post was deleted...</font></h2>";
        $forum_list="no";
        $forum_showposts="yes";
        $action="get_thread";
    }
}

if($action=="delete_reply_s")
{
    if($logged_in=="true")
    {
        echo "<table border=\"0\" align=center><tr><td class=\"dm_warning\"><center>".smiles(":X")."\n";
        echo "<br>WARNING:<br>The forum reply will be completely removed are you sure?</center>\n";
        echo "</td></tr></table>\n";
        echo "<table align=center><tr><td><form action=\"forum.php\">\n";
        echo "<input type=hidden name=action value=delete_reply><input type=hidden name=reply value=$reply>\n";
        echo "<input type=\"submit\" name=\"submit\" value=\"Yes delete it!\"></form></td>\n";
        echo "<td><form action=\"forum.php\"><input type=\"submit\" name=\"no\" value=\"No\"></form></td></tr></table>\n";
    }
}

if($action=="delete_reply")
{
    if($logged_in=="true")
    {
        dm_query("delete from forum_posts where `id`='$reply';");
        echo "<h2><font color=red>Reply was deleted...</font></h2>";
        $action="get_thread";
    }
}

if($action=="edit_reply")
{
    if($logged_in=="true")
    {
        $posttt=dm_query("select * from forum_posts where id='$reply';");
        $post=mysql_fetch_object($posttt);
        $fw=$forum_which;
        echo "<table border=0 width=100%>\n";
        echo "<form action=forum.php method=post>\n";
        echo "<input type=hidden name=action value=edit_reply_go>\n";
        echo "<input type=hidden name=reply value=$reply>\n";
        echo "<input type=hidden name=forum_which value=$forum_which>\n";
        echo "<input type=hidden name=thread value=$thread>\n";
        echo "<tr><td align=right>Message Title:</td><td><input type=text name=title value=\"";
	    echo stripslashes($post->title);
	    echo "\"></td></tr>\n";
        echo "<tr><td align=right>Message:</td><td><textarea name=message cols=110 rows=20>";
	    echo stripslashes($post->message);
	    echo "</textarea></td></tr>\n";
        echo "<tr><td>&nbsp;</td><td><input type=submit name=submit value=go></td></tr>\n";
        echo "</form></table>\n";
    }
}

if($action=="edit_reply_go")
{
	$message=addslashes($message);
	$title=addslashes($title);
    if($logged_in=="true")
    {
        dm_query("UPDATE forum_posts SET message = '$message' where id = '$reply'");
        dm_query("UPDATE forum_posts SET title   = '$title'   where id = '$reply'");
        $action="get_thread";
    }
}

if($action=="reply_to_thread")
{
    if($logged_in=="true")
    {
        $user=$data->id; if($anonymous=="yes") $user=999;
        $time=date("Y-m-d H:i:s");
        $header=addslashes($header);
        $reply=addslashes($reply);
        $query  = "INSERT  INTO  `forum_posts` ";
        $query .= "( `id`, `poster`, `title`, `message`, `thread`, `forum`, `time`, `thread_top` ) ";
        $query .= "VALUES (  '',  '$user',  '$header',  '$reply',  '$thread',  '$forum_which',  '$time',  'no' );";
        dm_query($query);

		rpg_setvar("forumreplies",$data->forumreplies+1);
        // addforumreplies($data->name,1);

        $fart=dm_query("select * from `forum_posts` order by `time` desc limit 1");
        $lick=mysql_fetch_object($fart); 
        dm_query("UPDATE `forum_list` set `last_post` = '$lick->id' where `id` = '$forum_which';");
        bumpthread($lick->thread);
        dm_log("*****> $data->name replied to thread [$header]");
    }
    else
    {
        echo "<p class=dm_locater><a href=login>Login</a> to reply</p>\n";
    }
    $action="get_thread";
}

if($action=="get_thread")
{
    get_thread($thread,$forum_which);
}

if($action=="create_forum")
{
    if($data->access==255)
    {
        dm_query("INSERT INTO `forum_list` 
                (`name`        ,  `comment`     , `folder`        , `parent` )
         VALUES ('$forum_name' ,  '$forum_desc' , '$forum_folder' , '$forum_parent' );");
        // now show the forum modification panel (FMP)
        dm_forum_modification_panel($forum_name);
        $forum_list="no";
    }
}

if($action=="rename_forum")
{
    $forum_name=addslashes($forum_name);
    $old_name=addslashes($old_name);
    if($data->access==255) dm_query("UPDATE forum_list SET `name`='$forum_name' where `name`='$old_name' limit 1;");
    // now show the forum modification panel (FMP)
    dm_forum_modification_panel(stripslashes($forum_name));
    $forum_list="no";
}

if($action=="modify_forum")
{
    if($data->access==255)
    {
        $con=1;
        if($forum_usepass=="yes")
        {
            if($forum_pass1!=$forum_pass2)
            {
                echo "<p>The two passwords you entered do not match!</p>\n";
                $con=0;
                dm_forum_modification_panel($forum_name);
                $forum_list="no";
            }
        }
        if($con==1)
        {
            $forum_name=stripslashes($forum_name);
            echo "$forum_name";
            dm_setvar("forum_list","name",addslashes($forum_name),"name",$old_name);
            dm_setvar("forum_list","comment",addslashes($forum_desc),"name",addslashes($forum_name));
            dm_setvar("forum_list","usepass",$forum_usepass,"name",addslashes($forum_name));
            dm_setvar("forum_list","password",$forum_pass1,"name",addslashes($forum_name));
            dm_setvar("forum_list","private",$forum_private,"name",addslashes($forum_name));
            dm_setvar("forum_list","moderated",$forum_moderated,"name",addslashes($forum_name));
            $userdata=dm_getuserdata($forum_moderator);
            dm_setvar("forum_list","moderator",$userdata->id,   "name",addslashes($forum_name));
            dm_setvar("forum_list","bgcolor",  $forum_bgcolor,  "name",addslashes($forum_name));
            dm_setvar("forum_list","priority", $forum_priority, "name",addslashes($forum_name));
            /*
            $tym=dm_query("select * from `access_groups`");
            $tymr=mysql_num_rows($tym);
            $nags="";
            for($tymi=0;$tymi<$tymr;$tymi++)
            {
                $tcb=$_REQUEST["agcb_$tymi"];
                if(!empty($tcb))
                {
                    $nags=$nags."$tcb,";
                }
            }
            dm_query("UPDATE `forum_list` set `access_groups` = '$nags' where `name`='$forum_name'");
            */
        }
    }
    else
    {
        echo "<p> ".smiles(":X")." You do not have access to modify the forums!</p>";
        dm_log("*****> $data->name tried to access the forum administration panel...");
    }
}

if($forum_list=="yes")
{
    // list forums here...
    
    $fres = dm_query("select * from forum_list where `folder`='yes' order by priority");
    
    $numfolder=mysql_num_rows($fres);
    if($numfolder>0)
    {
        $fihg=0;
        while($fihg<$numfolder)
        {
            $fihg++;
            $dfold=mysql_fetch_object($fres);
              
            $seefolder=false;
            if($data->access_groups=="") $seefolder=false;
            if($data->access==255) $seefolder=true;
            else
            {
                $agar=explode(",",$dfold->access_groups); $agarc=count($agar);
                $uagar=explode(",",$data->access_groups); $uagarc=count($uagar);
                for($agari=0;$agari<$agarc;$agari++)
                for($uagari=0;$uagari<$uagarc;$uagari++)
                {
            	    if(empty($agar[$agari]) || empty($uagar[$uagari])) {}
            	    else if($agar[$agari]==$uagar[$uagari]) $seefolder=true;
                }
            }

            $seefolder=true;
            if($seefolder==true)
            {                
				echo "<h1>$dfold->name</h1>";
                //echo "<br>";
                //echo "<table width=100% cellspacing=0 cellpadding=0 bgcolor=\"".$dfold->bgcolor."\">";
                //echo "<tr><th colspan=\"2\" width=\"100%\" align=left>&nbsp;$dfold->name&nbsp;";
                //echo "</th></tr>\n";
                //echo "</table>";

                $result = dm_query("select * from `forum_list` where `parent`='$dfold->id' order by priority");
                $numforums=mysql_num_rows($result);
                
                echo "<table width=100% cellspacing=0 cellpadding=0>\n";
                if($numforums>0)
                {
                    $gt=1; $i=0;
                    while($i<$numforums)
                    {
                        $new=0;
                        $der = mysql_fetch_object($result);
                        $name=stripslashes($der->name);
                        $comment=stripslashes($der->comment);
                        $moder=$der->moderator;

                        $dumpforum=1;

                        if(($der->private=="yes")&&($data->access<254)) $dumpforum=0;
                        
		                $agar=explode(",",$der->access_groups); $agarc=count($agar);
		                $uagar=explode(",",$data->access_groups); $uagarc=count($uagar);
		                for($agari=0;$agari<$agarc;$agari++)
		                for($uagari=0;$uagari<$uagarc;$uagari++)
		                {
		            	    if( (empty($agar[$agari])) ||
		            	        (empty($uagar[$uagari])) ) {}
		            	    
		                    else if($agar[$agari]==$uagar[$uagari])
		                    {
		                 	    $dumpforum=1;
		                     }
		                }
                        
                        if($dumpforum)
                        {            
                            $fork = dm_query("select * from forum_posts where `forum`= '$der->id' and `thread_top`='yes'");
                            $posts=0;
                            if($fork) $posts=mysql_num_rows($fork);
                            for($star=0;$star<$posts;$star++)
                            {
                                $fart=mysql_fetch_array($fork);
                                if($fart['time']>=$data->last_login) $new=1;
                                $lip = dm_query("select * from forum_posts where `thread`=".($fart['thread']));
                                $postst=0;
                                if($lip) $postst=mysql_num_rows($lip);
                                for($stary=0;$stary<$postst;$stary++)
                                {
                                    $farter=mysql_fetch_array($lip);
                                    if($farter['time']>=$data->last_login) $new=1;
                                }
                            }
                            $link="forum.php?forum_which=$der->id&forum_showposts=yes";
                            $gt=$gt+1; if($gt>2) $gt=1; $gx=$gt+2; $gy=$gt+4;
                            echo "<tr><td>&nbsp;</td></tr>";
                            echo "<tr><td bgcolor=$forum_color[$gt] style=\"color: $forum_font\" width=20% >\n";
                            
                            
                            echo "<table border=0>\n";
                            echo "<tr>\n";
                            echo "<td  class=\"row1\" align=\"center\" valign=\"middle\" height=\"50\">";
                            $folderpic="images/folder_big.gif";
                            $alttxt="No new posts";
                            if($new==1) { $folderpic="images/folder_new_big.gif"; $alttxt="New posts"; }
                            echo "<a href=\"$link\" class=\"forumlink\"><img src=\"$folderpic\" alt=\"$alttxt\" title=\"$alttxt\" border=0></a></td>\n";
                            echo "<td class=\"row1\" width=\"300\" height=\"50\" colspan=\"1\" valign=\"middle\">\n";
                            echo "<span class=\"forumlink\"><a href=\"$link\" class=\"forumlink\">$name</a><br /></span>\n";
                            echo "<span class=\"genmed\">$comment</span>\n";
                            if($der->moderated=="yes") {
                            echo "<span class=\"gensmall\"><br />";
                            echo "<b>Moderator [</b>";
                            $foruser=dm_getuserdata($moder);
                            echo "<a href=rpg_profile.php?id=$foruser->id>$foruser->rpg_name</a>]";
                            echo "</span>\n";
                            }
                            $fart=dm_query("select * from `forum_posts` where `forum`= '$der->id' and `thread_top`='yes'");
                            $topics=mysql_num_rows($fart);
                            $fart=dm_query("select * from `forum_posts` where `forum`='$der->id';");
                            $posts=mysql_num_rows($fart);
                            echo "<br><span class=\"gensmall\">$topics topics / $posts posts</span>";
                            $ruhroh=dm_query("select * from `forum_posts` where `forum` = '$der->id' order by time desc limit 1");
                            if(mysql_num_rows($ruhroh))
                            {
                                echo "</td><td>";
                                $lastpost=mysql_fetch_object($ruhroh);
                                echo "<br>";
                                echo "<span class=\"gensmall\">";
                                $link="forum.php?action=get_thread&thread=$lastpost->id";
                                $link="forum.php?forum_list=no&action=get_thread&thread=$lastpost->thread&forum_which=$lastpost->forum";
                                echo "latest post: <a href=\"$link\" title=\"$lastpost->title\">$lastpost->title</a>";
                                echo "<br>";
                                echo "posted ".b4time($lastpost->time); //Tue 11 Jul, 2006 00:33<br>"; ****
                                echo "<br>";
                                $udata=dm_getuserdata($lastpost->poster);
                                echo "by <a href=\"rpg_profile.php?id=$udata->id\">$udata->rpg_name</a>";
                                echo "<a href=\"$link\"><img src=\"images/icon_latest_reply.gif\" width=\"18\" height=\"9\" class=\"imgspace\" border=\"0\" alt=\"View latest post\" title=\"View latest post\" /></a>";
                                echo "</span>";
                            }
                            echo "</td>\n";
                            echo "</tr>";
                            echo "</table>\n";
                            echo "</td></tr>\n";
                            
                        }
                        $i=$i+1;
                    }
                }
                else
                {
                    echo "There are no forums defined!\n";
                }
                
                echo "</table>\n";
                echo "<br>";
            }
        }
    }
    else
    {
        echo "<p> Error! </p>";
    }
}

if($forum_showposts=="yes")
{
    $der=mysql_fetch_object(dm_query("select * from `forum_list` where `id`='$forum_which';"));

    echo "<table width=100% border=0><th align=left>Defective Minds Forum > $der->name</th></table><br>";            
    
    $result = dm_query("select * from forum_posts where `forum`='$forum_which' and `thread_top`='yes' order by bumptime desc limit 0,30");
    if($result) $numposts=mysql_num_rows($result);
    else $numposts=0;
    if($numposts)
    {
       $gt=1; $i=0;
        echo "<table width=100% cellspacing=0 cellpadding=0>\n";

        echo "<tr><td>Topics&nbsp;</td><td>Replies&nbsp;</td><td>Views&nbsp;</td><td>Latest Reply&nbsp;</td><td></td></tr>";
        

        for($i=0;$i<$numposts;$i++)
        {
            $new=0;
            $gt=$gt+1; if($gt>2) $gt=1; $gx=$gt+2; $gy=$gt+4;
            $post=mysql_fetch_array($result);
            $fork = dm_query("select * from forum_posts where `thread`=".$post['thread']." and `thread_top`='no'");
            $posts=0;
            if($fork) $posts=mysql_num_rows($fork);
            for($star=0;$star<$posts;$star++)
            {
                $fart=mysql_fetch_array($fork);
                if($fart['time']>=$data->last_login) $new=1;
            }
            
            $link="<a href=\"forum.php?action=get_thread&thread=".$post['thread']."&forum_which=$forum_which\">".stripslashes($post['title'])."</a>\n";
            echo "<tr>";
            
            
            echo "<td bgcolor=$forum_color[$gx] style=\"color: $forum_font\" width=400>\n";
            
            echo "<table border=0 cellspacing=0 cellpadding=0>";            
            echo "<tr><td>\n";
            echo "<img src=\"images/icon_minipost.gif\" border=0 > &nbsp;\n";
            echo "</td><td>";
            
            echo "$link\n";
            echo "</td></tr>";

            echo "<tr><td>";
            echo "</td><td>";
            
            $time=b4time($post['time']);
            $great=dm_getuserdata($post['poster']);
            echo "Posted by ".$great->rpg_name." on $time";
            echo "</td></tr>";

            echo "</table>\n";

            echo "</td><td bgcolor=$forum_color[$gx] align=left>";
            
            echo " $posts ";
		    
		    echo "</td><td bgcolor=$forum_color[$gx] align=left>";
		    
		    echo $post['views'];
		    
		    echo "</td><td bgcolor=$forum_color[$gx]>";
		    
		    $lreply="";
			$lrepr=dm_query("select * from forum_posts where `thread`=".$post['thread']." and `thread_top`='no' order by `time` desc limit 1");
			if($lrepr) $lreply=mysql_fetch_object($lrepr);
			if($lreply)			
			{

				$great=dm_getuserdata($lreply->poster);
				echo "<a href=\"forum.php?action=get_thread&thread=$lreply->thread&forum_which=$forum_which\">".stripslashes($lreply->title)."</a>\n";
				echo "<br>by $great->rpg_name on ".b4time($lreply->time);
			}
			else
			{
				echo "none";
			}
		    
		    echo"</td>";		    
		    

		    echo "<td bgcolor=$forum_color[$gx]>";

            if( ($data->access==255) & ($_SESSION['forum_admin']=="yes"))
            {
                echo "<form action=\"forum.php\">\n";
                echo "<input type=hidden name=action value=move_thread><input type=hidden name=id value=".$post['id'].">\n";
                
                $resultj = dm_query("select * from forum_list where `folder`!='yes' order by priority");
                $numforumsj=mysql_num_rows($resultj);
		        echo "Move to:<select name=move>";
                for($jji=0;$jji<$numforumsj;$jji++)
                {
                    $forumj=mysql_fetch_object($resultj);
                    echo "<option>$forumj->name";
                }

                echo "</select>";
                echo "<input type=\"submit\" name=\"submit\" value=\"go\"></form>";
            }

		    echo "</td>";		    
		    
		    echo"</tr>";
		    
		    echo "</td>";

            echo "</tr>\n";
        }
        echo "</table>\n";
    }
    else echo "<p align=center> There are no threads! </p>\n";    
}

//$der=mysql_fetch_object(dm_query("select * from `forum_list` where `id`='$forum_which';"));
//forum_put_buttons($der->id);

include("rpg_footer.php");
?>




