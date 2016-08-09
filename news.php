<?php
////////////////////////////////////////////////////
// defective minds news v4.o

if(!function_exists('keywords')) include("rpg_header.php");

$data=getuserdata($_SESSION['valid_user']); 
if(empty($headline)) $headline = $_REQUEST['title'];

function put_news_image($fname)
{
    $file=$_FILES[$fname]['name'];
    $local_path=$GLOBALS['local_path'];
    $locate=$GLOBALS['locate'];

    $f_ext=dm_getfiletype($file);
    $uploadFile=$local_path."/images/news/$file";
    if(($f_ext=="gif")||($f_ext=="jpg")||($f_ext=="swf"))
    {
        $oldname=$file;
        if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadFile))
        {
            system("chmod 755 $uploadFile");            
            $httppath="$locate/images/news/".$_FILES['userfile']['name'];
            echo "<p>File stored as [<a href=\"$httppath\" target=\"_blank\">$httppath</a>]</p>\n";
        }
    }
    return $httppath;
}

if($give_file=="news_cat_add")
{
    $image=put_news_image('userfile');
}
if($give_file=="news_cat_mod")
{
    $image=put_news_image('userfile');    
}

if($give_file=="news")
{
    if(empty($data->name)) echo "<p>No...</p>\n";
    else
    {
        $httppath=put_news_image('userfile');
    }
    dm_query("update `news` set `image_url`='$httppath' where `id`='$nid'");
    $action="ed";
}

if($give_file=="news_sup")
{
    if(empty($data->name)) echo "<p>No...</p>\n";
    else
    {
        put_news_image('userfile');
        put_news_image('userfile2');
        put_news_image('userfile3');
        put_news_image('userfile4');
        put_news_image('userfile5');
    }
    $action="ed";
}

if(!empty($bot))
{
    if(empty($_SESSION['bot']))
    {
        $_SESSION['bot']=$bot;
    }
}
else
{
    $bot=$_SESSION['bot'];
}

function updatenews($nid)
{
    $p=addslashes($GLOBALS['headline']); dm_query("UPDATE news SET headline ='$p' where id = '$nid'");
    $p=addslashes($GLOBALS['posttext']); dm_query("UPDATE news SET message ='$p' where id = '$nid'");


    $p=addslashes($GLOBALS['category1']);
    dm_query("UPDATE `news` SET `category1` ='$p' where id = '$nid'");
    $p=addslashes($GLOBALS['category2']);
    if($p!="none") dm_query("UPDATE `news` SET `category2` ='$p' where id = '$nid'");
    $p=addslashes($GLOBALS['category3']);
    if($p!="none") dm_query("UPDATE `news` SET `category3` ='$p' where id = '$nid'");
    $p=addslashes($GLOBALS['category4']);
    if($p!="none") dm_query("UPDATE `news` SET `category4` ='$p' where id = '$nid'");

    //$p=addslashes($GLOBALS['image']);
    //dm_query("UPDATE news SET image_url ='$p' where id = '$nid'");
    //$p=addslashes($GLOBALS['image_url']);
    //dm_query("UPDATE news SET image_link ='$p' where id = '$nid'");
    //$p=addslashes($GLOBALS['image_alt']);
    //dm_query("UPDATE news SET image_alt ='$p' where id = '$nid'");
    
    $p=$GLOBALS['topstory'];
    if($p=="yes")
    {
        dm_query("update news set topstory='no'");
        dm_query("update news set topstory='yes' where id='$nid'");
    }
    
    $p=$GLOBALS['published'];
    if($p=="yes") dm_query("update news set published='yes' where id='$nid'");
    else          dm_query("update news set published='no' where id='$nid'");

    echo "<p>News article [$nid] has been updated...</p>\n";
    $loggit="*****> ".$GLOBALS['data']->name." updated news article $nid...";
}

function deletenews($nid)
{
    $locate=$GLOBALS['locate'];
    echo "<table border=\"0\" align=center><tr><td class=\"dm_warning\"><center>".smiles(":X")."\n";
    echo "<br>WARNING:<br>The news article will be completely removed are you sure?</center>\n";
    echo "</td></tr></table>\n";
    echo "<table align=center><tr><td><form action=\"$locate/news.php\">\n";
    echo "<input type=hidden name=action value=dego><input type=hidden name=nid value=$nid>\n";
    echo "<input type=\"submit\" name=\"submit\" value=\"Fuck Yeah!\"></form></td>\n";
    echo "<td><form action=\"$locate/news.php\"><input type=\"submit\" name=\"no\" value=\"No\"></form></td></tr></table>\n";
}

