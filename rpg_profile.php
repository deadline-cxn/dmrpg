<?
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////

include("rpg_header.php");
$data=getuserdata($HTTP_SESSION_VARS['valid_user']);
if(empty($id)) $id=$data->id;
if($HTTP_SESSION_VARS["logged_in"]!="true") { rpg_showlogin(); include("rpg_footer.php"); exit(); }

function drawtower($text)
{
        if(empty($text)) echo "<img src=images/base_empty.gif>";
        else
        {
            switch($text)
            {
                         case "tower_foundation":
                              echo "<img src=images/base_tower_empty.gif >";
                              break;

                         case "tower_guns_1":
                              echo "<img src=images/base_tower_guns1.gif >";
                              break;
                         
                         default:
                          echo "<img src=images/base_empty.gif>";
                          break;

            }
        }
}

if($action=="show_password_form")
{
    echo "<table border=0><form action=rpg_profile.php method=post>\n<input type=hidden name=asparagus value=withcheese><tr><td>Current Password</td><td><input type=password name=pass1></td></tr>\n";
    echo "<tr><td>New Password</td><td><input type=password name=pass2></td></tr>\n<tr><td>New Password (again)</td><td><input type=password name=pass3></td></tr>\n";
    echo "<tr><td>&nbsp;</td><td><input type=submit name=submit value=\"Go!\"></td></tr>\n</form></table>\n";
    exit();
}

if($asparagus == "withcheese")
{
    echo "<h1>Change password...</h1>\n"; if(empty($data->name)) { echo smiles(":X")."error!\n"; exit(); }
    if( $pass1 != $data->pass ) echo smiles(":X")."You did not enter the correct current password!<br>\n";
    else    { if($pass2==$pass3) { dm_query("update users set pass='$pass2' where name = '$data->name'"); echo "Password changed!<br>\n"; }       
              else echo smiles(":X")."The passwords do not match!<br>\n"; }
    echo "Click <a href=rpg_profile.php>here</a> to continue!\n";    exit;
}

if(empty($email)) $email=$data->email;
$email=str_replace("'at'","@",$email);
$thisemail=str_replace("@","$at",$email);
$enteremail=str_replace("@","'at'",$email);
if($action=="update")
{
    echo "<h1>Profile Update</h1>\n";
    if(!empty($name)) dm_query("UPDATE users SET real_name='$name' where name = '$data->name'");
    if(!empty($sentence))    {        $sentence=addslashes($sentence); $result = dm_query("UPDATE users SET sentence='$sentence' where name = '$data->name'");    }
    dm_query("UPDATE users SET `email`='$email' where `name` = '$data->name'");
    if(!empty($webpage)) dm_query("UPDATE users SET webpage='$webpage' where name = '$data->name'");
    if(!empty($avatar))  dm_query("UPDATE users SET avatar='$avatar' where name = '$data->name'");
    if(!empty($country)) dm_query("UPDATE users SET country='$country' where name = '$data->name'");
    dm_query("UPDATE users SET icq='$icq' where name = '$data->name'");
    dm_query("UPDATE users SET msn='$msn' where name = '$data->name'");
    dm_query("UPDATE users SET yahoo='$yahoo' where name = '$data->name'");
    dm_query("UPDATE users SET aim='$aim' where name = '$data->name'");

	dm_query("UPDATE users SET rpg_emails='$rpg_emails' where name = '$data->name'");
    if(!empty($show_contact_info)) dm_query("UPDATE users SET show_contact_info='$show_contact_info' where name = '$data->name'");
    if(!empty($show_flash)) dm_query("UPDATE users SET show_flash='$show_flash' where name = '$data->name'");
    if((!empty($birth_year))&&(!empty($birth_day))&&(!empty($birth_month)) )
    {   $der  = $birth_year."-"; $birth_month=ltrim($birth_month,"0"); if($birth_month<10) $der .= "0"; $der .= $birth_month."-"; $birth_day=ltrim($birth_day,"0"); if($birth_month<10) $der .= "0"; $der .= $birth_day." 01:01:01";
        dm_query("UPDATE users SET birthday='$der' where name = '$data->name'");
    }
    echo "Profile updated... Click <a href=rpg_profile.php>here</a> to continue!\n";
    rpg_reload();
    exit;
}

