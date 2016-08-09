<?php

include("dm_config.php");

$showform    = $_REQUEST['showform'];
$give_file   = $_REQUEST['give_file'];
$newpath     = $local_path."/".$_REQUEST['local'];
$httppath    = $locate."/".$_REQUEST['local'];
$category    = $_REQUEST['category'];
$newname     = $_REQUEST['newname'];
$short_name  = $_REQUEST['short_name'];
$desc        = $_REQUEST['desc'];
$hidden      = $_REQUEST['hidden'];
$action      = $_REQUEST['action'];
$id          = $_REQUEST['id'];
$sfw         = $_REQUEST['sfw'];
$description = $_REQUEST['description'];
$location    = $_REQUEST['location'];
$annihilate  = $_REQUEST['annihilate'];
$file_mod    = $_REQUEST['file_mod'];
$file_url    = $_REQUEST['file_url'];
$file_add    = $_REQUEST['file_add'];
$criteria    = $_REQUEST['criteria'];
$top         = $_REQUEST['top'];
$amount      = $_REQUEST['amount'];
$size      = $_REQUEST['size'];
$homepage = $_REQUEST['homepage'];
$platform = $_REQUEST['platform'];
$os = $_REQUEST['os'];
$version = $_REQUEST['version'];
$owner = $_REQUEST['owner'];


$title="Files";
if($action=="upload")
$title="Files > Upload";

include("header.php");
$data=getuserdata($_SESSION['valid_user']);

function dm_fileheader()
{
    $file_header=$GLOBALS['file_header'];
    echo "<table border=0 cellspacing=0 cellpadding=0 width=100%>\n";
    echo "<tr bgcolor=#$file_header height=16>\n";
    echo "<td style=\"color: black\" align=center>&nbsp;</td>\n";
    echo "<td width=5% style=\"color: black\">Type</td>\n";
    echo "<td width=15% style=\"color: black\">File</td>\n";
    echo "<td width=5% style=\"color: black\">Version</td>\n";
    echo "<td width=5% style=\"color: black\">Web</td>\n";
    echo "<td width=10% style=\"color: black\">Size</td>\n";
    echo "<td width=5% style=\"color: black\">DL's</td>\n";
    echo "<td width=40% style=\"color: black\">Description</td>\n";
    echo "<td width=15% style=\"color: black\">Submitter</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
}

