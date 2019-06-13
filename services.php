<?php require_once("inc/header.php"); ?>
<!-- Main variables *content* -->
<script>

  function isNotEmpty(val){
    return (val === undefined || val == null || val.length <= 0) ? false : true;
  }

  $(document).ready(function(){

    $(".service-description-split").each(function(){
      lines = $(this).html().split("<br>");

    index = $(this).attr('id');
    $(this).html('<div>' + lines.join("</div><div>") + '</div>');


    var i = 1;
      $(this).find('div').each(function(){
      if(i < 7) {
        $(this).addClass('split-class-'+i+"-"+index);
        i++;
      }else{
      $(this).addClass('split-class-'+index);
      }
    });




    var extraData = '';
    $('.split-class-'+index).each(function(){
    var info = $(this).text();

      var infoArr  = info.split(":");


      var infoStr = '';
        if(infoArr[0] == "Details"){
        if(isNotEmpty(infoArr[1])){
          infoStr = infoArr[1] + "<br>";
        }
        }else{
         infoStr = info + "<br>";
      }

      extraData = extraData + infoStr;
    })





    var splt1 = $( ".split-class-1-"+index ).text();
    var str1 = splt1.split(":");
  	console.log(str1);
    $(".quality-split-"+index).html(str1[1]);

    var splt2 = $( ".split-class-2-"+index ).text();
    var str2 = splt2.split(":");
    $( ".time-split-"+index ).html(str2[1]);

    var splt3 = $( ".split-class-3-"+index ).text();
    var str3 = splt3.split(":");
    $( ".speed-split-"+index ).html(str3[1]);

    var splt4 = $( ".split-class-4-"+index ).text();
    var str4 = splt4.split(":");
    $( ".minMax-split-"+index ).html(str4[1]);

    var splt5 = $( ".split-class-5-"+index ).text();
    var str5 = splt5.split(":");
    $( ".refill-split-"+index ).html(str5[1]);

    var splt6 = $( ".split-class-6-"+index ).text();
    var str6 = splt6.split(":");
    $( ".price-split-"+index ).html(str6[1]);

    //var splt7 = $( ".split-class-7-"+index ).text();
    //var str7 = splt7.split(":");
    $( ".details-split-"+index ).html(extraData);
    })
  });

  $(document).on("change","#orderform-service",function(){
  //Delay because else the value it was taking from the description was from the previous service chosen
  setTimeout(function() {
      UpdateDescription()
    }, 10)
  });


  $(document).on("change","#orderform-category",function(){
  //Delay because else the value it was taking from the description was from the previous service chosen
    setTimeout(function() {
      UpdateDescription()
    }, 10)
  });

  $(document).on("click",".cateSelect",function(){
    var dataCate = $(this).attr("data-category")

     $('.servie-data-panel').each(function(){
      if($(this).hasClass("active")){
      }else{
        $(this).hide();
      }
   });
    if($(this).hasClass("active")){
      $(this).removeClass("active");
      $("div[data-category='" + dataCate +"']").hide();
    }
    else{
      $(this).addClass("active");
      $("div[data-category='" + dataCate +"']").addClass("active");
      $("div[data-category='" + dataCate +"']").show();
    }
  });

   $(document).ready(function(){
    $('.social-title:contains("Instagram")').find('i').addClass('fab fa-instagram')
    $('.social-title:contains("Facebook")').find('i').addClass('fab fa-facebook')
    $('.social-title:contains("Twitter")').find('i').addClass('fab fa-twitter')
    $('.social-title:contains("Youtube")').find('i').addClass('fab fa-youtube')
   });



</script>

