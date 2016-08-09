package
{
	import flash.display.*;
	import flash.events.*;
	import flash.utils.*;
	import flash.net.*;
	import flash.ui.Keyboard;

	public class dmrpg_base extends base_panel
	{
		var theparent:MovieClip;
	
		function dmrpg_base(parentMC:MovieClip)
		{
			theparent=parentMC;
			theparent.dbg.debugmsg("Hi dmrpg_base.as");

			theparent.addChild(this);
			
		}
		
		

	
	}
}