if($action=="addfilelinktodb")
{
    table_top("Add a file link to the public file database");
    table_middle_start("000000");
    echo "<table border=0>\n";
    echo "<form action=$locate/files.php method=post>\n";
    echo "<input type=hidden name=action value=addfilelinktodb_go>\n";
    echo "<input type=hidden name=file_add value=\"$file_add\">\n";
    echo "<tr><td>Short name </td><td><input name=short_name value=\"$filedata->short_name\"></td></tr>\n";
    echo "<tr><td>File Link  </td><td><input name=file_url value=\"\" size=110></td></tr>\n";

    echo "<tr><td>Version</td><td><input name=version value=\"\"></td></tr>\n";

    echo "<tr><td>Size in bytes</td><td><input name=size></td></tr>\n";

    echo "<tr><td align=right>Safe for work:    </td><td><select name=sfw><option>yes<option>no</select></td></tr>\n";
    echo "<tr><td align=right>category:         </td><td><select name=category>\n";
    $result=dm_query("select * from files_categories order by category asc"); $numcats=mysql_num_rows($result); for($i=0;$i<$numcats;$i++) { $cat=mysql_fetch_object($result);  echo "<option>$cat->category"; }
    echo "</select></td></tr>\n";
    echo "<tr><td>Description</td><td><textarea name=description rows=7 cols=60>$filedata->description</textarea></td></tr>\n";

    echo "<tr><td>Homepage</td><td><input name=homepage></td></tr>\n";
    echo "<tr><td>Platform</td><td><input name=platform value=i686></td></tr>\n";
    echo "<tr><td>Operating System</td><td><input name=os value=Windows></td></tr>\n";
    echo "<tr><td>Company</td><td><input name=owner></td></tr>\n";

    echo "<tr><td>&nbsp;</td><td><input type=submit name=shubmit value=Add!></td><td>&nbsp;</td></tr>\n";
    echo "</form></table>\n";
    table_middle_end();
    table_bottom("&nbsp;");
    include("footer.php");
    exit();
}
if($action=="addfilelinktodb_go")
{

    $file_url=addslashes($file_url);
    $file_add=addslashes($file_add);
    $description=addslashes($description);
    $short_name=addslashes($short_name);
    $filetype=dm_getfiletype($file_add);

    echo "<p>New file link added: $short_name</p>";

        $time1=date("Y-m-d H:i:s");
        dm_query("INSERT INTO `files` (`short_name`) VALUES ('$short_name');");
        dm_query("UPDATE files SET location='$file_url' where short_name='$short_name'");
        dm_query("UPDATE files SET submitter='$data->name' where short_name='$short_name'");
        dm_query("UPDATE files SET category='$category' where short_name='$short_name'");
        dm_query("UPDATE files SET description='$description' where short_name='$short_name'");
        dm_query("UPDATE files SET category='$category' where short_name='$short_name'");
        dm_query("UPDATE files SET filetype='$filetype' where short_name='$short_name'");
        dm_query("UPDATE files SET size='$size' where short_name='$short_name'");
        dm_query("UPDATE files SET local_path='$file_add' where short_name='$short_name'");
        dm_query("UPDATE files SET time='$time1' where short_name='$short_name'");
        dm_query("UPDATE files SET worksafe='$sfw' where short_name='$short_name'");
        dm_query("UPDATE files SET homepage='$homepage' where short_name='$short_name'");
        dm_query("UPDATE files SET platform='$platform' where short_name='$short_name'");
        dm_query("UPDATE files SET os='$os' where short_name='$short_name'");
        dm_query("UPDATE files SET owner='$owner' where short_name='$short_name'");
        dm_query("UPDATE files SET version='$version' where short_name='$short_name'");
       

}
if($action=="addfiletodb")
{
    table_top("Add a hidden file to the public file database");
    table_middle_start("000000");
    echo "<p>You are adding:</p><p>$file_url</p><p>$file_add</p>\n";
    echo "<table border=0>\n";
    echo "<form action=$locate/files.php method=post>\n";
    echo "<input type=hidden name=action value=addfiletodb_go>\n";
    echo "<input type=hidden name=file_url value=\"$file_url\">\n";
    echo "<input type=hidden name=file_add value=\"$file_add\">\n";
    echo "<tr><td>Short name </td><td><input name=short_name value=\"$filedata->short_name\"></td></tr>\n";
    echo "<tr><td align=right>Safe for work:    </td><td><select name=sfw><option>yes<option>no</select></td></tr>\n";
    echo "<tr><td align=right>category:         </td><td><select name=category>\n";
    $result=dm_query("select * from files_categories order by category asc");
    $numcats=mysql_num_rows($result);
    for($i=0;$i<$numcats;$i++)
    {
        $cat=mysql_fetch_object($result);
        echo "<option>$cat->category";
    }
    echo "</select></td></tr>\n";
    echo "<tr><td>Description</td><td><textarea name=description rows=7 cols=60>$filedata->description</textarea></td></tr>\n";
    echo "<tr><td>&nbsp;</td><td><input type=submit name=shubmit value=Add!></td><td>&nbsp;</td></tr>\n";
    echo "</form></table>\n";
    table_middle_end();
    table_bottom("&nbsp;");
    include("footer.php");
    exit();
}

if($action=="addfiletodb_go")
{
    $file_url=addslashes($file_url);
    $file_add=addslashes($file_add);
    $description=addslashes($description);
    $short_name=addslashes($short_name);
    $filetype=dm_getfiletype($file_add);
    $fsize = filesize($file_add);
    $fsize = intval($fsize);
    if($fsize!="0")
    {
        $time1=date("Y-m-d H:i:s");
        dm_query("INSERT INTO `files` (`short_name`) VALUES('$short_name');");
        dm_query("UPDATE files SET location='$file_url' where short_name='$short_name'");
        dm_query("UPDATE files SET submitter='$data->name' where short_name='$short_name'");
        dm_query("UPDATE files SET category='$category' where short_name='$short_name'");
        dm_query("UPDATE files SET description='$description' where short_name='$short_name'");
        dm_query("UPDATE files SET category='$category' where short_name='$short_name'");
        dm_query("UPDATE files SET filetype='$filetype' where short_name='$short_name'");
        dm_query("UPDATE files SET size='$fsize' where short_name='$short_name'");
        dm_query("UPDATE files SET local_path='$file_add' where short_name='$short_name'");
        dm_query("UPDATE files SET time='$time1' where short_name='$short_name'");
        dm_query("UPDATE files SET worksafe='$sfw' where short_name='$short_name'");
    }
}

