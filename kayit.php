<?php

include("baglanti.php");
session_start();

?>
<?php



$username_err="";
$email_err="";
$okul_err="";
$parola_err="";
$repass_err="";
$pn_err="";

if(isset($_POST["sumbit"]))

{
  if(empty($_POST["kullaniciadi"]))
  {
    $username_err="Kullanıcı adı boş geçilemez.";
  }
  else if(strlen($_POST["kullaniciadi"])<10)
  {
    $username_err="Kullanıcı adı en az 10 karakter olmalıdır.";
  }
 
    else{
      $username=$_POST['kullaniciadi'];
    }


    // Email doğrulama
    if(empty($_POST["email"]))
    {
      $email_err="Email boş geçilemez.";
    }
    else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $email_err = "Geçersiz email formatı.";
    }
    else{
      $email=$_POST['email'];
    }


           // numara
  if(empty($_POST["nmara"]))
  {
    $pn_err="Numara  boş geçilemez.";
  }
 
 
    else{
      $nmara=$_POST['nmara'];
    }


       // Okul adı doğrulama
  if(empty($_POST["okuladi"]))
  {
    $okul_err="Okul adı boş geçilemez.";
  }
  else if(strlen($_POST["okuladi"])<6)
  {
    $okul_err="Okul adı en az 6 karakter olmalıdır.";
  }
 
    else{
      $okuladi=$_POST['okuladi'];
    }


    // Parola doğrulama
    if(empty($_POST["parola"]))
    {
      $parola_err="Lütfen şifre giriniz.";
    }
    else{
      $parola=password_hash($_POST["parola"],PASSWORD_DEFAULT);
    }

    // REPASS doğrulama
    if(empty($_POST["parolatkr"]))
    {
      $repass_err="Lütfen şifrenizi doğrulayınız.";
    }
    else if($_POST["parola"]!=$_POST["parolatkr"])
    {
      $repass_err="Şifreler eşleşmiyor.";
    }
    else{
      $paorlatkr=$_POST["parolatkr"];
    }









  if(isset($username) && isset($email) && isset($nmara) && isset($okuladi) && isset($parola) && isset($paorlatkr))
  {



    $name=$_POST["kullaniciadi"];
    $email=$_POST["email"];

    $ekle="INSERT INTO `kullanicilar` (`ide`, `kullanici_adi`, `email`, `nmara`,  `okuladi`, `wuser`, `parola`, `kayit_tarihi`) VALUES (NULL, '$username', '$email', '$nmara', '$okuladi', '', '$parola', CURRENT_TIMESTAMP)";
    $calistirekle = mysqli_query($baglanti,$ekle);
    

    if($calistirekle) {
        echo '<div class="alert alert-success" role="alert">
        Kayıt başarılı bir şekilde eklendi
      </div>';
    }
    else{
      echo '<div class="alert alert-danger" role="alert">
      Kaydınız eklenirken bir hata oluştu.
      Lütfen Tekrar deneyin
    </div>';
    }

    mysqli_close($baglanti);
}
}

?>



<!doctype html>
<html lang="tr" dir="TR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.rtl.min.css" integrity="sha384-dc2NSrAXbAkjrdm9IYrX10fQq9SDG6Vjz7nQVKdKcJl3pC+k37e7qJR5MVSCS+wR" crossorigin="anonymous">
    <link rel="icon" href="aicon1.png" type="image/x-icon" />

    <title>ÜYE KAYIT İŞLEMİ</title>
   <style>
  
   </style>
  </head>
  <body style="background-color: lightgrey;">
  
      <br>
  <center><div id="123345" style="float:  center;">
<img src="Studeel1.png" style="float:; padding:0 0px 0px 0;" class="flex-shrink-0 me-3"  alt="Logo" />
</div>
<div >
  <div class="" style="background-color:; border-size: 510px;" name="grup" class="d-flex position-relative"  role="group" aria-label="Basic outlined example">
  
  
  <button type="button"  name="anasayfa" onclick="window.location.href = 'anasayfa.php'; " class="btn btn-outline-danger">Anasayfa</button>
  <button type="button"  name="giris" onClick="parent.location='login.php'"  class="btn btn-outline-secondary">Giriş Yap</button>
  <button type="button"  name="bizkimiz" onClick="parent.location='aboutus.php'" class="btn btn-outline-success">Biz kimiz</button>
