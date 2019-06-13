<?php
require_once("inc/header.php");




 ?>
<!-- Main variables *content* -->
<div class="inner-page">
  <!-- top section -->
  <section>
    <div class="container">

      <div class="row">

        <div class="col-lg">

          <div class="card order-dashboard">
            <div class="card-body">
              <div class="icon rounded-circle">
                <i class="fa fa-clone" style="margin-top:12px"></i>
              </div>
              <div class="content-box">
                <div class="title">Bugüne Kadar Tamamlanan Sipariş Sayısı</div>
                <div class="numbers">
                  <?php
                    $cek=$db->prepare("select * from orders");
                    $cek->execute();
                    echo $cek->rowCount();
                 ?></div>
              </div>
              <div class="des-sec"><? echo $takeSetting['name'];?> bugüne kadar tamamlanan siparişler</div>
            </div>
          </div>
        </div>
        <div class="col-lg">
          <div class="card order-dashboard">
            <div class="card-body">
              <div class="icon rounded-circle">
                <i class="fa fa-wallet" style="margin-top:12px"></i>
              </div>
              <div class="right-side">
                <label></label>
                <a href="addfunds" class="btn btn-green">Bakiye Ekle</a>
              </div>
              <div class="content-box">
                <div class="title">Mevcut Bakiyeniz</div>
                <div class="numbers"><?php echo $takeUserInfo['balance'] ?>₺</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end top section -->

  <section>
    <div class="container">
      <div class="row">

        <div class="col-lg">
          <div class="card">
            <div class="card-body pt-0">

              <ul class="nav nav-tabs"> <!-- nav tabs -->
                <li class="nav-item">
                  <a class="nav-link active" href="#neworder" aria-controls="new-order" data-toggle="tab">
                    <i class="fa fa-clone"></i> Yeni Sipariş
                  </a>
                </li>

              </ul> <!-- end nav tabs -->

              <div class="tab-content">

                <div id="neworder" class="tab-pane fade in active"> <!-- neworder tab -->
                  <form method="post" id="order-form">

                    <div class="alert alert-dismissible alert-danger" id="danger" style="display:none">
                      Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                    </div>
                    <div class="alert alert-dismissible alert-success" id="success" style="display:none">
                      Sipariş verildi. <a>Siparişlerim</a> sayfasından görüntüleyebilirsiniz.
                    </div>


                                          <div class="form-group">
                        <label for="orderform-category" class="control-label">Kategori</label>
                        <select class="form-control" id="category" name="category" onchange="getComboA(this)">
                          <option value="0" selected="">Kategori Seçin</option>
                          <?php
                              $category=$db->prepare("SELECT * FROM category where enable=:enable");
                                $category->execute(array(
                                  'enable' => 1
                                ));

                                while($takeCategory=$category->fetch(PDO::FETCH_ASSOC)){ ?>
                                      <option value="<?php echo $takeCategory['id']; ?>"><?php echo $takeCategory['name']; ?></option>
                              <?php  }  ?>
                              </select>
                      </div>
                      <div class="form-group">
                      <label for="service" class="control-label">Servis/1000 adet fiyatı</label>
                      <!--<span class="help-for-icons">
                        <i class="fa fa-question-circle"></i>
                        <div class="icons-panel card">
                          <ul class="nav nav-pills">
                            <li class="active">
                              <a href="#tab-1" data-hover="tab" class="active show">â­</a>
                            </li>
                            <li>
                              <a href="#tab-2" data-hover="tab" class="">â¡ï¸</a>
                            </li>
                            <li>
                              <a href="#tab-3" data-hover="tab" class="">â»</a>
                            </li>
                            <li>
                              <a href="#tab-4" data-hover="tab" class="">ð«</a>
                            </li>
                            <li>
                              <a href="#tab-5" data-hover="tab" class=""><b>AR</b></a>
                            </li>
                            <li>
                              <a href="#tab-6" data-hover="tab" class=""><b>R30</b></a>
                            </li>
                            <li>
                              <a href="#tab-7" data-hover="tab" class=""><b>R60</b></a>
                            </li>
                            <li>
                              <a href="#tab-8" data-hover="tab" class=""><b>Râ</b></a>
                            </li>
                            <li>
                              <a href="#tab-9" data-hover="tab" class="">ð©</a>
                            </li>
                          </ul>
                          <div class="tab-content well">
                            <div class="tab-pane active show" id="tab-1">Best Service</div>
                            <div class="tab-pane" id="tab-2">Fast Start</div>
                            <div class="tab-pane" id="tab-3">Refill button</div>
                            <div class="tab-pane" id="tab-4">Cancel button</div>
                            <div class="tab-pane" id="tab-5">Auto-Refill</div>
                            <div class="tab-pane" id="tab-6">Refill 30 days</div>
                            <div class="tab-pane" id="tab-7">Refill 60 days</div>
                            <div class="tab-pane" id="tab-8">Lifetime Refill</div>
                            <div class="tab-pane" id="tab-9">Service Updating (Slow Start, Slow Delivery)</div>
                          </div>
                        </div>
                      </span>-->
                      <select id="service" class="form-control" name="service" onchange="getComboDesc(this)">
                        <option data-type="0" value="0">Kategori Seçiniz</option>
                        </select>
                    </div>

                    <!-- description split -->
                    <!--<div class="description fields" id="service_description">
                      <label for="service_description" class="control-label">Servis Açıklaması</label>

                      <div class="service-description-split">

                      </div>
                    </div> --><!-- split end -->

                    <!--<div class="description">
                      <div class="title">
                        Description
                      </div>

                      <div class="row">
                        <div class="col-sm">
                          <div class="card card-mini bg-light">
                            <div class="card-body">
                              <label>Quality</label>
                              <div class="value quality-split"></div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm">
                          <div class="card card-mini bg-light">
                            <div class="card-body">
                                <label>Start Time</label>
                              <div class="value time-split"></div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm">
                          <div class="card card-mini bg-light">
                            <div class="card-body">
                              <label>Speed per Day</label>
                              <div class="value speed-split"></div>
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-sm">
                          <div class="card card-mini bg-light">
                            <div class="card-body">
                              <label>Min/Max</label>
                              <div class="value minMax-split"></div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm">
                          <div class="card card-mini bg-light">
                            <div class="card-body">
                                <label>Refill Available</label>
                              <div class="value refill-split"></div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm">
                          <div class="card card-mini bg-light">
                            <div class="card-body">
                              <label>Price per 1000</label>
                              <div class="value price-split"></div>
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="card">
                        <div class="card-header">Details</div>
                        <div class="card-body">
                          <p class="card-text details-split"></p>

                        </div>
                      </div>
                    </div>-->

                    <!-- normal desc -->
                    <div class="form-group fields" id="service_description">
                      <label for="service_description" class="control-label">Servis Açıklaması</label>
                      <div class="panel-body border-solid border-rounded" id="desc" style="border: 1px solid #d5dcec; border-radius: 2px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;"></div>
                    </div>
                    <p><span class="label label-danger">UYARI</span>
