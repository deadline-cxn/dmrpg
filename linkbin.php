<?
include("rpg_header.php");
$data=getuserdata($HTTP_SESSION_VARS['valid_user']);

function linkbin_showaddform()
{
    echo "<h2>For consistency please put all link short names in all lower case unless it is necessary, thanks management</h2>\n";
    echo "<table border=0>\n";
    echo "<form action=\"".$GLOBALS['locate']."/linkbin.php\" method=\"post\">\n";
    echo "<tr><td align=right>Link URL:       </td><td><input name=linkurl value=\"http://\" size=80></td></tr>\n";
    echo "<tr><td align=right>Link Short Name:</td><td><input name=short_name size=40></td></tr>\n";
    echo "<tr><td align=right>Description:    </td><td><textarea name=description rows=10 cols=70></textarea></td></tr>\n";
    echo "<tr><td align=right>Category:</td><td><select name=category>\n";
    $result=dm_query("select * from link_bin_categories");
    $numcats=mysql_num_rows($result);
    for($i=0;$i<$numcats;$i++)
    {
    	$cat=mysql_fetch_object($result);
    	echo "<option>$cat->name\n";
    }
    echo "</select></td></tr>\n";


    echo "<tr><td align=right>&nbsp;          </td><td><input type=submit name=submit value=\"add\"></td></tr>\n";
    echo "<input type=hidden name=action value=addlinkgo>\n";
    echo "</form>\n";
    echo "</table>\n";
}
if($action=="addlink")
{
    linkbin_showaddform();
}

if($action=="addlinkgo")
{
    $description=addslashes($description);
    $short_name=addslashes($short_name);
    $time=date("Y-m-d H:i:s");
    if($data->id==0) $data->id=999;
    dm_query("insert into `link_bin` values('','$linkurl','$data->id','$time','$short_name','0','0','$description','0','3','')");
    addsp($data->name,10);
    addlinks($data->name,1);
    echo "<p>Link [$short_name][$linkurl] added to linkbin...</p>\n";
    $action="editlinkbin";
}

if($action=="modifylinknow")
{
	if($deletelink=="delete")
    {
        echo "<p><h1>Deleting Link!</h1></p>\n";
        dm_query("DELETE FROM link_bin where `id` = '$linkid' limit 1", $mysql);
        dm_log("*****> $data->name deleted a link from the linkbin [$short_name][$link]");
        $action="editlinkbin";
    }
    if($renamelink=="modify")
    {
    	echo "<p><h1>Modifying Link!</h1></p>\n";
        $short_name=addslashes($short_name);
        $linkurl=addslashes($linkurl);
        $description=addslashes($description);
        $category=addslashes($category);
    	dm_query("update link_bin set `sname` = '$short_name' where `id` = '$linkid'");
    	dm_query("update link_bin set `link` = '$linkurl' where `id` = '$linkid'");
    	dm_query("update link_bin set `description` = '$description' where `id` = '$linkid'");
    	$hide=0; if($hidden=="yes") { $hide=1; } if($hidden=="no")  { $hide=0; }
    	dm_query("update link_bin set `hidden` = '$hide' where `id` = '$linkid'");
    	dm_query("update link_bin set `referrals` = '$referrals' where `id` = '$linkid'");
    	dm_query("update link_bin set `clicks` = '$clicks' where `id` = '$linkid'");
    	dm_query("update link_bin set `category` = '$category' where `id` = '$linkid'");
    	dm_query("update link_bin set `rating` = '$rating' where `id` = '$linkid'");
        $action="editlinkbin";
    }

}
if($action=="addlink2bin")
{
    echo "<h1>Dump a Link in the Bin!</h1>\n";
    $time=date("Y-m-d H:i:s");
    dm_query("INSERT INTO link_bin VALUES ('', '$linkurl', '".$data->id."', '".$time."', '".$_REQUEST['linksn']."', '', '' ,'','3');");
    dm_log("*****> $data->name added a link to the linkbin [".$_REQUEST['linksn']."]");
    $action="linkbin";
}
if($action=="editlinkbin")
{
    echo "<p><h1>Link Bin Edirator</h1></p>\n";
    // list all the links here with edit or delete buttons...
    $result=dm_query("select * from link_bin order by time desc");
    $numlinks=mysql_num_rows($result);
    echo "<table width=100% border=0 cellspacing=0 cellpadding=0 align=center>\n";

    $gt=2;
    for($i=0;$i<$numlinks;$i++)
    {
    	    $gt++;if($gt>3)$gt=2;
            echo "<tr><td bgcolor=$forum_color[$gt]>\n";

            $link=mysql_fetch_object($result);
            $userdata=dm_getuserdata($link->poster);

            echo "<table border=0 cellspacing=0 cellpadding=0 width=100% bgcolor=$forum_color[$gt]>\n";
            echo "<form action=linkbin.php method=\"post\">\n";
            echo "<input type=\"hidden\" name=\"action\" value=\"modifylinknow\">\n";
            echo "<input type=\"hidden\" name=\"linkid\" value=\"$link->id\">\n";

            echo "<tr bgcolor=$forum_color[$gt]>\n";
            echo "<td bgcolor=$forum_color[$gt] width=130><input type=text name=short_name value=\"$link->sname\" size=18></td>";
            echo "<td width=250><input type=text name=linkurl value=\"$link->link\" size=40> </td>\n";
            echo "<td width=300>(submitted by $userdata->name on ".b4time($link->time).")</td>\n";
            echo "<td>Rating:</td>\n";
            echo "<td bgcolor=$forum_color[$gt] width=100 align=center><input type=submit name=renamelink value=modify></td>\n";
            echo "</tr>\n";
            echo "<tr>\n";

            echo "<td>\n";
                echo "<select name=category>\n";
                echo "<option>$link->category\n";
                /*
                $result2=dm_query("select * from link_bin_categories");
                $numcats=mysql_num_rows($result2);
                for($i2=0;$i2<$numcats;$i2++)
                {
                	$cat=mysql_fetch_object($result2);
                	echo "<option>$cat->name\n";
                }
                */
                echo "</select>\n";
                echo "</td>\n";

            echo "<td><input type=text name=description value=\"$link->description\" size=40></td>\n";
            echo "<td><table border=0><tr>\n";
            echo "<td>referrals</td><td><input type=text size=3 name=referrals value=\"$link->referrals\"></td>\n";
            echo "<td>clicks</td><td><input type=text size=3 name=clicks value=\"$link->clicks\"></td>\n";
            if($link->hidden==0) echo "<td>hidden</td><td><select name=hidden><option>no<option>yes</td>\n";
            if($link->hidden==1) echo "<td>hidden</td><td><select name=hidden><option>yes<option>no</td>\n";
            echo "</tr></table></td>\n";
            echo "<td><select name=rating><option>$link->rating\n";
            for($j=1;$j<6;$j++) echo "<option>$j\n";
            echo "</select></td>\n";
            echo "<td align=center><input type=submit name=deletelink value=delete></td>\n";

            echo "</tr>\n";
            echo "<tr bgcolor=$forum_color[1]><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
            echo "</table>\n";
            echo "</form>\n";
            echo "</td></tr>\n";
    }

    echo "<tr><td>\n";
    echo "</td></tr></table>\n";
    // add a new link here...

    linkbin_showaddform();
}