function deletenewsgo($nid)
{
  
    dm_query("DELETE FROM news where id = '$nid'");
    echo "<p>News article $nid has been deleted...</p>\n";
    $loggit="*****> ".$GLOBALS['data']->name." deleted news article $nid...";
    dm_log($loggit);
    
}

function editnews($nid)
{
    $locate=$GLOBALS['locate'];
    $news=mysql_fetch_object(dm_query("select * from news where id='$nid'"));

    //echo "<tr><td>Image Link</td><td><input name=image_url value=\"".stripslashes($news->image_link)."\" size=100></td></tr>\n";
    //echo "<tr><td>Image URL </td><td><input name=image     value=\"".stripslashes($news->image_url)."\"  size=100></td></tr>\n";
    //echo "<tr><td>Image ALT </td><td><input name=image_alt value=\"".stripslashes($news->image_alt)."\"  size=100></td></tr>\n";
    
    echo "<a href=news.php?action=view&nid=$nid>Preview</a>";

    if(empty($news->image_url)) $news->image_url="images/noimage.gif";
    echo "<table border=0><tr><td>";
    echo "<img src=\"$news->image_url\" width=100 height=100>";
    echo "</td><td>";
    echo "<table border=0><tr>";
    echo "<td align=left>";
    echo "<p>150 x 150</p>";
    
    echo "Enter a url";
    echo "<table border=0>\n";
    echo "<form enctype=\"multipart/form-data\" action=\"news.php\" method=\"post\">\n";
    echo "<input type=hidden name=action value=imageupload>\n";
    echo "<input type=hidden name=nid value=$nid>";
    echo "<tr><td><input name=\"userfile\"> </td><td><input type=\"submit\" name=\"submit\" value=\"URL\"></td></tr>\n";
    echo "</form>\n";
    echo "</table>\n";    

    echo "Or select a file to upload";
    echo "<table border=0>\n";
    echo "<form enctype=\"multipart/form-data\" action=\"news.php\" method=\"post\">\n";
    echo "<input type=hidden name=give_file value=news>\n";
    echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"99900000\">";
    echo "<input type=hidden name=local value=\"images/news\">";
    echo "<input type=hidden name=hidden value=yes>\n";
    echo "<input type=hidden name=nid value=$nid>";
    echo "<tr><td><input name=\"userfile\" type=\"file\"> </td><td><input type=\"submit\" name=\"submit\" value=\"Upload!\"></td></tr>\n";
    echo "</form>\n";
    echo "</table>\n";
        
    echo "<table border=0>\n";
    echo "<form enctype=\"multipart/form-data\" action=\"news.php\" method=\"post\">\n";
    echo "<input type=hidden name=action value=clearnewsimage>\n";
    echo "<input type=hidden name=nid value=$nid>";
    echo "<tr><td>Or clear current image: <input type=\"submit\" name=\"submit\" value=\"Clear\"></td></tr>\n";
    echo "</form>\n";
    echo "</table>\n";

    echo "</td>";    
    echo "</tr></table>";

    echo "</td>";
    echo "<td>";

    echo "Add more pictures to use in this news article:<br>";
    echo "<table border=0>\n";
    echo "<form enctype=\"multipart/form-data\" action=\"news.php\" method=\"post\">\n";
    echo "<input type=hidden name=give_file value=news_sup>\n";
    echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"99900000\">";
    echo "<input type=hidden name=local value=\"images/news\">";
    echo "<input type=hidden name=hidden value=yes>\n";
    echo "<input type=hidden name=nid value=$nid>";
    echo "<tr><td><input name=\"userfile\" type=\"file\"></td></tr>\n";
    echo "<tr><td><input name=\"userfile2\" type=\"file\"></td></tr>\n";
    echo "<tr><td><input name=\"userfile3\" type=\"file\"></td></tr>\n";
    echo "<tr><td><input name=\"userfile4\" type=\"file\"></td></tr>\n";
    echo "<tr><td><input name=\"userfile5\" type=\"file\"></td></tr>\n";
    echo "<tr><td><input type=\"submit\" name=\"submit\" value=\"Upload!\"></td></tr>\n";
    echo "</form>\n";
    echo "</table>\n";
    echo "</td>";
    
    echo "</tr></table>";

    echo "<table border=0><form method=post action=\"$locate/news.php\">\n";
    echo "<input type=\"hidden\" name=\"action\" value=\"edgo\">\n";
    echo "<input type=\"hidden\" name=\"nid\" value=\"$nid\">\n";
    echo "<tr><td>Headline</td><td><input name=title value=\"$news->headline\"         size=100></td></tr>\n";

    echo "<tr><td>Message</td><td><textarea cols=\"100\" rows=\"40\" name=\"posttext\"  >".stripslashes($news->message)."</textarea></td></tr>\n";
    
    echo "<tr><td>Top Story:   </td><td><select name=topstory><option>no<option>yes</select></td></tr>\n";

    echo "<tr><td>Publish:   </td><td><select name=published>";
    echo "<option>$news->published";
    echo "<option>no<option>yes</select></td></tr>\n";

    /*
    echo "<tr><td>Main Category:</td><td><select name=category1>";           echo "<option>1";
    if(!empty($news->category1)) echo "<option>$news->category1";
    $res=dm_query("select * from `categories` order by `name` asc");
    $ncats=mysql_num_rows($res);
    for($i=0;$i<$ncats;$i++)
    {
        $cat=mysql_fetch_object($res);
        echo "<option>$cat->name";
    }
    echo "</select></td></tr>\n";

    echo "<tr><td>Sub Category 1:</td><td><select name=category2>";
    if(!empty($news->category2)) echo "<option>$news->category2";
    echo "<option>none";
    $res=dm_query("select * from `categories` order by `name` asc");
    $ncats=mysql_num_rows($res);    
    for($i=0;$i<$ncats;$i++)
    {
        $cat=mysql_fetch_object($res);
        echo "<option>$cat->name";
    }
    echo "</select></td></tr>\n";

        echo "<tr><td>Sub Category 2:</td><td><select name=category3>";
    if(!empty($news->category3)) echo "<option>$news->category3";
    echo "<option>none";
    $res=dm_query("select * from `categories` order by `name` asc");
    $ncats=mysql_num_rows($res);    
    for($i=0;$i<$ncats;$i++)
    {
        $cat=mysql_fetch_object($res);
        echo "<option>$cat->name";
    }
    echo "</select></td></tr>\n";

    echo "<tr><td>Sub Category:</td><td><select name=category4>";
    if(!empty($news->category4)) echo "<option>$news->category4";
    echo "<option>none";
    $res=dm_query("select * from `categories` order by `name` asc");
    $ncats=mysql_num_rows($res);    
    for($i=0;$i<$ncats;$i++)
    {
        $cat=mysql_fetch_object($res);
        echo "<option>$cat->name";
    }
    echo "</select></td></tr>\n";                         */

    echo "<tr><td>&nbsp; </td><td><input type=\"submit\" value=\"Update News\" class=b4button></td></tr>\n";
    echo "</form></table>\n";
    
}

