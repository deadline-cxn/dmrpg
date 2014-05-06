package
{
import flash.display.*;
import flash.events.*;	
import flash.utils.*;
import flash.net.*;
import flash.ui.*;
import fl.controls.UIScrollBar;
	public class dmrpg_debug extends debugbox
	{
		var image:Bitmap;
		var theparent:MovieClip;
		
		var scrollBar:UIScrollBar;// = new UIScrollBar();//assign the target of the scrollBar to your textfield
	
		function dmrpg_debug(parentMC:MovieClip)
		{
			theparent=parentMC;
			x=1188;
			y=928;
			
			scrollBar=new UIScrollBar();
			scrollBar.scrollTarget = this.debugmessages;
			//make the height the same as the textfield
			scrollBar.height = this.debugmessages.height;
			//Move the scrollbar to the righthand side
			scrollBar.move(this.debugmessages.x + this.debugmessages.width, this.debugmessages.y);
			//add it to the stage
			addChild(scrollBar);
			//check if it is required if so show it,put this function right after updating your textfield contents with added text


			
			
			visible=false; // hide it					
			theparent.addChild(this);
		}	
		
		function debugmsg(msg)
		{
			msg=msg.replace("\n"," ");//:String
			
			this.debugmessages.text+=msg+"\n";
			this.debugmessages.scrollV=this.debugmessages.maxScrollV; 
			
			scrollBar.update();
			if (scrollBar.enabled == false)
			{
				scrollBar.alpha = 0;
			}
			else {
				scrollBar.alpha = 100;
			}
		}
			
	}
}

