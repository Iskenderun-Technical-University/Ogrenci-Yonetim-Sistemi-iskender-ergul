<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$ogrencisor=$db->prepare("SELECT * FROM ogrenci");
$ogrencisor->execute();

$ogrencisor=$db->prepare("SELECT * FROM ogrenci");
$ogrencisor->execute();


?>



<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ögrenci  Listeleme <small>

              



            </small></h2>

            <div class="clearfix"></div>

            <div align="right">
              <a href="ogrenci-ekle.php"><button class="btn btn-success btn-xs"> Ögrenci Ekle</button></a>

            </div>
          </div>
          <div class="x_content">

            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Ogrenci Numara</th>
                  <th>Ogrenci Fotograf</th>
                  <th>Ogrenci İsim</th>
                  <th>Ogrenci Soyisim</th>
                  <th>Ogrenci Cinsiyet</th>
                  <th>Ogrenci Telefon</th>
                  <th>Ogrenci Adres</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php 

                while($ogrencicek=$ogrencisor->fetch(PDO::FETCH_ASSOC)) {?>


                <tr>
                  <td><?php echo $ogrencicek['ogrenci_id']+1 ?></td>
                  <td><?php echo $ogrencicek['ogrenci_fotograf'] ?></td>
                  <td><?php echo $ogrencicek['ogrenci_isim'] ?></td>
                  <td><?php echo $ogrencicek['ogrenci_soyisim'] ?></td>
                  <td><?php echo $ogrencicek['ogrenci_cinsiyet'] ?></td>
                  <td><?php echo $ogrencicek['ogrenci_telefon'] ?></td>
                  <td><?php echo $ogrencicek['ogrenci_adres'] ?></td>
                  <td><center><a href="ogrenci-duzenle.php?ogrenci_id=<?php echo $ogrencicek['ogrenci_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                  <td><center><a href="../netting/ogrenci-islem.php?ogrenci_id=<?php echo $ogrencicek['ogrenci_id']; ?>&ogrencisil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
                </tr>



                <?php  }

                ?>


              </tbody>
            </table>

            <!-- Div İçerik Bitişi -->


          </div>
        </div>
      </div>
    </div>




  </div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