function shownews()
{
  //?echo "<h1>Latest News</h1>";
  
      $data=$GLOBALS['data'];

      if($data->access=="255")  echo "[<a href=news.php?showform=yes>Add News</a>] <br>";
    echo "<table border=0 cellspacing=0 cellpadding=1 bgcolor=#000000 width=100%><tr><td>";
    echo "<table border=0 width=100% ><tr>";
    echo "<td valign=top class=td_cat>";

    include("dm_time.php");
    $locate=$GLOBALS["locate"];
	$month_name=$GLOBALS['month_name'];
	$day_name=$GLOBALS['day_name'];

    if($GLOBALS['action']=="catsrch")
    {
        $derr=$cat_desc[$GLOBALS['crit']];
        echo "<p>Category [$derr] search...</p>";
        $t=$GLOBALS['crit']; $kt=sprintf("%03d|",$t);
        $newssearch="and categories like '%$kt%'";
    }
    if($GLOBALS['action']=="search")
    {
        $t=$GLOBALS['crit'];
        $newssearch="and message like '%$t%' or headline like '%$t%'";
    }

    if(empty($GLOBALS['top'])) $GLOBALS['top']=0;
    if(empty($GLOBALS['bot'])) $GLOBALS['bot']=1500;
    $newslist=dm_getnewslist($newssearch);

    // search method dictate sort order?

    echo "<table border=0 width=100% align=left>";

    //if($data->access==255) echo "<tr><td><font class=dm_admin>Views</td></tr>";

    $f=1;
    for($i=0;$i<count($newslist);$i++)
    {    
         $f++;
         if($f>4) $f=1;
        $news=dm_getnewsdata($newslist[$i]);
        echo "<tr>";
        echo "<td valign=top>" ;//width=500>";



        rpg_newsbordertop(" ","news");
        echo "<table width=100% border=0><tr><td>";
        echo "<center><font class=dm_newshead>$news->headline";		
        echo "</td></tr><tr><td>";
		echo "<hr>";
        
        echo "<font class=dm_news align=right>".b4time($news->time)."</font><br><br>";
		echo "<font class=dm_news>";
        echo nl2br(smiles($news->message));
        echo "</font>";
        echo "</td></tr>";
        if($data->access==255)
            {
            echo "<tr><td>[<a href=\"$locate/news.php?action=ed&nid=$news->id\">edit</a>]\n";
                    echo "[<a href=\"$locate/news.php?action=de&nid=$news->id\">remove</a>]\n";
                    echo "</td></tr>";
                        }
                    echo "</table>";
        rpg_newsborderbot("news");


        echo "</td></tr>";
        
    }
    echo "</table>";
    echo "<br>";


    echo "</td></tr></table>";
    echo "</td></tr></table>";   
}

