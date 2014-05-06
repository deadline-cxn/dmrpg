<?
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
////////////////////////////////////////////////////////////////////////////////////////

function rpg_money_format($in) { return "$".number_format($in,2,'.',','); }
function inform($txt) {	echo "<table border=0 cellspacing=0 cellpadding=6 width=100%><tr><td class=td_inform>$txt</td></tr></table>"; }
function inform2($txt){	echo "<table border=0 cellspacing=0 cellpadding=3 width=100%><tr><td class=td_inform2>$txt</td></tr></table>"; }
function inform3($txt){	echo "<table border=0 cellspacing=0 cellpadding=3 width=100%><tr><td class=td_inform3>$txt</td></tr></table>"; }

function eqcolorize($info)
{
    $info = str_replace(".+","<br><font color=#008800>+",$info);
    $info = str_replace(".-","<br><font color=#ff0000>-",$info);
    $info = str_replace("Require","<br><font color=#00ff00>Require",$info);
    $info = str_replace("(Cra","<br><font color=#0088ff>(Cra",$info);
    $info = str_replace("Use:","<br><font color=#ffaa00>Use:",$info);
    $info = str_replace("Damage:","<br><font color=#ff44ff>Damage:",$info);
	$info = str_replace("Can not","<br><font color=#ff0000>Can not",$info);
	return $info;
}

function rpg_itemlink($id)
{
	$result=dm_query("select * from rpg_items where `id`='$id'");
	$item=mysql_fetch_object($result);

	if(empty($item))
	{
		return;

	}

	$img = '<img src=images/'.$item->image.' border="0" width="32" height="32">';

	$item->name=stripslashes($item->name);
	$item->description=stripslashes($item->description);

	if(empty($item->description)) $item->description="<h4>".$item->name."</h4>".$img."<br><br>".$item->description;
	else					 	  $item->description="<h4>".$item->name."</h4>".$img."<br><br>".$item->description; 

	$item->description.="<br>";

	if($item->damage!=0)	$item->description.="Damage: $item->damage - $item->damage_high<br>";
	$sign="."; if($item->str_mod>0) $sign=".+";
	if($item->str_mod!=0)   $item->description.= "$sign$item->str_mod Intimidation<br>";
	$sign="."; if($item->agl_mod>0) $sign=".+";
	if($item->agl_mod!=0)   $item->description.= "$sign$item->agl_mod Non-Fatness<br>";
	$sign="."; if($item->int_mod>0) $sign=".+";
	if($item->int_mod!=0)   $item->description.= "$sign$item->int_mod Syllogism<br>";
	$sign="."; if($item->pow_mod>0) $sign=".+";
	if($item->pow_mod!=0)   $item->description.= "$sign$item->pow_mod Motivation<br>";
	$sign="."; if($item->def_mod>0) $sign=".+";
	if($item->def_mod!=0)   $item->description.= "$sign$item->def_mod Callousness<br>";

	$item->description.=rpg_getactiontext($item->action);

	if($item->required_level>1)
	$item->description.= "Required Level [$item->required_level]<br>\n";

	if($item->quest=="yes") {
	$item->tradeable="no";
	$item->description.= "(Quest Item)<br>";
	}

	if($item->craft_mat=="yes")
	$item->description.= "(Craft Material)<br>";

	if($item->unique=="1")
	$item->description.= "Unique<br>";

	if($item->tradeable=="no")
	$item->description.= "Can not be traded<br>";

	//$clr=substr(trim($incolor),2,6);
	$clr=$incolor;
	$color=' style="color: #'.substr(trim($incolor),2,6).';"';
	    
	$out ="<a class=\"dmz_item\" href=\"rpg_rightpane.php?action=info&id=$item->id\"{$color} target=right border=0> ";
	$item->description=stripslashes($item->description);
	$out.="<span><font color=$clr>".eqcolorize($item->description)."</span>{$img}</a>";
	return $out;
}

function rpg_getitemtext($id)
{
	$result=dm_query("select * from rpg_items where `id`='$id'");
	$item=mysql_fetch_object($result);

	if(empty($item))
	{
		return;
	}

//	$img = '<img src=images/'.$item->image.' border="0" width="32" height="32">';

	$item->name=stripslashes($item->name);
	$item->description=stripslashes($item->description);

    //$item->description="<h4>".$item->name."</h4>".$img."<br><br>".$item->description;

    $item->description.="\n\n";


	if($item->damage!=0)	$item->description.="Damage: $item->damage - $item->damage_high\n\n";
	$sign=""; if($item->str_mod>0) $sign="+";
	if($item->str_mod!=0)   $item->description.= "$sign$item->str_mod Intimidation\n\n";
	$sign=""; if($item->agl_mod>0) $sign="+";
	if($item->agl_mod!=0)   $item->description.= "$sign$item->agl_mod Non-Fatness\n\n";
	$sign=""; if($item->int_mod>0) $sign="+";
	if($item->int_mod!=0)   $item->description.= "$sign$item->int_mod Syllogism\n\n";
	$sign=""; if($item->pow_mod>0) $sign="+";
	if($item->pow_mod!=0)   $item->description.= "$sign$item->pow_mod Motivation\n\n";
	$sign=""; if($item->def_mod>0) $sign="+";
	if($item->def_mod!=0)   $item->description.= "$sign$item->def_mod Callousness\n\n";

	$item->description.=rpg_getactiontext($item->action)."\n\n";

	if($item->required_level>1)
	$item->description.= "Required Level [$item->required_level]\n\n";

	if($item->quest=="yes") {
	$item->tradeable="no";
	$item->description.= "(Quest Item)\n";
	}

	if($item->craft_mat=="yes")
	$item->description.= "(Craft Material)\n";

	if($item->unique=="1")
	$item->description.= "Unique\n";

	if($item->tradeable=="no")
	$item->description.= "Can not be traded\n";

//	//$clr=substr(trim($incolor),2,6);
//	$clr=$incolor;
//	$color=' style="color: #'.substr(trim($incolor),2,6).';"';
//	$out ="<a class=\"dmz_item\" href=\"rpg_rightpane.php?action=info&id=$item->id\"{$color} target=right border=0> ";
	$item->description=stripslashes($item->description);
//	$out.="<span><font color=$clr>".eqcolorize($item->description)."</span>{$img}</a>";
	return $item->description;
}

function rpg_showabilities()
{
  $data=$GLOBALS['data'];
  $dabs=explode("|",$data->rpg_abilities);
  echo "<table border=0 cellpadding=5><tr>";
  $ln=0;
  for($i=0;$i<count($dabs);$i++)
  {
    $id=$dabs[$i];
	if(empty($id)||($id=="0"))
	{
	}
	else
	{
		$rab=dm_query("select * from rpg_special_attacks where `id`='$id'");
		$tab=mysql_fetch_object($rab);
		echo "<td>";
		echo rpg_abilitylink($tab->id);
		echo "</td>";
		$ln++; if($ln>12) { $ln=0; echo "</tr><tr>"; }
	}
  }
  echo "</tr>";
}

function rpg_bar($x,$y,$z)
{
	if($y!=0)
	{
		$dera= $x/$y;
		$wd  =($x/$y)*$z;
	}
	else
	{
		$dera=1;
		$wd=1;
	}
	$whbar="statbargreen.gif";
	if(($dera*100)<70) $whbar="statbaryellow.gif";
	if(($dera*100)<30) $whbar="statbarred.gif";
	return "<img src=\"images/$whbar\" width=$wd height=6>";
}

