function saveSettings(){

  document.getElementById("dangerSetting").style.display = "none";
  document.getElementById("successSetting").style.display = "none";

  var url = document.getElementById('url').value;
  var title = document.getElementById('title').value;
  var slogan = document.getElementById('slogan').value;
  var description = document.getElementById('description').value;
  var keywords = document.getElementById('keywords').value;
  var copyright = document.getElementById('copyright').value;
  var mail = document.getElementById('mail').value;
  var face_text = document.getElementById('face_text').value;
  var insta_text = document.getElementById('insta_text').value;
  var notice = CKEDITOR.instances['notice'].getData();
  var kul_kos = CKEDITOR.instances['kul_kos'].getData();
  var iade_kos = CKEDITOR.instances['iade_kos'].getData();
  var giz_pol = CKEDITOR.instances['giz_pol'].getData();
  var headerCode = CKEDITOR.instances['header'].getData();

  var dataType = 'saveSettings';

  $.ajax({
    url: 'progress/ajax.php',
    type: 'POST',
    data: {
      title:title,
      slogan:slogan,
      description:description,
      keywords:keywords,
      url:url,
      copyright:copyright,
      mail:mail,
      face_text:face_text,
      insta_text:insta_text,
      header:headerCode,
      notice:notice,
      kul_kos:kul_kos,
      iade_kos:iade_kos,
      giz_pol:giz_pol,
      dataType: dataType
    },
  }).done(function(response) {
    //response
    var obj = JSON.parse(response);
    if(obj['stats']=='ok'){
      document.getElementById("successSetting").style.display = "block";
      document.getElementById("successSetting").innerText = "Ayarlarınız değiştirildi...";
      setTimeout(function() {
        window.location.reload();
      }, 3000);
    }else{
      document.getElementById("dangerSetting").style.display = "block";
      document.getElementById("dangerSetting").innerText = "Başarısız! Lütfen tekrar deneyin!";
    }
    document.getElementById("goToSetting").scrollIntoView();
  });

}

function getServices(selectedObject){

  var cat_id = selectedObject.value;

  $.ajax({
    url: 'inc/servicesAjax.php',
    type: 'POST',
    data: {
      cat_id:cat_id
    },
  }).done(function(response) {
    //response
      document.getElementById("rowCont").innerHTML = response;
  });

}

function saveCategory(){

  document.getElementById("dangerCategory").style.display = "none";
  document.getElementById("successCategory").style.display = "none";


  if(document.getElementById('name').value.trim()==''){
    document.getElementById("dangerCategory").style.display = "block";
    document.getElementById("dangerCategory").innerText = "Kategori Adı boş bırakılamaz...";
    return;
  }

  if(document.getElementById('status').value == 0 || document.getElementById('status').value == 1){

      var name = document.getElementById('name').value;
      var status = document.getElementById('status').value;
      var id = document.getElementById('cat_id').value;
      var dataType = 'saveCategory';

      $.ajax({
        url: 'progress/ajax.php',
        type: 'POST',
        data: {
          name:name,
          status:status,
          id:id,
          dataType: dataType
        },
      }).done(function(response) {
        //response
        var obj = JSON.parse(response);
        if(obj['stats']=='ok'){
          document.getElementById("successCategory").style.display = "block";
          document.getElementById("successCategory").innerText = "Ayarlarınız değiştirildi...";
          setTimeout(function() {
            window.location.reload();
          }, 3000);
        }else{
          document.getElementById("dangerCategory").style.display = "block";
          document.getElementById("dangerCategory").innerText = "Başarısız! Lütfen tekrar deneyin!";
        }
      });

  }else{
    document.getElementById("dangerCategory").style.display = "block";
    document.getElementById("dangerCategory").innerText = "Kodlarla oynama :)";
    return;
  }

}