if($action=="get_file")
{
    table_top("Get a file");
    table_middle_start("000000");
    if($_SESSION["logged_in"]=="true")
    {
        $filedata=dm_getfiledata($_REQUEST['id']);
        if(empty($filedata))
        {
            echo "Error 3392! File does not exist?\n";
            table_middle_end();
            table_bottom("&nbsp;");
            include("footer.php");
            exit();
        }

        $size = dm_sizefile($filedata->size);
        if($filedata->worksafe=="no")

        echo smiles("<p><center>%X CAUTION THIS FILE IS NOT SAFE FOR WORK!</center></p>\n");
        echo "<p><center><a href=\"$locate/files.php?action=get_file_go&id=$filedata->id\"><font size=4>$filedata->short_name ($size)</a> </font></center></p>\n";
        echo "<p><center> (Right click and 'save target as' to save the file to your computer...)</center></p>\n";
        echo "<p><center>Category: $filedata->category</center></p>\n";
        echo "<p><table border=0><tr><td>Description</td></tr><tr><td><table border=0 bordercolor=#000000 cellspacing=0 cellpadding=4 width=100%>\n";
        echo "<tr><td>$filedata->description</td></tr></table></td></tr></table></p>\n";
        echo "<p align=right>Posted by <a href=\"$locate/showprofile.php?user=$filedata->submitter\">$filedata->submitter</a>, \n";
        echo "Downloaded $filedata->downloads times</p>\n";
        adddownloads($data->name,1);
    }
    else echo "<p> You can't download files unless you are <a href=login.php>Logged in</a>!</p>\n";
    table_middle_end();
    table_bottom("&nbsp;");
    include("footer.php");
    exit();
}

if($action=="get_file_go")
{
        $filedata=dm_getfiledata($_REQUEST['id']);
        if(empty($filedata))
        {
            echo "Error 3392! File does not exist?\n";
            table_middle_end();
            table_bottom("&nbsp;");
            include("footer.php");
            exit();
        }
         $dl=$filedata->downloads+1;
        dm_query("UPDATE files SET downloads='$dl' where id = '$id'");
       echo "<META HTTP-EQUIV=\"refresh\" content=\"0;URL=$filedata->location\">\n";
}