function rpg_getmodified($atr)
{
	$gd=$atr."_mod";

	$attr=0;

	$data=$GLOBALS['data'];
	$uid=0;

	$item=rpg_getlootobj($data->rpg_slot_head);
	$attr=$attr+$item->$gd;
	
	$item=rpg_getlootobj($data->rpg_slot_back);
	$attr=$attr+$item->$gd;
	
	$item=rpg_getlootobj($data->rpg_slot_hands);
	$attr=$attr+$item->$gd;
	
	$item=rpg_getlootobj($data->rpg_slot_legs);
	$attr=$attr+$item->$gd;
	
	$item=rpg_getlootobj($data->rpg_slot_arms);
	$attr=$attr+$item->$gd;
	
	$item=rpg_getlootobj($data->rpg_slot_feet);
	$attr=$attr+$item->$gd;
	
	$item=rpg_getlootobj($data->rpg_slot_chest);
	$attr=$attr+$item->$gd;
	
	$item=rpg_getlootobj($data->rpg_slot_mainhand);
	$attr=$attr+$item->$gd;
	
	$item=rpg_getlootobj($data->rpg_slot_sechand);
	$attr=$attr+$item->$gd;

	return $attr;
}

function rpg_equipitem($id)
{
	$data=$GLOBALS['data'];
	
	$item=rpg_getlootobj($id);
	if($item->required_level>$data->rpg_level) return;

	$uid=0;

	if($item->wear_slot=="item_head")
	{
		$uid=$data->rpg_slot_head;
		rpg_giveitem($uid,1);
		rpg_setvar("rpg_slot_head",$id);		
		rpg_takeitem($id,1);
	}

	if($item->wear_slot=="item_back")
	{
		$uid=$data->rpg_slot_back;
		rpg_giveitem($uid,1);
		rpg_setvar("rpg_slot_back",$id);
		rpg_takeitem($id,1);
	}

	if($item->wear_slot=="item_hands")
	{
		$uid=$data->rpg_slot_hands;
		rpg_giveitem($uid,1);
		rpg_setvar("rpg_slot_hands",$id);
		rpg_takeitem($id,1);
	}

	if($item->wear_slot=="item_legs")
	{
		$uid=$data->rpg_slot_legs;
		rpg_giveitem($uid,1);
		rpg_setvar("rpg_slot_legs",$id);
		rpg_takeitem($id,1);
	}

	if($item->wear_slot=="item_arms")
	{
		$uid=$data->rpg_slot_arms;
		rpg_giveitem($uid,1);
		rpg_setvar("rpg_slot_arms",$id);
		rpg_takeitem($id,1);
	}

	if($item->wear_slot=="item_feet")
	{
		$uid=$data->rpg_slot_feet;
		rpg_giveitem($uid,1);
		rpg_setvar("rpg_slot_feet",$id);
		rpg_takeitem($id,1);
	}

	if($item->wear_slot=="item_chest")
	{
		$uid=$data->rpg_slot_chest;
		rpg_giveitem($uid,1);
		rpg_setvar("rpg_slot_chest",$id);
		rpg_takeitem($id,1);
	}

	if($item->wear_slot=="item_weapon1")
	{
		$uid=$data->rpg_slot_mainhand;
		rpg_giveitem($uid,1);
		rpg_setvar("rpg_slot_mainhand",$id);
		rpg_takeitem($id,1);
	}

	if($item->wear_slot=="item_sechand")
	{
		$uid=$data->rpg_slot_sechand;
		rpg_giveitem($uid,1);
		rpg_setvar("rpg_slot_sechand",$id);
		rpg_takeitem($id,1);
	}
	
}

