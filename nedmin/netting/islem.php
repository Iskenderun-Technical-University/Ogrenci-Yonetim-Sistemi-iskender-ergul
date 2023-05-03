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

if(isset($_POST['ogrenciduzenle']))  { 

	$ogrenci_id=$_POST['ogrenci_id'];

	$uploads_dir = '../../dimg';
	@$tmp_name = $_FILES['ogrenci_fotograf']["tmp_name"];
	@$name = $_FILES['ogrenci_fotograf']["name"];
	$benzersizsayi1=rand(20000,32000);
	$benzersizsayi2=rand(20000,32000);
	$benzersizsayi3=rand(20000,32000);
	$benzersizsayi4=rand(20000,32000);
	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

	$duzenle=$db->prepare("UPDATE ogrenci SET
		ogrenci_isim=:isim,
		ogrenci_soyisim=:soyisim,
		ogrenci_telefon=:telefon,
		ogrenci_adres=:adres,
		ogrenci_cinsiyet=:cinsiyet,
		ogrenci_fotograf=:resimyol	
		WHERE ogrenci_id=$ogrenci_id");
	$update=$duzenle->execute(array(
		'isim' => $_POST['ogrenci_isim'],
		'soyisim' => $_POST['ogrenci_soyisim'],
		'telefon' => $_POST['ogrenci_telefon'],
		'adres' => $_POST['ogrenci_adres'],
		'cinsiyet' => $_POST['ogrenci_cinsiyet'],
		'resimyol' => $refimgyol
		));
	

	

	if ($update) {

		$resimsilunlink=$_POST['ogrenci_fotograf'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/ogrenci-duzenle.php?ogrenci_id=$ogrenci_id&durum=ok");

	} else {

		Header("Location:../production/ogrenci-duzenle.php?durum=no");
	}



} 
	



if (isset($_POST['ogretmenduzenle'])) {


    $ogretmen_id = $_POST['ogretmen_id'];

	$uploads_dir = '../../dimg';
	@$tmp_name = $_FILES['ogretmen_fotograf']["tmp_name"];
	@$name = $_FILES['ogretmen_fotograf']["name"];
	$benzersizsayi1=rand(20000,32000);
	$benzersizsayi2=rand(20000,32000);
	$benzersizsayi3=rand(20000,32000);
	$benzersizsayi4=rand(20000,32000);
	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	
	//Tablo güncelleme işlemi kodları...
	$ogretmenduzenle=$db->prepare("UPDATE ogretmen SET
		
		ogretmen_ad=:ad,
		ogretmen_soyad=:soyad,
		ogretmen_brans=:brans,
		ogretmen_maas=:maas,
		ogretmen_fotograf=:resimyol	
		WHERE ogretmen_id=$ogretmen_id");

	$update=$ogretmenduzenle->execute(array(
		
		'ad' => $_POST['ogretmen_ad'],
		'soyad' => $_POST['ogretmen_soyad'],
		'brans' => $_POST['ogretmen_brans'],
		'maas' => $_POST['ogretmen_maas'],
		'resimyol' =>$refimgyol
		));


	if ($update) {
		$resimsilunlink=$_POST['ogretmen_fotograf'];
		unlink("../../$resimsilunlink");
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


	$uploads_dir = '../../dimg';

    $tmp_name = $_FILES['ogretmen_fotograf']["tmp_name"];
    $name = $_FILES['ogretmen_fotograf']["name"];

    $benzersizsayi4 = rand(20000, 32000);
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizsayi4 . $name;

    move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");

   

    $ekle = $db->prepare("INSERT INTO ogretmen SET 
		ogretmen_fotograf=:fotograf,
		ogretmen_ad=:ad,
		ogretmen_soyad=:soyad,
		ogretmen_brans=:brans,
		ogretmen_maas=:maas
	
	");
    $ekle->execute(array(
		'fotograf'=>$refimgyol,
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







?>