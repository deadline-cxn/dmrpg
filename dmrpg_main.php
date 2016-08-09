<?php
include("dm_config.php");

//if($_SESSION["logged_in"]!="true") {  exit(); }
/*
http://www.flashandmath.com/basic/
http://www.flashandmath.com/basic/randompic/randompic2.html
http://www.flashandmath.com/basic/tween/example4.html
http://www.flashandmath.com/basic/transitions/example3.html
http://www.flashandmath.com/basic/dragdroptour/dd_tour5.html
http://www.actionscript.org/resources/articles/905/1/Simple-Enemies/Page1.html
http://www.actionscript.org/resources/articles/842/1/Command-line-terminal-for-Flash/Page1.html
http://www.actionscript.org/resources/categories/Tutorials/Flash/
*/

$returnVars = array();
$returnVars['wtf']="wtf"; // dunno why but if this isnt in here the data gets fucked
$returnVars['wtf2']="wtf2"; // dunno why but if this isnt in here the data gets fucked
$returnVars['action']=$action."_cb";

$data=getuserdata($_SESSION['valid_user']);

if($action!="chat_update" ) dm_log("TESTING[$PHP_SELF]:IN::::::::::::::--- $data->id $data->name $action");

if($action=="start")
{
    while(list ($key, $dat) = each ($data)) // return all the data in $data to the flash - easy
    {
      if($key!="pass") // don't send password
        $returnVars[$key]=$dat;
    }

    $returnVars['motd']="Welcome to Defective Minds RPG. If you have any questions, comments, or suggestions please use the forums.";

    rpg_removeoldchat();

    $res=dm_query("select * from rpg_chat order by timestamp asc");
    $num=mysql_num_rows($res);
    $retchat="";
    for($i=0;$i<$num;$i++)
    {
      $chat=mysql_fetch_object($res);
      $retchat.=$chat->name.": ".$chat->message."\n";
    }
    $returnVars['inmessage']=rtrim($retchat,"\n");
    $returnVars['lastmessagetime']=$chat->timestamp;

    // send class information
    $result=dm_query("select * from rpg_classes"); $numclasses=mysql_num_rows($result); $classinfo="";
    for($i=0;$i<$numclasses;$i++) { $class=mysql_fetch_object($result); $classinfo.="$class->id;$class->name;$class->image;$class->info|"; }
    $returnVars["classinfo"]=rtrim($classinfo,"|");

    // send item information
    $result=dm_query("select * from rpg_items"); $numitems=mysql_num_rows($result); $iteminfo="";
    for($i=0;$i<$numitems;$i++) { $item=mysql_fetch_object($result);
    //$item->description=stripslashes($item->description);
    $item->name=stripslashes($item->name);
    $item->description="\n".rpg_getitemtext($item->id)."\n";
    



    $iteminfo.="$item->id;$item->name;$item->image;$item->description|"; }
    $returnVars["iteminfo"]=rtrim($iteminfo,"|");
    



}

if($action=="clickedinv")
{

  $startVars = array();
    // store vars before item modification
     while(list ($key, $dat) = each ($data))
     {
       if($key!="pass") // don't send password
         $startVars[$key]=$dat;
     }

  $item=rpg_getitemobj($item);
  $returnVars['item']=$item->id;

  $acttxt=rpg_getactiontext($item->action);
  if(empty($acttxt) || ($acttxt=="\n") )
  $acttxt="no action";
  else
  {
    $result=dm_query("select * from rpg_inventory where `user`='$data->id' and `id`='$item->id'");
    $inv=mysql_fetch_object($result);

    if($item->useable=="1")
    {
      if(rpg_doaction($item->action)!=1) // return 1 means the item was not used and will not be consumed
      {
         if($inv->charges=="1") rpg_takeitem($item->id,1);
         else                   dm_query("update rpg_inventory set `charges`=`charges`-1 where `iid`='$inv->iid'");
      }
      $result=dm_query("select * from rpg_inventory where `user`='$data->id' and `id`='$item->id'");
      $inv=mysql_fetch_object($result);
    }

    $data=getuserdata($_SESSION['valid_user']); // get data to obtain most up to date info

    // update stats
     while(list ($key, $dat) = each ($data)) // return all the data in $data to the flash - easy
     {
       if($key!="pass") // don't send password
       {
         if($startVars[$key]!=$dat) $returnVars[$key]=$dat;
       }
     }
  }
  if(empty($inv->quantity)) $inv->quantity=0;

  $returnVars['qty']="$inv->quantity";
  $returnVars['sysmessage']="Clicked $item->name";
  $returnVars['acttxt']=$acttxt;

    $lout="";
    $lex=explode("|",$GLOBALS['lootout']);
    //dm_log($GLOBALS['lootout']);
    for($i=0;$i<count($lex);$i++)
    {
      $lexo=explode("x",$lex[$i]);
        //      $lfo=$lexo[0];
      $lout.=$lexo[0];
      if(rpg_inventory_qty($lexo[0]) > 1)
      $lout.="x".rpg_inventory_qty($lexo[0]);
      $lout.="|";
    }
    if($GLOBALS['lootout']=="")
    {
      $lout=0;
    }
    else
    {
        $returnVars['inventory']=rtrim($lout,"|");
        $returnVars['warn']=    $returnVars['inventory'];
    }


}