$result=dm_query("select * from link_bin order by time desc");
$numlinks=mysql_num_rows($result);
echo "<table width=100% cellspacing=0 cellpadding=0 border=0>\n";
$gt=4;
for($u=0;$u<$numlinks;$u++)
{
    $gt++; if($gt>5) $gt=4;
    $link=mysql_fetch_object($result);
    $userdata=dm_getuserdata($link->poster);
    list($lmonth,$lday,$lyear,$ltime,$lampm) = explode(" ",b4time($link->time));
    if($lmonth!=$lastmonth)
    {
        echo "<tr bgcolor=$forum_color[1]><td></td><td><h1>$lmonth $lyear</h1></td><td></td><td></td></tr>\n";
        $lastmonth=$lmonth;
    }
    if(empty($link->description)) $link->description="<i>No description</i>";
    echo "<tr bgcolor=$forum_color[$gt]><td><a href=\"$locate/link_out.php?link=$link->link\" target=\"_blank\">$link->sname</a></td>\n";
    echo "<td><i><a href=\"$locate/link_out.php?link=$link->link\" target=\"_blank\">$link->link</a></i></td>\n";
    echo "<td> added on ".b4time($link->time)." by <a href=\"$locate/showprofile.php?user=$userdata->name\">$userdata->name</a>. </td>\n";
    echo "<td>\n";
    for($i=0;$i<$link->rating;$i++)
    {
    	echo "<img src=\"$locate/images/thumbs_up.gif\" border=0 alt=\"$link->rating thumbs up\" title=\"$link->rating thumbs up\">";
    }
    echo "</td>\n";
    echo "</tr>\n";

    echo "<tr bgcolor=$forum_color[$gt]><td></td>\n";
    echo "<td>$link->description</td>\n";
    echo "<td>refs: $link->referrals clicks:$link->clicks</td> <td>\n";
          // insert rating vote here
    echo "</td></tr>\n";
    echo "<tr><td>\n";
    echo "</td><td></td><td></td><td></td></tr>\n";
}
echo "</table>\n";


include("footer.php");
?>
