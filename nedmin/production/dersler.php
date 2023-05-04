<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$kurssor=$db->prepare("SELECT * FROM kurslar");
$kurssor->execute();


?>



<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ders Listeleme <small>

            </small></h2>

            <div class="clearfix"></div>

            <div align="right">
              <a href="ders-ekle.php"><button class="btn btn-success btn-xs"> Ders Ekle</button></a>

            </div>
          </div>
          <div class="x_content">

            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Ders Numarası</th>
                  <th>Ders Adı</th>
                  <th>Ders Süresi(Saat)</th>
                  <th>Ders Açıklama</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php 

                $i = 1;

                while($kurscek=$kurssor->fetch(PDO::FETCH_ASSOC)) {?>


                <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo $kurscek['kurs_ad'] ?></td>
                  <td><?php echo $kurscek['kurs_saat'] ?></td>
                  <td><?php echo $kurscek['kurs_aciklama'] ?></td>
                 
                  <td><center><a href="ders-duzenle.php?kurs_id=<?php echo $kurscek['kurs_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                  <td><center><a href="../netting/ders-islem.php?ders_id=<?php echo $kurscek['kurs_id']; ?>&kurssil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
                </tr>



                <?php  $i++;  }

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
