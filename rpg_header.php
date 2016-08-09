<?php
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////

include ("dm_config.php");

$vusr=$HTTP_SESSION_VARS['valid_user'];
$data=getuserdata($vusr);
usersonline($data->name);

if(!empty($dm_edge_left))
    $dm_left_code="<img src=$locate/images/$dm_edge_left border=0 height=100% width=5>";
else
    $dm_left_code="&nbsp;";

if(!empty($dm_edge_right))
    $dm_right_code="<img src=$locate/images/$dm_edge_right border=0 height=100% width=5>";
else
    $dm_right_code="&nbsp;";

function keywords() {
	echo "Defective Minds Role Playing Game RPG Web based ";
}

echo "<html>\n<head>\n";
echo "<meta name=\"ROBOTS\" content=\"INDEX,FOLLOW\">\n";
//echo "<meta http-equiv=\"Content-Language\" content=\"en-us\">\n";
//echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1252\">\n";
echo "<meta name=\"GENERATOR\" content=\"Notepad\">\n";
echo "<meta name=\"ProgId\" content=\"Notepad\">\n";
echo "<meta name=\"description\" content=\"";
keywords();
echo "\">\n";
echo "<meta name=\"keywords\" content=\"";
keywords();
echo "\">\n";

echo "<title>.: Defective Minds : Ultimate RPG :.</title>";

echo "<link rel=\"stylesheet\" href=\"rpg.css\" type=\"text/css\">\n";
echo "</head>\n<body bgcolor=\"$site_bg_color\" topmargin=\"0\" leftmargin=\"0\">\n";

echo "<style type=\"text/css\">\n";
echo "a.dmz_item {\n position: relative;\n z-index: 4;\n}\n";
echo "a.dmz_item:hover { \n z-index:5; \n}\n";
echo "a.dmz_item span {\n display: none;\n text-decoration: none;\n }\n";
echo "a.dmz_item:hover span {\n display: block;\n position: absolute;\n ";
echo "top: 0.0ex;\n left: 7.0ex;\n width: 22ex;\n padding: 1.8ex;\n ";
echo "border: 1px solid yellow;\n background-color: #332200;\n color: white; ";
echo "\ntext-align: left;\n     text-decoration: none;\n}\n";
echo "</style>\n";

echo "<style type=\"text/css\">\n";
echo "a.worldmap {\n position: relative;\n z-index: 4;\n}\n";
echo "a.worldmap:hover { \n z-index:5; \n}\n";
echo "a.worldmap span {\n display: none;\n text-decoration: none;\n }\n";
echo "a.worldmap:hover span {\n display: block;\n position: absolute;\n ";
echo "top: 15.0ex;\n left: -23.25ex;\n width: 40ex;\n padding: 1.8ex;\n ";
echo "border: 1px solid black;\n background-color: #eefe40;\n color: black; ";
echo "\ntext-align: left;\n     text-decoration: none;\n}\n";
echo "</style>\n";

echo "<style type=\"text/css\">\n";
echo "a.worldmap_top_left {\n position: relative;\n z-index: 4;\n}\n";
echo "a.worldmap_top_left:hover { \n z-index:5; \n}\n";
echo "a.worldmap_top_left span {\n display: none;\n text-decoration: none;\n }\n";
echo "a.worldmap_top_left:hover span {\n display: block;\n position: absolute;\n ";
echo "top: 2.0ex;\n left: 8.25ex;\n width: 20ex;\n padding: 1.8ex;\n ";
echo "border: 1px solid black;\n background-color: #eefe40;\n color: black; ";
echo "\ntext-align: left;\n     text-decoration: none;\n}\n";
echo "</style>\n";

echo "<style type=\"text/css\">\n";
echo "a.worldmap_top_right {\n position: relative;\n z-index: 4;\n}\n";
echo "a.worldmap_top_right:hover { \n z-index:5; \n}\n";
echo "a.worldmap_top_right span {\n display: none;\n text-decoration: none;\n }\n";
echo "a.worldmap_top_right:hover span {\n display: block;\n position: absolute;\n ";
echo "top: 2.0ex;\n left: -13.25ex;\n width: 20ex;\n padding: 1.8ex;\n ";
echo "border: 1px solid black;\n background-color: #eefe40;\n color: black; ";
echo "\ntext-align: left;\n     text-decoration: none;\n}\n";
echo "</style>\n";

echo "<style type=\"text/css\">\n";
echo "a.worldmap_bot_left {\n position: relative;\n z-index: 4;\n}\n";
echo "a.worldmap_bot_left:hover { \n z-index:5; \n}\n";
echo "a.worldmap_bot_left span {\n display: none;\n text-decoration: none;\n }\n";
echo "a.worldmap_bot_left:hover span {\n display: block;\n position: absolute;\n ";
echo "top: -15.0ex;\n left: 13.25ex;\n width: 20ex;\n padding: 1.8ex;\n ";
echo "border: 1px solid black;\n background-color: #eefe40;\n color: black; ";
echo "\ntext-align: left;\n     text-decoration: none;\n}\n";
echo "</style>\n";

echo "<style type=\"text/css\">\n";
echo "a.worldmap_bot_right {\n position: relative;\n z-index: 4;\n}\n";
echo "a.worldmap_bot_right:hover { \n z-index:5; \n}\n";
echo "a.worldmap_bot_right span {\n display: none;\n text-decoration: none;\n }\n";
echo "a.worldmap_bot_right:hover span {\n display: block;\n position: absolute;\n ";
echo "top: -15.0ex;\n left: -24.25ex;\n width: 20ex;\n padding: 1.8ex;\n ";
echo "border: 1px solid black;\n background-color: #eefe40;\n color: black; ";
echo "\ntext-align: left;\n     text-decoration: none;\n}\n";
echo "</style>\n";



echo "<!-- "; keywords(); echo "-->\n";