if($action=="edit")
{
	echo "<table border=0> <form method=post action=rpg_profile.php><tr><td>\n<input type=hidden name=action value=update>\n<table border=0>\n";
	echo "<tr><td>Real Name :</td><td> <input type=textbox name=name size=30 value=\"$data->real_name\"> </td><td>&nbsp;</td></tr>\n";
	list($adate,$atime)=explode(" ",$data->birthday); $bdate=date("Y-m-d"); list($tyear,$tmonth,$tday)=explode("-",$adate); list($byear,$bmonth,$bday)=explode("-",$bdate);
	$years  = ($byear-$tyear); if($tmonth<10) $nmonth=$month_name[$tmonth[1]]; $nmonth = $month_name[intval($tmonth)];
	echo "<tr><td>Birthday:</td>\n<td>\n";
	echo "<select name=birth_month>\n<option value=$tmonth>$nmonth<option value=1>Jan\n<option value=2>Feb\n<option value=3>Mar\n<option value=4>Apr\n<option value=5>May\n<option value=6>Jun\n<option value=7>Jul\n<option value=8>Aug\n<option value=9>Sep\n<option value=10>Oct\n<option value=11>Nov\n<option value=12>Dec\n</select>\n";
	echo "<select name=birth_day>\n";	echo "<option>$tday\n";	$i=1; while($i<32)	{	if($i<10) echo "<option>0$i";else echo "<option>$i"; $i=$i+1;	}	echo "</select>";
	echo "<select name=birth_year>\n";	echo "<option>$tyear\n";	$i=1201; while($i<5432) { echo "<option>$i"; $i=$i+1; } echo "</select>";	//echo "</td><td>-> (<i>$years this year!</i>) </td></tr>\n";
	echo "<tr><td>Country   :</td><td> <select name=country><option>$data->country\n"; include("countries.php"); echo "</select> </td><td>&nbsp;</td></tr>\n";
	echo "<tr><td>Quote     :</td><td> <textarea name=sentence rows=6 cols=45>$data->sentence</textarea>    </td><td>&nbsp;</td></tr>\n";
    if($data->rpg_emails=="") $data->rpg_emails="no";
	echo "<tr><td>Receive DM Emails:</td><td><select name=rpg_emails><option>$data->rpg_emails<option>yes<option>no</td><td>&nbsp;</td></tr>\n";
	echo "<tr><td>Email     :</td><td> <input type=textbox name=email    size=45 value=\"$data->email\">         </td><td>&nbsp;</td></tr>\n";
	echo "<tr><td>Webpage   :</td><td> <input type=textbox name=webpage  size=45 value=\"$data->webpage\">       </td><td> <a href=$data->webpage target=_blank><img src=$locate/images/wp.gif  border=0 alt=\"Visit this person's website!\" title=\"Visit this person's website!\" height=16> </a></td></tr>\n";
	echo "<tr><td>ICQ       :</td><td> <input type=textbox name=icq      size=45 value=\"$data->icq\">       </td><td> <img src=$locate/images/icq.gif height=16>   </td></tr>\n";
	echo "<tr><td>MSN       :</td><td> <input type=textbox name=msn      size=45 value=\"$data->msn\">       </td><td> <img src=$locate/images/msn.gif height=16>   </td></tr>\n";
	echo "<tr><td>Yahoo     :</td><td> <input type=textbox name=yahoo    size=45 value=\"$data->yahoo\">       </td><td> <img src=$locate/images/yahoo.gif height=16> </td></tr>\n";
	echo "<tr><td>AIM       :</td><td> <input type=textbox name=aim      size=45 value=\"$data->aim\">       </td><td> <img src=$locate/images/aim.gif height=16>   </td></tr>\n";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>\n<tr><td>Show Contact Info:</td><td><select name=show_contact_info>\n";
	if($data->show_contact_info=="yes") echo "<option>yes<option>no"; else echo "<option>no<option>yes";
    echo "</select></td><td>&nbsp;</td></tr>\n<tr><td>flash (experimental mode)</td><td><select name=show_flash>";
	if($data->show_flash=="yes") echo "<option>yes<option>no"; else echo "<option>no<option>yes</select>";
    echo "</td><td>&nbsp;</td></tr>\n<tr><td align=right>Update</td><td class=\"dm_select_pic\">\n<input type=submit name=\"update\" value=\"Go!\">\n";
	echo "</td><td>&nbsp;</td></tr>\n</table> </td></tr></form></table>\n";	exit();
}

if($action=="configure_abilities")
{
  echo "<h1>Configure Abilities</h1>";

 exit;
}