if($file_mod=="yes")
{
    table_top("File Modification");
    table_middle_start("000000");
    if(!empty($data->name))
    {
        if($action=="ren")
        {
            if(!empty($short_name)) dm_query("UPDATE files SET short_name='$short_name' where id = '$id'");
        }
        if($action=="del")
        {
            $filedata=dm_getfiledata($id);
            echo "<table border=0>\n";
            echo "<form action=$locate/files.php method=post>\n";
            echo "<input type=hidden name=file_mod value=yes>\n";
            echo "<input type=hidden name=action value=del_conf>\n";
            echo "<input type=hidden name=id value=\"$id\">\n";
            echo "<tr><td>Are you sure you want to delete [$filedata->short_name]???</td><td><input type=submit name=submit value=\"Fuck Yeah!\"></td></tr>\n";
            echo "<tr><td>Annihilate the file from the server?</td><td><input name=\"annihilate\" type=\"checkbox\" value=\"yes\"></td></tr>\n";
            echo "<tr><td>Important! If you do not want to delete this file, <a href=$locate/index2.php>click here</a>!</td>\n";
            echo "<td>&nbsp;</td><td>&nbsp;</td></tr>\n";
            echo "</form></table>\n";
        }
        if($action=="del_conf")
        {
            $filedata=dm_getfiledata($id);
            dm_query("delete from files where id = '$id'");
            echo "<p>Delete [$filedata->short_name] is deleted from the database...</p>\n";
            if($annihilate=="yes")
            {
                unlink($filedata->local_path);
                echo "<p> $filedata->local_path annihilated!</p>\n";
            }
        }
        if($action=="mod")
        {
            if(!empty($short_name))  dm_query("UPDATE files SET short_name='$short_name' where id = '$id'");
            if(!empty($description)) dm_query("UPDATE files SET description='$description' where id = '$id'");
            if(!empty($location))
            {
                              dm_query("UPDATE files SET location='$location' where id = '$id'");
                              $filetype=dm_getfiletype($location);
                               dm_query("UPDATE files SET filetype='$filetype' where id = '$id'");
            }

            if(!empty($sfw))         dm_query("UPDATE files SET worksafe='$sfw' where id = '$id'");
            if(!empty($category))    dm_query("UPDATE files SET category='$category' where id='$id'");
            if(!empty($size)) dm_query("UPDATE files SET size='$size' where id='$id'");
  

            if(!empty($homepage))  dm_query("UPDATE files SET homepage='$homepage' where id='$id'");
            if(!empty($platform)) dm_query("UPDATE files SET platform='$platform' where id='$id'");
            if(!empty($os))      dm_query("UPDATE files SET os='$os' where id='$id'");
            if(!empty($owner))        dm_query("UPDATE files SET owner='$owner' where id='$id'");

            if(!empty($version)) dm_query("UPDATE files SET version='$version' where id='$id'");

            echo "<p><a href=$locate/files.php>File</a> modified...</p><br>\n";
            echo "<p><a href=$locate/pro.php>Profile</a>...</p><br>\n";
            echo "<META HTTP-EQUIV=\"refresh\" content=\"0;URL=$locate/files.php\">\n";

        }
        if($action=="mdf") // show a form to modify the file attributes...
        {
            $filedata=dm_getfiledata($id);
            echo "<p>.:] Modify [$filedata->short_name] [:.</p>\n";
            echo "<table border=0>\n";
            echo "<form action=$locate/files.php method=post>\n";
            echo "<input type=hidden name=file_mod value=yes>\n";
            echo "<input type=hidden name=action value=mod>\n";
            echo "<input type=hidden name=id value=\"$id\">\n";
            echo "<tr><td align=right>Short name:</td><td><input name=short_name size=100 value=\"$filedata->short_name\"></td></tr>\n";

            echo "<tr><td align=right>Location:  </td><td><input name=location   size=100 value=\"$filedata->location\"></td></tr>\n";

            echo "<tr><td align=right>Version:</td><td><input name=version value=\"$filedata->version\"></td></tr>\n";


            echo "<tr><td>Size in bytes</td><td><input name=size value=\"$filedata->size\"></td></tr>\n";

            if($filedata->worksafe=="") $filedata->worksafe="no";
            if($filedata->worksafe=="yes")  echo "<tr><td align=right>Worksafe: </td><td><select name=\"sfw\"><option>$filedata->worksafe<option>no</select</td></tr>\n";
            else                                                        echo "<tr><td align=right>Worksafe: </td><td><select name=\"sfw\"><option>$filedata->worksafe<option>yes</select</td></tr>\n";
            echo "<tr><td align=right>category:         </td><td><select name=category>\n";
            echo "<option>$filedata->category";
            $result=dm_query("select * from files_categories order by category asc");
            $numcats=mysql_num_rows($result);
            for($i=0;$i<$numcats;$i++)
            {
                $cat=mysql_fetch_object($result);
                echo "<option>$cat->category";
            }
            echo "</select></td></tr>\n";
            echo "<tr><td align=right>Description:</td><td><textarea name=description rows=7 cols=60>".stripslashes($filedata->description)."</textarea></td></tr>\n";

            echo "<tr><td>Homepage</td><td><input name=homepage value=\"$filedata->homepage\"></td></tr>\n";
            echo "<tr><td>Platform</td><td><input name=platform value=\"$filedata->platform\"></td></tr>\n";
            echo "<tr><td>Operating System</td><td><input name=os value=\"$filedata->os\"></td></tr>\n";
            echo "<tr><td>Company</td><td><input name=owner value=\"$filedata->owner\"></td></tr>\n";

            echo "<tr><td>&nbsp;</td><td><input type=submit name=shubmit value=Modify!></td><td>&nbsp;</td></tr>\n";
            echo "</form></table>\n";
        }
        
    }
    else echo "<p>You can't modify files if you are not <a href=$locate/login.php>logged in</a>!</p>\n";
    table_middle_end();
    table_bottom("&nbsp;");
    include("footer.php");
    exit();
}

if($action=="upload_avatar")
{
    table_top("Upload a file");
    table_middle_start("000000");
    if(empty($data->name))
    {
        echo "<p>You must be logged in to upload files...</p>\n";
    }
    else
    {
        echo "<p>Upload your very own avatar picture! Upload an swf, gif, or jpg avatar!</p>\n";
        echo "<table border=0>\n";
        echo "<form enctype=\"multipart/form-data\" action=\"files.php\" method=\"post\">\n";
        echo "<input type=hidden name=give_file value=avatar>\n";
        echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"99900000\">";
        echo "<input type=hidden name=local value=\"files/avatars\">\n";
        echo "<input type=hidden name=hidden value=yes>\n";
        echo "<tr><td align=right>$locate/files/avatars/</td><td><input name=\"userfile\" type=\"file\"> </td></tr>\n";
        echo "<tr><td>&nbsp;</td><td><input type=\"submit\" name=\"submit\" value=\"Upload!\"></td></tr>\n";
        echo "</form>\n";
        echo "</table>\n";
    }
    table_middle_end();
    table_bottom("&nbsp;");
    include("footer.php");
    exit();
}


