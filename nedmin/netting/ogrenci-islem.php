<?php
ob_start();
session_start();

include 'baglan.php';

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




?>