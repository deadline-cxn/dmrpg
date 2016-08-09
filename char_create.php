<?php
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////

include("char_create1.php");
/*

include("rpg_header.php");

if($HTTP_SESSION_VARS["logged_in"]!="true")
{
  	rpg_refresh("top","index.php");
    include("rpg_footer.php");
	exit();
}

$data=getuserdata($HTTP_SESSION_VARS['valid_user']);

if($data->rpg=="yes")
{
	echo "<p>Sorry you can not go back and change your character, you will have to delete this one first.</p>\n";
	echo "<p><a href=delete_char.php>Delete Character</a></p>\n";
}
else
{

echo "<img src=images/band_small.jpg><br>";
echo "[<a href=logout.php>logout</a>]  [<a href=char_create1.php>test flash</a>]<br>";

  if(empty($action))
   {
	//echo "<p>Create a rpg character:</p>\n";
	//echo "<p>Select from the following which class you want to play:</P>\n";

	echo "<table class=td_base>";

	echo "<tr><td width=200>The alignment of Sane</td><td width=200>The alignment of Narcissistic</td></tr>\n";

	$goodresult=dm_query("select * from rpg_classes where alignment='Good'");
	$goodclasses=mysql_num_rows($goodresult);
	$result=dm_query("select * from rpg_classes where alignment='Evil'");
	$classes=mysql_num_rows($result);
	for($i=0;$i<$goodclasses;$i++)
	{
		$goodclass=mysql_fetch_object($goodresult);
		$class=mysql_fetch_object($result);
		echo "<tr><td>";
		echo "<a href=\"char_create.php?action=char2&class=$goodclass->name\">";
                echo "<img src=\"images/$goodclass->image\" alt=\"$goodclass->info\" title=\"$goodclass->info\">";
                echo " $goodclass->name</a>";
		echo "</td><td>";
		echo "<a href=\"char_create.php?action=char2&class=$class->name\">";
                echo "<img src=\"images/$class->image\" alt=\"$class->info\" title=\"$class->info\">";
                echo " $class->name</a></td></tr>\n";
	}
	echo "</table>";
      }
      if($action=="char2")
      {
	$result=dm_query("select * from rpg_classes where name='$class'");
	$class=mysql_fetch_object($result);
	//echo "<p>Create a rpg character:</p>\n";
	//echo "<p>Excellent you have chosen [$class->name].</p><p>If that's not correct, 
	echo "<br><a href=char_create.php>go back</a><br>\n";

	echo "<p><img src=\"images/$class->image\"><br>$class->name</p>\n";

        //echo "<p><h1>Enter your character's name to continue: </h1></p>";
        echo "<table border=0 cellspacing=0 cellpadding=0>\n";
        echo "<form action=char_create.php method=post>\n";
        echo "<input type=hidden name=action value=char3>\n";
        echo "<tr><td>Name</td> <td><input type=textbox name=charname value=\"\" size=100></td>\n";
	echo "<td><input type=submit value=\"Create\" name=\"Create\">\n";
	echo "<input type=hidden value=\"$class->name\" name=class></td>\n";
	echo "</tr>\n";
	echo "</form></table>\n";
      }
      
      if($action=="char3")
      {

	$result=dm_query("select * from rpg_classes where name='$class'");
	$class=mysql_fetch_object($result);
	echo "<p>Excellent you have chosen [$class->name] and named it [$charname].</p>\n";
	echo "<p><img src=\"images/$class->image\"></p>\n";

	echo "<p><a href=char_create.php>Click here</a> to start over.</p>\n";
	echo "<p><a href=\"char_create.php?action=char4&class=$class->id&charname=$charname\">";
        echo "Click here</a> to confirm this and create the character.</p>\n";
      }
      
      if($action=="char4")
      {


    rpg_deletechar();
    rpg_createchar($charname,$class);
  
	echo "<p>Character created:</p>\n";
	echo "<p>Excellent you have chosen [$class->name] and named it [$charname].</p>\n";
	echo "<p><img src=\"images/$class->image\"></p>\n";

	echo "<p><a href=index.php target=_top>Click Here to continue</a></p>\n";
	rpg_reload();
      }

}


include("rpg_footer.php");
*/
?>