if($action=="upload")
{
    table_top("Upload a file");
    table_middle_start("000000");
    if(empty($data->name)) {  echo "<p>You must be logged in to upload files...</p>\n"; }
    else
    {
        if($data->upload!="yes") {  echo "<p>You are not authorized to upload files!</p>\n";  }
        else
        {
            echo "<p>Add a file?!?!</p>\n";
            echo "<table border=0>\n";
            echo "<form enctype=\"multipart/form-data\" action=\"files.php\" method=\"post\">\n";
            echo "<input type=hidden name=give_file value=yes>\n";
            echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"93000000\">";
            echo "<tr><td align=right>Put file in:</td><td>\n";
            echo "<select name=local>\n";
            echo "<option>files\n";
            echo "<option>images\n";
            echo "<option>images/avatars\n";
            echo "<option>images/awards\n";
            echo "<option>files/utilities\n";
            echo "<option>files/images\n";
            echo "<option>files/flash\n";
            echo "<option>files/movies\n";
            echo "<option>files/sound\n";
            echo "</select></td></tr>\n";
            echo "<tr><td align=right>Select file:      </td><td ><input name=\"userfile\" type=\"file\" size=80> </td></tr>\n";
            echo "<tr><td align=right>Hide from public: </td><td><select name=hidden><option>yes<option>no</select> (no will place file entry into database viewable by the public)</td></tr>\n";
            echo "<tr><td align=right>Safe for work:    </td><td><select name=sfw><option>yes<option>no</select></td></tr>\n";
            echo "<tr><td align=right>category:         </td><td><select name=category>\n";
            $result=dm_query("select * from files_categories order by category asc");
            $numcats=mysql_num_rows($result);
            for($i=0;$i<$numcats;$i++) { $cat=mysql_fetch_object($result); echo "<option>$cat->category"; }
            echo "</select></td></tr>\n";
            echo "<tr><td align=right>Short name :</td><td><input type=textbox name=short_name></td></tr>\n";
            echo "<tr><td align=right valign=top>Description:</td><td><textarea name=\"desc\" rows=\"7\" cols=\"40\"></textarea></td></tr>\n";
            echo "<tr><td>&nbsp;</td><td><input type=\"submit\" name=\"submit\" value=\"Upload!\"></td></tr>\n";
            echo "</form>\n";
            echo "</table>\n";
        }
    }
    table_middle_end();
    table_bottom("&nbsp;");
}

if($give_file=="yes")
{
    table_top("Uploading...");
    table_middle_start("000000");

    if(empty($data->name)) {  echo "<p> You must be logged in to upload files... <a href=join.php>JOIN</a> now!</p>\n"; }
    else
    {
        if($data->upload!="yes") { echo "<p>You are not authorized to upload files!</p>\n"; }
        else
        {
            echo "<p> Uploading files... </p>\n";
            $uploadFile=$newpath."/".$_FILES['userfile']['name'];
            $uploadFile =str_replace("//","/",$uploadFile);
            if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadFile))
            {
                system("chmod 755 $uploadFile");
                $error="File is valid, and was successfully uploaded. ";
                echo "<P>You sent: ".$_FILES['userfile']['name'].", a ".$_FILES['userfile']['size']." byte file with a mime type of ".$_FILES['userfile']['type']."</p>\n";
                echo "<p>It was stored as [$httppath"."/".$_FILES['userfile']['name']."]</p>\n";
                if($hidden=="no")
                {
                    $xp_ext = explode(".",$_FILES['userfile']['name'],40);
                    $j = count ($xp_ext)-1;
                    $ext = "$xp_ext[$j]";
                    $filetype=strtolower($ext);
                    $filesizebytes=$_FILES['userfile']['size'];
                    $time1=date("Y-m-d H:i:s");
                    $httppath=$httppath."/".$_FILES['userfile']['name'];
                    $description=addslashes($description);
                    $short_name=addslashes($short_name);

                    dm_query("INSERT INTO `files` (`short_name`) VALUES('$short_name');");
                    dm_query("UPDATE files SET location='$httppath' where short_name='$short_name'");
                    dm_query("UPDATE files SET submitter='$data->name' where short_name='$short_name'");
                    dm_query("UPDATE files SET category='$category' where short_name='$short_name'");
                    dm_query("UPDATE files SET description='$desc' where short_name='$short_name'");
                    dm_query("UPDATE files SET category='$category' where short_name='$short_name'");
                    dm_query("UPDATE files SET filetype='$filetype' where short_name='$short_name'");
                    dm_query("UPDATE files SET size='$filesizebytes' where short_name='$short_name'");
                    dm_query("UPDATE files SET local_path='$uploadFile' where short_name='$short_name'");
                    dm_query("UPDATE files SET time='$time1' where short_name='$short_name'");
                    dm_query("UPDATE files SET worksafe='$sfw' where short_name='$short_name'");

                    $extra_sp=$_FILES['userfile']['size']/10240;
                    addsp($data->name,15+$extra_sp);
                    adduploads($data->name,1);
                    echo "<p>You gain $extra_sp extra points based on file size!</p>\n";
                }
                else
                {
                    echo "<p>This file added to your private stash, no shit fairy visit for you...</p>\n";                    
                }
            }
            else
            {
                //UPLOAD_ERR_OK        //Value: 0; There is no error, the file uploaded with success.
                //UPLOAD_ERR_INI_SIZE  //Value: 1; The uploaded file exceeds the upload_max_filesize directive in php.ini.
                //UPLOAD_ERR_FORM_SIZE //Value: 2; The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.
                //UPLOAD_ERR_PARTIAL   //Value: 3; The uploaded file was only partially uploaded.
                //UPLOAD_ERR_NO_FILE
                $error ="File upload error!";
                echo "File upload error! [\n";
                echo $_FILES['userfile']['name'];
                echo "][";
                echo $_FILES['userfile']['error'];
                echo "][";
                echo $_FILES['userfile']['tmp_name'] ;
                echo "][";
                echo $uploadFile;
                echo "]\n";
            }

            if(!$error)
            {
                $error .= "No files have been selected for upload";
            }
            echo "<P>Status: [$error]</P>\n";
            echo "<p>[<a href=$locate/files.php?action=upload>Add another file</a>]\n";
            echo "[<a href=$locate/files.php>Files</a>]</p>\n";
        }
    }
    table_middle_end();
    table_bottom("&nbsp;");
}

