<?php
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////
include("rpg_header.php");
$data=getuserdata($_SESSION['valid_user']);
if($_SESSION["logged_in"]!="true") {
  	rpg_refresh("top","index.php");
    include("rpg_footer.php");
    exit();
}
if($data->rpg=="yes") {
    //  echo "Abilities [<a href=rpg_profile.php?action=configure_abilities target=mainpane>configure</a>]<br>";
}
else {

}