if($action=="exitflash")
{
    rpg_setvar("show_flash","no");
    $returnVars['action']= "exitflash_cb";
}

if($action=="chat")
{
  

  if($message[0]=="/")
  {
    $returnVars['action']="command_cb";
    
    $cmds=explode(" ",$message);

    if($cmds[0]=="/gi")
    {
          rpg_giveitem($cmds[1],1);
          $resu=dm_query("select * from rpg_inventory where `id`='".$cmds[1]."' and `user`='$data->id'");
          $itemu=mysql_fetch_object($resu);
          $returnVars['action']="clickedinv_cb";
          $returnVars['item']=$itemu->id;
          $returnVars['qty']=$itemu->quantity;
          $returnVars['sysmessage']="Gave random item!";
          $returnVars['acttxt']="/give item ".$itemu->name;
    }

    if($message=="/gr")
    {
      $res=dm_query("select * from rpg_items");
      $num=mysql_num_rows($res);
      $it=rand(0,$num);
      dm_log("   $it");

      for($i=0;$i<$num;$i++)
      {
        $item=mysql_fetch_object($res);
        if($i==$it)
        {
          rpg_giveitem($item->id,1);
          $resu=dm_query("select * from rpg_inventory where `id`='$item->id' and `user`='$data->id'");
          $itemu=mysql_fetch_object($resu);
          $returnVars['action']="clickedinv_cb";
          $returnVars['item']=$item->id;
          $returnVars['qty']=$itemu->quantity;
          $returnVars['sysmessage']="Gave random item!";
          $returnVars['acttxt']="/giverand";
        }
      }


    }
    
    if($message=="/who")
    {
      $returnVars['inmessage']="WHO COMMAND NOT FULLY IMPLEMENTED";
    }

    if($message=="/help")
    {
       $returnVars['inmessage']="HELP";
    }

    if($message=="/refreshinv")
    {
      $returnVars['action']="getinventory_cb";
      $action="getinventory";
    }
    

  }
  else
  {
    $returnVars['lastmessagetime']=rpg_putchatmsg($data->rpg_name,$message);
    $res=dm_query("select * from rpg_chat where `timestamp` > '$lastmessagetime'");
    $num=mysql_num_rows($res);
      $retchat="";
      for($i=0;$i<$num;$i++)
      {
        $chat=mysql_fetch_object($res);
        $retchat.=$chat->name.": ".$chat->message."\n";
      }
    $returnVars['inmessage']=rtrim($retchat,"\n");
  }
}

if($action=="usereditstart")
{
  $res=dm_query("select * from users");
  $num=mysql_num_rows($res);
  $ret="";
  for($i=0;$i<$num;$i++)
  {
    $usr=mysql_fetch_object($res);
    if(!empty($usr->rpg_name))
        $ret.="$usr->rpg_name|";
  }
  $returnVars['sysmessage']=rtrim($ret,"|");
}