if($give_file=="avatar")
{
    table_top("Uploading Avatar...");
    table_middle_start("000000");

    if(empty($data->name)) echo "<p> You must be logged in to upload files... <a href=join.php>JOIN</a> now!</p>\n";
    else
    {
        echo "<p> Uploading files... </p>\n";

        $f_ext=dm_getfiletype($_FILES['userfile']['name']);
        $uploadFile=$local_path."/files/avatars/".$_FILES['userfile']['name'];

        if(($f_ext=="gif")||($f_ext=="jpg")||($f_ext=="swf"))
        {
            $oldname=$_FILES['userfile']['name'];
            if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadFile))
            {
                system("chmod 755 $uploadFile");
                $error="File is valid, and was successfully uploaded. ";
                echo "<P>You sent: ".$_FILES['userfile']['name'].", a ".$_FILES['userfile']['size']." byte file with a mime type of ".$_FILES['userfile']['type']."</p>\n";
                $oldname=$_FILES['userfile']['name'];
                $newname=$data->name.".".$f_ext;
                rename($local_path."/files/avatars/".$oldname,$local_path."/files/avatars/".$newname);
                $httppath=$httppath."/".$newname;
                echo "<p>It was stored as [<a href=\"$httppath\" target=\"_blank\">$httppath</a>]</p>\n";
                dm_setuservar($data->name,"avatar",$httppath);
            }
            else
            {
                $error ="File upload error!";
                echo "File upload error! [\n";
                echo $_FILES['userfile']['name'];
                echo "][";
                echo $_FILES['userfile']['error'];
                echo "][";
                echo $_FILES['userfile']['tmp_name'] ;
                echo "][";
                echo $uploadFile;
                echo "]\n";
            }
            if(!$error) $error .= "No files have been selected for upload";
            echo "<P>Status: [$error]</P>\n";
        }
        else echo "<p>Invalid filetype ($f_ext) for an avatar!</p>";
    }
    table_middle_end();
    table_bottom("&nbsp;");
    include("footer.php");
    exit();
}

if($action=="edit_categories")
{
    showfilecatsform();
    include("footer.php");
    exit();
}

if($action=="add_category")
{
    dm_query("insert into files_categories values ('', '$category', '0')");
    showfilecatsform();
    include("footer.php");
    exit();
}

if($action=="rename_category")
{
    dm_query("update files_categories set category='$newname' where category = '$category'");
    showfilecatsform();
    include("footer.php");
    exit();
}

