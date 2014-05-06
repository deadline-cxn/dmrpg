<?
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////

include("rpg_header.php");
$data=getuserdata($HTTP_SESSION_VARS['valid_user']);
if(empty($id)) $id=$data->id;
if($HTTP_SESSION_VARS["logged_in"]!="true")
{
  	rpg_refresh("top","index.php");
    include("rpg_footer.php");
    exit();
}


if($data->rpg=="yes")
{
  
  if($action=="make")
  {
    $rcp=rpg_getrecipeobj($recipe);

    inform("Making $rcp->name...");

    $craft_mats=rpg_getloottable($rcp->craft_mats);
    $created_items=rpg_getloottable($rcp->created_items);


    $ct=0;
    $ci=explode("|",$craft_mats->data);
    for($i=0;$i<count($ci);$i++)
    {
      $cri=explode(";",$ci[$i]);
      $it=rpg_getitemobj($cri[0]);

      if($cri[1]<=rpg_inventory_qty($it->id)) $ct++;
      else
      {
        inform2("Missing craft material: $it->name x".$cri[1]);
      }
    }
    if($ct==count($ci))
    {
      //all mats available
      //echo "<p>MAKING IT</p>";
      for($i=0;$i<count($ci);$i++)
      {
        $cri=explode(";",$ci[$i]);
        rpg_takeitem($cri[0],$cri[1]);
      }
      $cti=explode("|",$created_items->data);
      for($i=0;$i<count($cti);$i++)
      {
        $cri=explode(";",$cti[$i]);
        if($cri[1]==$cri[2])
        {
          rpg_giveitem($cri[0],$cri[1]);
        }
        else
        {
          rpg_giveitem($cri[0],rand($cri[1],$cri[2]));
        }
      }


      if( $data->rpg_craft_skill-$rcp->recipe_skill < 5 )
      {
        rpg_craft_skill_add(1);
      }
      else
      if( $data->rpg_craft_skill-$rcp->recipe_skill < 10 )
      {
        if(rand(1,100)>20)
         rpg_craft_skill_add(1);
      }
      else
      if( $data->rpg_craft_skill-$rcp->recipe_skill < 15 )
      {
        if(rand(1,100)>50)
         rpg_craft_skill_add(1);
      }
      else
      if( $data->rpg_craft_skill-$rcp->recipe_skill < 20 )
      {
        if(rand(1,100)>90)
         rpg_craft_skill_add(1);
      }






      rpg_refresh("right","rpg_rightpane.php");

    }

  }


  if( (empty($data->rpg_craft)) || ($data->rpg_craft=="0") )
  {
    inform("You don't know any crafts");
  }
  else
  {
    $crft=rpg_getcraftobj($data->rpg_craft);
    echo "<h1>$crft->name ($data->rpg_craft_skill / $data->rpg_craft_skill_max)</h1>";
    $out=$crft->skill_99;
    if($data->rpg_craft_skill==500) $out=$crft->skill_500;
    else if($data->rpg_craft_skill>399) $out=$crft->skill_499;
    else if($data->rpg_craft_skill>299) $out=$crft->skill_399;
    else if($data->rpg_craft_skill>199) $out=$crft->skill_299;
    else if($data->rpg_craft_skill>99) $out=$crft->skill_199;
    echo "($out)<br>";

    echo "<img src=images/$crft->image><br>";

    echo "<table border=0><tr><td>Known recipes</td></tr></table>";
    
    echo "<table border=0>";
    $rcps=explode("|",$data->rpg_craft_recipes);
    for($i=0;$i<count($rcps);$i++)
    {
      $rcp=rpg_getrecipeobj($rcps[$i]);
      if(!empty($rcp->name))
      echo "<tr><td>[<a href=rpg_craft.php?action=make&recipe=$rcp->id>make</a>] </td><td> $rcp->name </td> </tr>";
    }

    echo "</table>";


  }

}

include("rpg_footer.php");
?>
