<?php

include("baglanti.php");

session_start();
if (!isset($_SESSION["username"])) {
	header("Location: login.php");
	exit();
}
?>


<?php


if(isset($_SESSION["username"]))
{
  
}
else
{
    echo "<div class='alert alert-Danger' role='alert'><center><h3>
    Bu sayfayı görüntülemek için giriş yapmanız gerekemektedir
  </h3></center></div>";
}


$username = $_SESSION["username"];
?>
<?php
    $sunucu_adi = "localhost";
    $kullanici_adi = "root";
    $sifre = "";
    $veri_tabani = "mesaji";
    $baglanti2 = new mysqli($sunucu_adi, $kullanici_adi, $sifre, $veri_tabani, 3306);

    if($baglanti2->connect_error)
        die("Bağlantı sağlanamadı:".$baglanti2->connect_error);
    /*else
      echo "Bağlantı başarılı";*/
?>

<?php 
if(isset($_POST["subbit"])) {
    $password = $_POST['password'];
    $message = $_POST['message'];

    // Hashle
    $ivlen = openssl_cipher_iv_length('aes-256-cbc');
    $iv = openssl_random_pseudo_bytes($ivlen);
    $encrypted = openssl_encrypt($message, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);
    $message_encrypted = base64_encode($encrypted . '::' . $iv);

    // Veritabanına ekle
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO mesajlar (sifre, mesajs) VALUES ('$password_hashed', '$message_encrypted')";
    $baglanti2->query($sql);
    if($baglanti2->query($sql) === TRUE) {
        echo '<div class="alert alert-success" name="divi"  role="alert">
        Mesaj başarıyla Kaydedildi!
      </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert"><center>
        Mesaj Kaydedilemedi :/
        Lütfen Tekrar Deneyin
      </center></div>' . $baglanti2->error;
    }
}
?>

<!doctype html>
<html lang="tr" dir="TR">
  
  <head>
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript">
       setTimeout(function() { $('#dv1').hide(); }, 3000); /*1000 milisaniye = 1 saniye*/
   </script> 








</head>




<?php
           

// id çekme

$ides = "SELECT ide, kullanici_adi, email, nmara, okuladi FROM kullanicilar WHERE kullanici_adi = '$username'";
$result1 = $baglanti->query($ides);

// Sorgu sonucunda tek bir sonuç beklediğimizden emin olmalıyız
if ($result1->num_rows == 1) {
    $row = $result1->fetch_assoc();
    $ide = $row["ide"];
    $uokuladi = $row["okuladi"];
    $uemail = $row["email"];
    $unmara = $row["nmara"];
    $uusername = $row["kullanici_adi"];



    
} else {
    echo "Kullanıcı bulunamadı veya birden fazla sonuç döndü.";
}


?>









<?php
$msja_err="";

if(isset($_POST["submit"])) {
    
    // Mesajın boş olmadığından emin olun
    if(empty($_POST["msje"])) {
        $msja_err="Mesaj boş geçilemez.";
    } elseif(strlen($_POST["msje"]) > 150) {
        $msja_err="Mesaj adı en fazla 150 karakter olmalıdır.";
    } else {
        $msj = $_POST["msje"];
    }

    // Alıcıyı seçtiğinizden emin olun
    if(empty($_POST["alici"])) {
        $alici_err = "Lütfen bir alıcı seçin.";
    } if($ids == $ide) {
        
        $alici_err = "Kendinize mesaj gönderemezsiniz.";
    } else {
      $ids = $_POST["alici"];
  }
    
    // Mesajı veritabanına kaydet
    if(isset($msj) && isset($ids) && isset($ide)) {
        $ekle="INSERT INTO `mesajs` (`id`, `alici`, `gonderen`, `msja`, `tarih`) VALUES (NULL, '$ids', '$ide', '$msj', CURRENT_TIMESTAMP);";
        $calistirekle = mysqli_query($baglanti,$ekle);
        
        if($calistirekle)  {
        echo '<div id="dv1" class="alert alert-success" role="alert">
        Kayıt başarılı bir şekilde eklendi, Sayfayı yenileyin
      </div>';
    }
    else{
      echo '<div id="dv1" class="alert alert-danger" role="alert">
      Kaydınız eklenirken bir hata oluştu.
      Lütfen Tekrar Deneyin
    </div>'  . mysqli_error($baglanti);
    }

    
}
}

