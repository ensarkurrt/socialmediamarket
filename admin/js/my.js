function saveSettings() {

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
      title: title,
      slogan: slogan,
      description: description,
      keywords: keywords,
      url: url,
      copyright: copyright,
      mail: mail,
      face_text: face_text,
      insta_text: insta_text,
      header: headerCode,
      notice: notice,
      kul_kos: kul_kos,
      iade_kos: iade_kos,
      giz_pol: giz_pol,
      dataType: dataType
    },
  }).done(function(response) {
    //response
    var obj = JSON.parse(response);
    if (obj['stats'] == 'ok') {
      document.getElementById("successSetting").style.display = "block";
      document.getElementById("successSetting").innerText = "Ayarlarınız değiştirildi...";
      setTimeout(function() {
        window.location.reload();
      }, 3000);
    } else {
      document.getElementById("dangerSetting").style.display = "block";
      document.getElementById("dangerSetting").innerText = "Başarısız! Lütfen tekrar deneyin!";
    }
    document.getElementById("goToSetting").scrollIntoView();
  });

}

function getServices(selectedObject) {

  var cat_id = selectedObject.value;

  $.ajax({
    url: 'inc/servicesAjax.php',
    type: 'POST',
    data: {
      cat_id: cat_id
    },
  }).done(function(response) {
    //response
    document.getElementById("rowCont").innerHTML = response;
  });

}


function addShopierLink() {

  document.getElementById("dangerShopier").style.display = "none";
  document.getElementById("successShopier").style.display = "none";


  if (document.getElementById('cost').value == 0 || document.getElementById('cost').value.trim() == '') {
    document.getElementById("dangerShopier").style.display = "block";
    document.getElementById("dangerShopier").innerText = "Tutar 0 olamaz yada boş bırakılamaz";
    return;
  }

  if (document.getElementById('link_id').value == 0 || document.getElementById('link_id').value.trim() == '') {
    document.getElementById("dangerShopier").style.display = "block";
    document.getElementById("dangerShopier").innerText = "Link id olamaz yada boş bırakılamaz";
    return;
  }


  var cost = document.getElementById('cost').value;
  var link_id = document.getElementById('link_id').value;
  var dataType = 'addShopierLink';

  $.ajax({
    url: 'progress/ajax.php',
    type: 'POST',
    data: {
      cost: cost,
      link_id: link_id,
      dataType: dataType
    },
  }).done(function(response) {
    //response
    var obj = JSON.parse(response);
    if (obj['stats'] == 'ok') {
      document.getElementById("successShopier").style.display = "block";
      document.getElementById("successShopier").innerText = "Link ekleme başarılı...";
      setTimeout(function() {
        window.location.reload();
      }, 3000);
    } else {
      document.getElementById("dangerShopier").style.display = "block";
      document.getElementById("dangerShopier").innerText = "Başarısız! Lütfen tekrar deneyin!";
    }
  });

}



function addCategory() {

  document.getElementById("dangerCategory").style.display = "none";
  document.getElementById("successCategory").style.display = "none";


  if (document.getElementById('name').value.trim() == '') {
    document.getElementById("dangerCategory").style.display = "block";
    document.getElementById("dangerCategory").innerText = "Kategori Adı boş bırakılamaz...";
    return;
  }

  if (document.getElementById('status').value == 0 || document.getElementById('status').value == 1) {

    var name = document.getElementById('name').value;
    var status = document.getElementById('status').value;
    var dataType = 'addCategory';

    $.ajax({
      url: 'progress/ajax.php',
      type: 'POST',
      data: {
        name: name,
        status: status,
        dataType: dataType
      },
    }).done(function(response) {
      //response
      var obj = JSON.parse(response);
      if (obj['stats'] == 'ok') {
        document.getElementById("successCategory").style.display = "block";
        document.getElementById("successCategory").innerText = "Kategori ekleme başarılı...";
        setTimeout(function() {
          window.location.reload();
        }, 3000);
      } else {
        document.getElementById("dangerCategory").style.display = "block";
        document.getElementById("dangerCategory").innerText = "Başarısız! Lütfen tekrar deneyin!";
      }
    });

  } else {
    document.getElementById("dangerCategory").style.display = "block";
    document.getElementById("dangerCategory").innerText = "Kodlarla oynama :)";
    return;
  }

}