function saveService(){

  document.getElementById("dangerService").style.display = "none";
  document.getElementById("successService").style.display = "none";


  if(document.getElementById('name').value.trim()==''){
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Kategori Adı boş bırakılamaz...";
    return;
  }

  if(document.getElementById('description').value.trim()==''){
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Açıklama boş bırakılamaz...";
    return;
  }

  if(document.getElementById('money').value.trim()=='' || document.getElementById('money').value == 0){
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Fiyat 0 olamaz veya boş bırakılamaz...";
    return;
  }

  if(document.getElementById('min').value.trim()=='' || document.getElementById('min').value == 0){
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Minimum 0 olamaz veya boş bırakılamaz...";
    return;
  }

  if(document.getElementById('max').value.trim()=='' || document.getElementById('max').value == 0){
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Maksimum 0 olamaz veya boş bırakılamaz...";
    return;
  }


  if(document.getElementById('status').value == 0 || document.getElementById('status').value == 1){

      var name = document.getElementById('name').value;
      var status = document.getElementById('status').value;
      var id = document.getElementById('service_id').value;
      var category_id = document.getElementById('category').value;
      var description = CKEDITOR.instances['description'].getData();
      var money = document.getElementById('money').value;
      var min = document.getElementById('min').value;
      var max = document.getElementById('max').value;


      var dataType = 'saveService';

      $.ajax({
        url: 'progress/ajax.php',
        type: 'POST',
        data: {
          name:name,
          status:status,
          cat_id:category_id,
          id:id,
          description:description,
          money:money,
          min:min,
          max:max,
          dataType: dataType
        },
      }).done(function(response) {
        //response
        var obj = JSON.parse(response);
        if(obj['stats']=='ok'){
          document.getElementById("successService").style.display = "block";
          document.getElementById("successService").innerText = "Ayarlarınız değiştirildi...";
          setTimeout(function() {
            window.location.reload();
          }, 3000);
        }else if(obj['stats']=='no'){
          document.getElementById("dangerService").style.display = "block";
          document.getElementById("dangerService").innerText = "Başarısız! Lütfen tekrar deneyin!";
        }else if(obj['stats']=='mm'){
          document.getElementById("dangerService").style.display = "block";
          document.getElementById("dangerService").innerText = "Maksimum, minimumdan küçük yada eşit olamaz...";
        }
        document.getElementById("respon").scrollIntoView();
      });

  }else{
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Kodlarla oynama :)";
    document.getElementById("respon").scrollIntoView();
    return;
  }

}



function savePayment(){

  document.getElementById("dangerPayment").style.display = "none";
  document.getElementById("successPayment").style.display = "none";

  var paywant = document.getElementById('paywantCheck').checked;
  var shopier = document.getElementById('shopierCheck').checked;
  var transfer = document.getElementById('transferCheck').checked;
  var dataType = 'savePayment';
  if(paywant){
    paywant=1;
  }else{
    paywant=0;
  }

  if(shopier){
    shopier=1;
  }else{
    shopier=0;
  }

  if(transfer){
    transfer=1;
  }else{
    transfer=0;
  }

  $.ajax({
    url: 'progress/ajax.php',
    type: 'POST',
    data: {
      paywant:paywant,
      shopier:shopier,
      transfer:transfer,
      dataType: dataType
    },
  }).done(function(response) {
    //response
    var obj = JSON.parse(response);
    if(obj['stats']=='ok'){
      document.getElementById("successPayment").style.display = "block";
      document.getElementById("successPayment").innerText = "Ayarlarınız değiştirildi...";
      setTimeout(function() {
        window.location.reload();
      }, 3000);
    }else{
      document.getElementById("dangerPayment").style.display = "block";
      document.getElementById("dangerPayment").innerText = "Başarısız! Lütfen tekrar deneyin!";
    }
    document.getElementById("goToPayment").scrollIntoView();
  });

}


function saveMail(){

  document.getElementById("dangerMail").style.display = "none";
  document.getElementById("successMail").style.display = "none";

  var server = document.getElementById('server').value;
  var username_mail = document.getElementById('username_mail').value;
  var password_mail = document.getElementById('password_mail').value;
  var port = document.getElementById('port').value;


  var dataType = 'saveMail';

  $.ajax({
    url: 'progress/ajax.php',
    type: 'POST',
    data: {
      server:server,
      username_mail:username_mail,
      password_mail:password_mail,
      port:port,
      dataType: dataType
    },
  }).done(function(response) {
    //response
    var obj = JSON.parse(response);
    if(obj['stats']=='ok'){
      document.getElementById("successMail").style.display = "block";
      document.getElementById("successMail").innerText = "Ayarlarınız değiştirildi...";
      setTimeout(function() {
        window.location.reload();
      }, 3000);
    }else{
      document.getElementById("dangerMail").style.display = "block";
      document.getElementById("dangerMail").innerText = "Başarısız! Lütfen tekrar deneyin!";
    }
    document.getElementById("goToMail").scrollIntoView();
  });

}
