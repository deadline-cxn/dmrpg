<?php
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2016 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////
include("dm_config.php");
function keywords() {
    echo "Defective Minds Role Playing Game RPG Web based ";
}
if($_SESSION["logged_in"]!=true) {
    include("rpg.thm.php");
    echo "<html>\n<head>\n";
    echo "<meta name=\"ROBOTS\" content=\"INDEX,FOLLOW\">\n";
    echo "<meta name=\"GENERATOR\" content=\"Notepad\">\n";
    echo "<meta name=\"ProgId\" content=\"Notepad\">\n";
    echo "<meta name=\"description\" content=\""; keywords(); echo "\">\n";
    echo "<meta name=\"keywords\" content=\"";    keywords(); echo "\">\n";
    echo "<title>.: Defective Minds : Ultimate RPG :.</title>";
    echo "<link rel=\"stylesheet\" href=\"rpg.css\" type=\"text/css\">\n";
    echo "</head>\n<body bgcolor=$site_bg_color leftmargin=0 topmargin=0>\n";
    echo "<!-- "; keywords(); echo " -->\n";
    echo  " <table border=0 width=1108 cellspacing=1 cellpadding=1><tr>";
    echo "<td background=images/dm_left.gif width=73></td>";
    echo "<td background=images/dm_banner.gif height=135><center><font class=dm_banner>DEFECTIVE MINDS</font></center></td>";
    //  	echo "<img src=images/dm_left.gif>";
    //	echo "<img src=images/dm_banner.gif height=135><br>";
    echo "</tr></table>";
    echo "<table border=0 width=1108 height=400 cellspacing=0 cellpadding=10><tr><td background=images/front_image.gif valign=bottom align=right>";
    echo "Login below.<br>If you haven't got an account,<br>you may <a href=join.php>Register</a> now.<br><br>";
    echo "<form method=post action=\"$locate/login.php\">";
    echo "<input type=hidden name=outpage value=\"$thispage\">";
    echo "<input type=hidden name=action value=\"logingo\">";
    // echo "<input type=hidden name=outpage value=index.php>";
    // echo "<input type=hidden name=login value=fo_shnizzle>\n";
    echo "<table border=0 cellspacing=0 cellwidth=0 cellpadding=0 valign=middle>\n";
    echo "<tr valign=middle>\n";
    echo "<td>Login &nbsp;</td>";
    echo "<td><input type=text name=userid size=10 class=\"b4text\"></td>";
    echo "</tr><tr>";
    echo "<td>Password &nbsp;</td>";
    echo "<td><input type=password name=password size=10 class=\"b4text\"></td>\n";
    echo "</tr><tr>";
    echo "<td valign=middle></td><td valign=middle><br>\n";
    echo "<input type=\"submit\" name=\"Login\" value=\"Login\">\n";
    echo "</form>\n";
    echo "</tr>\n";
    echo "</table>\n";
    echo "<br><br>Defective Minds RPG<br>";
    echo "$dm_version<br><br>";
    echo "Choose your side: Good or Evil.<br>";
    echo "Fight against forces in the lands<br>";
    echo "or PvP against other players.<br><br><br>";
    echo "<img src=images/pa.gif><br>";
    echo "</td></tr></table>";
    echo "</td></tr></table>";
    echo "<table border=0 width=50%><tr><td valign=top>";
    include("news.php");
    echo "</td><td valign=top>";
    include("rpg_footer.php");
    exit();
}
$data=getuserdata($_SESSION['valid_user']);
// print_r($data);
if($data->show_flash=="yes") {
/*  include("rpg.thm.php");
    echo "<html>\n<head>\n";
    echo "<meta name=\"ROBOTS\" content=\"INDEX,FOLLOW\">\n";
    echo "<meta name=\"GENERATOR\" content=\"Notepad\">\n";
    echo "<meta name=\"ProgId\" content=\"Notepad\">\n";
    echo "<meta http-equiv=\"pragma\" content=\"no-cache\" />\n";
    echo "<meta name=\"description\" content=\""; keywords(); echo "\">\n";
    echo "<meta name=\"keywords\" content=\"";    keywords(); echo "\">\n";
    echo "<title>.: Defective Minds : Ultimate RPG :.</title>";
    echo "<link rel=\"stylesheet\" href=\"rpg.css\" type=\"text/css\">\n";
    echo "</head>\n<body bgcolor=$site_bg_color leftmargin=0 topmargin=0 onload=resetWidth('flashme') onresize=resetWidth('flashme')>";
    echo "<!-- "; keywords(); echo " -->\n";
    echo "<script language=\"JavaScript\" type=\"text/javascript\">
            function resetWidth(x) {
                var flash = document.getElementById(x);
                var winWidth = document.body.clientWidth?document.body.clientWidth:window.innerWidth;
                flash.setAttribute(\"width\", winWidth);
            }
            function resetWidthb(x) {
                if(flash==null) return;
                var flash = document.getElementById(x);
                var win_width = window.innerWidth;
                if (win_width < 812) {
                    flash.setAttribute(\"width\", \"812\");
                } else {
                    flash.setAttribute(\"width\", win_width);
            }
        }
        </script>
        <OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" width=\"100%\" height=\"100%\" id=\"myMovieName\">
        <PARAM NAME=movie VALUE=\"dmrpg_main.swf\">
        <PARAM NAME=quality VALUE=high>
        <PARAM NAME=bgcolor VALUE=#000000>
        <EMBED src=\"dmrpg_main.swf\"
        id=\"flashme\"
        quality=high bgcolor=#000000 width=\"100%\" HEIGHT=\"100%\" NAME=\"dmrpg_main.swf\"
        ALIGN=\"\" TYPE=\"application/x-shockwave-flash\"
        PLUGINSPAGE=\"http://www.macromedia.com/go/getflashplayer\">
        </EMBED>
        </OBJECT>
     </body>
    </html> ";
  exit;   */
}
echo "<html><head><title>Defective Minds RPG</title></head> ";
echo "<frameset cols=\"4*,*\" border=\"0\" frameborder=\"0\" framespacing=\"0\">
    <frameset rows=\"88,*\" border=\"0\" frameborder=\"0\" framespacing=\"0\">
        <frame name=menupane src=\"rpg_menu.php\" scrolling=no noresize framespacing=\"0\" frameborder=\"0\" border=\"0\">
        </frame>
        <frameset cols=\"212,*\" border=\"0\" frameborder=\"0\" framespacing=\"0\">
            <frame name=charpane src=\"rpg_character.php\" noresize framespacing=\"0\" frameborder=\"0\" border=\"0\">
             <frameset rows=\"*,180\" border=\"0\" frameborder=\"0\" framespacing=\"0\">
                  <frame name=mainpane src=\"rpg_main.php?action=worldmap\" noresize framespacing=\"0\" frameborder=\"0\" border=\"0\">
                   <frame name=bottom src=\"rpg_bottom.php\" noresize framespacing=\"0\" frameborder=\"0\" border=\"0\">
            </frameset>
        </frameset>
    </frameset>
    <frame name=right src=\"rpg_rightpane.php\" noresize framespacing=\"0\" frameborder=\"0\" border=\"0\"></frame>
 </frameset>
