<?php
session_start();
if (!isset($_SESSION["Email"])) {
    header("location:index.php");
}
?>
<?php     
include("db.php");  
include("header.php"); 
include("menu.php"); 
?>      
<div id="page-wrapper">
<?php
//cek otoritas
$q = "SELECT * FROM tw_hak_akses WHERE tabel='dokumen/dokumen_file' AND user = '". $_SESSION['Email'] ."' AND insertData='1'";
$r = mysqli_query($con, $q);
if ($obj = @mysqli_fetch_object($r)) {
?>
<link href="standar.css" rel="stylesheet" type="text/css">

<!-- calendar -->
<script src="php_calendar/scripts.js" type="text/javascript"></script>
<!-- TinyMCE -->
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
    tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        plugins : "youtube,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,paste,directionality,fullscreen,noneditable,contextmenu",
        theme_advanced_buttons1_add_before : "save,newdocument,separator",
        theme_advanced_buttons1_add : "fontselect,fontsizeselect",
        theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor,liststyle",
        theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
        theme_advanced_buttons3_add_before : "tablecontrols,separator,youtube,separator",
        theme_advanced_buttons3_add : "emotions,iespell,flash,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        plugin_insertdate_dateFormat : "%Y-%m-%d",
        plugin_insertdate_timeFormat : "%H:%M:%S",
        extended_valid_elements : "hr[class|width|size|noshade]",
        file_browser_callback : "fileBrowserCallBack",
        paste_use_dialog : false,
        theme_advanced_resizing : true,
        theme_advanced_resize_horizontal : false,
        theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
        media_strict : false,
        apply_source_formatting : true
    });

    function fileBrowserCallBack(field_name, url, type, win) {
        var connector = "../../filemanager/browser.html?Connector=connectors/php/connector.php";
        var enableAutoTypeSelection = true;

        var cType;
        tinymcpuk_field = field_name;
        tinymcpuk = win;

        switch (type) {
            case "image":
                cType = "Image";
                break;
            case "flash":
                cType = "Flash";
                break;
            case "file":
                cType = "File";
                break;
        }

        if (enableAutoTypeSelection && cType) {
            connector += "&Type=" + cType;
        }

        window.open(connector, "tinymcpuk", "modal,width=600,height=400");
    }
</script>
<!-- /TinyMCE -->
<?php
echo "<table class='table table-striped'>";
echo "<tr><td colspan=2><font face='Verdana' color='black' size='1'>dokumen</font></td></tr>";
echo "<form action='insertmasterdokumendokumen_fileexec.php' method='post' enctype='multipart/form-data'>";
echo "<tr><td bgcolor='CCCCCC'><font face='Verdana' color='black' size='1'>No_Dokumen</font></td>";
echo "<td bgcolor='CCEEEE'><input type='text' class='form-control' name='No_Dokumen' size='100'></td>";
echo "<tr><td bgcolor='CCCCCC'><font face='Verdana' color='black' size='1'>Kode</font></td>";
echo "<td bgcolor='CCEEEE'>";
echo "<select class='form-control' name='Kode'>";
$result = mysqli_query($con, "SELECT * FROM kategori_dokumen"); 
while ($r = mysqli_fetch_array($result)) {
    echo "<option value='". $r['Kode'] ."'>". $r['Kode'] ." | ". $r['Kategori'] ."</option>";
}
echo "</select>";
echo "</td>";
echo "<tr><td bgcolor='CCCCCC'><font face='Verdana' color='black' size='1'>Judul</font></td>";
echo "<td bgcolor='CCEEEE'><input type='text' class='form-control' name='Judul' size='100'></td>";
echo "<tr><td bgcolor='CCCCCC'><font face='Verdana' color='black' size='1'>Deskripsi</font></td>";
echo "<td bgcolor='CCEEEE'><textarea class='form-control' name='Deskripsi' cols='70' rows='5'></textarea></td>";
echo "<tr><td bgcolor='CCCCCC'><font face='Verdana' color='black' size='1'>Tanggal_Pembuatan</font></td>";
echo "<td bgcolor='CCEEEE'><input type='text' id='Tanggal_Pembuatan' name='Tanggal_Pembuatan'><script type='text/javascript'>calendar.set('Tanggal_Pembuatan');</script></td>";
echo "<tr><td bgcolor='CCCCCC'><font face='Verdana' color='black' size='1'>Tanggal_Modifikasi</font></td>";
echo "<td bgcolor='CCEEEE'><input type='text' id='Tanggal_Modifikasi' name='Tanggal_Modifikasi'><script type='text/javascript'>calendar.set('Tanggal_Modifikasi');</script></td>";
echo "<tr><td bgcolor='CCCCCC'><font face='Verdana' color='black' size='1'>Kode_Pengguna</font></td>";
echo "<td bgcolor='CCEEEE'>";
echo "<select class='form-control' name='Kode_Pengguna'>";
$result = mysqli_query($con, "SELECT * FROM pengguna"); 
while ($r = mysqli_fetch_array($result)) {
    echo "<option value='". $r['Kode_Pengguna'] ."'>". $r['Kode_Pengguna'] ." | ". $r['Nama'] ."</option>";
}
echo "</select>";
echo "</td>";
echo "<tr><td colspan=2 align='center'><input type='submit' name='send_image' value='Insert'></td></tr>";
echo "</form>";
echo "</table></td></tr>";
?>
</div> 
<?php 
include("footer.php");
?>
<?php
} else {
 //header("Location:content.php");
}
?>
