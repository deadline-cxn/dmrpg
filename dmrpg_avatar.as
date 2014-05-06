package
{
	
import flash.display.*;
import flash.events.*;	
import flash.utils.*;
import flash.net.*;

	public class dmrpg_avatar extends dm_avatar
	{
		var theparent:MovieClip;
		
		var dir;		
		var anim_frame;
		
	
		function dmrpg_avatar(parentMC:MovieClip)
		{
			theparent=parentMC;
			theparent.dbg.debugmsg("Hi dmrpg_avatar.as");
			
			x=700;
			y=450;
			
			theparent.addChild(this);
			
			
		}
		
	}

	
}