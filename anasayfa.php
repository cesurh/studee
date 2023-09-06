<?php
include("baglanti.php");
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
  opacity: 0.7;
}
header:hover {
  opacity: 1.0;
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
  color:black;
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
  background-image: linear-gradient(#5155A6, #66B1F2, #F2C49B);
  color:black;
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
  color:black;
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
.logo {
  opacity: 1.0;
}
.logo:hover {
  opacity: ;
}


    </style>
  </head>
  <body>
<center>
    <header>
    <img src="studeel1.png" class="send" id="logo" alt="Logo" />
      <nav>
        <ul>
        <div class="btn-group" style="border-radius: 10px;" name="grup"  role="group" aria-label="Basic outlined example">
  <li><button type="button" name="Astronom" onClick="parent.location='aboutus.php'" style="border-radius: 90px;" class="btn btn-outline-danger"> About Us</button></li>
  <li><?php  if(isset($_SESSION["username"]))
{
    echo "<li><a type='button' name='Yaazılım'  href='hesap.php' style='color: blue; border-radius: 90px;' class='btn btn-outline-info'> Join Us</a></li>";
}
else
{
    echo "<li><a type='button' name='Yaazılım'  href='kayit.php' style='color: blue; border-radius: 90px;' class='btn btn-outline-info'> Join Us</a></li>

";
}
?></li>
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
    <section class="hero">
  
      <h2>Uzman Eğitmenlerden Ücretli Online Kurslar</h2>
      <p>Studee, istediğiniz herhangi bir konuda öğrenmenizi sağlayacak online kurslar sunar.</p>
      <a href="#" class="button" id="explore" style="color: black;">Keşfet</a>
    </section>
    <script>
        kurs1 = tk.Label(root, text="Kurs 1", bg="white", padx=20, pady=10, font=("Arial", 14), anchor="w")
kurs1.grid(row=0, column=0, sticky="w")
kurs1.config(width=10, height=3)

    </script>
    <div class="container">
    <section class="courses">
  
      <div class="course">
        <img src="cs.jpg" alt="Kurs 1" id="Kurs1">
        <h4>Bilgisayar Bilimleri Ve Proglamlama</h4>
        
        <center><a href="#" class="button">Satın Al</a></center><br>
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
    echo '<h4>'. $row["baslik"] .'</h4>';
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
        <h4>İngilizce Eğitimleri</h4>
        
        <center><a href="#" class="button">Satın Al</a></center>
      </div>


      <div class="course">
        <img src="https://media.istockphoto.com/id/545286316/tr/foto%C4%9Fraf/checking-the-chemical-formula-in-academic-laboratory.jpg?s=612x612&w=0&k=20&c=nyhC3nDOK3xCmSqff7FzrdHjlWFwNewyTZ18nrYGwv8=" alt="Kurs 3">
        <h4>Kimya Eğitimleri</h4>
        
        <center><a href="#" class="button">Satın Al</a></center>
      </div>
    </section>
</div>
    

<div class="container">
  <div class="row">
    <div class="col-md-12 text-center"  >
  
      <img src="1.png"  alt="Resim Açıklaması" style="width: 1100px; heigth: 650; border-radius:15px;  ">
      
    </div>
  </div><center><br>
  <div class="row">
    
    <div class="col-md-12" id="text-section" style="text-align: left;">
    <center><h1>Studee</h1></center>
<p>Studee olarak amacımız, eğitim alanında fark yaratmak, öğrencilerin ve gençlerin hayatını kolaylaştırmaktır. Gençlerin eğitim hayatları boyunca karşılaştıkları zorlukları azaltmak ve onların başarılarına katkıda bulunmak için çalışıyoruz.</p>

<p>Studee olarak, eğitim sürecini daha kolay ve erişilebilir hale getirmek için birçok farklı hizmet sunuyoruz. Gençlerin eğitim kurumlarını seçerken karşılaştıkları zorlukları gidermek ve doğru kararı vermelerine yardımcı olmak için geniş bir veritabanı sağlıyoruz. Bu veritabanında, öğrenciler farklı eğitim kurumlarını, programları, ücretsiz kursları ve diğer önemli projeleri kolayca bulabilirler.</p>

<p>Ayrıca, öğrencilere ve öğrenmeye açık olan herkese eğitimleri sırasında destek olmak için öğretmenler ve öğrenci koçları gibi uzmanlardan oluşan bir ekip sunuyoruz. Bu uzmanlar, gençlerin öğrenme sürecinde ihtiyaç duydukları desteği sağlamak için onlara özel dersler ve koçluk hizmetleri sunuyorlar.</p>

<p>Ve ayrıca birincil veya ek gelir finans ekosistemimiz sayesinde alanında profeyonel ama işsiz insanlar için gelir kaynağı.</p>

<p>Studee olarak amacımız, öğrencilerin eğitim hayatları boyunca karşılaştıkları zorlukları azaltmak ve onların başarılarına katkıda bulunmaktır. Bu nedenle, sürekli olarak yeni hizmetler sunmak ve öğrencilerin ihtiyaçlarını karşılamak için çalışıyoruz. Eğitim alanında fark yaratmak ve öğrencilere yardımcı olmak için, Studee her zaman öğrencilerin yanındadır.</p>


    </div>
  </div></center>
  
</div>

<style>
#image-section {
  margin-top: 30px;
  margin-bottom: 30px;
  box-shadow: 0 30px 40px rgba(0,0,0,0.1);
  border-radius:90px;

}

#text-section h1 {
  color: #007bff;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-size: 36px;
  margin: 0;
}

#text-section p {
  color: #333;
  font-family: Arial, sans-serif;
  font-size: 18px;
  line-height: 1.5;
  margin-top: 10px;
}
</style>

<br>
<br>
<br>
<?php 
?>

        <footer>    
            
              <p>2023. Studee. ©All rights reserved. Created by <a href="https://github.com/cesurh?" rel="nofollow">Cesur Huseynzade</a>.</p>
        

    </footer>
  </body>
</html>
