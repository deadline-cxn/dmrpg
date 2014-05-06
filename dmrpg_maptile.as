package
{
	
import flash.display.*;
import flash.events.*;	
import flash.utils.*;
import flash.net.*;


	import flash.ui.Keyboard;
	import fl.controls.TextArea;

	public class dmrpg_maptile
	{
		var theparent:MovieClip;
		var image:MovieClip;
			
		function dmrpg_maptile(parentMC:MovieClip,px,py)
		{
			theparent=parentMC;
			image=new map_plains();
			image.x=32+(px*64);
			image.y=32+(py*64);
			image.width=64;
			image.height=64;			
			theparent.addChild(image);
			//loadimage("images/map_plains.gif");
		}
		/*
		
		function loadimage(img):void // loads img into imageholder (ih)
		{
			var loader:Loader = new Loader();//Create the loader
			var urlRequest:URLRequest = new URLRequest(img);//Get the URL to load
			loader.load(urlRequest); 	//Load the image
			loader.contentLoaderInfo.addEventListener(Event.COMPLETE, dmmt_image_loaded); //Listen when the loading is complete
       	}
		 //This function is called when an image is loaded			
		function dmmt_image_loaded(e:Event):void
		{
			//if(image) theparent.removeChild(image);
			image=(e.target.content);
			image.x=mpx*64;
			image.y=mpy*64;
			image.width=64;
			image.height=64;
			theparent.addChildAt(image,1);
			
		}	
		*/
		
	}

	
}