<?php
    require_once("coreClass/myObject.php");
    require_once("myClass/registrasiProcess.php");

    $data[0][0]="kerang";
    $data[0][1]="ajaib";

    $registrasiClass=new registrasiProcess();
    $registrasiClass->insertRegistrasi("tb_kategori", $data);
?>