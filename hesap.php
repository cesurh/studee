<?php

include("baglanti.php")
?>
<?php

session_start();
if (!isset($_SESSION["username"])) {
	header("Location: login.php");
	exit();
}





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
if(isset($username) && isset($parola))
  {
  
    $secim = "SELECT * FROM kullanicilar WHERE kullanici_adi = '$username'";
    $calistir=mysqli_query($baglanti , $secim);
    $kayitsayisi = mysqli_num_rows($calistir);

    if($kayitsayisi>0)
    {
        $ilgilikayit = mysqli_fetch_assoc($calistir);
        $hashlisifre=$ilgilikayit["parola"];


        if(password_verify($parola,$hashlisifre))
        {
            session_start();
            $_SESSION["username"]=$ilgilikayit["kullanici_adi"];
            $_SESSION["email"]=$ilgilikayit["email"];
            $_SESSION["nmara"]=$ilgilikayit["nmara"];
            $_SESSION["okuladi"]=$ilgilikayit["okuladi"];
            $_SESSION['ide']=$ilgilikayit["id"];
            $_SESSION["wuser"]=$ilgilikayit["wuser"];
            header("location:profil.php");

        
        }
        else{
            echo '<div class="alert alert-Danger" role="alert">
        Şifreniz yanlış.
      </div>';
        }
    }
    else
    {
        echo '<div class="alert alert-Danger" role="alert">
        Kullanıcı adı yanlış.
      </div>';
    }



   

    
}




// id çekme

// SQL sorgusu
$ides = "SELECT ide FROM kullanicilar WHERE kullanici_adi = '$username'";

// Sorguyu çalıştırın
$result1 = $baglanti->query($ides);

// Sorgu sonucunda tek bir sonuç beklediğimizden emin olmalıyız
if (!$result1) {
    die("Sorgu hatası: " . $baglanti->error);
}

$user_id = null; // Varsayılan değer

if ($result1->num_rows == 1) {
    $row = $result1->fetch_assoc();
    $user_id = $row["ide"];
} else {
    echo "Kullanıcı bulunamadı veya birden fazla sonuç döndü.";
}



?>
<!doctype html>
<html lang="tr" dir="TR">
  
  <head>
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript">
       setTimeout(function() { $('#dv1').hide(); }, 5000); /*1000 milisaniye = 1 saniye*/
   </script> 
</head>

<?php
$username_err="";
$dersi_err="";
$okul_err="";
$certif_err="";



if(isset($_POST["submit"]))

{
  

    
    // Email doğrulama
    if(empty($_POST["dersi"]))
    {
      $dersi_err="Ders boş geçilemez.";
    }
    else if(strlen($_POST["dersi"])>25)
  {
    $dersi_err="Ders adı en fazla 25 karakter olmalıdır.";
  }
    else{
      $dersi = $_POST["dersi"];
    }


    

       // Okul adı doğrulama
  if(empty($_POST["okul"]))
  {
    $okul_err="Okul adı boş geçilemez.";
  }
  else if(strlen($_POST["okul"])<6)
  {
    $okul_err="Okul adı en az 6 karakter olmalıdır.";
  }
  else if(strlen($_POST["okul"])>35)
  {
    $okul_err="Okul adı en fazla 35 karakter olmalıdır.";
  }
 
    else{
      $okul=$_POST["okul"];
    }










  if(isset($dersi) && isset($okul))
  {

    
    $teaCheck = "SELECT * FROM teablo WHERE basvurn = '$username'";
    $result1 = mysqli_query($baglanti, $teaCheck);
    if (mysqli_num_rows($result1) > 0) {
      echo "<center><h3 id='dv1' style='color:purple;'>Zaten Başvuru Yaptınız/Başvurunuz Değerlendirme Sürecinde</center></h3>";
    } else {
      
$ekle="INSERT INTO `teablo` (`id`, `basvurn`, `branss`, `okladi`, `tarih`) VALUES (NULL, '$username', '$dersi', '$okul', CURRENT_TIMESTAMP);";
    $calistirekle = mysqli_query($baglanti,$ekle);
    

    if($calistirekle) {
        echo '<div id="dv1" class="alert alert-success" role="alert">
        Kayıt başarılı bir şekilde eklendi, Sayfayı yenileyin
      </div>';
    }
    else{
      echo '<div id="panel1" class="alert alert-danger" role="alert">
      Kaydınız eklenirken bir hata oluştu.
      Lütfen Tekrar Deneyin
    </div>';
    }



    }
   
    
    
}
}

