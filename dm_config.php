<?php
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////

$dm_version="v4.0.2 (beta)";
$serverName = getenv("HTTP_HOST");
@session_name('dm_rpg');
//@session_cache_limiter('private');
@session_cache_expire(99999);
@session_start();

$pwd=exec("hostname");
//echo $pwd;

if($pwd=="844cgwhp21c12au") {
  //echo "[$serverName]";
    switch($serverName)
    {
      case "127.0.0.1":
        break;
      case "844cgwhp21c12au":
        break;
      default:
        include("cannot.txt");
        die();
        break;
    }
}


$GLOBALS["authdbname"]    = "rpg";
$GLOBALS["authdbaddress"] = "localhost";
$GLOBALS["locate"]        = "http://rpg.sethcoder.com";
$GLOBALS["local_path"]    = "/var/www/rpg.sethcoder.com/html";
$GLOBALS["log_path"]      = "/var/www/rpg.sethcoder.com/logs";
$GLOBALS["authdbuser"]    = "rpg";
$GLOBALS["authdbpass"]    = "!QAZ2wsx";

setlocale(LC_MONETARY, 'en_US');

include("dm_time.php");
include("comments.php");
include("rpg.thm.php");
include("rpg_funcs.php");

$counttoday=0;
$countit=dm_count();
$logged_in=$_SESSION["logged_in"];



$blur_start="<span style=\"filter: Blur(Add=1, Direction=255, Strength=6)\">\n";
$blur_end="</span>\n";

$at="<img src=\"$locate/images/fat.gif\" border=\"0\">";

$breadcrumb_begin="<img src=\"$locate/images/breadcrumb2.gif\" border=\"0\">";
$breadcrumb="<img src=\"$locate/images/breadcrumb.gif\" border=\"0\">";


function getuserdata($userid) { return dm_getuserdata($userid); }
function dm_getuserdata($name)
{
    if(is_numeric($name)) $result = dm_query("select * from users where id = '$name'");
    else                  $result = dm_query("select * from users where name = '$name'");
    return mysql_fetch_object($result);
}

function getuserdatabyfield($field,$data)
{
    $result = dm_query("select * from users where `$field` = '$data'");
    return mysql_fetch_object($result);
}

function mailto($user,$domain)
{
    echo "<META HTTP-EQUIV=\"refresh\" content=\"0;URL=$locate/mailto.php?user=$user&domain=$domain\">";
}


function flashnosize($swf)
{
        echo "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" \n";
        echo "codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=4,0,28,0\" >\n";
        echo "<param name=src value=\"$swf\">";
        echo "<param name=quality value=high>\n";
        echo "<param name=bgcolor value=ff9900>\n";
        //echo "<param name=wmode value=opaque>\n";
        echo "<param name=wmode value=transparent>\n";
        echo "<param name=menu value=false>\n";
        echo "<embed src=\"$swf\" ";
        echo "menu=false quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" \n";
        echo "type=\"application/x-shockwave-flash\" bgcolor=000000 wmode=transparent>\n";
        echo "</embed></object>";
}

function flash_color($swf,$bgcolor,$width,$height)
{
    echo "<table border=0 bgcolor=black><tr><td>";
    echo "<table border=0 bgcolor=$bgcolor><tr><td>";
    flash($swf,$width,$height);
    echo "</td></tr></table>";
    echo "</td></tr></table>";
}

function flash_white($swf,$width,$height)
{
    echo "<table border=0 bgcolor=black><tr><td>";
    echo "<table border=0 bgcolor=white><tr><td>";
    flash($swf,$width,$height);
    echo "</td></tr></table>";
    echo "</td></tr></table>";
}

function flash($swf,$width,$height)
{
        echo "<object align=center classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" \n";
        echo "codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=4,0,28,0\" width=$width height=$height>\n";
        echo "<param name=src value=\"$swf\">";
        echo "<param name=quality value=high>\n";
        echo "<param name=bgcolor value=ff9900>\n";
        echo "<param name=wmode value=transparent>\n";
        echo "<param name=menu value=false>\n";
        echo "<embed src=\"$swf\" ";
        echo "menu=false quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" \n";
        echo "type=\"application/x-shockwave-flash\" bgcolor=000000 wmode=transparent width=$width height=$height>\n";
        echo "</embed></object>";
}