function shownewsarticle($nid,$gt)
{
    $locate=$GLOBALS['locate'];
    $dm_table_top_mid_1=$GLOBALS['dm_table_top_mid_1'];
    $dm_table_bot_mid_1=$GLOBALS['dm_table_bot_mid_1'];
    $news=dm_getnewsdata($nid);    
    $userdata=dm_getuserdata($news->submitter);
    $thisemail=str_replace("@"," at ",$userdata->email);
    $thisemail=str_replace(".","  dot ",$userdata->email);
    echo "\n\n<news top ************************************************************************ news top>\n";
    echo "<table border=0 width=100%><tr><td>";
    echo "<p>&nbsp;</p><h1>$news->headline</h1>";
    echo "<i>Posted by <a href=\"$locate/rpg_profile.php?id=$userdata->id\">$userdata->rpg_name</a> on ".b4time($news->time)."</i>";
    echo "<table border=0 width=100%><tr><td valign=top>";
    if(!empty($news->image_url))
    {
        echo "<table border=0 bgcolor=#000000 cellpadding=1 cellspacing=0><tr><td>";
        $altern=stripslashes($news->image_alt); 
        if(!empty($news->image_link))
        {
            echo "<a href=\"$news->image_link\" target=\"_blank\">";
        }
        echo "<img src=\"$news->image_url\" border=\"0\" title=\"$altern\" alt=\"$altern\" align=\"center\" width=\"150\" height=\"150\">\n";
        if(!empty($news->image_link))
        {
            echo "</a>\n";
        }
        echo "</td></tr></table>";
    }
    echo "</td><td>";
    $message=smiles(stripslashes($news->message));
	if($GLOBALS['action']=="search")
	{	$crit=$GLOBALS['crit'];
		$critr="<font class=dm_warning>$crit</font>";
		$message=str_replace($crit,$critr,$message);
	}
    echo "$message<br>\n";
    echo "<table border=0 align=right>";
	echo "<tr><td align=right></td></tr><tr><td></td></tr></table></td></tr></table></td></tr><tr><td align=right>";
 //    dm_useravatar($userdata->name);
    echo "</td></tr></table><table border=0 cellspacing=0 cellpadding=2><tr><td>&nbsp;</td><td>&nbsp;</td>";
    //echo dm_getcommentstats($news->headline,"news",$nid);
    $data=$GLOBALS['data'];
    if(($data->name==$userdata->name)||($data->access==255))
    {
        echo "[<a href=\"$locate/news.php?action=ed&nid=$nid\">edit</a>]\n";
        echo "[<a href=\"$locate/news.php?action=de&nid=$nid\">remove</a>]\n";
    }
    echo "<br><news bot ************************************************************************ news bot>\n";
    $news->views=$news->views+1;
    dm_query("update news set views ='$news->views' where id='$nid'");
}

