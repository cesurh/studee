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


?><?php
           

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
$isimd_err="";
$email_err="";



if(isset($_POST["named"]))

{
  // Kullanıcı adı doğrulama
  
 
    if(empty($_POST["isimd"]))
  {
    $isimd_err="Kullanıcı adı boş geçilemez.";
  }
  else if(strlen($_POST["isimd"])<6)
  {
    $isimd_err="Kullanıcı adı en az 6 karakter olmalıdır.";
  }
 
    else{
      $isimd=$_POST["isimd"];
    }






  if(isset($isimd)) //if(isset($$parola2));   
  {



    
   
    
    $edit="UPDATE `kullanicilar` SET `kullanici_adi` = '$isimd' WHERE `kullanicilar`.`ide` = '$ide'";
    $calistirguncelle = mysqli_query($baglanti,$edit);
    
if($calistirguncelle) {
    echo '<div class="alert alert-success" name="divi"  role="alert">
    Kullanıcı adı başarılı bir şekilde güncellendi. Güncellemeyi görebilmek için yeniden giriş yapın
  </div>';
}
else{
  echo '<div class="alert alert-danger" role="alert"><center>
  Kaydınız güncellenirken bir hata oluştu.
  Lütfen Tekrar Deneyin
</center></div>';
}


 
}
}

?>
<?php
$emaild_err="";




if(isset($_POST["emaild"]))

{
  // Kullanıcı adı doğrulama
  
 
    if(empty($_POST["mail"]))
  {
    $emaild_err="Email boş geçilemez.";
  }
  else if(strlen($_POST["mail"])<11)
  {
    $emaild_err="Mail en az 11 karakter olmalıdır.";
  }
 
    else{
      $mail=$_POST["mail"];
    }






  if(isset($mail)) //if(isset($$parola2));   
  {



    
   
    
    $edit="UPDATE `kullanicilar` SET `email` = '$mail' WHERE `kullanicilar`.`id` = ".$_SESSION["ide"].";";
    $calistirguncelle = mysqli_query($baglanti,$edit);
    
if($calistirguncelle) {
    echo '<div class="alert alert-success" name="divi"  role="alert">
    Email başarılı bir şekilde güncellendi. Güncellemeyi görebilmek için yeniden giriş yapın
  </div>';
}
else{
  echo '<div class="alert alert-danger" role="alert"><center>
  Kaydınız güncellenirken bir hata oluştu.
  Lütfen Tekrar Deneyin
</center></div>';
}


 
}
}

?>
<?php
$nmrad_err="";




if(isset($_POST["nmarad"]))

{
  // Kullanıcı adı doğrulama
  
 
    if(empty($_POST["nmra"]))
  {
    $nmrad_err="Numara boş geçilemez.";
  }
  else if(strlen($_POST["nmra"])<11)
  {
    $nmrad_err="Numara en az 11 karakter olmalıdır.";
  }
 
    else{
      $nmra=$_POST["nmra"];
    }






  if(isset($nmra)) //if(isset($$parola2));   
  {



    
   
    
    $edit="UPDATE `kullanicilar` SET `nmara` = '$nmra' WHERE `kullanicilar`.`id` = ".$_SESSION["ide"].";";
    $calistirguncelle = mysqli_query($baglanti,$edit);
    
if($calistirguncelle) {
    echo '<div class="alert alert-success" name="divi"  role="alert">
    Numara başarılı bir şekilde güncellendi. Güncellemeyi görebilmek için yeniden giriş yapın
  </div>';
}
else{
  echo '<div class="alert alert-danger" role="alert"><center>
  Kaydınız güncellenirken bir hata oluştu.
  Lütfen Tekrar Deneyin
</center></div>';
}


 
}
}

?>
<?php
$okld_err="";

$id=$_SESSION["id"];


if(isset($_POST["okld"]))