function addBankAccount() {

  document.getElementById("dangerShopier").style.display = "none";
  document.getElementById("successShopier").style.display = "none";


  if (document.getElementById('name').value.trim() == '') {
    document.getElementById("dangerShopier").style.display = "block";
    document.getElementById("dangerShopier").innerText = "Hesap adı boş bırakılamaz...";
    return;
  }

  if (CKEDITOR.instances['description'].getData().trim() == '') {
    document.getElementById("dangerShopier").style.display = "block";
    document.getElementById("dangerShopier").innerText = "Açıklama boş bırakılamaz...";
    return;
  }


    var name = document.getElementById('name').value;
    var description = CKEDITOR.instances['description'].getData();
    var dataType = 'addBankAccount';

    $.ajax({
      url: 'progress/ajax.php',
      type: 'POST',
      data: {
        name: name,
        description: description,
        dataType: dataType
      },
    }).done(function(response) {
      //response
      var obj = JSON.parse(response);
      if (obj['stats'] == 'ok') {
        document.getElementById("successShopier").style.display = "block";
        document.getElementById("successShopier").innerText = "Banka hesabı ekleme başarılı...";
        setTimeout(function() {
          window.location.reload();
        }, 3000);
      } else {
        document.getElementById("dangerShopier").style.display = "block";
        document.getElementById("dangerShopier").innerText = "Başarısız! Lütfen tekrar deneyin!";
      }
    });


}

function saveBankAccount() {

  document.getElementById("dangerShopier").style.display = "none";
  document.getElementById("successShopier").style.display = "none";


  if (document.getElementById('name').value.trim() == '') {
    document.getElementById("dangerShopier").style.display = "block";
    document.getElementById("dangerShopier").innerText = "Banka adı boş bırakılamaz";
    return;
  }

  if (CKEDITOR.instances['description'].getData().trim() == '') {
    document.getElementById("dangerShopier").style.display = "block";
    document.getElementById("dangerShopier").innerText = "Açıklama boş bırakılamaz";
    return;
  }


  var name = document.getElementById('name').value;
  var description = CKEDITOR.instances['description'].getData();
  var data_id = document.getElementById('data_id').value;
  var dataType = 'saveBankAccount';

  $.ajax({
    url: 'progress/ajax.php',
    type: 'POST',
    data: {
      name: name,
      description: description,
      data_id: data_id,
      dataType: dataType
    },
  }).done(function(response) {
    //response
    var obj = JSON.parse(response);
    if (obj['stats'] == 'ok') {
      document.getElementById("successShopier").style.display = "block";
      document.getElementById("successShopier").innerText = "Banka hesabı düzenleme başarılı...";
      setTimeout(function() {
        window.location.reload();
      }, 3000);
    } else {
      document.getElementById("dangerShopier").style.display = "block";
      document.getElementById("dangerShopier").innerText = "Başarısız! Lütfen tekrar deneyin!";
    }
  });


}

function saveShopierLink() {

  document.getElementById("dangerShopier").style.display = "none";
  document.getElementById("successShopier").style.display = "none";


  if (document.getElementById('cost').value == 0 || document.getElementById('cost').value.trim() == '') {
    document.getElementById("dangerShopier").style.display = "block";
    document.getElementById("dangerShopier").innerText = "Tutar 0 olamaz yada boş bırakılamaz";
    return;
  }

  if (document.getElementById('link_id').value == 0 || document.getElementById('link_id').value.trim() == '') {
    document.getElementById("dangerShopier").style.display = "block";
    document.getElementById("dangerShopier").innerText = "Link id olamaz yada boş bırakılamaz";
    return;
  }


  var cost = document.getElementById('cost').value;
  var link_id = document.getElementById('link_id').value;
  var data_id = document.getElementById('data_id').value;
  var dataType = 'saveShopierLink';

  $.ajax({
    url: 'progress/ajax.php',
    type: 'POST',
    data: {
      cost: cost,
      link_id: link_id,
      data_id: data_id,
      dataType: dataType
    },
  }).done(function(response) {
    //response
    var obj = JSON.parse(response);
    if (obj['stats'] == 'ok') {
      document.getElementById("successShopier").style.display = "block";
      document.getElementById("successShopier").innerText = "Link düzenleme başarılı...";
      setTimeout(function() {
        window.location.reload();
      }, 3000);
    } else {
      document.getElementById("dangerShopier").style.display = "block";
      document.getElementById("dangerShopier").innerText = "Başarısız! Lütfen tekrar deneyin!";
    }
  });


}