if($showform=="yes")
{
    if($data->reporter!="yes")
    {
        echo smiles("<p>:X</p><p>You can not edit or submit news!</p>");
    }
    else
    {
        echo "<h1>Submit News</h1>";
        echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"> \n";
        echo "<br><form method=POST action=\"news.php\">\n";
        echo "<input type=hidden name=action value=createnewsgo>";
        echo "<tr><td>Headline:</td><td><input type=\"text\" name=\"title\" size=\"100\"></td></tr>\n";
        echo "<tr><td></td><td><input type=\"submit\" value=\"Add News\" class=b4button></td></tr>\n";
        echo "</table></form><br>\n";  
    }
    include("rpg_footer.php");
    exit();
}

if($action == "modifycategory")
{
    if(empty($image)) $image="$locate/images/news/test.jpg";
    if(!empty($cname)) dm_query("update `categories` set `name`='$cname' where `id`='$id'");
    dm_query("update `categories` set `image`='$image' where `id`='$id'");
    $action="editcategories";
}

if($action == "addcategory")
{
    if(empty($image)) $image="$locate/images/news/test.jpg";
    dm_query("insert into `categories` (`name`,`image`) VALUES ('$cname','$image');");
    $action="editcategories";
}

if($action == "deletecategory")
{
    dm_query("delete from `categories` where `id`='$id'");
    $action="editcategories";
}

if($action == "editcategories")
{
    if($data->access!=255)
    {
        echo smiles("<p>:X</p><p>You can not edit news categories!</p>");
    }
    else
    {
        echo "<h1>Edit News Categories</h1>";
        $res=dm_query("select * from `categories` order by `name` asc");
        // id, name, image
        $numcats=mysql_num_rows($res);
        echo "<table border=0>";
        echo "<tr><td>Name</td><td>Image</td><td></td><td></td></tr>";
        for($i=0;$i<$numcats;$i++)
        {
            $cat=mysql_fetch_object($res);
            echo "<form action=news.php enctype=\"multipart/form-data\" method=post><tr><td>";
            echo "<input type=hidden name=action value=modifycategory><input type=hidden name=\"id\" value=\"$cat->id\">";
            echo "<input name=cname value=\"$cat->name\"></td><td>";
            
            echo "<input type=hidden name=give_file value=news_cat_mod>\n";
            echo "<input type=hidden name=hidden value=yes>\n";
            echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"99900000\">";
            echo "<input name=\"userfile\" type=\"file\">\n";
            echo "</td>";
            echo "<td><img src=\"$cat->image\" width=100 height=24><br>$cat->image</td>";
            echo "<td><input type=submit name=modify value=modify></form></td><td><form action=news.php method=post>";
            echo "<input type=hidden name=action value=deletecategory><input type=hidden name=id value=\"$cat->id\">";
            echo "<input type=submit name=delete value=delete></form></td></tr>";
        }
        echo "<form action=news.php enctype=\"multipart/form-data\" method=post><tr><td><input type=hidden name=action value=addcategory>";
        echo "<input name=cname value=\"\"></td><td>";

        echo "<input type=hidden name=give_file value=news_cat_add>\n";
        echo "<input type=hidden name=hidden value=yes>\n";
        echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"99900000\">";
        echo "<input name=\"userfile\" type=\"file\">\n";

        // echo "<input name=image value=\"\">";

        echo "</td>";
        echo "<td><input type=submit name=add value=add></td><td></td></tr></form>";
        echo "</table>";



        
    }
    include("rpg_footer.php");
    exit();
}