</html>";
/*    if ((winWidth < 1025) && (winWidth > 799 )) {
        flash.setAttribute("width", "1000px");
        flash.setAttribute("height", "768px");
    } else{
        flash.setAttribute("width", "800px");
        flash.setAttribute("height", "600px");
    }

<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="stage" ALIGN="top">
<PARAM NAME=menu VALUE=false>
<PARAM NAME=quality VALUE=high>
<param name='SCALE' value='exactfit'>
<PARAM NAME=bgcolor VALUE=#000000>
<EMBED src="dmrpg_main.swf" id="flashme" menu="false" 
quality="high" bgcolor="#000000" 
NAME="stage"
ALIGN="top" TYPE="application/x-shockwave-flash" 
PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer">
</EMBED>
</OBJECT>
//window.onresize = resetWidth("flashme") ;  codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/SWFlash.cab#version=7,0,0,0"
var requiredMajorVersion = 9;
var requiredMinorVersion = 0;
var requiredRevision = 0;
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td align="center" valign="middle">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="dmrpg3" width="400" height="260" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
salign="LT" 
  <param name="movie" value="dmrpg_main.swf" />
  <param name="quality" value="high" />
  <param name="wmode" value="transparent">
  <param name="bgcolor" value="#869ca7" />
  <param name="allowScriptAccess" value="always" />
  <PARAM NAME=FlashVars value="allowResize=true">
<PARAM NAME=FlashVars value="allowResize=true">
  <embed src="dmrpg_main.swf" quality="high" bgcolor="#869ca7" width="400" height="260" name="dmrpg"
   play="true"  loop="false" quality="high" wmode="transparent" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer"> </embed>
    </object>
</td></tr></table>
<div name="flv_frame" id="flv_frame" style="">
<script language="JavaScript" type="text/javascript">
    var w = document.body.clientWidth;
    var h = document.body.clientHeight;
    var rate = 7 / 12;
    var currentRate = h / w;
    if ( currentRate > rate ) {
        flash_width = w;
        flash_height = w * rate;
    } else {
        flash_width = h / rate;
        flash_height = h;
    }
</script>
<div>  <div class="foot" name="foot" id="foot">    <p>Copyright ©2009 Defective Minds. All rights reserved. </p>   </div> </div>
</div>
*/
// width="400" height="260"
// flash("dmrpg_main.swf",1024,768);
// echo "<table border=0><tr><td>[<a href=index.php?action=noflash&id=$data->id>exit flash mode</a>]</td></tr></table>";


