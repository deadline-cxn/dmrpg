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

$data=getuserdata($_SESSION['valid_user']);

dm_log("TESTING[$PHP_SELF]:::::::::::::::::--- $data->id $data->name $action");

if($action=="getclasspic")
{
	$result=dm_query("select * from rpg_classes where `name`='$class'");
	$class=mysql_fetch_object($result);
    $returnVars = array();
    $returnVars['wtf']="wtf";
    $returnVars['action']= "changepic";
    $returnVars['pic']= $class->image;
    $returnVars['infos']=$class->info;

    $returnString = http_build_query($returnVars);
    dm_log($returnString);
    echo $returnString;

}

if($action=="begin")
{
	$result=dm_query("select * from rpg_classes");
	$numclasses=mysql_num_rows($result);
    $returnVars = array();
    $returnVars['inname']= $data->name;
    $returnVars['numclasses'] = $numclasses;
    $returnVars['action']= "begin_result";

    for($i=0;$i<$numclasses;$i++)
    {
        $class=mysql_fetch_object($result);
        $cn="class".($i+1);
        $ci="class".($i+1)."img";
        $returnVars[$cn]=$class->name;
        $returnVars[$ci]=$class->image;
    }

    $returnString = http_build_query($returnVars);
    dm_log($returnString);
    echo $returnString;
    exit;
}

if($action=="create")
{
    $cls=dm_query("select * from rpg_classes where `name`='$class'");
    $clr=mysql_fetch_object($cls);
    $class=$clr->id;
    dm_log("TESTING[$PHP_SELF]::CREATE::::::::::--- $data->id $data->name ($rpg_name) $action class:$class");
    rpg_deletechar();
    rpg_createchar($rpg_name,$class);
    rpg_setvar("rpg","yes");
    rpg_setvar("gender",$gender);
    $data=getuserdata($_SESSION['valid_user']);
    $action="completed";
    $returnVars = array();
    $returnVars['inname']= $data->name;
    $returnVars['rpg_name'] = $data->rpg_name;
    $returnVars['action']= $action;
    $returnString = http_build_query($returnVars);
    dm_log($returnString);
    echo $returnString;
    exit;
}




?>