if($action == "createnewsgo")
{
    $time=date("Y-m-d H:i:s");
    $result=dm_query("INSERT INTO `news` (`headline`, `submitter`,`time`, `published`) 
                                  VALUES ('$headline','$data->id','$time','no');");
    echo "<p>News headline entered into database... The story is unpublished.</p>";
    $result=dm_query("select * from news where `headline`='$headline' and `submitter`='$data->id'");
    $news=mysql_fetch_object($result);
    $nid=$news->id;
    $action="ed";
}

if($action=="publish")
{
    echo "Publishing news article $nid";
    dm_query("update `news` set `published`='yes' where `id`='$nid'");
    $action="edityournews";
}

if($action=="unpublish")
{
    echo "Unpublishing news article $nid";
    dm_query("update `news` set `published`='no' where `id`='$nid'");
    $action="edityournews";
}

if($action=="edc")
{
    dm_showeditcommentform("news",$nid,$cid);
    include("rpg_footer.php");
    exit();  
}

if(($action=="decgo")&&
   ($submit=="Fuck Yeah!"))
{
    dm_deletecommentgo($nid,$cid);
    include("rpg_footer.php");
    exit();  
}

if($action=="dec")
{
    dm_showdeletecommentform($nid,$cid);
    include("rpg_footer.php");
    exit();  
}

if(($action=="view") ||
  ($action=="ad"))      
{

    echo "<table border=0 cellspacing=0 cellpadding=1 bgcolor=#000000 width=100%><tr><td>";
    echo "<table border=0 width=100% ><tr>";
    echo "<td valign=top class=td_cat>";

    shownewsarticle($nid,0);
//    dm_showcomments("news",$nid);
    echo "<br>\n";
//    dm_showaddcommentform($headline,"news",$nid);

//    echo "<p align=right><a href=news.php  class=\"a_cat\" align=right>More news stories...</a></p>";

    echo "</td></tr></table>";
    echo "</td></tr></table>";




    echo "<br>";

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
   /*
    echo "<table border=0 cellspacing=0 cellpadding=1 bgcolor=#000000 width=100%><tr><td>";

    echo "<table border=0 width=100% ><tr>";
    echo "<td valign=top class=td_cat>";

    echo "<h1>Latest news</h1>";
    //search method dictate sort order?
    $newslist=dm_getnewslist($newssearch);
    echo "<table border=0>";
    $ct=count($newslist);
    if($ct>5) $ct=5;
    for($i=0;$i<$ct;$i++)
    {    
        echo "<tr><td>";
        echo "<table border=0 bgcolor=#000000 cellpadding=1 cellspacing=0><tr><td>";
        $news=dm_getnewsdata($newslist[$i]);   
        if(empty($news->image_url)) $news->image_url="images/noimage.gif";
        $altern=stripslashes($news->image_alt);
        echo "<a href=\"$locate/news.php?action=view&nid=$news->id\"><img src=\"$news->image_url\" border=\"0\" title=\"$altern\" alt=\"$altern\" width=30 height=30></a>\n";
        echo "</td></tr></table>";
        echo "</td><td valign=top>";
        echo "<a href=\"$locate/news.php?action=view&nid=$news->id\" class=\"a_cat\">".dm_trunc("$news->headline",50)."</a><br>";
        $ntext=str_replace("<br>"," ",stripslashes(dm_trunc("$news->message",70)));
        $ntext=str_replace("<p>"," ",$ntext);
        $ntext=str_replace("</p>"," ",$ntext);
        echo "<font class=dm_black>$ntext</font>";
        echo "</td></tr>";
    }
    echo "</table>";

    echo "<h1>Popular</h1>";
    //search method dictate sort order?
    $result=dm_query("select * from news where topstory!='yes' and published='yes' order by views desc limit 5");
    echo "<table border=0>";
    $ct=mysql_num_rows($result);
    for($i=0;$i<$ct;$i++)
    {    
        $news=mysql_fetch_object($result);
        echo "<tr><td>";
        echo "<table border=0 bgcolor=#000000 cellpadding=1 cellspacing=0><tr><td>";
        if(empty($news->image_url)) $news->image_url="images/noimage.gif";
        $altern=stripslashes($news->image_alt);
        echo "<a href=\"$locate/news.php?action=view&nid=$news->id\"><img src=\"$news->image_url\" border=\"0\" title=\"$altern\" alt=\"$altern\" width=30 height=30></a>\n";
        echo "</td></tr></table>";
        echo "</td><td valign=top>";
        echo "<a href=\"$locate/news.php?action=view&nid=$news->id\" class=\"a_cat\">".dm_trunc("$news->headline",50)."</a><br>";
        $ntext=str_replace("<br>"," ",stripslashes(dm_trunc("$news->message",70)));
        $ntext=str_replace("<p>"," ",$ntext);
        $ntext=str_replace("</p>"," ",$ntext);
        echo "<font class=dm_black>$ntext</font>";
        echo "</td></tr>";
    }
    echo "</table>";

    echo "<p align=right><a href=news.php  class=\"a_cat\" align=right>More news stories...</a></p>";
    echo "</td></tr></table>";

    echo "</td></tr></table>";
                  */
    include("rpg_footer.php");
    exit();  
}

if($action=="edcgo")
{
    if(($userid=="invalid_user")||
       ($anon=="yes"))
    {
//        dm_updatecommentgo($cid,$headline,$posttext,999);
    }
    else
    {
//        dm_updatecommentgo($cid,$headline,$posttext,$data->id);
    }
    include("rpg_footer.php");
    exit();  
}

if($action=="de")
{
    deletenews($nid); 
    $action="edityournews";
}

if(($action=="dego") &&
   ($data->access==255))
{
    deletenewsgo($nid);
    $action="edityournews";
}

if($action=="ed")
{
    editnews($nid);
    include("rpg_footer.php");
    exit(); 
}

if(($action=="edgo") &&
   ($data->access==255))
{
    updatenews($nid);
    editnews($nid);
    include("rpg_footer.php");
    exit(); 
}

if($action=="edityournews")
{
    echo "<p>Editing your news stories</p>";

    echo "<p>Unpublished:</p>";
    echo "<p align=left>";
    $res=dm_query("select * from news where submitter='$data->id' and published='no' order by time desc");
    $count=mysql_num_rows($res);
    for($i=0;$i<$count;$i++)
    {
        $news=mysql_fetch_object($res);
        echo "[<a href=news.php?action=de&nid=$news->id>Delete</a>] ";
        echo "[<a href=news.php?action=ed&nid=$news->id>Edit</a>] ";
        echo "[<a href=news.php?action=publish&nid=$news->id>Publish</a>] ";
        echo "<a href=\"news.php?action=view&nid=$news->id\">link: $news->headline</a><br>";
    }
    echo "</p>";

    echo "<p>Published:</p>";

    echo "<p align=left>";
    $res=dm_query("select * from news where submitter='$data->id' and published='yes' order by time desc");
    $count=mysql_num_rows($res);    
    for($i=0;$i<$count;$i++)
    {
        $news=mysql_fetch_object($res);
        echo "[<a href=news.php?action=de&nid=$news->id>Delete</a>] ";
        echo "[<a href=news.php?action=ed&nid=$news->id>Edit</a>] ";
        echo "[<a href=news.php?action=unpublish&nid=$news->id>Unpublish</a>] ";
        echo "<a href=\"news.php?action=view&nid=$news->id\">link: $news->headline</a><br>";
    }
    echo "</p>";


    echo "<p>Other people's news stories:</p>";

    echo "<p>Unpublished:</p>";
    echo "<p align=left>";
    $res=dm_query("select * from news where submitter!='$data->id' and published='no' order by time desc");
    
    $count=mysql_num_rows($res);
    for($i=0;$i<$count;$i++)
    {
        $news=mysql_fetch_object($res);
        $userdata=getuserdata($news->submitter);
        echo "[<a href=news.php?action=de&nid=$news->id>Delete</a>] ";
        echo "[<a href=news.php?action=ed&nid=$news->id>Edit</a>] ";
        echo "[<a href=news.php?action=publish&nid=$news->id>Publish</a>] ";
        echo "<a href=\"news.php?action=view&nid=$news->id\">link: $news->headline</a> ($userdata->name)<br>";
    }
    echo "</p>";

    echo "<p>Published:</p>";

    echo "<p align=left>";
    $res=dm_query("select * from news where submitter!='$data->id' and published='yes' order by time desc");
    $count=mysql_num_rows($res);    
    for($i=0;$i<$count;$i++)
    {
        $news=mysql_fetch_object($res);
        $userdata=getuserdata($news->submitter);
        echo "[<a href=news.php?action=de&nid=$news->id>Delete</a>] ";
        echo "[<a href=news.php?action=ed&nid=$news->id>Edit</a>] ";
        echo "[<a href=news.php?action=unpublish&nid=$news->id>Unpublish</a>] ";
        echo "<a href=\"news.php?action=view&nid=$news->id\">link: $news->headline</a> ($userdata->name)<br>";
    }
    echo "</p>";
    include("rpg_footer.php");
    exit();
}

shownews();

include("rpg_footer.php");
?>
