<?php
$link_out=$_REQUEST['link'];
include("dm_config.php");
$link_domain=dm_getdomain($link_out);
$result=dm_query("select * from link_bin where `link` like '$link_domain%'"); if(mysql_num_rows($result)>0)
{   $link=mysql_fetch_object($result); $link->clicks=$link->clicks+1;
    dm_query("update link_bin set `clicks` = '$link->clicks' where `id` = '$link->id'"); }

$result=dm_query("select * from link_friends where `link` = '$link_domain'"); if(mysql_num_rows($result)>0)
{   $link=mysql_fetch_object($result); $link->clicks=$link->clicks+1;
    dm_query("update link_friends set `clicks` = '$link->clicks' where `id` = '$link->id'"); }

$result=dm_query("select * from link_crap where `link` = '$link_domain'"); if(mysql_num_rows($result)>0)
{   $link=mysql_fetch_object($result); $link->clicks=$link->clicks+1;
    dm_query("update link_crap set `clicks` = '$link->clicks' where `id` = '$link->id'"); }

$result=dm_query("select * from referrals where `link` = '$link_domain'"); if(mysql_num_rows($result)>0)
{   $link=mysql_fetch_object($result); $link->clicks=$link->clicks+1;
    dm_query("update referrals set `clicks` = '$link->clicks' where `id` = '$link->id'"); }
header("Location: $link_out\r\n");
?>
