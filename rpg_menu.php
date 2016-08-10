<?php
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2016 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////
include("rpg_header.php");
$data=getuserdata($_SESSION['valid_user']);
if($_SESSION["logged_in"]!="true") {
    rpg_refresh("top","index.php");
    include("rpg_footer.php"); exit();
}
echo "<img src=\"images/dm_menu_banner.gif\" width=468 height=60><br>";
if($data->rpg=="yes") {
    echo "<table border=0><tr><td>.$dm_version</td><td>";
    echo "[<a href=\"logout.php\" target=_top>logout</a>] ";
    echo "</td><td>";
    echo "[<a href=\"rpg_profile.php\" target=mainpane>base</a>] ";
    echo "</td><td>";
    echo "[<a href=\"rpg_main.php?action=worldmap\" target=mainpane>map</a>] ";
    echo "</td><td>";
    echo "[<a href=\"rpg_char_doll.php\" target=mainpane>equipment</a>] ";
    echo "</td><td>";
    //echo "[<a href=\"rpg_skills.php\" target=mainpane>skills</a>] ";
    //echo "</td><td>";
    //echo "[<a href=\"rpg_craft.php\" target=mainpane>craft</a>] ";
    //echo "</td><td>";
    echo "[<a href=\"rpg_rank.php\" target=mainpane>rankings</a>] ";
    echo "</td><td>";
    //echo "[<a href=\"rpg_arena.php\" target=mainpane>arena</a>] ";
    //echo "</td><td>";
    //echo "[<a href=\"rpg_friends.php\" target=mainpane>friends</a>] ";
    //echo "</td><td>";
    //echo "[<a href=\"rpg_enemies.php\" target=mainpane>enemies</a>] ";
    //echo "</td><td>";
}
else {
    echo "[<a href=\"char_create.php\" target=mainpane>create character</a>] ";
    echo "</td><td>";
}
echo "[<a href=\"forum.php?forum_list=yes\" target=mainpane>forums</a>] ";
echo "</td><td>";
echo "[<a href=\"news.php\" target=mainpane>news</a>] ";
echo "</td><td>";
//echo "[<a href=\"help.php\" target=mainpane>help</a>] ";
//echo "</td><td>";
//echo "[<a href=\"rpg_donate.php\" target=mainpane>donate</a>] ";
//echo "</td><td>";
//echo "[<a href=\"rpg_store.php\" target=mainpane>store</a>] ";
//echo "</td><td>";
if($data->access>=255) {
    echo "[<a href=\"rpg_build.php\" target=mainpane>editors</a> ] ";
    echo "</td><td>";
}
//echo "[<a href=\"index.php?action=yesflash&id=$data->id\" target=_top>flash mode (experimental)</a> ] ";
echo "</td><td>";
echo "</tr></table>";
include("rpg_footer.php");