?>

</html>

<!doctype html>
<html lang="tr" dir="TR">
  
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    
    
  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.rtl.min.css" integrity="sha384-dc2NSrAXbAkjrdm9IYrX10fQq9SDG6Vjz7nQVKdKcJl3pC+k37e7qJR5MVSCS+wR" crossorigin="anonymous">
    <link rel="icon" href="aicon1.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  

    <title>Welcome</title>
<!-- İP log-->

    <!-- 🎇🎇🎇php aç
include("baglanti.php");
$username = $_SESSION["username"];


 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $ip = $_POST['ip'];
  $ipObj = json_decode($ip);
  $userIpAddress = $ipObj->ip;

 //IP adresinin veritabanında var olup olmadığını kontrol et
  $ipCheck = "SELECT * FROM ips WHERE username = '$username'";
  $result = mysqli_query($baglanti, $ipCheck);
  if (mysqli_num_rows($result) > 0) {
    echo "";  //<center><h1 style='color:red;'>Bu IP adresi zaten veritabanında mevcut</center></h1>
  } else {
     //Veritabanına kaydetmek için hazırlanan SQL sorgusu
   $sql = "INSERT INTO ips (ip, username) VALUES ('$userIpAddress', '$username')";
     //Sorguyu veritabanına gönder
    if (mysqli_query($baglanti, $sql)) {
      echo "Kayıt başarılı bir şekilde eklendi";
    } else {
      echo "Kaydınız eklenirken bir hata oluştu. Lütfen Tekrar deneyin.";
    }
  }
 
}

?>  


  <script>
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "  🎇✨aç php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        const ip = xhr.responseText;
        document.getElementById("ip").textContent = ip;
      }
    };
    const userIpAddress = "";
    const ipApiUrl = "https://api.ipify.org?format=json";
    fetch(ipApiUrl)
      .then(response => response.json())
      .then(data => {
        const ip = JSON.stringify({ ip: data.ip });
        xhr.send("ip=" + ip);
      })
      .catch(error => {
        console.error('IP adresi alınırken hata oluştu:', error);
      });
  </script> -->
     
<!-- A https://github.com/cesurh? Production -->
    
    <style>
    body {
    margin: 0;
    color: grey;
}

ul {
    list-style-type: none;

    margin: 0;

    padding: 0;

    width: 13%;

    background-color: #f1f1f1;

    position: fixed;

    height: 115%;

    overflow: auto;
}

li a {
    display: block;

    color: #000;

    padding: 8px 16px;

    text-decoration: none;
}

li a.active:hover:not(.active) {
    background-color: green;
    height: 55px;
    border: 5px;
    color: white;
    
}

li a:hover:not(.active) {
    background-color: grey;
    border-radius: 25px;
    text-shadow: 5px;

    color: white;
}

.tamam {
  background-color: ;
  float:left;
  weight:40px;
  height:40px;
}
.send {
  float:left;
  weight:140px;
  height:60px;

} 
#box {
max-width: 950px;
position: relative;

}
#box .fa-search {
position: absolute;
top: 14px;
left: 12px;
font-size: 20px;
color:cornflowerblue;
}
#search {
width: 950px;
box-sizing: border-box;
border: 2px solid cornflowerblue;
border-radius: 25px;
font-size:18px;
padding: 12px 20px 12px 40px;
-moz-transition: width 0.4s ease-out-in;
-o-transition: width 0.4s ease-out-in;
-webkit-transition: width 0.4s ease-in-out;
transition: width 0.4s ease-in-out;
}
#search:focus {
width: 100%;
}
#footer1 {

}
#op1 {
  


}
#tamam :hover {
  background-color: green;



}
.mainmenubtn {
  background-color: grey;
  border-radius: 45px;
  border: none;
  cursor: pointer;
  padding:15px;
  margin-top:15px;
}
.mainmenubtn:hover {
  background-color: white;
  border-radius: 45px;
}
.dropdown {
  position: relative;
  display: inline-block;
}
.dropdown-child {
  display: none;
  background-color: black;
  min-width: 130px;
}
.dropdown-child a {
  color: white;
  padding: 20px;
  text-decoration: none;
  display: block;
}
.dropdown:hover .dropdown-child {
  display: block;
}
#buton {
  background-color: lightgrey;
  border-radius: 15px;

}
#buton:hover {
  background-color: pink;
  border-radius: 15px;

}
#buton1 {
  background-color: lightgrey;
  border-radius: 15px;

}
#buton1:hover {
  background-color: lightblue;
  border-radius: 15px;

}
   
   </style>

   



  </head>
  
  <header style="background-color: lightgrey;">
  <body  style="background-color: lightgrey;">
  
  
  

  
  <ul>
  <img src="studeel1.png" class="send" alt="Logo" />
  <br><br>
