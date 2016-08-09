<?php
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////

include("rpg_header.php");
$data=getuserdata($_SESSION['valid_user']);

$action = $_REQUEST['action'];
$id		= $_REQUEST['id'];

if($_SESSION["logged_in"]!="true") {
  	rpg_refresh("top","index.php");
    include("rpg_footer.php"); exit();
}

$data=getuserdata($_SESSION['valid_user']);

if($data->rpg=="yes")
{
    $result=dm_query("select * from rpg_inventory where `user`='$data->id'");
    $icount=mysql_num_rows($result);
	if($icount==0)
	{
		echo "<p>You have nothing in your inventory.</p>\n";
	}
	else
	{
        echo "<h1>Inventory</h1>";
		echo "<table class=td_base width=100%>\n";
		for ($i=0;$i<$icount;$i++)
		{
           $usetext="&nbsp;";
           $itema=mysql_fetch_object($result);
           $item=rpg_getitemobj($itema->id);

           $item->name=stripslashes($item->name);
           $item->description=stripslashes($item->description);

      		if($item->required_level<=$data->rpg_level)
      		{
      			if($item->useable=="1")
      			{
      				if(rpg_getactionobj($item->action)->action=="loottable")
      					$usetext="[<a href=\"rpg_main.php?action=use&item=$item->id\" target=mainpane>open</a>]";
      				else
      					$usetext="[<a href=\"rpg_main.php?action=use&item=$item->id\" target=mainpane>use</a>]";
      			}
      			if($item->wear_slot!="")
      					$usetext="[<a href=\"rpg_main.php?action=equip&item=$item->id\" target=mainpane>equip</a>]";
      		}

      		if($vendor=="yes")
      		{
                  if($item->quest=="yes") $item->sellable="no";
                  if($item->sellable!="no")
                  {
       			$usetext =  "[<a href=\"rpg_main.php?action=sell&item=$item->id&qty=1&loc=$loc\" target=mainpane>sell 1</a>] ".rpg_money_format($item->sell_value)."<br>";
      			$usetext .= "[<a href=\"rpg_main.php?action=sell&item=$item->id&loc=$loc&qty=$itema->quantity\" target=mainpane>sell all</a>]".rpg_money_format($item->sell_value*$itema->quantity);
     		  }
                  else
     		  {
                        $usetext = "<font color=#ff0000>(can't sell)";
                  }

      		}

      		echo "<tr><td width=80 align=right>$usetext</td><td width=32>";
      		echo "<a href=\"rpg_rightpane.php?action=info&id=$item->id\">";

      		echo rpg_itemlink($item->id,"000000");

      		echo "</a>\n";
      		echo "</td><td>";
      		if($itema->charges>1) echo "($itema->charges charges)";
      		if($itema->quantity>1) echo "  <font color=#ffffff>x$itema->quantity";

            echo " &nbsp;</td></tr> ";


		}
		echo "</table>\n";
	}
}
else
{
	echo "<p>Create a character first!</p>\n";

}

for($i=0;$i<12;$i++) echo "<p>&nbsp;</p>";

include("rpg_footer.php");
?>

