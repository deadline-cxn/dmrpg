<?

include("rpg_header.php");

$data=getuserdata($HTTP_SESSION_VARS['valid_user']);

if(empty($data->name))
{ 
    echo "<p>You can not use admin if you're not \n";
    echo "<a href=\"$locate/login.php\">logged in</a>!</p>\n";
    include("rpg_footer.php");
    exit;
}

if($data->access==255)
{
    $mysql=odb();
    $sto=stripslashes($sto);
    $sfrom=stripslashes($sfrom);
    $ofrom=stripslashes($ofrom);

    if(!empty($act))
    {
        if($act=="update")
        {
            $sto=addslashes($sto);
            $query="UPDATE `smilies` SET `sto`='$sto' where `sfrom`='$ofrom';";
            $result = mysql_query($query, $mysql);
            $query="UPDATE `smilies` SET `sfrom`='$sfrom' where `sfrom` = '$ofrom';";
            $result = mysql_query($query, $mysql);
        }

        if($act=="delete")
        {
            $sto=addslashes($sto);
            $query="delete from `smilies` where `sfrom` = '$sfrom' and `sto` = '$sto' limit 1;";
            $result = mysql_query($query, $mysql);
        }

        if($act=="new")
        {
            $sto=addslashes($sto);
            $query =  "INSERT INTO `smilies` VALUES ('$sfrom', '$sto');";
            $result = mysql_query($query, $mysql);
        }
    }

    echo "<table width=100% border=1 bordercolor=000000 cellspacing=0 cellpadding=0 class=\"dm_news\">\n";

    echo "<tr>\n";
    echo "<td bordercolor=#777777>\n";

    echo "<table width=100% border=0 cellspacing=0 cellpadding=2 >\n";

    echo "<tr>\n";

    $mysql=odb();
    $result = mysql_query("select * from smilies", $mysql);
    $num_smilies=mysql_num_rows($result);

    echo "<td>\n";

    echo "$num_smilies smilies";

    
    for($i=0;$i<$num_smilies;$i++)
    {
        $smiley = mysql_fetch_array($result);
        $sfrom=stripslashes($smiley['sfrom']);
        $sto=stripslashes($smiley['sto']);
       
        
        echo "<table border=0><tr>\n";
        echo "<form action=\"$locate/adm_smiles.php\">\n";
        echo "<td align=center width=24 valign=top>$sto</td><td valign=top>\n";
        //echo "<input type=hidden name=act value=upd>\n";
        echo "<input type=hidden name=ofrom value=\"$sfrom\">\n";
        echo "<input size=5 type=textbox name=sfrom value=\"$sfrom\"></td>\n";
        echo "<td valign=top><textarea name=sto cols=120>$sto</textarea></td>\n";
        echo "<td><select name=act><option>update<option>delete</select></td>\n";
        echo "<td valign=top><input type=image src=\"$locate/images/log-n.gif\" value=submit class=dm_select_pic alt=\"update smiley\">\n";
        echo "</form></td>\n";
        echo "</tr></table>\n";
    }

    
    echo "<table border=0><tr>\n";
    echo "<td align=center width=24 valign=top>Add";
    echo "<form action=\"$locate/adm_smiles.php\">\n";
    echo "<input type=hidden name=act value=new>\n";
    echo "</td>\n";
    echo "<td valign=top><input size=5 type=textbox name=sfrom></td>\n";
    echo "<td valign=top><textarea name=sto cols=120></textarea></td>\n";
    echo "<td valign=top><input type=image src=\"$locate/images/log-n.gif\" value=submit class=dm_select_pic alt=\"new smiley\"></form></td>\n";
    echo "</tr></table>\n";
        
    echo "</td>\n";

    echo "</tr>\n";

    echo "</table>\n";

    echo "</td></tr></table>\n";

}
else
{
  echo "<p class=dm_warning><center>WARNING:<br>You do not have access to admin area...</center></p>\n";
}


include("rpg_footer.php");
?>