</div>
</div>
</center>
<br>
<br>
<br>

    <center><h2 style="color:; "></h2></center>
    <div  class="container p-5">
        <div style="box-shadow: 2px 5px 3px limegreen; " class="card p-5">
        
        <center><big><h3 style="color: red; ">Yeni Bir Hesap Oluştur</h3></center>

        <center><h5 style="color: grey; ">Hızlı ve kolaydır!</h5></big></center>

                    <form action="kayit.php" style="background: #fff;" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text"  class="form-control 
                
                <?php
                if(!empty($username_err))
                {
                  echo "is-invalid";
                }
                ?>
                "
                id="exampleInputEmail1" name="kullaniciadi" maxlength="20" minlength="10">
                <div class="invalid-feedback">
        <?php 
      echo $username_err;  
        ?>
      </div>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" email ngModal class="form-control 
                
                <?php
                if(!empty($email_err))
                {
                  echo "is-invalid";
                }
                ?>
                "
                
                id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="@ " maxlength="35" minlength="15">
                <div class="invalid-feedback">
        <?php
      echo $email_err;
      ?>
      </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputnumara" class="form-label">Phone number</label>
                <input type="tel" class="form-control 
               
               <?php
                if(!empty($pn_err))
                {
                  echo "is-invalid";
                }
                ?>
                "
                
                id="exampleInputEmail1" aria-describedby="emailHelp" name="nmara" placeholder="0########## gibi yazınız " maxlength="11" minlength="10">
                <div class="invalid-feedback">
        <?php
      echo $pn_err;
      ?>
      </div>
            </div>
            
            <div class="mb-3">
                <label for="exampleInputokul1"  class="form-label">Okul</label>
                <input type="text" class="form-control 

                <?php
                if(!empty($okul_err))
                {
                  echo "is-invalid";
                }
                ?>
                
                
                "
                
                id="exampleInputokul1" name="okuladi" maxlength="40" minlength="15">
                <div class="invalid-feedback">
        <?php
      echo $okul_err;
      ?>
      </div>

            <div class="mb-3">
                <label for="exampleInputPassword1"  class="form-label">Password</label>
                <input type="password" class="form-control 

                <?php
                if(!empty($parola_err))
                {
                  echo "is-invalid";
                }
                ?>
                
                
                "
                
                id="exampleInputPassword1" name="parola" placeholder="🔑" maxlength="20" minlength="6">
                <div class="invalid-feedback">
        <?php
      echo $parola_err;
      ?>
      </div>

      <div style="float: left;" class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confrim password</label>
                <input type="password" class="form-control  

                <?php
                if(!empty($repass_err))
                {
                  echo "is-invalid";
                }
                ?>
                
                
              s
               " id="exampleInputPassword1" name="parolatkr" maxlength="20" minlength="6">
                <div class="invalid-feedback">
        <?php
      echo $repass_err;
        ?>
     
      </div><br><center>
           <div  class="col-12">
    <div  class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree to <a href="home.php">terms</a> and <a href="home.php">conditions</a>
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>
   
              </center>
            </div>
            <br>
            <?php
            if(isset($_SESSION["username"]))
{
  echo "<div class='alert alert-Danger' role='alert'><center><h3>
    Yeni Kayıt Oluşturmak İçin Çıkış Yapın
  </h3></center></div>";
}
else
{
    echo "<div class='d-grid gap-2 col-6 mx-auto'>
            <button type='submit' name='sumbit' style='font-size: 25px;' align='center' class='btn btn-primary'>Email doğrulama</button>
              </div>";
}



?>

            
            </form>

        </div>
      
    </div><br><br>
    
    </div><center>
    <div style="background-color: lightblue; box-shadow: 2px 5px 3px limegreen; font-color: white;" class="card p 9 " id="footer" align="center">
        <p>2023. Studee. ©All rights reserved. Created by <a href="https://github.com/cesurh?" rel="nofollow">Cesur Huseynzade</a>.</p>
    </div></center>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    -->
  </body>
</html>