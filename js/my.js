var money = 0;
var service = 0;
var count = 0;
var min = 0;
var max = 0;
var cost = 0;

var ticketSubject = 'Sipariş';

function getComboA(selectObject) {
  var value = selectObject.value;
  var dataType = "services";
  if (value != 0) {
    $.ajax({
      url: 'progress/ajax.php',
      type: 'POST',
      data: {
        value: value,
        dataType: dataType
      },
    }).done(function(response) {
      //response
      var obj = JSON.parse(response);

      $("#service").html("");
      var htmlCode = " ";
      for (var i = 0; i < obj.length; i++) {
        htmlCode += "<option value='" + obj[i]['id'] + "'>" + obj[i]['name'] + "</option>";
      }
      $("#desc").html(obj[0]['description']);
      service = obj[0]['id'];
      money = obj[0]['money'];
      min = obj[0]['min'];
      max = obj[0]['max'];
      $("#service").html(htmlCode);
      $("#info").html("Min: " + min + " - Max: " + max);
      calculateCost();
    });
  }

}

function getComboDesc(selectObject) {
  var value = selectObject.value;
  var dataType = "desc";

  $.ajax({
    url: 'progress/ajax.php',
    type: 'POST',
    data: {
      value: value,
      dataType: dataType
    },
  }).done(function(response) {
    //response
    var obj = JSON.parse(response);
    $("#desc").html(obj['description']);
    service = obj['id'];
    money = obj['money'];
    min = obj['min'];
    max = obj['max'];
    $("#info").html("Min: " + min + " - Max: " + max);
    calculateCost();
  });


}

function calculateCost() {
  document.getElementById("danger").style.display = "none";
  document.getElementById("success").style.display = "none";
  count = document.getElementById("count").value.trim();
  if (service != 0) {
    if (count != 0) {
      var p = money / 1000;
      cost = p * count;
      document.getElementById("costMy").setAttribute('value', cost);

    }
  }
}

function newOrder() {

  calculateCost();
  var dataType = "newOrder";
  var link = document.getElementById("link").value.trim();
  document.getElementById("success").style.display = "none";
  document.getElementById("danger").style.display = "none";

  if (count == "") {
    //count cant be empty
    document.getElementById("danger").style.display = "block";
    document.getElementById("danger").innerText = "Adet sayısı boş bırakılamaz";
    return;
  }

  if (count == 0) {
    //count cant be 0
    document.getElementById("danger").style.display = "block";
    document.getElementById("danger").innerText = "Adet sayısı 0 olamaz";

    return;
  }
  if (service == 0) {
    //doesnt choose service
    document.getElementById("danger").style.display = "block";
    document.getElementById("danger").innerText = "Öncelikle servis seçmelisiniz";
    return;
  }
  if (link.trim() == "") {
    //empty link input
    document.getElementById("danger").style.display = "block";
    document.getElementById("danger").innerText = "Link kısmı boş bırakılamaz";
    return;
  }

  if (cost == 0) {
    //empty link input
    document.getElementById("danger").style.display = "block";
    document.getElementById("danger").innerText = "Tutar 0 olamaz";
    return;
  }

  //there is no danger
  $.ajax({
    url: 'progress/ajax.php',
    type: 'POST',
    data: {
      dataType: dataType,
      service: service,
      count: count,
      cost: cost,
      link: link,
      min: min,
      max: max
    },
  }).done(function(response) {
    //response

    if (response.trim() == "ok") {
      document.getElementById("success").style.display = "block";
      setTimeout(function() {
        window.location.reload();
      }, 3000);
    } else if (response.trim() == "no") {
      document.getElementById("danger").style.display = "block";
      document.getElementById("danger").innerText = "İşlem başarısız. Lütfen daha sonra tekrar deneyin";
      setTimeout(function() {
        window.location.reload();
      }, 3000);
    } else if (response.trim() == "max") {
      document.getElementById("danger").style.display = "block";
      document.getElementById("danger").innerText = "Bu servis için maksimum " + max + " adet sipariş verebilirsiniz";
    } else if (response.trim() == "min") {
      document.getElementById("danger").style.display = "block";
      document.getElementById("danger").innerText = "Bu servis için minimum " + min + " adet sipariş verebilirsiniz";
    } else if (response.trim() == "yb") {
      document.getElementById("danger").style.display = "block";
      document.getElementById("danger").innerText = "Yetersiz bakiye!";
    }


  });
}

function chooseBankFunc(selectObject) {
  var value = selectObject.value;
  var dataType = "getBankDesc";

  $.ajax({
    url: 'progress/ajax.php',
    type: 'POST',
    data: {
      value: value,
      dataType: dataType
    },
  }).done(function(response) {
    //response
    var obj = JSON.parse(response);
    $("#transfer_content").html(obj['description']);
  });

}

function transferPay() {
  document.getElementById("success").style.display = "none";
  document.getElementById("danger1").style.display = "none";
  var bankId = document.getElementById("chooseBank").value;
  var amount = document.getElementById("transferAmount").value;
  var dataType = "transferPay";

  $.ajax({
    url: 'progress/ajax.php',
    type: 'POST',
    data: {
      value: bankId,
      amount: amount,
      dataType: dataType
    },
  }).done(function(response) {
    //response
    var obj = JSON.parse(response);
    if (obj['stats'] == "ok") {
      document.getElementById("success").style.display = "block";
      document.getElementById("success").innerText = "Ödeme Bildirimi Başarılı! Takip Numaranız : #" + obj['number'] + ". Not almayı unutmayınız!";
    } else if (obj['stats'] == "no") {
      document.getElementById("danger1").style.display = "block";
      document.getElementById("danger1").innerText = "Bildirim yapılamadı! Lütfen daha sonra tekrar deneyin...";
    }
  });
}

