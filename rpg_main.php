<?
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////

include("rpg_header.php");
if($HTTP_SESSION_VARS["logged_in"]!="true")
{

  	rpg_refresh("top","index.php");
    include("rpg_footer.php"); exit();
}

$data=getuserdata($HTTP_SESSION_VARS['valid_user']);

//////////////////////////////////////////////////////////////////////////////

if($data->rpg=="yes") // check to see if they have made a character
{
  	if(empty($loc))
	{
		$loc=$data->rpg_lastaction;
		if(empty($loc)) $loc="0,0,-1";
	}
//	echo $loc;
	if($loc=="none") $loc="0,0,-1";
	
	if($data->rpg_tutorial=="start")
	{
		inform("Tutorial: Welcome to Defective Minds RPG! Since you are new we made this tutorial mode.");
		inform("Tutorial: You can turn it off in your base. You can access your base from the top menu.");
		inform("Tutorial: You can turn off tutorial mode from your base.");

		rpg_setvar("rpg_tutorial","yes");

	}

	if($data->rpg_tutorial=="yes")
	{
		if( (empty($action)) ||
			($action=="worldmap")  )
		{
			inform("Tutorial: This is the main screen. There is a map below. A menu up top. ");
			inform("Tutorial: Your character panel is to the left. And your inventory is to the right.");
			inform("Tutorial: You can turn off tutorial mode from your base.");

		}

		if($action=="worldmapgo")
		{
			inform("Tutorial: You have zoomed in to the map.");
			inform("Tutorial: The zoomed in map has different areas you can adventure in.");
			inform("Tutorial: Some areas require AP. Others are vendors or special areas.");
			inform("Tutorial: You only get a certain amount of AP per day.");
			inform("Tutorial: You can turn off tutorial mode from your base.");

		}

		if(($action=="vendor") ||
		   ($action=="sell") ||
		   ($action=="buyitem") )
		{
			inform("Tutorial: You can buy or sell things in your inventory to vendors. The inventory is to the right.");
			inform("Tutorial: You can turn off tutorial mode from your base.");
		}

		if($data->rpg_encounter=="yes") 
		{
			inform("Tutorial: There are encounters in this area. You may wish to equip a weapon from your inventory");
			inform("Tutorial: You will do more damage to monsters you encounter if you have a weapon equipped.");
			inform("Tutorial: The monsters you fight will have items on them that you can loot after you win the fight");
			inform("Tutorial: You want to get better weapons with better stats. The better your stats the more powerful your character will be");
			inform("Tutorial: Some encounters do not require fighting. They could be puzzles, traps or other types of encounters");
		}

	}

	// did level?
	if($data->rpg_exp>=rpg_exptolevel($data->rpg_level))
	{ 
		rpg_levelup();
		echo "<br>[<a href=rpg_main.php?action=$action>continue</a>]";
		exit();
	}

	if($action!="vendor")
	if($action!="sell") 
	if($action!="buyitem")
	{
		rpg_refresh("right","rpg_rightpane.php");
	}

	if($data->rpg_x=="") // if rpg_x="" then that means that none of the values are filled so fill em
	{
		dm_setuservar($data->name,"rpg_x","0");
		$data->rpg_x="0";
		dm_setuservar($data->name,"rpg_y","0");
		$data->rpg_y="0";
		dm_setuservar($data->name,"rpg_z","0");
		$data->rpg_z="0";
	}

	$old_x=$data->rpg_x;
	$old_y=$data->rpg_y;
	$old_z=$data->rpg_z;

	$nloc=explode(",",$loc);

	$data->rpg_x=$nloc[0];
	$data->rpg_y=$nloc[1];
	$data->rpg_z=$nloc[2];
	if(empty($data->rpg_z)) $data->rpg_z="0";

	if($action=="worldmapgo")
	{
		$tloc=rpg_getmapobj("$data->rpg_x,$data->rpg_y,$data->rpg_z");
		$nloc=explode(",",$tloc->data);
		$data->rpg_x=$nloc[0];
		$data->rpg_y=$nloc[1];
		$data->rpg_z=$nloc[2];


	}

	// Check actions
	
	if($action=="increasemapsize")
	{
      $data->rpg_mapsize+=6; if($data->rpg_mapsize>64) $data->rpg_mapsize=64;
      rpg_setvar("rpg_mapsize",$data->rpg_mapsize);
    }
	if($action=="decreasemapsize")
	{
      $data->rpg_mapsize-=6; if($data->rpg_mapsize<12) $data->rpg_mapsize=12;
      rpg_setvar("rpg_mapsize",$data->rpg_mapsize);
    }
    if($wm=="yes") $action="worldmap";

	if($action=="rest")
	{
		$loc="$data->rpg_x,$data->rpg_y,$data->rpg_z"; // paste location into one text string

		$result=dm_query("select * from rpg_map where location='$loc'");
		$locinfo=mysql_fetch_object($result);

		if($locinfo->data=="rest")
		{
			if($locinfo->ap>0)
			{
				if($data->rpg_ap<$locinfo->ap)
				{
					echo "Oh man.. Not enough Action points to rest!";
					exit;
				}
				$data->rpg_ap=$data->rpg_ap-$locinfo->ap;
				if($data->rpg_ap<=0) $data->rpg_ap=0;
				rpg_setvar("rpg_ap",$data->rpg_ap);
			}
			rpg_setvar("rpg_hp",$data->rpg_hpmax);
			rpg_setvar("rpg_pow",$data->rpg_powmax);
			rpg_refresh("charpane","rpg_character.php");
			rpg_refresh("mainpane","rpg_main.php");
		}
		else
		{
			echo "You can't rest here!";
		}
	}

	if($action=="buyitem")
	{
		$titem=rpg_getlootobj($item);
		if($data->rpg_cash < ($titem->sell_value*5))
		{
			inform("You don't have enough cash to purchase that.");
		}
		else
		{
			rpg_giveitem($item,1);
			rpg_setvar("rpg_cash",$data->rpg_cash - ($titem->sell_value*5));
			rpg_refresh("charpane","rpg_character.php");
			rpg_refresh("right","rpg_rightpane.php?vendor=yes&loc=$loc");
		}
		$action="vendor";
	}

	if($action=="sell")
	{
		$titem=rpg_getitemobj($item);
		rpg_takeitem($item,$qty);
		$newcash=$data->rpg_cash+($titem->sell_value*$qty);
		rpg_setvar("rpg_cash",$newcash);
		rpg_refresh("charpane","rpg_character.php");
		rpg_refresh("right","rpg_rightpane.php?vendor=yes&loc=$loc");
		rpg_refresh("mainpane","rpg_main.php?action=vendor&loc=$loc");
	}

	if($action=="encounterguess")
	{
		$loc=$_REQUEST['loc'];
		$res=dm_query("select * from rpg_encounter where `id`='$id'");
		$enc=mysql_fetch_object($res);

		inform("$enc->name");
		if(empty($enc->image)) $enc->image="nofile.gif";
		echo "<br><center><img src=\"images/$enc->image\"></center><br>";

		$correct="no";

		switch($enc->type)
		{
			case "puzzle_multiple_choice":

				if( (!empty($a1)) && ($enc->puzzle_answer=="1") ) $correct="yes";
				if( (!empty($a2)) && ($enc->puzzle_answer=="2") ) $correct="yes";
				if( (!empty($a3)) && ($enc->puzzle_answer=="3") ) $correct="yes";
				if( (!empty($a4)) && ($enc->puzzle_answer=="4") ) $correct="yes";

				if($enc->puzzle_answer=="random")
				{
					$correct="no";
					if(rand(1,4)==3) $correct="yes";
				}

				break;

			case "puzzle_hidden_answer":
					if($a1==$enc->puzzle_opt1) $correct="yes";
				break;
		}

		if($correct=="yes")
		{
			inform(stripslashes($enc->finishtext));

			if(($enc->trigaction)>0)
			rpg_doaction($enc->trigaction);

			if(($enc->gives_loot)>0)
			rpg_getloot($enc->gives_loot);

			rpg_refresh("right","rpg_rightpane.php");
			rpg_refresh("charpane","rpg_character.php");


		}
		else
		{
			
			inform(stripslashes($enc->unfinishtext));

		}

				/*
				  id  $encobj->id<br>
				  name  $encobj->name<br>
				  image  $encobj->image<br>
				  type  $encobj->type<br>
				  description  $encobj->description<br>
				  repeatable  $encobj->repeatable<br>
				  required_level  $encobj->required_level<br>
				  requires_loot  $encobj->requires_loot<br>
				  reqlootamt  $encobj->reqlootamt<br>
				  gives_loot  $encobj->gives_loot<br>
				  finishtext  $encobj->finishtext<br>
				  unfinishtext  $encobj->unfinishtext<br>
				  trigaction  $encobj->trigaction<br>
				  puzzle_opt1  $encobj->puzzle_opt1<br>
				  puzzle_opt2  $encobj->puzzle_opt2<br>
				  puzzle_opt3  $encobj->puzzle_opt3<br>
				  puzzle_opt4  $encobj->puzzle_opt4<br>
				  puzzle_answer $encobj->puzzle_answer<br>
						echo "<p>";
						echo "$id<br>";
						echo "$a1<br>";
						echo "$a2<br>";
						echo "$a3<br>";
						echo "$a4<br>";
						echo "</p>";
				*/
							
		echo "<br>[<a href=\"rpg_main.php?action=seek&loc=$loc\">adventure again</a>] 
				[<a href=rpg_main.php?loc=$loc>continue</a>]";
		exit();
	}
	

	if($action=="equip")
	{
		rpg_equipitem($item);
		rpg_refresh("right","rpg_rightpane.php");
		rpg_refresh("mainpane","rpg_char_doll.php");
	}

	if($action=="use")
	{
		rpg_useitem($item);
		rpg_refresh("right","rpg_rightpane.php");
		rpg_refresh("charpane","rpg_character.php");
		//$data=getuserdata($GLOBALS['vusr']);
	}

	if($action=="death")
	{
		inform("You were defeated. You crawl back to a safe area.");

		rpg_setvar("rpg_hp","1");
		rpg_setvar("rpg_x","0");
		rpg_setvar("rpg_y","0");
		rpg_setvar("rpg_z","0");
		rpg_clearencounter();
		$data=getuserdata($HTTP_SESSION_VARS['valid_user']);
		rpg_refresh("charpane","rpg_character.php");
	}

	if($action=="reload")
		rpg_refresh("mainpane","rpg_main.php"); // reload all frames

	// check if level is too high or other restrictions here revert back to $old_#
	$loc="$data->rpg_x,$data->rpg_y,$data->rpg_z"; // paste location into one text string
	$result=dm_query("select * from rpg_map where location='$loc'"); 
	$locinfo=mysql_fetch_object($result);

	if($locinfo->required_level>$data->rpg_level)
	{
		$data->rpg_x=$old_x;
		$data->rpg_y=$old_y;
		$data->rpg_z=$old_z;
		inform("You don't have what it takes for that area yet!");
		$loc="$data->rpg_x,$data->rpg_y,$data->rpg_z"; // paste location into one text string
	}
	
	rpg_setvar("rpg_x",$data->rpg_x);
	rpg_setvar("rpg_y",$data->rpg_y);
	rpg_setvar("rpg_z",$data->rpg_z);

	if($action=="useability")
	{
		$ab=rpg_getabilityobj($ability);
		if($ab->power>$data->rpg_pow)
		{
			inform("Not enough power to use that special ability");
		}
		else
		{
			rpg_setvar("rpg_pow",$data->rpg_pow-$ab->power);
			$ability_damage=rpg_doaction($ab->action);
		}
	}

	if($action=="quest")
	{

      if(!rpg_isonquest($quest))
      {

        $quest=rpg_getquestobj($quest);
        $npc=rpg_getnpcobj($npc);
        inform("Quest: $quest->name");

        echo "<center><img src=images/$npc->image width=128 height=128><br>";

        inform("$quest->description");

        if($quest->requires_loot!=0)
        {
           inform("Required items: ");
          $rt=rpg_getloottable($quest->requires_loot);
          $rl=explode("|",$rt->data);
          for($u=0;$u<count($rl);$u++)
          {
            $ri=explode(";",$rl[$u]);
            inform(rpg_itemlink($ri[0])."<font color=white> x".$ri[1]." ");
          }

        }
        
        if(!empty($quest->killmonsters))
        {
          inform("Monsters to kill: ");
          $rt=explode("|",$quest->killmonsters);
          for($i=0;$i<count($rt);$i++)
          {
            $rl=explode(";",$rt[$i]);
            $mon=rpg_getmonsterobj($rl[0]);
            inform("<img src=images/$mon->image width=32 height=32>$mon->name <font color=white>x".$rl[1]);
          }

        }
        



        if(!empty($quest->question))
        {
          inform("$quest->question");

          if(!empty($quest->answer_1))
          {
                            echo "<br>";
            echo "<form action=rpg_main.php method=post>";
            echo "<input type=hidden name=action value=questgo>";
            echo "<input type=hidden name=loc value=$loc>";
            echo "<input type=hidden name=quest value=$quest->id>";
            echo "<input type=hidden name=npc value=$npc->id>";
            echo "<input type=hidden name=answer value=1>";
            echo "<input type=submit name=answer_1 value=$quest->answer_1>";
            echo "</form>";
          }

          if(!empty($quest->answer_2))
          {
                            echo "<br>";
            echo "<form action=rpg_main.php method=post>";
            echo "<input type=hidden name=action value=questgo>";
            echo "<input type=hidden name=loc value=$loc>";
            echo "<input type=hidden name=quest value=$quest->id>";
            echo "<input type=hidden name=npc value=$npc->id>";
            echo "<input type=hidden name=answer value=2>";
            echo "<input type=submit name=answer_2 value=$quest->answer_2>";
            echo "</form>";
          }
    
          if(!empty($quest->answer_3))
          {
                            echo "<br>";
            echo "<form action=rpg_main.php method=post>";
            echo "<input type=hidden name=action value=questgo>";
            echo "<input type=hidden name=loc value=$loc>";
            echo "<input type=hidden name=quest value=$quest->id>";
            echo "<input type=hidden name=npc value=$npc->id>";
            echo "<input type=hidden name=answer value=3>";
            echo "<input type=submit name=answer_3 value=$quest->answer_3>";
            echo "</form>";
          }
    
          if(!empty($quest->answer_4))
          {
                            echo "<br>";
            echo "<form action=rpg_main.php method=post>";
            echo "<input type=hidden name=action value=questgo>";
            echo "<input type=hidden name=loc value=$loc>";
            echo "<input type=hidden name=quest value=$quest->id>";
            echo "<input type=hidden name=npc value=$npc->id>";
            echo "<input type=hidden name=answer value=4>";
            echo "<input type=submit name=answer_4 value=$quest->answer_4>";
            echo "</form>";
          }
        }
        else
        {
                          echo "<br>";
            echo "<form action=rpg_main.php method=post>";
            echo "<input type=hidden name=action value=questgo>";
            echo "<input type=hidden name=loc value=$loc>";
            echo "<input type=hidden name=quest value=$quest->id>";
            echo "<input type=hidden name=npc value=$npc->id>";
            echo "<input type=hidden name=answer value=Accept>";
            echo "<input type=submit name=answer_1 value=Accept>";
            echo "</form>";

        }
                        echo "<br>";

        echo "[<a href=rpg_main.php?action=enter&loc=$loc>Go back</a>] [<a href=rpg_main.php?loc=$loc>map</a>]";
  
        exit;
      }
      else
      {
        $action="questgo";
        $answer="cameback";
      }
    }

    if($action=="questgo")
    {
      $quest=rpg_getquestobj($quest);
      $npc=rpg_getnpcobj($npc);

      if(empty($quest->question))
    {







      inform("Quest: $quest->name");
      echo "<center><img src=images/$npc->image width=128 height=128><br>";



      if($answer=="cameback")
      {
        inform($quest->unfinishtext);

        $loot=rpg_getloottable($quest->requires_loot);
        $tl1=explode("|",$loot->data);
        $turnin=0;
        $ct=0;
        for($i=0;$i<count($tl1);$i++)
        {
          $tl2=explode(";",$tl1[$i]);
          $item=rpg_getitemobj($tl2[0]);

          $res=dm_query("select * from rpg_inventory where `id`='$item->id'");
          $num=mysql_num_rows($res);
          if($num)
          {
            $invit=mysql_fetch_object($res);
            if($invit->quantity>=($tl2[1])) $ct++;
          }
        }
        if($ct==count($tl1)) $turnin=1;

        if(rpg_quest_monsters_killed($quest->id)==false) $turnin=0;
        
        

        if($quest->requires_loot!=0)
        {
           inform("Required items: ");
          $rt=rpg_getloottable($quest->requires_loot);
          $rl=explode("|",$rt->data);
          for($u=0;$u<count($rl);$u++)
          {
            $ri=explode(";",$rl[$u]);
            inform(rpg_itemlink($ri[0])."<font color=white> x".$ri[1]." ");
          }

        }

        if(!empty($quest->killmonsters))
        {
          inform("Monsters to kill: ");
         inform(rpg_get_current_quest_kills($quest->id));
        }
        
        echo "<br>";


        if($turnin==1)
        {
            echo "<form action=rpg_main.php method=post>";
            echo "<input type=hidden name=action value=questturnin>";
            echo "<input type=hidden name=loc value=$loc>";
            echo "<input type=hidden name=quest value=$quest->id>";
            echo "<input type=hidden name=npc value=$npc->id>";
            echo "<input type=hidden name=answer value=\"Turn In\">";
            echo "<input type=submit name=answer_1 value=\"Turn In\">";
            echo "</form><br>";
        }
      }

      if($answer=="Accept")
      {
        rpg_add_current_quest($quest->id);
        //        $data->rpg_quests_current.="$quest->id,";
        //      rpg_setvar("rpg_quests_current",$data->rpg_quests_current);
        inform($quest->accepttext);

      }


      echo "[<a href=rpg_main.php?action=enter&loc=$loc>Go back</a>] [<a href=rpg_main.php?loc=$loc>map</a>]";

      exit;
    }
    else
    {
      if($quest->correct_answer==$answer) { $action="questturnin"; $quest=$quest->id; $npc=$npc->id; }
      else
      {
          inform("Quest: $quest->name");
          echo "<center><img src=images/$npc->image><br>";
          inform($quest->unfinishtext);
          echo "[<a href=rpg_main.php?action=enter&loc=$loc>Go back</a>] [<a href=rpg_main.php?loc=$loc>map</a>]";

          exit;


      }
    }

    }

    if($action=="questturnin")
    {

      $quest=rpg_getquestobj($quest);
      $npc=rpg_getnpcobj($npc);
      inform("Quest Turn In: $quest->name");
      echo "<center><img src=images/$npc->image width=128 height=128><br>";
      
      inform("$quest->finishtext");
      
      /*
  	id
	name
	description
	repeatable
	required_level
	requires_loot
	reqlootamt
	gives_loot
	finishtext
	unfinishtext
	trigaction
	prereq_quest
	question
	answer_1
	answer_2
	answer_3
	answer_4
	correct_answer
	accepttext
    */
      $lt=rpg_getloottable($quest->gives_loot);

        rpg_getloot($quest->gives_loot);
      $loot=rpg_getloottable($quest->requires_loot);
      $tl1=explode("|",$loot->data);
      $ct=0;
      for($i=0;$i<count($tl1);$i++)
      {
        $tl2=explode(";",$tl1[$i]);
        $item=rpg_getitemobj($tl2[0]);
        rpg_takeitem($tl2[0],$tl2[1]);
      }

     rpg_doaction($quest->trigaction);


	  rpg_remove_current_quest($quest->id);
	  rpg_add_completed_quest($quest->id);


      echo "[<a href=rpg_main.php?action=enter&loc=$loc>Go back</a>] [<a href=rpg_main.php?loc=$loc>map</a>]";
      exit;
    }


	//enter (inside a building)

	if($action=="enter")
	{
		$locinfo->name=stripslashes($locinfo->name);

        inform("$locinfo->name");
        inform($locinfo->description);

		//show npc's at this location

		$npclist=explode(",",$locinfo->data);
		echo "<center>";
		echo "<table border=0><tr>";
		$ln=0;

		for($i=0;$i<count($npclist);$i++)
		{
          $npc=rpg_getnpcobj($npclist[$i]);
          echo "<td><center><img src=\"images/$npc->image\" width=128 height=128><br>$npc->name <br>";

          $showquest=0;
          $qic="<img src=images/quest.gif>";
          $tqs=explode(",",$npc->quest);
          for($kk=0;$kk<count($tqs);$kk++)
          {
                if($showquest==0)
                {
                  if(rpg_isonquest($tqs[$kk]))     { $showquest=$tqs[$kk]; $qic="<img src=images/onquest.gif>"; }
                  if(!rpg_isquestcompleted($tqs[$kk])) if(rpg_isquestprereq($tqs[$kk])) $showquest=$tqs[$kk];
                }
          }

          if($showquest>0)
          {
            $quest=rpg_getquestobj($showquest);
            echo "<table border=0><tr><td>$qic</td><td><a href=rpg_main.php?action=quest&npc=$npc->id&quest=$quest->id&loc=$loc>$quest->name</a></td></tr></table>";
          }
          else
          {
            echo "<table border=0><tr><td>&nbsp;</td><td>&nbsp;</td></tr></table>";
          }


          echo "</td>";
          $ln++;
          if($ln>5) {$ln=0; echo "</tr><tr>"; }
        }
        echo "</tr></table>";


		echo "<center><p>[<a href=rpg_main.php?action=leave&loc=$loc>leave</a>]</p></center>\n";
	}

	else
	{

		// do battle

		if($data->rpg_encounter=="yes")
		{
			if($action=="flee") // hmm did the player flee the monsters?
			{
				$action="";

				// 80% chance to flee, should make it dynamic formula

				if(rand(1,100)>20) 
				{
					echo "<p>You flee the battle!</p>\n";
					rpg_clearencounter(); // remove the encounter from the encounter table, and clear the rpg_encounter var
				}
				else
				    echo "<p>You tried to flee the battle but could not...</p>\n";
			}

			$encobj=rpg_getencdata();

			// 24;5;8;14;0;14;0|
			// 18;5;10;37;0;37;0|
			// 25;10;34;141;0;141;0

			$moblist=explode("|",$encobj->data);
			$nummobs=count($moblist);
			
			if($moblist[0]=="encounter")
			{
				$id=$moblist[1];
				$res=dm_query("select * from rpg_encounter where `id`='$id'");
				$enc=mysql_fetch_object($res);

				inform(stripslashes($enc->name));

				if(empty($enc->image)) $enc->image="nofile.gif";
				echo "<br><center><img src=\"images/$enc->image\"></center><br>";

				inform($enc->description);

				switch($enc->type)
				{
					case "puzzle_multiple_choice":

						echo "<center>";
						if(!empty($enc->puzzle_opt1))
						{	
							echo "<form action=rpg_main.php method=post><input type=hidden name=action value=encounterguess>";
							echo "<input type=hidden name=id value=$enc->id>";
							echo "<input type=hidden name=loc value=$loc>";
							echo "<input type=submit name=a1 value=\"$enc->puzzle_opt1\"></form><br>";

						}
						if(!empty($enc->puzzle_opt2))
						{
							echo "<form action=rpg_main.php method=post><input type=hidden name=action value=encounterguess>";
							echo "<input type=hidden name=id value=$enc->id>";
							echo "<input type=hidden name=loc value=$loc>";
							echo "<input type=submit name=a2 value=\"$enc->puzzle_opt2\"></form><br>";
						}
						if(!empty($enc->puzzle_opt3))
						{
							echo "<form action=rpg_main.php method=post><input type=hidden name=action value=encounterguess>";
							echo "<input type=hidden name=id value=$enc->id>";
							echo "<input type=hidden name=loc value=$loc>";
							echo "<input type=submit name=a3 value=\"$enc->puzzle_opt3\"></form><br>";
						}
						if(!empty($enc->puzzle_opt4))
						{
							echo "<form action=rpg_main.php method=post><input type=hidden name=action value=encounterguess>";
							echo "<input type=hidden name=id value=$enc->id>";
							echo "<input type=hidden name=loc value=$loc>";
							echo "<input type=submit name=a4 value=\"$enc->puzzle_opt4\"></form><br>";
						}

						echo "</center>";
						rpg_clearencounter();

						exit();

						break;

					case "puzzle_hidden_answer":

						echo "<form action=rpg_main.php method=post><input type=hidden name=action value=encounterguess>";
						echo "<input type=hidden name=id value=$enc->id>";
						echo "<input type=hidden name=loc value=$loc>";
						echo "<input name=a1>";
						echo "<input type=submit name=submit value=\"answer\"></form><br>";

						rpg_clearencounter();
						break;

					case "giver":

						rpg_clearencounter();

						break;

					case "trap":
									
						break;
					
					case "other":

						break;


				}
				

				echo "<a href=rpg_main.php>no thanks!</a>";

				rpg_clearencounter();
				exit();
			}
			else //its not an encounter type encounter; it is a fight encounter
			{

			
				if($encobj->data=="")
				{
					$battleover="yes";
				}
				else
				{
					$newencounter="";

					for($i=0;$i<$nummobs;$i++)
					{
						$mynatlist=explode(";",$moblist[$i]);
						$mynid    = $mynatlist[0];
						$mynlvl   = $mynatlist[1];
						$myndmg   = $mynatlist[2];
						$mynhp    = $mynatlist[3];
						$mynpow   = $mynatlist[4];
						$mynhpmax = $mynatlist[5];
						$mynpowmax= $mynatlist[6];
						//$thismobres=dm_query("select * from rpg_monsters where `id`='$mynid'");
						$thismob  = rpg_getmonsterobj($mynid);// mysql_fetch_object($thismobres);
						$isdead="no";

						
						if($dead!="yes")
						{
							if($i==0) // change this to "which mob to attack" instead of 0
							{
                              
							  
							  if($action=="useability")
							  {
								  // special ability attacks
								  
								  // echo "<p>$ability_damage</p>";

								  if(!empty($ability_damage))
								  {

									$act=rpg_getactionobj($ab->action);

									if($act->action=="hp_modify_enemy")
									{
										inform("$ab->name does $ability_damage damage");
										$mynhp+=$ability_damage;
									}

									if($act->action=="hp_leech_enemy")
									{
										inform("$ab->name leeches enemy health for $ability_damage - you are healed");
										$mynhp-=$ability_damage;
										rpg_addhp($ability_damage);										
									}

									if($act->action=="pow_modify_enemy")
									{
										inform("$ab->name reduces enemy's $ability_damage power");
										$mynpow+=$ability_damage;
									}

									if($act->action=="pow_leech_enemy")
									{
										inform("$ab->name leeches $ability_damage power");
										$mynpow-=$ability_damage;
										rpg_addpow($ability_damage);
			     					}


								  }
							  }
						


							
							  // attack using equipped weapon
	
							  if($action=="attack")
							  {
									$gatak=rpg_getlootobj($data->rpg_slot_mainhand);
									$weapdmg=rand($gatak->damage,$gatak->damage_high);
									$str=$data->rpg_str+rpg_getmodified("str");
									$thisheredmg=($str/3)+$weapdmg;
                                                        $crit="hit";
									$agl=$data->rpg_agl+rpg_getmodified("agl");
									if($agl>rand(1,100))
									{
										$crit="<span class=dm_crit>critically strike</span>";
										$thisheredmg=$thisheredmg*2;
									}
									$mynhp=intval(round(floatval($mynhp)) - round(floatval($thisheredmg)));
									inform("You $crit $thismob->name for ".round(floatval($thisheredmg)));
								}

								if($mynhp<=0)
								{
									$mynhp=0; $exp=$mynlvl*16;
									inform("You have slain $thismob->name!");
									if(($mynlvl>=$data->rpg_level) || (($data->rpg_level>$mynlvl)& (abs($mynlvl-$data->rpg_level)<6)) )
									{
										inform("You gain $exp experience.");
										rpg_expgain($exp);
										rpg_refresh("charpane","rpg_character.php");
									}
									$isdead="yes";
									
									///////////////////////////////////////////////////
									//check current quests for monsters to kill
									///////////////////////////////////////////////////
									
									rpg_update_current_quest_kills($thismob->id,1);

									///////////////////////////////////////////////////
									//check here for loot
									///////////////////////////////////////////////////
									
									rpg_getloot($thismob->loot_table);
									rpg_worldloot($mynlvl);
									rpg_refresh("right","rpg_rightpane.php");

									if($nummobs==1)
										$battleover="yes";
								}
							}
						}

						if($dead!="yes")
						if($isdead=="no")
						{
							if($newencounter=="")
								$newencounter="$thismob->id;$mynlvl;$myndmg;$mynhp;$mynpow;$mynhpmax;$mynpowmax";
							else
								$newencounter="$newencounter|$thismob->id;$mynlvl;$myndmg;$mynhp;$mynpow;$mynhpmax;$mynpowmax";

							if($_REQUEST['mobatk']=="no")  { }
							else
							{
								$mobdmg=rand($thismob->dmg_low,	$thismob->dmg_high);

								$def=$data->rpg_def+rpg_getmodified("def");
								$agl=$data->rpg_agl+rpg_getmodified("agl");

								// check to see if hit (based on level)
								$hit="no";
								if($data->rpg_level>$mynlvl)
								{
									$rang=abs($data->rpg_level-$mynlvl);
									$tc=100-$rang;
									$hc=rand(1,($tc));
									//echo "rang[$rang] tc[$tc] hc[$hc] agl[$agl]";
									if($hc>$agl) $hit="yes";
									
								}
								else
								{
									$rang=abs($data->rpg_level-$mynlvl);
									$hc=rand($rang,100+$rang);
									//echo "rang[$rang] hc[$hc] agl[$agl]";
									if($hc>$agl) $hit="yes";
								}

								if($hit=="yes")
								{
									$deflect=($def/10);
									$deflect=rand(1,$deflect);
									$mobdmg-=$deflect;
									if($mobdmg<0) $mobdmg=0;
									inform2("$thismob->name hits you for $mobdmg. ($deflect deflected) ");
									$data->rpg_hp=$data->rpg_hp-$mobdmg;
									rpg_setvar("rpg_hp",$data->rpg_hp);
									rpg_refresh("charpane","rpg_character.php");
								}
								else
								{
									inform("$thismob->name misses");
								}

								if($data->rpg_hp<1)
								{
									// you are dead
									$battleover=="yes";
									$dead="yes";
								}
							}
						}
					}
				
			
			
					if( ($battleover=="yes") || ($dead=="yes") )
					{
						rpg_clearencounter();
						if($dead!="yes") 
						{
							inform("You are victorious in battle.");
							echo "<br>";
							echo "[<a href=\"rpg_main.php?action=seek&loc=$loc\">adventure again</a>]";
							echo "[<a href=rpg_main.php?loc=$loc>continue</a>]"; 
							
						}
						else 
						{
							echo "<br>";
						    inform("You were defeated in battle.");
							echo "<br>";
							echo " [<a href=rpg_main.php?action=death>continue</a>]";
							if(stristr($data->rpg_base,"bed"))
							{
								echo " [<a href=rpg_profile.php?action=rest>rest at base (1 AP)</a>]";
							}
						}
					}
					else
					{
  						rpg_setencounter($newencounter);
	                   // show the monsters

						$encobj=rpg_getencdata();

						$moblist=explode("|",$encobj->data);
						$nummobs=count($moblist);
						echo "<br>";
						echo "<table border=0 width=100%><tr><td background=\"images/backdrop_".$locinfo->name.".gif\">";
						echo "$locinfo->name";

                        echo "<table class=dm_base><tr>";
						for($i=0;$i<$nummobs;$i++)
						{
							$mynatlist=explode(";",$moblist[$i]);
							$mynid    = $mynatlist[0];
							$mylvl	  = $mynatlist[1];
							$mynhp    = $mynatlist[3];
							$mynhpmax = $mynatlist[5];
							$thismob  = rpg_getmonsterobj($mynid);

							if(!empty($thismob->image))
							{
								echo "<td>";
								if(empty($thismob->image)) $thismob->image="nofile.gif";
								echo"<img src=\"images/$thismob->image\" alt=\"$thismob->name\" title=\"$thismob->name\" width=128 height=128><br>";
								$mname="Level $mylvl $thismob->name";
								rpg_bordertop($mname,5);
								echo "<table width=130><tr><td>";
								echo rpg_bar($mynhp,$mynhpmax,128);
								echo "</td></tr></table>\n";
								rpg_borderbot(5);
								echo "</td>";
							}
						}
						echo "</tr></table>\n";
						echo "</td></tr></table>";


						echo "<p>What will you do? [<a href=rpg_main.php?action=flee>Flee</a>] [<a href=rpg_main.php?action=attack&loc=$loc>Attack</a>]</p>\n";
						rpg_showabilities();
				
					}
				}
			}
		}
		else
		{

			// if($action!="death")

			if($action=="seek")
			{
				rpg_setvar("rpg_lastaction",$loc);
				$newencounter="";

				$result=dm_query("select * from rpg_map where location='$loc'");
				$locinfo=mysql_fetch_object($result);

				if($locinfo->ap>0)
				{

					if($data->rpg_ap<$locinfo->ap)
					{
						inform("Oh man.. Not enough Action points for that area!");
						
						exit;
					}

					$data->rpg_ap=$data->rpg_ap-$locinfo->ap;
					if($data->rpg_ap<=0) $data->rpg_ap=0;
					rpg_setvar("rpg_ap",$data->rpg_ap);
					rpg_refresh("charpane","rpg_character.php");
				}


				// to do: giver, trap, puzzle, quest, treasure, info

				if(rtrim($locinfo->encounter_list)=="")
				{

				}

				else
				{
					// there is an encounter list for this map tile
					// determine if there is an encounter

					$enc=explode("|",$locinfo->encounter_list);
					$numencs=count($enc);

					for($i=0;$i<$numencs;$i++)
					{
						$encs=explode(";",$enc[$i]);
						$encid		= $encs[0];
						$encpercent	= $encs[1];

						if(rand(0,100)<$encpercent)
						{
							$encid=$encs[0];						
							$encob=dm_query("select * from rpg_encounter where `id`='$encid'");
							$encobj=mysql_fetch_object($encob);

							$newencounter="encounter|$encobj->id";
							rpg_setencounter($newencounter);
							rpg_loadpanel("rpg_main.php?loc=$loc");
							exit();
						}

					}


				}

				if(rtrim($locinfo->moblist)=="") 
				{

				}

				else
				{
					// There is a mob list for this map tile
					// determine if here is a mob encounter (fight)

					$nadded=0;

					$mobs=explode("|",$locinfo->moblist);
					$nummobs=count($mobs);

					for($i=0;$i<$nummobs;$i++)
					{
						$thismob=explode(";",$mobs[$i]);
						$mobid		= $thismob[0];
						$mobpercent	= $thismob[1];

						$mobob=dm_query("select * from rpg_monsters where `id`='$mobid'");
						$mobobj=mysql_fetch_object($mobob);

						if($mobobj->group<2) $mobobj->group=1;

						if(rand(0,100)<$mobpercent)
						{
							$numadd=1;

							//if($mobobj->group>1) $numadd=rand(1,$mobobj->group);
							//$nadded+=numadd;
							//if($nadded<4) 
							//{
							
								for($y=0;$y<$numadd;$y++)
								{
									$madlvl=rand($mobobj->level_low,$mobobj->level_high);
									$maddmg=rand($mobobj->dmg_low,$mobobj->dmg_high);
									$madhp=rand($mobobj->hp,$mobobj->hp_max);
									$madpow=rand($mobobj->pow_low,$mobobj->pow_high);
									
									//	echo "<p>A level $madlvl $mobobj->name with $madhp hit points, $madpow power, and dealing $maddmg damage added to encounter.</p>\n";
									if($newencounter=="")
										$newencounter="$mobobj->id;$madlvl;$maddmg;$madhp;$madpow;$madhp;$madpow";
									else
										$newencounter="$newencounter|$mobobj->id;$madlvl;$maddmg;$madhp;$madpow;$madhp;$madpow";
								}
							//}
						}

			
					}

					if(rtrim($newencounter)=="")
					{

					}
					else
					{
						rpg_setencounter($newencounter);
						rpg_loadpanel("rpg_main.php?loc=$loc");
						exit();
						
					}
				}
				
			}
		
			$locinfo=rpg_getmapobj($loc);
			$dirs=explode(",",$locinfo->exits);

			$vendor="no";
			for($i=0;$i<count($dirs);$i++)
			{
				if($dirs[$i]=="vendor")
				{
					$vendor="yes";
				}
			}

			//vendor

			if( ($vendor=="yes") & ($action=="vendor") )
			{
				echo "<center><br>[<a href=rpg_main.php?loc=$loc>leave vendor</a>]</center><br>";
				echo "<center><p>".stripslashes($locinfo->name)."</p>\n";
				$vendman=rpg_getvendorobj($locinfo->data);

				echo "<p>".stripslashes($vendman->name)."<br>";
				echo "<img src=\"images/$vendman->image\" width=128 height=128>";
				// .imgn("images/$vendman->image",$vendman->name).
				echo "</p>\n";
				echo "<p>".stripslashes($vendman->description)."</p>\n";

				$hark=rpg_getloottable($vendman->inventory);

				$vlist=explode("|",$hark->data); //$vendman->inventory);

				rpg_bordertop(" ","4");

				echo "<table class=td_base cellpadding=25 >";

				$rw=0;

				echo "<tr>";
				
				for($i=0;$i<count($vlist);$i++)
				{
					$vit=explode(";",$vlist[$i]);
					if($vit!="")
					{
						$tvit=rpg_getlootobj($vit[0]);
						$tvit->name=stripslashes($tvit->name);
						$tvit->description=stripslashes($tvit->description);					

						echo "<td align=center cellpadding=5>";

						echo rpg_itemlink($tvit->id,"000000");

						$cost=$tvit->sell_value*5;
						echo "<br><font color=#ff9900>";
						echo rpg_money_format($cost);
						echo "<br>";
						echo "[<a href=\"rpg_main.php?action=buyitem&loc=$loc&item=$tvit->id\">purchase</a>]";
						echo "</td>\n";

						$rw++; if($rw==4){ $rw=0; echo "</tr><tr>"; }
					}
				}
				echo "</tr>";
				echo "</table>";

				rpg_borderbot("4");

				rpg_refresh("right","rpg_rightpane.php?vendor=yes&loc=$loc");

				echo "<center><br>[<a href=rpg_main.php?loc=$loc>leave vendor</a>]</center>";

				
				for($i=0;$i<4;$i++) echo "<p>&nbsp;</p>";

			}
			else
			{
                            $wm="what";
                            if($action=="worldmap") $wm="yes";
                            echo "<center>";
                            echo "<table border=0><tr><td>map size</td><td><a href=rpg_main.php?action=increasemapsize&wm=$wm&loc=$loc><img src=images/plus.gif border=0></a></td><td>";
                            echo "<a href=rpg_main.php?action=decreasemapsize&wm=$wm&loc=$loc><img src=images/minus-2.gif border=0></a></td></tr></table>";

				//worldmap

				if($action=="worldmap") $data->rpg_z="-1";

				if($data->rpg_z=="-1")
				{
					$z="-1";

					echo "<center>";

					echo "<table border=0 cellspacing=0 cellpadding=0>";
					echo "<tr><td><img src=images/world-water-top-left.gif border=\"0\" width=\"$data->rpg_mapsize\"></td><td>";

					echo "<table border=0 cellspacing=0 cellpadding=0><tr>";
					for($yi=0;$yi<11;$yi++)
					{
						echo "<td><img src=images/world-water-top.gif border=\"0\" width=\"$data->rpg_mapsize\"></td>";
					}
					echo "</tr></table></td>";

					echo "<td><img src=images/world-water-top-right.gif border=\"0\" width=\"$data->rpg_mapsize\"></td></tr>";

					echo "<tr><td>";
					for($yi=0;$yi<7;$yi++)
					{
						echo "<img src=images/world-water-left.gif border=\"0\" width=\"$data->rpg_mapsize\"><br>";
					}
					echo "</td><td>";

					echo "<table cellspacing=0 cellpadding=0 border=0>";

					for($y=0;$y<7;$y++)
					{
						echo "<tr>";
						for($x=0;$x<11;$x++)
						{
							$gloc="$x,$y,-1";
							$getter=dm_query("select * from rpg_map where location='$gloc'");
							$glocinfo=mysql_fetch_object($getter);
							$gimg=$glocinfo->image;
							if($gimg=="") $gimg="world-blank.gif";


							echo "<td>";

							$glocinfo->name=stripslashes($glocinfo->name);
							$glocinfo->description=stripslashes($glocinfo->description);
							if(empty($glocinfo->description)) $glocinfo->description="Nothing here";

							$desc="$glocinfo->name<br>";
							$desc.=$glocinfo->description;


							if($glocinfo->hidden=="yes")
							{
								$see_crit=explode("|",$glocinfo->see_criteria);
								for($yi=0;$yi<count($see_crit);$yi++)
								{
									$see_crits=explode("=",$see_crit[$yi]);

									if($see_crits[0]=="access")if($see_crits[1]==$data->access) $glocinfo->hidden="no";
									if($see_crits[0]=="level") if($see_crits[1]<=$data->rpg_level) $glocinfo->hidden="no";
								}
							}

							if($glocinfo->hidden=="yes")
                                                        {
                                                          $glocinfo->name=null;
                                                          if(empty($glocinfo->hid_image)) $gimg="map_plains.gif";
                                                          else                            $gimg=$glocinfo->hid_image;
                                                        }


							if(!empty($glocinfo->name))
							{
                                                             $worldmap="worldmap";
                                                             if(($y<4) & ($x<6)) $worldmap="worldmap_top_left";
                                                             if(($y<4) & ($x>5)) $worldmap="worldmap_top_right";
                                                             if(($y>3) & ($x<6)) $worldmap="worldmap_bot_left";
                                                             if(($y>3) & ($x>5)) $worldmap="worldmap_bot_right";

    							     echo "<a class=\"$worldmap\" href=\"rpg_main.php?action=worldmapgo&loc=$x,$y,$z\"{\"#ffffff\"} border=0> ";
    							     echo "<span><font color=\"#000000\">$desc</span>";
							}
							if(empty($gimg)) $gimg="world-blank.gif";
							echo "<img src=\"images/$gimg\" border=\"0\" width=\"$data->rpg_mapsize\">";
							if(!empty($glocinfo->name))
							{
							echo "</a>";
							}



							echo "</td>\n";


						}

						echo "</tr>";

					}
					echo "</table>";


					echo "</td><td>";
					for($yi=0;$yi<7;$yi++)
					{
						echo "<img src=images/world-water-right.gif border=\"0\" width=\"$data->rpg_mapsize\"><br>";
					}
					echo "</td></tr>";


					echo "<tr><td><img src=images/world-water-bot-left.gif border=\"0\" width=\"$data->rpg_mapsize\"></td><td>";

					echo "<table border=0 cellspacing=0 cellpadding=0><tr>";
					for($yi=0;$yi<11;$yi++)
					{
						echo "<td><img src=images/world-water-bot.gif border=\"0\" width=\"$data->rpg_mapsize\"></td>";
					}
					echo "</tr></table></td>";


					echo "<td><img src=images/world-water-bot-right.gif border=\"0\" width=\"$data->rpg_mapsize\"></td></tr>";

					echo "</table>";

				}

				else
				{

					//map zoomed in

					echo "<center><table cellspacing=0 cellpadding=0>\n";
					$z=$data->rpg_z;
					for($y=-3;$y<4;$y++)
					{
						echo"<tr>\n";
						for($x=-5;$x<6;$x++)
						{
							$gloc="$x,$y,$data->rpg_z";
							$getter=dm_query("select * from rpg_map where location='$gloc'");
							$glocinfo=mysql_fetch_object($getter);
							$gimg=$glocinfo->image;

							$wact="";

							$dirs=explode(",",$glocinfo->exits);

							$vendor="no";
							for($i=0;$i<count($dirs);$i++)
							{
								if($dirs[$i]=="vendor")
								{
									$vendor="yes";
									$wact="vendor";
								}
								if( (!empty($glocinfo->moblist)) ||
									(!empty($glocinfo->encounter_list)) )
								{
									$wact="seek";
								}
								if($dirs[$i]=="enter")
								{
									$wact="enter";
								}
								if($dirs[$i]=="school")
								{
									$wact="school";
								}
								if($dirs[$i]=="mapportal")
                                                                {
                                                                    $wact="worldmapgo";
                                                                }

							}

							$nloc="$x,$y,$z";
								
							$glocinfo->name=stripslashes($glocinfo->name);
							$glocinfo->description=stripslashes($glocinfo->description);
							if(empty($glocinfo->description)) $glocinfo->description="Nothing here";

							if($glocinfo->ap>0) 
							{
								$glocinfo->description.="<br><br><font class\"dm_warning\">($glocinfo->ap) AP";
							}

							$desc="$glocinfo->name<br>";
							$desc.=$glocinfo->description;

							echo "<td>";

							if($glocinfo->hidden=="yes")
							{
								$see_crit=explode("|",$glocinfo->see_criteria);
								for($yi=0;$yi<count($see_crit);$yi++)
								{
									$see_crits=explode("=",$see_crit[$yi]);

									if($see_crits[0]=="access") if($see_crits[1]==$data->access)   $glocinfo->hidden="no";
									if($see_crits[0]=="level") if($see_crits[1]<=$data->rpg_level) $glocinfo->hidden="no";
								}
							}

							if($glocinfo->hidden=="yes")
                                                        {
                                                          $glocinfo->name=null;
                                                          if(empty($glocinfo->hid_image)) $gimg="map_plains.gif";
                                                          else                            $gimg=$glocinfo->hid_image;
                                                        }

							if(!empty($glocinfo->name)) echo "<a class=\"worldmap\" href=\"rpg_main.php?action=$wact&loc=$nloc\"{\"#ffffff\"} border=0> <span><font color=\"#000000\">$desc</span>";
							if(empty($gimg)) $gimg="map_plains.gif";
							echo "<img src=\"images/$gimg\" border=\"0\" width=\"$data->rpg_mapsize\">";
							if(!empty($glocinfo->name)) echo "</a>";

							echo "</td>\n";
						}
						echo "</tr>\n";
					}
					echo "</table></center>\n";

					echo "<center>\n";
					
					echo "<br>[<a href=rpg_main.php?action=worldmap>world map</a>]\n";
					echo "</center>\n";

				}

			}
		}
	}

}
else
{
	rpg_refresh("top","char_create.php");
}


include("rpg_footer.php");
?>

