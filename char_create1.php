<?php
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////

include("rpg_header.php");

if($_SESSION["logged_in"]!="true")
{
  	rpg_refresh("top","index.php");
    include("rpg_footer.php");
	exit();
}

$data=getuserdata($_SESSION['valid_user']);

if($data->rpg=="yes")
{
	echo "<p>Sorry you can not go back and change your character, you will have to delete this one first.</p>\n";
	echo "<p><a href=delete_char.php>Delete Character</a></p>\n";
}
else
{
   flash("dmrpg_cc.swf",1024,768);
}


include("rpg_footer.php");
?>