if($action=="bank")
{
  if(stristr($data->rpg_base,"bank"))
  {
    echo "<p>Bank</p>";
    echo "[<a href=rpg_profile.php?action=bankdeposit>Deposit</a>]";
    echo "[<a href=rpg_profile.php?action=bankwithdraw>Withdraw</a>]";
  }
  else
  {
    inform("You don't have a bank in your base.");
  }
}

if($action=="bankdeposit")
{
	echo "<p>Deposit into your bank. No one can take anything in your bank.</p>";
}

if($action=="bankwithdraw")
{
	if(empty($data->rpg_bank))
	{
		echo "<p>There are no items in your bank.</p>";
	}
	else
	{

	}
	if(empty($data->rpg_bankcash)) $data->rpg_bankcash="0";
	echo "<p>You have ".rpg_money_format($data->rpg_bankcash)." cash in your bank.</p>";
}

if($action=="rest")
{
	if(stristr($data->rpg_base,"bed"))
	{
		if($data->rpg_ap<1)
		{
			echo "Oh man.. Not enough Action points to rest!";			
		}
		else
		{
			$data->rpg_ap=$data->rpg_ap-1;
			if($data->rpg_ap<=0) $data->rpg_ap=0;
			rpg_setvar("rpg_ap",$data->rpg_ap);
			rpg_setvar("rpg_hp",$data->rpg_hpmax);
			rpg_setvar("rpg_pow",$data->rpg_powmax);
			rpg_refresh("charpane","rpg_character.php");
			echo "You have rested.";
		}
	}
	else
	{
		echo "You can't rest here. There is no bed!";
	}
}

if($action=="sidekick")
{
  if(stristr($data->rpg_base,"sidekick_generator"))
  {
	echo "<p>There is nothing in the sidekick generator.</p>";
  }
}

if($action=="trinket_panel")
{
  if(stristr($data->rpg_base,"trinket_panel"))
  {
  }
}

if($action=="trophy_case")
{
  if(stristr($data->rpg_base,"trophy_case"))
  {
  }
}

if($action=="henchmen_generator")
{
    if(stristr($data->rpg_base,"henchmen_generator"))
    {
          $hml=$data->rpg_henchleaders*1000;
      if( ($hml) > $data->rpg_henchmen)
      {
        if($data->rpg_ap>15)
        {
          $data->rpg_ap-=15;
          rpg_setvar("rpg_ap",$data->rpg_ap);
          inform("You currently have $data->rpg_henchmen henchmen");
          $hm=rand(1,200);

          if( ($hm+$data->rpg_henchmen) > ($hml) )
          {
            $hm=$hml-$data->rpg_henchmen;
          }
          inform("The henchmen generator produces $hm henchmen");
          $data->rpg_henchmen+=$hm;
          inform("New number of henchmen: $data->rpg_henchmen");
          rpg_setvar("rpg_henchmen",$data->rpg_henchmen);
  		rpg_refresh("charpane","rpg_character.php");
        }
        else
        {
          inform("You do not have enough action points for that.");
        }
      }
      else
      {
        inform("You don't have enough henchmen leaders for that.");
      }
    }

}

if($action=="henchleader_generator")
{
    if(stristr($data->rpg_base,"henchleader_generator"))
    {
      if($data->rpg_ap>35)
      {
        $data->rpg_ap-=35;
        rpg_setvar("rpg_ap",$data->rpg_ap);
        inform("You currently have $data->rpg_henchleaders henchmen leaders");
        $hm=rand(1,5);
        inform("The henchmen leader generator produces $hm henchmen leaders");
        $data->rpg_henchleaders+=$hm;
        inform("New number of henchmen leaders: $data->rpg_henchleaders");
        rpg_setvar("rpg_henchleaders",$data->rpg_henchleaders);
		rpg_refresh("charpane","rpg_character.php");
      }
      else
      {
        inform("You do not have enough action points for that.");
      }
    }

}
if($action=="dropquest")
{
  rpg_remove_current_quest($quest);
  $action="quest_log";
}

if($action=="quest_log")
{
  if(!empty($data->rpg_quests_current))
  {
    inform("Quests you are on:");
    echo "<table border=0>";
    $tt=explode(",",$data->rpg_quests_current);
    for($op=0;$op<count($tt);$op++) // format is QUEST#:MONSTER#;NUMKILLED#|MONSTER#;NUMKILLED,QUEST#:MONSTER#;NUMKILLED
    {
       $tr=explode(":",$tt[$op]);
       $que=rpg_getquestobj($tr[0]);
       if(!empty($que->name))
       {
         echo "<tr><td>[<a href=rpg_profile.php?action=dropquest&quest=$que->id>drop quest</a>]</td>";
         echo "<td>$que->name </td></tr>";
       }
    }
    echo "</table>";
  }
  if(!empty($data->rpg_quests_completed))
  {
    inform("Quests you have completed:");
    $tq=explode(",",$data->rpg_quests_completed);

    echo "<table border=0>";
    for($i=0;$i<count($tq);$i++)
    {
        $que=rpg_getquestobj($tq[$i]);
        echo "<tr><td>$que->name </td></tr>";
    }
    echo "</table>";
  }

}