function showfilecatsform()
{
    $locate=$GLOBALS['locate'];
    table_top("Edit File Categories...");
    table_middle_start("000000");

    $result=dm_query("select * from files_categories order by category asc");
    $numcats=mysql_num_rows($result);
    if($numcats==0) echo "<p>There are no categories!</p>\n";
    echo "<table border=0>";
    for($i=0;$i<$numcats;$i++)
    {
        $cat=mysql_fetch_object($result);
        echo "<tr><td><form action=\"$locate/files.php\" method=\"post\">";
        echo "<input type=hidden name=action    value=delete_category>\n";
        echo "<input type=hidden name=category  value=\"$cat->category\">\n";
        echo "<input type=submit name=submit    value=delete>\n";
        echo "</form></td>\n";
        echo "<td><form action=\"$locate/files.php\" method=\"post\">\n";
        echo "<input type=hidden name=action    value=rename_category>\n";
        echo "<input type=hidden name=category  value=\"$cat->category\">\n";
        echo "<input type=text   name=newname   value=\"$cat->category\">\n";
        echo "</td><td>\n";
        echo "<input type=submit name=submit    value=rename>\n";
        echo "</td></tr>\n";
    }
    echo "<tr><td>&nbsp;</td><td><form action=\"$locate/files.php\" method=\"post\">\n";
    echo "<input type=hidden name=action        value=add_category>\n";
    echo "<input type=text   name=category      value=\"\">\n";
    echo "</td><td>\n";
    echo "<input type=submit name=submit        value=add>\n";
    echo "</td></tr>\n";
    echo "</table>\n";

    table_middle_end();
    table_bottom("&nbsp;");
}

function show1file($filedata,$colr)
{
    $locate=$GLOBALS['locate'];
    echo "<tr><td>\n";
    echo "<table border=0 cellspacing=0 cellpadding=0 width=100%>\n";
    echo "<tr bgcolor=#$colr >\n";
    if($filedata->worksafe!="yes")
        echo "<td align=center><img src=$locate/images/pinkslip.gif border=0 align=center alt=\"Not safe for work... Pink Slip!\" title=\"Not safe for work... Pink Slip!\"></td>\n";
    else
        echo "<td align=center><img src=$locate/images/worksafe.gif border=0 align=center alt=\"Safe for work... Productivity Chart!\" title=\"Safe for work... Productivity Chart!\"></td>\n";
    echo "<td width=5%><center><a href=\"$locate/files.php?action=get_file&id=$filedata->id\" target=_blank>\n";
    $xp_ext = explode(".",$filedata->location,40);
    $j = count ($xp_ext)-1;
    $ext = "$xp_ext[$j]";
    $filetype=strtolower($ext);
    echo "<img src=$locate/images/$filetype.gif border=0 alt=\"$filedata->short_name\"></a></center></td>\n";
    echo "<td width=15%>&nbsp;<a href=\"$locate/files.php?action=get_file&id=$filedata->id\" target=_blank>$filedata->short_name &nbsp;</a></td>\n";
    $size=dm_sizefile($filedata->size);
    echo "<td width=5% style=\"color: black\">&nbsp;$filedata->version</td>\n";
    echo "<td width=5% style=\"color: black\"><a href=\"$filedata->homepage\" target=_blank><img src=\"$locate/images/wp.gif\" border=0 title=\"$filedata->homepage\" alt=\"$filedata->homepage\"></a> &nbsp;</td>\n";
    echo "<td width=10% style=\"color: black\">$size &nbsp;</td>\n";
    echo "<td width=5% style=\"color: black\">$filedata->downloads &nbsp;</td>\n";
    echo "<td width=40% style=\"color: black\">$filedata->description &nbsp;</td>\n";

    echo "<td width=15%><a href=$locate/showprofile.php?user=$filedata->submitter>$filedata->submitter &nbsp;</a>";

    $data=$GLOBALS['data'];
    if( ($filedata->submitter==$data->name) || ($data->access==255))
   {
 echo " [<a href=\"$locate/files.php?action=mdf&file_mod=yes&id=$filedata->id\">edit</a>] &nbsp;";
    }

    echo "</td>\n";
    echo "</tr>\n";
}

$what= "Files...";
table_top($what);
table_middle_start("000000");

echo "<table border=0 width=100%>";
echo "<tr>\n";
echo "<form action=\"$locate/files.php\" method=post>\n";
echo "<input type=hidden name=action value=search>\n";
echo "<td width=65>Search for:</td>\n";
echo "<td width=90><input type=textbox name=criteria></td>\n";
echo "<td width=10>in</td>\n";
echo "<td width=80><select name=category><option>all categories\n";

$result=dm_query("select * from files_categories order by category asc");
$numcats=mysql_num_rows($result);
for($i=0;$i<$numcats;$i++)
{
    $cat=mysql_fetch_object($result);
    echo "<option>$cat->category";
}

