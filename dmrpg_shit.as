


	// - some testing stuff below

	/*
	
	var i = new Loader();
	i.addEventListener(IOErrorEvent.IO_ERROR, errorHandler);
	i.addEventListener(SecurityErrorEvent.SECURITY_ERROR, errorHandler);
	i.load(new URLRequest(”http://www.kirupa.com/new_layout/modules/kirupaLogoGIF.gif”));
	//change the url of the above line to something that doesn’t exist to test the error
	movieClipInstance.addChild(i);
	function errorHandler(event:ErrorEvent):void {
	trace(”errorHandler: ” + event);
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	var picLoader:Loader = new Loader();
	picLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, loadPicture);
	picLoader.load(new URLRequest("425_FH000023_cropped.jpg"));
	
	function loadPicture(event:Event):void {
	pic.addChild(event.target.content);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	import flash.events.*;import flash.display.Loader;import flash.display.LoaderInfo;
	import flash.net.URLLoader;import flash.net.URLRequest;
	var url:String = "http://domain.com/image.png";
	var myLoader:Loader;myLoader= new Loader();
	myLoader.contentLoaderInfo.addEventListener(ProgressEvent.PROGRESS, onProgress);
	myLoader.contentLoaderInfo.addEventListener(Event.COMPLETE, onComplete);
	myLoader.load(new URLRequest(url));
	function onProgress(e:ProgressEvent):void{var p:Number = (e.bytesLoaded / e.bytesTotal);}
	function onComplete(e:Event):void{myLoader.contentLoaderInfo.removeEventListener(ProgressEvent.PROGRESS, onProgress);
	//e.target.content.bitmapDatastage.addChild(myLoader);}
	
	
	*/
}

/*
package 
{

import flash.events.MouseEvent;

    public class dm_Mouse_ToolTip extends MouseEvent {
   
    public static const MY_EVENT:String = "dm_Mouse_ToolTip";
    
public var infotext public var infotext;
    public var id:int    public var id:int;

        public function MyCustomEvent(infotext:String, id:int):void {
            super(infotext);
            this.id = id;
        }
        override public function clone():Event {
            return new MyCustomEvent(this.infotext, this.id);
        }
       override  public function toString():String {
            return formatToString("dm_Mouse_ToolTip","infotext","id");
        }
    }
}
*/

/*
package {
import flash.display.*;

public class DM_InventoryDemo extends MovieClip {
var dm_inventory:DM_Inventory;

function DM_InventoryDemo() {
dm_inventory = new DM_Inventory(this);
dm_inventory.makeInventoryItems([box1,box2,box3,box4]);
}
}
}
*/