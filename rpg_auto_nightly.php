<?
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////

include("rpg_header.php");

//////////////////////////////////////////////////////////////////////////////////
// Reset everyone's AP

$res=dm_query("select * from users");
$nusers=mysql_num_rows($res);
for($i=0;$i<$nusers;$i++)
{
	$user=mysql_fetch_object($res);
	$user->rpg_ap+=50;
	if($user->rpg_ap>200) $user->rpg_ap=200;
	//if($user->access=="255") $user->rpg_ap=20000;
	dm_query("update users set `rpg_ap`='$user->rpg_ap' where `id`='$user->id'");
	echo "$user->name ($user->rpg_name) given AP<br>";

}

include("rpg_footer.php");
?>
