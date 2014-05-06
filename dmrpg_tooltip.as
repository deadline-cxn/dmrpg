
package {

	import flash.display.*;
	import flash.events.*;
	import flash.utils.*;
	import flash.net.*;
	import flash.ui.Keyboard;

	public class dmrpg_tooltip extends ToolTip {
		
		public var theparent:MovieClip;
		
		function dmrpg_tooltip(parentMC:MovieClip)
		{
			theparent=parentMC;
			txt.text="(tooltip)";
			x=theparent.mouseX;
			y=theparent.mouseY+80;
			theparent.addEventListener("mouseOver", mouseRollOver); // add mouse events for tooltips
			theparent.addEventListener("mouseOut", mouseRollOut);
			theparent.addEventListener("mouseMove", mouseMove1);
			theparent.addChild(this);
			visible=false;
		}	
		

		/////////////////////////////////////////////////////
		// Tool tip stuff

		function mouseRollOver(af:MouseEvent):void
		{
			if(this!=null)
			if(theparent!=null)			
			if(txt.text!="(tooltip)")
			{
				visible=true;
				//theparent.addChildAt(this, theparent.numChildren-1 );
				//theparent.theparent.dbg.debugmsg(theparent.theparent.mouseX);
				//if(theparent.theparent.mouseX<800)
					//this.x=theparent.mouseX+100;
				//else
					this.x=theparent.mouseX-200;
				this.y=theparent.mouseY+100;
			}
			
		}
		function mouseRollOut(e:MouseEvent):void
		{
			if(this!=null)
			if(theparent!=null)			
			if(txt.text!="(tooltip)")
			{
				visible=false;
				//theparent.removeChild(this);
			}
		}
		function mouseMove1(e:MouseEvent):void
		{
			if(this!=null)
			if(theparent!=null)
			if(txt.text!="(tooltip)")
			{
				//if(theparent.theparent.mouseX<800)
					//x=theparent.mouseX+100;
				//else
					x=theparent.mouseX-200;
				y=theparent.mouseY+100;
			}			
		}
		
		function dmtt_clear()
		{
			visible=false;
			txt.text="(tooltip)";
		}
		
		
		function settooltiphead(intxt)
		{
			head.text=intxt;			
		}
		
		function settooltip(intxt)
		{
			txt.text=intxt;
			
		}
		


	}
	
}