function rpg_doaction($id)
{
 //  teleport     combine    do_encounter    do_fight
	$data=$GLOBALS['data'];
	$action	= rpg_getactionobj($id);

	if( ($action->action=="hp_modify_enemy") ||
		($action->action=="hp_leech_enemy") ||
		($action->action=="pow_modify_enemy") ||
		($action->action=="pow_leech_enemy") )
	{
		$dmgs=explode(",",$action->value);
		if(empty($dmgs[1])) { return $dmgs[0]; }
		else		{         return(rand($dmgs[0],$dmgs[1])); }
	}

	if($action->action=="teach_ability")
	{
		$ab=rpg_getabilityobj($action->value);
     	$rtn=0;
		$dabs=explode("|",$data->rpg_abilities);
		for($i=0;$i<count($dabs);$i++)
		{
			if($dabs[$i]==$action->value) $rtn=1;
		}
		if($rtn==1)
        {
          inform("You already know $ab->name");
          return 1;
        }
		$data->rpg_abilities.="|$action->value";
		rpg_setvar("rpg_abilities",$data->rpg_abilities);
		inform("You have learned a new abilitiy! $ab->name");
		rpg_refresh("bottom","rpg_bottom.php");
	}

	if($action->action=="teach_recipe")
	{
      if(!empty($data->rpg_craft))
      {
        $crft=rpg_getcraftobj($data->rpg_craft);
        $rcp=rpg_getrecipeobj($action->value);
        if($rcp->craft_id==$crft->id)
        {
          if($rcp->skill_required<=$data->rpg_craft_skill)
          {
            $knw=0;
            $rcplist=explode("|",$data->rpg_craft_recipes);
            for($i=0;$i<count($rcplist);$i++)
            {
              if($rcplist[$i]==$action->value) $knw=1;
            }
            if($knw==1)
            {
              inform("You already know that recipe!");
              return 1;
            }
            else
            {
              $data->rpg_craft_recipes.="|$action->value";
              rpg_setvar("rpg_craft_recipes",$data->rpg_craft_recipes);
              inform("You learn the recipe $rcp->name");
            }
          }
          else
          {
            inform("You don't have the required skill for that recipe");
            return 1;
          }
        }
        else
        {
          $crft=rpg_getcraftobj($action->value);
          inform("You don't know $crft->name");
          return 1;
        }
      }
      else
      {
        inform("You don't know any crafts!");
        return 1;
      }
    }

	if($action->action=="teach_craft")
	{
        if(!empty($data->rpg_craft))
        {
          inform("You already know a craft. You must unlearnify it first.");
          return 1;
        }
		rpg_setvar("rpg_craft",$action->value);
		rpg_setvar("rpg_craft_skill",1);
		rpg_setvar("rpg_craft_skill_max",99);
		$crft=rpg_getcraftobj($action->value);
		inform("You have learned $crft->name");
	}

    if($action->action=="modify_exp") 
    {
      $data->rpg_exp+=$action->value;
      rpg_setvar("rpg_exp",$data->rpg_exp);
      $gain="gain"; if($action->value<0) $gain="lose";
      inform3("You $gain $action->value exp");
    }
    if($action->action=="modify_str") { $data->rpg_str+=$action->value; rpg_setvar("rpg_str",$data->rpg_str); }
    if($action->action=="modify_int") { $data->rpg_int+=$action->value; rpg_setvar("rpg_int",$data->rpg_int); }
    if($action->action=="modify_agl") { $data->rpg_agl+=$action->value; rpg_setvar("rpg_agl",$data->rpg_agl); }
    if($action->action=="modify_def") { $data->rpg_def+=$action->value; rpg_setvar("rpg_def",$data->rpg_def); }

	if($action->action=="modify_powmax")
	{
		$data->rpg_powmax+=$action->value;
		if($data->rpg_pow>$data->rpg_powmax) $data->rpg_pow=$data->rpg_powmax;
		rpg_setvar("rpg_powmax",$data->rpg_powmax);
	}

	if($action->action=="modify_hpmax")
	{
		$data->rpg_hpmax=$data->rpg_hpmax+$action->value;
		if($data->rpg_hp>$data->rpg_hpmax) $data->rpg_hp=$data->rpg_hpmax;
		rpg_setvar("rpg_hpmax",$data->rpg_hpmax);
	}
    if($action->action=="modify_hp")
    {
		$data->rpg_hp=$data->rpg_hp+$action->value;
		if($data->rpg_hp>$data->rpg_hpmax) $data->rpg_hp=$data->rpg_hpmax;
		rpg_setvar("rpg_hp",$data->rpg_hp);
	}
    if($action->action=="modify_pow")
	{
		$data->rpg_pow=$data->rpg_pow+$action->value;
		if($data->rpg_pow>$data->rpg_powmax) $data->rpg_pow=$data->rpg_powmax;
		rpg_setvar("rpg_pow",$data->rpg_pow);
	}
    if($action->action=="modify_ap")
    {
		$data->rpg_ap=$data->rpg_ap+$action->value;
		if($data->rpg_ap>300) $data->rpg_ap=300;
		rpg_setvar("rpg_ap",$data->rpg_ap);
    }
    if($action->action=="modify_cash")
	{
		$bc=$data->rpg_cash;
		$data->rpg_cash=$data->rpg_cash+$action->value;
		if($bc>$data->rpg_cash) $inf="You lose ".abs(rpg_money_format($action->value))." cash";
		else $inf="You gain ".rpg_money_format($action->value)." cash";
		$inf.=" <img src=images/item_cash.gif>";
		inform($inf);
		rpg_setvar("rpg_cash",$data->rpg_cash);
	}

	if($action->action=="loottable") { rpg_getloot($action->value); }

	if($action->action=="upgrade_base")
	{
		if($action->value=="start")
		{
			if(!empty($data->rpg_base))
			{
				inform("Your base is already started.");
				return 1;
			}
			else
			{
				inform("You start your base!");
				rpg_setvar("rpg_base","base");
			}
		}
		else if($action->value=="destroy")
		{
			inform("Base destroyed!");
			rpg_setvar("rpg_base","");

		}
		else
		{
			if(empty($data->rpg_base))
			{
				inform("Your base isn't started yet!");
				return 1;
			}

             // barracks cable_tv craft_machine factory shield_1 shield_2 shield_3 tower_guns_2 trinket_panel
             
			if($action->value=="quest_log")
			{
				if(!stristr($data->rpg_base,"quest_log"))
				{
					inform("You add a quest log to your base!");
					$data->rpg_base.="|quest_log";
					rpg_setvar("rpg_base",$data->rpg_base);
				}
				else
				{
                    inform("You already have one installed");
                  return 1;
                 }
			}

			if($action->value=="henchmen_generator")
			{
				if(!stristr($data->rpg_base,"henchmen_generator"))
				{
					inform("You add a henchmen generator to your base!");
					$data->rpg_base.="|henchmen_generator";
					rpg_setvar("rpg_base",$data->rpg_base);
				}
				else
				{
                    inform("You already have one installed");
                  return 1;
                 }
			}

			if($action->value=="henchleader_generator")
			{
				if(!stristr($data->rpg_base,"henchleader_generator"))
				{
					inform("You add a henchmen leader generator to your base!");
					$data->rpg_base.="|henchleader_generator";
					rpg_setvar("rpg_base",$data->rpg_base);
				}
				else
				{
                    inform("You already have one installed");
                  return 1;
                 }
			}

			if($action->value=="trophy_case")
			{
				if(!stristr($data->rpg_base,"trophy_case"))
				{
					inform("You add a trophy case to your base!");
					$data->rpg_base.="|trophy_case";
					rpg_setvar("rpg_base",$data->rpg_base);
				}
				else
				{
                    inform("You already have one installed");
                  return 1;
                 }
			}

            if($action->value=="tower_foundation")
			{

				if(empty($data->rpg_base_tower1))
				{
					rpg_setvar("rpg_base_tower1","tower_foundation");
     				inform("Tower Foundation set into tower slot 1");
     				return;
				}
				else if(empty($data->rpg_base_tower2))
				{
					rpg_setvar("rpg_base_tower2","tower_foundation");
     				inform("Tower Foundation set into tower slot 2");
     				return;
				}
				else if(empty($data->rpg_base_tower3))
				{
					rpg_setvar("rpg_base_tower3","tower_foundation");
     				inform("Tower Foundation set into tower slot 3");
     				return;
				}
				else if(empty($data->rpg_base_tower4))
				{
					rpg_setvar("rpg_base_tower4","tower_foundation");
     				inform("Tower Foundation set into tower slot 4");
     				return;
				}

				inform("There are no base tower slots available. Use a base tower de-configurator 9000");
				return 1;
			}
			
            if($action->value=="tower_guns_1")
			{
				$inform="There are no base tower foundations available. Use a base tower foundation.";
				if($data->rpg_base_tower1=="tower_foundation")
				{
					$inform="Tower Guns set into tower slot 1";
					rpg_setvar("rpg_base_tower1","tower_guns_1");
				}
				else if($data->rpg_base_tower2=="tower_foundation")
				{
					$inform="Tower Guns set into tower slot 2";
					rpg_setvar("rpg_base_tower2","tower_guns_1");
				}
				else if($data->rpg_base_tower3=="tower_foundation")
				{
					$inform="Tower Guns set into tower slot 3";
					rpg_setvar("rpg_base_tower3","tower_guns_1");
				}
				else if($data->rpg_base_tower4=="tower_foundation")
				{
					$inform="Tower Guns set into tower slot 4";
					rpg_setvar("rpg_base_tower4","tower_guns_1");
				}
				inform($inform);
			}

			if($action->value=="auction_counter")
			{
				if(!stristr($data->rpg_base,"auction_counter"))
				{
					inform("You add an auction robot to your base!");
					$data->rpg_base.="|auction_counter";
					rpg_setvar("rpg_base",$data->rpg_base);
				}
				else
				{
                    inform("You already have one installed");
                  return 1;
                 }				
			}

			if($action->value=="trinket_panel")
			{
				if(!stristr($data->rpg_base,"trinket_panel"))
				{
					inform("You add a trinket panel to your base!");
					$data->rpg_base.="|trinket_panel";
					rpg_setvar("rpg_base",$data->rpg_base);
				}
				else
				{
                    inform("You already have one installed");
                  return 1;
                 }
			}
				
			if($action->value=="bank")
			{
				if(!stristr($data->rpg_base,"bank"))
				{
					inform("You add a bank to your base!");
					$data->rpg_base.="|bank";
					rpg_setvar("rpg_base",$data->rpg_base);
				}
				else
				{
                    inform("You already have one installed");
                  return 1;
                 }
			}

			if($action->value=="bed")
			{
				if(!stristr($data->rpg_base,"bed"))
				{
					inform("You add a bed to your base!");
					$data->rpg_base.="|bed";
					rpg_setvar("rpg_base",$data->rpg_base);
				}
				else
				{
                    inform("You already have one installed");
                  return 1;
                 }
			}

			if($action->value=="sidekick_generator")
			{
				if(!stristr($data->rpg_base,"sidekick_generator"))
				{
					inform("You add a sidekick generator to your base!");
					$data->rpg_base.="|sidekick_generator";
					rpg_setvar("rpg_base",$data->rpg_base);
				}
				else
				{
                    inform("You already have one installed");
                  return 1;
                 }
			}

			if($action->value=="sidekick_stable")
			{
				if(!stristr($data->rpg_base,"sidekick_stable"))
				{
					inform("You add a sidekick stable to your base!");
					$data->rpg_base.="|sidekick_stable";
					rpg_setvar("rpg_base",$data->rpg_base);
				}
				else
				{
                    inform("You already have one installed");
                  return 1;
                 }
			}

			if($action->value=="mailbox")
			{
				if(!stristr($data->rpg_base,"mailbox"))
				{
					inform("You add a mailbox to your base!");
					$data->rpg_base.="|mailbox";
					rpg_setvar("rpg_base",$data->rpg_base);
				}
				else
				{
                    inform("You already have one installed");
                  return 1;
                 }
			}
		}
	}

	if($action->action=="action_chain")	{ $act=explode(",",$action->value); for($i=0;$i<count($act);$i++) rpg_doaction($act[$i]); }
}