Bir Profil Yada Link İçin Başka Siparişiniz Varsa Aynı Anda 2.Siparişi Girmeyin! .</p>
                    <div id="fields">

<div class="form-group fields" id="order_link">
    <label class="control-label" for="field-orderform-fields-link">Link</label>
    <input class="form-control" name="OrderForm[link]" value="" type="text" id="link">
</div>
<div class="form-group fields" id="order_quantity">
    <label class="control-label" for="field-orderform-fields-quantity">Miktar</label>
    <input class="form-control" name="count" id="count" value="" type="number" onchange="calculateCost()"><small id="info" class="help-block min-max">Min: 10 - Max: 100000</small>
</div>
</div>

                    <div class="form-group">
                      <div class="card card-mini price bg-light">
                        <div class="card-body">
                          <span class="card-text">
                            <b>Ücret</b></span>
                          <input type="text" class="color-text" id="costMy" value="">
                        </div>
                      </div>
                    </div>


                    <div class="form-group">
                      <input type="button" onclick="return newOrder()" name="save" class="btn btn-blue" value="Sipariş Ver" id="butsave">
                    </div>
                  </form>
                </div> <!-- new order tab end -->



              </div>
            </div>
          </div>
        </div> <!-- prvi col-lg end -->

        <div class="col-lg">
          <div class="accordion mb-30">
            <div class="card bg-white">
              <div class="card-header" id="headingOne">
                  <button class="btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-clipboard-list"></i> MUTLAKA OKUYUN! <i class="arrow fa fa-angle-up"></i><i class="arrow fa fa-angle-down"></i> </button>
              </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  <p class="card-text">
                    <?php echo $takeSetting['notice']; ?>
                  	</p>
                  <p><i class="blue"><?php echo $takeSetting['name']; ?></i></p>
                </div>
              </div>
                          </div>
          </div>

        <!--  <div class="card bg-white latest-news-panel">
            <div class="card-header">
              <div class="card-title">
                <i class="fa fa-newspaper"></i> Yenilikler</div>
              <!--<span class="help-for-icons"> <i class="fa fa-question-circle"></i>
                <div class="icons-panel card">
                  <ul class="nav nav-pills">
                    <li class="active">
                      <a href="#tab-1-1" data-hover="tab">â­</a>
                    </li>
                    <li>
                      <a href="#tab-2-1" data-hover="tab">â¡ï¸</a>
                    </li>
                    <li>
                      <a href="#tab-3-1" data-hover="tab">â»</a>
                    </li>
                    <li>
                      <a href="#tab-4-1" data-hover="tab">ð«</a>
                    </li>
                    <li>
                      <a href="#tab-5-1" data-hover="tab"><b>AR</b></a>
                    </li>
                    <li>
                      <a href="#tab-6-1" data-hover="tab"><b>R30</b></a>
                    </li>
                    <li>
                      <a href="#tab-7-1" data-hover="tab"><b>R60</b></a>
                    </li>
                    <li>
                      <a href="#tab-8-1" data-hover="tab"><b>Râ</b></a>
                    </li>
                    <li>
                      <a href="#tab-9-1" data-hover="tab">ð©</a>
                    </li>
                  </ul>
                  <div class="tab-content well">
                    <div class="tab-pane active" id="tab-1-1">Best Service</div>
                    <div class="tab-pane" id="tab-2-1">Fast Start</div>
                    <div class="tab-pane" id="tab-3-1">Cancel button</div>
                    <div class="tab-pane" id="tab-4-1">Refill button</div>
                    <div class="tab-pane" id="tab-5-1">Auto-Refill</div>
                    <div class="tab-pane" id="tab-6-1">Refill 30 days</div>
                    <div class="tab-pane" id="tab-7-1">Refill 60 days</div>
                    <div class="tab-pane" id="tab-8-1">Lifetime Refill</div>
                    <div class="tab-pane" id="tab-9-1">Service Updating (Slow Start, Slow Delivery)</div>
                  </div>
                </div> </span>-->
            </div>
            <!--    <div class="card-body" id="newOrderContent">
               <div class="news-list-panel">

                 <div class="news-list-item">

                   <span class="badge badge-green date">28 Şubat 2019</span>
                   <div class="news-type-list">
                     <div class="news-type-list-item">
                       <div class="title red">Düzenleme</div>
                       <ul class="list">
                         <li class="list-item">Yeni Tasarım Mobil Uyumlu Hale Getirildi!</li>
                       </ul>
                     </div>
                  <div class="news-type-list-item">
                       <div class="title red">Yeni Ödeme Yöntemi</div>
                       <ul class="list">
                         <li class="list-item"> Yeni Tema İle Birlikte ,Perfect Money İle Ödeme Yöntemi  Aktif Edilmiştir</li>
                       </ul>
                     </div>
            <div class="card-body" id="newOrderContent">
               <div class="news-list-panel">

                 <div class="news-list-item">
                 <div class="news-list-item">
                  <span class="badge badge-green date">20 Mart 2019</span>
                  <div class="news-type-list">
                    <div class="news-type-list-item">
                      <div class="title blue">Fiyat Güncellemesi</div>
                      <ul class="list">
                        <li class="list-item"><b>● Instagram Beğeni Paketleri ve Paket Oluşturma Servislerinin Fiyatları Maaliyetlerin Aşırı Yükselmesinden Dolayı Güncellenmiştir. <br>
