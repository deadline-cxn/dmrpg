package
{
	import flash.display.*;
	import flash.events.*;
	import flash.utils.*;
	import flash.net.*;
	import flash.ui.Keyboard;
	import fl.controls.TextArea;
	
	public class dmrpg_inventory_box extends dmrpg_inventory_bg
	{
		
		var image:Bitmap;
		var info:String;
		var fid:Number;
		var iid:Number;
		var id:Number;
		var d_x:Number;
		var d_y:Number;		
		var quantity:Number;
		var theparent:MovieClip;
		var dm_tooltip:dmrpg_tooltip;
		
		function dmrpg_inventory_box(parentMC:MovieClip,ix,iy)
		{
			theparent=parentMC;
			
			id=0;
			
			d_x=ix;
			d_y=iy;
			
			//image=new Bitmap();

			//image.visible=false;

			this.addEventListener(MouseEvent.CLICK, dm_invclick);
			
			var imageWidth      = 32;
			var imageHeight     = 32;
			var padding         = 1.34; //Padding between the images
			var left            = 37;  //Left edge space
		
			x = left + ix * imageWidth * padding +(theparent.inventory_text.x); //Position it
			y = iy * imageHeight * padding + (theparent.inventory_text.y) + 40;
			
			dm_tooltip = new dmrpg_tooltip(this);
			theparent.addChild(this);
			//theparent.addChildAt(this,theparent.numChildren-1);		 //Add the holder to the stage
			//setChildIndex(this.dm_tooltip, (numChildren-1) );		
			
		}
		
		function dm_invclick(me:MouseEvent)
		{
			theparent.dbg.debugmsg("Clicked "+this.name+" "+theparent.dm_getitemname(id));
			if(id)
			theparent.getdata("dmrpg_main.php?action=clickedinv&item="+id);
		}
		
		function dm_clear()
		{
			dm_tooltip.dmtt_clear();
			id=0;
			//image.visible=false;
			if(image) removeChild(image);
		}
		
		function settooltiphead(txt)
		{
			dm_tooltip.settooltiphead(txt);
		}
		
		function settooltip(txt)
		{
			dm_tooltip.settooltip(txt);			
		}


		
		function loadimage(img):void // loads img into imageholder (ih)
		{
			var loader:Loader = new Loader();//Create the loader
			var urlRequest:URLRequest = new URLRequest(img);//Get the URL to load
			loader.load(urlRequest); 	//Load the image
			loader.contentLoaderInfo.addEventListener(Event.COMPLETE, dminv_image_loaded); //Listen when the loading is complete
       	}
		 //This function is called when an image is loaded			
		function dminv_image_loaded(e:Event):void
		{
			
			/*
			ArgumentError: Error #2025: The supplied DisplayObject must be a child of the caller.
	at flash.display::DisplayObjectContainer/setChildIndex()
	at dmrpg_inventory/dminv_image_loaded()
*/
			
			//if(image)  removeChild(image);

			image=(e.target.content);
			image.x=-16;
			image.y=-16;
			image.width=32;
			image.height=32;
			//image.visible=true;
			addChild(image);
			
			setChildIndex(this.qoverlay,   (numChildren-1) );
			setChildIndex(this.qoverlay2,   (numChildren-1) );
			setChildIndex(this.dm_tooltip, (numChildren-1) );			
			//dm_tooltip.visible=true;
		}
	}
	
	
}

		