function rpg_getactiontext($id)
{
	$ret="";
	if($id!=0)
	{
		$act=rpg_getactionobj($id);

		if($act->value<0) $valverb="Decreases";
		else              $valverb="Increases";

		if($act->action=="hp_modify_enemy") 
		{
			$vals=explode(",",$act->value);
			$val1=abs($vals[0]);
			$val2=abs($vals[1]);
			if(!empty($val2)) $dmg="$val1 to $val2";
			else $dmg="$val1";
			$ret.="$valverb enemy Will to Live by $dmg";
		}

		if($act->action=="teach_ability")
		{
			$ab=rpg_getabilityobj($act->value);
			$ret="Use: Teaches you the ability $ab->name\n";
			$ret.=rpg_getactiontext($ab->action);

		}

		if($act->action=="hp_leech_enemy") 
		{
			$vals=explode(",",$act->value);
			$val1=abs($vals[0]);
			$val2=abs($vals[1]);
			if(!empty($val2)) $dmg="$val1 to $val2";
			else $dmg="$val1";
			$ret.="Leeches $dmg of enemy's Will to Live";
		}

		if($act->action=="pow_modify_enemy") 
		{
			$vals=explode(",",$act->value);
			$val1=abs($vals[0]);
			$val2=abs($vals[1]);
			if(!empty($val2)) $dmg="$val1 to $val2";
			else $dmg="$val1";
			$ret.="$valverb enemy Motivation by $dmg";
		}


		if($act->action=="pow_leech_enemy") 
		{
			$vals=explode(",",$act->value);
			$val1=abs($vals[0]);
			$val2=abs($vals[1]);
			if(!empty($val2)) $dmg="$val1 to $val2";
			else $dmg="$val1";
			$ret.="Leeches $dmg of enemy's Motivation";
		}

		if($act->action=="modify_ap") $ret.="Use: $valverb AP by $act->value";

		if($act->action=="modify_hp") $ret.="Use: $valverb WTL by $act->value";
		if($act->action=="modify_hpmax") $ret.="Use: $valverb max WTL by $act->value";
		if($act->action=="modify_pow") $ret.="Use: $valverb MOT by $act->value";
		if($act->action=="modify_powmax") $ret.="Use: $valverb max MOT by $act->value";

		if($act->action=="modify_exp") $ret.="Use: $valverb XP by $act->value";

		if($act->action=="modify_cash") $ret.="Use: $valverb cash by $act->value";

		if($act->action=="modify_str") $ret.="Use: $valverb INT by $act->value";
		if($act->action=="modify_int") $ret.="Use: $valverb SYL by $act->value";
		if($act->action=="modify_agl") $ret.="Use: $valverb NFN by $act->value";
		if($act->action=="modify_def") $ret.="Use: $valverb CAL by $act->value";

		if($act->action=="teleport")
		{
			$loc=rpg_getmapobj($act->value);
			$ret.="Use: Teleports you to $loc->name";
		}

		if($act->action=="combine")
		{
			$ret.="Use: Combine";

		}

		if($act->action=="teach_craft")
		{
			$ret.="Use: Teaches you the craft";
			$crft=rpg_getcraftobj($act->value);
			$ret.=" $crft->name";
		}
		
		if($act->action=="teach_recipe")
		{
			$ret.="Use: Teaches you the recipe";
			$recipe=rpg_getrecipeobj($act->value);
			$ret.=" $recipe->name";
		}

		if($act->action=="do_encounter")
		{
			$ret.="Use: Do encounter";
		}

		if($act->action=="do_fight")
		{
			$ret.="Use: Do fight";

		}
		
		if($act->action=="loottable") $ret.="Use: Get what's inside";

		if($act->action=="upgrade_base")
		{
			if($act->value=="start")
			{
				$ret.= "Use: Starts your base";
			}
			else if($act->value=="destroy")
			{
				$ret.= "Use: Destroys your base";

			}
			else
			{
				$ret.= "Use: Upgrades your base";
			}
		}

		if($act->action=="action_chain")
		{
			$tact=explode(",",$act->value);
			for($i=0;$i<count($tact);$i++)
			{
				$ret.=rpg_getactiontext($tact[$i])." ";
			}
		}
	}
    $ret.="\n";
	return $ret;
}

function rpg_abilitylink($id)
{
	$rab=dm_query("select * from rpg_special_attacks where `id`='$id'");
    $tab=mysql_fetch_object($rab);
	echo "<a href=\"rpg_main.php?action=useability&ability=$id\" target=mainpane class=dmz_item>";
	echo "<span>";
	echo "$tab->name <br>";
    $ract=dm_query("select * from rpg_actions where `id`='$tab->action'"); $nact=mysql_num_rows($ract);
    $act=mysql_fetch_object($ract);
    echo "$tab->power Motivation<br> ";
    echo rpg_getactiontext($act->id);
    echo "</span><img src=\"images/$tab->image\" border=0></a>";
}

function rpg_useitem($id)
{
	$data=$GLOBALS['data'];
	$result=dm_query("select * from rpg_inventory where `user`='$data->id' and `id`='$id'");
	$itema=mysql_fetch_object($result);
	$item=rpg_getitemobj($itema->id);
    if(rpg_doaction($item->action)!=1)
    {
       if($itema->charges=="1") rpg_takeitem($id,1);
       else                     dm_query("update rpg_inventory set `charges`=`charges`-1 where `iid`='$itema->iid'");
    }
}

function rpg_takeitem($id,$qty)
{
	$data=$GLOBALS['data'];
	$result=dm_query("select * from rpg_inventory where `user`='$data->id' and `id`='$id'");
	$item=mysql_fetch_object($result);
    $item->quantity-=$qty;
	if($item->quantity<1) dm_query("delete from rpg_inventory where `id`='$id'");
    else                  dm_query("update rpg_inventory set `quantity`='$item->quantity' where `id`='$id'");
}

function rpg_transferitem($user,$id)
{
  $result=dm_query("select * from rpg_inventory where `iid`='$id'");
  $iitem=mysql_fetch_object($result);
  dm_query("update rpg_inventory set `user`='$user' where `iid`='$id'");
}

/*
update `rpg_inventory`, `rpg_items`
set `rpg_inventory`.`name`=`rpg_items`.`name`
where `rpg_inventory`.`id`=`rpg_items`.`id`
*/


function rpg_inventory_qty($item)
{
  $data=$GLOBALS['data'];
  $result=dm_query("select * from rpg_inventory where `user`='$data->id' and `id`='$item'");
  $it=mysql_fetch_object($result);
  return $it->quantity;

}

