<?php
include("../class/koneksi.php");
include("../class/config.php");

$sql = 'SELECT * FROM data_barang';
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Praktikum 11</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <header>
            <h1>Pendifinisian Class dan Pemanggilan Class</h1>
        </header>
        <nav>
            <a href="../module/index.php">Home</a>
            <a href="../module/about.php">About</a>
            <a href="../module/kontak.php">Contact</a>
        </nav>
        