if($action=="moduser")
{
  
  while(list($key, $value) = each($HTTP_GET_VARS))
    {
        dm_log("$key = $value");;
    }
    
    $res=dm_query("select * from users where `rpg_name`='$rpg_name'");
    $usr=mysql_fetch_object($res);
    $name=$usr->name;

    if(!empty($rpg_name))       rpg_setvaruser($name,"rpg_name",$rpg_name);
    if(!empty($rpg_cl))         rpg_setvaruser($name,"rpg_class",$rpg_cl);
    if(!empty($rpg_hp))         rpg_setvaruser($name,"rpg_hp",$rpg_hp);
    if(!empty($rpg_hpmax))      rpg_setvaruser($name,"rpg_hpmax",$rpg_hpmax);
    if(!empty($rpg_pow))        rpg_setvaruser($name,"rpg_pow",$rpg_pow);
    if(!empty($rpg_powmax))     rpg_setvaruser($name,"rpg_powmax",$rpg_powmax);
    if(!empty($rpg_str))        rpg_setvaruser($name,"rpg_str",$rpg_str);
    if(!empty($rpg_int))        rpg_setvaruser($name,"rpg_int",$rpg_int);
    if(!empty($rpg_agl))        rpg_setvaruser($name,"rpg_agl",$rpg_agl);
    if(!empty($rpg_def))        rpg_setvaruser($name,"rpg_def",$rpg_def);
    if(!empty($rpg_level))      rpg_setvaruser($name,"rpg_level",$rpg_level);
    if(!empty($rpg_exp))        rpg_setvaruser($name,"rpg_exp",$rpg_exp);
    if(!empty($rpg_totalexp))   rpg_setvaruser($name,"rpg_totalexp",$rpg_totalexp);
    if(!empty($rpg_trainpoints))rpg_setvaruser($name,"rpg_trainpoints",$rpg_trainpoints);
    if(!empty($rpg_x))          rpg_setvaruser($name,"rpg_x",$rpg_x);
    if(!empty($rpg_y))          rpg_setvaruser($name,"rpg_y",$rpg_y);
    if(!empty($rpg_z))          rpg_setvaruser($name,"rpg_z",$rpg_z);
    if(!empty($rpg_cash))       rpg_setvaruser($name,"rpg_cash",$rpg_cash);
    $returnVars['sysmessage']="yo";
    
/*
dmrpg_main.php?
action=moduser
&orpg_name=Char
&rpg_name=Char
&rpg_class=5
&rpg_hp=31
&rpg_hpmax=67
&rpg_pow=74
&rpg_powmax=74
&rpg_str=13
&rpg_int=19
&rpg_agl=16
&rpg_def=16
&rpg_level=3
&rpg_exp=2090
&rpg_totalexp=30404
&rpg_trainpoints=0
&rpg_x=0
&rpg_y=-2
&rpg_z=51
&rpg_cash=1.97
*/

}

if($action=="usereditgetdata")
{
  $res=dm_query("select * from users where `rpg_name`='$name'");
  $usr=mysql_fetch_object($res);

   while(list ($key, $dat) = each ($usr)) // return all the data in $data to the flash - easy
     {
       if($key!="pass") // don't send password
       {
         if($startVars[$key]!=$dat) $returnVars[$key]=$dat;
       }
     }
}



if($action=="chat_update")
{
  $res=dm_query("select * from rpg_chat where `timestamp` > '$lastmessagetime'");
  $num=mysql_num_rows($res);
    $retchat="";
    for($i=0;$i<$num;$i++)
    {
      $chat=mysql_fetch_object($res);
      $retchat.=$chat->name.": ".$chat->message."\n";
    }
    if(!empty($retchat))
      $returnVars['inmessage']=rtrim($retchat,"\n");
    $returnVars['lastmessagetime']=time();
}

if($action=="getinventory")
{
    $inv="";
    $result=dm_query("select * from rpg_inventory where `user`='$data->id'");
    $icount=mysql_num_rows($result);
	if($icount==0)
	{
         //$inv.="You have nothing in your inventory";
	}
	else
	{
      for($i=0;$i<$icount;$i++)
      {
        $it=mysql_fetch_object($result);
        $inv.=$it->id;
        if($it->quantity>1) $inv.="x$it->quantity";
        $inv.="|";  // 1x54|54x5


      }
    }
    if(empty($inv)) $inv="0";
    $returnVars['inventory']=rtrim($inv,"|");;
}


$returnString = http_build_query($returnVars);

if($returnVars['action']!="start_cb" )
    if($returnVars['action']!="chat_update_cb" )
        dm_log("TESTING[$PHP_SELF]:OUT:::::::::::::--- $data->id $data->name ".$returnVars['action']." = ".$returnString);

echo $returnString;

?>