<script>
  $(document).ready(function(){
    $("#searchService").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $(".servie-data-panel tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>

<div class="inner-page">

  <section class="service-search-panel">
    <div class="container">
      <div class="card">
        <div class="card-body">

            <div class="dropdown">
              <a class="btn btn-green dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <i class="fa fa-filter"></i><span>Kategori Seç</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">

                                                           <?php
                                                               $category=$db->prepare("SELECT * FROM category where enable=:enable");
                                                                 $category->execute(array(
                                                                   'enable' => 1
                                                                 ));

                                                                 while($takeCategory=$category->fetch(PDO::FETCH_ASSOC)){ ?>
                                                                    <button type="button" class="dropdown-item cateSelect" data-category="<?php echo $takeCategory['name']; ?>"><?php echo $takeCategory['name']; ?></button>
                                                               <?php  }  ?>
                                            </div>
            </div>
         <!--   <span class="help-for-icons">
              <i class="fa fa-question-circle"></i>
              <div class="icons-panel card">
                <ul class="nav nav-pills">
                  <li class="active">
                    <a href="#tab-1-1" data-hover="tab" class="">⭐</a>
                  </li>
                  <li>
                    <a href="#tab-2-1" data-hover="tab" class="">⚡️</a>
                  </li>
                  <li>
                    <a href="#tab-3-1" data-hover="tab" class="">♻</a>
                  </li>
                  <li>
                    <a href="#tab-4-1" data-hover="tab" class="">🚫</a>
                  </li>
                  <li>
                    <a href="#tab-5-1" data-hover="tab" class=""><b>AR</b></a>
                  </li>
                  <li>
                    <a href="#tab-6-1" data-hover="tab" class=""><b>R30</b></a>
                  </li>
                  <li>
                    <a href="#tab-7-1" data-hover="tab" class=""><b>R60</b></a>
                  </li>
                  <li>
                    <a href="#tab-8-1" data-hover="tab" class=""><b>R∞</b></a>
                  </li>
                  <li>
                    <a href="#tab-9-1" data-hover="tab" class="active show">🚩</a>
                  </li>
                </ul>
                <div class="tab-content well">
                  <div class="tab-pane" id="tab-1-1">Best Service</div>
                  <div class="tab-pane" id="tab-2-1">Fast Start</div>
                  <div class="tab-pane" id="tab-3-1">Refill button</div>
                  <div class="tab-pane" id="tab-4-1">Cancel button</div>
                  <div class="tab-pane" id="tab-5-1">Auto-Refill</div>
                  <div class="tab-pane" id="tab-6-1">Refill 30 days</div>
                  <div class="tab-pane" id="tab-7-1">Refill 60 days</div>
                  <div class="tab-pane" id="tab-8-1">Lifetime Refill</div>
                  <div class="tab-pane active show" id="tab-9-1">Service Updating (Slow Start, Slow Delivery)</div>
                </div>
              </div>
            </span> -->
            <div class="search-panel">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Servis Ara" id="searchService">
                <span class="input-text">
                  <i class="fa fa-search"></i>
                </span>
              </div>
            </div>
        </div>
      </div>
    </div>
  </section>
  <!-- kraj filtera -->

  	<section>
      <div class="container-fluid">


        <?php
            $category=$db->prepare("SELECT * FROM category where enable=:enable");
              $category->execute(array(
                'enable' => 1
              ));

              while($takeCategory=$category->fetch(PDO::FETCH_ASSOC)){ ?>
                <div class="servie-data-panel" data-category="<?php echo $takeCategory['name']; ?>">
                  <div class="title social-title">
                    <i></i> <?php echo $takeCategory['name']; ?>
                          </div>
                  <div class="table-responsive-xl">
                    <table class="table table-striped  ">
                      <thead>
                      <tr>
                        <th scope="col">Servis No</th>
                        <th scope="col">Servis</th>
                        <th scope="col">1000 adet fiyatı (₺)</th>
                        <th scope="col">En Az Sipariş</th>
                        <th scope="col">En Çok Sipariş</th>
                                              <th class="hidden-xs hidden-sm width-40">Açıklama</th>
                                          </tr>
                      </thead>
                      <tbody>

                        <?php
                              $services=$db->prepare("SELECT * FROM services where category_id=:id");
                              $services->execute(array(
                                'id' => $takeCategory['id']
                              ));

                              while($takeService=$services->fetch(PDO::FETCH_ASSOC)){ ?>

                            <tr style="display; table-row;">
                            <td><?php echo $takeService['id']; ?></td>
                            <td><?php echo $takeService['name']; ?></td>
                            <td><span class="badge">₺ <?php echo $takeService['money']; ?></span></td>
                            <td><span class="badge" style="background:#4ede80; color: #fff"><?php echo $takeService['min']; ?></span></td>
                            <td><span class="badge" style="background:#2272d6; color: #fff"><?php echo $takeService['max']; ?></span></td>
                                                      <!-- <td class="hidden-xs hidden-sm service-description">⛔⛔⛔GÜNCEL VE ÖNEMLİ BİLDİRİMLER İÇİN SAĞ ALT KÖŞEDE BULUNAN BUTONA TIKLAYINIZ⛔⛔⛔<br>✅Sipariş Sonuçlanmadan Başka Sitelerden Bile Olsa! 2.Sipariş Girmeyin!  Bu İşlemin Telafisi YOK!<br>✅Girilen Siparişlerin İptali Yoktur. Lütfen Bu Konuda Destek Talebi Oluşturmayınız.<br>✅Parça gönderimlerde en az 30 dakika aralık verin aksi taktirde çakışma yaşanabilir ve bakiyeniz boşuna gider <br>✅Fiyatlar 1000 adet için geçerlidir<br>✅Her servisin bir hesaba ya da linke atabileceği maksimum miktar yanlarında belirtilmiştir, bu miktarları aşmayın! <br>⛔ Aylık oto beğeni paketlerindeki açıklamayı mutlaka okuyun!<br>⛔Sipariş girmeden önce seçtiğiniz servisin altında yazan açıklamayı okuyun!</td> -->
                            <td>
                              <a href="javascript:void(0)" class="btn btn-blue icon" data-toggle="modal" data-target="#serviceDetails<?php echo $takeService['id']; ?>">
                            	   <i class="fa fa-eye" style="margin-top:6px"></i>
                              </a>
                              <!-- Modal -->
                              <div class="modal fade" id="serviceDetails<?php echo $takeService['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $takeService['name']; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body text-left">
                                      <?php echo $takeService['description']; ?>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-blue" data-dismiss="modal">KAPAT</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            </td>
                          </tr> <?php } ?> <!--<tr class="visible-xs visible-sm service-description">
                                <td colspan="5">⛔⛔⛔GÜNCEL VE ÖNEMLİ BİLDİRİMLER İÇİN SAĞ ALT KÖŞEDE BULUNAN BUTONA TIKLAYINIZ⛔⛔⛔<br>✅Sipariş Sonuçlanmadan Başka Sitelerden Bile Olsa! 2.Sipariş Girmeyin!  Bu İşlemin Telafisi YOK!<br>✅Girilen Siparişlerin İptali Yoktur. Lütfen Bu Konuda Destek Talebi Oluşturmayınız.<br>✅Parça gönderimlerde en az 30 dakika aralık verin aksi taktirde çakışma yaşanabilir ve bakiyeniz boşuna gider <br>✅Fiyatlar 1000 adet için geçerlidir<br>✅Her servisin bir hesaba ya da linke atabileceği maksimum miktar yanlarında belirtilmiştir, bu miktarları aşmayın! <br>⛔ Aylık oto beğeni paketlerindeki açıklamayı mutlaka okuyun!<br>⛔Sipariş girmeden önce seçtiğiniz servisin altında yazan açıklamayı okuyun!</td>
                              </tr> -->




                              </tbody>
                    </table>
          		  </div> <!-- kraj table -->

            	</div>
            <?php  }  ?>




          	              </div>
	</section>
</div>


<?php require_once("inc/footer.php"); ?>
