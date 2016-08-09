package 
{

	import flash.display.*;
	import flash.events.*;
	import flash.utils.*;
	import flash.net.*;

	public class dmrpg_map
	{
		var theparent:MovieClip;

		var mpx:Number;
		var mpy:Number;
		var mpz:Number;

		var tile:Dictionary;

		function dmrpg_map (parentMC:MovieClip)
		{
			// the map will be 200 x 200
			// should be plenty of room to do whatever we need
			// if not i'll expand it later

			theparent = parentMC;
			theparent.dbg.debugmsg ("Hi dmrpg_map.as");

			tile=new Dictionary();
			var px;
			var py;

			for (px=0; px<21; px++)
			{
				for (py=0; py<13; py++)
				{
					tile[px+(py*21)]=new dmrpg_maptile(theparent,px,py);
				}
			}
			
		}
	}
}