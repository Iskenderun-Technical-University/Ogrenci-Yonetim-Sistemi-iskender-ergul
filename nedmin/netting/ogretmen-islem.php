<?php
ob_start();
session_start();

include 'baglan.php';



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


?>