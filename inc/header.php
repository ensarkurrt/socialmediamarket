<?php
session_start();
ob_start();
date_default_timezone_set('Europe/Istanbul');
require_once("inc/conn.php");


function tarihcek($sqlsorgusu,$tarihname){

switch (substr($sqlsorgusu[$tarihname], 5,2)) {
		case '01':
		$ay = "Ocak";
		break;
		case '02':
		$ay = "Şubat";
		break;
		case '03':
		$ay = "Mart";
		break;
		case '04':
		$ay = "Nisan";
		break;
		case '05':
		$ay = "Mayıs";
		break;
		case '06':
		$ay = "Haziran";
		break;
		case '07':
		$ay = "Temmuz";
		break;
		case '08':
		$ay = "Ağustos";
		break;
		case '09':
		$ay = "Eylül";
		break;
		case '10':
		$ay = "Ekim";
		break;
		case '11':
		$ay = "Kasım";
		break;
		case '12':
		$ay = "Aralık";
		break;

}

$yil = substr($sqlsorgusu[$tarihname],0,4);

$gun =  substr($sqlsorgusu[$tarihname], 8,2);

$saat = substr($sqlsorgusu[$tarihname], 11,2);

$dakika = substr($sqlsorgusu[$tarihname], 14,2);

$saniye = substr($sqlsorgusu[$tarihname], 17,2);


	echo $gun." ".$ay." ".$yil." ".$saat.":".$dakika;


}

$settings=$db->prepare("SELECT * FROM settings where id=:id");
$settings->execute(array(
  'id' => 1
));
$takeSetting=$settings->fetch(PDO::FETCH_ASSOC);
$url = $takeSetting['url'];

if($_SERVER['SCRIPT_NAME']=="/takipci/home.php" || $_SERVER['SCRIPT_NAME'] =="/takipci/services.php" || $_SERVER['SCRIPT_NAME']=="/takipci/apiinfo.php" || $_SERVER['SCRIPT_NAME'] =="/takipci/signup.php"){}else{
  if(empty($_SESSION['username'])){
    header("Location:home?redirect=".$_SERVER['SCRIPT_NAME']);
    exit();
  }
}

if(isset($_SESSION['username'])){
  $users=$db->prepare("SELECT * FROM users where username=:username");
  $users->execute(array(
    'username' => $_SESSION['username']
  ));
  $takeUserInfo=$users->fetch(PDO::FETCH_ASSOC);
}


?>

<html lang="tr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><? echo $takeSetting['name'];?> | <? echo $takeSetting['slogan'];?></title>
  <meta name="keywords" content="Sosyal Medya Paneli,BDD Medya,Instagram Bayilik Paneli,Facebook Begeni,Instagram,Begeni,Instagram Takipçi,Facebook Takipçi,Twitter Fav,Twitter Takipçi">
  <meta name="description" content="Sosyal Medya Bayilik,Instagram Takipçi İnstagram Beğeni Bayilik Paneli Sosyal Medya Hizmetleri Facebook Twitter Youtube İnstagram İzlenme Twitter Takipçi.">
  <link rel="shortcut icon" type="image/ico" href="https://perfectcdn.com/3e9b918f-7bc8-436f-85e4-16dace3040e0/">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


<style>
	.top-banner{
		padding-bottom: 100px !important;
	}
</style>

</head>

<body>
  <div style="position:fixed;top:0px;left:0px;width:0;height:0;" id="scrollzipPoint"></div>

  <!-- Externel css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">

  <link rel="stylesheet" type="text/css" href="css/panel/1554802291/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/panel/1554802291/style.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">

  <!-- Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,600i,700,700i,800">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">


  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>



  <header class="bg-blue">
    <div class="container">
      <nav class="navbar navbar-expand-lg">
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon">
            <i class="fa fa-bars"></i>
          </span>
        </button>
        <a class="navbar-brand" href="home">
          <!-- <img src="https://perfectcdn.com/f0f01109-7642-481c-a427-b7c1cfdf25ea/" alt="<?php echo $takeSetting['name']; ?> | <?php echo $takeSetting['slogan']; ?>" title="<?php echo $takeSetting['name']; ?> | <?php echo $takeSetting['slogan']; ?>"> -->
					<h3 style="color:white"><?php echo $takeSetting['name']; ?></h3>
			  </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

<?php if(!empty($_SESSION['username'])){?>
  <ul class="navbar-nav ml-auto">
      <li class="nav-item topBotomBordersIn <?php if($_SERVER['SCRIPT_NAME']=="/takipci/index.php"){echo "active";} ?>"><a href="index" class="nav-link">
     Yeni Sipariş</a></li>
      <li class="nav-item dropdown <?php if($_SERVER['SCRIPT_NAME']=="/takipci/orders.php"){echo "active";} ?>">
              <a class="nav-link dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="supportMenu">
                Sipariş Geçmişi
              </a>
              <div class="dropdown-menu" aria-labelledby="supportMenu">
                  <a class="dropdown-item" href="orders">Siparişler</a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
            </li>
      <li class="nav-item topBotomBordersIn <?php if($_SERVER['SCRIPT_NAME']=="/takipci/services.php"){echo "active";} ?>"><a href="services" class="nav-link">
     Fiyat Listesi

</a></li>
      <li class="nav-item topBotomBordersIn <?php if($_SERVER['SCRIPT_NAME']=="/takipci/addfunds.php"){echo "active";} ?>"><a href="addfunds" class="nav-link">
              Bakiye Ekle

</a></li>
      <li class="nav-item dropdown <?php if($_SERVER['SCRIPT_NAME']=="/takipci/terms.php" || $_SERVER['SCRIPT_NAME']=="/takipci/tickets.php"){echo "active";} ?>">
              <a class="nav-link dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="supportMenu">
                Destek                       </a>
              <div class="dropdown-menu " aria-labelledby="supportMenu">
                                                <a class="dropdown-item" href="terms">Kullanım Şartları</a>

                <a class="dropdown-item" href="tickets">Destek Talebi </a>

                                                                                </div>
            </li>
      <li class="nav-item topBotomBordersIn <?php if($_SERVER['SCRIPT_NAME']=="/takipci/apiinfo.php"){echo "active";} ?>"><a href="apiinfo" class="nav-link">
     API

</a></li>
    </ul>
    </div>
    <div class="navbar-right">
              <a href="addfunds" class="badge badge-green float-left hide-lg"><?php echo $takeUserInfo['balance']; ?>₺</a>
              <div class="dropdown float-left">
                <a href="javascript:void(0)" class="nav-link dropdown-toggle" id="myAccount" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <i class="fa fa-user-circle"></i>
              </a>
                <div class="dropdown-menu" aria-labelledby="myAccount">
                    <a href="account" class="dropdown-item">Hesabım</a>
				              <a href="logout" class="dropdown-item">Çıkış</a>
                </div>
              </div>
        	</div>
<?php }else{?>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item topBotomBordersIn">
      <a class="nav-link" href="home">
        Giriş Yap!
      </a>
    </li>
    <li class="nav-item topBotomBordersIn">
      <a class="nav-link" href="services">
        Servisler
      </a>
    </li>
    <li class="nav-item topBotomBordersIn">
      <a class="nav-link" href="faq">
        SSS
      </a>
    </li>
    <li class="nav-item topBotomBordersIn">
      <a class="nav-link" href="apiinfo">
        API
      </a>
    </li>
  </ul>




        </div>

        <div class="navbar-right">
          <a class="btn btn-green hvr-bob" href="signup">Üye Ol</a>
        </div>
        <?php } ?>
      </nav>
    </div>
  </header>
