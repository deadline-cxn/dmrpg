<?
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////

include("rpg_header.php");
$data=getuserdata($HTTP_SESSION_VARS['valid_user']);

if($HTTP_SESSION_VARS["logged_in"]!="true")
{
  	rpg_refresh("top","index.php");
    include("rpg_footer.php");
    exit();
}

if($data->rpg=="yes")
{
//  echo "Abilities [<a href=rpg_profile.php?action=configure_abilities target=mainpane>configure</a>]<br>";
  //  
}
else
{

}

?>

