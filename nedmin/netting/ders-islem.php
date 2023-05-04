<?php
ob_start();
session_start();

include 'baglan.php';

if (isset($_POST['kursduzenle'])) {


    $kurs_id = $_POST['kurs_id'];
	
	//Tablo güncelleme işlemi kodları...
	$kursduzenle=$db->prepare("UPDATE kurslar SET
		
		kurs_ad=:ad,
		kurs_saat=:saat,
		kurs_aciklama=:aciklama
		WHERE kurs_id=$kurs_id");

	$update=$kursduzenle->execute(array(
		
		'ad' => $_POST['kurs_ad'],
		'saat' => $_POST['kurs_saat'],
		'aciklama' => $_POST['kurs_aciklama']
		));


	if ($update) {

		header("Location:../production/ders-duzenle.php?durum=ok");

	} else {

        header("Location:../production/ders-duzenle.php?durum=no");

	}
	
}

if (isset($_POST['dersekle'])) {

   

    $kursduzenle=$db->prepare("INSERT INTO kurslar SET
		
		kurs_ad=:ad,
		kurs_saat=:saat,
		kurs_aciklama=:aciklama
		");

	$update=$kursduzenle->execute(array(
		
		'ad' => $_POST['kurs_ad'],
		'saat' => $_POST['kurs_saat'],
		'aciklama' => $_POST['kurs_aciklama']
		));

	

    if ($ekle) {

        header("Location:../production/dersler.php?durum=ok");

    } else {

        header("Location:../production/dersler.php?durum=no");
    }


}


if($_GET['derssil']=='ok') {

	$sil = $db->prepare('DELETE FROM kurslar  WHERE kurs_id=:id');
	$kontrol = $sil->execute(array(
		'id' => $_GET['ders_id']
	));
	
		if($kontrol) {
	
			header('Location:../production/dersler.php?sil=ok') ;  
		}else {
	
			header('Location:../production/dersler.php?sil=no') ;  
		}
	
	
	
}


?>