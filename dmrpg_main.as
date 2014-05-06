///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
// Defective Minds RPG Flash
//
// Seth Parson
// Will Delahoussaye
//
// Copyright (c) 2009 Defective Minds ~ All Rights Reserved ~ And Stuff
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
// I tried to document as best as I could. If you don't understand something let me know and I will try to explain it.
// I don't really know what I am doing. There is a very big learning curve to AS3.
// This AS3 language blows ass btw.
// I am just piecing this shit together from bits and pieces I find on the internet.
// AS3 sucks ass! I wish they would have made it more like C++ or PHP. FUCK them.
// So lets get this ball rolling... Seriously this language can lick my balls.
// omg as3 is the worst language out there why?
// Adobe can suck my penis
// Retarded language
// Fuck fuck fuck fuck fuck 
//
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

package
{

	import flash.display.*;
	import flash.events.*;
	import flash.utils.*;
	import flash.net.*;
	import flash.ui.Keyboard;
	import flash.ui.Mouse;
	import fl.controls.UIScrollBar;	

	public class dmrpg_main extends MovieClip {

		/////////////////////////////////////////////////////
		// Some global variable definitions needed later

		var version="1.2.1 (beta)";
		var lastmessagetime;	// used to figure out which chat message was the last one to avoid duplicates
		
		// this timer will send out a request for new chat messages every 5 seconds
		// it also keeps the connection session to the site alive and eats up bandwidth
		// it is probably the most efficient way i could think of to do this
		// as the project evolves i will probably add more shit to the timer 
		// stuff that needs to be updated but can't unless you have a mechanism like this
		// to update it... for instance, we could have a real-time combat system
		// it would update all the vars to the swf this way - the health bar and whatever
		// would be updated through this method

		var myTimer:Timer=new Timer(5000);
		var dm_admin_panel:dmrpg_admin;
		var dm_inventory:dmrpg_inventory;
		var dm_charstats:dmrpg_charstats;
		var dbg:dmrpg_debug;
		var dm_map:dmrpg_map;
		var dm_avatar:dmrpg_avatar;
		var dm_useredit:dmrpg_useredit;
		var dm_warnbox:warnbox;
		var player_access=0;
		
		var mmouse_mc:mouse_mc;		
		var dm_base:dmrpg_base;

		var dm_item:Dictionary = new Dictionary();		
		var dm_class:Dictionary = new Dictionary();
		
		var chatscrollBar:UIScrollBar;
		
		var dm_vendorbox:dm_vendorbox_all;

		function dmrpg_main()
		{
			dbg=new dmrpg_debug(this);
			
			dm_map=new dmrpg_map(this);

			dm_inventory=new dmrpg_inventory(this,5,17);
			
			dm_charstats=new dmrpg_charstats(this);
			
			dm_avatar=new dmrpg_avatar(this);
			
			setChildIndex(dm_avatar,numChildren-1);
			
			dm_useredit=new dmrpg_useredit(this);
			dm_useredit.visible=false;
			
			dm_base=new dmrpg_base(this);
			dm_base.x=700;
			dm_base.y=400;
			this.addChild(dm_base);
			dm_base.visible=false;
						
			dm_admin_panel=new dmrpg_admin(this);			
			dm_admin_panel.x=1480;
			dm_admin_panel.y=573;
			dm_admin_panel.visible=false;			
			this.addChild(dm_admin_panel);
			
			dm_warnbox=new warnbox;
			//dm_warnbox.warning.text="Welcome to Defective Minds RPG!";
			dm_warnbox.x=800;
			dm_warnbox.y=450;
			dm_warnbox.warnclose.addEventListener(MouseEvent.CLICK, closewarning);
			dm_warnbox.visible=false;
			this.addChild(dm_warnbox);

			chatinputbox.addEventListener(MouseEvent.CLICK, clearchatinput);
			chatinputbox.addEventListener(KeyboardEvent.KEY_DOWN, processchatinput);
			
			chatscrollBar=new UIScrollBar();
			chatscrollBar.scrollTarget = this.chatbox;
			//make the height the same as the textfield
			chatscrollBar.height = this.chatbox.height;
			//Move the scrollbar to the righthand side
			chatscrollBar.move(this.chatbox.x + this.chatbox.width, this.chatbox.y);
			//add it to the stage
			addChild(chatscrollBar);

			

			btn_exit.addEventListener(MouseEvent.CLICK, exitflash);
			setChildIndex(btn_exit,numChildren-1);
			btn_logout.addEventListener(MouseEvent.CLICK, logout);
			setChildIndex(btn_logout,numChildren-1);
			dbg.dbgboxclose.addEventListener(MouseEvent.CLICK, dm_closedebug);
			dbgboxopen.addEventListener(MouseEvent.CLICK, dm_opendebug);
			adminboxopen.addEventListener(MouseEvent.CLICK, dm_openadmin);

			dbgboxopen.visible=false;// debugbox button visible? no
			mx.visible=false;
			
			adminboxopen.visible=false;// admin button visible? no
			
			
			dm_vendorbox=new dm_vendorbox_all();
			dm_vendorbox.x=300;
			dm_vendorbox.y=300;
			dm_vendorbox.visible=false;
			dm_vendorbox.closebutton.addEventListener(MouseEvent.CLICK, dm_vendorbox_close);
			addChild(dm_vendorbox);
			
			getdata("dmrpg_main.php?action=start");// this starts the data trickle without it this whole fucking thing would not work
			dmstarttimer();
			//mmouse_mc=new mouse_mc();
			//mmouse_mc.startDrag(true);
			//this.addChild(mmouse_mc);
			stage.addEventListener(MouseEvent.MOUSE_MOVE, mousemove);
			//Mouse.hide();
		}
		
		function dm_vendorbox_close(mev:MouseEvent)
		{
			dm_vendorbox.visible=false;
		}
		
		function mousemove(evt:MouseEvent)
		{
			setChildIndex(mx,numChildren-1);
			mx.text = " mouseX:"+stage.mouseX+" mouseY:"+stage.mouseY;

		}
		//function mouseontop(evt:MouseEvent)
		//{
			//setChildIndex(mmouse_mc,numChildren-1);
		//}
		
		function warn(txt)
		{
			setChildIndex(dm_warnbox,numChildren-1);
			dm_warnbox.warning.text=txt;
			dm_warnbox.visible=true;			
		}
		
		function closewarning(evt:MouseEvent)
		{
			dm_warnbox.visible=false;
		}


		function dmstarttimer()
		{
			myTimer.addEventListener(TimerEvent.TIMER , timedFunction);
			myTimer.start();
		}
		
		function timedFunction(eventArgs:TimerEvent)
		{
			getdata("dmrpg_main.php?action=chat_update&lastmessagetime="+lastmessagetime);
		}
		
		function chatmsg(msg)
		{
			chatbox.text+=msg;
			chatbox.scrollV=chatbox.maxScrollV;
			chatscrollBar.update();
			if (chatscrollBar.enabled == false)
			{
				chatscrollBar.alpha = 0;
			}
			else {
				chatscrollBar.alpha = 100;
			}			

			
		}

		/////////////////////////////////////////////////////
		// Game items dictionary and helper funcs
		
		function dm_additem(fid,id,name,image,info)
		{
			var _i:Dictionary=new Dictionary();
			dm_item[fid]=_i;
			dm_item[fid].id=id;
			dm_item[fid].name=name;
			dm_item[fid].image=image;
			dm_item[fid].info=info;			
		}
		
		/////////////////////////////////////////////////////
		// returns item name by passing the id
		
		function dm_getitemname(id)
		{
			var rt="(null)";
			var i=0;
			while (dm_item[i]!=null)
			{
				if (dm_item[i].id==id)
				{
					rt=dm_item[i].name;
				}
				i++;
			}
			return rt;
		}
		
		/////////////////////////////////////////////////////
		// returns item image by passing the id
		
		function dm_getitemimage(id)
		{
			var rt="(null)";
			var i=0;
			while (dm_item[i]!=null)
			{
				if (dm_item[i].id==id)
				{
					rt=dm_item[i].image;
				}
				i++;
			}
			return rt;
		}
		
		/////////////////////////////////////////////////////
		// returns item info by passing the id
		
		function dm_getiteminfo(id)
		{
			var rt="(null)";
			var i=0;
			while (dm_item[i]!=null)
			{
				if (dm_item[i].id==id)
				{
					rt=dm_item[i].info;
				}
				i++;
			}
			return rt;
		}

		/////////////////////////////////////////////////////
		// Game classes dictionary and helper funcs
		
		function dm_addclass(fid,id,name,image,info)
		{
			var _d:Dictionary=new Dictionary();
			dm_class[fid]=_d;
			dm_class[fid].id=id;
			dm_class[fid].name=name;
			dm_class[fid].image=image;
			dm_class[fid].info=info;
		}
		
		///////////////////////////////////////////
		// return class name from id
		
		function dm_getclassname(id)
		{
			var rt="(null)";
			var i=0;
			while (dm_class[i]!=null)
			{
				if (dm_class[i].id==id)
				{
					rt=dm_class[i].name;
				}
				i++;
			}
			return rt;
		}
		
		/////////////////////////////////////////////
		// return class image from id
		
		function dm_getclassimage(id)
		{
			var rt="(null)";
			var i=0;
			while (dm_class[i]!=null)
			{
				if (dm_class[i].id==id)
				{
					rt=dm_class[i].image;
				}
				i++;
			}
			return rt;
		}

		/////////////////////////////////////////////////////
		// Chat input box handlers

		function clearchatinput(mev:MouseEvent):void
		{
			if (chatinputbox.text=="Enter chat message or console command here")
			{
				chatinputbox.text="";
			}
		}

		function processchatinput(kev:KeyboardEvent):void
		{
			switch (kev.keyCode)
			{
				case Keyboard.ENTER :
					// enter was hit, send chat to website
					getdata("dmrpg_main.php?action=chat&message="+chatinputbox.text+"&lastmessagetime="+lastmessagetime);
					chatinputbox.text=""; // clear the chat input
					break;
			}
		}

		/////////////////////////////////////////////////////
		// Exit Button 

		function exitflash(mev:MouseEvent):void
		{
			getdata("dmrpg_main.php?action=exitflash");
		}

		/////////////////////////////////////////////////////
		// Logout Button

		function logout(mev:MouseEvent):void
		{
			navigateToURL(new URLRequest("logout.php"), "_self");
			stop();
		}

		/////////////////////////////////////////////////////
		// Close Debug Button
		
		function dm_closedebug(mev:MouseEvent):void
		{
			dbg.debugmsg("Close the debug box!");
			dbg.visible=false;
			mx.visible=false;
		}

		/////////////////////////////////////////////////////
		// Open Debug Button
		
		function dm_opendebug(mev:MouseEvent):void
		{

			dbg.debugmsg("Open the debug box!");
			dbg.visible=true;
			mx.visible=true;
		}
		/////////////////////////////////////////////////////
		// Open Admin Button
		
		function dm_openadmin(mev:MouseEvent):void
		{
			if(dm_admin_panel.visible==true) dm_admin_panel.visible=false;
			else { dm_admin_panel.visible=true; setChildIndex(dm_admin_panel,numChildren-1); }
		}
		
		function dm_updatestatbox(rpg_name,rpg_level,rpg_hp,rpg_hpmax,rpg_pow,rpg_powmax,rpg_exp,rpg_totalexp,rpg_class)
        {
			var dorefresh=0;
			if(rpg_level!=null) 	{ dm_charstats.level	= rpg_level;	dorefresh=1; }
			if(rpg_name!=null) 		{ dm_charstats.dm_name	= rpg_name;		dorefresh=1; }
			if(rpg_hp!=null)  		{ dm_charstats.hp		= rpg_hp;		dorefresh=1; }
			if(rpg_hpmax!=null) 	{ dm_charstats.hpmax	= rpg_hpmax;	dorefresh=1; }
			if(rpg_pow!=null) 		{ dm_charstats.pow		= rpg_pow;		dorefresh=1; }
			if(rpg_powmax!=null) 	{ dm_charstats.powmax	= rpg_powmax;	dorefresh=1; }
			if(rpg_exp!=null) 		{ dm_charstats.exp		= rpg_exp;		dorefresh=1; }
			if(rpg_totalexp!=null) 	{ dm_charstats.total_exp= rpg_totalexp; dorefresh=1; }
			if(rpg_class!=null) 	{ dm_charstats.dm_class	= rpg_class;	dorefresh=1; }
			if(dorefresh)
				dm_charstats.dm_refresh(); // fills in the controls of the mc with the variables
        }
		
		//////////////////////////////////////////////////////////////////////////
		// getdata(URL) function that gets shit from the website
		// after its done it calls the completeHandler function right below
		// it automatically and passes the vars from the site back into flash
		// works real good.
		// NOTE: The site php appends  "_cb" to whatever action you send to it
		// automatically and then automatically sends it back even if you don't 
		// add in any extra code in the php. i did it this way so you can just
		// add in new actions in completeHandler and then modify the php later

		function getdata(gurl)
		{
			var rurl:URLRequest=new URLRequest(gurl);
			rurl.method=URLRequestMethod.GET;
			var loader:URLLoader = new URLLoader();
			loader.dataFormat=URLLoaderDataFormat.VARIABLES;
			loader.addEventListener(Event.COMPLETE, dm_dataHandler);	// function below
			loader.load(rurl);											// consider both functions as one big function
																		}		function dm_dataHandler(evt:Event)		{

			// note: all data manipulation will be done in php 
			// so these vars are local scope and will be
			// dropped after the function exits
			// the swf client only serves to draw the data
			// and tell php what you want to do with the data
			// the reason for this is to avoid people being 
			// able to manipulate thier data outside the website
			// this is pretty standard practice

			var i=0;
			var k=0;
			var update="no";
			
			var invar=evt.target.data;			

			var action      = invar.action;
			var access		= invar.access;
			var inmessage   = invar.inmessage;
			var gender		= invar.gender;
			var rpg_name    = invar.rpg_name;
			var motd        = invar.motd;
			var inventory   = invar.inventory;
			var rpg_class   = invar.rpg_class;
			var classinfo   = invar.classinfo;
			var iteminfo    = invar.iteminfo;
			var class_image = invar.class_image;
			var rpg_hp		= invar.rpg_hp;
			var rpg_hpmax	= invar.rpg_hpmax;
			var rpg_pow		= invar.rpg_pow;
			var rpg_powmax  = invar.rpg_powmax;
			var rpg_str		= invar.rpg_str;
			var rpg_int		= invar.rpg_int;
			var rpg_agl		= invar.rpg_agl;
			var rpg_def		= invar.rpg_def;
			var rpg_level	= invar.rpg_level;
			var rpg_exp		= invar.rpg_exp;
			var rpg_totalexp= invar.rpg_totalexp;
			var rpg			= invar.rpg;
			var rpg_trainpoints= invar.rpg_trainpoints;
			var rpg_abilities= invar.rpg_abilities;
			var rpg_craft	= invar.rpg_craft;
			var rpg_craft_skill= invar.rpg_craft_skill;
			var rpg_craft_skill_max= invar.rpg_craft_skill_max;
			var rpg_craft_recipes= invar.rpg_craft_recipes;
			var rpg_bank= invar.rpg_bank;
			var rpg_bankcash= invar.rpg_bankcash;
			var rpg_x		= invar.rpg_x;
			var rpg_y		= invar.rpg_y;
			var rpg_z		= invar.rpg_z;
			var rpg_cash	= invar.rpg_cash;
			var rpg_encounter= invar.rpg_encounter;
			var rpg_slot_head= invar.rpg_slot_head;
			var rpg_slot_hands= invar.rpg_slot_hands;
			var rpg_slot_legs = invar.rpg_slot_legs;
			var rpg_slot_arms = invar.rpg_slot_arms;
			var rpg_slot_feet = invar.rpg_slot_feet;
			var rpg_slot_chest= invar.rpg_slot_chest;
			var rpg_slot_back= invar.rpg_slot_back;
			var rpg_slot_mainhand= invar.rpg_slot_mainhand;
			var rpg_slot_sechand= invar.rpg_slot_sechand;
			var rpg_lastaction= invar.rpg_lastaction;
			var rpg_ap= invar.rpg_ap;
			var rpg_emails= invar.rpg_emails;
			var rpg_base= invar.rpg_base;
			var rpg_base_tower1 = invar.rpg_base_tower1;
			var rpg_base_tower2= invar.rpg_base_tower2;
			var rpg_base_tower3= invar.rpg_base_tower3;
			var rpg_base_tower4= invar.rpg_base_tower4;
			var rpg_henchleaders= invar.rpg_henchleaders;
			var rpg_henchmen= invar.rpg_henchmen;
			var rpg_tutorial= invar.rpg_tutorial;
			var rpg_mapsize= invar.rpg_mapsize;
			var rpg_pvp_won= invar.rpg_pvp_won;
			var rpg_pvp_lost= invar.rpg_pvp_lost;
			var rpg_pvp_lastplayer= invar.rpg_pvp_lastplayer;
			var rpg_clan= invar.rpg_clan;
			var rpg_clanrank= invar.rpg_clanrank;
			var rpg_quests_current= invar.rpg_quests_current;
			var rpg_quests_completed=invar.rpg_quests_completed;
			var item       = invar.item;
			var qty        = invar.qty;
			var sysmessage = invar.sysmessage;
			var acttxt     = invar.acttxt;
			var char_image = "";
			
			var lmsg        = lastmessagetime;// chat message last message time			
			lastmessagetime = invar.lastmessagetime;
			if (lastmessagetime==null)			
				lastmessagetime=lmsg;
			

			// more variables that don't really matter i guess (they are passed however)
			// i'm keeping them in in case we want to go somewhere with them
			/// name=real_name=country=email= webpage= avatar=picture=posts=karma=id=show_flash=icq=yahoo=msn= aim= irc_server= irc_channel=
			/// website_fav=sentence= first_login=2009-06-25+05%3A19%3A37reporter=yes show_contact_info= upload= files_uploaded= files_downloaded=0
			// last_activity= last_login= birthday= forumposts= forumreplies= awards= referrals= comments= linksadded= logins=0 */
			
			// note, if you don't explicitly send back a variable in the php it will be null in flash
			// so lines like the one below only get executed  under certain conditions
			// pretty good shit
			// fill in class information from the website

			/////////////////////////////////////////////////////
			/////      Beginning of PHP callbacks			/////
			/////////////////////////////////////////////////////
			
			var dm_array:Array;
			var dm_array2:Array;			
			var dm_inv_geta:Array;
			var dm_inv_getb:Array;
			var users:Array;
			
			///////////////////////////////
			// user editor fill data
			if(action=="usereditstart_cb")
			{
				dbg.debugmsg("#6 "+sysmessage);
				dm_array=sysmessage.split("|");
				users=new Array();
				for(i=0; i<dm_array.length; i++)
				{
					users.push({label:dm_array[i], data:dm_array[i]});
				}
				dbg.debugmsg(sysmessage);
				dbg.debugmsg(users[0].label);
				dm_useredit.dmue_fillusers(users);
			}
			
			if(action=="moduser_cb")
			{
				// ?
				dbg.debugmsg("#9 moduser_cb");
			}
			
			if(action=="usereditgetdata_cb")
			{
				dbg.debugmsg("#8 usereditgetdata_cb");
                    //				var inventory   = invar.inventory;
				dm_useredit.dmue_filldata(rpg_name,
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
                                          );
				dbg.debugmsg("#7 usereditgetdata_cb");
				return;
			}
			

			///////////////////////////////
			// Clicked Inventory Item
			
			if (action=="clickedinv_cb")
			{				
			
				dbg.debugmsg("#4 (item="+dm_getitemname(item)+") INV CB! "+sysmessage+" ("+acttxt+")");
				if(acttxt!="no action")
				{
					dm_inventory.moditem(item,qty);
				}

				if(inventory!=null) action="getinventory_cb";
				dbg.debugmsg("#5 "+inventory+" action:"+action);				
			}
			
			///////////////////////////////
			// Retrieve contents of player 
			// inventory from website

			if (action=="getinventory_cb")
			{	// format  1x54|54x5|5|34x5  ( item 1 times 54  // item 54 times 5 // item 5 times 1 // item 34 times 5 )
				dbg.debugmsg("#2 Player inventory:");
				dbg.debugmsg(inventory);
				if(inventory=="0")
					dbg.debugmsg("#3 debug inventory is 0");				
				else
				{					
					dm_inv_geta=inventory.split("|");
					
					for (i=0; i<dm_inv_geta.length; i++)
					{
						dm_inv_getb=dm_inv_geta[i].split("x");
						
						if (dm_inv_getb[1]==null) dm_inv_getb[1]=1;
						
						dm_inventory.moditem(dm_inv_getb[0], dm_inv_getb[1]);
						
					}
				}
			}

			///////////////////////////////
			// Start of all things
			// does alot. It fills in data
			// mostly.
			
			if (action=="start_cb")
			{
				chatmsg("Defective Minds RPG "+version+" by Seth Parson and Will Delahoussaye\n");
				chatmsg(motd);											
				chatinputbox.text="Enter chat message or console command here";				
				getdata("dmrpg_main.php?action=getinventory");
			}
			
			///////////////////////////////
			// Exit flash; the php sets
			// user's show_flash var to no 
			// then the flash will navigate
			// to index which will show the 
			// non-flash site

			if (action=="exitflash_cb")
			{
				navigateToURL(new URLRequest("index.php"), "_self");
				stop();
			}
			
			////////////////////////////////////////////////////////////////
			// Update all vars and controls from the passed vars below
			
			if (classinfo!=null)
			{
				dbg.debugmsg("Class information:");
				var dm_class_getb;
				var dm_class_geta:Array=classinfo.split("|");
				for (i=0; i<dm_class_geta.length; i++)
				{
					dm_class_getb=dm_class_geta[i].split(";");					
					dm_addclass( i,dm_class_getb[0], dm_class_getb[1], dm_class_getb[2], dm_class_getb[3]); //fid (flash id)// class id // name// image// info
				}
				i=0;
				while (dm_class[i]!=null)
				{
					dbg.debugmsg( i+")"+dm_class[i].id + ": "+dm_class[i].name+" ("+dm_class[i].image+")");
					i++;
				}
			}
			
			// fill in item information from the website
			if (iteminfo!=null)
			{
				dbg.debugmsg("Item information:");
				var dm_item_getb;
				var dm_item_geta:Array=iteminfo.split("|");
				for (i=0; i<dm_item_geta.length; i++)
				{
					dm_item_getb=dm_item_geta[i].split(";");					
					dm_additem( i, dm_item_getb[0], dm_item_getb[1], dm_item_getb[2], dm_item_getb[3] ); //fid (flash id)// class id // name// image// info
				}
				while (dm_item[i]!=null)
				{
					dbg.debugmsg( i+")"+dm_item[i].id + ": "+dm_item[i].name+" ("+dm_item[i].image+")");
					i++;
				}
			}

			// player's access
			
			if (access!=null)
			{
				player_access=access;
				dbg.debugmsg("Access set to: "+player_access);
				if (player_access==255)
				{
					dbgboxopen.visible=true;
					adminboxopen.visible=true;
				}
				else
				{
					dbgboxopen.visible=false;
					adminboxopen.visible=false;					
				}
			}			
			
		   dm_updatestatbox(rpg_name,rpg_level,rpg_hp,rpg_hpmax,rpg_pow,rpg_powmax,rpg_exp,rpg_totalexp,rpg_class);
		   
			if(inmessage!=null)
			{
				chatmsg(inmessage+"\n");
			}					
		}
		


	}

}
	// the end 




