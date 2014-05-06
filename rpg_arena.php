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
if($data->rpg=="yes")
{
	echo "<h1>Arena</h1>";
	if($action=="duel")
	{
      if($data->rpg_ap>0)
      {

		$player=getuserdata($id);

		if( !stristr(($player->rpg_base),"henchmen_generator") )
		{
          inform("$player->rpg_name does not have a henchmen generator!");
        }
        else
        {
            rpg_setvar("rpg_ap",$data->rpg_ap-1);

            inform("You launch an attack against $player->rpg_name's base.");
            inform("Your henchmen: $data->rpg_henchmen");
            inform2("$player->rpg_name's henchmen: ?");


            //echo "<p>What is your objective:</p>";
            //		echo "<p>        Money <br>		Bank <br>		Base Infrastructure <br>		Henchmen Loyalty <br>      </p>";
            

            if($player->rpg_henchmen>$data->rpg_henchmen)
            {
                $hr=$data->rpg_henchmen;
                echo "<p>$player->rpg_name $hr</p>";
            }
            else
            {
                $hr=$player->rpg_henchmen;
                $cp=round(($data->rpg_henchmen-$player->rpg_henchmen)/500);
            }

            $ct=0; $cy=0;
            for($i=0;$i<$hr;$i++)
            {
              if(rand(0,100)>50) $ct++;
              if(rand(0,100)>50) $cy++;
            }
            $ct+=$cp;
            echo "<p>$cp</p>";
            


            inform("$player->rpg_name henchmen killed $ct");
            inform("$data->rpg_name henchmen killed $cy");

            $data->rpg_henchmen-=$cy;

            rpg_setvar("rpg_henchmen",$data->rpg_henchmen);
            $player->rpg_henchmen-=$ct;
            rpg_setvaruser($player->id,"rpg_henchmen",$player->rpg_henchmen);


            // to do: add some checks here
            // if(rand(1,100)>50) $win="yes";
            if($cy<$ct) $win="yes";

            if($win=="yes")
            {
                $hi=rand(6,60)/1000;
                $mn=round(($player->rpg_cash*$hi),2);
                //echo "$hi / $mn";
                inform("You win! You take ".rpg_money_format($mn)." from $player->rpg_name");
      
                rpg_setvar("rpg_cash",$data->rpg_cash+$mn);
                rpg_setvar("rpg_pvp_won",$data->rpg_pvp_won+1);
                rpg_setvaruser($player->id,"rpg_cash",$player->rpg_cash-$mn);
                rpg_setvaruser($player->id,"rpg_pvp_lost",$player->rpg_pvp_lost+1);
                
                $hi=rand(6,60)/1000;
                $hm=round(($player->rpg_henchmen*$hi));

                inform("$hm henchmen defect to your side");
                rpg_setvar("rpg_henchmen",$data->rpg_henchmen+$hm);
                rpg_setvaruser($player->id,"rpg_henchmen",$player->rpg_henchmen-$hm);

                $hm+=$ct;
                pmsg($player->rpg_name,"Imacomputa","PvP Lost","You lost a PvP battle against $data->rpg_name. You lost ".rpg_money_format($mn)." and $hm henchmen");

                // add pvp email option
            }
            else
            {
                $hi=rand(6,60)/1000;
                $mn=round(($data->rpg_cash*$hi),2);
                inform("You lose! $player->rpg_name takes ".rpg_money_format($mn)." from you");
      
                rpg_setvar("rpg_cash",$data->rpg_cash-$mn);
                rpg_setvar("rpg_pvp_lost",$data->rpg_pvp_lost+1);
                rpg_setvaruser($player->id,"rpg_cash",$player->rpg_cash+$mn);
                rpg_setvaruser($player->id,"rpg_pvp_won",$player->rpg_pvp_won+1);
                
                $hi=rand(6,60)/1000;
                $hm=round(($data->rpg_henchmen*$hi));
                
                inform("$hm henchmen defect to $player->rpg_name's side");
                $data->rpg_henchmen-=$hm;
                rpg_setvar("rpg_henchmen",$data->rpg_henchmen);
                rpg_setvaruser($player->id,"rpg_henchmen",$player->rpg_henchmen+$hm);
      

            }
            
            inform("You now have $data->rpg_henchmen henchmen");
            rpg_refresh("charpane","rpg_character.php");
        }
    }
   else
   {
     inform("Not enough AP");
   }

 }


}
else
{
	echo "<p>Create a character first!</p>\n";
	
}


include("rpg_footer.php");
?>

