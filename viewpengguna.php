<?php
session_start();
if (!isset($_SESSION["Email"])) {
    header("location:index.php");
    exit; // tambahkan exit setelah header
}

include("db.php");
include("header.php");
include("menu.php");
include("tulislog.php");
?>

<div id="page-wrapper">
    <?php
    //cek otoritas
    $q = "SELECT * FROM tw_hak_akses where tabel='pengguna' and user = '" . $_SESSION['Email'] . "' and viewData='1'";
    $r = mysqli_query($con, $q);
    if ($obj = @mysqli_fetch_object($r)) {
    ?>
        <html>

        <head>
            <title>E-Document</title>
            <link rel="stylesheet" type="text/css" href="tag.css">
            <script type="text/javascript" src="tag.js"></script>
            <script type="text/javascript" src="kalender/calendar.js"></script>
            <link href="kalender/calendar.css" rel="stylesheet" type="text/css" media="screen">
        </head>

        <body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor=FFFFFF>
            <?php
            echo "<td bgcolor=F5F5F5 valign=top>";
            echo "<div class='table-responsive'> ";
            echo "<table class='table table-striped'>";
            echo "<tr><td colspan=2><font face=Verdana color=black size=1>pengguna</font></td></tr>";
            $result = mysqli_query($con, "SELECT * FROM pengguna where Kode_Pengguna = '" . mysqli_real_escape_string($con, $_GET['Kode_Pengguna']) . "'");
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>Kode_Pengguna</font></td>";
                echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['Kode_Pengguna'] . "</font></td>";
                echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>Nama</font></td>";
                echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['Nama'] . "</font></td>";
                echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>Jenis_Pengguna</font></td>";
                echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['Jenis_Pengguna'] . "<br>";
                $l = mysqli_query($con, "select Keterangan from jenis_pengguna where Jenis_Pengguna = '" . $row['Jenis_Pengguna'] . "'");
                while ($rl = mysqli_fetch_array($l)) {
                    echo $rl[0];
                }
                echo "</font></td></tr>";
                echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>Email</font></td>";
                echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['Email'] . "</font></td>";
                echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>Telepon</font></td>";
                echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['Telepon'] . "</font></td>";
                echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>Foto</font></td>";
                echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1><a href='images/" . $row['Foto'] . "' target=_blank><img src='images/" . $row['Foto'] . "' width=50 height=50></a></font></td>";
                echo "<tr><td colspan=2 align=center><a href=listpengguna.php><button type='button' class='btn btn-warning'><font face=Verdana size=1><i class='fa fa-check'></i>&nbsp;Back</font></button></a></td></tr>";
                echo "</table><br>";
                echo "</div>";
            }
            tulislog("view pengguna", $con);
            ?>
        </body>

        </html>
</div>

<?php include("footer.php"); ?>
<?php
} else {
    //header("Location:content.php");
}
?>