<br>
  <li onclick="gizleGoster('hesap');"><a class="active" onclick="gizleGoster('hesap');" style="weight: 35px;" >  <img class="tamam"  src="aicon1.png" id="tamam" alt="profile" /><h4 onclick="gizleGoster('hesap');"><?php  echo $_SESSION["username"] ?></h4></a></li>
          <script>
function gizleGoster(ID) {
  var secilenID = document.getElementById(ID);
  if (secilenID.style.display == "none") {
    secilenID.style.display = "";
  } else {
    secilenID.style.display = "none";
  }
}
</script>

<p id="hesap" style="display: none;">
  <button id="buton" onClick="parent.location='profile.php'"><h5>Profil</h5></button><br>
  <button id="buton1" onClick="parent.location='hesap.php'"><h5>Hesap Bilgileri</h5></button>
 
<br>
  
  <li ><a class="" href="anasayfa.php"><img class="tamam"   src="home (1).png" style="widht: 25px; height: 30px;" id="tamam" alt="profile" /><h5>Home</h5></a></li>
<br>
  <li ><a class="" href="anasayfa.php"><img class="tamam"   src="megap.png" style="widht: 25px; height: 30px;" id="tamam" alt="profile" /><h5>News</h5></a></li>

  <br>
  <li ><a class="" href="anasayfa.php"><img class="tamam"   src="sss.png" style="widht: 25px; height: 30px;" id="tamam" alt="profile" /><h5>SSS</h5></a></li>

  <li ><a class="" onClick="parent.location='aboutus.php'"><img class="tamam"   src="users.png" style=" hover-color: red; widht: 25px; height: 30px;" id="tamam" alt="profile" /><h5>About</h5></a></li>

  <li ><a class="" href="hesap.php" ><img class="tamam"   src="jobs.png" style=" hover-color: red; widht: 28px; height: 33px;" id="tamam" alt="profile" /><h5 style="color:blue;">Bize Katıl!</h5></a></li>
  
  <li ><a class="" href="plang.php" target="" title="Proje veya Dosya halinde teslim edeceğin ödevi yapamadıysan herhangi bir doya oluştur ve dosyayı boz!"><img class="tamam"   src="job.png" style=" hover-color: red; widht: 28px; height: 33px;" id="tamam" alt="profile" /><h5 style="color:purple;">Araçlar</h5></a></li>



  <button type="button" name="cikis" onClick="parent.location='cikis.php'" style=' backround-color:yellow; float:center; border:5px solid red; padding:5px 5px;' class="btn btn-outline-danger">Çıkış yap</button>

</ul>
      <br>
      
      
 
<?php
if(isset($_SESSION["username"]))
{

    echo "<center><h1 style='color:limegreen; float:center;' class='animate__animated animate__fadeInDown'>Welcome</h1><h1 style='color:Brown; float:center;' class='animate__animated animate__fadeInUp'>".$_SESSION["username"]."</h1></center>";
    
}
else
{
    echo "Bu sayfayı görüntülemeye yetkiniz yoktur";
}
?> 
<center>
<form action="profil.php" method="POST">
  <div class="input-group mb-3" style="width:70%;">
    <input type="text" class="form-control" placeholder="<?php
      if(isset($_SESSION["username"])) {
        echo "Kullanıcı adı ile ara...";
      } else {
        echo "Bu sayfayı görüntülemek için giriş yapmanız gerekmektedir";
      }
    ?>" aria-label="Recipient's username" aria-describedby="button-addon2" name="search_query" required>
    <div class="input-group-append">
      <button class="btn btn-outline-secondary" type="submit" id="button-addon2" name="search_button">Ara</button>
    </div>
  </div>