echo "</select></td>\n";
echo "<td width=30>display</td>\n";
echo "<td width=15><select name=amount><option>all<option>10<option>25<option>50<option>100</select></td>\n";
echo "<td width=30>results</td>\n";
echo "<td width=50><input type=submit value=\"go!\" name=submit></td>\n";
echo "</form>\n";


if($data->upload=="yes")
{
 echo "<td>[<a href=\"files.php?action=upload\">submit file</a>]</td>\n";
 echo "<td>[<a href=\"files.php?action=addfilelinktodb\">link file</a>]</td>\n";
}
if($data->access==255)  echo "<td>[<a href=$locate/files.php?action=edit_categories>Edit File Categories</a>]</td>\n";
if($data->access==255)  echo "<td>[<a href=$locate/xplorer.php>Xplorer</a>]</td>\n";


echo "</tr></table>\n";

if( ($action=="listcategory") ||
    ($action=="search") )
{
    $category=rtrim($category);

    if($action=="search")
    {   
        $query="where (`short_name` like '%$criteria%' or `description` like '%$criteria%' or `category` like '%$criteria%') ";
        if($category!="all categories")
        $query.="and `category` = '$category' ";
    }

    if($action=="listcategory") $query="where `category` = '$category' ";
    if($top=="")    $top=0;
    if($amount=="") $amount=25;
    if($amount!="all") $limit="limit $top,$amount";
    else               $limit="";

    // echo "[$query][$limit]";
    $filelist=@dm_getfilelist($query,$limit);

    $x=count($filelist);
    if($x==0) echo "<p>Your search for $criteria yielded no results...</p>";
    else      echo "<p>Your search for $criteria yielded $x results:</p>";

    if(count($filelist))
    {
        echo "<table border=0 bordercolor=#000000 cellspacing=0 cellpadding=0 width=100%>\n";
        echo "<tr><td>\n";
        dm_fileheader();
        echo "</td></tr>\n";
    }
    $i=0; $bg=0;
    while($i<count($filelist))
    {
        $filedata=dm_getfiledata($filelist[$i]);
        if(!empty($filedata->short_name))
        {
            $colr=$file_color[1];
            if($bg=="1") $colr=$file_color[2];
            $i=$i+1;
            show1file($filedata,$colr);
            $bg=$bg+1; if($bg>1) $bg=0;
            echo "</table></td></tr>\n";
            $la=$amount;
            if(empty($la)) $la=5;
            if($i==$la)
            {
                echo "<tr><td>\n";
                echo "</td><td></td><td></td></tr>\n";
                break;
            }
        }
        
    }
    if(count($filelist)) echo "</table>\n";
    table_middle_end();
    table_bottom("&nbsp;");
    include("footer.php");
    exit();
}

$result=dm_query("select * from files_categories order by category asc");
$numcats=mysql_num_rows($result);
for($i=0;$i<$numcats;$i++)
{
    $cat=mysql_fetch_object($result);
 
    if(!empty($cat->category))
    {
        $i=0; $bg=0;
        $buffer=rtrim($buffer);
        $buffer=rtrim($cat->category);
        $filelist=@dm_getfilelist("where category = '$buffer'");
        if(count($filelist))
        {
            echo "<p><h1><a href=\"$locate/files.php?action=listcategory&category=$buffer\" class=h1>$buffer</a></h1></p>\n";
            echo "<table border=0 bordercolor=#000000 cellspacing=0 cellpadding=0 width=100%>\n";
            echo "<tr><td>\n";
            dm_fileheader();
            echo "</td></tr>\n";
        }
    
        while($i<count($filelist))
        {
            $filedata=dm_getfiledata($filelist[$i]);
            $colr=$file_color[1];
            if($bg=="1") $colr=$file_color[2];
            show1file($filedata,$colr);
            $i=$i+1;
            $bg=$bg+1; if($bg>1) $bg=0;
            echo "</table></td></tr>\n";
            $la=$amount;
            if(empty($la)) $la=5;
            if($i==$la)
            {
                echo "<tr><td>\n";
                echo "<a href=\"$locate/files.php?action=listcategory&category=$buffer&top=0&amount=25\">more...</a></td><td></td><td></td><td></td><td></td><td></td>";
                echo "<td></td><td></td><td></td></tr>\n";
                break;
            }
        }
        if(count($filelist)) echo "</table>\n";
    }
}


table_middle_end();
table_bottom("&nbsp;");

include("footer.php");


?>

















































ÿ