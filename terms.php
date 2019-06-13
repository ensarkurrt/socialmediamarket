<?php require_once("inc/header.php"); ?>
<!-- Main variables *content* -->

<div class="inner-page">
  <section class="terms-sec">
  <div class="container">
   <!--  <h3>Terms of Service</h3> -->
    <div class="card bg-white">
            <div class="card-header">
              <div class="card-title">Kullanım Koşulları</div>
            </div>
            <div class="card-body">
              <?php echo $takeSetting['kullanim_kos']; ?>
            </div>
          </div>

          <div class="card bg-white">
            <div class="card-header">
              <div class="card-title">İADE KOŞULLARI</div>
            </div>
            <div class="card-body">
              <?php echo $takeSetting['iade_kos']; ?>
            </div>
          </div>

          <div class="card bg-white">
            <div class="card-header">
              <div class="card-title">Gizlilik Politikası</div>
            </div>
            <div class="card-body">
              <?php echo $takeSetting['giz_pol']; ?>
            </div>
          </div>
  </div>
  </section>
</div>


<?php require_once("inc/footer.php"); ?>