if($action=="turnofftut")
{
	rpg_setvar("rpg_tutorial","no");
	rpg_refresh("mainpane","rpg_profile.php");
}
if($action=="turnontut")
{
	rpg_setvar("rpg_tutorial","yes");
	rpg_refresh("mainpane","rpg_profile.php");
}

if($data->rpg=="yes")
{
	if($data->rpg_tutorial=="yes")
	{
		inform("Tutorial: This is your base. You can add to your base by finding in game items.");
		inform("Tutorial: If you haven't done so already you should use your base seed from your inventory to get your base started.");
		inform("Tutorial: Your inventory is to the right.");
		inform("Tutorial: Then you should use your base bed kit.");
		inform("Tutorial: Once you have set up your bed you can rest at your base and it will restore your Will to Live.");
		inform("Tutorial: You can turn off tutorial mode from your base.");
	}

	$user=getuserdata($id);

	echo "<h1>$user->rpg_name's Base</h1>";

	if(!empty($user->rpg_base))
	{
		//echo $user->rpg_base;
		$basestuff=explode("|",$user->rpg_base);
		sort($basestuff);
		reset($basestuff);

		echo "<table border=0 cellspacing=0 cellpadding=0><tr><td>";

        drawtower($user->rpg_base_tower1);

		echo "</td><td>";
		echo "<img src=images/base_empty.gif>";
		echo "<img src=images/base_empty.gif>";
		echo "<img src=images/base_empty.gif>";
		echo "<img src=images/base_empty.gif>";
		echo "<img src=images/base_empty.gif>";
		echo "<img src=images/base_empty.gif>";
		echo "<img src=images/base_empty.gif>";
		echo "<img src=images/base_empty.gif>";
		echo "<img src=images/base_empty.gif>";
		
		echo "</td><td>";

        drawtower($user->rpg_base_tower2);

		echo "</td></tr>";

		echo "<tr><td>";

		echo "<img src=images/base_empty.gif><br>";
		echo "<img src=images/base_empty.gif><br>";
		echo "<img src=images/base_empty_door.gif><br>";
		echo "<img src=images/base_empty.gif><br>";
		echo "<img src=images/base_empty.gif><br>";

		echo "</td><td>";

		if(count($basestuff)>1)
		{
			echo "<table border=0 cellpadding=0 cellspacing=0 width=100% height=320><tr><td background=images/base_empty.gif>";
			echo "<table border=0 cellpadding=0 cellspacing=0 width=100%><tr>";

            $lnk="<";
    		if($id==$data->id) $lnk="<a href=rpg_profile.php?action=";

			$lc=0;

			for($i=0;$i<count($basestuff);$i++)
			{
				if($lc>5) { $lc=0; echo "</tr><tr>"; }
				switch($basestuff[$i])
				{
					case "bank":
						echo "<td background=images/base_empty.gif><center>";
						$link=$lnk."bank>";
   						echo $link."<img src=images/base_bank.gif width=64 height=64 border=0></a>";
        				echo "<br>[".$link."Bank</a>]</td>";
						$lc++;

						break;

					case "bed":
						echo "<td background=images/base_empty.gif><center>";
						$link=$lnk."rest>";
                        echo $link."<img src=images/base_bed.gif width=64 height=64 border=0></a>";
                        echo "<br>[".$link."Bed (1 AP)</a>]</td>";
						$lc++;

						break;

					case "sidekick_generator":
						echo "<td background=images/base_empty.gif><center>";
						$link=$lnk."sidekick>";
                        echo $link."<img src=images/base_skgenerator.gif width=64 height=64 border=0></a>";
						echo "<br>[".$link."Sidekick Generator</a>]</td>";
						$lc++;

						break;

					case "sidekick_stable":
						echo "<td background=images/base_empty.gif><center>";
						$link=$lnk."sidekick_stable>";
						echo $link."<img src=images/base_skstable.gif width=64 height=64 border=0></a>";
						echo "<br>[".$link."Sidekick Stable</a>]</td>";
						$lc++;

						break;

					case "mailbox":
						echo "<td background=images/base_empty.gif><center>";
						if($id==$data->id) $link="<a href=pmsg.php>"; else $link="<mailbox>";
						echo $link."<img src=images/base_mailbox.gif width=64 height=64 border=0></a>";
						echo "<br>[".$link."Mailbox</a>]</td>";
						$lc++;

						break;

					case "auction_counter":
						echo "<td background=images/base_empty.gif><center>";
						if($id==$data->id) $link="<a href=rpg_auction.php>"; else $link="<auxion>";
						echo $link."<img src=images/base_auction_counter.gif width=64 height=64 border=0></a><br>";
                        echo "[".$link."Auction Robot</a>]</td>";
						$lc++;

						break;

					case "trinket_panel":
						echo "<td background=images/base_empty.gif><center>";
						$link=$lnk."trinket_panel>";
						echo $link."<img src=images/base_trinket_panel.gif width=64 height=64 border=0></a><br>";
						echo "[".$link."Trinket Panel</a>]</td>";
						$lc++;

						break;

					case "trophy_case":
						echo "<td background=images/base_empty.gif><center>";
						$link=$lnk."trophy_case>";
						echo $link."<img src=images/base_trophy_case.gif width=64 height=64 border=0></a><br>";
						echo "[".$link."Trophy Case</a>]</td>";
						$lc++;

						break;

					case "henchmen_generator":
						echo "<td background=images/base_empty.gif><center>";
						$link=$lnk."henchmen_generator>";
						echo $link."<img src=images/base_henchmen_generator.gif width=64 height=64 border=0></a><br>";
						echo "[".$link."Henchmen <br>Generator <br>(15 AP)</a>]";
						if($data->id==$id) echo "<br>($data->rpg_henchmen henchmen)";
						echo "</td>";
						$lc++;

						break;

					case "henchleader_generator":
						echo "<td background=images/base_empty.gif><center>";
						$link=$lnk."henchleader_generator>";
						echo $link."<img src=images/base_henchleader_generator.gif width=64 height=64 border=0></a><br>";
						echo "[".$link."Henchmen <br>Leader <br>Generator <br>(35 AP)</a>]";
						if($data->id==$id) echo "<br>($data->rpg_henchleaders henchmen leaders)";
						echo "</td>";
						$lc++;

						break;
						
					case "quest_log":
						echo "<td background=images/base_empty.gif><center>";
						$link=$lnk."quest_log>";
						echo $link."<img src=images/base_log.gif width=64 height=64 border=0></a><br>";
						echo "[".$link."Quest Log</a>]";
						echo "</td>";
						$lc++;

						break;

				}
			}
				echo "</tr></table>";
				echo "</td></tr></table>";



		}
		else
		{
			inform("No base upgrades have been installed.<br> Bases can be upgraded by finding, crafting or buying devices.<br>Your bed is a device.");
		}


			echo "</td><td>";
			echo "<img src=images/base_empty.gif><br>";
			echo "<img src=images/base_empty.gif><br>";
			echo "<img src=images/base_empty.gif><br>";
			echo "<img src=images/base_empty.gif><br>";
			echo "<img src=images/base_empty.gif><br>";
			echo "</td></tr>";
			echo "<tr><td>";

            drawtower($user->rpg_base_tower3);

			echo "</td><td>";

			echo "<img src=images/base_empty.gif>";
			echo "<img src=images/base_empty.gif>";
			echo "<img src=images/base_empty.gif>";
			echo "<img src=images/base_empty.gif>";
			echo "<img src=images/base_empty.gif>";
			echo "<img src=images/base_empty.gif>";
			echo "<img src=images/base_empty.gif>";
			echo "<img src=images/base_empty.gif>";
			echo "<img src=images/base_empty.gif>";
			echo "</td><td>";

            drawtower($user->rpg_base_tower4);

			echo "</td></tr>";
			echo "</table>";
	}
	else
	{
		inform("No base has been started");
	}

	if($id==$data->id)
	{
		echo "[<a href=\"rpg_profile.php?action=edit\">Edit Your Profile</a>] ";
		echo "[<a href=\"rpg_profile.php?action=show_password_form\">Change Your Password</a>] ";
		echo "[<a href=delete_char.php target=mainpane class=td_red>Delete character</a>] ";
		if($data->rpg_tutorial=="yes")
			echo "[<a href=rpg_profile.php?action=turnofftut>Turn off tutorial mode</a>]";
		else
			echo "[<a href=rpg_profile.php?action=turnontut>Turn on tutorial mode</a>]";
		echo "<br><br>";
	}


	$fres=dm_query("select * from rpg_classes where id=$user->rpg_class");
	$class=mysql_fetch_object($fres);

	echo "<table border=0><tr><td valign=top>";
	echo "<img src=\"images/$class->image\" alt=\"$class->image\"><br>Level $user->rpg_level<br>$class->name <br>";
	echo "</td><td valign=top>";

	echo "<table border=0>";

	$class=rpg_getclassobj($user->rpg_class);

	echo "<tr><td>XP</td><td>$user->rpg_exp</td></tr>";
    echo "<tr><td>XP Total</td><td>$user->rpg_totalexp</td></tr>";

	echo "<tr><td>Will to Live</td><td>$user->rpg_hp / $user->rpg_hpmax</td></tr>";

	echo "<tr><td>Motivation</td><td>$user->rpg_pow / $user->rpg_powmax</td></tr>";
	
	echo "</table>";

    echo "</td><td valign=top>";
    
    echo "<table border=0>";

	echo "<tr><td>Intimidation</td><td>$user->rpg_str</td></tr>";
	echo "<tr><td>Syllogism</td><td>$user->rpg_int</td></tr>";
	echo "<tr><td>Non-Fatness</td><td>$user->rpg_agl</td></tr>";
	echo "<tr><td>Callousness</td><td>$user->rpg_def</td></tr>";

	echo "</table>";

    echo "</td><td valign=top>";
    
    echo "<table border=0>";

	echo "<tr><td>Karma</td><td>$user->karma</td></tr>";

	echo "<tr><td>Cash</td><td>".rpg_money_format($user->rpg_cash)."</td></tr>";

	echo "<tr><td>PvP Battles Won</td><td>$user->rpg_pvp_won</td></tr>";
	echo "<tr><td>PvP Battles Lost</td><td>$user->rpg_pvp_lost</td></tr>";
	
	echo "</table>";

    echo "</td><td valign=top>";
    
    echo "<table border=0>";

	echo "<tr><td>Forum Posts</td><td>$user->forumposts</td></tr>";
	echo "<tr><td>Forum Replies</td><td>$user->forumreplies</td></tr>";

	echo "</table>";

    echo "</td><td valign=top>";

    echo "<table border=0>";

	if($user->show_contact_info=="yes")
	{
		echo "<tr><td>Real Name</td><td>$user->real_name</td></tr>";
		echo "<tr><td>Country</td><td>$user->country</td></tr>";
		echo "<tr><td>Gender</td><td>$user->gender</td></tr>";
		echo "<tr><td>Birthday</td><td>$user->birthday</td></tr>";
		echo "<tr><td>Email Address</td><td>$user->email</td></tr>";
		if(!empty($user->icq)) echo "<tr><td>ICQ ID</td><td>$user->icq</td></tr>";
		if(!empty($user->yahoo)) echo "<tr><td>Yahoo Messenger ID</td><td>$user->yahoo</td></tr>";
		if(!empty($user->msn)) echo "<tr><td>MSN Messenger ID</td><td>$user->msn</td></tr>";
		if(!empty($user->aim)) echo "<tr><td>AIM ID</td><td>$user->aim</td></tr>";
		if(!empty($user->irc_server)) echo "<tr><td>IRC Server</td><td>$user->irc_server</td></tr>";
		if(!empty($user->irc_channel)) echo "<tr><td>IRC Channel</td><td>$user->irc_channel</td></tr>";
		if(!empty($user->webpage)) echo "<tr><td>Personal Website</td><td>$user->webpage</td></tr>";
		if(!empty($user->website_fav)) echo "<tr><td>Favorite Website</td><td>$user->website_fav</td></tr>";
	}
	echo "<tr><td>Quote</td><td>$user->sentence</td></tr>";
	

	echo "</table>";

    echo "</td><td valign=top>";

    echo "<table border=0>";
	echo "<tr><td>First Login</td><td>$user->first_login</td></tr>";
	echo "<tr><td>Last Activity</td><td>$user->last_activity</td></tr>";
	echo "<tr><td>Last Login</td><td>$user->last_login</td></tr>";


	echo "</table>";



	echo "</td></tr></table>";


	//////////////////////////////////////////////////////////////////////////////////



}
else
{
	echo "<p>Create a character first!</p>\n";
}


include("rpg_footer.php");
?>