</form>

<?php
// Check if the form was submitted
if(isset($_POST["search_button"])) {
  // Check if the search query is not empty


  
  if(!empty($_POST["search_query"])) {
    $search_query = $_POST["search_query"];
    $arama_sorgusu = "SELECT * FROM `kullanicilar` WHERE `kullanici_adi` LIKE '%$search_query%'";
    $arama_sonucu = mysqli_query($baglanti, $arama_sorgusu);

    if(mysqli_num_rows($arama_sonucu) > 0) {
      echo '<div style="display:flex; justify-content:center;">'; // div ile ortalamaya başlıyoruz
      while($row = mysqli_fetch_assoc($arama_sonucu)) {
        echo '<div class="card" style="width: 19rem;margin:1rem;">'; // card divi içinde verileri yazdırıyoruz
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row["kullanici_adi"] . '</h5>';
        echo '<p class="card-text">' . $row["email"] . '</p>';
        echo '<p class="card-text">' . $row["okuladi"] . '</p>';
        if($row["wuser"] == 1){
          echo '<p class="card-text">Eğitmen</p>';
          } else {
              echo '<p class="card-text">Öğrenci</p>'; 
          }

        echo '</div>';
        echo '</div>';
      }
      echo '</div>'; // div ile ortalamayı kapatıyoruz
    } else {
      echo "Aranan isim veritabanında bulunamadı.";
    }
  } else {
    echo "Lütfen bir arama terimi girin.";
  }
}
?>



</center>

</header>






<br>
<!– Resimler –>


    <br>
    <br>

<br>
<br>
<!-- A Cesur Huseynzade Production -->
<center>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="A short description." />
    <meta name="keywords" content="put, keywords, here" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<title></title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <script>
    
      console.log("a Cesur huseynzade production");
      console.log("Studee © 2023");
    </script>
    <style>
    body {
    background-color: #4E4E4E;
    text-align: center;         /* make sure IE centers the page too */
}
 
#wrapper {
    width: 900px;
    background-color: #4E4E4E; /* A https://github.com/cesurh? Production */
    margin: 0 auto;             /* center the page */
    border-radius: ;
}
 
#content {
    background-color: ;
    border: 3px solid #000;
    float: left;
    font-family: Arial;
    padding: 20px 30px;
    text-align: left;
    width: 100%;
     height: 400px;               /* fill up the entire div */
    border-radius: 20px;

}
 
#menu {
    float: left;
    border: 1px solid #000;
    border-bottom: none;        /* avoid a double border */
    clear: both;                /* clear:both makes sure the content div doesn't float next to this one but stays under it */
    width:100%;
    height:20px;
    padding: 0 30px;
    background-color: #FFF;
    text-align: left;
    font-size: 85%;
    border-radius: 5px;

}
 
#menu a:hover {
    background-color: pink;
    border-radius: 5px;
}
 
#userbar {
    background-color: #fff;
    float: right;
    width: 250px;
    border-radius: 5px;
}
 
#footer {
    clear: both;
}
 
/* begin table styles */
table {
    border-collapse: collapse;
    width: 100%;
     
}
 
table a {
    color: #000;
}
 
table a:hover {
    color:#373737;
    text-decoration: none;
}
 
th {
    background-color: #B40E1F;
    color: #F0F0F0;
}
 
td {
    padding: 5px;
}
 
/* Begin font styles */
h1, #footer {
    font-family: Arial;
    color: red;
}
 
h3 {margin: 0; padding: 0;}
 
/* Menu styles */
.item {
    background-color: green;
    border: 1px solid #032472;
    color: #FFF;
    font-family: Arial;
    padding: 3px;
    text-decoration: none;
}
 
