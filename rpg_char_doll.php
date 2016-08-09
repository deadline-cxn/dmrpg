<?php
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
	rpg_refresh("charpane","rpg_character.php");
	echo "<p>\n";

	echo "<h1> $data->rpg_name </h1>\n";	

	$head  = rpg_getlootobj($data->rpg_slot_head);
	$hands = rpg_getlootobj($data->rpg_slot_hands);
	$arms  = rpg_getlootobj($data->rpg_slot_arms);
	$legs  = rpg_getlootobj($data->rpg_slot_legs);
	$chest = rpg_getlootobj($data->rpg_slot_chest);
	$back  = rpg_getlootobj($data->rpg_slot_back);
	$feet  = rpg_getlootobj($data->rpg_slot_feet);
	$hand1 = rpg_getlootobj($data->rpg_slot_mainhand);
	$hand2 = rpg_getlootobj($data->rpg_slot_sechand);


	echo "<table class=td_base width=400 >\n";

	echo "<tr>";
	
	//////////////////////////////////////////////////////////////////////////
	
	echo "<td>&nbsp;</td>";
	
	/////////////////////////////////////	
	
	echo "<td valign=top align=center height=60 >head <br>";
	if(!empty($head->image))
	{
		
		echo rpg_itemlink($head->id,"000000");

	}
	echo "</td>";

	/////////////////////////////////////
	
	echo "<td>&nbsp;</td>";

	//////////////////////////////////////////////////////////////////////////

	echo "</tr>\n";
	echo "<tr>";

	//////////////////////////////////////////////////////////////////////////

	echo "<td valign=top align=center height=60 >arms<br>";
	if(!empty($arms->image))
	{
		echo rpg_itemlink($arms->id,"000000");

	}
	echo "</td>";
	
	/////////////////////////////////////

	echo "<td valign=top align=center height=60 >chest <br>";
	if(!empty($chest->image))
	{
		echo rpg_itemlink($chest->id,"000000");

	}
	echo "</td>";

	/////////////////////////////////////

	echo "<td valign=top align=center height=60 >back <br>";
	if(!empty($back->image))
	{
		echo rpg_itemlink($back->id,"000000");

	}
	echo "</td>";


	//////////////////////////////////////////////////////////////////////////
	
	echo "</tr>\n";
	echo "<tr>";
	
	//////////////////////////////////////////////////////////////////////////
	
	echo "<td valign=top align=center height=60 >hands<br>";
	if(!empty($hands->image))
	{
		echo rpg_itemlink($hands->id,"000000");

	}
	echo "</td>";
	
	/////////////////////////////////////
	
	echo "<td>&nbsp;</td>";
	
	/////////////////////////////////////

	echo "<td>&nbsp;</td>";
	
	//////////////////////////////////////////////////////////////////////////

	echo "</tr>\n";
	echo "<tr>";   
	
	//////////////////////////////////////////////////////////////////////////
	
	echo "<td valign=top align=center height=60 >mainhand<br>\n";
	if(!empty($hand1->image))
	{
		echo rpg_itemlink($hand1->id,"000000");

	}
	echo "</td>";
	/////////////////////////////////////
	
	echo "<td valign=top align=center height=60 >legs<br>";
	if(!empty($legs->image))
	{
		echo rpg_itemlink($legs->id,"000000");

	}
	echo "</td>";
	
	/////////////////////////////////////

	echo "<td valign=top align=center height=60 >sechand<br>";
	if(!empty($hand2->image))
	{
		echo rpg_itemlink($hand2->id,"000000");

	}
	echo "</td>";
	
	//////////////////////////////////////////////////////////////////////////
	
	echo "</tr>\n";
	echo "<tr>";   

	//////////////////////////////////////////////////////////////////////////
	
	echo "<td></td>";
	
	/////////////////////////////////////
	
	echo "<td valign=top align=center height=60 >feet <br>";
	if(!empty($feet->image))
	{
		echo rpg_itemlink($feet->id,"000000");

	}
	echo "</td>";
	
	/////////////////////////////////////

	echo "<td></td>";
	
	echo "</tr>\n";
	
	//////////////////////////////////////////////////////////////////////////


	echo "</table>\n";





	echo "</p>\n";
}
else
{
	echo "<p><center>You must create a character!</center></p>\n";

}

include("rpg_footer.php");

?>
