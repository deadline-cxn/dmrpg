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


     
if($data->access<255)
{
	echo "<p>You don't have access to build!</p>\n";
}
else
{
    echo "<table border=0><tr><td valign=top width=80>";
	echo "<h1>Editors</h1>";

	echo "[<a href=rpg_build.php?action=abilities>Abilities</a>] <br>";
   	echo "[<a href=rpg_build.php?action=actions>Actions</a>] <br>";
	echo "[<a href=rpg_build.php?action=class>Classes</a>] <br>";
	echo "[<a href=rpg_build.php?action=craft>Crafts</a>] <br>";
    echo "[<a href=rpg_build.php?action=encounter>Encounters</a>] <br>";
    echo "[<a href=rpg_build.php?action=item>Items</a>] <br>";
    echo "[<a href=rpg_build.php?action=loot>Loot Tables</a>] <br>";
	echo "[<a href=rpg_build.php?action=monster>Monsters</a>] <br>";
	echo "[<a href=rpg_build.php?action=npc>NPC's</a>] <br>";
    echo "[<a href=rpg_build.php?action=quest>Quests</a>] <br>";
	echo "[<a href=rpg_build.php?action=recipe>Recipes</a>] <br>";
	echo "[<a href=rpg_build.php?action=vendor>Vendors</a>] <br>";
	echo "<hr>";
	echo "[<a href=rpg_build.php?action=users>Users</a>] <br>";
    echo "<hr>";
	echo "[<a href=rpg_build.php?action=map>Map</a>] <br>";
	echo "[<a href=rpg_build.php?action=worldmap>World Map</a>] <br>";
	echo "<hr>";
	echo "[<a href=adm.php>Admin Panel</a>] <br>";
	echo "[<a href=adm.php?action=viewlog>View Log</a>] <br>";
	echo "<hr>";
    echo "[<a href=rpg_auto_weekly.php>Week Mtc</a>] <br>";
	echo "[<a href=rpg_auto_nightly.php>Night Mtc</a>] <br>";
	echo "<hr>";
	echo "[<a href=rpg_test.php>Test Flash</a>] <br>";
	echo "<hr>";


   echo "</td><td valign=top>";

    //Craft

	if($action=="craftedgo")
	{
		echo "<h1>Edit Craft [$name]</h1>";
		$name=addslashes($name);
		$description=addslashes($description);
        $skill_99=addslashes($skill_99);
        $skill_199=addslashes($skill_199);
        $skill_299=addslashes($skill_299);
        $skill_399=addslashes($skill_399);
        $skill_499=addslashes($skill_499);
        $skill_500=addslashes($skill_500);

		dm_query("update rpg_crafts set `name`='$name' where `id`='$id'");
		dm_query("update rpg_crafts set `image`='$image' where `id`='$id'");
		dm_query("update rpg_crafts set `description`='$description' where `id`='$id'");
		dm_query("update rpg_crafts set `required_tools`='$required_tools' where `id`='$id'");
		dm_query("update rpg_crafts set `required_base`='$required_base' where `id`='$id'");
		dm_query("update rpg_crafts set `skill_99`='$skill_99' where `id`='$id'");
		dm_query("update rpg_crafts set `skill_199`='$skill_199' where `id`='$id'");
		dm_query("update rpg_crafts set `skill_299`='$skill_299' where `id`='$id'");
		dm_query("update rpg_crafts set `skill_399`='$skill_399' where `id`='$id'");
		dm_query("update rpg_crafts set `skill_499`='$skill_499' where `id`='$id'");
		dm_query("update rpg_crafts set `skill_500`='$skill_500' where `id`='$id'");

		$action="craft";
	}


	if( ($action=="crafted") || ($action=="craftadd") )
	{
        if($action=="craftadd")
        {
            echo "<h1>New Craft</h1>";
    		dm_query("INSERT INTO `rpg_crafts` ( `name`, `image`) VALUES ('unnamed', 'nopic.gif');");
    		$qr=dm_query("select * from rpg_crafts where `name`='unnamed'");
    		$enc=mysql_fetch_object($qr);
    		$id=$enc->id;
        }
		$rq=dm_query("select * from rpg_crafts where `id`='$id'");
		$tq=mysql_fetch_object($rq);
		$tq->name=stripslashes($tq->name);
		$tq->description=stripslashes($tq->description);

        if($action=="crafted")
        {
            echo "<h1>Edit Craft [$tq->name]</h1>";
        }
		echo "<img src=\"images/$tq->image\">";

		echo "<table class=dm_base><tr><td valign=top>";

		echo "<table class=dm_base>";
		echo "<form action=rpg_build.php method=post><input type=hidden name=action value=craftedgo><input type=hidden name=id value=$id>";

		echo "<tr><td>Name</td><td><input type=textbox name=name size=50 value=\"$tq->name\"></td></tr>";

		echo "<tr><td>Image</td> <td><select name=image>";
		echo "<option>$tq->image";
		$dirfiles=rpg_getdir("./images/");
		while(list ($key, $file) = each ($dirfiles)) if(stristr($file,"craft_")) echo "<option>$file";
		echo "</select></td></tr>\n";

		echo "<tr><td>Description</td><td><textarea name=description cols=40>$tq->description</textarea></td></tr>";
		
		echo "<tr><td>Skill Subname 1-99</td><td><input type=textbox name=skill_99 size=50 value=\"$tq->skill_99\"></td></tr>";
		echo "<tr><td>Skill Subname 100-199</td><td><input type=textbox name=skill_199 size=50 value=\"$tq->skill_199\"></td></tr>";
		echo "<tr><td>Skill Subname 200-299</td><td><input type=textbox name=skill_299 size=50 value=\"$tq->skill_299\"></td></tr>";
		echo "<tr><td>Skill Subname 300-399</td><td><input type=textbox name=skill_399 size=50 value=\"$tq->skill_399\"></td></tr>";
		echo "<tr><td>Skill Subname 400-499</td><td><input type=textbox name=skill_499 size=50 value=\"$tq->skill_499\"></td></tr>";
     	echo "<tr><td>Skill Subname 500</td><td><input type=textbox name=skill_500 size=50 value=\"$tq->skill_500\"></td></tr>";

		echo "<tr><td>Required Tools</td><td><select name=required_tools><option>$tq->required_tools<option>0";
		$ract=dm_query("select * from rpg_loot_table order by `id`"); $nact=mysql_num_rows($ract);
		for($i=0;$i<$nact;$i++) { $tact=mysql_fetch_object($ract); echo "<option>$tact->id"; }
		echo "</select></td></tr>";


		echo "<tr><td>&nbsp;</td><td><input type=submit name=Go value=Go></td></tr>";
		echo "</form>";
		echo "</table>";

		echo "</td><td valign=top>";

		echo "<p class=dm_warning>Image Files:</p>";

		echo "<table class=dm_base>\n";

			$dirfiles=rpg_getdir("./images/");
			while(list ($key, $file) = each ($dirfiles)) if(stristr($file,"craft_")) echo "<tr><td><img src=\"images/$file\" alt=\"$file\" title=\"$file\" width=64 height=64><br>$file</td></tr>";
			
		echo "</table>\n";

		echo "</td><td valign=top>";

		echo "<p class=dm_warning>Loot Tables:</p>";
		
		$result=dm_query("select * from rpg_loot_table order by `id`");
		$numitems=mysql_num_rows($result);
		echo "<table class=dm_base><tr><td>[<a href=\"rpg_build.php?action=lootadd\">add new loot table</a>]</td></tr></table>";
		echo "<table class=dm_base>\n";
		for($i=0;$i<$numitems;$i++)
		{
			$loot=mysql_fetch_object($result);
			echo "<tr>";
			echo "<td>[<a href=\"rpg_build.php?action=looted&id=$loot->id\">edit</a>]</td>\n";

			echo "<td>ID: $loot->id</td>";

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
		}
		echo "</table>";			

		
		echo"</td></tr></table>";
		exit();
	}


    if($action=="craft")
    {
		echo "<h1>Edit Crafts</h1>";
     // techniker     - makes computer hardware
     // hackling      - makes software upgrades for computers
     // squishologist - makes things by squishing other things together like potions
     // armamentary   - makes weapons
     // armorentary   - makes armor
     // enhancifier   - makes improvements to things that can be equipped
     // macgyverist   - makes crazy things out of seemingly useless or unrelated objects

     // id
     // name
     // description
     // image
     // required_tools (loot_table)
     // required_base
     // skill_99
     // skill_199
     // skill_299
     // skill_399
     // skill_499
     // skill_500

     $res=dm_query("select * from rpg_crafts");
     $num=mysql_num_rows($res);
     

     echo "<table border=0><tr><td>[<a href=rpg_build.php?action=craftadd>Add new craft</a>]</td></tr></table>";
     echo "<table border=0>";

     for($i=0;$i<$num;$i++)
     {
         $craft=mysql_fetch_object($res);
         $craft->name=stripslashes($craft->name);
         $craft->description=stripslashes($craft->description);
         echo "<tr>";
         echo "<td>[<a href=rpg_build.php?action=crafted&id=$craft->id>edit</a>]</td>";
         echo "<td><img src=images/$craft->image border=0 size=32></td>";
         echo "<td>$craft->name </td>";
         echo "<td>$craft->description</td>";
         echo "</tr>";
     }
     echo "</table>";

    }

    //Recipes

	if($action=="recipeedgo")
	{
		echo "<h1>Edit Recipe [$name]</h1>";
		$name=addslashes($name);
		$description=addslashes($description);

		dm_query("update rpg_craft_recipes set `craft_id`='$craft_id' where `id`='$id'");
		dm_query("update rpg_craft_recipes set `name`='$name' where `id`='$id'");
		dm_query("update rpg_craft_recipes set `description`='$description' where `id`='$id'");
		dm_query("update rpg_craft_recipes set `image`='$image' where `id`='$id'");

		dm_query("update rpg_craft_recipes set `recipe_skill`='$recipe_skill' where `id`='$id'");
		dm_query("update rpg_craft_recipes set `skill_required`='$skill_required' where `id`='$id'");

		dm_query("update rpg_craft_recipes set `craft_mats`='$craft_mats' where `id`='$id'");
		dm_query("update rpg_craft_recipes set `created_items`='$created_items' where `id`='$id'");

		$action="recipe";
	}

	if( ($action=="recipeed") || ($action=="recipeadd") )
	{
        if($action=="recipeadd")
        {
            echo "<h1>New Recipe</h1>";
    		dm_query("INSERT INTO `rpg_craft_recipes` ( `name`, `image`) VALUES ('unnamed', 'nopic.gif');");
    		$qr=dm_query("select * from rpg_craft_recipes where `name`='unnamed'");
    		$enc=mysql_fetch_object($qr);
    		$id=$enc->id;
        }
		$rq=dm_query("select * from rpg_craft_recipes where `id`='$id'");
		$tq=mysql_fetch_object($rq);
		$tq->name=stripslashes($tq->name);
		$tq->description=stripslashes($tq->description);

        if($action=="recipeed")
        {
            echo "<h1>Edit Recipe [$tq->name]</h1>";
        }
		echo "<img src=\"images/$tq->image\">";

		echo "<table class=dm_base><tr><td valign=top>";

		echo "<table class=dm_base>";
		echo "<form action=rpg_build.php method=post><input type=hidden name=action value=recipeedgo><input type=hidden name=id value=$id>";

		echo "<tr><td>Name</td><td><input type=textbox name=name size=50 value=\"$tq->name\"></td></tr>";

		echo "<tr><td>Profession</td><td><select name=craft_id>";
		$craftr=dm_query("select * from rpg_crafts where `id`='$tq->craft_id'");
		$craft=mysql_fetch_object($craftr);
		echo "<option value=$craft->id>$craft->name";
		$craftr=dm_query("select * from rpg_crafts");
		$ncrafs=mysql_num_rows($craftr);
		for($i=0;$i<$ncrafs;$i++)
		{
          $craft=mysql_fetch_object($craftr);
          echo "<option value=$craft->id>$craft->name";
        }

		echo "</select></td></tr>";

		echo "<tr><td>Image</td> <td><select name=image>";
		echo "<option>$tq->image";
		$dirfiles=rpg_getdir("./images/");
		while(list ($key, $file) = each ($dirfiles)) if(stristr($file,"item_")) echo "<option>$file";
		echo "</select></td></tr>\n";

		echo "<tr><td>Description</td><td><textarea name=description cols=40>$tq->description</textarea></td></tr>";


		echo "<tr><td>Craft Materials</td><td><select name=craft_mats><option>$tq->craft_mats<option>0";
		$ract=dm_query("select * from rpg_loot_table order by `id`"); $nact=mysql_num_rows($ract);
		for($i=0;$i<$nact;$i++) { $tact=mysql_fetch_object($ract); echo "<option>$tact->id"; }
		echo "</select></td></tr>";

		echo "<tr><td>Created Items</td><td><select name=created_items><option>$tq->created_items<option>0";
		$ract=dm_query("select * from rpg_loot_table order by `id`"); $nact=mysql_num_rows($ract);
		for($i=0;$i<$nact;$i++) { $tact=mysql_fetch_object($ract); echo "<option>$tact->id"; }
		echo "</select></td></tr>";
		
		echo "<tr><td>Recipe Skill</td><td><input name=recipe_skill value=$tq->recipe_skill></td></tr>";

    	echo "<tr><td>Required Skill</td><td><input name=skill_required value=$tq->skill_required></td></tr>";


		echo "<tr><td>&nbsp;</td><td><input type=submit name=Go value=Go></td></tr>";
		echo "</form>";
		echo "</table>";

		echo "</td><td valign=top>";

		echo "<p class=dm_warning>Image Files:</p>";

		echo "<table class=dm_base>\n";

			$dirfiles=rpg_getdir("./images/");
			while(list ($key, $file) = each ($dirfiles)) if(stristr($file,"item_")) echo "<tr><td><img src=\"images/$file\" alt=\"$file\" title=\"$file\" width=64 height=64><br>$file</td></tr>";
			
		echo "</table>\n";

		echo "</td><td valign=top>";

		echo "<p class=dm_warning>Loot Tables:</p>";
		
		$result=dm_query("select * from rpg_loot_table order by `id`");
		$numitems=mysql_num_rows($result);
		echo "<table class=dm_base><tr><td>[<a href=\"rpg_build.php?action=lootadd\">add new loot table</a>]</td></tr></table>";
		echo "<table class=dm_base>\n";
		for($i=0;$i<$numitems;$i++)
		{
			$loot=mysql_fetch_object($result);
			echo "<tr>";
			echo "<td>[<a href=\"rpg_build.php?action=looted&id=$loot->id\">edit</a>]</td>\n";

			echo "<td>ID: $loot->id</td>";

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
		}
		echo "</table>";


		echo"</td></tr></table>";
		exit();
	}


    if($action=="recipe")
    {
		echo "<h1>Edit Recipes</h1>";

     $res=dm_query("select * from rpg_craft_recipes");
     $num=mysql_num_rows($res);

     echo "<table border=0><tr><td>[<a href=rpg_build.php?action=recipeadd>Add new recipe</a>]</td></tr></table>";
     echo "<table border=0>";

     for($i=0;$i<$num;$i++)
     {
         $recipe=mysql_fetch_object($res);
         $recipe->name=stripslashes($recipe->name);
         $recipe->description=stripslashes($recipe->description);

    /*
    id
	craft_id
	name
	description
	image
	recipe_skill
	skill_required
	craft_mats
	created_items
    */
         echo "<tr>";
         echo "<td>[<a href=rpg_build.php?action=recipeed&id=$recipe->id>edit</a>]</td>";
         $crr=dm_query("select * from rpg_crafts where `id`='$recipe->craft_id'");
         $craft=mysql_fetch_object($crr);
         echo "<td><img src=images/$craft->image border=0 width=32 height=32></td><td> -&gt; </td>";
         echo "<td><img src=images/$recipe->image border=0 width=32 height=32></td>";
         echo "<td>$recipe->name </td>";
         echo "<td>$recipe->recipe_skill / $recipe->skill_required</td>";
         echo "<td>$recipe->description</td>";

		echo "<td>craft mats:</td>"; echo "<td>"; rpg_showloottable($recipe->craft_mats); echo "</td>";
		echo "<td>creates:</td>"; echo "<td>"; rpg_showloottable($recipe->created_items); echo "</td>";


         echo "</tr>";
     }
     echo "</table>";

    }

    //Encounter

	if($action=="encounteredgo")
	{
		echo "<h1>Edit Encounter [$name]</h1>";
		$name=addslashes($name);
		$description=addslashes($description);
		$finishtext=addslashes($finishtext);
		$unfinishtext=addslashes($unfinishtext);
		dm_query("update rpg_encounter set `name`='$name' where `id`='$id'");
		dm_query("update rpg_encounter set `image`='$image' where `id`='$id'");
		dm_query("update rpg_encounter set `type`='$type' where `id`='$id'");
		dm_query("update rpg_encounter set `description`='$description' where `id`='$id'");
		dm_query("update rpg_encounter set `repeatable`='$repeatable' where `id`='$id'");
		dm_query("update rpg_encounter set `required_level`='$required_level' where `id`='$id'");
		dm_query("update rpg_encounter set `requires_loot`='$requires_loot' where `id`='$id'");
		dm_query("update rpg_encounter set `gives_loot`='$gives_loot' where `id`='$id'");
		dm_query("update rpg_encounter set `reqlootamt`='$reqlootamt' where `id`='$id'");
		dm_query("update rpg_encounter set `trigaction`='$trigaction' where `id`='$id'");
		$finishtext=addslashes($finishtext);
		dm_query("update rpg_encounter set `finishtext`='$finishtext' where `name`='$name'");
		$unfinishtext=addslashes($unfinishtext);
		dm_query("update rpg_encounter set `unfinishtext`='$unfinishtext' where `name`='$name'");
		$puzzle_opt1=addslashes($puzzle_opt1);
		dm_query("update rpg_encounter set `puzzle_opt1`='$puzzle_opt1' where `name`='$name'");
		$puzzle_opt2=addslashes($puzzle_opt2);
		dm_query("update rpg_encounter set `puzzle_opt2`='$puzzle_opt2' where `name`='$name'");
		$puzzle_opt3=addslashes($puzzle_opt3);
		dm_query("update rpg_encounter set `puzzle_opt3`='$puzzle_opt3' where `name`='$name'");
		$puzzle_opt4=addslashes($puzzle_opt4);
		dm_query("update rpg_encounter set `puzzle_opt4`='$puzzle_opt4' where `name`='$name'");
		$puzzle_answer=addslashes($puzzle_answer);
		dm_query("update rpg_encounter set `puzzle_answer`='$puzzle_answer' where `name`='$name'");
		$action="encounter";
	}

	if( ($action=="encountered") || ($action=="encounteradd") )
	{
        if($action=="encounteradd")
        {
            echo "<h1>New Encounter</h1>";
    		dm_query("INSERT INTO `rpg_encounter` ( `name`, `image`) VALUES ('unnamed', 'nopic.gif');");
    		$qr=dm_query("select * from rpg_encounter where `name`='unnamed'");
    		$enc=mysql_fetch_object($qr);
    		$id=$enc->id;
        }
		$rq=dm_query("select * from rpg_encounter where `id`='$id'");
		$tq=mysql_fetch_object($rq);
		$tq->name=stripslashes($tq->name);
		$tq->description=stripslashes($tq->description);

        if($action=="encountered")
        {
            echo "<h1>Edit Encounter [$tq->name]</h1>";
        }
		echo "<img src=\"images/$tq->image\">";

		echo "<table class=dm_base><tr><td valign=top>";

		echo "<table class=dm_base>";
		echo "<form action=rpg_build.php method=post><input type=hidden name=action value=encounteredgo><input type=hidden name=id value=$id>";
		
		echo "<tr><td>Name</td><td><input type=textbox name=name size=50 value=\"$tq->name\"></td></tr>";

		echo "<tr><td>Image</td> <td><select name=image>";
		echo "<option>$tq->image";
		$dirfiles=rpg_getdir("./images/");
		while(list ($key, $file) = each ($dirfiles)) if(stristr($file,".gif")) echo "<option>$file";
		echo "</select></td></tr>\n";	

		echo "<tr><td>Type</td><td>";
		echo "<select name=type>";
		echo "<option>$tq->type";
		echo "<option>puzzle_multiple_choice";
		echo "<option>puzzle_hidden_answer";
		echo "<option>giver";
		echo "<option>trap";
		echo "<option>other";
		echo "</select>";
		echo "</td></tr>";
		
		echo "<tr><td>Repeatable</td><td><select name=repeatable><option>$tq->repeatable<option>no<option>yes</select></td></tr>";

		echo "<tr><td>Req. Level</td><td><select name=required_level><option>$tq->required_level";
		for($i=1;$i<200;$i++) echo "<option>$i";
		echo "</select></td></tr>";

		$tq->unfinishtext=stripslashes($tq->unfinishtext);
		$tq->finishtext=stripslashes($tq->finishtext);

		
		echo "<tr><td>Encounter Start Text</td><td><textarea name=description cols=40>$tq->description</textarea></td></tr>";
		echo "<tr><td>Encounter Unfinished Text</td><td><textarea name=unfinishtext cols=40>$tq->unfinishtext</textarea></td></tr>";
		echo "<tr><td>Encounter Finished Text</td><td><textarea name=finishtext cols=40>$tq->finishtext</textarea></td></tr>";

		$tq->puzzle_opt1=stripslashes($tq->puzzle_opt1);
		$tq->puzzle_opt2=stripslashes($tq->puzzle_opt2);
		$tq->puzzle_opt3=stripslashes($tq->puzzle_opt3);
		$tq->puzzle_opt4=stripslashes($tq->puzzle_opt4);

		$tq->puzzle_answer=stripslashes($tq->puzzle_answer);
		echo "<tr><td>Puzzle Option 1</td><td><textarea name=puzzle_opt1 cols=40>$tq->puzzle_opt1</textarea></td></tr>";
		echo "<tr><td>Puzzle Option 2</td><td><textarea name=puzzle_opt2 cols=40>$tq->puzzle_opt2</textarea></td></tr>";
		echo "<tr><td>Puzzle Option 3</td><td><textarea name=puzzle_opt3 cols=40>$tq->puzzle_opt3</textarea></td></tr>";
		echo "<tr><td>Puzzle Option 4</td><td><textarea name=puzzle_opt4 cols=40>$tq->puzzle_opt4</textarea></td></tr>";

		echo "<tr><td>Puzzle Answer</td><td><select name=puzzle_answer><option>$tq->puzzle_answer";
		echo "<option>random";
		echo "<option>1";
		echo "<option>2";
		echo "<option>3";
		echo "<option>4";
		echo "</select></td></tr>";

		echo "<tr><td>Req. Loot</td><td><select name=requires_loot><option>$tq->requires_loot<option>0";
		$ract=dm_query("select * from rpg_loot_table order by `id`"); $nact=mysql_num_rows($ract);
		for($i=0;$i<$nact;$i++) { $tact=mysql_fetch_object($ract); echo "<option>$tact->id"; }
		echo "</select></td></tr>";

		echo "<tr><td>Req. Loot Amount</td><td><input name=reqlootamt value=$tq->reqlootamt></td></tr>";

		echo "<tr><td>Gives Loot</td><td><select name=gives_loot><option>$tq->gives_loot<option>0";
		$ract=dm_query("select * from rpg_loot_table order by `id`"); $nact=mysql_num_rows($ract);
		for($i=0;$i<$nact;$i++) { $tact=mysql_fetch_object($ract); echo "<option>$tact->id"; }
		echo "</select></td></tr>";

		echo "<tr><td>Triggers Action</td><td><select name=trigaction><option>$tq->trigaction<option>0";
		$ract=dm_query("select * from rpg_actions order by `id`"); $nact=mysql_num_rows($ract);
		for($i=0;$i<$nact;$i++) { $tact=mysql_fetch_object($ract); echo "<option>$tact->id"; }
		echo "</select></td></tr>";	

		echo "<tr><td>&nbsp;</td><td><input type=submit name=Go value=Go></td></tr>";
		echo "</form>";	
		echo "</table>";

		echo "</td><td valign=top>";		
	
		echo "<p class=dm_warning>Image Files:</p>";

		echo "<table class=dm_base>\n";

		$dirfiles=rpg_getdir("./images/");
		while(list ($key, $file) = each ($dirfiles))
        if(stristr($file,".gif"))
        echo "<tr><td><img src=\"images/$file\" alt=\"$file\" title=\"$file\" width=64 height=64><br>$file</td></tr>";
			
		echo "</table>\n";

		echo "</td><td valign=top>";

		echo "<p class=dm_warning>Loot Tables:</p>";
		
		$result=dm_query("select * from rpg_loot_table order by `id`");
		$numitems=mysql_num_rows($result);
		echo "<table class=dm_base><tr><td>[<a href=\"rpg_build.php?action=lootadd\">add new loot table</a>]</td></tr></table>";
		echo "<table class=dm_base>\n";
		for($i=0;$i<$numitems;$i++)
		{
			$loot=mysql_fetch_object($result);
			echo "<tr>";
			echo "<td>[<a href=\"rpg_build.php?action=looted&id=$loot->id\">edit</a>]</td>\n";

			echo "<td>ID: $loot->id</td>";

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
		}
		echo "</table>";			

		echo "</td><td valign=top>";
		echo "<p class=dm_warning>Actions:</p>";

		$ract=dm_query("select * from rpg_actions order by `action`,`value` asc"); $nact=mysql_num_rows($ract);
		for($i=0;$i<$nact;$i++) { $tact=mysql_fetch_object($ract); echo "$tact->id) $tact->action $tact->value<br>"; }
		
		echo"</td></tr></table>";
		exit();
	}

	if($action=="encounter")
	{
		echo "<h1>Encounter Editor</h1>";
		echo "<table class=dm_base>";
		echo "<tr><td>[<a href=rpg_build.php?action=encounteradd>add encounter</a>]</td><td></td></tr>";
		$rq=dm_query("select * from rpg_encounter");
		$nq=mysql_num_rows($rq);
		for($i=0;$i<$nq;$i++)
		{
			$tq=mysql_fetch_object($rq);
			echo "<tr>";
			echo "<td>[<a href=rpg_build.php?action=encountered&id=$tq->id>edit</a>]</td>";
			echo "<td>".stripslashes($tq->name)."</td>";
			echo "<td><img src=\"images/$tq->image\" width=64 height=64 border=0></td>";
			echo "<td>".dm_trunc(stripslashes($tq->description),10)."</td>";
			echo "<td>type[$tq->type]</td>";
			echo "<td>rq.lvl[$tq->required_level]</td>";
			echo "<td>rq.loot[$tq->requires_loot]x$tq->reqlootamt</td>";
			echo "<td>gives [$tq->gives_loot]</td>";
			echo "<td>triggers action [$tq->trigaction]</td>";
			echo "</tr>";
		}
		echo "</table>";
		exit();
	}

        //NPC

    if($action=="npcedgo")
    {
		echo "<h1>Edit NPC [$name] $id</h1>";
		$name=addslashes($name);
		dm_query("update rpg_npc set `name`='$name' where `id`='$id'");
		dm_query("update rpg_npc set `image`='$image' where `id`='$id'");
		dm_query("update rpg_npc set `loot`='$loot' where `id`='$id'");
		dm_query("update rpg_npc set `quest`='$quest' where `id`='$id'");
		$action="npc";

    }

    if( ($action=="npced") || ($action=="npcadd") )
    {
        if($action=="npcadd")
        {
            //insert unnamed npc
            dm_query("insert into rpg_npc (`name`,`image`) VALUES ('unnamed','nopic.gif');");
            $res=dm_query("select * from rpg_npc where `name`='unnamed'");
            $npc=mysql_fetch_object($res);
            $id=$npc->id;
    		echo "<h1>Add new NPC</h1>";
        }

        $npcr=dm_query("select * from rpg_npc where `id`='$id'");
        $npc=mysql_fetch_object($npcr);

        if($action=="npced")
        {
            echo "<h1>Edit NPC [$npc->name]</h1>";
        }
		echo "<table class=dm_base><tr><td valign=top>";

		echo "<table class=dm_base>";
		echo "<form action=rpg_build.php method=post><input type=hidden name=action value=npcedgo>";
		echo "<input type=hidden name=id value=$npc->id>";

		echo "<tr><td>Name</td><td><input type=textbox name=name value=\"$npc->name\" size=50></td></tr>";

		echo "<tr><td>Image</td> <td><select name=image><option>$npc->image";
		$dirfiles=rpg_getdir("./images/"); while(list ($key, $file) = each ($dirfiles)) if(stristr($file,"monster_")) echo "<option>$file";
		echo "</select></td></tr>\n";	
				
		echo "<tr><td>Loot</td><td><select name=loot><option>$npc->loot";
		$ract=dm_query("select * from rpg_loot_table"); $nact=mysql_num_rows($ract);
		for($i=0;$i<$nact;$i++) { $tact=mysql_fetch_object($ract); echo "<option>$tact->id"; }
		echo "</select></td></tr>";

		echo "<tr><td>Quest</td><td>";
		echo "<textarea name=quest cols=40 rows=6>$npc->quest</textarea>";

        echo "</td></tr>";

		echo "<tr><td>&nbsp;</td><td><input type=submit name=Go value=Go></td></tr>";
		echo "</form>";
		echo "</table>";

		echo "</td><td valign=top>";
		echo "<p class=dm_warning>Image Files:</p>";
		echo "<table class=dm_base>\n";

    	$dirfiles=rpg_getdir("./images/");
    	while(list ($key, $file) = each ($dirfiles)) if(stristr($file,"monster_")) echo "<tr><td>".imgs("images/$file",$file,64,64)."</td></tr>";

		echo "</table>\n";

		echo "</td><td valign=top>";

		echo "<p class=dm_warning>Loot Tables:</p>";
		
		$result=dm_query("select * from rpg_loot_table");
		$numitems=mysql_num_rows($result);
		echo "<table class=dm_base><tr><td>[<a href=\"rpg_build.php?action=lootadd\">add new loot table</a>]</td></tr></table>";
		echo "<table class=dm_base>\n";
		for($i=0;$i<$numitems;$i++)
		{
			$loot=mysql_fetch_object($result);
			echo "<tr>";
			echo "<td>[<a href=\"rpg_build.php?action=looted&id=$loot->id\">edit</a>]</td>\n";

			echo "<td>ID: $loot->id</td>";

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
		}
		echo "</table>";			
		
		echo "</td><td valign=top>";
		echo "<p class=dm_warning>Quests:</p>";
		$result=dm_query("select * from rpg_quest");
		$numitems=mysql_num_rows($result);
		echo "<table class=dm_base><tr><td>[<a href=\"rpg_build.php?action=questadd\">add new quest</a>]</td></tr></table>";
		echo "<table class=dm_base>\n";
		for($i=0;$i<$numitems;$i++)
		{
			$loot=mysql_fetch_object($result);
			echo "<tr>";
			echo "<td>[<a href=\"rpg_build.php?action=quested&id=$loot->id\">edit</a>]</td>\n";
			echo "<td>ID: $loot->id</td>";
			echo "<td>".stripslashes($loot->name);
			echo "</td>\n";
			echo"</tr>";
		}
		echo "</table>";
		echo"</td></tr></table>";
		exit();
	}

	if($action=="npc")
	{
		echo "<h1>NPC's</h1>";
		echo "<p>[<a href=rpg_build.php?action=npcadd>add new npc</a>]</p>";
		echo "<table class=dm_base>";
		$rn=dm_query("select * from rpg_npc order by `id`");
		$nn=mysql_num_rows($rn);
		for($i=0;$i<$nn;$i++)
		{
			$tn=mysql_fetch_object($rn);
			echo "<tr>";
			echo "<td>[<a href=rpg_build.php?action=npced&id=$tn->id>edit</a>]</td>";
			echo "<td>".stripslashes($tn->name)."</td>";
			echo "<td><img src=\"images/$tn->image\" width=64 height=64 border=0> </td>";
			echo "<td>loot [$tn->loot]</td>";
			echo "<td>quest [$tn->quest]</td>";
			echo "</tr>";
		}
		echo "</table>";
		exit();
	}

	//Quests

	if($action=="questedgo")
	{
		echo "<h1>Edit Quest [$name]</h1>";
		$name=addslashes($name);
		$description=addslashes($description);
		$finishtext=addslashes($finishtext);
		$unfinishtext=addslashes($unfinishtext);
        $question=addslashes($question);
        $answer_1=addslashes($answer_1);
        $answer_2=addslashes($answer_2);
        $answer_3=addslashes($answer_3);
        $answer_4=addslashes($answer_4);
        $correct_answer=addslashes($correct_answer);
        $accepttext=addslashes($accepttext);

		dm_query("update rpg_quest set `name`='$name' where `id`='$id'");
		dm_query("update rpg_quest set `description`='$description' where `id`='$id'");
		dm_query("update rpg_quest set `finishtext`='$finishtext' where `id`='$id'");
		dm_query("update rpg_quest set `unfinishtext`='$unfinishtext' where `id`='$id'");
		dm_query("update rpg_quest set `repeatable`='$repeatable' where `id`='$id'");
		dm_query("update rpg_quest set `required_level`='$required_level' where `id`='$id'");
		dm_query("update rpg_quest set `requires_loot`='$requires_loot' where `id`='$id'");
		dm_query("update rpg_quest set `gives_loot`='$gives_loot' where `id`='$id'");
		dm_query("update rpg_quest set `trigaction`='$trigaction' where `id`='$id'");
		dm_query("update rpg_quest set `prereq_quest`='$prereq_quest' where `id`='$id'");
		dm_query("update rpg_quest set `killmonsters`='$killmonsters' where `id`='$id'");


		dm_query("update rpg_quest set `question`='$question' where `id`='$id'");
		dm_query("update rpg_quest set `answer_1`='$answer_1' where `id`='$id'");
		dm_query("update rpg_quest set `answer_2`='$answer_2' where `id`='$id'");
		dm_query("update rpg_quest set `answer_3`='$answer_3' where `id`='$id'");
		dm_query("update rpg_quest set `answer_4`='$answer_4' where `id`='$id'");
        dm_query("update rpg_quest set `correct_answer`='$correct_answer' where `id`='$id'");
        
        dm_query("update rpg_quest set `accepttext`='$accepttext' where `id`='$id'");


		
		$action="quest";
	}

	if( ($action=="quested") || ($action=="questadd") )
	{
		if($action=="questadd")
		{
			dm_query("INSERT INTO `rpg_quest` ( `name` ) VALUES ( 'unnamed' )");
			$res=dm_query("select * from `rpg_quest` where `name`='unnamed'");
			$qu=mysql_fetch_object($res);
			$id=$qu->id;
		}

		$rq=dm_query("select * from rpg_quest where `id`='$id'");
		$tq=mysql_fetch_object($rq);
		$tq->name=stripslashes($tq->name);
		$tq->description=stripslashes($tq->description);

		if($action=="quested")
		{
			echo "<h1>Edit Quest [$tq->name]</h1>";
		}

		echo "<table class=dm_base><tr><td valign=top>";

		echo "<table class=dm_base>";
		echo "<form action=rpg_build.php method=post><input type=hidden name=action value=questedgo><input type=hidden name=id value=$id>";
		
		echo "<tr><td>Name</td><td><input type=textbox name=name size=50 value=\"$tq->name\"></td></tr>";
		
		echo "<tr><td>Repeatable</td><td><select name=repeatable><option>$tq->repeatable<option>no<option>yes</select></td></tr>";

		echo "<tr><td>Req. Level</td><td><select name=required_level><option>$tq->required_level";
		for($i=1;$i<200;$i++) echo "<option>$i";
		echo "</select></td></tr>";
		
		echo "<tr><td>Quest Start Text</td><td><textarea name=description cols=40>$tq->description</textarea></td></tr>";
		echo "<tr><td>Quest Unfinished Text</td><td><textarea name=unfinishtext cols=40>$tq->unfinishtext</textarea></td></tr>";
		echo "<tr><td>Quest Finished Text</td><td><textarea name=finishtext cols=40>$tq->finishtext</textarea></td></tr>";
		
		echo "<tr><td>Accept Text</td><td><textarea name=accepttext cols=40>$tq->accepttext</textarea></td></tr>";

		echo "<tr><td>Req. Loot</td><td><select name=requires_loot><option>$tq->requires_loot<option>0";
		$ract=dm_query("select * from rpg_loot_table"); $nact=mysql_num_rows($ract);
		for($i=0;$i<$nact;$i++) { $tact=mysql_fetch_object($ract); echo "<option>$tact->id"; }
		echo "</select></td></tr>";
		
		echo "<tr><td>Kill Monsters</td><td><textarea name=killmonsters cols=40>$tq->killmonsters</textarea></td></tr>";

		echo "<tr><td>Pre Requisite Quest</td><td><input name=prereq_quest value=$tq->prereq_quest></td></tr>";

		echo "<tr><td>Gives Loot</td><td><select name=gives_loot><option>$tq->gives_loot<option>0";
		$ract=dm_query("select * from rpg_loot_table"); $nact=mysql_num_rows($ract);
		for($i=0;$i<$nact;$i++) { $tact=mysql_fetch_object($ract); echo "<option>$tact->id"; }
		echo "</select></td></tr>";

		echo "<tr><td>Triggers Action</td><td><select name=trigaction><option>$tq->trigaction<option>0";
		$ract=dm_query("select * from rpg_actions"); $nact=mysql_num_rows($ract);
		for($i=0;$i<$nact;$i++) { $tact=mysql_fetch_object($ract); echo "<option>$tact->id"; }
		echo "</select></td></tr>";

		echo "<tr><td>Question</td><td><textarea name=question cols=40>$tq->question</textarea></td></tr>";
		echo "<tr><td>Answer 1</td><td><textarea name=answer_1 cols=40>$tq->answer_1</textarea></td></tr>";
		echo "<tr><td>Answer 2</td><td><textarea name=answer_2 cols=40>$tq->answer_2</textarea></td></tr>";
		echo "<tr><td>Answer 3</td><td><textarea name=answer_3 cols=40>$tq->answer_3</textarea></td></tr>";
		echo "<tr><td>Answer 4</td><td><textarea name=answer_4 cols=40>$tq->answer_4</textarea></td></tr>";
		echo "<tr><td>Correct Answer</td><td><textarea name=correct_answer cols=40>$tq->correct_answer</textarea></td></tr>";

		echo "<tr><td>&nbsp;</td><td><input type=submit name=Go value=Go></td></tr>";
		echo "</form>";	
		echo "</table>";

		echo "</td><td valign=top>";

		echo "<p class=dm_warning>Loot Tables:</p>";

		$result=dm_query("select * from rpg_loot_table");
		$numitems=mysql_num_rows($result);
		echo "<table class=dm_base><tr><td>[<a href=\"rpg_build.php?action=lootadd\">add new loot table</a>]</td></tr></table>";
		echo "<table class=dm_base>\n";
		for($i=0;$i<$numitems;$i++)
		{
			$loot=mysql_fetch_object($result);
			echo "<tr>";
			echo "<td>[<a href=\"rpg_build.php?action=looted&id=$loot->id\">edit</a>]</td>\n";

			echo "<td>ID: $loot->id</td>";

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
		}
		echo "</table>";			

		echo "</td><td valign=top>";
		echo "<p class=dm_warning>Actions:</p>";

		$ract=dm_query("select * from rpg_actions"); $nact=mysql_num_rows($ract);
		for($i=0;$i<$nact;$i++) { $tact=mysql_fetch_object($ract); echo "$tact->id) $tact->action $tact->value<br>"; }
		
		echo"</td></tr></table>";
		exit();
	}

	if($action=="quest")
	{
		echo "<h1>Quest Editor</h1>";
		echo "<table class=dm_base>";

		echo "<tr><td>[<a href=rpg_build.php?action=questadd>add quest</a>]</td><td></td></tr>";

		$rq=dm_query("select * from rpg_quest");
		$nq=mysql_num_rows($rq);
		for($i=0;$i<$nq;$i++)
		{
			$tq=mysql_fetch_object($rq);
			echo "<tr>";
			echo "<td>[<a href=rpg_build.php?action=quested&id=$tq->id>edit</a>]</td>";
			echo "<td>".stripslashes($tq->name)."</td>";
			echo "<td>".dm_trunc(stripslashes($tq->description),10)."</td>";
			echo "<td>rq.lvl[$tq->required_level]</td>";
			echo "<td>rq.loot[$tq->requires_loot]";
            echo "</td>";
			echo "<td>gives [$tq->gives_loot]</td>";
            $act=ltrim(str_replace("Use: ",", ",rpg_getactiontext($tq->trigaction)),",");
			echo "<td>triggers action [$tq->trigaction] $act</td>";
			echo "</tr>";
		}
		echo "</table>";
		exit();
	}

	//Maped

    if($action=="mappaint")        // Paint mode
    {
      $res=rpg_getmapobj($loc);
      if(empty($res))
      {
        dm_query("insert into rpg_map
			      (`location`, `image`)
			values('$loc', '$mapbrush')");
      }
      else
        dm_query("update rpg_map set `image`='$mapbrush' where `location`='$loc'");

      $action="map";
    }

    if($action=="mapedclearbrush")
    {
      $mapedmode=""; $mapbrush="";
      //&loc=$loc>clear brush</a>] ";
    }

	if($action=="mapedmmi")
    {
        dm_query("update rpg_map set `image`='$image' where `location`='$loc'");
        $action="maped";
    }
    if($action=="mapedmhi")
    {
        dm_query("update rpg_map set `hid_image`='$image' where `location`='$loc'");
        $action="maped";
    }

	if($action=="mapedre") // remove encounter
	{
       $en=rpg_getencounterobj($eid);
       inform("REMOVE $en->name");
       $action="maped";
       $gloc=rpg_getmapobj($loc);
       $encsx=explode("|",$gloc->encounter_list);
       $newlist="";
       for($i=0;$i<count($encsx);$i++)
       {
            $encsy=explode(";",$encsx[$i]);
            if($encsy[0]==$eid)
            {
            }
            else
            {
              $newlist.=$encsx[$i]."|";
            }
       }
       $newlist=rtrim($newlist,"|");
       dm_query("update rpg_map set `encounter_list`='$newlist' where `location`='$loc'");
       $encounter_list=$newlist;
    }
    if($action=="mapedae") // add encounter
    {
       $en=rpg_getencounterobj($eid);
       inform("ADD $en->name");
       $action="maped";
       $gloc=rpg_getmapobj($loc);
       $encsx=explode("|",$gloc->encounter_list);
       $isin=0;
       for($i=0;$i<count($encsx);$i++)
       {
            $encsy=explode(";",$encsx[$i]);
            if($encsy[0]==$eid)
            { 
              $isin=1;
            }
       }
       if($isin==0)
       {
         $gloc->encounter_list.="|$eid;50";
         $gloc->encounter_list=ltrim($gloc->encounter_list,"|");
         dm_query("update rpg_map set `encounter_list`='$gloc->encounter_list' where `location`='$loc'");
         $encounter_list=$gloc->encounter_list;
       }
    }

	if($action=="mapedrm") // remove monster
    {
       $mn=rpg_getmonsterobj($mid);
       inform("REMOVE $mn->name");
       $action="maped";
       $gloc=rpg_getmapobj($loc);
       $mobsx=explode("|",$gloc->moblist);
       $newlist="";
       for($i=0;$i<count($mobsx);$i++)
       {
            $mobsy=explode(";",$mobsx[$i]);
            if($mobsy[0]==$mid)
            {
            }
            else
            {
              $newlist.=$mobsx[$i]."|";
            }
       }
       $newlist=rtrim($newlist,"|");
       dm_query("update rpg_map set `moblist`='$newlist' where `location`='$loc'");
       $moblist=$newlist;
    }

	if($action=="mapedam") // add monster
    {
       $mn=rpg_getmonsterobj($mid);
       inform("ADD $mn->name");
       $action="maped";
       $gloc=rpg_getmapobj($loc);
       $mobsx=explode("|",$gloc->moblist);
       $isin=0;
       for($i=0;$i<count($mobsx);$i++)
       {
            $mobsy=explode(";",$mobsx[$i]);
            if($mobsy[0]==$mid)
            { $isin=1;
            }
       }
       if($isin==0)
       {
         $gloc->moblist.="|$mid;50";
         $gloc->moblist=ltrim($gloc->moblist,"|");
         dm_query("update rpg_map set `moblist`='$gloc->moblist' where `location`='$loc'");
         $moblist=$gloc->moblist;
       }
    }

	if($action=="mapedgo")
	{
		$name=addslashes($name);
		$description=addslashes($description);

		$res=dm_query("select * from rpg_monsters");
		$num=mysql_num_rows($res);
		$newlist="";
        for($i=0;$i<$num;$i++)
        {
          $mn=mysql_fetch_object($res);
          $per=$_REQUEST["mob_$mn->id"];
          if(!empty($per)) { $newlist.="|$mn->id;$per"; }
        }
        $moblist=ltrim($newlist,"|");

		$res=dm_query("select * from rpg_encounter");
		$num=mysql_num_rows($res);
		$newlist="";
        for($i=0;$i<$num;$i++)
        {
          $en=mysql_fetch_object($res);
          $per=$_REQUEST["enc_$en->id"];
          if(!empty($per)){ $newlist.="|$en->id;$per"; }
        }
        $encounter_list=ltrim($newlist,"|");

		$testmap=rpg_getmapobj($loc);
		if($testmap->id==0)
		{
			dm_query("insert into rpg_map
			      (`location`, `name`, `description`, `image`, `exits`, `moblist`, `encounter_list`, `required_level`, `data`, `ap`, `required_items`, `hidden`, `see_criteria`)
			values('$loc',   '$name','$description','$image','$exits','$moblist','$encounter_list','$required_level','$data_','$ap', '$required_items', '$hidden', '$see_criteria')");
		}
		else
		{
			dm_query("update rpg_map set `name`='$name' where `location`='$loc'");
			dm_query("update rpg_map set `description`='$description' where `location`='$loc'");
			dm_query("update rpg_map set `image`='$image' where `location`='$loc'");
			dm_query("update rpg_map set `exits`='$exits' where `location`='$loc'");
			dm_query("update rpg_map set `moblist`='$moblist' where `location`='$loc'");
			dm_query("update rpg_map set `encounter_list`='$encounter_list' where `location`='$loc'");
			dm_query("update rpg_map set `required_level`='$required_level' where `location`='$loc'");
			dm_query("update rpg_map set `data`='$data_' where `location`='$loc'");
			dm_query("update rpg_map set `ap`='$ap' where `location`='$loc'");
			dm_query("update rpg_map set `required_items`='$required_items' where `location`='$loc'");
			dm_query("update rpg_map set `hidden`='$hidden' where `location`='$loc'");
			dm_query("update rpg_map set `see_criteria`='$see_criteria' where `location`='$loc'");
			dm_query("update rpg_map set `hid_image`='$hid_image' where `location`='$loc'");


		}
		$action="maped";
	}

	if($action=="maped")
	{

		$coords=explode(",",$loc);
		$x=$coords[0];
		$y=$coords[1];
		$z=$coords[2];

		$locinfo=rpg_getmapobj($loc);
		$locinfo->name=stripslashes($locinfo->name);
		$locinfo->description=stripslashes($locinfo->description);
		echo "<h1>Editing map tile ($loc)</h1>";

		echo "<table class=dm_base><tr><td valign=top>";

		if(empty($locinfo->image)) $locinfo->image="map_plains.gif";
		echo "<p>".imgn("images/$locinfo->image",$locinfo->name)."</p>";
		echo "<table class=dm_base><form action=rpg_build.php method=post><input type=hidden name=loc value=$loc>";
		echo "<input type=hidden name=action value=mapedgo>";		
		echo "<tr><td>Name</td><td><input type=textbox name=name value=\"$locinfo->name\"></td></tr>\n";
		echo "<tr><td>Description</td><td><textarea cols=40 name=description>$locinfo->description</textarea></td></tr>\n";
		echo "<tr><td>Image</td><td><select name=image><option>$locinfo->image<option> ";
		$dirfiles=rpg_getdir("./images/");
		while(list ($key, $file) = each ($dirfiles))
		{
          if(stristr($file,"map_"))   echo "<option>$file";
          if(stristr($file,"world-")) echo "<option>$file";
        }
		echo "</select></td></tr>";

		echo "<tr><td>Exits</td><td><input type=textbox name=exits value=$locinfo->exits></td></tr>";
		echo "<tr><td>Data</td><td>";
   		echo "<textarea name=data_ cols=40 rows=2>$locinfo->data</textarea>";

		echo "<tr><td></td><td><hr>Monsters<br>";

		$mobd=explode("|",$locinfo->moblist);
		for($i=0;$i<count($mobd);$i++)
		{
			$amob=explode(";",$mobd[$i]);
			$tmob=$amob[0];
			$tper=$amob[1];
			if($tmob!="")
			{
				$jmob=rpg_getmonsterobj($tmob);
				if(empty($jmob->image)) $jmob->image="nopic.gif";
				if(!file_exists("images/$jmob->image")) $jmob->image="nofile.gif";
				echo imgs("images/$jmob->image",$jmob->name,32,32);
                echo "<input name=mob_$tmob value=\"$tper\" size=3>%";
                echo " [<a href=rpg_build.php?action=mapedrm&mid=$tmob&loc=$loc>remove</a>]";
                echo "<br>";
			}
		}

        echo "<br>";
        echo "<hr>";
        echo "</td></tr>";

		echo "<tr><td></td><td>Encounters<br>";

		$encd=explode("|",$locinfo->encounter_list);
		for($i=0;$i<count($encd);$i++)
		{
			$aenc=explode(";",$encd[$i]);
			$tenc=$aenc[0];
			$tper=$aenc[1];
			if($tenc!="")
			{
				$jenc=rpg_getencounterobj($tenc);
				if(empty($jenc->image)) $jenc->image="nopic.gif";
				if(!file_exists("images/$jenc->image")) $jenc->image="nofile.gif";
				echo imgs("images/$jenc->image",$jenc->name,32,32);
                echo "<input name=enc_$tenc value=\"$tper\" size=3>%";
                echo " [<a href=rpg_build.php?action=mapedre&eid=$tenc&loc=$loc>remove</a>]";
                echo "<br>";
			}
		}

        echo "<br>";
        echo "<hr>";

		echo "</td></tr>";

		echo "<tr><td>Required Level</td><td><input type=textbox name=required_level value=$locinfo->required_level></td></tr>";
		echo "<tr><td>Required Items</td><td><input type=textbox name=required_items value=$locinfo->required_items></td></tr>";

        echo "</td></tr>";

		echo "<tr><td>AP</td><td><input type=textbox name=ap value=$locinfo->ap></td></tr>";

		echo "<tr><td>Hidden</td><td><select name=hidden><option>$locinfo->hidden<option>no<option>yes</select></td></tr>";

        echo "<tr><td>Hid Image</td><td><select name=hid_image><option>$locinfo->hid_image <option> ";
		$dirfiles=rpg_getdir("./images/");
		while(list ($key, $file) = each ($dirfiles))
		{
           if(stristr($file,"map_"))   echo "<option>$file";
           if(stristr($file,"world-")) echo "<option>$file";
        }
		echo "</select></td></tr>";

		echo "<tr><td>See Criteria</td><td><input type=textbox name=see_criteria value=$locinfo->see_criteria></td></tr>";


		echo "<tr><td>&nbsp;</td><td><input type=submit name=Go value=Go></td></tr>";
		echo "</form></table>";

		echo "</td><td valign=top>";

		echo "<p class=dm_warning>Image Files:</p>";
		echo "<table class=dm_base>\n";

		$dirfiles=rpg_getdir("./images/");
		while(list ($key, $file) = each ($dirfiles))
		{
            if( (stristr($file,"map_")) || (stristr($file,"world-")) )
            echo "<tr><td>".imgs("images/$file",$file,64,64)."</td><td>
            $file<br>
            [<a href=rpg_build.php?action=mapedmmi&image=$file&loc=$loc>use image</a>]<br>
            [<a href=rpg_build.php?action=mapedmhi&image=$file&loc=$loc>use hid image</a>]<br>
            </td></tr>";
        }
		echo "</table>\n";

		echo "</td><td valign=top>";

		echo "<p class=dm_warning>Monsters:</p>";
		$result=dm_query("select * from rpg_monsters");
		$nmobs=mysql_num_rows($result);
		echo "<table class=dm_base>";
		for($i=0;$i<$nmobs;$i++)
		{
			$tmob=mysql_fetch_object($result);
			if(empty($tmob->image)) $tmob->image="nopic.gif";
			if(!file_exists("images/$tmob->image")) $tmob->image="nofile.gif";
			echo "<tr>";
			echo "<td>";
			echo "[<a href=rpg_build.php?action=mapedam&mid=$tmob->id&loc=$loc>add</a>]";
			echo "</td>";
            echo "<td>$tmob->id</td><td>".imgs("images/$tmob->image",$tmob->name,64,64)."</td></tr>";
		}
		echo "</table>";

		echo "</td><td valign=top>";
		
		echo "<p class=dm_warning>Encounters:</p>";
		$result=dm_query("select * from rpg_encounter");
		$nmobs=mysql_num_rows($result);
		echo "<table class=dm_base>";
		for($i=0;$i<$nmobs;$i++)
		{
			$tmob=mysql_fetch_object($result);
			if(empty($tmob->image)) $tmob->image="nopic.gif";
			if(!file_exists("images/$tmob->image")) $tmob->image="nofile.gif";
			echo "<tr>";
			echo "<td>[<a href=rpg_build.php?action=mapedae&eid=$tmob->id&loc=$loc>add</a>]</td>";
            echo "<td>$tmob->id</td><td>".imgs("images/$tmob->image",$tmob->name,64,64)."</td></tr>";
		}
		echo "</table>";

		echo "</td></tr></table>";

		exit();
	}

	if($action=="map")
	{
		echo "<h1>Map Editor</h1>";
		echo "<center>";
		$thisloc=$_REQUEST['loc'];
		if(empty($thisloc)) $thisloc="0,0,0";
		$coors=explode(",",$thisloc);
		$tx=$coors[0];
		$ty=$coors[1];
		$tz=$coors[2];
		$x=0;
		$y=0;
		$z=$tz;
		echo "<table border=0><tr><td  valign=top>";
		echo "<table border=0 cellspacing=0 cellpadding=0>\n";
		for($y=-3;$y<4;$y++)
		{
			echo"<tr>\n";
			for($x=-5;$x<6;$x++)
			{
				$gloc="$x,$y,$z";
				$getter=dm_query("select * from rpg_map where location='$gloc'");
				$glocinfo=mysql_fetch_object($getter);
				$gimg=$glocinfo->image;
				if($gimg=="") $gimg="map_plains.gif";
				if($mapedmode=="paint")
				{
				 echo "<td><a href=rpg_build.php?action=mappaint&mapedmode=paint&mapbrush=$mapbrush&loc=$x,$y,$z>";
				 if(empty($glocinfo->name)) $glocinfo->name="undefined (playnes)";
				 echo "<img src=\"images/$gimg\" border=0 width=32 height=32>";
				 echo "</a></td>\n";
                }
                else
                {
				 echo "<td><a href=rpg_build.php?action=maped&loc=$x,$y,$z>";
				 if(empty($glocinfo->name)) $glocinfo->name="undefined (playnes)";
				 echo "<img src=\"images/$gimg\" border=0 width=32 height=32>";
				 echo "</a></td>\n";
                }
			}
			echo "</tr>\n";
		}
		echo "</table></center>\n";

		echo "<center><table class=dm_base><form action=rpg_build.php method=post>";
        echo "<tr><td><input type=hidden name=action value=map>Warp to:</td>";
		echo "<td><select name=loc>";
		$z="-1";
		for($y=0;$y<7;$y++)
		{
			for($x=0;$x<11;$x++)
			{
				$gloc="$x,$y,-1";
				$getter=rpg_getmapobj($gloc);
				if(!empty($getter->name))
					echo "<option value=$getter->data>$getter->name";
			}
		}
		$res=dm_query("select * from rpg_map");
		$num=mysql_num_rows($res);
		for($i=0;$i<$num;$i++)
		{
          $getter=mysql_fetch_object($res);
          if($getter->exits=="mapportal")
          {
					echo "<option value=$getter->data>$getter->name";
          }
        }

		echo "</select></td><td><input type=submit name=warp value=warp></td></tr></table></center>";
		echo "</form>";
		echo "</td>";

		echo "<td valign=top>";

        if($mapedmode=="paint")
        {
    	   echo "<h1>Paint mode</h1>";
	   	   //echo "[<a href=rpg_build.php?action=mapedbrush&loc=$loc>choose brush</a>] ";
	       echo "[<a href=rpg_build.php?action=map&loc=$loc>clear brush</a>] ";
	       echo "<br>";
	       if(!empty($mapbrush))
	       {
             echo "Current brush:<br>";
             echo "<table border=0 width=68 height=68 cellpadding=5 cellspacing=5><tr><td class=dm_warning>";
             echo imgs("images/$mapbrush",$mapbrush,64,64);
             echo "</td></tr></table>";
           }
           echo "<br>Choose brush:<br>";
          $mapedmode="paint";
          $ln=0;
          $dirfiles=rpg_getdir("./images/");
          while(list ($key, $file) = each ($dirfiles))
          if( (stristr($file,"map_")) || (stristr($file,"world-")) )
          {
            echo "<a href=rpg_build.php?action=map&mapedmode=paint&mapbrush=$file&loc=$loc>";
            echo imgs("images/$file",$file,64,64);
            echo "</a>";
            $ln++; if($ln>8) { $ln=0;       echo "<br>"; }
            }


        }
        else
        {
          echo "<h1>Edit mode</h1>";
          echo "[<a href=rpg_build.php?action=map&mapedmode=paint&loc=$loc>paint mode</a>] ";

        }

		echo "</td></tr></table>";

		exit();
	}

	//Worldmap

	if($action=="worldmap")
	{
		$z="-1";
		echo "<h1>World Map</h1><center><table cellspacing=0 cellpadding=0 border=0>";
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
				echo "<td><a href=rpg_build.php?action=maped&loc=$x,$y,$z>";
				if(empty($glocinfo->name)) $glocinfo->name="undefined (playnes)";
				echo "<img src=\"images/$gimg\" border=0 width=32 height=32></a></td>\n";
			}
			echo "</tr>";
		}
		echo "</table>";
		exit();
	}

   //Abilities

	if($action=="abilityedgo")
	{
		echo "<h1>Edit ability GO!</h1>\n";
		$name=addslashes($name);
		$description=addslashes($description);

		dm_query("update rpg_special_attacks set `name`='$name' where `id`='$id'");
		dm_query("update rpg_special_attacks set `description`='$description' where `id`='$id'");
		dm_query("update rpg_special_attacks set `image`='$image' where `id`='$id'");
		dm_query("update rpg_special_attacks set `persist_rounds`='$persist_rounds' where `id`='$id'");
		dm_query("update rpg_special_attacks set `power`='$power' where `id`='$id'");
		dm_query("update rpg_special_attacks set `cooldown`='$cooldown' where `id`='$id'");
		dm_query("update rpg_special_attacks set `action`='$act' where `id`='$id'");
		dm_query("update rpg_special_attacks set `class`='$class' where `id`='$id'");
		dm_query("update rpg_special_attacks set `level`='$level' where `id`='$id'");
		dm_query("update rpg_special_attacks set `trained`='$trained' where `id`='$id'");
		
		$action="abilities";
	}

	
	if( ($action=="abilityadd") || ($action=="abilityed") )
	{
		if($action=="abilityadd")
		{

			echo "<h1>Add new ability</h1>\n";
			dm_query("insert into rpg_special_attacks (`name`) values('unnamed' )");
			$res=dm_query("select * from rpg_special_attacks where `name` = 'unnamed'");
			$ab=mysql_fetch_object($res);
			$id=$ab->id;
		}

		$rab=dm_query("select * from rpg_special_attacks where `id`='$id'");
		$tab=mysql_fetch_object($rab);
		$tab->name=stripslashes($tab->name);


		if($action=="abilityed")
		{
			echo "<h1>Edit ability [$tab->name]</h1>\n";
		}


		echo "<table class=dm_base><tr><td valign=top>";
		
		echo "<table class=dm_base>";

		echo "<form action=rpg_build.php method=post>\n";
		echo "<input type=hidden name=action value=abilityedgo>";
		echo "<input type=hidden name=id value=$id>";
		
		$tab->name=stripslashes($tab->name);
		echo "<tr><td>Name</td><td><input type=textbox name=name value=\"$tab->name\" size=20></td></tr>\n";

		echo "<tr><td>Description</td><td><textarea name=description cols=45 rows=6>$tab->description</textarea></td></tr>";

		echo "<tr><td>Image</td><td><select name=image><option>$tab->image";
		$dirfiles=rpg_getdir("./images/");
		while(list ($key, $file) = each ($dirfiles)) if(stristr($file,"abl_")) echo "<option>$file";
		echo "</select></td></tr>";

		echo "<tr><td>Class</td><td><select name=class><option>$tab->class<option>All<option>All Good<option>All Evil";
		$rcls=dm_query("select * from rpg_classes"); $ncls=mysql_num_rows($rcls);
		for($i=0;$i<$ncls;$i++) { $tcls=mysql_fetch_object($rcls); echo "<option>$tcls->name"; }
		echo "</select></td></tr>";

		echo "<tr><td>Required Level</td><td><input name=level value=\"$tab->level\"></td></tr>";

		echo "<tr><td>Trained</td><td><select name=trained><option>$tab->trained<option>auto<option>yes<option>no</select></td></tr>";
		
		echo "<tr><td>Action</td><td><select name=act><option>$tab->action<option> ";	
		$ract=dm_query("select * from rpg_actions"); $nact=mysql_num_rows($ract);
		for($i=0;$i<$nact;$i++) { $tact=mysql_fetch_object($ract); echo "<option>$tact->id"; }
		echo "</select></td></tr>";
		
		echo "<tr><td>Persist Turns	</td><td><input type=textbox name=persist_rounds size=10 value=$tab->persist_rounds	></td></tr>";
		echo "<tr><td>Power Cost	</td><td><input type=textbox name=power size=10		value=$tab->power		></td></tr>";
		echo "<tr><td>Cooldown Turns</td><td><input type=textbox name=cooldown size=10	value=$tab->cooldown		></td></tr>";

		echo "<tr><td><input type=submit name=Go value=Go></td><td></td></tr>";
		
		echo "</table>";

		echo "</td><td valign=top>";
		
		
		echo "<p class=dm_warning>Image Files:</p>";

		echo "<table class=dm_base>\n";

			$dirfiles=rpg_getdir("./images/");
			while(list ($key, $file) = each ($dirfiles)) if(stristr($file,"abl_")) echo "<tr><td>".imgs("images/$file",$file,32,32)."</td><td>$file</td></tr>";
			
		echo "</table>\n";
		

		echo "</td><td valign=top>";
		echo "<p class=dm_warning>Actions:</p>";

		$ract=dm_query("select * from rpg_actions order by `action`"); $nact=mysql_num_rows($ract);
		
                for($i=0;$i<$nact;$i++)
                {
                  $act=mysql_fetch_object($ract);
                  echo "$act->id) ";
                  echo "$act->action ";
                  if(!empty($act->value))    echo "$act->value";
                  echo "<br>";
                }

		echo "</td>";
		echo "</tr></table>";

		exit();
	}

	if($action=="abilities")
	{
		echo "<h1>Abilities</h1>\n";

		echo "<table class=dm_base><tr><td>[<a href=rpg_build.php?action=abilityadd>add new ability</a>]</td></tr></table>";

		echo "<table class=dm_base>";
		$rabs=dm_query("select * from rpg_special_attacks");
		$nabs=mysql_num_rows($rabs);

		for($i=0;$i<$nabs;$i++)
		{
			$tabs=mysql_fetch_object($rabs);
			echo "<tr><td>[<a href=rpg_build.php?action=abilityed&id=$tabs->id>edit</a>]</td>";
			echo "<td>$tabs->name</td><td>";
			echo rpg_abilitylink($tabs->id);
			echo "</td>";
			echo "<td>modifies($tabs->modifies</td><td> $tabs->modify_value)</td>";
			echo "<td>dmg($tabs->dmg_low to</td><td>$tabs->dmg_high)</td>";
			echo "<td>persists ($tabs->persist_rounds) turns</td><td>cost ($tabs->power) power</td>";
			echo "<td>cooldown ($tabs->cooldown) turns</td>";

			echo "</tr>";
		}

		echo "</table>";	
		exit();
	}

    //Vendors

	if($action=="vendoredgo")
	{
		$name=addslashes($name);
		$description=addslashes($description);
		dm_query("update rpg_vendor set `name`='$name' where `id`='$id'");
		dm_query("update rpg_vendor set `image`='$image' where `id`='$id'");
		dm_query("update rpg_vendor set `description`='$description' where `id`='$id'");
		dm_query("update rpg_vendor set `inventory`='$inventory' where `id`='$id'");
		dm_query("update rpg_vendor set `will_not_buy`='$will_not_buy' where `id`='$id'");
		echo "<h1>Vendor $name updated</h1>\n";
		$action="vendor";
	}

	if( ($action=="vendoradd") || ($action=="vendored") )
	{

		if($action=="vendoradd")
		{
			dm_query("insert into rpg_vendor (`name`) values('unnamed')");
			$res=dm_query("select * from rpg_vendor where `name`='unnamed'");
			$tact=mysql_fetch_object($res);
			$id=$tact->id;
		}
		
		$tact=rpg_getvendorobj($id);
		if($action=="vendored")
		{
			echo "<h1>Edit vendor [$tact->name]</h1>\n";
		}
		
		echo "<table class=dm_base><tr><td valign=top>";

		echo "<table class=dm_base>";
		echo "<form action=rpg_build.php method=post>\n";
       	echo "<input type=hidden name=action value=vendoredgo>\n";
		echo "<input type=hidden name=id value=$id>\n";

		echo "<tr>";
		$tact->name=stripslashes($tact->name);
		echo "<td>Name  </td><td><input type=textbox size=20 name=name value=\"$tact->name\"></td> </tr>";

		echo "<tr><td>Description</td><td><textarea name=description cols=40 rows=6>".stripslashes($tact->description)."</textarea></td></tr>";
		echo "<tr><td></td><td><img src=\"images/$tact->image\" width=128 height=128> </td></tr>";
		echo "<tr><td>Image</td> <td><select name=image><option>$tact->image";
		$dirfiles=rpg_getdir("./images/");
		while(list ($key, $file) = each ($dirfiles)) if(stristr($file,"monster_")) echo "<option>$file";
		echo "</select></td></tr>\n";		

		echo "<tr><td>Inventory</td><td><select name=inventory><option>$tact->inventory";
		$ract=dm_query("select * from rpg_loot_table"); $nact=mysql_num_rows($ract);
		for($i=0;$i<$nact;$i++) { $gact=mysql_fetch_object($ract); echo "<option>$gact->id"; }
		echo "</select></td></tr>";

		echo "<tr><td>Will Not Buy</td><td><input type=textbox size=20 name=will_not_buy value=\"$tact->will_not_buy\"></td>";
		
		echo "</tr>";

		echo "<tr><td></td><td><input type=submit value=Go></td><td></td></tr>";
		echo "</form>";
		echo "</table>";

		echo "</td><td valign=top>";
		echo "<table class=dm_base>\n";

			$dirfiles=rpg_getdir("./images/");
			while(list ($key, $file) = each ($dirfiles)) if(stristr($file,"monster_")) echo "<tr><td>".imgs("images/$file",$file,64,64)."</td><td>$file</td></tr>";
			
		echo "</table>\n";

		echo "</td><td valign=top>";

		echo "<p class=dm_warning>Loot Tables:</p>";
		
		$result=dm_query("select * from rpg_loot_table");
		$numitems=mysql_num_rows($result);
		echo "<table class=dm_base><tr><td>[<a href=\"rpg_build.php?action=lootadd\">add new loot table</a>]</td></tr></table>";
		echo "<table class=dm_base>\n";
		for($i=0;$i<$numitems;$i++)
		{
			$loot=mysql_fetch_object($result);
			echo "<tr>";
			echo "<td>[<a href=\"rpg_build.php?action=looted&id=$loot->id\">edit</a>]</td>\n";

			echo "<td>ID: $loot->id</td>";

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
		}
		echo "</table>";	
		
		echo "</td></tr></table>";
		exit();
	}

	if($action=="vendor")
	{
		echo "<h1>Vendors</h1>\n";
		
		$ract=dm_query("select * from rpg_vendor");
		$nact=mysql_num_rows($ract);
		echo "<table class=dm_base><tr><td>[<a href=rpg_build.php?action=vendoradd>add new vendor</a>]</td></tr></table>";
		echo "<table class=dm_base>";		
		for($i=0;$i<$nact;$i++)
		{
			$tact=mysql_fetch_object($ract);
			
			echo "<tr><td>[<a href=rpg_build.php?action=vendored&id=$tact->id>edit</a>]</td>";
			echo "<td>$tact->name</td>";
			echo "<td>".imgs("images/$tact->image",$tact->name,32,32)."</td>";
			echo "<td>";

				echo "<table class=dm_base>\n";
				$result=dm_query("select * from rpg_loot_table where `id`='$tact->inventory'");
				$numitems=mysql_num_rows($result);
				for($j=0;$j<$numitems;$j++)
				{
					$loot=mysql_fetch_object($result);
					echo "<tr>";
					echo "<td>[<a href=\"rpg_build.php?action=looted&id=$loot->id\">edit</a>]</td>\n";
					echo "<td>";

					$its=explode("|",$loot->data);
					for($k=0;$k<count($its);$k++)
					{
						$lts=explode(";",$its[$k]);
						$item=rpg_getlootobj($lts[0]);
						if($item->image=="") $item->image="nopic.gif";
						if(!file_exists("images/$item->image")) $item->image="nofile.gif";
						echo imgs("images/$item->image",$item->name,16,16);
					}
					echo "</td>\n";			
					echo"</tr>";
				}
				echo "</table>";


			echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
		exit();
	}
	
	//Actions

	if($action=="actionedgo")
	{
		dm_query("update rpg_actions set `action`='$rpg_action' where `id`='$id'");
		dm_query("update rpg_actions set `value`='$value' where `id`='$id'");
		echo "<h1>Action $id updated</h1>\n";
		$action="actions";
	}

	if( ($action=="actioned") || ($action=="actionadd") )
	{
      if($action=="actionadd")
      {
		echo "<h1>Add new action $id</h1>\n";
        dm_query("insert into rpg_actions values('','unnamed','0')");
        $res=dm_query("select * from rpg_actions where `action`='unnamed'");
        $tact=mysql_fetch_object($res);
        $id=$tact->id;
      }
      else
      {
		echo "<h1>Edit action $id</h1>\n";
      }

		$tact=rpg_getactionobj($id);
		
		echo "<table class=dm_base>";
		echo "<form action=rpg_build.php method=post>\n";
        	echo "<input type=hidden name=action value=actionedgo>\n";
		echo "<input type=hidden name=id value=$id>\n";

		echo "<tr>";
		echo "<td>Action  </td><td><select name=rpg_action><option>$tact->action";

                echo "<option>modify_ap";
                echo "<option>modify_hp";
                echo "<option>modify_hpmax";
                echo "<option>modify_pow";
                echo "<option>modify_powmax";
                
                echo "<option>modify_exp";
                echo "<option>modify_str";
                echo "<option>modify_int";
                echo "<option>modify_agl";
                echo "<option>modify_def";
                
                echo "<option>modify_cash";

                echo "<option>teleport";
                echo "<option>loottable";
                echo "<option>upgrade_base";
                echo "<option>teach_ability";
                echo "<option>teach_craft";
                echo "<option>teach_recipe";

                echo "<option>do_encounter";
                echo "<option>do_fight";

                echo "<option>hp_modify_enemy";
                echo "<option>hp_leech_enemy";
                echo "<option>pow_modify_enemy";
                echo "<option>pow_leech_enemy";

				echo "<option>action_chain";

                echo "</select></td>";
                                   
		echo "<td>Value   </td><td><input type=textbox size=50 name=value value=$tact->value></td>";
		echo "</tr>";

		echo "<tr><td><input type=submit value=Go></td><td></td></tr>";
		echo "</form>";
		echo "</table>";
		exit();
	}

	if($action=="actions")
	{
		echo "<h1>Actions</h1>\n";

		$ract=dm_query("select * from rpg_actions order by `action`,`value` asc");
		$nact=mysql_num_rows($ract);
		echo "<table class=dm_base><tr><td>";
		echo "[<a href=rpg_build.php?action=actionadd>add new action</a>]</td></tr></table>";
		echo "<table class=dm_base>";		
		for($i=0;$i<$nact;$i++)
		{
			$tact=mysql_fetch_object($ract);
			
			echo "<tr><td>[<a href=rpg_build.php?action=actioned&id=$tact->id>edit</a>]</td>";
			echo "<td>$tact->id</td>";
			echo "<td>$tact->action</td>";
			echo "<td>$tact->value</td>";
			echo "</tr>";
		}
		echo "</table>";
		exit();
	}
	
	//Monsters

	if($action=="monsteredgo")
	{
		echo "<h1>Updated monster [$name]</h1>\n";
		
		$name=addslashes($name);		dm_query("update rpg_monsters set `name`='$name' where id='$id'");
							dm_query("update rpg_monsters set `image`='$image' where id='$id'");
		$loot_table=$_REQUEST['loot_table'];	dm_query("update rpg_monsters set `loot_table`='$loot_table' where id='$id'");
		$level_low=$_REQUEST['level_low'];	dm_query("update rpg_monsters set `level_low`='$level_low' where id='$id'");
		$level_high=$_REQUEST['level_high'];	dm_query("update rpg_monsters set `level_high`='$level_high' where id='$id'");
		$str=$_REQUEST['str'];			dm_query("update rpg_monsters set `str`='$str' where id='$id'");
		$int=$_REQUEST['int'];			dm_query("update rpg_monsters set `int`='$int' where id='$id'");
		$agl=$_REQUEST['agl'];			dm_query("update rpg_monsters set `agl`='$agl' where id='$id'");
		$def=$_REQUEST['def'];			dm_query("update rpg_monsters set `def`='$def' where id='$id'");
		$hp=$_REQUEST['hp'];			dm_query("update rpg_monsters set `hp`='$hp' where id='$id'");
		$hp_max=$_REQUEST['hp_max'];		dm_query("update rpg_monsters set `hp_max`='$hp_max' where id='$id'");	
		$pow=$_REQUEST['pow'];			dm_query("update rpg_monsters set `pow`='$pow' where id='$id'");
		$pow_max=$_REQUEST['pow_max'];		dm_query("update rpg_monsters set `pow_max`='$pow_max' where id='$id'");
		$dmg_low=$_REQUEST['dmg_low'];		dm_query("update rpg_monsters set `dmg_low`='$dmg_low' where id='$id'");
		$dmg_high=$_REQUEST['dmg_high'];	dm_query("update rpg_monsters set `dmg_high`='$dmg_high' where id='$id'");
		$alignment=$_REQUEST['alignment'];	dm_query("update rpg_monsters set `alignment`='$alignment' where id='$id'");
		$group=$_REQUEST['group'];		dm_query("update rpg_monsters set `group`='$group' where id='$id'");
		
		$action="monster";
	}

	if( ($action=="monstered") || ($action=="monsteradd") )
	{
      if($action=="monsteradd")
      {
          dm_query("insert into rpg_monsters (`name`) values('unnamed')");
          $res=dm_query("select * from rpg_monsters where `name`='unnamed'");
          $mon=mysql_fetch_object($res);
          $id=$mon->id;
      }
	$monster=rpg_getmonsterobj($id);
      if($action=="monstered")
      {

       		echo "<h1>Edit monster [$monster->name]</h1>\n";
      }

		echo "<table class=dm_base><tr>";
		echo "<td valign=top>";

		echo "<table class=dm_base>";		
		echo "<form action=rpg_build.php method=post>\n";
		echo "<input type=hidden name=action value=monsteredgo>\n";
		
		echo "<tr><td>";
		echo "<img src=\"images/$monster->image\" width=128 border=0>";
		echo "</td><td></td></tr>\n";
		echo "<tr><td>Name</td><td><input type=textbox name=name value=\"".stripslashes($monster->name)."\" size=50></td></tr>\n";
		
		echo "<tr><td>Image</td> <td><select name=image><option>$monster->image";
		$dirfiles =rpg_getdir("./images/");
		while(list ($key, $file) = each ($dirfiles)) if(stristr($file,"monster_")) echo "<option>$file";
		echo "</select></td></tr>\n";
		echo "<tr><td>Level (low)</td><td><select name=level_low><option>$monster->level_low"; for($i=1;$i<200;$i++) echo "<option>$i"; echo "</td></tr>";
		echo "<tr><td>Level (high)</td><td><select name=level_high><option>$monster->level_high"; for($i=1;$i<200;$i++) echo "<option>$i"; echo "</td></tr>";
		echo "<tr><td>HP (low)</td><td><select name=hp><option>$monster->hp"; for($i=1;$i<1000;$i++) echo "<option>$i"; echo "</td></tr>\n";
		echo "<tr><td>HP (high)</td><td><select name=hp_max><option>$monster->hp_max"; for($i=1;$i<1000;$i++) echo "<option>$i"; echo "</td></tr>\n";
		echo "<tr><td>POW (low)</td><td><select name=pow><option>$monster->pow"; for($i=1;$i<1000;$i++) echo "<option>$i"; echo "</td></tr>\n";
		echo "<tr><td>POW (high)</td><td><select name=pow_max><option>$monster->pow_max"; for($i=1;$i<1000;$i++) echo "<option>$i"; echo "</td></tr>\n";
		echo "<tr><td>DMG (low)</td><td><select name=dmg_low><option>$monster->dmg_low"; for($i=1;$i<1000;$i++) echo "<option>$i"; echo "</td></tr>\n";
		echo "<tr><td>DMG (high)</td><td><select name=dmg_high><option>$monster->dmg_high"; for($i=1;$i<1000;$i++) echo "<option>$i"; echo "</td></tr>\n";
		echo "<tr><td>STR</td><td><select name=str><option>$monster->str"; for($i=1;$i<200;$i++) echo "<option>$i"; echo "</td></tr>\n";
		echo "<tr><td>INT</td><td><select name=int><option>$monster->int"; for($i=1;$i<200;$i++) echo "<option>$i"; echo "</td></tr>\n";
		echo "<tr><td>AGL</td><td><select name=agl><option>$monster->agl"; for($i=1;$i<200;$i++) echo "<option>$i"; echo "</td></tr>\n";
		echo "<tr><td>DEF</td><td><select name=def><option>$monster->def"; for($i=1;$i<200;$i++) echo "<option>$i"; echo "</td></tr>\n";
		echo "<tr><td>Alignment</td><td><select name=alignment><option>$monster->alignment<option>good<option>nuetral<option>evil</td></tr>\n";
		echo "<tr><td>Group</td><td><select name=group><option>$monster->group"; for($i=1;$i<200;$i++) echo "<option>$i"; echo "</td></tr>\n";
		//special_atttack
		//special_attack_percent
		echo "<tr><td>Loot Table</td><td><select name=loot_table><option>$monster->loot_table";
		$result=dm_query("select * from rpg_loot_table");
		$numitems=mysql_num_rows($result);
		for($i=0;$i<$numitems;$i++)
		{
			$loot=mysql_fetch_object($result);
			echo "<option>$loot->id";
		}
		echo "</td></tr>\n";
		echo "<tr><td><input type=submit name=Go value=Go>";
		echo "<input type=hidden name=id value=$monster->id>";
		echo "</td><td>&nbsp;</td></tr>\n";
		echo "</form>\n";
		echo "</table>";
		echo "</td><td valign=top>";
		echo "<p class=dm_warning>Image Files:</p>";
		echo "<table class=dm_base>\n";

			$dirfiles=rpg_getdir("./images/");
			while(list ($key, $file) = each ($dirfiles)) if(stristr($file,"monster_")) echo "<tr><td>".imgs("images/$file",$file,64,64)."</td><td>$file</td></tr>";
			
		echo "</table>\n";
		echo "</td><td valign=top>";
		echo "<p class=dm_warning>Loot Tables:</p>";
		
		$result=dm_query("select * from rpg_loot_table");
		$numitems=mysql_num_rows($result);
		echo "<table class=dm_base><tr><td>[<a href=\"rpg_build.php?action=lootadd\">add new loot table</a>]</td></tr></table>";
		echo "<table class=dm_base>\n";
		for($i=0;$i<$numitems;$i++)
		{
			$loot=mysql_fetch_object($result);
			echo "<tr>";
			echo "<td>[<a href=\"rpg_build.php?action=looted&id=$loot->id\">edit</a>]</td>\n";
			echo "<td>$loot->id</td>\n";
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
		}
		echo "</table>";
		echo "</td></tr></table>";
		exit();
	}

	if($action=="monster")
	{
		$result=dm_query("select * from rpg_monsters order by `level_low`, `name` asc");
		$numitems=mysql_num_rows($result);
		echo "<h1>Monsters</h1>\n";
		echo "<table class=dm_base><tr><td>[<a href=\"rpg_build.php?action=monsteradd\">add new monster</a>]</td></tr></table>";
		echo "<table class=dm_base>\n";
		for($i=0;$i<$numitems;$i++)
		{
			$monster=mysql_fetch_object($result);
			echo "<tr>";
			echo "<td>[<a href=\"rpg_build.php?action=monstered&id=$monster->id\">edit</a>]</td>\n";
			if($monster->image=="") $monster->image="nopic.gif";
			if(!file_exists("images/$monster->image")) $monster->image="nofile.gif";
			echo "<td>".imgs("images/$monster->image",$monster->name,32,32)."</td>\n";
			echo "<td>$monster->name</td>\n";
			echo "<td>LVL $monster->level_low - $monster->level_high</td>";
			echo "<td>DMG $monster->dmg_low - $monster->dmg_high</td>";
			echo "<td>WTL $monster->hp</td>";
			echo "<td>MOT $monster->pow</td>";
			echo "<td>INT $monster->str</td>";
			echo "<td>SYL $monster->int</td>";
			echo "<td>NFN $monster->agl</td>";
			echo "<td>CAL $monster->def</td>";
			echo"</tr>";
		}
		echo "</table>";
		exit();
	}
	
	//Items

	if($action=="itemedgo")
	{
		
		echo "<h1>Item ".stripslashes($name)." edited...</h1>\n";
		
		$name=addslashes($name);
		$description=addslashes($description);
		$description=addslashes($description);

		dm_query ("UPDATE rpg_items SET name		   = '$name'			where id = '$id'");
		dm_query ("UPDATE rpg_items SET image		   = '$image'			where id = '$id'");
		dm_query ("UPDATE rpg_items SET description    = '$description'	    where id = '$id'");
		dm_query ("UPDATE rpg_items SET damage		   = '$damage'			where id = '$id'");
		dm_query ("UPDATE rpg_items SET damage_high    = '$damage_high'	    where id = '$id'");
		dm_query ("UPDATE rpg_items SET durability	   = '$durability_max'	where id = '$id'");
		dm_query ("UPDATE rpg_items SET durability_max = '$durability_max'  where id = '$id'");
		dm_query ("UPDATE rpg_items SET hp_mod         = '$hp_mod'		 	where id = '$id'");
		dm_query ("UPDATE rpg_items SET pow_mod        = '$pow_mod'		    where id = '$id'");
		dm_query ("UPDATE rpg_items SET str_mod        = '$str_mod'		    where id = '$id'");
		dm_query ("UPDATE rpg_items SET agl_mod        = '$agl_mod'	   	    where id = '$id'");
		dm_query ("UPDATE rpg_items SET int_mod        = '$int_mod'		    where id = '$id'");
		dm_query ("UPDATE rpg_items SET def_mod        = '$def_mod'	    	where id = '$id'");
		dm_query ("UPDATE rpg_items SET wear_slot      = '$wear_slot'		where id = '$id'");
		dm_query ("UPDATE rpg_items SET useable		   = '$useable'	    	where id = '$id'");
		dm_query ("UPDATE rpg_items SET action         = '$rpg_action'		where id = '$id'");
		dm_query ("UPDATE rpg_items SET charges		   = '$charges'		    where id = '$id'");
		dm_query ("UPDATE rpg_items SET charges_max    = '$charges_max'	    where id = '$id'");
		dm_query ("UPDATE rpg_items SET required_level = '$required_level'  where id = '$id'");
		dm_query ("UPDATE rpg_items SET `unique`       = '$unique'          where id = '$id'");
		dm_query ("UPDATE rpg_items SET sell_value     = '$sell_value'      where id = '$id'");
		dm_query ("UPDATE rpg_items SET quest 		   = '$quest'		    where id = '$id'");
		dm_query ("UPDATE rpg_items SET craft_mat	   = '$craft_mat'		where id = '$id'");
		dm_query ("UPDATE rpg_items SET sellable	   = '$sellable'		where id = '$id'");
		dm_query ("UPDATE rpg_items SET tradeable      = '$tradeable'		where id = '$id'");

		dm_query ("UPDATE rpg_inventory SET charges_max    = '$charges_max'	    where id = '$id'");
		dm_query ("UPDATE rpg_inventory SET durability     = '$durability_max'	    where id = '$id'");
                dm_query ("UPDATE rpg_inventory SET durability_max = '$durability_max'	    where id = '$id'");

		$action="item";
	}
	
	if($action=="itemclone")
	{
	       $itc=rpg_getitemobj($id);
               dm_query("insert into rpg_items (`name`) values('cloned$id')");
	       $newitemr=dm_query("select * from rpg_items where `name`='cloned$id'");
	       $newitem=mysql_fetch_object($newitemr);
	       $id=$newitem->id;
	       $itc->name=addslashes($itc->name);
	       $itc->description=addslashes($itc->description);

		dm_query ("UPDATE rpg_items SET name		   = '$itc->name(cloned)' where id = '$id'");
		dm_query ("UPDATE rpg_items SET image		   = '$itc->image'			where id = '$id'");
		dm_query ("UPDATE rpg_items SET description        = '$itc->description'	    where id = '$id'");
		dm_query ("UPDATE rpg_items SET damage		   = '$itc->damage'			where id = '$id'");
		dm_query ("UPDATE rpg_items SET damage_high        = '$itc->damage_high'	    where id = '$id'");
		dm_query ("UPDATE rpg_items SET durability	   = '$itc->durability_max'	where id = '$id'");
		dm_query ("UPDATE rpg_items SET durability_max     = '$itc->durability_max'  where id = '$id'");
		dm_query ("UPDATE rpg_items SET hp_mod             = '$itc->hp_mod'		 	where id = '$id'");
		dm_query ("UPDATE rpg_items SET pow_mod            = '$itc->pow_mod'		    where id = '$id'");
		dm_query ("UPDATE rpg_items SET str_mod            = '$itc->str_mod'		    where id = '$id'");
		dm_query ("UPDATE rpg_items SET agl_mod            = '$itc->agl_mod'	   	    where id = '$id'");
		dm_query ("UPDATE rpg_items SET int_mod            = '$itc->int_mod'		    where id = '$id'");
		dm_query ("UPDATE rpg_items SET def_mod            = '$itc->def_mod'	    	where id = '$id'");
		dm_query ("UPDATE rpg_items SET wear_slot          = '$itc->wear_slot'		where id = '$id'");
		dm_query ("UPDATE rpg_items SET useable		   = '$itc->useable'	    	where id = '$id'");
		dm_query ("UPDATE rpg_items SET action             = '$itc->action'		where id = '$id'");
		dm_query ("UPDATE rpg_items SET charges		   = '$itc->charges'		    where id = '$id'");
		dm_query ("UPDATE rpg_items SET charges_max        = '$itc->charges_max'	    where id = '$id'");
		dm_query ("UPDATE rpg_items SET required_level     = '$itc->required_level'  where id = '$id'");
		dm_query ("UPDATE rpg_items SET `unique`           = '$itc->unique'          where id = '$id'");
		dm_query ("UPDATE rpg_items SET sell_value         = '$itc->sell_value'      where id = '$id'");
		dm_query ("UPDATE rpg_items SET quest 		   = '$itc->quest'		    where id = '$id'");
		dm_query ("UPDATE rpg_items SET craft_mat	   = '$itc->craft_mat'		where id = '$id'");
		dm_query ("UPDATE rpg_items SET sellable	   = '$itc->sellable'		where id = '$id'");
		dm_query ("UPDATE rpg_items SET tradeable          = '$itc->tradeable'		where id = '$id'");
		dm_query ("UPDATE rpg_inventory SET charges_max    = '$itc->charges_max'	    where id = '$id'");
		dm_query ("UPDATE rpg_inventory SET durability     = '$itc->durability_max'	    where id = '$id'");
                dm_query ("UPDATE rpg_inventory SET durability_max = '$itc->durability_max'	    where id = '$id'");
                $action="itemed";
                $newitem=rpg_getitemobj($id);
                inform3("Item $itc->name cloned to $newitem->name");

	}

	if( ($action=="itemed") || ($action=="itemadd") )
	{

		if($action=="itemadd")
		{
			dm_query("insert into rpg_items (`name`) values('unnamed')");
			$thisitemr=dm_query("select * from rpg_items where `name`='unnamed'");
			$thisitem=mysql_fetch_object($thisitemr);
			$id=$thisitem->id;
			echo "<h1>Add new item</h1>\n";
		}

		$thisitem=rpg_getlootobj($id);
		$thisitem->name=stripslashes($thisitem->name);
		$thisitem->description=stripslashes($thisitem->description);
	
		if($action=="itemed")   
		{
			echo "<h1>Edit item [$thisitem->name]:</h1>\n";
		}


		echo "<table class=dm_base><tr><td valign=top>\n";

		echo "<table class=dm_base>\n";
		echo "<form action=rpg_build.php method=post>\n";
        	echo "<input type=hidden name=action value=\"itemedgo\">\n";
		echo "<input type=hidden name=id value=$id>\n";
		echo "<tr><td>Name</td>  <td><input type=textbox name=name value=\"$thisitem->name\" size=50></td></tr>\n";
        if(empty($thisitem->image)) $thisitem->image="item__blank.gif";
		echo "<tr><td>Image</td> <td><table class=dm_base><tr><td>".imgn("images/$thisitem->image",$thisitem->name)."</td><td><select name=image><option>$thisitem->image";

			$dir_count=0;
			$dirfiles=rpg_getdir("./images/");
			while(list ($key, $file) = each ($dirfiles))
			{
				if($file!=".")
					if($file!="..")
					{
						if(stristr($file,"item_")) echo "<option>$file";
						$dir_count++;
					}
			}

		echo "</td></tr></table></select></td></tr>\n";

		echo "<tr><td>Description</td><td><textarea name=description cols=45>";
		echo stripslashes($thisitem->description)."</textarea></td></tr>\n";


		echo "<tr><td>Damage (low)</td> <td><input type=textbox name=damage value=\"$thisitem->damage\" size=5></td></tr>\n";
		echo "<tr><td>Damage (high)</td><td><input type=textbox name=damage_high value=\"$thisitem->damage_high\" size=5></td></tr>\n";

		echo "<tr><td>Durability Max(high)</td><td><input type=textbox name=durability_max value=\"$thisitem->durability_max\" size=5></td></tr>\n";

		echo "<tr><td>HP (mod)</td> <td><input type=textbox name=hp_mod value=\"$thisitem->hp_mod\" size=5></td></tr>\n";
		echo "<tr><td>POW (mod)</td><td><input type=textbox name=pow_mod value=\"$thisitem->pow_mod\" size=5></td></tr>\n";
		echo "<tr><td>STR (mod)</td><td><input type=textbox name=str_mod value=\"$thisitem->str_mod\" size=5></td></tr>\n";
		echo "<tr><td>AGL (mod)</td><td><input type=textbox name=agl_mod value=\"$thisitem->agl_mod\" size=5></td></tr>\n";
		echo "<tr><td>INT (mod)</td><td><input type=textbox name=int_mod value=\"$thisitem->int_mod\" size=5></td></tr>\n";
		echo "<tr><td>DEF (mod)</td><td><input type=textbox name=def_mod value=\"$thisitem->def_mod\" size=5></td></tr>\n";

		echo "<tr><td>Wear Slot</td><td><select name=wear_slot>";

		if($thisitem->wear_slot!="")
		{
			if($thisitem->wear_slot=="item_head") echo "<option value=item_head>Head";
			if($thisitem->wear_slot=="item_back") echo "<option value=item_chest>Back";
			if($thisitem->wear_slot=="item_chest") echo "<option value=item_chest>Chest";
			if($thisitem->wear_slot=="item_hands") echo "<option value=item_hands>Hands";
			if($thisitem->wear_slot=="item_feet") echo "<option value=item_feet>Feet";
			if($thisitem->wear_slot=="item_legs") echo "<option value=item_legs>Legs";
			if($thisitem->wear_slot=="item_arms") echo "<option value=item_arms>Arms";
			if($thisitem->wear_slot=="item_weapon1") echo "<option value=item_weapon1>Hand 1";
			if($thisitem->wear_slot=="item_sechand") echo "<option value=item_sechand>Hand 2";
		}
		else
		    echo "<option>";
		echo "<option value=item_head>Head";
		echo "<option value=item_back>Back";
		echo "<option value=item_chest>Chest";
		echo "<option value=item_hands>Hands";
		echo "<option value=item_feet>Feet";
		echo "<option value=item_legs>Legs";
		echo "<option value=item_arms>Arms";
		echo "<option value=item_weapon1>Hand 1";
		echo "<option value=item_sechand>Hand 2";
		echo "</select></td></tr>";

		echo "<tr><td>Useable</td><td><select name=useable>";
		if($thisitem->useable==1) echo "<option value=1>Yes<option value=0>No";
		else echo "<option value=0>No<option value=1>Yes";
		echo "</select></td></tr>";

		echo "<tr><td>Action</td><td><select name=rpg_action>";
		echo "<option>$thisitem->action";
		$result=dm_query("select * from rpg_actions");
		$nact=mysql_num_rows($result);
		echo "<option> ";
		for($i=0;$i<$nact;$i++)
		{
			$act=mysql_fetch_object($result);
			echo "<option>$act->id";		
		}
		echo "</select></td></tr>";

		echo "<tr><td>Charges </td><td><input type=textbox name=charges value=\"$thisitem->charges\" size=5></td></tr>\n";
		echo "<tr><td>Charges (max)</td><td><input type=textbox name=charges_max value=\"$thisitem->charges_max\" size=5></td></tr>\n";


		echo "<tr><td>Required Level</td><td><select name=required_level><option>$thisitem->required_level";
		for($i=1;$i<999;$i++) echo "<option>$i";
		echo "</select></td></tr>\n";

		echo "<tr><td>Unique</td><td><select name=unique><option>$thisitem->unique<option>no<option>yes</select></td></tr>";

		echo "<tr><td>Sellable</td><td><select name=\"sellable\">";
		echo "<option>$thisitem->sellable";		
		echo "<option>yes<option>no";
		echo "</select></td></tr>";

		echo "<tr><td>Sell Value</td><td><input type=textbox name=sell_value value=\"$thisitem->sell_value\" size=5></td></tr>\n";

		echo "<tr><td>Tradeable</td><td><select name=\"tradeable\">";
		echo "<option>$thisitem->tradeable";		
		echo "<option>yes<option>no";
		echo "</select></td></tr>";

		echo "<tr><td>Quest Item</td><td><select name=quest><option>$thisitem->quest<option>no<option>yes</select></td></tr>\n";

		echo "<tr><td>Craft Mat</td><td><select name=craft_mat><option>$thisitem->craft_mat<option>no<option>yes</select></td></tr>\n";

		echo "<tr><td><input type=submit value=\"Edit\" name=\"Go\"></td><td>&nbsp;</td></tr>\n";
		echo "</form>\n";
		echo "</table>\n";

		echo "</td><td valign=top>";
        echo "<p class=dm_warning>Image Files:</p>";

		echo "<table border=0 valign=top>\n";

			$dir_count=0;
			$dirfiles=rpg_getdir("./images/");
            echo "<tr>"; $tln=0;
			while(list ($key, $file) = each ($dirfiles))
			{
				if($file!=".")
					if($file!="..")
					{
						if(stristr($file,"item_"))
						{
							echo "<td>".imgn("images/$file",$file)."<br>$file</td>";
                            $tln++; if($tln>2) { $tln=0; echo "</tr><tr>"; }
                        }
					}
			}
		echo "</tr></table>\n";

		echo "</td>";

		echo "<td valign=top>";
		echo "<p class=dm_warning>Actions:</p>";

		echo "<table class=dm_base>\n";
		
		$result=dm_query("select * from rpg_actions order by `action`");
		$nact=mysql_num_rows($result);
		
		for($i=0;$i<$nact;$i++)
		{
			$act=mysql_fetch_object($result);
			echo "<tr><td>$act->id</td><td>";

			echo "$act->action ";
            if(!empty($act->value))    echo "$act->value";

			echo"</td></tr>";
		}
		echo "</table>\n";

		echo "</td>";
		echo "</tr></table>\n";
		exit();
	}

	if($action=="item")
	{
        if(empty($type)) $result=dm_query("select * from rpg_items order by wear_slot desc, required_level ");
        else
        {
          switch($type)
          {
            case "item_weapon1":
            case "item_head":
            case "item_back":
            case "item_chest":
            case "item_hands":
            case "item_feet":
            case "item_legs":
            case "item_arms":
            case "item_sechand":
                $sort=" where `wear_slot`='$type' ";
            break;
            
		    case "useable":
                $sort=" where `useable`='1' ";
            break;

		    case "tradeable":
		    case "quest":
		    case "craft_mat":
                $sort=" where `$type`='yes' ";
            break;
            
            case "base":
            case "recipe":
                $sort=" where `name` like '%$type%' ";
                break;

            default:
            break;

          }

          $result=dm_query("select * from rpg_items $sort order by required_level ");
        }
		$numitems=mysql_num_rows($result);
		echo "<h1>Items</h1>\n";
		
        echo "<table class=dm_base><tr>";

        echo "<td>[<a href=\"rpg_build.php?action=itemadd\">add new item</a>]</td>";

        echo "<td>Display:</td>";
        

        //echo "<td>[<a href=\"rpg_build.php?action=item&type=item_weapon1\">Hand 1</a>]</td>";



        echo "<td>";
        echo "<table border=0 cellspacing=0 cellpadding=0><tr><form action=rpg_build.php method=post>\n";
        echo "<input type=hidden name=action value=item>\n";
        echo "<select name=type onchange=\"this.form.submit();\">\n";
        if(!empty($type)) echo "<option>$type";
   		echo "<option value=all>All";
		echo "<option value=item_head>Head";
		echo "<option value=item_back>Back";
		echo "<option value=item_chest>Chest";
		echo "<option value=item_hands>Hands";
		echo "<option value=item_feet>Feet";
		echo "<option value=item_legs>Legs";
		echo "<option value=item_arms>Arms";
		echo "<option value=item_weapon1>Hand 1";
		echo "<option value=item_sechand>Hand 2";
		echo "<option value=useable>Useable";
		echo "<option value=tradeable>Tradeable";
		echo "<option value=quest>Quest";
		echo "<option value=craft_mat>Craft Mat";
		
        echo "<option value=base>Base Upgrade";
        echo "<option value=recipe>Recipe";        

        echo "</select>";
        //</td><td>&nbsp;</td><td><input type=submit value=Go! name=Go!></td></tr>";
        echo "</form></table>\n";
        echo "</td>";



        echo "</tr></table>";

		echo "<table class=dm_base>\n";
		echo "<tr><td></td><td></td><td></td><td></td><td>Level</td><td>Damage</td><td>Value</td><td>Defense</td></tr>";
		for($i=0;$i<$numitems;$i++)
		{
			$item=mysql_fetch_object($result);
			$item->name=stripslashes($item->name);
			$item->description=stripslashes($item->description);
			echo "<tr>";
			echo "<td>[<a href=\"rpg_build.php?action=itemed&id=$item->id\">edit</a>]</td>\n";
			echo "<td>[<a href=\"rpg_build.php?action=itemclone&id=$item->id\">clone</a>]</td>\n";
			echo "<td>".rpg_itemlink($item->id)."</td>";
			echo "<td>$item->name</td>\n";
			echo "<td>$item->wear_slot</td>";
			echo "<td align=right>$item->required_level</td>";
			echo "<td align=right>$item->damage - $item->damage_high</td>";
			echo "<td align=right>$$item->sell_value</td>";
			echo "<td align=right>$item->def_mod</td>";
			echo"</tr>";
		}
		echo "</table>";
		for($i=0;$i<10;$i++) echo "<p>&nbsp;</p>";
		exit();
	}
	
	//Loot

	if($action=="lootaddgo")
	{
		$lt=array();
		echo "<h1>New loot table added</h1>";
		$result=dm_query("select * from rpg_items");
		$numitems=mysql_num_rows($result);
		for($i=0;$i<$numitems;$i++)
		{
			$thisitem=mysql_fetch_object($result);
			$duh=$_REQUEST["loot_$thisitem->id"];
			if($_REQUEST["loot_$thisitem->id"]=="1")
			{	
				$lootlow =$_REQUEST["lootlow_$thisitem->id"];
				$loothigh=$_REQUEST["loothigh_$thisitem->id"];
				$lootprct=$_REQUEST["lootprct_$thisitem->id"];
				echo "<p>Item included [$thisitem->name] with a %$lootprct chance to drop from [$lootlow] to [$loothigh]</p>";
				array_push($lt,"$thisitem->id;$lootlow;$loothigh;$lootprct");
			}
		}
		$totlt=rpg_combine($lt);
		dm_query("insert into rpg_loot_table values ('','$totlt')");
		$action="loot";
	}

	if($action=="lootedgo")
	{
		$lt=array();
		echo "<h1>Loot table updated</h1>";
		$result=dm_query("select * from rpg_items");
		$numitems=mysql_num_rows($result);
		for($i=0;$i<$numitems;$i++)
		{
			$thisitem=mysql_fetch_object($result);
			$thisitem->name=stripslashes($thisitem->name);
			$duh=$_REQUEST["loot_$thisitem->id"];
			if($_REQUEST["loot_$thisitem->id"]=="1")
			{	
				$lootlow =$_REQUEST["lootlow_$thisitem->id"];
				$loothigh=$_REQUEST["loothigh_$thisitem->id"];
				$lootprct=$_REQUEST["lootprct_$thisitem->id"];
				echo "<p>Item included [$thisitem->name] with a %$lootprct chance to drop from [$lootlow] to [$loothigh]</p>";
				array_push($lt,"$thisitem->id;$lootlow;$loothigh;$lootprct");
			}
		}
		$totlt=rpg_combine($lt);
		dm_query("update rpg_loot_table set `data`='$totlt' where `id`='$id'");
		$action="loot";
	}

	if( ($action=="looted") || ($action=="lootadd") )
	{
      if($action=="looted")
      {	$rresult=dm_query("select * from rpg_loot_table where id = '$id'");
		$loot=mysql_fetch_object($rresult);
		$its=explode("|",$loot->data);
		echo "<h1>Edit loot table</h1>\n";      }
      else { echo "<h1>Add Loot Table</h1>\n"; }
		


        echo "<table border=0 cellspacing=0 cellpadding=0><tr><form action=rpg_build.php method=post>\n";
        echo "<input type=hidden name=action value=looted>\n";
        echo "<input type=hidden name=id value=$id>\n";
        echo "<select name=type onchange=\"this.form.submit();\">\n";
        if(!empty($type)) echo "<option>$type"; else echo "<option>Filter:";
                echo "<option value=this>This Loot Table";
   		echo "<option value=all>All";
		echo "<option value=item_head>Head";
		echo "<option value=item_back>Back";
		echo "<option value=item_chest>Chest";
		echo "<option value=item_hands>Hands";
		echo "<option value=item_feet>Feet";
		echo "<option value=item_legs>Legs";
		echo "<option value=item_arms>Arms";
		echo "<option value=item_weapon1>Hand 1";
		echo "<option value=item_sechand>Hand 2";
		echo "<option value=useable>Useable";
		echo "<option value=tradeable>Tradeable";
		echo "<option value=quest>Quest";
		echo "<option value=craft_mat>Craft Mat";
		
        echo "<option value=base>Base Upgrade";
        echo "<option value=recipe>Recipe";        

        echo "</select>";
        //</td><td>&nbsp;</td><td><input type=submit value=Go! name=Go!></td></tr>";
        echo "</form></table>\n";
        
 if(empty($type)) $result=dm_query("select * from rpg_items order by wear_slot desc, required_level ");
        else
        {
          switch($type)
          {
            case "item_weapon1":
            case "item_head":
            case "item_back":
            case "item_chest":
            case "item_hands":
            case "item_feet":
            case "item_legs":
            case "item_arms":
            case "item_sechand":
                $sort=" where `wear_slot`='$type' ";
            break;
            
		    case "useable":
                $sort=" where `useable`='1' ";
            break;

		    case "tradeable":
		    case "quest":
		    case "craft_mat":
                $sort=" where `$type`='yes' ";
            break;
            
            case "base":
            case "recipe":
                $sort=" where `name` like '%$type%' ";
                break;

            default:
            break;

          }

          $result=dm_query("select * from rpg_items $sort order by wear_slot desc, required_level ");
        }

         //       $result=dm_query("select * from rpg_items order by wear_slot desc, required_level ");
		$numitems=mysql_num_rows($result);
		echo "<table class=dm_base>\n<form action=rpg_build.php method=post>";
                echo "<input type=hidden name=action value=\"$action"."go\"><input type=hidden name=id value=$id>\n";
		for($i=0;$i<$numitems;$i++)
		{
			$thisitem=mysql_fetch_object($result);
			$floot=0;
			for($j=0;$j<count($its);$j++)
			{
				$lts=explode(";",$its[$j]);
				$item=rpg_getlootobj($lts[0]);
				if($thisitem->id==$item->id)
				{

					$lootlow=$lts[1];
					$loothigh=$lts[2];
					$lootprct=$lts[3];
					if($item->image=="") $item->image="nopic.gif";
					if(!file_exists("images/$item->image")) $item->image="nofile.gif";
					echo "<tr><td><input type=\"checkbox\" name=\"loot_$item->id\" value=\"1\" class=dm_select_pic checked></td>";
					echo "<td>";
					echo rpg_itemlink($item->id);
					echo "</td>";
					echo "<td>Lvl $item->required_level</td>";
					echo "<td>Qty Low  </td><td><input type=textbox size=5 name=lootlow_$item->id  value=$lootlow></td>";
					echo "<td>Qty High </td><td><input type=textbox size=5 name=loothigh_$item->id value=$loothigh></td>";
					echo "<td>Drop % </td><td><input type=textbox size=5 name=lootprct_$item->id value=$lootprct></td>";
					echo "</tr>";
					$floot=1;

				}

			}
			if($floot==0)
			{
			  if($type!="this")
			  {
				echo "<tr><td><input type=\"checkbox\" name=\"loot_$thisitem->id\" value=\"1\" class=dm_select_pic></td>";
				if($thisitem->image=="") $thisitem->image="nopic.gif";
				if(!file_exists("images/$thisitem->image")) $thisitem->image="nofile.gif";
				echo "<td>".rpg_itemlink($thisitem->id)."</td>";
					echo "<td>Lvl $thisitem->required_level</td>";
				echo "<td>Qty Low  </td><td><input type=textbox size=5 name=lootlow_$thisitem->id  value=1></td>";
				echo "<td>Qty High </td><td><input type=textbox size=5 name=loothigh_$thisitem->id value=1></td>";
				echo "<td>Drop % </td><td><input type=textbox size=5 name=lootprct_$thisitem->id value=100></td>";
				echo "</tr>";
			  }
			}
		}
		echo "<tr><td><input type=submit value=Go></td><td></td></tr></form></table>";
		exit();
	}
	
	if($action=="loot")
	{
		$result=dm_query("select * from rpg_loot_table order by `id`");
		$numitems=mysql_num_rows($result);
		echo "<h1>Loot Tables</h1><table class=dm_base><tr><td>[<a href=\"rpg_build.php?action=lootadd\">add new loot table</a>]</td></tr></table><table class=dm_base>\n";
		for($i=0;$i<$numitems;$i++)
		{
			$loot=mysql_fetch_object($result);
			echo "<tr><td>[<a href=\"rpg_build.php?action=looted&id=$loot->id\">edit</a>]</td><td>$loot->id</td><td>";
			$its=explode("|",$loot->data);
			for($j=0;$j<count($its);$j++)
			{
				$lts=explode(";",$its[$j]);
				$item=rpg_getlootobj($lts[0]);
				if($item->image=="") $item->image="nopic.gif";
				if(!file_exists("images/$item->image")) $item->image="nofile.gif";
				echo imgs("images/$item->image",$item->name,16,16);
			}
			echo "</td></tr>";
		}
		echo "</table>";
		exit();
	}

	//Classes

	if($action=="classdel")
	{
		$result=dm_query("select * from rpg_classes where `id`='$classid'");
		$cls=mysql_fetch_object($result);
		echo "<h1>Delete Class ($cls->name)</h1>";
		echo "<p>Are you sure? [<a href=rpg_build.php?action=classdelgo&classid=$classid>Yes</a>/<a href=rpg_build.php?action=class>No</a>]</p>";
		exit();
	}

	if($action=="classdelgo")
	{
		$result=dm_query("delete from rpg_classes where `id`='$classid'");
		echo "<h1>Class Deleted!</h1>";
		
		$action="class";
	}

    if($action=="classnewgo")
	{
		echo "<h1>Class $name Added</h1>\n";
		$qr=	"INSERT INTO `rpg_classes` ";
		$qr.=          "( `name`,  `info`,  `image`,  `alignment`,  `start_hp`, `start_pow`,  `start_str`, `start_int`, `start_agl`, `start_def`) ";
		$qr.=	"VALUES ('$name', '$info', '$image', '$alignment', '$start_hp', '$start_pow', '$start_str', '$start_int', '$start_agl', '$start_def');";
		dm_query($qr);
		$action="class";
	}
	
		if($action=="classedgo")
	{

		echo "<h1>$name changed</h1>";

		dm_query ("UPDATE rpg_classes SET `name` = '$name' where `id` = '$classid'");
		dm_query ("UPDATE rpg_classes SET `alignment` = '$alignment' where `id` = '$classid'");
		dm_query ("UPDATE rpg_classes SET `image` = '$image' where `id` = '$classid'");
		dm_query ("UPDATE rpg_classes SET `info` = '$info' where `id` = '$classid'");
		dm_query ("UPDATE rpg_classes SET `start_hp` = '$start_hp' where `id` = '$classid'");
		dm_query ("UPDATE rpg_classes SET `start_pow` = '$start_pow' where `id` = '$classid'");
		dm_query ("UPDATE rpg_classes SET `start_str` = '$start_str' where `id` = '$classid'");
		dm_query ("UPDATE rpg_classes SET `start_int` = '$start_int' where `id` = '$classid'");
		dm_query ("UPDATE rpg_classes SET `start_agl` = '$start_agl' where `id` = '$classid'");
		dm_query ("UPDATE rpg_classes SET `start_def` = '$start_def' where `id` = '$classid'");

		$action="class";
	}

	if( ($action=="classed") || ($action=="classnew") )
	{
      if($action=="classed")
      {
		$result=dm_query("select * from rpg_classes where id='$classid'");
		$cls=mysql_fetch_object($result);
		$cls->info=stripslashes($cls->info);
		$cls->name=stripslashes($cls->name);
	    echo "<h1>Editing $cls->name</h1>";
		echo imgn("images/$cls->image",$cls->image);
      }
      else
      {
		echo "<h1>Add Class</h1>\n";
        $cls="";
      }
		echo "<table border=0><tr><td valign=top>";
		echo "<table class=dm_base>";
		echo "<form action=rpg_build.php method=post>\n";
		$toact=$action."go";
       	echo "<input type=hidden name=action value=$toact>\n";
		echo "<input type=hidden name=classid value=$cls->id>\n";

		echo "<tr><td>Name</td><td><input name=name value=$cls->name></td></tr>";
		echo "<tr><td>Alignment</td><td><select name=alignment><option>$cls->alignment<option>Good<option>Evil</select></td></tr>";
		
		echo "<tr><td>Image</td> <td><select name=image><option>$cls->image";

			$dir_count=0;
			$dirfiles=rpg_getdir("./images/");
			while(list ($key, $file) = each ($dirfiles))
			{
				if($file!=".")
					if($file!="..")
					{
						if(stristr($file,"class-")) echo "<option>$file";
						$dir_count++;
					}
			}

		echo "</select></td></tr>\n";
		echo "<tr><td>Description</td><td><textarea name=info cols=45 rows=6>$cls->info</textarea></td></tr>\n";
		echo "<tr><td>Starting HP</td><td><input name=start_hp value=$cls->start_hp></td></tr>";
		echo "<tr><td>Starting POW</td><td><input name=start_pow value=$cls->start_pow></td></tr>";
		echo "<tr><td>Starting STR</td><td><input name=start_str value=$cls->start_str></td></tr>";
		echo "<tr><td>Starting INT</td><td><input name=start_int value=$cls->start_int></td></tr>";
		echo "<tr><td>Starting AGL</td><td><input name=start_agl value=$cls->start_agl></td></tr>";
		echo "<tr><td>Starting DEF</td><td><input name=start_def value=$cls->start_def></td></tr>";

		echo "<tr><td><input type=submit value=\"Modify Class\"></td></tr>";
		echo "</form>";
		echo "</table>";

		echo "</td><td valign=top>";
		echo "<p class=dm_warning>Class Image Files:</p>";

		echo "<table class=dm_base>\n";

			$dir_count=0;
			$dirfiles=rpg_getdir("./images/");
			while(list ($key, $file) = each ($dirfiles))
			{
				if($file!=".")
					if($file!="..")
					{
						if(stristr($file,"class-"))
							echo "<tr><td>".imgn("images/$file",$file)."</td><td>$file</td></tr>";
						$dir_count++;
					}
			}
		echo "</table>\n";

		echo "</td></tr></table>";
		exit();
	}

	if($action=="class")
	{
		echo "<h1>Classes</h1>";
		$result=dm_query("select * from rpg_classes");
		
		echo "<p>[<a href=rpg_build.php?action=classnew>add new class</a>]</p>";

		echo "<table border=0>";		
	
		$numclasses=mysql_num_rows($result);
		for($i=0;$i<$numclasses;$i++)
		{
			$cls=mysql_fetch_object($result);
			echo "<tr>";

			echo "<td>[<a href=rpg_build.php?action=classdel&classid=$cls->id>delete</a>]</td>";
			echo "<td>[<a href=rpg_build.php?action=classed&classid=$cls->id>edit</a>]</td>";

			echo "<td>$cls->name</td>";
			echo "<td>$cls->alignment</td>";
			echo "<td><img src=images/$cls->image></td>";
			echo "<td width=170>$cls->info</td>";
			echo "<td>starting <br>hp:$cls->start_hp <br>pow:$cls->start_pow <br>str:$cls->start_str <br>int:$cls->start_int <br>agl:$cls->start_agl <br>def:$cls->start_def</td>";
			echo "</tr>";
		}

		echo "</table>";
		exit();
	}
	
	//Users

	if($action=="useredgo")
	{
		dm_query ("UPDATE users SET `email` = '$email' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg` = '$rpg' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_name` = '$rpg_name' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_hp` = '$rpg_hp' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_hpmax` = '$rpg_hpmax' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_pow` = '$rpg_pow' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_powmax` = '$rpg_powmax' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_str` = '$rpg_str' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_int` = '$rpg_int' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_agl` = '$rpg_agl' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_def` = '$rpg_def' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_level` = '$rpg_level' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_trainpoints` = '$rpg_trainpoints' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_abilities` = '$rpg_abilities' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_exp` = '$rpg_exp' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_totalexp` = '$rpg_totalexp' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_class` = '$rpg_class' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_x` = '$rpg_x' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_y` = '$rpg_y' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_z` = '$rpg_z' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_cash` = '$rpg_cash' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_ap` = '$rpg_ap' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_base` = '$rpg_base' where `id` = '$id'");
		dm_query ("UPDATE users SET `rpg_lastaction` = '$rpg_lastaction' where `id` = '$id'");

		$action="useredit";
	}

	if($action=="useredgiveitem")
	{
		rpg_giveitemuser($userid,$itemid,1);
		$action="useredit"; $id=$userid;
		rpg_refresh("right","rpg_rightpane.php");
	}

	if($action=="useredit")
	{
		$result=dm_query("select * from users where `id`='$id'");
		$user=mysql_fetch_object($result);
		echo "<h1>Edit $user->name ($user->rpg_name)</h1>";

		echo "<table border=0><tr><td valign=top>";

		echo "<table border=0>";

		echo "<form action=rpg_build.php method=post>\n";
        	echo "<input type=hidden name=action value=useredgo>\n";
		echo "<input type=hidden name=id value=$id>\n";
				
		echo "<tr><td>email</td><td><input name=email value=\"$user->email\"></td></tr>";

		echo "<tr><td>rpg</td><td><input name=rpg value=\"$user->rpg\"></td></tr>";		
		echo "<tr><td>rpg_name</td><td><input name=rpg_name value=\"$user->rpg_name\"></td></tr>";
		echo "<tr><td>rpg_hp</td><td><input name=rpg_hp value=\"$user->rpg_hp\"></td></tr>";
		echo "<tr><td>rpg_hpmax</td><td><input name=rpg_hpmax value=\"$user->rpg_hpmax\"></td></tr>";
		echo "<tr><td>rpg_pow</td><td><input name=rpg_pow value=\"$user->rpg_pow\"></td></tr>";
		echo "<tr><td>rpg_powmax</td><td><input name=rpg_powmax value=\"$user->rpg_powmax\"></td></tr>";
		echo "<tr><td>rpg_str</td><td><input name=rpg_str value=\"$user->rpg_str\"></td></tr>";
		echo "<tr><td>rpg_int</td><td><input name=rpg_int value=\"$user->rpg_int\"></td></tr>";
		echo "<tr><td>rpg_agl</td><td><input name=rpg_agl value=\"$user->rpg_agl\"></td></tr>";
		echo "<tr><td>rpg_def</td><td><input name=rpg_def value=\"$user->rpg_def\"></td></tr>";
		echo "<tr><td>rpg_level</td><td><input name=rpg_level value=$user->rpg_level></td></tr>";
		echo "<tr><td>rpg_trainpoints</td><td><input name=rpg_trainpoints value=$user->rpg_trainpoints></td></tr>";
		echo "<tr><td>rpg_abilities</td><td><textarea name=rpg_abilities cols=45 rows=6>$user->rpg_abilities</textarea></td></tr>";
		echo "<tr><td>rpg_base</td><td><textarea name=rpg_base cols=45 rows=6>$user->rpg_base</textarea></td></tr>";
		echo "<tr><td>rpg_exp</td><td><input name=rpg_exp value=$user->rpg_exp></td></tr>";
		echo "<tr><td>rpg_totalexp</td><td><input name=rpg_totalexp value=$user->rpg_totalexp></td></tr>";
		echo "<tr><td>rpg_class</td><td><input name=rpg_class value=$user->rpg_class></td></tr>";
		echo "<tr><td>rpg_x</td><td><input name=rpg_x value=$user->rpg_x></td></tr>";
		echo "<tr><td>rpg_y</td><td><input name=rpg_y value=$user->rpg_y></td></tr>";
		echo "<tr><td>rpg_z</td><td><input name=rpg_z value=$user->rpg_z></td></tr>";
		echo "<tr><td>rpg_cash</td><td><input name=rpg_cash value=$user->rpg_cash></td></tr>";

		echo "<tr><td>rpg_lastaction</td><td><input name=rpg_lastaction value=$user->rpg_lastaction></td></tr>";
		echo "<tr><td>rpg_ap</td><td><input name=rpg_ap value=$user->rpg_ap></td></tr>";

		echo "<tr><td>&nbsp;</td><td><input type=submit value=\"Modify User\"></td></tr>";
		echo "</form>";

		echo "</table>";

		/*   rpg   rpg_name  rpg_hp  rpg_hpmax  rpg_pow  rpg_powmax  rpg_str  rpg_int  rpg_agl  rpg_def  rpg_inventory  rpg_level  rpg_trainpoints  rpg_abilities  rpg_exp  rpg_totalexp
		     rpg_class  rpg_x  rpg_y  rpg_z  rpg_cash  rpg_lastaction  rpg_ap   rpg_align   // ??  rpg_eq_head // ??  rpg_encounter  rpg_slot_head  rpg_slot_hands  rpg_slot_legs
		     rpg_slot_arms   rpg_slot_feet  rpg_slot_chest  rpg_slot_back  rpg_slot_mainhand  rpg_slot_sechand */ 

		echo "</td><td valign=top>";

		$result=dm_query("select * from rpg_items order by wear_slot desc");
		$numitems=mysql_num_rows($result);
		echo "<table class=dm_base>\n";
		for($i=0;$i<$numitems;$i++)
		{
			$item=mysql_fetch_object($result);
			$item->name=stripslashes($item->name);
			$item->description=stripslashes($item->description);
			echo "<tr>";
			echo "<td>[<a href=\"rpg_build.php?action=useredgiveitem&itemid=$item->id&userid=$id\">give 1</a>]</td>\n";
			echo "<td>$item->id</td><td>".rpg_itemlink($item->id)."</td><td>$item->name</td>\n";
			echo"</tr>";
		}
		echo "</table>";
		echo "</td></tr></table>";

		exit();
	}

	if($action=="users")
	{
		echo "<h1>User edit</h1>";
		$result=dm_query("select * from users");
		$numu=mysql_num_rows($result);
		echo "<table border=0>";
		for($i=0;$i<$numu;$i++)
		{
			$user=mysql_fetch_object($result);
			echo "<tr>";
			echo "<td>[<a href=\"rpg_build.php?action=useredit&id=$user->id\">edit</a>]</td>";
			echo "<td>$user->name</td>";
			echo "<td>$user->rpg_name</td>";
			echo "<td> level $user->rpg_level</td>";
			$res=dm_query("select * from rpg_classes where `id`='$user->rpg_class'"); $cls=mysql_fetch_object($res);
			echo "<td> $cls->name ($cls->alignment)</td>";
			echo "</tr>";
		}
		echo "</table>";
		exit();
	}


}
echo "</td></tr></table>";

include("rpg_footer.php");
?>
