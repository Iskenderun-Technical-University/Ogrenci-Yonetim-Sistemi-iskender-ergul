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

if (isset($_POST['fotoduzenle'])) {

    $ogrenci_id = $_POST['ogrenci_id'];
	
	$uploads_dir = '../../dimg';

	@$tmp_name = $_FILES['ogrenci_fotograf']["tmp_name"];
	@$name = $_FILES['ogrenci_fotograf']["name"];

	$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4.$name;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");

	
	$duzenle=$db->prepare("UPDATE ogrenci SET
		ogrenci_fotograf=:fotograf
		WHERE ogrenci_id=$ogrenci_id");
	$update=$duzenle->execute(array(
		'fotograf' => $refimgyol
		));



	if ($update) {

		Header("Location:../production/ogrenci-duzenle.php?durum=ok");

	} else {

		Header("Location:../production/ogrenci-duzenle.php?durum=no");
	}

}


if (isset($_POST['ogrenciduzenle'])) {


    $ogrenci_id = $_POST['ogrenci_id'];
	
	//Tablo güncelleme işlemi kodları...
	$ogrenciduzenle=$db->prepare("UPDATE ogrenci SET
		
		ogrenci_isim=:isim,
		ogrenci_soyisim=:soyisim,
		ogrenci_telefon=:telefon,
		ogrenci_adres=:adres,
		ogrenci_cinsiyet=:cinsiyet
		WHERE ogrenci_id=$ogrenci_id");

	$update=$ogrenciduzenle->execute(array(
		
		'isim' => $_POST['ogrenci_isim'],
		'soyisim' => $_POST['ogrenci_soyisim'],
		'telefon' => $_POST['ogrenci_telefon'],
		'adres' => $_POST['ogrenci_adres'],
		'cinsiyet' => $_POST['ogrenci_cinsiyet']
	
		));


	if ($update) {

		header("Location:../production/ogrenci-duzenle.php?durum=ok");

	} else {

        header("Location:../production/ogrenci-duzenle.php?durum=no");

	}
	
}

if (isset($_POST['ogretmenduzenle'])) {


    $ogretmen_id = $_POST['ogretmen_id'];
	
	//Tablo güncelleme işlemi kodları...
	$ogretmenduzenle=$db->prepare("UPDATE ogretmen SET
		
		ogretmen_ad=:ad,
		ogretmen_soyad=:soyad,
		ogretmen_brans=:brans,
		ogretmen_maas=:maas
		WHERE ogretmen_id=$ogretmen_id");

	$update=$ogretmenduzenle->execute(array(
		
		'ad' => $_POST['ogretmen_ad'],
		'soyad' => $_POST['ogretmen_soyad'],
		'brans' => $_POST['ogretmen_brans'],
		'maas' => $_POST['ogretmen_maas']
		));


	if ($update) {

		header("Location:../production/ogretmen-duzenle.php?durum=ok");

	} else {

        header("Location:../production/ogretmen-duzenle.php?durum=no");

	}
	
}


if($_GET['ogrencisil']=='ok') {

$sil = $db->prepare('DELETE FROM ogrenci  WHERE ogrenci_id=:id');
$kontrol = $sil->execute(array(
    'id' => $_GET['ogrenci_id']
));

    if($kontrol) {

        header('Location:../production/ogrenciler.php?sil=ok') ;  
    }else {

        header('Location:../production/ogrenciler.php?sil=no') ;  
    }

}

if($_GET['ogretmensil']=='ok') {

	$sil = $db->prepare('DELETE FROM ogretmen  WHERE ogretmen_id=:id');
	$kontrol = $sil->execute(array(
		'id' => $_GET['ogretmen_id']
	));
	
		if($kontrol) {
	
			header('Location:../production/ogretmenler.php?sil=ok') ;  
		}else {
	
			header('Location:../production/ogretmenler.php?sil=no') ;  
		}
	
	
	
	}



if (isset($_POST['ogrenciekle'])) {

    $uploads_dir = '../../dimg';

    $tmp_name = $_FILES['ogrenci_fotograf']["tmp_name"];
    $name = $_FILES['ogrenci_fotograf']["name"];

    $benzersizsayi4 = rand(20000, 32000);
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizsayi4 . $name;

    move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");

    $ekle = $db->prepare("INSERT INTO ogrenci SET 
		
		ogrenci_fotograf=:fotograf,
		ogrenci_isim=:isim,
		ogrenci_soyisim=:soyisim,
		ogrenci_telefon=:telefon,
		ogrenci_adres=:adres,
		ogrenci_cinsiyet=:cinsiyet
	
	
	");
    $ekle->execute(array(
		
        'fotograf' => $refimgyol,
		'isim' => $_POST['ogrenci_isim'],
		'soyisim' => $_POST['ogrenci_soyisim'],
		'telefon' => $_POST['ogrenci_telefon'],
		'adres' => $_POST['ogrenci_adres'],
		'cinsiyet' => $_POST['ogrenci_cinsiyet']
	
	
	
	));

	

    if ($ekle) {

        header("Location:../production/ogrenciler.php?durum=ok");

    } else {

        header("Location:../production/ogrenciler.php?durum=no");
    }


}


if (isset($_POST['ogretmenekle'])) {

   

    $ekle = $db->prepare("INSERT INTO ogretmen SET 
		
		ogretmen_ad=:ad,
		ogretmen_soyad=:soyad,
		ogretmen_brans=:brans,
		ogretmen_maas=:maas
	
	");
    $ekle->execute(array(
		
        'ad' => $_POST['ogretmen_ad'],
		'soyad' => $_POST['ogretmen_soyad'],
		'brans' => $_POST['ogretmen_brans'],
		'maas' => $_POST['ogretmen_maas']
	
	
	
	));

	

    if ($ekle) {

        header("Location:../production/ogretmenler.php?durum=ok");

    } else {

        header("Location:../production/ogretmenler.php?durum=no");
    }


}








?>