function al_flash($swf,$width,$height,$align)
{
    echo "<object align=\"$align\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" \n";
    echo "codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=4,0,28,0\" width=$width height=$height>\n";
    echo "<param name=src value=\"$swf\">";
    echo "<param name=quality value=high>\n";
    echo "<param name=bgcolor value=ff9900>\n";
    echo "<param name=wmode value=transparent>\n";
    echo "<param name=menu value=false>\n";
    echo "<embed src=\"$swf\" ";
    echo "menu=false quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" \n";
    echo "type=\"application/x-shockwave-flash\" bgcolor=000000 wmode=transparent width=$width height=$height>\n";
    echo "</embed></object>";
}

function dm_getflashcode($swf,$width,$height)
{

    $d=  "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" \n";
    $d.= "codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=4,0,28,0\" width=$width height=$height>\n";
    $d.= "<param name=src value=\"$swf\">";
    $d.= "<param name=quality value=high>\n<param name=bgcolor value=ff9900>\n<param name=wmode value=trasnparent>\n<param name=menu value=false>\n";
    $d.= "<embed src=\"$swf\" ";
    $d.= "menu=false quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" \n";
    $d.= "type=\"application/x-shockwave-flash\" bgcolor=000000 wmode=transparent width=$width height=$height>\n";
    $d.= "</embed></object>";
    return $d;
}

function dm_getimagecode($url,$width,$height,$alt)
{
    $d=  "<img src=$url border=\"0\" title=\"$alt\" alt=\"$alt\" ";
    if(!empty($width))  $d.="width=\"$width\" ";
    if(!empty($height)) $d.="height=\"$height\" ";
    $d.= ">\n";
    return $d;
}

function imgn($url,$alt)
{
    $d=  "<img src=$url border=\"0\" title=\"$alt\" alt=\"$alt\">\n";
	return $d;
}

function imgs($url,$alt,$w,$h)
{
    $d=  "<img src=$url border=\"0\" title=\"$alt\" alt=\"$alt\" width=$w height=$h>\n";
	return $d;
}

function imgat($url,$alt,$ourl,$target)
{
	$d="<a href=\"$ourl\" target=\"$target\"><img src=\"$url\" border=\"0\" title=\"$alt\" alt=\"$alt\"></a>\n";
	return $d;
}

function imga($url,$alt,$ourl,$target)
{
	$d="<a href=\"$ourl\"><img src=\"$url\" border=\"0\" title=\"$alt\" alt=\"$alt\"></a>\n";
	return $d;
}

function b4time($whattime)
{
    include("dm_time.php");
    list($adate,$atime)=explode(" ",$whattime);
    list($tyear,$tmonth,$tday)  = explode("-",$adate);
    list($thour,$tminute,$tsec) = explode(":",$atime);
    $nmonth = $month_name[intval($tmonth)];
    $ampm="am";
    if($thour>11) { $ampm="pm"; $thour=$thour-12; }
    if($thour<10) $thour="0".intval($thour);
    return "$nmonth $tday, $tyear @ $thour:$tminute $ampm\n";
}

function thumb($im)
{
    $thumb=ImageCreate(64,48);
    // copy original image to thumbnail
    ImageCopyResized($thumb,$im,0,0,0,0,64,48,ImageSX($im),ImageSY($im));
    // show thumbnail on screen
    $out = ImagejpeG($thumb);
    print($out);
}

function smiles($text)
{
    $query = "select * from smilies";
    $smiley_result = dm_query($query);
    $num_smilies=mysql_num_rows($smiley_result);
    if($num_smilies>0)
    {
        for($i=0;$i<$num_smilies;$i++)
        {
            $der = mysql_fetch_array($smiley_result);
            $from=$der['sfrom'];
            $to=$der['sto'];
            $text=str_replace($from,$to,$text);
        }
    }
    // built in stuff
	$data=$GLOBALS['data'];
    $text=str_replace("[usr]" ,"Users Online :".usersonline($data->name),$text);
    $text=str_replace("[usrs]","Users Logged In :".usersloggedin(),$text);
    $text=str_replace("[users_logged_details]",users_logged_details($data->name),$text);
    $text=str_replace("-{","[",$text);
    $text=str_replace("}-","]",$text);
    return nl2br($text);
}