function saveCategory() {

  document.getElementById("dangerCategory").style.display = "none";
  document.getElementById("successCategory").style.display = "none";


  if (document.getElementById('name').value.trim() == '') {
    document.getElementById("dangerCategory").style.display = "block";
    document.getElementById("dangerCategory").innerText = "Kategori Adı boş bırakılamaz...";
    return;
  }

  if (document.getElementById('status').value == 0 || document.getElementById('status').value == 1) {

    var name = document.getElementById('name').value;
    var status = document.getElementById('status').value;
    var id = document.getElementById('cat_id').value;
    var dataType = 'saveCategory';

    $.ajax({
      url: 'progress/ajax.php',
      type: 'POST',
      data: {
        name: name,
        status: status,
        id: id,
        dataType: dataType
      },
    }).done(function(response) {
      //response
      var obj = JSON.parse(response);
      if (obj['stats'] == 'ok') {
        document.getElementById("successCategory").style.display = "block";
        document.getElementById("successCategory").innerText = "Ayarlarınız değiştirildi...";
        setTimeout(function() {
          window.location.reload();
        }, 3000);
      } else {
        document.getElementById("dangerCategory").style.display = "block";
        document.getElementById("dangerCategory").innerText = "Başarısız! Lütfen tekrar deneyin!";
      }
    });

  } else {
    document.getElementById("dangerCategory").style.display = "block";
    document.getElementById("dangerCategory").innerText = "Kodlarla oynama :)";
    return;
  }

}

function saveService() {

  document.getElementById("dangerService").style.display = "none";
  document.getElementById("successService").style.display = "none";


  if (document.getElementById('name').value.trim() == '') {
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Servis Adı boş bırakılamaz...";
    return;
  }

  if (CKEDITOR.instances['description'].getData().trim() == '') {
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Açıklama boş bırakılamaz...";
    return;
  }

  if (document.getElementById('money').value.trim() == '' || document.getElementById('money').value == 0) {
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Fiyat 0 olamaz veya boş bırakılamaz...";
    return;
  }

  if (document.getElementById('min').value.trim() == '' || document.getElementById('min').value == 0) {
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Minimum 0 olamaz veya boş bırakılamaz...";
    return;
  }

  if (document.getElementById('max').value.trim() == '' || document.getElementById('max').value == 0) {
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Maksimum 0 olamaz veya boş bırakılamaz...";
    return;
  }


  if (document.getElementById('status').value == 0 || document.getElementById('status').value == 1) {

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
        name: name,
        status: status,
        cat_id: category_id,
        id: id,
        description: description,
        money: money,
        min: min,
        max: max,
        dataType: dataType
      },
    }).done(function(response) {
      //response
      var obj = JSON.parse(response);
      if (obj['stats'] == 'ok') {
        document.getElementById("successService").style.display = "block";
        document.getElementById("successService").innerText = "Ayarlarınız değiştirildi...";
        setTimeout(function() {
          window.location.reload();
        }, 3000);
      } else if (obj['stats'] == 'no') {
        document.getElementById("dangerService").style.display = "block";
        document.getElementById("dangerService").innerText = "Başarısız! Lütfen tekrar deneyin!";
      } else if (obj['stats'] == 'mm') {
        document.getElementById("dangerService").style.display = "block";
        document.getElementById("dangerService").innerText = "Maksimum, minimumdan küçük yada eşit olamaz...";
      }
      document.getElementById("respon").scrollIntoView();
    });

  } else {
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Kodlarla oynama :)";
    document.getElementById("respon").scrollIntoView();
    return;
  }

}