.leftpart {
    width: 70%;
}
 
.rightpart {
    width: 30%;
}
 
.small {
    font-size: 75%;
    color: #373737;
}
#footer {
    font-size: 65%;
    padding: 3px 0 0 0;
    
}
 
.topic-post {
    height: 100px;
    overflow: auto;
}
 
.post-content {
    padding: 30px;
}
 
textarea {
    width: 500px;
    height: 200px;
}
.sonuc {
  max-width: none;
  max-height: none;
  overflow: auto;
}
.content {
  max-width: none;
  max-height: none;
  overflow: auto;
}
</style>
</head>
<body>
    <div id="wrapper" style="background-color:grey; height:auto;">
    <div id="menu" style="height:auto;">
    
        
        <button class="item" style="" onclick="gizleGoster('sonuc');">Mesaj Gönder</button> -
        <button class="item" style="" onclick="gizleGoster('passli');">Şifreli Mesaj</button> -
    
        <script>
function gizleGoster(ID) {
  var secilenID = document.getElementById(ID);
  if (secilenID.style.display == "none") {
    secilenID.style.display = "";
  } else {
    secilenID.style.display = "none";
  }
}
</script>








        <div id="userbar">
        <div id="userbar" href="cikis.php">a Cesur Huseynzade Production.</div>
    </div><br>
 <div id="sonuc" style="display: none;">       
<div id="content" style="max-width: none; max-height: none; height:auto;">


<form action="profil.php"  method="POST" enctype="multipart/form-data">

<h2 style="color:blue; text-align:center;">Mesajlara Hoş Geldiniz</h2>
<div class="mb-3">
  <label for="exampleInputEmail1" style="color:black;" class="form-label">Kullanıcı Seç</label>
  <select id="alici" name="alici" >
    <option value="" style="width: 100%; margin-bottom: 20px;color:black;" selected>Lütfen bir alıcı seçin</option>
    <?php
    // Veritabanına bağlanma kodu buraya gelecek

    // Tüm kullanıcıları sorgula
    $sql4 = "SELECT * FROM kullanicilar";
$result2 = $baglanti->query($sql4);

if ($result2->num_rows > 0) {
  // Kullanıcıları bir tablo içinde listeleyelim
  echo '<table><tr style="color:white;"><th>Kullanıcı Adı</th><th></th></tr>';
  while ($row = $result2->fetch_assoc()) {
      $ids = $row["ide"];
      $kullanici_adi = $row["kullanici_adi"];

      // Eğer kullanıcı adı sizin kullanıcı adınızla aynı değilse
      if ($kullanici_adi != $username) {
          echo '<option value="'.$ids.'"><tr style="color:lime;"><td>'.$kullanici_adi.'</td></tr></option>';
      }
  }
  echo '</table>';
} else {
  echo 'Kayıtlı kullanıcı yok';
}
    ?>
</select> 
  <div class="invalid-feedback"></div>
</div>

<button class="" style="color:;" onclick="gizleGoster('mesajlar');" type="button">Gelen Msg</button><button class="" style="color:;" onclick="gizleGoster('gonderilen');" type="button">Gönderilen Msg</button> <br>



<!-- Gelen Mesajların -->

<div id="mesajlar" style="display:none;max-width: none; max-height: none; overflow: auto;">
 <?php include("alınan.php"); ?>  </div>

<!-- Giden Mesajların -->


<div id="gonderilen" style="display:none;max-width: none; max-height: none; overflow: auto;">
  <?php include("gonderi.php"); ?>
</div>



<!-- 🔆🔆🔆🔆🔆🔆🔆🔆🔆🔆🔆
 🔆🔆Çoook Önemli İsTERSNNNN 🔆🔆-->

    <!-- <script>
    function updateMessages() {
      $('#mesajlar').load('profil.php #mesajlar > *', function() {
        setTimeout(updateMessages, 5000);
      });
    }
    updateMessages();


    </script> -->



