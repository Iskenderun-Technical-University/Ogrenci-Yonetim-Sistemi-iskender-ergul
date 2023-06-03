<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$ogretmensor=$db->prepare("SELECT * FROM ogretmen");
$ogretmensor->execute();



?>



<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ögretmen Listeleme <small>

            </small></h2>

            <div class="clearfix"></div>

            <div align="right">
              <a href="ogretmen-ekle.php"><button class="btn btn-success btn-xs"> Ögretmen Ekle</button></a>

            </div>
          </div>
          <div class="x_content">

            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Ogretmen Fotograf</th>
                  <th>Ogretmen Ad</th>
                  <th>Ogretmen Soyad</th>
                  <th>Ogretmen Branş</th>
                  <th>Ogretmen Maaş</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php 

                while($ogretmencek=$ogretmensor->fetch(PDO::FETCH_ASSOC)) {?>


                <tr>
                  <td><?php echo $ogretmencek['ogretmen_fotograf']?></td>
                  <td><?php echo $ogretmencek['ogretmen_ad']?></td>
                  <td><?php echo $ogretmencek['ogretmen_soyad'] ?></td>
                  <td><?php echo $ogretmencek['ogretmen_brans'] ?></td>
                  <td><?php echo $ogretmencek['ogretmen_maas'] ?></td>
                 
                  <td><center><a href="ogretmen-duzenle.php?ogretmen_id=<?php echo $ogretmencek['ogretmen_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                  <td><center><a href="../netting/ogretmen-islem.php?ogretmen_id=<?php echo $ogretmencek['ogretmen_id']; ?>&ogretmensil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
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