function addService() {

  document.getElementById("dangerService").style.display = "none";
  document.getElementById("successService").style.display = "none";


  if (document.getElementById('name').value.trim() == '') {
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Servis Adı boş bırakılamaz...";
    return;
  }

  if (CKEDITOR.instances['description'].getData().trim() == '') {
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Açıklama boş bırakılamaz...";
    return;
  }

  if (document.getElementById('money').value.trim() == '' || document.getElementById('money').value == 0) {
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Fiyat 0 olamaz veya boş bırakılamaz...";
    return;
  }

  if (document.getElementById('min').value.trim() == '' || document.getElementById('min').value == 0) {
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Minimum 0 olamaz veya boş bırakılamaz...";
    return;
  }

  if (document.getElementById('max').value.trim() == '' || document.getElementById('max').value == 0) {
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Maksimum 0 olamaz veya boş bırakılamaz...";
    return;
  }


  if (document.getElementById('status').value == 0 || document.getElementById('status').value == 1) {

    var name = document.getElementById('name').value;
    var status = document.getElementById('status').value;
    var category_id = document.getElementById('category').value;
    var description = CKEDITOR.instances['description'].getData();
    var money = document.getElementById('money').value;
    var min = document.getElementById('min').value;
    var max = document.getElementById('max').value;


    var dataType = 'addService';

    $.ajax({
      url: 'progress/ajax.php',
      type: 'POST',
      data: {
        name: name,
        status: status,
        cat_id: category_id,
        description: description,
        money: money,
        min: min,
        max: max,
        dataType: dataType
      },
    }).done(function(response) {
      //response
      var obj = JSON.parse(response);
      if (obj['stats'] == 'ok') {
        document.getElementById("successService").style.display = "block";
        document.getElementById("successService").innerText = "Servis ekleme başarılı...";
        setTimeout(function() {
          window.location.reload();
        }, 3000);
      } else if (obj['stats'] == 'no') {
        document.getElementById("dangerService").style.display = "block";
        document.getElementById("dangerService").innerText = "Başarısız! Lütfen tekrar deneyin!";
      } else if (obj['stats'] == 'mm') {
        document.getElementById("dangerService").style.display = "block";
        document.getElementById("dangerService").innerText = "Maksimum, minimumdan küçük yada eşit olamaz...";
      }
      document.getElementById("respon").scrollIntoView();
    });

  } else {
    document.getElementById("dangerService").style.display = "block";
    document.getElementById("dangerService").innerText = "Kodlarla oynama :)";
    document.getElementById("respon").scrollIntoView();
    return;
  }

}



function savePayment() {

  document.getElementById("dangerPayment").style.display = "none";
  document.getElementById("successPayment").style.display = "none";

  var paywant = document.getElementById('paywantCheck').checked;
  var paywant_desc = CKEDITOR.instances['paywant_desc'].getData();
  var shopier = document.getElementById('shopierCheck').checked;
  var shopier_desc = CKEDITOR.instances['shopier_desc'].getData();
  var transfer = document.getElementById('transferCheck').checked;
  var pay_desc = CKEDITOR.instances['pay_desc'].getData();



  var dataType = 'savePayment';

  if (paywant) {
    paywant = 1;
    if (CKEDITOR.instances['paywant_desc'].getData().trim() == '') {
      document.getElementById("dangerPayment").style.display = "block";
      document.getElementById("dangerPayment").innerText = "Paywant Ödeme Açıklamasını Boş Bırakmayın!";
      return;
    }
  } else {
    paywant = 0;
  }

  if (shopier) {
    shopier = 1;
    if (CKEDITOR.instances['shopier_desc'].getData().trim() == '') {
      document.getElementById("dangerPayment").style.display = "block";
      document.getElementById("dangerPayment").innerText = "Shopier Ödeme Açıklamasını Boş Bırakmayın!";
      return;
    }
  } else {
    shopier = 0;
  }

  if (transfer) {
    transfer = 1;
  } else {
    transfer = 0;
  }

  $.ajax({
    url: 'progress/ajax.php',
    type: 'POST',
    data: {
      paywant: paywant,
      shopier: shopier,
      transfer: transfer,
      paywant_desc: paywant_desc,
      shopier_desc: shopier_desc,
      pay_desc: pay_desc,
      dataType: dataType
    },
  }).done(function(response) {
    //response
    var obj = JSON.parse(response);
    if (obj['stats'] == 'ok') {
      document.getElementById("successPayment").style.display = "block";
      document.getElementById("successPayment").innerText = "Ayarlarınız değiştirildi...";
      setTimeout(function() {
        window.location.reload();
      }, 3000);
    } else {
      document.getElementById("dangerPayment").style.display = "block";
      document.getElementById("dangerPayment").innerText = "Başarısız! Lütfen tekrar deneyin!";
    }
    document.getElementById("goToPayment").scrollIntoView();
  });

}


function saveMail() {

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
      server: server,
      username_mail: username_mail,
      password_mail: password_mail,
      port: port,
      dataType: dataType
    },
  }).done(function(response) {
    //response
    var obj = JSON.parse(response);
    if (obj['stats'] == 'ok') {
      document.getElementById("successMail").style.display = "block";
      document.getElementById("successMail").innerText = "Ayarlarınız değiştirildi...";
      setTimeout(function() {
        window.location.reload();
      }, 3000);
    } else {
      document.getElementById("dangerMail").style.display = "block";
      document.getElementById("dangerMail").innerText = "Başarısız! Lütfen tekrar deneyin!";
    }
    document.getElementById("goToMail").scrollIntoView();
  });

}
