<?php
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////

include("rpg_header.php");
$data=getuserdata($_SESSION['valid_user']);

if($_SESSION["logged_in"]!="true")
{
  	rpg_refresh("top","index.php");
    include("rpg_footer.php"); exit();
}

echo "<h1>Rankings</h1>";

echo "<table border=0>";

$result=dm_query("select * from `users` where rpg='yes' order by `rpg_level` desc, rpg_totalexp desc");

if($action=="sortlevelasc") $result=dm_query("select * from users where rpg='yes' order by rpg_level asc, rpg_totalexp asc");
if($action=="sortcashdesc") $result=dm_query("select * from users where rpg='yes' order by rpg_cash desc");
if($action=="sortcashasc")  $result=dm_query("select * from users where rpg='yes' order by rpg_cash asc");

$num=mysql_num_rows($result);

echo "<tr><td></td><td> </td><td> </td><td> weapon </td><td> ";
if($action=="sortlevelasc") echo "[<a href=rpg_rank.php?action=sortleveldesc>";
else	                    echo "[<a href=rpg_rank.php?action=sortlevelasc>";
echo "level</a>]</td><td> exp </td><td> total exp </td>";

echo "<td> ";
if($action=="sortcashdesc") echo "[<a href=rpg_rank.php?action=sortcashasc>";
else                        echo "[<a href=rpg_rank.php?action=sortcashdesc>";
echo "cash</a>] </td> ";

echo "<td>PvP Won / Lost</td>";

echo "</tr>";

for($x=0;$x<$num;$x++)
{
	$player=mysql_fetch_object($result);
	if( (empty($player->rpg_class)) || ($player->rpg_class==0))
    {
      rpg_setvaruser($player->id,"rpg_class",1);
      $player->rpg_class="1";
    }

	$fres=dm_query("select * from rpg_classes where id=$player->rpg_class");
	$class=mysql_fetch_object($fres);
	
	echo "<tr>";

	if($player->name==$data->name)
		echo "<td>  </td>";
	else
	{
		// add a check here to see if the person has already dueled this player today and not allow (or allow x amount of times)
		echo "<td> [<a href=rpg_arena.php?action=duel&id=$player->id>PvP duel (1 AP)</a>] </td>";
	}

	echo "<td><a href=\"rpg_profile.php?id=$player->id\"><img src=\"images/$class->image\" alt=\"$class->name\" title=\"$class->name\" border=0></a></td>";
	echo "<td><a href=\"rpg_profile.php?id=$player->id\">$player->rpg_name</a></td>";
	echo "<td>";
	$item=rpg_getlootobj($player->rpg_slot_mainhand);
	$item->name=stripslashes($item->name);
	// echo "$item->name ";
	echo "<a href=\"rpg_rightpane.php?action=info&id=$item->id\" target=right>";
	echo rpg_itemlink($item->id,"000000");
	//echo "<img src=\"images/$item->image\" alt=\"$item->description\" title=\"$item->description\" border=0></td>";
	echo "</a>\n";
	echo "</td>";
		
	echo "<td align=right>Level $player->rpg_level</td>";
	echo "<td align=right>$player->rpg_exp/".rpg_exptolevel($player->rpg_level)."</td>\n";
	echo "<td align=right>$player->rpg_totalexp</td>\n";

	echo "<td align=right>"; 
	echo rpg_money_format($player->rpg_cash);
	echo "</td>\n";
	
	echo "<td align=right> $player->rpg_pvp_won / $player->rpg_pvp_lost </td>";
	echo "</tr>\n";


}

echo "</table>\n";


include("rpg_footer.php");
?>