?>
<?php
$bas_err="";
$kurs_err="";
$acik_err="";


if(isset($_POST["submit"]))

{
  

    
    // baslik doğrulama
    if(empty($_POST["bas"]))
    {
      $bas_err="Ders boş geçilemez.";
    }
    else if(strlen($_POST["bas"])>25)
  {
    $bas_err="Ders adı en fazla 25 karakter olmalıdır.";
  }
    else{
      $bas = $_POST["bas"];
    }


    

       // kurs adı doğrulama
  if(empty($_POST["kurs"]))
  {
    $kurs_err="Kurs linki boş geçilemez.";
  }
  else if(strlen($_POST["kurs"])<6)
  {
    $kurs_err="Kurs linki en az 6 karakter olmalıdır.";
  } 
    else{
      $kurs=$_POST["kurs"];
    }

    // açıklama
    if(empty($_POST["acik"]))
    {
      $acik_err="Kurs açıklaması boş geçilemez.";
    }
    else if(strlen($_POST["acik"])<6)
    {
      $acik_err="Kurs kurs açıklaması en az 6 karakter olmalıdır.";
    } 
      else{
        $acik=$_POST["acik"];
      }








  if(isset($bas) && isset($kurs) && isset($acik))
  {

    
   
   
    $ekle="INSERT INTO `kurs` (`id`,`egitmen`, `baslik`, `link`, `aciklma`, `tarih`) VALUES (NULL, '$username', '$bas', '$kurs', '$acik', CURRENT_TIMESTAMP);";
    $calistirekle = mysqli_query($baglanti,$ekle);
    

    if($calistirekle) {
        echo '<div id="dv1" class="alert alert-success" role="alert">
        Kayıt başarılı bir şekilde eklendi, Sayfayı yenileyin
      </div>';
    }
    else{
      echo '<div id="panel1" class="alert alert-danger" role="alert">
      Kaydınız eklenirken bir hata oluştu.
      Lütfen Tekrar Deneyin
    </div>';
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.rtl.min.css" integrity="sha384-dc2NSrAXbAkjrdm9IYrX10fQq9SDG6Vjz7nQVKdKcJl3pC+k37e7qJR5MVSCS+wR" crossorigin="anonymous">
    <link rel="icon" href="aicon1.png" type="image/x-icon" />
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

    <title>Hesap Ayarları</title>
    <style>

body {
    background-color: #4E4E4E;
            /* make sure IE centers the page too */
}

 
td {
    padding: 5px;
}
#exampleInputEmail1 {
  text-align: left;  
}
 

#divi {
  position: fixed; 
  position: top;  
  text-align: center;
  overflow: auto;
  height: 450px;
  weight: 50px ;
  width: 13%;
  border-radius: 90px;
  animation: fadeOut 5s;
}



      








    body {
    
}

ul {
    list-style-type: none;

    margin: 0;

    padding: 0;

    width: 13%;

    background-color: #f1f1f1;

    position: fixed;
    position: top;

    height: 100%;

    overflow: auto;

    text-align: center;
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
    background-color: #555;
    border-radius: 35px;

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
float: center;

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
border-radius: 40px;
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

.courses {
  display: flex;
  flex-wrap: wrap;
  margin: 50px 0;
}
.courses button:hover{
    background-color: #fff;
  color: #000;
}

.course {
   flex-basis: 30%;
  margin-right: 3.3333%;
  margin-bottom: 30px;
  box-shadow: 0 6px 10px rgba(0,0,0,0.1);
  position: ;
  border-radius: 40px;
  background-color:white;
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
   
   </style>
  </head>
  <header style="background-color: lightgrey;">
  <body  style="background-color: lightgrey;">
  <ul>
  <img src="studeel1.png"  class="send" alt="Logo" />
  <br><br><br>
  <li ><a class="" href="profil.php"><img class="tamam"   src="ger.png" style="widht: 25px; height: 30px;" id="tamam" alt="profile" /><h5>Back</h5></a></li>
  <br>
  <li ><a class="" href="profile.php"><img class="tamam"   src="aicon1.png" style="widht: 25px; height: 30px;" id="tamam" alt="profile" /><h5>Profil</h5></a></li>

  <br>
  <li ><a class="" href="anasayfa.php"><img class="tamam"   src="home (1).png" style="widht: 25px; height: 30px;" id="tamam" alt="profile" /><h5>Home</h5></a></li>
<br>
  <li ><a class="" href="anasayfa.php"><img class="tamam"   src="megap.png" style="widht: 25px; height: 30px;" id="tamam" alt="profile" /><h5>News</h5></a></li>

  <br>
  <li ><a class="" href="anasayfa.php"><img class="tamam"   src="sss.png" style="widht: 25px; height: 30px;" id="tamam" alt="profile" /><h5>SSS</h5></a></li>

  <li ><a class="" href="aboutus.php"><img class="tamam"   src="users.png" style=" hover-color: red; widht: 25px; height: 30px;" id="tamam" alt="profile" /><h5>About</h5></a></li>

</ul>
      <br>

  <center>



<?php
if(isset($_SESSION["username"]))
{

    echo "<center><big><h3 style='color: red; '>Hesap Ayarları</h3></center>";
    
}
else
{
    echo "<center>Bu sayfayı görüntülemeye yetkiniz yoktur</center>";
}
?>

  <div class="" name="grup"  role="group" aria-label="Basic outlined example">
  <button type="button" name="sss" class="btn btn-outline-primary">SSS</button>
  <button type="button" name="bizkimiz" class="btn btn-outline-success">Biz kimiz</button>
</div>
</center>
<center>

<div style="float: center; width: 1090px; weight:auto; display:flex;"  class="container p-5">
        <div style="box-shadow: 2px 5px 3px limegreen; weight:auto; " class="card p-5">
        <center><h5 style="color: grey; ">Hızlı ve kolaydır!</h5></big></center>






     

        <center><div class="d-grid gap-2 d-md-flex" style="weight:auto;">
        <?php

$sql1 = "SELECT wuser FROM kullanicilar WHERE ide = $user_id";
$result2 = $baglanti->query($sql1);

if ($result2 instanceof mysqli_result) {
  // Sorgu başarılı, num_rows özelliğini kullanabilirsiniz
  if ($result2->num_rows > 0) {
      $row1 = $result2->fetch_assoc();
      if ($row1["wuser"] == 1) {
        echo "<button type='button' id='arey' name='Astronomi' onclick='showPopup();' class='btn btn-outline-warning'><a style='color:white;'>İçerik üret!</a>
        <style>
            .onyuz {
                position: relative;
                border-radius: 35px;
                -webkit-transform: scale(1);
                -ms-transform: scale(1);
                -moz-transform: scale(1);
                transition: all .3s ease-in;
                -moz-transition: all .3s ease-in;
                -webkit-transition: all .3s ease-in;
                -ms-transition: all .3s ease-in;
                float: right;
            }
            .onyuz:hover {
                z-index: index 1;
                -webkit-transform: scale(1.1);
                -ms-transform: scale(1.1);  
                -moz-transform: scale(1.1);
                transform: scale(1.1);
            }
            .Astronomi {
                position: relative;
                border-radius: 35px;
                -webkit-transform: scale(1);
                -ms-transform: scale(1);
                -moz-transform: scale(1);
                transition: all .3s ease-in;
                -moz-transition: all .3s ease-in;
                -webkit-transition: all .3s ease-in;
                -ms-transition: all .3s ease-in;
            }
            .Astronomi:hover {
                z-index: index 1;
                -webkit-transform: scale(1.1);
                -ms-transform: scale(1.1);  
                -moz-transform: scale(1.1);
                transform: scale(1.1);
            }
        </style>
        <center>
            <h4>Kurs Başlat<a style='color:lightblue;'>!</a></h4>
            <script src='https://cdn.lordicon.com/ritcuqlt.js'></script>
            <lord-icon
                src='https://cdn.lordicon.com/zgogqkqu.json'
                trigger='hover'
                colors='primary:#4be1ec,secondary:#cb5eee'
                stroke='39'
                style='width:250px;height:250px'>
            </lord-icon>
        </center>
      </button>";
    
} else {
    echo "<button type='button' id='arey' name='Astronomi' onclick='gizleGoster(\"sonuc\");' class='btn btn-outline-warning'><a style='color:white;'>İçerik üreticisi Ol!</a>
          <style>
              .onyuz {
                  position: relative;
                  border-radius: 35px;
                  -webkit-transform: scale(1);
                  -ms-transform: scale(1);
                  -moz-transform: scale(1);
                  transition: all .3s ease-in;
                  -moz-transition: all .3s ease-in;
                  -webkit-transition: all .3s ease-in;
                  -ms-transition: all .3s ease-in;
                  float: left;
              }
              .onyuz:hover {
                  z-index: index 1;
                  -webkit-transform: scale(1.1);
                  -ms-transform: scale(1.1);  
                  -moz-transform: scale(1.1);
                  transform: scale(1.1);
              }
              .Astronomi {
                  position: relative;
                  border-radius: 35px;
                  -webkit-transform: scale(1);
                  -ms-transform: scale(1);
                  -moz-transform: scale(1);
                  transition: all .3s ease-in;
                  -moz-transition: all .3s ease-in;
                  -webkit-transition: all .3s ease-in;
                  -ms-transition: all .3s ease-in;
              }
              .Astronomi:hover {
                  z-index: index 1;
                  -webkit-transform: scale(1.1);
                  -ms-transform: scale(1.1);  
                  -moz-transform: scale(1.1);
                  transform: scale(1.1);
              }
          </style>
          <center>
              <h4>İçerik Üret<a style='color:lightblue;'>!</a></h4>
              <script src='https://cdn.lordicon.com/ritcuqlt.js'></script>
              <lord-icon
                  src='https://cdn.lordicon.com/zgogqkqu.json'
                  trigger='hover'
                  colors='primary:#4be1ec,secondary:#cb5eee'
                  stroke='39'
                  style='width:250px;height:250px'>
              </lord-icon>
          </center>
        </button>";
}
}
}
?>


  
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






<center>


  <button type="button" id="arey" title="Studee ekibine katıl!"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"  name="Astronomi" class="btn btn-outline-success"><a style="color:white;">Studee</a>
  <style>
  .onyuz
{
    position: relative;
    border-radius: 35px;
    -webkit-transform: scale(1);
    -ms-transform: scale(1);
    -moz-transform: scale(1);
    transition: all .3s ease-in;
    -moz-transition: all .3s ease-in;
    -webkit-transition: all .3s ease-in;
    -ms-transition: all .3s ease-in;
    float: left;
}
.onyuz:hover
{
    z-index: index 1;;
    -webkit-transform: scale(1.1);
    -ms-transform: scale(1.1);  
    -moz-transform: scale(1.1);
    transform: scale(1.1);
}
.Astronomi
{
    position: relative;
    border-radius: 35px;
    -webkit-transform: scale(1);
    -ms-transform: scale(1);
    -moz-transform: scale(1);
    transition: all .3s ease-in;
    -moz-transition: all .3s ease-in;
    -webkit-transition: all .3s ease-in;
    -ms-transition: all .3s ease-in;
}
.Astronomi:hover
{
    z-index: index 1;;
    -webkit-transform: scale(1.1);
    -ms-transform: scale(1.1);  
    -moz-transform: scale(1.1);
    transform: scale(1.1);
}
</style> <center> <h4 href="https://forms.gle/XezUfP4XymNad8uS6">Ekibe Katıl<a style="color:lightcyan;">!</a></h4>
<script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
<lord-icon
    src="https://cdn.lordicon.com/yrxnwkni.json"
    trigger="hover"
    scale="39"
    style="width:250px;height:250px">
</lord-icon>
    
 </center>
  </button>







  <?php
$sql1 = "SELECT wuser FROM kullanicilar WHERE ide = $user_id";
$result2 = $baglanti->query($sql1);

if ($result2 === false) {
    die("Sorgu hatası: " . $baglanti->error);
}

if ($result2->num_rows > 0) {
    $row1 = $result2->fetch_assoc();
    if ($row1["wuser"] == 1) {
        echo "<button type='button' id='arey' name='Astronomi' onclick='gizleGoster(\"cour\");' class='btn btn-outline-warning'><a style='color:white;'>İçerikler!</a>
        <style>
            .onyuz {
                position: relative;
                border-radius: 35px;
                -webkit-transform: scale(1);
                -ms-transform: scale(1);
                -moz-transform: scale(1);
                transition: all .3s ease-in;
                -moz-transition: all .3s ease-in;
                -webkit-transition: all .3s ease-in;
                -ms-transition: all .3s ease-in;
                float: right;
            }
            .onyuz:hover {
                z-index: index 1;
                -webkit-transform: scale(1.1);
                -ms-transform: scale(1.1);  
                -moz-transform: scale(1.1);
                transform: scale(1.1);
            }
            .Astronomi {
                position: relative;
                border-radius: 35px;
                -webkit-transform: scale(1);
                -ms-transform: scale(1);
                -moz-transform: scale(1);
                transition: all .3s ease-in;
                -moz-transition: all .3s ease-in;
                -webkit-transition: all .3s ease-in;
                -ms-transition: all .3s ease-in;
            }
            .Astronomi:hover {
                z-index: index 1;
                -webkit-transform: scale(1.1);
                -ms-transform: scale(1.1);  
                -moz-transform: scale(1.1);
                transform: scale(1.1);
            }
        </style>
        <center>
            <h4>Eğitimlerim<a style='color:lightblue;'>!</a></h4>
            <script src='https://cdn.lordicon.com/ritcuqlt.js'></script>
            <lord-icon
                src='https://cdn.lordicon.com/zgogqkqu.json'
                trigger='hover'
                colors='primary:#4be1ec,secondary:#cb5eee'
                stroke='39'
                style='width:250px;height:250px'>
            </lord-icon>
        </center>
      </button>";
    
} else {
    
}
}
?>
</div>
</div>
</center>

<style>
  /* Kurslar stilleri */
  .courses {
  display: flex;
  flex-wrap: wrap;
  margin: 50px 0;
  justify-content: flex; /* Kartları yatayda aralıklı olarak sırala */
  flex-direction: row; /* Kartları yatayda yan yana sırala */
  margin-left: 6%; /* Kurs kartlarını sola kaydırın */
}

.courses button:hover{
    background-color: #fff;
  color: #000;
}
.course {
  max-width: 300px; /* Kurs kartlarının maksimum genişliği */
 

  margin-bottom: 25px; /* Alt boşluk */
  box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
  border-radius: 30px; /* Kurs kartlarının kenar yuvarlatması */
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
</style>
<div id="cour" class="container" style="display:none;">
    <section class="courses">
    <?php 
$sql = "SELECT egitmen, link, baslik FROM kurs WHERE egitmen = '$username'";
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
    echo '<h4>'. $row["baslik"] .'</h4>';
    echo '<center><a href="#" class="button">Daha Fazla</a></center>';
    echo '<br>';
    echo '</div>';
    
  }
} else {
  echo "Kayıt bulunamadı.";
}

?>



    </section>
</div>
    <center>

<div class="offcanvas offcanvas-end" data-bs-scroll="true" style="width:700; height:700;" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Ekiplerimize Katılın</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  ...
  </div>
</div></center>
</div>

<center>

<div id="sonuc"  style="background-color: #fff;
    border: 3px solid #000;
    float: center;
    font-family: Arial;
    padding: 20px 30px;
    text-align: left;
    width: 56%;
     height: 400px;               /* fill up the entire div */
    border-radius: 20px; display: none;" >

<form action="hesap.php?ID=<?= $user_id; ?>"  method="POST" enctype="multipart/form-data">
            

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Profesyonel Olduğunuz Alan</label>
                <input type="text" class="form-control 
                
                <?php
                if(!empty($dersi_err))
                {
                  echo "is-invalid";
                }
                ?>
                "
                id="exampleInputEmail1" name="dersi" maxlength="20" minlength="6">
                <div class="invalid-feedback">
        <?php 
      echo $dersi_err;  
        ?>
      </div>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Varsa Çalışığınız Eğitim Kurumu Adı</label>
                <input type="text" class="form-control 
                
                <?php
                if(!empty($okul_err))
                {
                  echo "is-invalid";
                }
                ?>
                "
                id="exampleInputEmail1" name="okul" maxlength="35" minlength="10">
                <div class="invalid-feedback">
        <?php 
      echo $okul_err;  
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
           
            </div>
</form>




        
        

</center>


<br>
<br>



<center>
        <div id="popup-wrapper" style="display:none;">
  <div id="popup">
  <button style="border-radius:50px; width:550px; height:40px;" class="btn btn-outline-info" onclick="hidePopup()">Kapat</button>
  <br>
  <br>
  <img src="1.png"  alt="Resim Açıklaması" style="width: 500px; heigth: 200;">
    <h2 style="color:orange;">Kurs Yayınla</h2>
    <form action="hesap.php?ID=<?= $user_id; ?>"  method="POST" enctype="multipart/form-data">
            


    <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Kurs Başlığı</label>
                <input type="text" class="form-control 
                
                <?php
                if(!empty($bas_err))
                {
                  echo "is-invalid";
                }
                ?>
                "
                id="exampleInputEmail1" name="bas" maxlength="300" minlength="6" placeholder="">
                <div class="invalid-feedback">
        <?php 
      echo $bas_err;  
        ?>
      </div>
            </div>


            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Kurs Video Yerleştirme Linki</label>
                <input type="url" class="form-control 
                
                <?php
                if(!empty($kurs_err))
                {
                  echo "is-invalid";
                }
                ?>
                "
                id="exampleInputEmail1" name="kurs" maxlength="300" minlength="6" placeholder="https://www.youtube.com/embed/FWTNMzK9vG4?controls=0">
                <div class="invalid-feedback">
        <?php 
      echo $kurs_err;  
        ?>
      </div>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Kurs Açıklaması</label>
                <input type="textarea" class="form-control 
                
                <?php
                if(!empty($acik_err))
                {
                  echo "is-invalid";
                }
                ?>
                "
                id="exampleInputEmail1" name="acik" maxlength="255" minlength="10"> 
                <div class="invalid-feedback">
        <?php 
      echo $acik_err;  
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
           
            </div>
</form>


    
  </div>
</div>

<script>
  function showPopup() {
    // Get the popup elements
    var wrapper = document.getElementById("popup-wrapper");
    var popup = document.getElementById("popup");
    // Show the popup and wrapper
    wrapper.style.display = "block";
    popup.style.display = "block";
  }

  function hidePopup() {
    // Get the popup elements
    var wrapper = document.getElementById("popup-wrapper");
    var popup = document.getElementById("popup");
    // Hide the popup and wrapper
    wrapper.style.display = "none";
    popup.style.display = "none";
  }
</script>

<style>
  #popup-wrapper {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
  }
  
  #popup {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    z-index: 10000;
  }
</style>

</center>

            <div class="d-grid gap-2 col-6 mx-auto">
            <button onClick="parent.location='hesap.php'" style="font-size: 25px;" align="center" class="btn btn-primary">Güncelle</button>
              </div>
              </div>
        
              <br>
<br>    

      

        <center>
    <div style="background-color: lightblue; box-shadow: 2px 5px 3px limegreen; font-color: white;" class="card p 9 " id="footer" align="center">
        <p>2023. Studee. ©All rights reserved. Created by <a href="https://github.com/cesurh?" rel="nofollow">Cesur Huseynzade</a>.</p>
    </div></center>
