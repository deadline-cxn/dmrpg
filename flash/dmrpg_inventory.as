package
{
	import flash.display.*;
	import flash.events.*;
	import flash.utils.*;
	import flash.net.*;
	import flash.ui.Keyboard;
	import fl.controls.TextArea;
	
	public class dmrpg_inventory extends MovieClip
	{
        var theparent:MovieClip;
		var rows:Number;
		var columns:Number;
		
		var dm_inv:Dictionary;		
		var dm_inv_tt:Dictionary;

		var dm_tb:dmrpg_inventory_box;

		

		function dmrpg_inventory(parentMC:MovieClip,incols,inrows)
		{
			dm_inv=new Dictionary();
			dm_inv_tt=new Dictionary();
			theparent=parentMC;

			x=theparent.inventory_text.x;
			y=theparent.inventory_text.y;

			rows=inrows;
		    columns=incols;
			var i;
			var j;
			
    		for (i = 0; i < columns; i++) //Create the image holders (= empty movie clips) and position them on the stage
			{	
				for (j = 0; j < rows; j++)
				{
					dm_tb=new dmrpg_inventory_box(theparent,i,j);
					dm_inv[i+(j*columns)]=dm_tb;
				}
			}			

		}
		
		
		//////////////////////////////////////////////////////////////////////////
		// Player inventory dictionary and helper funcs and other inventory shit
		
		function additem(fid,id,quantity)
		{
			dm_inv[fid].id=id;
			dm_inv[fid].quantity=quantity;
			dm_inv[fid].settooltiphead(theparent.dm_getitemname(id));
			dm_inv[fid].settooltip(theparent.dm_getiteminfo(id));
			dm_inv[fid].loadimage("images/"+theparent.dm_getitemimage(id));

			if(quantity>1) 
			{
				dm_inv[fid].qoverlay.text=quantity;// little white numbers in the inventory box
				dm_inv[fid].qoverlay2.text=quantity;// little white numbers in the inventory box
			}
		}
		
		function delitem(fid)
		{
			dm_inv[fid].clear();
		}
		
		function giveitem(id,quantity)
		{
			var i;
			var j;
			var k;
			var first_empty;
			if(quantity==null) quantity=1;
			i=0; j=0; k=0;
			while(dm_inv[i]!=null)
			{
				if(first_empty==null)
				{
					if(dm_inv[i].id==0)
						first_empty=i;
				}
				if(dm_inv[i].id==id) { j=i; break; }
				i++;
			}
			
			theparent.dbg.debugmsg(" dm_giveinv("+id+","+quantity+") i="+i+" j="+j+" first_empty="+first_empty);

			if(j==0)
			{
				if(first_empty==null)
				{
					theparent.dbg.debugmsg(" The inventory is full! ");
					theparent.warn(" Inventory is full !");
				}
				else
				additem( first_empty, id, quantity);//fid (flash id)// item id // quantity
			}
			else
			{
				if(j<85)
				{
					k=dm_inv[j].quantity+quantity;
					moditem(id, k);
				}
			}
		}

		function moditem(id,quantity)
		{
			theparent.dbg.debugmsg("dm_modinv("+id+","+quantity+")");
			
			if(quantity==null) quantity=0;
			
			var i=0; var j=0; var it=0;
			while(dm_inv[i]!=null)
			{
				if(dm_inv[i].id==id)  it=i;
				i++;
			}
			
			if(it>0)
			{
					dm_inv[it].quantity=quantity;
					
					if(dm_inv[it].quantity < 1)
					{
						i=dm_inv[it].d_x;
						j=dm_inv[it].d_y;
						//theparent.removeChild(dm_inv[i+(j*5)]);
						//delete(dm_inv[i+(j*5)]);
						//dm_inv[i+(j*5)]=new dmrpg_inventory_box(theparent,i,j);
						dm_inv[it].dm_clear();
					}
					
					if(dm_inv[it].quantity > 1) 
					{
						dm_inv[it].qoverlay.text=quantity; // little white numbers in the inventory box				
						dm_inv[it].qoverlay2.text=quantity; // little white numbers in the inventory box										
					}
					else
					{
						dm_inv[it].qoverlay.text="";
						dm_inv[it].qoverlay2.text="";
					}
				
			}
			else
			{
				giveitem(id,quantity);
			}
		}	
		
	}
}

