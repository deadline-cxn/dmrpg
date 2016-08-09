<?php

$title="Administration";
include("rpg_header.php");

$data=getuserdata($_SESSION['valid_user']);

if(empty($data->name))
{
    echo "<p><center>%X<br>You can not use admin if you're not \n";
    echo "<a href=\"$locate/login.php\">logged in</a>!</p>\n";
    include("rpg_footer.php");
    exit;
}

if($data->access==255)
{

//echo "[<a href=\"$locate/adm_smiles.php\">Auto-SmileyCon (tm) Configurator</a>] ";
echo "[<a href=\"$locate/adm.php?action=viewlog\">View Log</a>] ";
echo "[<a href=\"$locate/adm.php?action=rotatelog\">Rotate Log</a>] ";

//echo "[<a href=\"$locate/linkbin.php?action=editlinkbin\">Linkbin</a>] ";
//echo "[<a href=\"$locate/adm.php?action=linkfriends\">Link Friends Admin</a>] ";

	if($action=="rsseditgoedit")
	{
		if($update=="update") dm_query("UPDATE rss_feeds SET `feed`='$edfeed' where `id`='$oid'");
		if($delete=="delete") dm_query("DELETE FROM rss_feeds WHERE id = '$oid' ");
		$action="rssedit";
	}
	if($action=="rsseditgoadd")
	{
          dm_query("insert into rss_feeds values('$edfeed',0);");
          $action="rssedit";
	}

	if($action=="rssedit")
	{
          $result=dm_query("select * from rss_feeds");
          $num_feeds=mysql_num_rows($result);
          echo "<hr><p><h1>Editing RSS Feeds </h1></p><hr>";
          
          for($i=0;$i<$num_feeds;$i++)
          {
            echo "<table border=0 cellspacing=0 cellpadding=0>\n";
            echo "<form action=adm.php method=post>\n";
            echo "<input type=hidden name=action value=rsseditgoedit>\n";
            $feed=mysql_fetch_object($result);
            echo "<tr><td>Feed URL</td> <td><input type=textbox name=edfeed value=\"$feed->feed\" size=100></td>\n";
            echo "<td><input type=submit value=delete name=delete></td>\n";
            echo "<td><input type=submit value=update name=update> <input type=hidden value=$feed->id name=oid></td>\n";
            echo "</tr>\n";
            echo "</form></table>\n";
          }
        echo "<table border=0 cellspacing=0 cellpadding=0>\n";
        echo "<form action=adm.php method=post>\n";
        echo "<input type=hidden name=action value=rsseditgoadd>\n";
 	echo "<tr><td>New Feed</td><td><input type=textbox name=edfeed value=\"\" size=100></td>\n";
 	echo "<td><input type=submit value=add name=add></td>\n";
        echo "</form></table>\n";
    }
    
    if($action=="rotatelog")
    {
      $t=time();
      system("mv log/log.htm log/log_$t.htm");
      system("cp log/blanklog.htm log/log.htm");
      $action="viewlog";
    }

     if($action=="viewlog")
    {
        echo "<table width=100%><tr><td><br>\n";
        echo "<br><br>\n";//<pre class=dm_locater>\n";
        include("log/log.htm");
        echo "<br>\n";//</pre>\n";
        echo "<br></td></tr></table>\n";
    }
    

                
function listawards()

{

        $result=dm_query("select * from awards order by name asc");

        $num_awards=mysql_num_rows($result);

        if($num_awards)

        {

        	echo "<p>(Hint: Upload image files to the images/awards/ folder)</p>\n";



        	echo "<table width=100% border=0>\n";

        	echo "<tr bgcolor=$forum_header><td>Name</td><td>Description</td><td>Image URL</td><td>Image</td><td>&nbsp</td></tr>\n";



        	for($i=0;$i<$num_awards;$i++)

        	{

        		$award=mysql_fetch_object($result);

        		echo "<form action=adm.php method=post>\n";

        		echo "<tr>\n";

                echo "<td><input type=text name=name value=\"$award->name\"></td>\n";

        		echo "<td><textarea name=description rows=1 cols=50>".stripslashes($award->description)."</textarea></td>\n";



                echo "<td>\n";

                echo "<select name=image>\n";

                echo "<option>$award->image";

                $dir_count=0; $dirfiles = array();

                $handle=@opendir("./images/awards/");

                while (false!==($file = readdir($handle))) array_push($dirfiles,$file);

                closedir($handle); reset($dirfiles);

                while(list ($key, $file) = each ($dirfiles))

                {

                    if($file!=".")

                        if($file!="..")

                        {

                            $xt = explode(".",$file,40);

                            $j = count($xt)-1;

                            $ext = "$xt[$j]";

                            if($ext=="gif") echo "<option>images/awards/$file";

                            if($ext=="jpg") echo "<option>images/awards/$file";

                        }

                }

                echo "</select>\n";                



                // echo "<input type=text name=image value=\"$award->image\">\n";



                echo "</td>\n";





        		echo "<td><img src=\"$award->image\" alt=\"$award->description\" title=\"$award->description\" border=0></td>\n";







        		echo "<td><input type=hidden name=action value=editawardgo>\n";

        		echo "<input type=hidden name=id value=\"$award->id\">\n";

        		echo "<input type=submit name=submit value=Modify!></td>\n";

        		echo "</tr></form>\n";



            }

            echo "</table>\n";

        }

        else

        {

        	echo "<p>There are no awards defined!</p>\n";

        }



       // id

       // name

       // description

       // image

       // time



       echo "<table border=0 width=100%><form action=adm.php method=post>\n";

       echo "<input type=hidden name=action value=addawardgo>\n";

       echo "<tr><td align=right>(Add New Award) Name:</td>               <td><input type=text name=name></td>\n";

       echo "<td align=right>Description:</td>         <td><textarea name=description></textarea></td>\n";

       echo "<td align=right>Image URL:</td>\n";

        echo "<td>\n";

        echo "<select name=image>\n";

        echo "<option>$award->image";

        $dir_count=0; $dirfiles = array();

        $handle=@opendir("./images/awards/");

        while (false!==($file = readdir($handle))) array_push($dirfiles,$file);

        closedir($handle); reset($dirfiles);

        while(list ($key, $file) = each ($dirfiles))

        {

        if($file!=".")

            if($file!="..")

            {

                $xt = explode(".",$file,40);

                $j = count($xt)-1;

                $ext = "$xt[$j]";

                if($ext=="gif") echo "<option>images/awards/$file";

                if($ext=="jpg") echo "<option>images/awards/$file";

            }

        }

        echo "</select>\n";

        echo "</td>\n";



       echo "<td align=right>&nbsp;</td>                     <td><input type=submit name=submit value=Add!></td></tr>\n";



       echo "</form></table>\n";



}

    if($action=="award_edit")

    {

        echo "<hr><p><h1>Award Editor</h1></p><hr>\n";

        listawards();





    }



    if($action=="addawardgo")
    {
    	echo "<hr><p><h1>Add award!</h1></p><hr>\n";
       // id, name, description, image, time
       $name=addslashes($name);
       $description=addslashes($description);
       $image=addslashes($image);
       $time=date("Y-m-d H:i:s");
       dm_query("insert into awards values('', '$name', '$description', '$image', '$time')");
       listawards();
    }

    if($action=="editawardgo")
    {
      echo "<hr><p><h1>Edit award!</h1></p><hr>\n";
       // id, name, description, image, time
       $name=addslashes($name);
       $description=addslashes($description);
       $image=addslashes($image);
       dm_query("update awards set name = '$name' where id = '$id'");
       dm_query("update awards set description = '$description' where id = '$id'");
       dm_query("update awards set image = '$image' where id = '$id'");
       listawards();
    }

    if($action=="modifyflinknow")
    {
    	if($deleteflink=="delete")
        {
            echo "<hr><p><h1>Deleting Link!</h1></p><hr>\n";
            dm_query("DELETE FROM link_friends where `id` = '$linkid' limit 1", $mysql);
            dm_log("*****> $data->name deleted a link from the linkbin [$short_name][$link]");
            $action="linkfriends";
        }

        if($renameflink=="modify")
        {
          echo "<hr><p><h1>Modifying Link!</h1></p><hr>\n";
          $short_name=addslashes($short_name);
          $link=addslashes($link);
       	  dm_query("update link_friends set `sname` = '$short_name' where `id` = '$linkid'");
          dm_query("update link_friends set `link` = '$link' where `id` = '$linkid'");
          $action="linkfriends";
        }
    }

    if($action=="addflink2bin")

    {

        echo "<hr><p><h1>Add a Friend Link!</h1></p><hr>\n";

        $time=date("Y-m-d H:i:s");

        dm_query("INSERT INTO link_friends VALUES ('', '".$_REQUEST['url']."', '".$data->id."', '".$time."', '".$_REQUEST['linksn']."', '', '' ,'', '');");

        dm_log("*****> $data->name added a link to link friends [".$_REQUEST['linksn']."]");

        $action="linkfriends";

    }

    if($action=="linkfriends")

    {

        echo "<hr><p><h1>Link Friends Edirator</h1></p><hr>\n";

        // list all the links here with edit or delete buttons...

        $result=dm_query("select * from link_friends order by time");

        $numlinks=mysql_num_rows($result);

        echo "<table width=90% border=0 cellspacing=0 cellpadding=0 align=center class=td_base>\n";

        echo "<tr><td>\n";

        echo "<table border=0 cellspacing=0 cellpadding=0>\n";

        for($i=0;$i<$numlinks;$i++)

        {

                echo "<form action=adm.php method=\"get\">\n";

                $link=mysql_fetch_object($result);

                echo "<tr class=td_base>\n";

                echo "<td><input type=submit name=deleteflink value=delete></td>\n";

                echo "<td class=td_base> $breadcrumb <input type=text name=short_name value=\"$link->sname\" size=15> $breadcrumb ";

                echo "<input type=text name=link value=\"$link->link\" size=30> </td>\n";

                echo "<td class=td_base>\n";

                echo " $breadcrumb <input type=submit name=renameflink value=modify></td>\n";

//$description

//$hidden

//$referrals

                echo "<input type=\"hidden\" name=\"action\" value=\"modifyflinknow\">\n";

                echo "<input type=\"hidden\" name=\"linkid\" value=\"$link->id\">\n";

                $userdata=dm_getuserdata($link->poster);

                echo "<td> $breadcrumb (submitted by $userdata->name on ".b4time($link->time).") &nbsp;</td>\n";

                echo "<td> $breadcrumb referrals [$link->referrals] &nbsp;</td>\n";

                echo "<td> $breadcrumb hidden [$link->hidden]</td>\n";

                echo "</tr>\n";

                echo "</form>\n";

        }

        echo "</table>\n";

        echo "</td></tr><tr><td>\n";

        echo "</td></tr></table>\n";

        // add a new link here...

        echo "<h2>For consistency please put all link short names in all lower case unless it is necessary, thanks management</h2>\n";

        echo "<table border=0 cellspacing=0 cellpadding=0>\n";

        echo "<form action=adm.php method=post>\n";

        echo "<input type=hidden name=action value=addflink2bin>\n";

        echo "<tr><td>URL        </td> <td><input type=textbox name=url value=\"\"></td></tr>\n";

        echo "<tr><td>Short name </td> <td><input type=textbox name=linksn value=\"\"></td></tr>\n";

        echo "<tr><td><input type=submit value=Go! name=Go!></td><td>&nbsp;</td></tr>\n";

        echo "</form></table>\n";

    }

    echo "</td></tr></table>\n";

}

else

{

	echo smiles("<p class=dm_warning><center>%X<br>WARNING:<br>You do not have access to admin area...</center></p>\n");

    dm_log("*****> $data->name tried to access the admin area!");

}



//table_middle_end();

//table_bottom("&nbsp;");

include("rpg_footer.php");

?>





















ÿ