function gotopage($outpage)
{
	$locate=$GLOBALS['locate'];
    //$outpage=str_replace("/2008","",$outpage); // quick hack to remove crap

	$loc="$locate/$outpage";
    $loc=str_replace("://",":///",$loc);
    $loc=str_replace("//","/",$loc);
    $loc=str_replace("amp;","&",$loc);

	echo "[$loc]";

    echo "<META HTTP-EQUIV=\"refresh\" content=\"0;URL=$loc\">";
}

function odb()
{
    $mysql = mysql_connect($GLOBALS['authdbaddress'], $GLOBALS['authdbuser'], $GLOBALS['authdbpass']);
    mysql_select_db($GLOBALS['authdbname'], $mysql);
    return $mysql;
}

function mailgo($email,$message,$subject)
{
	$email=str_replace("'at'","@",$email);
    $locate  = $GLOBALS['locate'];
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $begin =  "<html><head><title>DefectiveMinds.com join</title>\n";

$begin.="
<style type\"text/css\">
body, td, p {font-family: verdana,geneva,sans-serif; font-size: 10px; color: #555555}
select {font-family:verdana,geneva; font-size:10px;}
input {font-family:verdana,geneva; font-size:10px}
h1 {font-family:verdana,geneva; font-size:12px}
a:link , a:active, a:visited {font-family: verdana,geneva,sans-serif; font-size: 10px;COLOR:#224466;text-decoration:underline;}
a:hover{font-family: verdana,geneva,sans-serif; font-size: 10px; COLOR:#ff6600;text-decoration:underline;}
</style>";

	$begin .= "</head></head>\n";
    $begin .= "<body>\n";
    $message  = $begin.$message;
    $message .= "\n\n<br><br><br><p>Automated message from <a href=http://www.defectiveminds.com>Defective Minds</a> ~ Do not reply! You can change your email settings through your profile on the site.</p>\n";
    $message .= "</body></html>\n";
    return mail( $email, $subject , $message, "From: imacomputa@defectiveminds.com\r\n$headers");
}

function generate_password()
{
    $i=0; $password=""; srand((double) microtime() * 1000000);
    while($i<8) { $password .= chr(rand(33,122)+1); $i=$i+1; }
    $password=str_replace("'","1",$password);
    $password=str_replace("`","2",$password);
    $password=str_replace("\\","3",$password);
    $password=str_replace("\"","4",$password);
    $password=str_replace("&","5",$password);
    $password=str_replace("<","6",$password);
    $password=str_replace(">","7",$password);
    return $password;
}

function joinform($locate,$userid,$password,$email)
{
    // table_top("7");
    // table_middle_start("7");
    echo "<h1>Apply below!</h1>";
    echo "<p>We will not share any of your information with anyone.</p>\n";
    echo "<p>The site may automatically send you messages about the game.</p>\n";
    echo "<p>This feature can be turned on or off in your profile.</p>";
    echo "<table border=0 cellspacing=0 cellpadding=0><form method=post action=\"$locate/join.php\">\n";
    echo "<tr><td> User ID         &nbsp;</td><td>&nbsp;<input type=textbox  name=userid value=\"$userid\">     </td></tr>\n";
    echo "<tr><td> Email           &nbsp;</td><td>&nbsp;<input type=textbox  name=email value=\"$email\">      </td></tr>\n";
	echo "<tr><td>         &nbsp;</td><td>&nbsp;</td></tr>\n";
    echo "<tr><td>            &nbsp;</td><td>&nbsp;&nbsp;<input type=\"submit\" name=\"Register\" value=\"Register\"></td></tr>\n";
    echo "</form></table>";
    //table_middle_end("7");
    //table_bottom("7");
}

function dm_sizefile($bytesize)
{
    $size = $bytesize." bytes";
    if($bytesize>1024)       $size = (round($bytesize/1024,2))." Kb";
    if($bytesize>1048576)    $size = (round($bytesize/1048576,2))." Mb";
    if($bytesize>1073741824) $size = (round($bytesize/1073741824,2))." Gb";
    return $size;
}

function dm_getfiletype($filen)
{
    $ext = explode(".",$filen,40);
    $j = count ($ext)-1;
    $f_ext = "$ext[$j]";
    return strtolower($f_ext);
}

function dm_setuservar($name,$var,$set)
{
    dm_query("UPDATE users SET `$var`='$set' where name = '$name'");
}

function dm_setvar($table,$var,$set,$name,$sname)
{
    dm_query("UPDATE `$table` SET `$var`='$set' where `$name` = '$sname'");
}

function dm_getnewstopstory()
{
    $result=dm_query("select * from news where topstory='yes' and published='yes'");
    $news=mysql_fetch_object($result);
    return $news;
}

function dm_getnewsdata($news)
{
    $query="select * from news where id = '$news'";
    $result=dm_query($query);
    if(mysql_num_rows($result) >0 ) $news = mysql_fetch_object($result);
    return $news;
}

function dm_getnewslist($newssearch)
{
    $newsbeg=$GLOBALS['top'];
    $newsend=$GLOBALS['bot'];
    $query = "select * from news where topstory!='yes' and published='yes' ";
    if(!empty($newssearch)) { $query.=" ".$newssearch; unset($newssearch); }
    if(empty($newsbeg)) $newsbeg=0; if(empty($newsend)) $newsend=10;
    $query .= " order by time desc limit $newsbeg,$newsend";
    $result = dm_query($query);
    $numnews=mysql_num_rows($result);
    $i=0;
    while($i<$numnews)
    {
        $der = mysql_fetch_array($result);
        $newslist[$i] = $der['id'];
        $i=$i+1;
    }
    return $newslist;
}

function dm_kill($what)
{
	echo "<html><head><title>Defective Minds</title></head>\n";
    echo "<body>I'm sorry the webpage you were looking for is no longer available... Please try again later.</body></html>\n";
	dm_log("<font class=dm_admin>[kill start]==========================</font>");
	dm_log("<font class=dm_admin>".$what."</font>");
	dm_log("<font class=dm_admin>============================[kill end]</font>");
    echo "<br>Actions Logged...<br>";
	die("</body></html>");
}

function dm_getdomain($link)
{
	$a=explode("/",$link,4);
	$link="http://".$a[2]."/";
	return $link;
}

function dm_ban_domain($domain)
{
    dm_query("insert into `banned` (`domain`) VALUES ('$domain')");
    //$res=dm_query("select * from `link_bin` where `link`='$domain'");
    //if(mysql_num_rows($res))
    dm_query("update `link_bin` set `banned`='yes' where `link`='$domain'");
}

function dm_ban_ref($refer)
{
    $res=mysql_num_rows(dm_query("select * from banned where `link`='$refer'"));
    if($res==0) dm_query("insert into `banned` (`link`) VALUES ('$refer')");
}

function dm_ban_ip($ip)
{
    $res=mysql_num_rows(dm_query("select * from banned where `ip`='$ip'"));
    if($res==0) dm_query("insert into `banned` (`ip`) VALUES ('$ip')");
}

function dm_unban_domain($domain)
{
    $res=mysql_num_rows(dm_query("select * from banned where `domain`='$domain'"));
    if($res==0) dm_query("delete from `banned` where `domain`='$domain'");
}

function dm_unban_ref($refer)
{
    dm_query("delete from `banned` where `link`='$refer'");
}

function dm_unban_ip($ip)
{
    dm_query("delete from `banned` where `ip`='$ip'");
}

function dm_banned_domain($domain)
{
    $res=dm_query("select * from `banned` where `domain`='$domain'");
    if(mysql_num_rows($res)) return true;
    return false;
}

function dm_banned_ref($refer)
{
    $res=dm_query("select * from `banned` where `link`='$refer'");
    if(mysql_num_rows($res)) return true;
    return false;
}

function dm_banned_ip($ip)
{
    $res=dm_query("select * from `banned` where `ip`='$ip'");
    if(mysql_num_rows($res)) return true;
    return false;
}

function dm_count()
{
    $local=$GLOBALS['local_path'];
    $fp = fopen("$local/counter.txt","r");
    if($fp)
    {
        $ct=fgets($fp,255); fclose($fp);
        $cnt=explode("|",$ct,40);
        $countit=$cnt[0];
        $countip=$cnt[1];
        $counttoday=$cnt[2];
        $countdate=$cnt[3];
        $countraw=$cnt[4];
        if(date("d")!=$countdate)
        {
        	$counttoday=1;
            $countdate=date("d");
            dm_writecount($countit,$countip,$counttoday,$countdate,$countraw);
        }
    }

	$countraw++;

        $refer=getenv("HTTP_REFERER");
        $countip=getenv("REMOTE_ADDR");

        $refer_ban=str_replace("&","%26",$refer);
        $refer_ban=str_replace("?","%3F",$refer_ban);

        $countip_ban=$countip;
        $domain_ban=dm_getdomain($refer_ban);
      	$a=explode("/",$domain_ban);
        $domain_who=$a[2];

        $refer_link=str_replace("%20"," ",$refer);
        $refer_link=str_replace("%2F","/",$refer_link);
        $refer_link=str_replace("%2f","/",$refer_link);
        $refer_link=str_replace("%3D","=",$refer_link);
        $refer_link=str_replace("%3d","=",$refer_link);
        $refer_link=str_replace("?","<br>",$refer_link);
        $refer_link=str_replace("%3F","<br>",$refer_link);
        $refer_link=str_replace("%3f","<br>",$refer_link);
        $refer_link=str_replace("%3A",":",$refer_link);
        $refer_link=str_replace("%3a",":",$refer_link);
        $refer_link=str_replace("%2B","+",$refer_link);
        $refer_link=str_replace("%2b","+",$refer_link);
        $refer_link=str_replace("%26","<br>",$refer_link);
        $refer_link=str_replace("&","<br>",$refer_link);

        $searched=explode("<br>",$refer_link);
        $nsear=count($searched);
        for($i=0;$i<$nsear;$i++)
        {
            if( (substr($searched[$i],0,2)=="p=") ||
                (substr($searched[$i],0,2)=="q=") )
            {
                dm_log("SEARCH: ".$searched[$i]);
                $time=date("Y-m-d H:i:s");
                dm_query("insert into `searches` (`search`,            `engine`,      `fullsearch`,`time`)
                                          VALUES ('".$searched[$i]."', '$domain_who', '$refer',  '$time')");
            }
        }

        $banip="<a href=\"$locate/adm.php?action=banip&ip=$countip_ban\">Ban this IP</a>";
        $banref="<a href=\"$locate/adm.php?action=banref&ref=$refer_ban\">Ban this Referral</a>";
        $testweb="<a href=\"http://$countip_ban/\" target=_blank>Test Web Server</a>";
        $bandomain="<a href=\"$locate/adm.php?action=bandomain&domain=$domain_ban\">Ban this Domain</a>";
        $whoisip="<a href=\"$locate/adm.php?action=nqt&queryType=arin&target=$countip\">WhoIS IP</a>";
        $whoisdm="<a href=\"$locate/adm.php?action=nqt&queryType=wwwhois&target=$domain_who\">WhoIS Domain</a>";

        $banned=0;

        if(empty($refer_ban)) $refer_ban="duh";
        if(empty($domain_ban)) $domain_ban="duh";

        if(dm_banned_ref($refer_ban)==true)     $banned=1;
        if(dm_banned_ip($countip_ban)==true)    $banned=1;
        if(dm_banned_domain($domain_ban)==true) $banned=1;

        $what="<br>\n";
        $what.="vIPADD|".$countip."| [$banip][$whoisip][$testweb]<br>";
        $what.="vAGENT|".getenv('HTTP_USER_AGENT')."|<br>\n";
        if(stristr($refer,"<a href")!=FALSE)
            $what.="vREFER|".$refer."|<br>\n ";
        else
            $what.="vREFER|<a href=\"".$refer."\" target=_blank>".$refer_link."</a>|<br>[$banref][$bandomain][$whoisdm]<br>\n ";

        if($banned==1)
        {
            $unbanip="<a href=\"$locate/adm.php?action=unbanip&ip=$countip_ban\">UnBan this IP</a>";
            $unbanref="<a href=\"$locate/adm.php?action=unbanref&ref=$refer_ban\">UnBan this Referral</a>";
            $unbandomain="<a href=\"$locate/adm.php?action=unbandomain&domain=$domain_ban\">UnBan this Domain</a>";

            $what="BANNED:<br>\n";
            $what.="vIPADD|".$countip."| [$unbanip][$whoisip][$testweb]<br>";
            $what.="vAGENT|".getenv('HTTP_USER_AGENT')."|<br>\n";
            if(stristr($refer,"<a href")!=FALSE)
                $what.="vREFER|".$refer."|<br>\n ";
            else
                $what.="vREFER|<a href=\"".$refer."\" target=_blank>".$refer_link."</a>|<br>[$unbanref][$unbandomain][$whoisdm]<br>\n ";
            dm_kill($what);
        }


        $countit++;
        $counttoday++;

        if(stristr($refer,"google")) { $google=1; $banned=0; }
        if(stristr($refer,"aol"))    { $aol=1;  $banned=0; }
        //if(stristr($refer,"64.233.167.104")) { $google=1; $banned=0; }
        //if(stristr($refer,"64.233.161.104")) { $google=1; $banned=0; }
        if(stristr(getenv('HTTP_USER_AGENT'),"google")) { $google=1; $banned=0; }
        if(stristr($refer,"yahoo"))  { $yahoo=1; $banned=0; }
        if(stristr($refer,"referrerslist")) { $referrerslist=1; $banned=0; }

        // do not count search engine stuff, but log that it was searching the site
        // msnbot
        //if(stristr(getenv('HTTP_USER_AGENT'),"msnbot")!=FALSE) $what=" --------> MSN Bot!";
        // Googlebot
        //if(stristr(getenv('HTTP_USER_AGENT'),"googlebot")!=FALSE) $what=" --------> Google Bot!";
        // Mediapartners-Google
        //if(stristr(getenv('HTTP_USER_AGENT'),"mediapartners-google")!=FALSE) $what=" --------> Ad Google Bot!";
        // Yahoo
        //if(stristr(getenv('HTTP_USER_AGENT'),"yahoo")!=FALSE) $what=" --------> Yahoo Slurp Bot!";
        // Slurp
        //if(stristr(getenv('HTTP_USER_AGENT'),"slurp")!=FALSE) $what=" --------> Yahoo Slurp Bot!";
        // CydralSpider
        //if(stristr(getenv('HTTP_USER_AGENT'),"CydralSpider")!=FALSE) $what=" --------> CydralSpider Bot!";

        // kill some things
        //if(stristr($refer,"BCReporter")!=FALSE)        { $refok=false; dm_kill($what); }
        //if(stristr($refer,".gov")) {$refok=false; dm_kill($what); }
        //if(stristr(getenv('REMOTE_HOST'),".gov")) {$refok=false; dm_kill($what); }
        //if(stristr(getenv('REMOTE_HOST'),".mil")) { $GLOBALS['noslow']="yes"; }

        $url2=explode("/",$refer);

        if($url2['0']=="http:")
        {
            $url=$url2['0']."//".$url2['2']."/";

            if($url!="http://www.defectiveminds.com/")
            {
                dm_log($what);

                if($google)        $url="http://www.google.com/";
            	if($yahoo)         $url="http://www.yahoo.com/";
            	if($referrerslist) $url="http://www.referrerslist.com/";
            	if($aol)           $url="http://www.aol.com/";

                $result=dm_query("select * from `link_bin` where `link` = '$url'");
                if(mysql_num_rows($result))
                {
                    $link=mysql_fetch_object($result);
                    $link->referrals=$link->referrals+1;
                    dm_query("update `link_bin` set `referrals` = '$link->referrals' where `id` = '$link->id'");
                    $time=date("Y-m-d H:i:s");
                    dm_query("update `link_bin` set `bumptime` = '$time' where `id` = '$link->id'");
                }
                else
                {
                    $time=date("Y-m-d H:i:s");
                    dm_query("insert into `link_bin` (`link`, `sname`, `time`, `bumptime`, `referrals`, `clicks`, `referral`, `hidden`, `category`,`reviewed`)
                                               values('$url','".$url2['2']."','$time','$time','1','0','yes','1','!!!TEMP!!!','no')");
                }
            }
        }

    if($url!="http://www.defectiveminds.com/")
        if(getenv("REMOTE_ADDR")!=$countip)
            dm_writecount($countit,$countip,$counttoday,$countdate,$countraw);
    return $countit;
}

function dm_writecount($countit,$countip,$counttoday,$countdate,$countraw)
{
    $local=$GLOBALS['local_path'];
    $fp = fopen("$local/counter.txt","w");
    if($fp)
    {
    	$countdate=date("d");
        fputs($fp,"$countit|$countip|$counttoday|$countdate|$countraw");
        fclose($fp);
    }
}

function dm_gettodaycount()
{
    $local=$GLOBALS['local_path'];
    $fp = fopen("$local/counter.txt","r");
    if($fp)
    {
        $ct=fgets($fp,255); fclose($fp);
        $cnt=explode("|",$ct,40);
    }
    return $cnt[2];
}

function dm_getrawhits()
{
    $local=$GLOBALS['local_path'];
    $fp = fopen("$local/counter.txt","r");
    if($fp)
    {
        $ct=fgets($fp,255); fclose($fp);
        $cnt=explode("|",$ct,40);
    }
    return $cnt[4];
}

function dm_log($logtext) {
    global $log_path;
    $fp2=fopen("$log_path/log.htm","a");
    if(empty($fp2)) {
        $fp2=fopen("$log_path/log.htm","w");
    }
    if($fp2) {
        $logtext="<p>".date("Y-m-d H:i:s").": ".$logtext."</p>\n";
        fputs($fp2,$logtext);
        fclose($fp2);
    }
}

function dm_is_valid_email($field)
{
    $pattern ="/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/";
    if(preg_match($pattern, $field)) return false;
    return true;
}

function dm_is_valid_name($field)
{
    $pattern ="/^([a-zA-Z0-9])+/";
    if(preg_match($pattern, $field)) return false;
    return false;
}

function dm_query($query)
{
    $mysql=odb(); $result=mysql_query($query,$mysql) or die(mysql_error());
    return $result;
}

function dm_trunc($str,$max_len)
{
    if(strlen($str) > $max_len )
    {
        $str = substr(trim($str),0,$max_len);
        $str = $str.'...';
    }
    return $str;
}
/*
function dm_skyscraperad()
{
    $locate=$GLOBALS['locate'];
    $result=dm_query("select * from ads_skyscrapers where `paid` = '1'");
    $numads=mysql_num_rows($result);
    $ad=rand(0,$numads);
    for($i=0;$i<$ad;$i++) $ads=mysql_fetch_object($result);
    if(empty($ads->html))
        $ads->html="<a href=\"$locate/ads.php?action=showskyform\">Your ad here</a>\n";
    echo "$ads->html";
}

function dm_getemailcode($email)
{
	$email=str_replace("'at'","@",$email);
	list($usr,$domain)=explode("@",$email);
	$code="javascript:win('mailto.php?user=$usr&domain=$domain')";
	return $code;
}
*/
function usersonline($name)
{
    $REMOTE_ADDR=getenv("REMOTE_ADDR"); $PHP_SELF=$_SERVER['PHP_SELF'];
    $refer=getenv("HTTP_REFERER");
    $timeoutseconds = 300;
    $timestamp = time();
    $timeout = $timestamp-$timeoutseconds;
    if(empty($name))
    {

        $insert = dm_query("INSERT INTO useronline VALUES ('$refer','$timestamp','$REMOTE_ADDR', '$PHP_SELF', TRUE, '$name')");
    }
    else
    {
		$res=dm_query("select * from useronline where name='$name'");
		if(mysql_num_rows($res))
        {
			$insert = dm_query("update useronline set timestamp='$timestamp' where name='$name'");
			$insert = dm_query("update useronline set page='$PHP_SELF' where name='$name'");
        }
		else
        $insert = dm_query("INSERT INTO useronline VALUES ('$refer','$timestamp','$REMOTE_ADDR',  '$PHP_SELF', TRUE, '$name')");
    }
    if(!($insert)) { print "Useronline Insert Failed > "; }
    $delete = dm_query("DELETE FROM useronline WHERE timestamp<$timeout");
    $result = dm_query("SELECT DISTINCT ip FROM useronline");
    $user = mysql_num_rows($result);
    return $user;
}

function usersloggedin()
{
    $result = dm_query("SELECT DISTINCT name FROM useronline WHERE loggedin='1'");
    $user = mysql_num_rows($result);
    return $user;
}

function users_logged_details()
{
    $result = dm_query("SELECT DISTINCT name,page FROM useronline WHERE loggedin='1'");
    $nusers = mysql_num_rows($result);
    $user="";
    for($i=0;$i<$nusers;$i++)
    {
		$usrdata=mysql_fetch_object($result);
		/*
        $loc=explode("/",$usrdata->locale);
        $lc=count($loc);
        $loc=$loc[$lc-1];
        $loc=explode("?",$loc);
        $loc=$loc[0];
        */
        $usrdata->page=str_replace("/","",$usrdata->page);
		$user.="$usrdata->name ($usrdata->page)";
		if(($nusers>1) && ($i<( $nusers-1)))
       		$user.=",";
    }
    return $user;
}

