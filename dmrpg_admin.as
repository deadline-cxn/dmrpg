package
{
	import flash.display.*;
	import flash.events.*;
	import flash.utils.*;
	import flash.net.*;
	import flash.ui.Keyboard;

	public class dmrpg_admin extends admin_panel
	{
		var theparent:MovieClip;
	
		function dmrpg_admin(parentMC:MovieClip)
		{
			theparent=parentMC;
			theparent.dbg.debugmsg("Hi dmrpg_admin.as");
			


			x=650;
			y=360;
			
			//close_button2=new close_button2();
			admin_close_button.addEventListener(MouseEvent.CLICK, dm_closeadmin);
			
			itemedbutton.label.text="Item Edit";
			
			usereditbutton.label.text="User Edit";			
			usereditbutton.addEventListener(MouseEvent.CLICK, dm_toggleuseredit);
			
			
			visible=false; // hide it
			theparent.addChild(this);
			
		}
		
		function dm_toggleuseredit(mev:MouseEvent):void
		{
			if(theparent.dm_useredit.visible==true)
			{
				theparent.dm_useredit.visible=false;
			}
			else
			{				
				theparent.dm_useredit.visible=true;
				theparent.setChildIndex(theparent.dm_useredit,theparent.numChildren-1);
				theparent.getdata("dmrpg_main.php?action=usereditstart");
				

				
			}
		}
		
		function dm_closeadmin(mev:MouseEvent):void
		{
			visible=false;
			
		}
		
		

	
	}
}