{
  // Kullanıcı adı doğrulama
  
 
    if(empty($_POST["schd"]))
  {
    $okld_err="Okul adı boş geçilemez.";
  }
  else if(strlen($_POST["schd"])<10)
  {
    $okld_err="Numara en az 10 karakter olmalıdır.";
  }
 
    else{
      $schd=$_POST["schd"];
    }






  if(isset($schd)) //if(isset($$parola2));   
  {



    
   
    
    $edit="UPDATE `kullanicilar` SET `okuladi` = '$schd' WHERE `kullanicilar`.`id` = ".$_SESSION["ide"].";";
    $calistirguncelle = mysqli_query($baglanti,$edit);
    
if($calistirguncelle) {
    echo '<div class="alert alert-success" name="divi"  role="alert">
    Okul adı başarılı bir şekilde güncellendi. Güncellemeyi görebilmek için yeniden giriş yapın
  </div>';
}
else{
  echo '<div class="alert alert-danger" role="alert"><center>
  Kaydınız güncellenirken bir hata oluştu.
  Lütfen Tekrar Deneyin
</center></div>';
}


 
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
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

    <title>Profile</title>
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

 
   
   </style>
  </head>
  <header style="background-color: lightgrey;">
  <body  style="background-color: lightgrey;">
  <ul>
  <img src="Studeel1.png" class="send" alt="Logo" />
  <br><br><br>
  <li ><a class="" href="profil.php"><img class="tamam"   src="ger.png" style="widht: 25px; height: 30px;" id="tamam" alt="profile" /><h5>Back</h5></a></li>
  <br>
  <li ><a class="" href="anasayfa.php"><img class="tamam"   src="home (1).png" style="widht: 25px; height: 30px;" id="tamam" alt="profile" /><h5>Home</h5></a></li>
<br>
  <li ><a class="" href="anasayfa.php"><img class="tamam"   src="megap.png" style="widht: 25px; height: 30px;" id="tamam" alt="profile" /><h5>News</h5></a></li>

  <br>
  <li ><a class="" href="anasayfa.php"><img class="tamam"   src="sss.png" style="widht: 25px; height: 30px;" id="tamam" alt="profile" /><h5>SSS</h5></a></li>

  <li ><a class="" href="aboutus.php"><img class="tamam"   src="users.png" style=" hover-color: red; widht: 25px; height: 30px;" id="tamam" alt="profile" /><h5>About</h5></a></li>

</ul>
      <br>

  
<?php
if(isset($_SESSION["username"]))
{

    echo "<center><h1 style='color:darkorange;'>Your Profile ".$_SESSION["username"]."</h1></center>";
    
}
else
{
    echo "<center>Bu sayfayı görüntülemeye yetkiniz yoktur</center>";
}
?><center>

<form>
   <div style="float: center;" id="box">
       <input type="text" id="search" placeholder="Ara..">
       <i class="fa fa-search"></i>
   </div>
</form>


</center>

<br>
<br>
<div style="float: center; width: 1090px;"  class="container p-5">
        <div style="box-shadow: 2px 5px 3px limegreen; " class="card p-5">
        
        <center><big><h3 style="color: red; ">Profil bilgilerinizi değiştirin!</h3></center>

        <center><h5 style="color: grey; ">Hızlı ve kolaydır!</h5></big></center>
<?php
   
?>
                    <form action="profile.php?" style="background: #fff;" method="POST">
                    <div class="btn-group" name="grup"  role="group" aria-label="Basic outlined example">
   <div class="mb-3">
   
            
                <label for="exampleInputokul1"  class="form-label" >Username</label>
              <p type="text" class="form-control" weigth="500" heigth="600"
              
              id="exampleInputokul1" name="nema" ><?php
if(isset($_SESSION["username"]))
{

    echo "".$_SESSION["username"]."";
    
}
else
{
    echo "Bu sayfayı görüntülemeye yetkiniz yoktur";
}
?></p>
                
                
                
                <div class="invalid-feedback">
        <?php
      echo $nmara_err;
      ?>
      </div>
      
      
    
     
      </div><br>
            </div><button type="button" name="oye" onclick="gizleGoster('nameuser');" style="color: blue;" class="btn btn-outline-info" >Değiştir </button>
         
         
         
         
         
         
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

<p id="nameuser" style="display: none;"  
  <h6>İsmini değiştir</h6>
  <form action="profile.php?id=<? $ide; ?>" method="POST" style="background-color: grey;">
  <input type="text" name="isimd" class="form-control
  <?php
  if(!empty($isimd_err))
    {
     echo "is-invalid";
    }
  ?>
  " weigth="500"
              
              id="exampleInputokul1"  placeholder="<?php
if(isset($_SESSION["username"]))
{

    echo "". $uusername ."";
    
}
else
{
    echo "Bu sayfayı görüntülemeye yetkiniz yoktur";
}
?>" maxlength="20" minlength="10">
   
            <button type="submit" name="named" style="font-size: 15px;" class="btn btn-primary">Değiştir</button>
</form>   <div class="invalid-feedback">
        <?php
      echo $isimd_err;
      ?>
      </div>
              







           <br>

            <div class="btn-group" name="grup"  role="group" aria-label="Basic outlined example">
   <div class="mb-3">
            
                <label for="exampleInputokul1"  class="form-label" >Email adress</label>
              <p type="text" class="form-control" weigth="500"
              
              id="exampleInputokul1" name="email" ><?php
if(isset($_SESSION["email"]))
{

    echo "".$_SESSION["email"]."";
    
}
else
{
    echo "Bu sayfayı görüntülemeye yetkiniz yoktur";
}
?></p>
                
                
                
                <div class="invalid-feedback">
        <?php
      echo $nmara_err;
      ?>
      </div>
      
      
      

      
     
      </div><br>
            </div><button type="button" name="oyen" onclick="gizleGoster('mailuser');" style="color: blue;" class="btn btn-outline-info" >Değiştir </button>
            
            
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

 

  <form action="profile.php" id="mailuser" style="display: none;" method="POST" style="">
    <h6>Emailini değiştir</h6>
  <input type="email" name="mail" class="form-control
  <?php
  if(!empty($emaild_err))
    {
     echo "is-invalid";
    }
  ?>
  " weigth="500"
              
              id="exampleInputokul1"  placeholder="<?php
if(isset($_SESSION["email"]))
{

    echo "".$_SESSION["email"]."";
    
}
else
{
    echo "Bu sayfayı görüntülemeye yetkiniz yoktur";
}
?>" maxlength="35" minlength="10">
   
            <button type="submit" name="emaild" style="font-size: 15px;" class="btn btn-primary">Değiştir</button>
</form></p> <div class="invalid-feedback">
        <?php
      echo $emaild_err;
      ?>
      </div>



           <br>

            <div class="btn-group" name="grup"  role="group" aria-label="Basic outlined example">
   <div class="mb-3">
            
                <label for="exampleInputokul1"  class="form-label" >Number</label>
              <p type="text" class="form-control" weigth="500"
              
              id="exampleInputokul1" name="phonumber" ><?php
if(isset($_SESSION["nmara"]))
{

    echo "".$_SESSION["nmara"]."";
    
}
else
{
    echo "Bu sayfayı görüntülemeye yetkiniz yoktur";
}
?></p>


                
                
                
                <div class="invalid-feedback">
        <?php
      echo $nmara_err;
      ?>
      </div>
      

    
     
      </div><br>
            </div><button type="button" name="oye" onclick="gizleGoster('nmarauser');" style="color: blue;" class="btn btn-outline-info" >Değiştir </button>

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

 

  <form action="profile.php" id="nmarauser" style="display: none;" method="POST" style="">
    <h6>Numarayı değiştir</h6>
  <input type="tel" name="nmra" class="form-control
  <?php
  if(!empty($nmrad_err))
    {
     echo "is-invalid";
    }
  ?>
  " weigth="500"
              
              id="exampleInputokul1"  placeholder="<?php
if(isset($_SESSION["nmara"]))
{

    echo "".$_SESSION["nmara"]."";
    
}
else
{
    echo "Bu sayfayı görüntülemeye yetkiniz yoktur";
}
?>" maxlength="11" minlength="10">
   
            <button type="submit" name="nmarad" style="font-size: 15px;" class="btn btn-primary">Değiştir</button>
</form></p> <div class="invalid-feedback">
        <?php
      echo $emaild_err;
      ?>
      </div>      
        
           <br>





<div class="btn-group" name="grup"  role="group" aria-label="Basic outlined example">
   <div class="mb-3">
            
                <label for="exampleInputokul1"  class="form-label" >School</label>
              <p type="text" class="form-control" weigth="500"
              
              id="exampleInputokul1" name="okuladi" ><?php
if(isset($_SESSION["okuladi"]))
{

    echo "".$_SESSION["okuladi"]."";
    
}
else
{
    echo "Bu sayfayı görüntülemeye yetkiniz yoktur";
}
?></p>
                
                
                
                <div class="invalid-feedback">
        <?php
      echo $okuladi_err;
      ?>
      </div>
      
      
      

      
          


    


    
     
      </div><br>
            </div><button type="button" name="oye" onclick="gizleGoster('oschuser');" style="color: blue;" class="btn btn-outline-info" >Değiştir </button>
        
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

 

  <form action="profile.php" id="oschuser" style="display: none;" method="POST" style="">
    <h6>Okulunu değiştir</h6>
  <input type="text" name="schd" class="form-control
  <?php
  if(!empty($okld_err))
    {
     echo "is-invalid";
    }
  ?>
  " weigth="500"
              
              id="exampleInputokul1"  placeholder="<?php
if(isset($_SESSION["okuladi"]))
{

    echo "".$_SESSION["okuladi"]."";
    
}
else
{
    echo "Bu sayfayı görüntülemeye yetkiniz yoktur";
}
?>" maxlength="35" minlength="10">
   
            <button type="submit" name="okld" style="font-size: 15px;" class="btn btn-primary">Değiştir</button>
</form></p> 

</div>
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
?>
            <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" name="sumbit" onClick="parent.location='profile.php'" style="font-size: 25px;" align="center" class="btn btn-primary">Güncelle</button>
              </div>
        
               <br>

             </div> 
           </div> 
            </form>

        </div>

        <center>
    <div style="background-color: lightblue; box-shadow: 2px 5px 3px limegreen; font-color: white;" class="card p 9 " id="footer" align="center">
        <p>2023. Studee. ©All rights reserved. Created by <a href="https://github.com/cesurh?" rel="nofollow">Cesur Huseynzade</a>.</p>
    </div></center>