<!-- A https://github.com/cesurh? Production -->
<br>
   
         

            <div class="mb-3">
                <label for="exampleInputEmail1" style="color:black;" class="form-label">Mesaj</label>
                <input type="text" class="form-control 
                
                <?php
                if(!empty($msja_err))
                {
                  echo "is-invalid";
                }
                ?>
                "
                id="exampleInputEmail1" name="msje" maxlength="200" >
                <div class="invalid-feedback">
        <?php 
      echo $msja_err;  
        ?>
      </div>
            </div>
            <br>


            <?php
            
            if(isset($_SESSION["username"]))
{
 echo    "<div class='d-grid gap-2 col-6 mx-auto'>
            <button type='submit' name='submit' style='font-size: 25px;' align='center' class='btn btn-primary'>Gönder</button>
              </div>";
}
else
{
    echo "<div class='alert alert-Danger' role='alert'><center><h3>
    Bu sayfayı görüntülemek için giriş yapmanız gerekemektedir
  </h3></center></div>";
}



?>
           
            <br></form>




        
        

</center>

<style>
  .message{
    max-width:50%;
    max-height:70px;
  }
</style>
<div id="passli" style="display: none;">       




<?php
if (isset($_POST["Sorgula"])) {
  $sifre = $_POST['parola'];

  // Veritabanından eşleşen hashlenmiş şifreyi al
  $sql1 = "SELECT sifre, mesajs FROM mesajlar";
  $result = $baglanti2->query($sql1);
  if (!$result) {
      die("Sorgu çalıştırılamadı: " . $baglanti2->error);
  }

  // Eşleşen veri varsa, şifresi doğru olan mesajları göster
  $found = false;
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          if (password_verify($sifre, $row["sifre"])) {
              $found = true;
              echo "<br><br><br>Mesaj: ";
              $encrypted_data = base64_decode($row["mesajs"]);
              list($encrypted_message, $iv) = explode('::', $encrypted_data, 2);
              $decrypted_message = openssl_decrypt($encrypted_message, 'aes-256-cbc', $sifre, OPENSSL_RAW_DATA, $iv);
              echo $decrypted_message . "<br>";
          }
      }
      if (!$found) {
          echo "Şifre bulundu ancak mesaj çözülemiyor.";
      }
  } else {
      echo "Şifre bulunamadı.";
  }
  // Bağlantıyı kapat
 
}
?>

<div style="text-align:center; width:100%; height:500px;">

<form action="profil.php" method="post"><br><br><br>
	
		<label for="password">Şifre:</label><br>
		<input type="password" id="password" name="password"><br>

		<label for="message">Mesaj:</label><br>
		<textarea id="message" name="message" ></textarea><br>

		<input type="submit" name="subbit" value="Gönder">
	</form>


<br><br><br>


<form action="profil.php" method="post">
    <label for="parola">Şifre:</label><br>
    <input type="password" id="parola" name="parola"><br>

    <input type="submit" name="Sorgula" value="Sorgula">
</form>
</div>




</div>
</div>


</div>
</div>


         </div> </div>
</div>  </div>



<br><br><br><br><br>
<h2 style="color:red;  margin-right: 45%;">İlgini çekebilecekler:</h2>
<br><br>

<style>
  /* Hero stilleri */
.hero {
  background-image: url('fotor.jpg');
  background-size: cover;
  background-position: center;
  height: 500px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  color: #fff;
}

.hero h2 {
  font-size: 48px;
  margin: 0 0 20px 0;
  text-align: center;
  text-shadow: 2px 2px #000;
}

.hero p {
  font-size: 24px;
  margin: 0;
  text-align: center;
  text-shadow: 2px 2px #000;
}

.button {
  display: inline-block;
  padding: 10px 20px;
  border: 2px solid cyan;
  border-radius: 30px;
  background-color: transparent;
  color: #000;
  font-size: 18px;
  text-decoration: none;
  margin-top: 20px;
  
  transition: all 0.3s;
}
.button:hover {
  background-color: cyan;
}




/* Kurslar stilleri */
.courses {
  display: flex;
  flex-wrap: wrap;
  margin: 50px 0;
  justify-content: flex-end;
 
}
.courses button:hover{
    background-color: #fff;
  color: #000;
}

