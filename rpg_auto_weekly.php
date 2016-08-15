<?php
include("rpg_header.php");
echo "Weekly maintenance<br>";
$message  = "Cron Job<br>\n";
$message .= "That is all, Ima Computa out!\n";
mailgo("defectiveseth@gmail.com",$message,"rpg.sethcoder.com testing cron jobs");
//mailgo("will@defectiveminds.com",$message,"DeFeCtiVeMinDs.com testing cron jobs");
//mailgo("seth_coder@hotmail.com",$message,"DeFeCtiVeMinDs.com testing cron jobs");
//mailgo("2406196570@vtext.com",$message,"DeFeCtiVeMinDs.com testing cron jobs");
dm_log("*********** Weekly Cron Job ************");
//////////////////////////////////////////////////////////////////////////////////
// Remove unconfirmed accounts
$res=dm_query("select * from users");
$nusers=mysql_num_rows($res);
for($i=0;$i<$nusers;$i++) {
    $user=mysql_fetch_object($res);
    if($user->last_activity=="0000-00-00 00:00:00") {
        $dte=explode(" ",$user->first_login);
        $d1=$dte[0];
        $d2=date("Y-m-d");
        $j = (strtotime($d2)-strtotime($d1))/86400;
        if($j>7) {
            dm_log("********* Removing $user->name $user->email for non-confirmation.");
            echo "Removing $user->name ( $j days non confirmation )  <br>";
            dm_query("delete from users where `id`='$user->id' limit 1");
        }
    }
}
