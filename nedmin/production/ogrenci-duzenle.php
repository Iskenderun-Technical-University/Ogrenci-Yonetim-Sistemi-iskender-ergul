<?php 

include 'header.php'; 


$ogrencisor = $db->prepare("SELECT * FROM ogrenci WHERE ogrenci_id=:id");
$ogrencisor->execute(array('id' => $_GET['ogrenci_id']));
$ogrencicek = $ogrencisor->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ögrenci Düzenleme <small>

              <?php 

              if ($_GET['durum']=="ok") {?>

              <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif ($_GET['durum']=="no") {?>

              <b style="color:red;">İşlem Başarısız...</b>

              <?php }

              ?>


            </small></h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/ogrenci-islem.php" method="POST" id="demo-form2"  enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">


            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Resim <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <img width="300" src="../../<?php echo $ogrencicek['ogrenci_fotograf']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim Seç<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="first-name"  name="ogrenci_fotograf"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ogrenci İsim <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="ogrenci_isim" value="<?php echo $ogrencicek['ogrenci_isim']; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ogrenci Soyisim <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="ogrenci_soyisim" value="<?php echo $ogrencicek['ogrenci_soyisim']; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ogrenci Telefon <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="ogrenci_telefon" value="<?php echo $ogrencicek['ogrenci_telefon']; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ogrenci Adres <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="ogrenci_adres" value="<?php echo $ogrencicek['ogrenci_adres']; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ögrenci Ciniyet<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                 <select id="heard" class="form-control" name="ogrenci_cinsiyet" required>

                  <option  <?php echo $ogrencicek['ogrenci_cinsiyet'] ?>>Erkek</option>
                  <option  <?php echo $ogrencicek['ogrenci_cinsiyet'] ?>>Kadın</option>


                </select>
              </div>
            </div>

                <input type="hidden" name="ogrenci_id" value="<?php echo $ogrencicek['ogrenci_id']; ?>" >
                <input type="hidden" name="ogrenci_fotograf" value="<?php echo $ogrencicek['ogrenci_fotograf'] ?>">

              <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="ogrenciduzenle" class="btn btn-success">Güncelle</button>
                </div>
              </div>

            </form>



          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
