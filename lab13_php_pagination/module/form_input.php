<?php
/**
 * Program utilizing Program 10.2 to create a simple input form.
 **/

include "../class/form.php";

echo "<html><head><title>Mahasiswa</title></head><body>";

$form = new Form("", "Input Form");
$form->addField("txtnim", "<b>Nim:</b>");
$form->addField("txtnama", "<b>Nama:</b>");
$form->addField("txtalamat", "<b>Alamat:</b>");

echo "<h3>Silahkan isi form berikut ini:</h3>";

$form->displayForm();

echo "</body></html>";
?>