.course {
  flex-basis: 25%; /* Kurs kartlarının genişliği */
    max-width: 300px; /* Kurs kartlarının maksimum genişliği */
    margin-right: 2.9%; /* Sağ ve sol boşluk */
    margin-bottom: 25px; /* Alt boşluk */
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
    border-radius: 30px; /* Kurs kartlarının kenar yuvarlatması */
    text-align: center; /* Metni merkeze hizala */
  background-image: linear-gradient(#5155A6, #66B1F2, #F2C49B);
}
.course:hover {
  box-shadow: 0 30px 40px rgba(0,0,0,0.1);
}
.imagesi:hover{
  
}
.course img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 40px;
}

.course h4 {
  font-size: 24px;
  margin: 20px;
  text-align: center;
}

.course p {
  font-size: 18px;
  margin: 20px;
  text-align: justify;
}

/* Altbilgi stilleri */
footer {
  background-color: #333;
  color: #fff;
  text-align: center;
  padding: 20px;
}

.explore:hover {
    background-color: grey;
    transition: all 0.3s;
    opacity: 5.0;
}
</style>

<div class="container">
    <section class="courses">
  
      <div class="course">
        <img src="cs.jpg" alt="Kurs 1" id="Kurs1">
        <h4 style="color:black;">Bilgisayar Bilimleri</h4>
        
        <center><a href="#" class="button">Daha Fazla</a></center><br>
        <center><a style="color:blue;">by Studee</a></center>
      </div>

<?php 
$sql = "SELECT egitmen, link, baslik FROM kurs";
$result = $baglanti->query($sql);

// Her kayıt için iframe oluştur ve URL'yi içine yerleştir
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo '<div class="course">';
    if (strpos($row["link"], 'vimeo.com') !== false) {
        echo '<iframe width="100%" height="200" style="border-radius:40px;" src="'. $row["link"] .'" frameborder="0" allowfullscreen></iframe>';
    } elseif (strpos($row["link"], 'youtube.com') !== false || strpos($row["link"], 'youtu.be') !== false) {
        echo '<iframe width="100%" height="200" style="border-radius:40px;" src="'. $row["link"] .'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
    } else {
        echo 'Bu link Vimeo veya YouTube linki değil.';
    }
    echo '<h4 style="color:black;">'. $row["baslik"] .'</h4>';
    echo '<center><a href="#" class="button">Daha Fazla</a></center>';
    echo '<br>';
    echo '<center><a style="color:blue;">by '. $row["egitmen"] .'</a></center>';
    echo '<br>';
    echo '</div>';
  }
} else {
  echo "Kayıt bulunamadı.";
}
?>






      <div class="course">
        <img src="https://media.istockphoto.com/id/1313088031/tr/vekt%C3%B6r/ingilizce.jpg?s=612x612&w=0&k=20&c=z01Fn1lQpnG-TUJ8eBP0dLKlb0SJ9cSXHKBOkn92vvI=" alt="Kurs 2">
        <h4 style="color:black;">İngilizce Eğitimleri</h4>
        
        <center><a href="#" class="button">Daha Fazla</a></center><br>
        <center><a style="color:blue;">by Studee</a></center><br>
      </div>


      <div class="course">
        <img src="https://media.istockphoto.com/id/545286316/tr/foto%C4%9Fraf/checking-the-chemical-formula-in-academic-laboratory.jpg?s=612x612&w=0&k=20&c=nyhC3nDOK3xCmSqff7FzrdHjlWFwNewyTZ18nrYGwv8=" alt="Kurs 3">
        <h4 style="color:black;">Kimya Eğitimleri</h4>
        <center><a href="#" class="button">Daha Fazla</a></center><br>
        <center><a style="color:blue;">by Studee</a></center><br>
      </div>
    </section>
</div>
    







<br><br><br><br><br><br><br><br>


<center>
            
      <div style="background-color: lightblue; lightblue; box-shadow: 2px 5px 3px limegreen; font-color: white;" class="card p 9 " id="footer1" align="center">
        <p>2023. Studee. ©All rights reserved. Created by <a href="https://github.com/cesurh?"  target="_blank"  rel="nofollow">Cesur Huseynzade</a>.</p>
    </div>
</center>