function rpg_giveitemuser($user,$id,$qty)
{
	$data=getuserdata($user);
	$result=dm_query("select * from rpg_inventory where `user`='$data->id' and `id`='$id'");
	$iitem=mysql_fetch_object($result);
    $result=dm_query("select * from rpg_items where `id`='$id'");
    $item=mysql_fetch_object($result);

	if(empty($iitem))
	{
          $result=dm_query("select * from rpg_items where `id`='$id'");
          $item=mysql_fetch_object($result);
          $item->name=addslashes($item->name);
          $item->description=addslashes($item->description);
          if($item->unique=="yes") $qty=1;

          dm_query("

          INSERT INTO `rpg_inventory` (`user`, `quantity`, `id`, `durability`, `durability_max`,
          `charges`, `charges_max`) VALUES

          ('$data->id',
           '$qty',
          '$item->id',
          '$item->durability',
          '$item->durability_max',
          '$item->charges',
          '$item->charges_max' ); ");
        }
        else
        {
			$iitem->quantity+=$qty;
			if($item->unique=="yes")
			{
				$iitem->quantity=1;
			}
			
			dm_query("update rpg_inventory set `quantity`='$iitem->quantity' where `id`='$id'");
        }
		if($item->unique=="yes") return "1";
		dm_query("
update `rpg_inventory`, `rpg_items`
set `rpg_inventory`.`name`=`rpg_items`.`name`
where `rpg_inventory`.`id`=`rpg_items`.`id`
");
		dm_query("
update `rpg_inventory`, `rpg_items`
set `rpg_inventory`.`description`=`rpg_items`.`description`
where `rpg_inventory`.`id`=`rpg_items`.`id`
");
}

function rpg_worldloot($lvl)
{
	$res=dm_query("select * from rpg_items where `wear_slot` != ''");
	$num=mysql_num_rows($res);
	if(rand(0,500) < 50)
	for($i=0;$i<$num;$i++)
	{
		$item=mysql_fetch_object($res);
		if($item->required_level<$lvl)
		{

			if( ($lvl-$item->required_level) < 2)
			{
				if(rand(0,100) < 5)
				{
					rpg_giveitem($item->id,1);
					return;
				}
			}
		}
	}
}

function rpg_giveitem($id,$qty)
{
	if($id==0) return;

	$data=$GLOBALS['data'];
	$item=rpg_getlootobj($id);

    $gj=rpg_giveitemuser($data->id,$id,$qty);

	if($gj!="1")
	{
		$inf= "<center><table border=0><tr><td class=td_inform_item>You gain $item->name";
		if($qty>1)
		$inf.=" x$qty";
		$inf.=rpg_itemlink($item->id);
		$inf.="</td></tr></table>";
		inform($inf);
	}
}

function rpg_combine($array)
{
	$str=implode("|",$array);
	$str=str_replace("||", "|", $str);
	return $str;
}

function rpg_getnpcobj($id)
{
  $result=dm_query("select * from rpg_npc where `id`='$id'");
  $npc=mysql_fetch_object($result);
  return $npc;
}

function rpg_getencounterobj($id)
{
  $result=dm_query("select * from rpg_encounter where `id`='$id'");
  $enc=mysql_fetch_object($result);
  return $enc;
}

function rpg_getcraftobj($id)
{
  $result=dm_query("select * from rpg_crafts where `id`='$id'");
  $crft=mysql_fetch_object($result);
  return $crft;
}

function rpg_getrecipeobj($id)
{
  $result=dm_query("select * from rpg_craft_recipes where `id`='$id'");
  $r=mysql_fetch_object($result);
  return $r;
}

function rpg_getquestobj($id)
{
  $result=dm_query("select * from rpg_quest where `id`='$id'");
  $quest=mysql_fetch_object($result);
  return $quest;
}

function rpg_getmapobj($loc)
{
	$result=dm_query("select * from rpg_map where location='$loc'");
	$locinfo=mysql_fetch_object($result);
	return $locinfo;
}

function rpg_getvendorobj($id)
{
	$result=dm_query("select * from rpg_vendor where `id`='$id'");
	return mysql_fetch_object($result);	
}

function rpg_getactionobj($id)
{
	$result=dm_query("select * from rpg_actions where `id`='$id'");
	return mysql_fetch_object($result);
}

function rpg_getauctionobj($id)
{
	$result=dm_query("select * from rpg_inventory where `iid`='$id'");
	return mysql_fetch_object($result);
}

function rpg_getabilityobj($id)
{
	$result=dm_query("select * from rpg_special_attacks where `id`='$id'");
	return mysql_fetch_object($result);
}

function rpg_getmonsterobj($id)
{
	$result=dm_query("select * from rpg_monsters where `id`='$id'");
	return mysql_fetch_object($result);
}

function rpg_getclassobj($id)
{
	$result=dm_query("select * from rpg_classes where `id`='$id'");
	return mysql_fetch_object($result);
}

function rpg_getitemobj($id)
{
	$result=dm_query("select * from rpg_items where `id`='$id'");
	return mysql_fetch_object($result);
}

function rpg_getlootobj($id)
{
	$result=dm_query("select * from rpg_items where `id`='$id'");
	$ob=mysql_fetch_object($result);
	$ob->name=stripslashes($ob->name);
	$ob->description=stripslashes($ob->description);
	return $ob;
}

function rpg_getloottable($id)
{
	$result=dm_query("select * from rpg_loot_table where `id`='$id'");
	return mysql_fetch_object($result);
}

function rpg_showloottable($id)
{
    if(empty($id)) return;
    echo "<table class=dm_base>\n";
    $loot=rpg_getloottable($id);
    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td>[<a href=\"rpg_build.php?action=looted&id=$loot->id\">edit</a>]</td>\n";
    echo "<td>";
    $its=explode("|",$loot->data);
    for($j=0;$j<count($its);$j++)
    {
        $lts=explode(";",$its[$j]);
        $item=rpg_getlootobj($lts[0]);
        if($item->image=="") $item->image="nopic.gif";
        if(!file_exists("images/$item->image")) $item->image="nofile.gif";
        echo imgs("images/$item->image",$item->name,16,16);
    }
    echo "</td>\n";
    echo"</tr>";
    echo "</table>";
}

function rpg_getloot($id)
{
	$lootres=dm_query("select * from rpg_loot_table where `id`='$id'");
	$lootstr=mysql_fetch_object($lootres);
	$lootls=explode("|",$lootstr->data);
	$numloots=count($lootls);
	for($jj=0;$jj<$numloots;$jj++)
	{
		$lootdetail		= explode(";",$lootls[$jj]);
		$lootid			= $lootdetail[0];
		$lootamountlow 	= $lootdetail[1];
		$lootamounthigh	= $lootdetail[2];
		$lootpercentage	= $lootdetail[3];
		if(rand(1,100)> (100-$lootpercentage))
		{
			$ltamount=rand($lootamountlow,$lootamounthigh);
			rpg_giveitem($lootid,$ltamount);
			$GLOBALS['lootout'].="$lootid"."x"."$ltamount|";
		}
	}
}

function rpg_refresh($which,$url)
{
	echo "<script>parent.$which.location.href = '$url';</script>\n";
}

function rpg_loadpanel($url)
{
	echo "<META HTTP-EQUIV=\"refresh\" content=\"0;URL=$url\">";
}

function rpg_reload()
{
	echo "<script language='JavaScript'>parent.location='index.php';</script>";
}

function rpg_expgain($value)
{
	$data=$GLOBALS['data'];
	rpg_setvar("rpg_exp",$data->rpg_exp+$value);
	rpg_setvar("rpg_totalexp",$data->rpg_totalexp+$value);
}

function rpg_setvar($attr,$value)
{
	$data=$GLOBALS['data'];
	$attr=strtolower($attr);
	dm_setuservar($data->name,$attr,$value);
}

function rpg_setvaruser($user,$attr,$value)
{
	$data=getuserdata($user);
	$attr=strtolower($attr);
	dm_setuservar($data->name,$attr,$value);
}

function rpg_setencounter($encounter)
{
	rpg_clearencounter();
	$data=$GLOBALS['data'];
	rpg_setvar("rpg_encounter","yes");
	dm_query("insert into rpg_encounters values('$data->id','$encounter')");

}
function rpg_clearencounter()
{
	$data=$GLOBALS['data'];
	rpg_setvar("rpg_encounter","no");
	dm_query("delete from rpg_encounters where `characterid`='$data->id'");
}

function rpg_exptolevel($currentlevel)
{
	$base=($currentlevel/8)*$currentlevel*2000;
	return $base;
}

function rpg_createchar($charname,$class)
{
    if(empty($class)) $class=1;
    $data=$GLOBALS['data'];
	dm_log("created character ( $data->id ) $charname (account: $data->name)");
 	$result=dm_query("select * from rpg_classes where id='$class'");
	$class=mysql_fetch_object($result);
	dm_log($class->name);

	rpg_setvar("rpg",  "yes");
    rpg_setvar("rpg_name",	$charname);
	rpg_setvar("rpg_class",	$class->id);
	rpg_setvar("rpg_hp",	$class->start_str*5+6);
	rpg_setvar("rpg_hpmax",	$class->start_str*5+6);
	rpg_setvar("rpg_pow",	($class->start_agl*5));
	rpg_setvar("rpg_powmax",($class->start_agl*5));
	rpg_setvar("rpg_str",	($class->start_str));
	rpg_setvar("rpg_int",	($class->start_int));
	rpg_setvar("rpg_agl",	($class->start_agl));
	rpg_setvar("rpg_def",	($class->start_agl));
	rpg_setvar("rpg_level",	"1");
	rpg_setvar("rpg_exp",	"0");
	rpg_setvar("rpg_totalexp","0");
	rpg_setvar("rpg_tutorial","start");
	rpg_setvar("rpg_mapsize","54");
	dm_query("delete from rpg_inventory where `user`='$data->id'");
	rpg_giveitem(7,5);
	rpg_giveitem(3,1);
	rpg_giveitem(12,1);
	rpg_giveitem(54,1);
	rpg_giveitem(66,1);
	rpg_giveitem(183,1);
	rpg_setvar("rpg_lastaction", "none");
	rpg_setvar("rpg_ap", "99");
	rpg_setvar("rpg",  "yes");
	$data=getuserdata($data->id);


}

function rpg_deletechar()
{
	$data=$GLOBALS['data'];
	dm_log("deleting character ( $data->id )$data->rpg_name (account: $data->name)");
	rpg_setvar("rpg","no");
	rpg_setvar("rpg_x","0");
	rpg_setvar("rpg_y","0");
	rpg_setvar("rpg_z","-1");
    rpg_setvar("rpg_lastaction","0,0,-1");
	rpg_setvar("rpg_cash","0");
	rpg_setvar("rpg_base","");
	rpg_setvar("rpg_base_tower1","");
	rpg_setvar("rpg_base_tower2","");
	rpg_setvar("rpg_base_tower3","");
	rpg_setvar("rpg_base_tower4","");
	rpg_setvar("rpg_abilities","");
	rpg_setvar("rpg_slot_head","");
	rpg_setvar("rpg_slot_back","");
	rpg_setvar("rpg_slot_hands","");
	rpg_setvar("rpg_slot_legs","");
	rpg_setvar("rpg_slot_arms","");
	rpg_setvar("rpg_slot_feet","");
	rpg_setvar("rpg_slot_chest","");
	rpg_setvar("rpg_slot_mainhand","");
	rpg_setvar("rpg_slot_sechand","");
	rpg_setvar("rpg_craft","");
	rpg_setvar("rpg_craft_recipes","");
	rpg_setvar("rpg_craft_skill","");
	rpg_setvar("rpg_craft_skill_max","");
	rpg_setvar("rpg_quests_current","");
    rpg_setvar("rpg_quests_completed","");
    rpg_setvar("rpg_pvp_won","0");
    rpg_setvar("rpg_pvp_lost","0");
    rpg_setvar("rpg_pvp_lastplayer","");
    rpg_setvar("rpg_clan","");
    rpg_setvar("rpg_clanrank","");
    rpg_setvar("rpg_henchmen","");
    rpg_setvar("rpg_henchleaders","");
    rpg_setvar("rpg_bank","");
    rpg_setvar("rpg_bankcash","0");



	dm_query("delete from `rpg_inventory` where `user`='$data->id'");
}

function rpg_levelup()
{
	// 1000 to level
	// 987 xp
	// kill yields 47 xp
	// 1034 xp
	// you level!
	// 34 xp left over

	$data=$GLOBALS['data'];

	$ho=$data->rpg_hpmax;
	$po=$data->rpg_powmax;
	$rstr=$data->rpg_str;
	$ragl=$data->rpg_agl;
	$rint=$data->rpg_int;
	$rdef=$data->rpg_def;

	$data->rpg_exp=$data->rpg_exp-rpg_exptolevel($data->rpg_level);
	$data->rpg_level++;
	rpg_setvar("rpg_exp",$data->rpg_exp);
	rpg_setvar("rpg_level",$data->rpg_level);

	$data->rpg_str+=($data->rpg_str/4);
	$data->rpg_agl+=($data->rpg_agl/4);
	$data->rpg_int+=($data->rpg_int/4);
	$data->rpg_def+=($data->rpg_def/4);

	$data->rpg_str=round($data->rpg_str);
	$data->rpg_agl=round($data->rpg_agl);
	$data->rpg_int=round($data->rpg_int);
	$data->rpg_def=round($data->rpg_def);

	rpg_setvar("rpg_str",$data->rpg_str);
	rpg_setvar("rpg_agl",$data->rpg_agl);
	rpg_setvar("rpg_int",$data->rpg_int);
	rpg_setvar("rpg_def",$data->rpg_def);

	$data->rpg_hpmax  += ($data->rpg_str/4);
	if($data->rpg_agl>$data->rpg_int)
		$data->rpg_powmax += ($data->rpg_agl/4);
	else
		$data->rpg_powmax += ($data->rpg_int/4);
	
	$data->rpg_hpmax+=(5+$data->rpg_level);	

	$data->rpg_hpmax=round($data->rpg_hpmax);

	rpg_setvar("rpg_hpmax",$data->rpg_hpmax);
	rpg_setvar("rpg_hp",$data->rpg_hpmax);

	$data->rpg_powmax+=(5+$data->rpg_level);

	$data->rpg_powmax=round($data->rpg_powmax);

	rpg_setvar("rpg_powmax",$data->rpg_powmax);
	rpg_setvar("rpg_pow",$data->rpg_powmax);

	$ha=$data->rpg_hpmax-$ho;
	$pa=$data->rpg_powmax-$po;

	$nrstr=$data->rpg_str-$rstr;
	$nragl=$data->rpg_agl-$ragl;
	$nrint=$data->rpg_int-$rint;
	$nrdef=$data->rpg_def-$rdef;

	inform("You have reached level $data->rpg_level!\n");
	echo "<p>You gain $ha Will to Live (WTL).<br>\n";
	echo "You gain $pa Motivation (MOT).<br>";

	echo "You gain $nrstr Intimidation (INT).<br>";
	echo "You gain $nragl Nonfatness (NFN).<br>";
	echo "You gain $nrint Syllogism (SYL).<br>";
	echo "You gain $nrdef Callousness (CAL).<br>";

	$cls=rpg_getclassobj($data->class);

	$res=dm_query("select * from rpg_special_attacks");
	$num=mysql_num_rows($res);

	for($i=0;$i<$num;$i++)
	{
		$ab=mysql_fetch_object($res);
		
		if($ab->level==$data->rpg_level)
		{
			if($ab->trained=="auto")
			{
				if( ($ab->class=="All") ||
					($ab->class==$cls->name) ||
					( ($ab->class=="All Evil") & ($cls->alignment=="Evil") ) ||
					( ($ab->class=="All Good") & ($cls->alignment=="Good") ) )
				{
					$data->rpg_abilities.="|$ab->id";
					rpg_setvar("rpg_abilities",$data->rpg_abilities);
					inform("You gain a new ability! $ab->name");
					rpg_refresh("bottom","rpg_bottom.php");
				}
			}
		}
	}




	echo "</p>\n";

	rpg_refresh("charpane","rpg_character.php");
}

function rpg_bordertop($title,$scrollid)
{

	if($scrollid=="") $scrollid="5";
	echo "<table  border=0 cellspacing=0 cellpadding=0>\n";
	echo "<td border=0 cellspacing=0 cellpadding=0>\n";
	echo "<table border=0 cellspacing=0 cellwidth=0 cellpadding=0 width=100%><tr>\n";
	echo "<td width=16><img src=\"images/".$scrollid."_left_top.gif\"></td>";
	echo "<td background=\"images/".$scrollid."_mid_top.gif\" align=center>";
	if($title=="") $title="&nbsp;";
	echo "<font class=dm_white>$title</font></td>\n";
	echo "<td width=16><img src=\"images/".$scrollid."_right_top.gif\"></td>";
	echo "</tr><tr><td background=\"images/".$scrollid."_left_mid.gif\" width=16>&nbsp;</td>";
	echo "<td background=\"images/".$scrollid."_mid_mid.gif\">";

}

function rpg_borderbot($scrollid)
{

	echo "</td><td background=\"images/".$scrollid."_right_mid.gif\">&nbsp;</td>\n";
	echo "</tr><tr><td width=16><img src=\"images/".$scrollid."_left_bot.gif\"></td>\n";
	echo "<td background=\"images/".$scrollid."_mid_bot.gif\">&nbsp;</td>\n";
	echo "<td width=16><img src=\"images/".$scrollid."_right_bot.gif\"></td></tr>\n";
	echo "</table></td></table>\n";
}


function rpg_newsbordertop($title,$scrollid)
{

	if($scrollid=="") $scrollid="5";
	echo "<table border=0 cellspacing=0 cellpadding=0 width=100%>\n";
	echo "<td border=0 cellspacing=0 cellpadding=0>\n";
	echo "<table border=0 cellspacing=0 cellwidth=0 cellpadding=0 width=100%><tr>\n";
	echo "<td width=16><img src=\"images/".$scrollid."_left_top.gif\"></td>";
	echo "<td background=\"images/".$scrollid."_mid_top.gif\" align=center>";
	if($title=="") $title="&nbsp;";
	echo "<font class=dm_news>$title</font></td>\n";
	echo "<td width=16><img src=\"images/".$scrollid."_right_top.gif\"></td>";
	echo "</tr><tr><td background=\"images/".$scrollid."_left_mid.gif\" width=16>&nbsp;</td>";
	echo "<td background=\"images/".$scrollid."_mid_mid.gif\">";

}

function rpg_newsborderbot($scrollid)
{

	echo "</td><td background=\"images/".$scrollid."_right_mid.gif\">&nbsp;</td>\n";
	echo "</tr><tr><td width=16><img src=\"images/".$scrollid."_left_bot.gif\"></td>\n";
	echo "<td background=\"images/".$scrollid."_mid_bot.gif\">&nbsp;</td>\n";
	echo "<td width=16><img src=\"images/".$scrollid."_right_bot.gif\"></td></tr>\n";
	echo "</table></td></table>\n";

}


function rpg_confirm($txt,$urlyes,$urlno)
{
  echo "<table border=\"0\" align=center><tr><td class=\"dm_warning\"><center>".smiles(":X")."\n";
  echo "<br>WARNING:<br>$txt</center>\n";
  echo "</td></tr></table>\n";
  echo "<table align=center><tr><td><form action=\"$urlyes\" method=\"post\">\n";
  echo "<input type=\"submit\" name=\"submit\" value=\"Yes\"></form></td>\n";
  echo "<td><form action=\"$urlno\"><input type=\"submit\" name=\"no\" value=\"No\"></form></td></tr></table>\n";
}

function rpg_getencdata()
{
	$data=$GLOBALS['data'];
	$resulta=dm_query("select * from rpg_encounters where `characterid`='$data->id' ");
	$encobj=mysql_fetch_object($resulta);
	return $encobj;
}

function rpg_getencmob($index)
{

}

function rpg_addhp($nmhp)
{
	$data=$GLOBALS['data'];
	$mxhp=$data->rpg_hpmax+rpg_getmodified("hp");
	$data->rpg_hp+=$nmhp;
	if($data->rpg_hp>$mxhp) $data->rpg_hp=$mxhp; 	
	rpg_setvar("rpg_hp",$data->rpg_hp);
}

function rpg_addpow($nmp)
{
	$data=$GLOBALS['data'];
	$mxp=$data->rpg_powmax+rpg_getmodified("pow");
	$data->rpg_pow+=$nmp;
	if($data->rpg_pow>$mxp) $data->rpg_pow=$mxp;
	rpg_setvar("rpg_pow",$data->rpg_pow);
}

function pmsg($to,$from,$subject,$message)
{
 $fdate=date("Y-m-d"); $ftime=date("H:i:s");
 $to=addslashes($to);
 $from=addslashes($from);
 $subject=addslashes($subject);
 $message=addslashes($message);
 dm_query("insert into `pmsg` (`to`, `from`, `subject`, `message`, `date`, `time`, `read`)
                      VALUES ('$to','$from','$subject','$message','$fdate','$ftime', 'no');");
}

function rpg_remove_current_quest($id)
{
  $data=$GLOBALS['data'];
  $tqw="";
  $tq=explode(",",$data->rpg_quests_current);
  for($i=0;$i<count($tq);$i++)
  {
    $tt=explode(":",$tq[$i]);
    if($tt[0]!=$id) $tqw.=$tq[$i].",";
  }
  $data->rpg_quests_current=rtrim($tqw,",");
//  $data->rpg_quests_current=ltrim($data->rpg_quests_current,",");
  rpg_setvar("rpg_quests_current",$data->rpg_quests_current);
}

function rpg_add_current_quest($id)
{
  $data=$GLOBALS['data'];
  rpg_remove_current_quest($id);
  $qu=rpg_getquestobj($id);
  echo "<p>$qu->killmonsters</p>";
  $montxt=":";
  if(!empty($qu->killmonsters))
  {
    $rt=explode("|",$qu->killmonsters);
    for($i=0;$i<count($rt);$i++)
    {
      $rl=explode(";",$rt[$i]);
      $montxt.=$rl[0].";0/".$rl[1]."|";
    }
  }

  $data->rpg_quests_current.=",$id".rtrim($montxt,"|");
  $data->rpg_quests_current=rtrim($data->rpg_quests_current,":");

 // $data->rpg_quests_current=rtrim($data->rpg_quests_current,",");
 $data->rpg_quests_current=ltrim($data->rpg_quests_current,",");
  rpg_setvar("rpg_quests_current",$data->rpg_quests_current);
}

function rpg_remove_completed_quest($id)
{
  $data=$GLOBALS['data'];
  $tqw="";
  $tq=explode(",",$data->rpg_quests_completed);
  for($i=0;$i<count($tq);$i++)
  {
    if($tq[$i]!=$id) $tqw.=$tq[$i].",";
  }
  $data->rpg_quests_completed=rtrim($tqw,",");
  $data->rpg_quests_completed=ltrim($data->rpg_quests_completed,",");
  rpg_setvar("rpg_quests_completed",$data->rpg_quests_completed);
}

function rpg_add_completed_quest($id)
{
  $data=$GLOBALS['data'];
  rpg_remove_completed_quest($id);
  $data->rpg_quests_completed.=",$id";
  $data->rpg_quests_completed=rtrim($data->rpg_quests_completed,",");
  $data->rpg_quests_completed=ltrim($data->rpg_quests_completed,",");
  rpg_setvar("rpg_quests_completed",$data->rpg_quests_completed);
}

function rpg_questreqs($id)
{
    $data=$GLOBALS['data'];
}

function rpg_isonquest($id)
{
    $data=$GLOBALS['data'];
    $tqw="";
    $tq=explode(",",$data->rpg_quests_current);
    for($i=0;$i<count($tq);$i++)
    {
      $tqu=explode(":",$tq[$i]);
      if($tqu[0]==$id) return true;
    }
    return false;
}


function rpg_isquestcompleted($id)
{
    $data=$GLOBALS['data'];
    $tqw="";
    $tq=explode(",",$data->rpg_quests_completed);
    for($i=0;$i<count($tq);$i++)
    {
      if($tq[$i]==$id) return true;
    }
    return false;
}

function rpg_isquestprereq($id)
{
    $quest=rpg_getquestobj($id); if(empty($quest->prereq_quest)) return true;
    $data=$GLOBALS['data'];
    $tqw="";
    $tq=explode(",",$data->rpg_quests_completed);
    for($i=0;$i<count($tq);$i++)
    {
      if($tq[$i]==$quest->prereq_quest) return true;
    }
    return false;
}

function rpg_update_current_quest($quest,$monster,$qty)
{
  $data=$GLOBALS['data'];
  $outtext="";
  $cq=explode(",",$data->rpg_quests_current);
  for($i=0;$i<count($cq);$i++)
  {
    $cqq=explode(":",$cq[$i]);
    if($cqq[0]==$quest)
    {
      $ml="";
      $cqqm=explode("|",$cqq[1]);
      for($mc=0;$mc<count($cqqm);$mc++)
      {
        $cqqmc=explode(";",$cqqm[$mc]);

        if($cqqmc[0]==$monster)
        {
           $cqqmcs=explode("/",$cqqmc[1]);
           $cqqmcs[0]+=$qty;
           if($cqqmcs[0]>$cqqmcs[1]) $cqqmcs[0]=$cqqmcs[1];
           $ml.=$monster.";".$cqqmcs[0]."/".$cqqmcs[1]."|";
        }
        else
        {
          $ml.=$cqqm[$mc]."|";
        }
      }
      $outtext.="$quest:".rtrim($ml,"|");
    }
    else
    {
      $outtext.=$cq[$i];
    }
    $outtext.=",";
  }
  $outtext=ltrim($outtext,",");
  $outtext=rtrim($outtext,":");
  rpg_setvar("rpg_quests_current",$outtext);
  $data->rpg_quests_current=$outtext;
}

function rpg_update_current_quest_kills($monster,$qty)
{
  $data=$GLOBALS['data'];
  $cq=explode(",",$data->rpg_quests_current);
  for($i=0;$i<count($cq);$i++)
  {
    $cqq=explode(":",$cq[$i]);
    $cqqm=explode("|",$cqq[1]);
    for($mc=0;$mc<count($cqqm);$mc++)
    {
      $cqqmc=explode(";",$cqqm[$mc]);
      if($cqqmc[0]==$monster)
      {
        rpg_update_current_quest($cqq[0],$monster,$qty);
        $qu=rpg_getquestobj($cqq[0]);
        $mn=rpg_getmonsterobj($monster);
        inform("Quest:$qu->name<br>".rpg_get_current_quest_kills($qu->id));
      }
    }
  }
}

function rpg_get_current_quest_kills($quest)
{
  $data=$GLOBALS['data'];
  $outtext="";
  $cq=explode(",",$data->rpg_quests_current);
  for($i=0;$i<count($cq);$i++)
  {
    $cqq=explode(":",$cq[$i]);
    if($cqq[0]==$quest)
    {
      $cqqm=explode("|",$cqq[1]);
      for($mc=0;$mc<count($cqqm);$mc++)
      {
        $cqqmc=explode(";",$cqqm[$mc]);
        $cqqmcs=explode("/",$cqqmc[1]);
        $mn=rpg_getmonsterobj($cqqmc[0]);
        $outtext.=$mn->name." ".$cqqmcs[0]."/".$cqqmcs[1]." <br> ";
      }
    }
  }
  return $outtext;
}

function rpg_quest_monsters_killed($quest)
{
  $data=$GLOBALS['data'];
  $qu=rpg_getquestobj($quest);
  if(empty($qu->killmonsters)) return true;
  $cq=explode(",",$data->rpg_quests_current);
  for($i=0;$i<count($cq);$i++)
  {
    $cqq=explode(":",$cq[$i]);
    if($cqq[0]==$quest)
    {
      $killed=0;
      $cqqm=explode("|",$cqq[1]);
      for($mc=0;$mc<count($cqqm);$mc++)
      {
        $cqqmc=explode(";",$cqqm[$mc]);
        $cqqmcs=explode("/",$cqqmc[1]);
        if($cqqmcs[0]==$cqqmcs[1]) $killed++;
      }
      if($killed==count($cqqm)) return true;
      else return false;
    }
  }

  return false;
}


function rpg_craft_skill_add($qty)
{
 $data=$GLOBALS['data'];
 if(($data->rpg_craft_skill+$qty) > $data->rpg_craft_skill_max) return;
 $data->rpg_craft_skill+=$qty;
 $cr=rpg_getcraftobj($data->rpg_craft);
 inform3("Your skill in $cr->name has increased to $data->rpg_craft_skill");
 rpg_setvar("rpg_craft_skill",$data->rpg_craft_skill);
}

function rpg_getdir($dir)
{
    $dirfiles = array();
    $handle=@opendir($dir) or die("Unable to open filepath $dir");
    while (false!==($file = readdir($handle))) array_push($dirfiles,$file);
    closedir($handle); sort($dirfiles); reset($dirfiles);
    return $dirfiles;
}

function rpg_putchatmsg($name,$message)
{
 // rpg_removeoldchat();
  $name=addslashes($name);
  $message=addslashes($message);
  $time=time();
  dm_query("insert into rpg_chat (`timestamp`,`name`,`message`) values ('$time','$name','$message')");
  return $time;
}

function rpg_removeoldchat()
{
    $time=time();
    $otime=time()-(5*60); // minus 5 minutes
    dm_query("delete from rpg_chat where `timestamp` < '$otime'");
}


function rpg_getchatmsgs($lastmessage)
{


}

?>
