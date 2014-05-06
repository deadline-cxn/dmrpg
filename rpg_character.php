<?
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////


include("rpg_header.php");
$data=getuserdata($HTTP_SESSION_VARS['valid_user']);


if($HTTP_SESSION_VARS["logged_in"]!="true")
{
  	rpg_refresh("top","index.php");
    include("rpg_footer.php"); exit();
}


if($data->rpg=="yes")
{

	//////////////////////////////////////////////////////////////////////////////////

	rpg_bordertop("",5);

	//echo "<p><center>\n";

	//////////////////////////////////////////////////////////////////////////////////

	echo "<table class=td_base width=180>\n";
	
	$result=dm_query("select * from rpg_classes where id=$data->rpg_class");
	$class=mysql_fetch_object($result);

	echo "<tr><td>".imgn("images/$class->image",$class->name)."</td></tr> ";

	echo "<tr><td>".stripslashes($data->rpg_name)."</td></tr>\n";
	echo "<tr><td>$class->name</td></tr>\n";

	echo "<tr><td>Alignment</td><td>[$class->alignment]</td></tr> ";
	echo "<tr><td>Level</td><td>[$data->rpg_level]</td></tr> ";
	echo "<tr><td>Exp</td><td>[$data->rpg_exp/";
	echo rpg_exptolevel($data->rpg_level);
	echo "]</td></tr>\n";
	echo "<tr><td>Total XP</td><td>[$data->rpg_totalexp]</td></tr>\n";
	echo "<tr><td>";
	echo imgn("images/item_cash.gif","Cash");
	echo "</td><td> ";
	echo rpg_money_format($data->rpg_cash);	
	echo "</td></tr>\n";
	echo "</table>\n";
	
	//echo "<p>&nbsp;</p>\n";

	echo "<table class=td_base width=180>\n";

	$hpm=$data->rpg_hpmax;
	$hp =$data->rpg_hp;

	// add in the item and effect bonuses here

	$hpm=$hpm+rpg_getmodified("hp");

	echo "<tr><td>Will To Live  [$hp / $hpm";
	if($hpm!=$data->rpg_hpmax) echo " ($data->rpg_hpmax)";
	echo "]</td></tr> ";
	
	$bar=rpg_bar($hp,$hpm,170);

	$powm=$data->rpg_powmax;
	$pow =$data->rpg_pow;

	// add in the item and effect bonuses here

	$powm=$powm+rpg_getmodified("pow");

	echo "<tr><td bgcolor>$bar</td></tr> ";
	echo "<tr><td>Motivation [$pow / $powm";
	if($powm!=$data->rpg_powmax) echo " ($data->rpg_powmax)";
	echo "]</td></tr> ";
	
	$bar=rpg_bar($pow,$powm,170);

	echo "<tr><td bgcolor>$bar</td></tr> ";

	// add in the item and effect bonuses here

	echo "</table>";
	
	echo "<table class=td_base width=180>\n";

	$str=$data->rpg_str;
	$int=$data->rpg_int;
	$agl=$data->rpg_agl;
	$def=$data->rpg_def;

	$str=$str+rpg_getmodified("str");
	$color="";
	if($str>$data->rpg_str) $color="dm_green";
	if($str<$data->rpg_str) $color="dm_red";
	echo "<tr><td class=$color>Intimidation [$str]";
	if($str!=$data->rpg_str) echo "<font color=#ff9900> ($data->rpg_str)";
	echo "</td></tr> ";

	$int=$int+rpg_getmodified("int");
	$color="";
	if($int>$data->rpg_int) $color="dm_green";
	if($int<$data->rpg_int) $color="dm_red";
	echo "<tr><td class=$color>Syllogism [$int]";
	if($int!=$data->rpg_int) echo "<font color=#ff9900> ($data->rpg_int)";
	echo "</td></tr> ";

	$agl=$agl+rpg_getmodified("agl");
	$color="";
	if($agl>$data->rpg_agl) $color="dm_green";
	if($agl<$data->rpg_agl) $color="dm_red";
	echo "<tr><td class=$color>Non-Fatness [$agl]";
	if($agl!=$data->rpg_agl) echo "<font color=#ff9900> ($data->rpg_agl)";
	echo "</td></tr> ";


	$def=$def+rpg_getmodified("def");
	$color="";
	if($def>$data->rpg_def) $color="dm_green";
	if($def<$data->rpg_def) $color="dm_red";
	echo "<tr><td class=$color>Callousness [$def]";
	if($def!=$data->rpg_def) echo "<font color=#ff9900> ($data->rpg_def)";
	echo "</td></tr> ";


	echo "<tr><td>AP [$data->rpg_ap]</td></td><td></tr>\n";

	echo "</table>\n";


	//////////////////////////////////////////////////////////////////////////////////

	echo "</center></p>\n";

	$lact=rpg_getmapobj($data->rpg_lastaction);
	if(!empty($lact))
	{
 	$lactlink="<a href=rpg_main.php?action=seek&loc=$data->rpg_lastaction target=mainpane>".stripslashes($lact->name)."</a>";
	echo "<hr><br>Last adventure:<br>$lactlink<br><br>";
 }

	$urresult=dm_query("select * from `pmsg` where `to` = '$data->rpg_name' and `read` = 'no'");
	$numunread=mysql_num_rows($urresult); if(empty($numunread)) $numunread=0;
	if($numunread>0) echo "<hr><table border=0><tr><td><a href=pmsg.php target=mainpane>You have unread mail</a></td><td><a href=pmsg.php target=mainpane><img src=images/mail.gif border=0></a></td></tr></table>";

	rpg_borderbot(5);
	
	
	if(!empty($data->rpg_craft))
	{
      if($data->rpg_craft!="0")
      {
        $crft=rpg_getcraftobj($data->rpg_craft);
        echo "<table border=0><tr><td>";

        echo "<a href=rpg_craft.php target=mainpane>$crft->name<br><img src=images/$crft->image border=0></a></td></tr></table>";
      }
    }















}
else
{
	echo "<p><center>You must create a character!</center></p>\n";

}

include("rpg_footer.php");


?>

