<?php require_once("inc/header.php"); ?>
<!-- Main variables *content* -->
<div class="inner-page">
  <section>
    <div class="container">
      <div class="row justify-content-center payments-panel">
        <div class="col-lg-7">
          <!-- alert -->


          <!-- alert end -->

          <div class="card">
            <div class="card-header">
              <ul class="nav nav-tabs row" id="myTab" role="tablist">
                <?php if($takeSetting['paywant']==1){?> <li class="nav-item col">
                  <a class="nav-link payment_tab_link" data-toggle="tab" id="tab_646" href="#paywant" role="tab" aria-controls="home" aria-selected="true" data-paymentname="Paywant" data-paymentid="646"><h6>Paywant</h6></a>
                </li> <?php } ?>

                <?php if($takeSetting['shopier']==1){?> 	<li class="nav-item col">
      <a class="nav-link payment_tab_link" data-toggle="tab" id="tab_5790" href="#shopier" role="tab" aria-controls="home" aria-selected="false" data-paymentname="Shopier" data-paymentid="5790"><h6>Shopier</h6></a>
    </li> <?php } ?>
    <?php if($takeSetting['transfer']==1){?> 	<li class="nav-item col">
    <a class="nav-link payment_tab_link" data-toggle="tab" id="tab_5790" href="#transfer" role="tab" aria-controls="home" aria-selected="false" data-paymentname="Transfer" data-paymentid="5790"><h6>EFT/HAVALE</h6></a>
    </li> <?php } ?>
                              </ul>
            </div>



            <div class="card-body">
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show"  role="tabpanel" aria-labelledby="home-tab">
                  Ödeme türünü seçin
                </div>
                <?php if($takeSetting['paywant']==1){?>

                <div class="tab-pane fade" id="paywant" role="tabpanel" aria-labelledby="home-tab">

                  <div class="alert alert-dismissible alert-danger" id="danger" style="display:none">

                  </div>

                  <form method="post" action="">
                    <div class="title" id="form_payment_name">Paywant</div>

                    <p id="paywant_content" style="display: block;">
                      <?php echo $takeSetting['paywant_cont']; ?>

                      </p>
                      <div class="form-group">
                        <label for="paywantAmount" class="control-label">Miktar</label>
                        <input type="number" class="form-control" name="paywantAmount" id="paywantAmount" step="0.01">

                      <input type="button" onclick="return paywantPay()" name="pay" class="btn btn-green" value="Ödeme" id="pay">
                </div>

                  </form>
                </div>
               <?php } ?>

               <?php if($takeSetting['shopier']==1){?>

               <div class="tab-pane fade" id="shopier" role="tabpanel">
                 <form method="post" action="">
                         <div class="title" id="form_payment_name">Shopier</div>


                     <p id="shopier_content" style="display: block;">
                         <?php echo $takeSetting['shopier_cont']; ?>

                     </p>
                     </p>

                   <div class="form-group">
                     <label for="method" class="control-label">Miktar</label>
                     <select class="form-control" id="amountShopier" name="amountShopier">
                       <?php
                            $shopier_amount=$db->prepare("SELECT * FROM shopier_id");
                            $shopier_amount->execute(array(
                              'enable' => 1
                            ));

                            while($takeShopier=$shopier_amount->fetch(PDO::FETCH_ASSOC)){ ?>
                                  <option value="<?php echo $takeShopier['link_id']; ?>"><?php echo $takeShopier['amount']; ?> TL Bakiye</option>
                        <?php  }  ?>
                    </select>
                    <input type="button" onclick="return shopierPay()" name="pay" class="btn btn-green" value="Ödeme" id="pay">
                   </div>

                 </form>
               </div>
              <?php } ?>

              <?php if($takeSetting['transfer']==1){?>

              <div class="tab-pane fade" id="transfer" role="tabpanel" aria-labelledby="home-tab">

                <div class="alert alert-dismissible alert-success" id="success" style="display:none">
                  selam
                </div>

                <div class="alert alert-dismissible alert-danger" id="danger1" style="display:none">
                  selam
                </div>

                <div class="alert alert-dismissible alert-info" id="info" style="display:block">
                  Belirtilen banka hesaplardan herhangi birine eft/havale yapmanız halinde ödeme bildirmi yapabilirsiniz.
                </div>

                <form method="post" action="">
                  <div class="title" id="form_payment_name">EFT/HAVALE</div>

                  <div id="transfer_content" style="display: block;">

                    <?php
                         $pay_type=$db->prepare("SELECT * FROM pay_type");
                         $pay_type->execute();
                         $takePayType=$pay_type->fetch(PDO::FETCH_ASSOC);
                        echo $takePayType['description'];
                     ?>

                   </div>
                    <div class="form-group">
                      <label for="method" class="control-label">Banka Seçin</label>

                    <select class="form-control" id="chooseBank" name="chooseBank" onchange="chooseBankFunc(this)">
                      <?php
                           $pay_type=$db->prepare("SELECT * FROM pay_type");
                           $pay_type->execute();

                           while($takePayType=$pay_type->fetch(PDO::FETCH_ASSOC)){ ?>
                                 <option value="<?php echo $takePayType['id']; ?>"><?php echo $takePayType['name']; ?></option>
                       <?php  }  ?>
                   </select>

                 </div>

                    <div class="form-group">
                      <label for="paywantAmount" class="control-label">Miktar</label>
                      <input type="number" class="form-control" name="transferAmount" id="transferAmount" step="0.01">

                    <input type="button" onclick="return transferPay()" name="pay" class="btn btn-green" value="Ödeme Bildirimi Yap" id="transferPayButton">
              </div>

                </form>
              </div>
             <?php } ?>

              </div>
            </div>
          </div>



          <!-- payments info/news -->
     <div class="card">
              <div class="card-body">
                <ul class="info-list">
                    <li class="list-item">
                      <span class="icon"> <span class="table" style="height: 142px;"> <span class="table-cell"> <img src="<?php echo $takeSetting['url']; ?>image/gVAGQKR.png"> </span> </span> </span>
                      <div class="content">
                        <div class="title"></div>
                        <p class="card-text">
                        </p><?php echo $takeSetting['pay_cont']; ?>
                        <p></p>
                      </div>
                    </li>


        </ul></div>
      </div>
    </div>
  </div></div></section>
</div>

<?php require_once("inc/footer.php"); ?>
