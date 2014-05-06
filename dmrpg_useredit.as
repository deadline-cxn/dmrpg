package
{
	import flash.display.*;
	import flash.events.*;
	import flash.utils.*;
	import flash.net.*;
	import flash.ui.Keyboard;

	public class dmrpg_useredit extends usereditpanel
	{
		var theparent:MovieClip;
	
		function dmrpg_useredit(parentMC:MovieClip)
		{
			theparent=parentMC;
			theparent.dbg.debugmsg("Hi dmrpg_useredit.as");



			x=1134;
			
			y=307;
			
			users.addEventListener(Event.CHANGE , dmue_changeuser);

			useredit_close_button.addEventListener(MouseEvent.CLICK, dm_closeuseredit);
			modify.addEventListener(MouseEvent.CLICK, dm_modifyuser);
			
			visible=false; // hide it
			theparent.addChild(this);			
		}

		function dm_closeuseredit(mev:MouseEvent):void { visible=false; }	

		function dmue_fillusers(itemz)
		{ // fill in the combo box
			users.removeAll();
			users.addItem({label:"Select User",data:"Select User"});
			for(var i=0;i<itemz.length;i++)
			{
				if(itemz[i].label!=null)
				{
					users.addItem({label:itemz[i].label,data:itemz[i].data})
				}
			}
		}		
		
		function dmue_filldata(	  rpg_name,
								  rpg_class,
								  rpg_hp,
								  rpg_hpmax,
								  rpg_pow,
								  rpg_powmax,
								  rpg_str,
								  rpg_int,
								  rpg_agl,
								  rpg_def,
								  rpg_level,
								  rpg_exp,
								  rpg_totalexp,
								  rpg,
								  rpg_trainpoints,
								  rpg_abilities,
								  rpg_craft,
								  rpg_craft_skill,
								  rpg_craft_skill_max,
								  rpg_craft_recipes,
								  rpg_bank,
								  rpg_bankcash,
								  rpg_x,
								  rpg_y,
								  rpg_z,
								  rpg_cash,
								  rpg_encounter,
								  rpg_slot_head,
								  rpg_slot_hands,
								  rpg_slot_legs,
								  rpg_slot_arms,
								  rpg_slot_feet,
								  rpg_slot_chest,
								  rpg_slot_back,
								  rpg_slot_mainhand,
								  rpg_slot_sechand,
								  rpg_lastaction,
								  rpg_ap,
								  rpg_emails,
								  rpg_base,
								  rpg_base_tower1,
								  rpg_base_tower2,
								  rpg_base_tower3,
								  rpg_base_tower4,
								  rpg_henchleaders,
								  rpg_henchmen,
								  rpg_tutorial,
								  rpg_mapsize,
								  rpg_pvp_won,
								  rpg_pvp_lost,
								  rpg_pvp_lastplayer,
								  rpg_clan,
								  rpg_clanrank,
								  rpg_quests_current,
								  rpg_quests_completed
								  )
		{
								 namebox.gtext.text=rpg_name;
								 classboxz.gtext.text= rpg_class;
								 hpbox.gtext.text= rpg_hp;
								 hpmaxbox.gtext.text= rpg_hpmax;
								 powbox.gtext.text=rpg_pow;
								 powmaxbox.gtext.text=rpg_powmax;
								 intbox.gtext.text=  rpg_str;
								 sylbox.gtext.text= rpg_int;
								 nfnbox.gtext.text=  rpg_agl;
								 calbox.gtext.text= rpg_def;

								  lvlbox.gtext.text=rpg_level;								  
     							  expbox.gtext.text=rpg_exp;
						  
								  exptotalbox.gtext.text=rpg_totalexp;
								  
								  trainpointsbox.gtext.text=rpg_trainpoints;

								  xbox.gtext.text=rpg_x;
								  ybox.gtext.text=rpg_y;
								  zbox.gtext.text=rpg_z;
								  cashbox.gtext.text=rpg_cash;
								  
								  
								  
								  
								  //	rpg_abilities;
								  //	rpg_craft;
								  //	rpg_craft_skill;
								  //	rpg_craft_skill_max;
								  //	rpg_craft_recipes;
								  //	rpg_bank;
								  //	rpg_bankcash;
								  								  
									/*
								  rpg_encounter,
								  rpg_slot_head,
								  rpg_slot_hands,
								  rpg_slot_legs,
								  rpg_slot_arms,
								  rpg_slot_feet,
								  rpg_slot_chest,
								  rpg_slot_back,
								  rpg_slot_mainhand,
								  rpg_slot_sechand,
								  rpg_lastaction,
								  rpg_ap,
								  rpg_emails,
								  rpg_base,
								  rpg_base_tower1,
								  rpg_base_tower2,
								  rpg_base_tower3,
								  rpg_base_tower4,
								  rpg_henchleaders,
								  rpg_henchmen,
								  rpg_tutorial,
								  rpg_mapsize,
								  rpg_pvp_won,
								  rpg_pvp_lost,
								  rpg_pvp_lastplayer,
								  rpg_clan,
								  rpg_clanrank,
								  rpg_quests_current,
								  rpg_quests_completed			*/
			
		}
		
		function dm_modifyuser(mev:MouseEvent):void
		{
		
			theparent.getdata("dmrpg_main.php?action=moduser"
																+"&rpg_cl="+classboxz.gtext.text
																+"&rpg_name="+namebox.gtext.text
																+"&rpg_hp="+hpbox.gtext.text
																+"&rpg_hpmax="+hpmaxbox.gtext.text
																+"&rpg_pow="+powbox.gtext.text
																+"&rpg_powmax="+powmaxbox.gtext.text
																+"&rpg_str="+intbox.gtext.text
																+"&rpg_int="+sylbox.gtext.text
																+"&rpg_agl="+nfnbox.gtext.text
																+"&rpg_def="+calbox.gtext.text
																+"&rpg_level="+lvlbox.gtext.text
																+"&rpg_exp="+expbox.gtext.text
																+"&rpg_totalexp="+exptotalbox.gtext.text
																+"&rpg_trainpoints="+trainpointsbox.gtext.text
																+"&rpg_x="+xbox.gtext.text
																+"&rpg_y="+ybox.gtext.text
																+"&rpg_z="+zbox.gtext.text
																+"&rpg_cash="+cashbox.gtext.text
																);


		}
		
		function dmue_changeuser(ev:Event):void
		{
			if(users.value!="Select Char")
				theparent.getdata("dmrpg_main.php?action=usereditgetdata&name="+users.value);
		}
		
		

	
	}
}

