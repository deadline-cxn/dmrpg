package
{
import flash.display.*;
import flash.events.*;	
import flash.utils.*;
import flash.net.*;

	public class dmrpg_charstats extends charstats
	{
		var image:Bitmap;
		var theparent:MovieClip;		
		var dm_name:String;
		var hp:Number;
		var hpmax:Number;
		var pow:Number;
		var powmax:Number;
		var dm_class:Number;
		var exp:Number;
		var total_exp:Number;
		var level:Number;
	
		function dmrpg_charstats(parentMC:MovieClip)
		{
			theparent=parentMC;
			theparent.dbg.debugmsg("Hi dmrpg_charstats.as");		
			this.x=215;
			this.y=75;
			dm_name="none";
			exp=0;
			level=1;
			total_exp=0;
			hp=10;
			hpmax=20;
			pow=30;
			powmax=40;
			dm_class=1;
			charname.text="Character Name";
			loadimage("images/nopic.gif");
			(this).addEventListener(MouseEvent.CLICK, dmrpg_charstats_click);
			theparent.addChild(this);

		}	
		
		function dmrpg_charstats_click(e:MouseEvent)
		{
			theparent.dbg.debugmsg("Clicked charstats");
		}


		function dmrpg_charstats_click_pic(e:MouseEvent)
		{
			theparent.dbg.debugmsg("Clicked charstats pic");
		}
		
		function loadimage(img):void // loads img into imageholder (ih)
		{
			var loader:Loader = new Loader();//Create the loader
			var urlRequest:URLRequest = new URLRequest(img);//Get the URL to load
			loader.load(urlRequest); 	//Load the image
			loader.contentLoaderInfo.addEventListener(Event.COMPLETE, dmcs_image_loaded); //Listen when the loading is complete
       	}
		//This function is called when an image is loaded
		function dmcs_image_loaded(e:Event):void
		{ 
			if(image!=null) 
			{
				removeChild(image);
				//this.delete(image);
			}
			image=new Bitmap();
			image=(e.target.content);
			image.x=-208;
			image.y=-65;
			image.width=79;
			image.height=79;
			addChild(image);
		}
		
		function dm_refresh() // fill boxes with the variables
		{
			
			charname.text=dm_name;
			hp_box.text="WTL:"+hp+" / "+hpmax;			
			pow_box.text="MOT:"+pow+" / "+powmax;
			xp_box.text="EXP: "+exp;
		
			var char_image="images/"+theparent.dm_getclassimage(dm_class);
			if (char_image=="images/") char_image+="nopic.gif";
			loadimage(char_image);
		}
	}
}