<div class="card-body" id="newOrderContent">
               <div class="news-list-panel">

                 <div class="news-list-item">
                 <div class="news-list-item">
                  <span class="badge badge-green date">04 Mart 2019</span>
                  <div class="news-type-list">
                    <div class="news-type-list-item">
                      <div class="title blue">Fiyat Güncellemesi</div>
                      <ul class="list">
                        <li class="list-item"><b>● Instagram Türk Bot-Gerçek Takipçi Takipçi fiyatlandırması '05.03.2019' tarihi itibariyle değişikliğe uğrayacaktır <br>

● Karışık Bot-Gerçek Takipçi Yeni Fiyatı 35 TL <br>

● %90 Türk BAYAN Bot-Gerçek Takipçi Yeni Fiyatı 40 TL <br>

● %90 Türk Erkek Bot-Gerçek Takipçi Yeni Fiyatı 40 TL <br>

● Tüm Bayilierimiz Fiyatlarınızı Bu Fiyatlar Doğrultusunda "05.03.2019" Gecesi 00:00'a Kadar Güncelleyiniz.</b></li>
                      </ul>
                    </div>
                   <!--  <div class="news-type-list-item">
                      <div class="title red">Disabled</div>
                      <ul class="list">
                        <li class="list-item">DISABLED</li>
                      </ul>
                    </div>
                    <div class="news-type-list-item">
                      <div class="title green">Updated</div>
                      <ul class="list">
                        <li class="list-item">UPDATED</li>
                      </ul>
                    </div>
                  </div>


                   <span class="badge badge-green date">27 Şubat 2019</span>
                   <div class="news-type-list">
                     <div class="news-type-list-item">
                       <div class="title blue">Yeni Tema</div>
                       <ul class="list">
                         <li class="list-item">Sitemizin Yeni Teması Yayında!</li>
                       </ul>
                     </div>
                     <div class="news-type-list-item">
                       <div class="title red">Yeni Ödeme Yöntemi</div>
                       <ul class="list">
                         <li class="list-item"> Yeni Tema İle Birlikte ,Perfect Money İle Ödeme Yöntemi  Aktif Edilmiştir</li>
                       </ul>
                     </div>
                 <div class="news-type-list-item">
                       <div class="title green">Tasarım</div>
                       <ul class="list">
                         <li class="list-item">Yeni Tasarım Mobil Uyumlu Hale Getirildi!</li>
                       </ul>
                     </div>
                   </div>



                </div>
			  </div>
            </div>
          </div>
        </div> <!-- drugi col-lg end -->

      </div> <!-- row end -->
    </div> <!-- container end -->

    <!--       <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="well ">
              <p></p><p></p><p style="text-align: center;"><b style="font-family: lato, latortl, sans-serif; font-size: 16px; white-space: pre-wrap;"><font color="#ff0000">Lütfen siparişlerinizde @ kullanmayınız</font></b><br></p><h5 style="text-align: center;"><b style="color: rgb(0, 0, 255); font-family: lato, latortl, sans-serif; font-size: 16px; white-space: pre-wrap;">Siparişiniz Sonuçlanmadan Başka Sitelerden Dahi Olsa 2.Ye Sipariş Girmeyin Bu İşlemin Telafisi </b><font face="lato, latortl, sans-serif" style="color: rgb(0, 0, 255);"><span style="font-size: 16px; white-space: pre-wrap;"><b>Bulunmamaktır</b></span></font><b style="font-family: lato, latortl, sans-serif; font-size: 16px; white-space: pre-wrap;"><font color="#0000ff">! </font><font color="#ff0000"><u>Bakiyeniz Yanar!</u> </font><font color="#0000ff"> Bu Durumla </font></b><b style="color: rgb(0, 0, 255); font-family: lato, latortl, sans-serif; font-size: 16px; white-space: pre-wrap;">İade </b><font color="#0000ff" face="lato, latortl, sans-serif"><span style="font-size: 16px; white-space: pre-wrap;"><b>Yapılmaz</b></span></font><b style="color: rgb(0, 0, 255); font-family: lato, latortl, sans-serif; font-size: 16px; white-space: pre-wrap;">!!!</b><span style="font-family: inherit; color: rgb(0, 0, 255);">&nbsp; &nbsp;</span></h5><h5 style="text-align: center;"><br></h5><h6 style="text-align: center; "><b style="color: inherit; font-family: inherit; font-size: 18px;">HER SERVİSİN BİR HESABA YA DA LİNKE ATABİLECEĞİ MAX MİKTAR,MİKTAR KISMINDA YAZMAKTADIR. BU MİKTARLAR TEK SEFERLİK DEĞİL YANİ MAX 5 K OLAN SERVİSTEN AYNI HESABA DEFALARCA&nbsp; 5 K ALIRIM DİYE DÜŞÜNMEYİN, SADECE 5 K ATAR BİR HESABA! BU HUSUSA DİKKAT&nbsp; EDİNİZ! MAX MİKTAR BİR HESABA 1 KERE ÇEKİLEBİLİR, AYNI SERVİSTEN SÜREKLİ GİRİŞ YAPARSANİZ <font color="#ff0000"><u>BAKİYENİZ YANAR!</u></font></b></h6><h3 style="text-align: center;"><font color="#ff0000">Instagram tarafından yapılan güncelleme dolayısıyla takipçi,beğeni ve izlenme servislerinde dünya geneli yavaşlama vardır. Bu sorun en kısa zamanda çözülecektir. Anlayışınız için Teşekkürler...</font></h3><h3 style="text-align: center;">&nbsp; &nbsp;&nbsp;</h3><p style="text-align: center;"><br></p><h4 style="text-align: start;"><div class="service-block__collapse-block" style="position: absolute; right: 10px; top: 11px; z-index: 3; font-size: 14px; color: rgb(51, 51, 51); text-align: start; background-color: rgba(255, 255, 255, 0.7);"></div></h4><p></p><h4 style="text-align: center;"></h4><p></p><h3></h3><p></p><center><p></p><p></p><p></p></center>
            </div>
          </div>
        </div>
      </div>
     -->
  </section>
</div>

<?php require_once("inc/footer.php"); ?>
