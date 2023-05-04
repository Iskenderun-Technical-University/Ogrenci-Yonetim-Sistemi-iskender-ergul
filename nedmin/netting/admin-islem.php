<?php
ob_start();
session_start();

include 'baglan.php';


if(isset($_POST['admingiris'])){ 

    $admin_isim = $_POST['admin_isim'];
    $admin_sifre = $_POST['admin_sifre'];

    $adminsor=$db->prepare("SELECT * FROM admin_giris where admin_isim=:isim and admin_sifre=:sifre and admin_yetki=:yetki");
    $adminsor->execute(array(

        'isim' => $admin_isim,
        'sifre' => $admin_sifre,
        'yetki' => 1

    ));

    echo $say=$adminsor->rowCount();

	if ($say==1) {

		$_SESSION['admin_isim']=$admin_isim;
		header("Location:../production/index.php");
		exit;



	} else {

		header("Location:../production/login.php?durum=no");
		exit;
	}

	
}




?>