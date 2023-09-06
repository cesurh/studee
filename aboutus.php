<?php

session_start();



?>
<!DOCTYPE html>
<html>
  <head>    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.rtl.min.css" integrity="sha384-dc2NSrAXbAkjrdm9IYrX10fQq9SDG6Vjz7nQVKdKcJl3pC+k37e7qJR5MVSCS+wR" crossorigin="anonymous">

    <title>Studee - Ücretli Online Eğitimler</title>

    <style>
        /* Üstbilgi stilleri */
header {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #f2f2f2;
  padding: 10px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  position: fixed;
}
img {
    height: 15;
    width: 10%;
}

h1 {
  font-size: 30px;
  margin: 0;
}

nav ul {
  list-style: none;
  display: flex;
  margin: 0;
  padding: 0;
}

nav ul li {
  margin-right: 20px;
}

nav ul li:last-child {
  margin-right: 0;
}

nav ul li a {
  color: #333;
  text-decoration: none;
  font-size: 18px;
}

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
  border: 2px solid #fff;
  border-radius: 30px;
  background-color: transparent;
  color: #000;
  font-size: 18px;
  text-decoration: none;
  margin-top: 20px;
  
  transition: all 0.3s;
}



/* Kurslar stilleri */
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
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  position: ;
}

.course img {
  width: 100%;
  height: 200px;
  object-fit: cover;
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
}


    </style>
  </head>
  <body>
<center>
    <header>
    <img src="studeel1.png" class="send" alt="Logo" />
      <nav>
        <ul>
        <div class="btn-group" style="border-radius: 10px;" name="grup"  role="group" aria-label="Basic outlined example">
  <li><button type="button" name="Astronom" onClick="parent.location='anasayfa.php'" style="border-radius: 90px;" class="btn btn-outline-danger"> Anasayfa</button></li>
  <li>
    <?php  if(isset($_SESSION["username"]))
{
    echo "<li><a type='button'   href='hesap.php' style='color: blue; border-radius: 90px;' class='btn btn-outline-info'> Join Us</a></li>";
}
else
{
    echo "<li><a type='button'   href='kayit.php' style='color: blue; border-radius: 90px;' class='btn btn-outline-info'> Join Us</a></li>";
}
?>
</li>
  <li><button type="button" name="Coğrafya" style="color: red; border-radius: 90px;" class="btn btn-outline-warning"> Projects</button></li>
  <li><button type="button" name="Felsefe" style="color: orange; border-radius: 90px;" class="btn btn-outline-success"> Our Goals</button></li>
</div>       

          <li><?php  if(isset($_SESSION["username"]))
{
    echo "";
}
else
{
    echo "<li><a type='button'   href='kayit.php'>Kayıt Ol</a></li>

";
}
?>
  
  
</li>
          <li><a ><?php  if(isset($_SESSION["username"]))
{
    echo "<li><center><a type='button'  href='profil.php' style=' border-radius: 90px;' class='btn btn-outline-primary' > <h5>".$_SESSION["username"]."</h5></a></li>";
}
else
{
    echo "<li><a type='button'    href='login.php' >Giriş Yap</a></li>"; # istersen eklersin
}
?></a></li>
        </ul>
      </nav>
    </header>
</center>
    

<br>
<br>
<br>
<!DOCTYPE html>
<html>
<head>
	<title>Biz Kimiz? - Studee</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style>
		.container {
			margin-top: 50px;
		}
	</style>
</head>
<body>
  
	<div class="container">



  <!-- HAREKETLİ BÖLÜM-->
  <style>
  @import "https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap";

.animation_text h1 {
font-family:"Poppins",Sans-serif;
text-align:center;
color:#373150;
font-size:60px;
font-weight:500;
line-height:70px;
}

.animation_text h1 span {
color:#56A274
}

@media(max-width:768px) {
.animation_text h1 {
font-size:30px
}
} 
</style>
<script>
  var Text = function(el, toRotate, period) {
  this.toRotate = toRotate;
  this.el = el;
  this.loopNum = 0;
  this.period = parseInt(period, 10) || 2000;
  this.txt = '';
  this.tick();
  this.isDeleting = false;
};

Text.prototype.tick = function() {
  var i = this.loopNum % this.toRotate.length;
  var fullTxt = this.toRotate[i];

  if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
  } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
  }

  this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

  var that = this;
  var delta = 200 - Math.random() * 100;

  if (this.isDeleting) { delta /= 2; }

  if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
  } else if (this.isDeleting && this.txt === '') {
    this.isDeleting = false;
    this.loopNum++;
    delta = 500;
  }

  setTimeout(function() {
    that.tick();
  }, delta);
};

window.onload = function() {
  var elements = document.getElementsByClassName('typewrite');
  for (var i=0; i<elements.length; i++) {
    var toRotate = elements[i].getAttribute('data-words');
    var period = elements[i].getAttribute('data-period');
    if (toRotate) {
      new Text(elements[i], JSON.parse(toRotate), period);
    }
  }
}; 
</script>
<!--Form Bölgesi-->
<div class="animation_text">
         <h1>
             <span class="typewrite"
                   data-period="2000"
                   data-words='[" Eğitim.", " Teknoloji.", " İnovasyon."]'>
             </span>
         </h1>
     </div>

		<h1>Biz Kimiz?</h1>
		<p>Studee, öğrencilere ve öğretmenlere online eğitim platformu sunan bir şirkettir. 2020 yılında kurulan şirketimiz, öğrencilerin başarıya ulaşmalarına yardımcı olmak ve öğretmenlere yeni bir öğretim deneyimi sunmak amacıyla kurulmuştur.</p>

		<h2>Vizyonumuz</h2>
		<p>Studee, öğrencilerin akademik başarılarına katkıda bulunmak için herkes için erişilebilir ve etkili bir öğrenim ortamı yaratmayı hedeflemektedir. Bu doğrultuda, en son teknolojileri kullanarak, öğrencilere öğrenme deneyimlerini kişiselleştirme imkanı sunuyoruz.</p>

		<h2>Misyonumuz</h2>
		<p>Studee, öğrencilerin öğrenme süreçlerinde etkili ve verimli bir şekilde ilerlemelerini sağlayan çözümler sunar. Bu amaçla, öğrencilerin ihtiyaçlarına uygun eğitim materyalleri ve destekleyici kaynaklar sunarız.</p>

		<h2>Ekibimiz</h2>
		<p>Studee'nin başarısının arkasında, uzman bir ekip yer almaktadır. Şirketimizde, eğitim teknolojileri, yazılım geliştirme, pazarlama ve işletme alanlarında deneyimli profesyoneller bulunmaktadır.</p>

		<h2>İletişim</h2>
		<p>Studee ile ilgili herhangi bir sorunuz varsa, lütfen bizimle <a href="mailto:info@studee.com">info@studee.com</a> adresinden iletişime geçin.</p>
	</div>
</body>
</html>

<br>
<br>

        <footer>    
            
              <p>2023. Studee. ©All rights reserved. Created by <a href="https://github.com/cesurh?" rel="nofollow">Cesur Huseynzade</a>.</p>
        

    </footer>
  </body>
</html>