function paywantPay() {
  var value = document.getElementById("paywantAmount").value;
  document.getElementById("danger").style.display = "none";
  if (value < 5) {
    document.getElementById("danger").style.display = "block";
    document.getElementById("danger").innerText = "Minimum 5 TL Bakiye yükleyebilirsiniz";
    return;
  }

  if (value > 900) {
    document.getElementById("danger").style.display = "block";
    document.getElementById("danger").innerText = "Maksimum 900 TL Bakiye yükleyebilirsiniz";
    return;
  }
}

function shopierPay() {
  var id = document.getElementById("amountShopier").value;
  var link = "https://www.shopier.com/ShowProductNew/products.php?id=" + id;

  window.open(link, '_blank');
}

function changePass() {

  document.getElementById("danger").style.display = "none";
  document.getElementById("success").style.display = "none";


  var currentPass = document.getElementById("currentPass").value;
  var newPass = document.getElementById("newPass").value;
  var confirmPass = document.getElementById("confirmPass").value;

  if (newPass.trim() == "" || confirmPass.trim() == "") {
    document.getElementById("danger").style.display = "block";
    document.getElementById("danger").innerText = "Yeni şifre alanlarını doldurmalısınız";
    return;
  }
  if (newPass.length < 8) {
    document.getElementById("danger").style.display = "block";
    document.getElementById("danger").innerText = "Şifreniz minimum 8 karakter uzunluğunda olmalıdır";
    return;
  }

  if (newPass.trim() == confirmPass.trim()) {

    var dataType = "changePass";

    $.ajax({
      url: 'progress/ajax.php',
      type: 'POST',
      data: {
        value: newPass,
        currentPass: currentPass,
        dataType: dataType
      },
    }).done(function(response) {
      //response
      var obj = JSON.parse(response);
      if (obj['stats'] == "ok") {
        document.getElementById("success").style.display = "block";
        document.getElementById("success").innerText = "İşlem Başarılı! Şifreniz değişti";
        setTimeout(function() {
          window.location.reload();
        }, 3000);
      } else if (obj['stats'] == "no") {
        document.getElementById("danger").style.display = "block";
        document.getElementById("danger").innerText = "İşlem başarısız! Lütfen daha sonra tekrar deneyin...";
      } else if (obj['stats'] == "nf") {
        document.getElementById("danger").style.display = "block";
        document.getElementById("danger").innerText = "Eski Şifre Doğrulanamadı";
      }
    });
  } else {
    document.getElementById("danger").style.display = "block";
    document.getElementById("danger").innerText = "Yeni şifreler uyuşmuyor";
  }
}

function newAPIKey() {

  document.getElementById("dangerAPI").style.display = "none";
  document.getElementById("successAPI").style.display = "none";

  var dataType = "createAPIKey";

  $.ajax({
    url: 'progress/ajax.php',
    type: 'POST',
    data: {
      dataType: dataType
    },
  }).done(function(response) {
    //response
    var obj = JSON.parse(response);
    if (obj['stats'] == "ok") {
      document.getElementById("successAPI").style.display = "block";
      document.getElementById("successAPI").innerText = "İşlem Başarılı! API Key değişti...";
      setTimeout(function() {
        window.location.reload();
      }, 2000);
    } else if (obj['stats'] == "no") {
      document.getElementById("dangerAPI").style.display = "block";
      document.getElementById("dangerAPI").innerText = "İşlem başarısız! Lütfen daha sonra tekrar deneyin...";
    }
  });
}


function clickRadio(selectObject){
  ticketSubject = selectObject.value;
  if(ticketSubject=='Sipariş'){
    document.getElementById("orderNum").style.display = "block";
  }else{
    document.getElementById("orderNum").style.display = "none";
  }
}


function newTicket(){

  var orderNumber = 0;
  document.getElementById("danger").style.display = "none";
  document.getElementById("success").style.display = "none";

  if(ticketSubject=='Sipariş'){
    if(document.getElementById("orderNumInput").value.trim()==''){
      document.getElementById("danger").style.display = "block";
      document.getElementById("danger").innerText = "Sipariş Numarası Boş Bırakılamaz";
      return;
    }else{
      orderNumber = document.getElementById("orderNumInput").value.trim();
    }
  }

  if(document.getElementById("messageInput").value.trim()==''){
    document.getElementById("danger").style.display = "block";
    document.getElementById("danger").innerText = "Mesaj Boş Bırakılamaz";
    return;
  }

  if(document.getElementById("konuInput").value.trim()==''){
    document.getElementById("danger").style.display = "block";
    document.getElementById("danger").innerText = "Konu Boş Bırakılamaz";
    return;
  }

  var konuInput = document.getElementById("konuInput").value;
  var message = document.getElementById("messageInput").value;
  var dataType = "newTicket";

  $.ajax({
    url: 'progress/ajax.php',
    type: 'POST',
    data: {
      orderNumber:orderNumber,
      message:message,
      konuInput:konuInput,
      ticketSubject:ticketSubject,
      dataType: dataType
    },
  }).done(function(response) {
    //response
    var obj = JSON.parse(response);
    if (obj['stats'] == "ok") {
      document.getElementById("success").style.display = "block";
      document.getElementById("success").innerText = "Destek talebi oluşturuldu! En kısa zamanda dönüş yapılacaktır...";
      setTimeout(function() {
        window.location.reload();
      }, 3000);
    } else if (obj['stats'] == "no") {
      document.getElementById("danger").style.display = "block";
      document.getElementById("danger").innerText = "İşlem başarısız! Lütfen daha sonra tekrar deneyin...";
    }
  });

}
