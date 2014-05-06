<?
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////

include("rpg_header.php");
$data=getuserdata($HTTP_SESSION_VARS['valid_user']);
if(empty($id)) $id=$data->id;
if($HTTP_SESSION_VARS["logged_in"]!="true")
{
  	rpg_refresh("top","index.php");
    include("rpg_footer.php");
    exit();
}

echo "<body background=auctionbg.gif>";

if($data->rpg=="yes")
{
  if(stristr($data->rpg_base,"auction_counter"))
  {
    
    rpg_refresh("right","rpg_rightpane.php");
	rpg_refresh("charpane","rpg_character.php");

	echo "<h1>Auctions</h1>";

	echo "[<a href=rpg_auction.php>Auction main page</a>]";

// check here for auctions that have expired
   
   $res=dm_query("select * from rpg_inventory where user=0");
   $num=mysql_num_rows($res);
        $d1=date("Y-m-d H:i:s");
   for($i=0;$i<$num;$i++)
   {
        $auc=mysql_fetch_object($res);
        $j=strtotime($d1);
        $k=strtotime($auc->auction_endtime);
        $l=$k-$j;
        //    echo " ($j / $k) = $l</p>";
        if($l<0)
        {
         // echo "<p> AUCTION EXPIRED: $auc->name </p>";
          if($auc->auction_highbidder==0)
          {

            // no one bid on this auction so give it back to the owner
			rpg_giveitemuser($auc->auction_owner,$auc->id,$auc->quantity);
            dm_query("delete from rpg_inventory where `iid`='$auc->iid'");
           $user=getuserdata($auc->auction_owner);
           pmsg($user->rpg_name,"Imacomputa","Auction unsuccessful","Your auction of $auc->name was unsuccessful");
          }
          else
          {
            // the winner is the high bidder
            $user=getuserdata($auc->auction_owner);
            $user2=getuserdata($auc->auction_highbidder);
			$to=$user->rpg_name;
			$from="Imacomputa";
			$subject="Auction Robot: Auction successful";
			$message="Your auction of $auc->name x $auc->quantity was bought out by ";
			$message.="<a href=rpg_profile.php?id=$user2->id>$user2->rpg_name</a>";
			$message.=" for ".rpg_money_format($auc->auction_buyout).".";
			pmsg($to,$from,$subject,$message);
			
			if( ($pwd=="wenix") || ($pwd=="IckleAzure") || ($pwd=="Michael-PC") ) {}
			else
            {

			 if($user->rpg_emails=="yes")
    			mailgo($user->email,$message,$subject);
            }

			$to=$user2->rpg_name;
			$message="You won an auction for $auc->name x $auc->quantity for ".rpg_money_format($auc->auction_buyout)." ";
			$message.=" from <a href=rpg_profile.php?id=$user->id>$user->rpg_name</a>.";
			pmsg($to,$from,$subject,$message);
			
			rpg_giveitemuser($user2->id,$auc->id,$auc->quantity);
            dm_query("delete from rpg_inventory where `iid`='$auc->iid'");
          }
        }
   }


	if($action=="newauction")
	{
		echo "<p>Start a new auction</p>";

		$res=dm_query("select * from rpg_inventory where `user` = '$data->id'");
		$num=mysql_num_rows($res);
		$numtra=0;
  		for($i=0;$i<$num;$i++)
  		{
  			$item=mysql_fetch_object($res);
  		    $nitem=rpg_getitemobj($item->id);

  			if($nitem->tradeable!="no") $numtra++;

        }

		$res=dm_query("select * from rpg_inventory where `user` = '$data->id'");
		$num=mysql_num_rows($res);

		if($numtra>0)
		{
          
            inform("Select which item to auction");

    		echo "<table border=0>";
    		for($i=0;$i<$num;$i++)
    		{
    			$item=mysql_fetch_object($res);
    		    $nitem=rpg_getitemobj($item->id);
    			if($nitem->tradeable!="no")
    			{
  					echo "<tr><td>";
  					echo "<a href=rpg_auction.php?action=newauction2&item=$item->iid>";
  					echo "$item->name";
  					echo "</a>";
  					echo "</td><td>";
  					echo "<a href=rpg_auction.php?action=newauction2&item=$item->iid>";
                     	echo "<img src=\"images/$nitem->image\" border=0 width=32  height=32>";
  					echo "</a>";
  					echo "</td></tr>";

    			}
    		}
    		echo "</table>";
        }
        else
        {
             inform("You have no items that you can auction");
        }
		exit();
	}

	if($action=="newauction2")
	{
		$res=dm_query("select * from rpg_inventory where `iid`='$item'");
		$item=mysql_fetch_object($res);
		$nitem=rpg_getitemobj($item->id);

		echo "<p>Auction $item->name</p>";
		echo "<p><img src=\"images/$nitem->image\" border=0 width=64  height=64></p>";

		echo "<table border=0>";

		echo "<form action=rpg_auction.php method=post><input type=hidden name=action value=newauction3>";
		echo "<input type=hidden name=item value=$item->iid>";
		echo "<tr><td>Quantity </td><td><select name=qty>";
		for($i=1;$i< ($item->quantity+1) ;$i++) { echo "<option>$i"; }
		echo "</select></td></tr>";
		echo "<tr><td>Starting Bid</td><td><input name=startbid></td></tr>";
		echo "<tr><td>Buyout Price</td><td><input name=buyout></td></tr>";
		echo "<tr><td>Duration</td><td><select name=duration><option>24 hours<option>48 hours<option>72 hours</select></td></tr>";
		echo "<tr><td></td><td><input type=submit name=submit value=Go></td></tr>";
		echo "</form></table>";
		exit;

	}

	if($action=="newauction3")
	{
		$res=dm_query("select * from rpg_inventory where `iid`='$item'");
		$item=mysql_fetch_object($res);
		$nitem=rpg_getitemobj($item->id);
		echo "<p>Auction $item->name confirm</p>";
		echo "<p><img src=\"images/$nitem->image\" border=0 width=64  height=64></p>";
		echo "<p>You are placing $item->name x $qty up for auction. Starting bid is $startbid and Buyout is $buyout. Duration is $duration</p>";

		$aucpric=round((($startbid/20)+($buyout/10)),2);
		echo "<p>This auction will cost you $aucpric to set up. Continue?";
		echo " ( <a href=\"rpg_auction.php?action=confirmauction&item=$item->iid&qty=$qty&startbid=$startbid&buyout=$buyout&duration=$duration&cost=$aucpric\">Yes</a> / <a href=rpg_auction.php>No</a> )";
		echo "</p>";
		exit;
	}

	if($action=="confirmauction")
	{
		$res=dm_query("select * from rpg_inventory where `iid`='$item'");
		$item=mysql_fetch_object($res);

		$time=date("Y-m-d H:i:s");
		if($duration=="24 hours") $time2=date('Y-m-d H:i:s', strtotime('+1 day'));
		if($duration=="48 hours") $time2=date('Y-m-d H:i:s', strtotime('+2 days'));
		if($duration=="72 hours") $time2=date('Y-m-d H:i:s', strtotime('+3 days'));

		if($qty!=$item->quantity)
		{
           rpg_takeitem($item->id,$qty);
           dm_query("
           insert into rpg_inventory (`name`,`user`,`quantity`,`id`,`auction_starttime`,`auction_endtime`,`auction_startbid`,`auction_highbid`,`auction_buyout`,`auction_owner`)
                            VALUES   ('$item->name','0','$qty','$item->id','$time','$time2','$startbid','$startbid','$buyout','$data->id')");
        }
        else
        {
           dm_query("update rpg_inventory set `user`='0' where `iid`='$item->iid'");
           dm_query("update rpg_inventory set `auction_starttime`='$time' where `iid`='$item->iid'");
           dm_query("update rpg_inventory set `auction_endtime`='$time2' where `iid`='$item->iid'");
           dm_query("update rpg_inventory set `auction_startbid`='$startbid' where `iid`='$item->iid'");
           dm_query("update rpg_inventory set `auction_highbid`='$startbid' where `iid`='$item->iid'");
           dm_query("update rpg_inventory set `auction_buyout`='$buyout' where `iid`='$item->iid'");
           dm_query("update rpg_inventory set `auction_owner`='$data->id' where `iid`='$item->iid'");




        }

/*
		dm_query("
		insert into rpg_auctions (`name`, `owner`, `quantity`, `id`, `starttime`, `endtime`, `startbid`, `highbid`, `buyout`)
		                 VALUES( '$item->name', '$data->id', '$qty', '$item->id', '$time', '$time2', '$startbid', '$startbid', '$buyout' );");
		                 */


		$data->rpg_cash=$data->rpg_cash-$cost;
		rpg_setvar("rpg_cash",$data->rpg_cash);

		rpg_refresh("right","rpg_rightpane.php");
		rpg_refresh("charpane","rpg_character.php");

		echo "<p>Auction created</p>";

	}


	if($action=="placebid")
	{
		echo"<p>Placing bid on ";
		$auc=rpg_getauctionobj($iid);
		$item=rpg_getitemobj($auc->id);
		echo "auction $item->name x $auc->quantity</p>";
		echo "<p><img src=\"images/$item->image\" border=0 width=64  height=64></p>";

		echo "Current bid is $auc->highbid<br><br>";
		echo "<form action=rpg_auction.php method=post>";
		echo "<input type=hidden name=action value=placebidgo>";
		echo "<input type=hidden name=iid value=$iid>";
		echo "Enter your bid: <input name=bid> <input type=submit value=Go>";
		echo "</form>";
		exit();
	}

	if($action=="placebidgo")
	{
	
		$auc=rpg_getauctionobj($iid);

		if( ($data->rpg_cash-$bid) < 0 )
		{
			inform("You don't have the cash for that auction!");
		}
		else
		{

			if($auc->auction_highbid<$bid)
			{
                if($auc->auction_highbidder>0)
                {
                    $user=getuserdata($auc->auction_highbidder);
                    $newcash=$user->rpg_cash+$auc->auction_highbid;
                    dm_query("update users set `rpg_cash`='$newcash' where `id`='$auc->auction_highbidder'");
                    $to=$user->rpg_name;
                    $from="Imacomputa";
                    $subject="Outbid on auction";
                    $message="You were outbid on an auction for $auc->name";
              		pmsg($to,$from,$subject,$message);
                }


				dm_query("update rpg_inventory set `auction_highbidder`='$data->id' where `iid`='$iid'");
				dm_query("update rpg_inventory set `auction_highbid`='$bid' where `iid`='$iid'");
				$data->rpg_cash-=$bid;
				rpg_setvar("rpg_cash",$data->rpg_cash);
				inform("Your bid was successfully placed.");

			}
			else
			{
				inform("Invalid bid! Bid needs to be higher than the current high bid.");
			}
		}

	}

	if($action=="buyout")
	{
		$auc=rpg_getauctionobj($iid);
		$item=rpg_getitemobj($auc->id);
		echo"<p>Buying out auction $auc->name x $auc->quantity</p>";
		echo "<p><img src=\"images/$item->image\" border=0 width=64  height=64></p>";

		echo "<p>This auction will cost ".rpg_money_format($auc->auction_buyout)."</p>";
		echo "<p>Are you sure you want to do this? (<a href=rpg_auction.php?action=buyoutgo&iid=$iid>Yes</a>/<a href=rpg_auction.php>No</a>)</p>";

		exit();
	}
	if($action=="buyoutgo")
	{
		$auc=rpg_getauctionobj($iid);
		if(($data->rpg_cash-$auc->auction_buyout) < 0)
		{
			inform("You don't have the cash to buyout that auction!");
		}
		else
		{
			$data->rpg_cash-=$auc->auction_buyout;
			rpg_setvar("rpg_cash",$data->rpg_cash);

			$user=getuserdata($auc->auction_owner);
			$user->rpg_cash+=$auc->auction_buyout;
			dm_query("update users set `rpg_cash`='$user->rpg_cash' where `id`='$auc->owner'");

			$to=$user->rpg_name;
			$res=dm_query("select * from users where `name`='imacomputa'");
			$ima=mysql_fetch_object($res);
			$from=$ima->rpg_name;
			
			$subject="Auction Robot: Item buyout!";
			$message="Your auction of $auc->name x $auc->quantity was bought out by ";
			$message.="<a href=rpg_profile.php?id=$data->id>$data->rpg_name</a>";
			$message.=" for ".rpg_money_format($auc->auction_buyout).".";

			pmsg($to,$from,$subject,$message);

			if($user->rpg_emails=="yes")
			{
				mailgo($user->email,$message,$subject);
			}
			inform("You buy out $auc->name x $auc->quantity");
			
			rpg_giveitem($auc->id,$auc->quantity);
            dm_query("delete from rpg_inventory where `iid`='$auc->iid'");

			/*
           dm_query("update rpg_inventory set `user`='$data->id' where `iid`='$iid'");
           dm_query("update rpg_inventory set `auction_starttime`='0000-00-00 00:00:00' where `iid`='$item->iid'");
           dm_query("update rpg_inventory set `auction_endtime`='0000-00-00 00:00:00' where `iid`='$item->iid'");
           dm_query("update rpg_inventory set `auction_startbid`='0' where `iid`='$item->iid'");
           dm_query("update rpg_inventory set `auction_highbid`='0' where `iid`='$item->iid'");
           dm_query("update rpg_inventory set `auction_buyout`='0' where `iid`='$item->iid'");
           dm_query("update rpg_inventory set `auction_owner`='0' where `iid`='$item->iid'");
           */
		}
	}
	
	
	echo "[<a href=rpg_auction.php?action=newauction>Start new auction</a>]<br><br>";



    if(empty($top)) $top=0;
    if(empty($bot)) $bot=16;

    
    $srch="select * from rpg_inventory where user = 0 ";
	if(!empty($searches))
	{
      $srch.=" and `name` like '%$searches%' ";
    }

    if(!empty($search)) $srch.=" order by $search";
    $srch.=" limit $top, $bot";

	// echo "$srch";

    $res=dm_query($srch);
    $num=mysql_num_rows($res);
	echo "<table border=0>";
	echo "<tr><td>Item Name</td><td></td><td>qty</td><td>Owner</td><td>High bid</td><td>Buyout</td></tr>";
    for($i=0;$i<$num;$i++)
    {
      $aitem=mysql_fetch_object($res);
	  $item=rpg_getitemobj($aitem->id);
	  $hibidder=getuserdata($aitem->auction_highbidder);
	  $ownerx=getuserdata($aitem->auction_owner);
      
	  echo "<tr><td>";

	  echo "$item->name ";

	  echo "</td><td>";

	  echo rpg_itemlink($item->id,"000000");

	  echo "</td><td>";
	  
	  echo " x".$aitem->quantity;

	  echo "</td><td>";


	  echo "<a href=rpg_profile.php?id=$aitem->auction_owner>$ownerx->rpg_name</a> ";

	  echo "</td><td>";

	  echo rpg_money_format($aitem->auction_highbid)." ";

	  $hibida=$hibidder->rpg_name;
	  if(empty($hibida)) $hibida="no one";
	  else
	  {
		$hibida="<a href=rpg_profile.php?id=$aitem->auction_highbidder>".$hibida."</a>";
	  }

	  echo "[<a href=rpg_auction.php?action=placebid&iid=$aitem->iid>place bid</a>] ($hibida)";
	  
	  

	  echo "</td><td>";

	  echo rpg_money_format($aitem->auction_buyout)." ";
	  echo "[<a href=rpg_auction.php?action=buyout&iid=$aitem->iid>buyout</a>]";

	  
	  echo "</td></tr>";

    }
	echo "</table>";
    if($top>0) echo "[<a href=\"rpg_auction.php?top=".($top-15)."\">last</a>] ";
	if($num>15) echo " [<a href=\"rpg_auction.php?top=".($top+15)."\">next</a>]";
    echo "<br>";
    echo "<form action=rpg_auction.php method=post>Search<input name=searches><input type=submit></form>";

    echo "<br><br>";
    

  }
  else
  {
    inform("You do not have an auction robot in your base.");
  }
}

include("rpg_footer.php");
?>
