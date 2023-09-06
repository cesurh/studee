<?php

session_start();
if (!isset($_SESSION["username"])) {
	header("Location: login.php");
	exit();
}


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





.imagesi:hover{
  
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

<!-- Header-->
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
<br><br><br><br>
<center><h2 style="color:red;">Console </h2></center>
<br>

<!--Form Bölgesi-->
<form action="plang.php" method="POST" style="background-color: ;">
    <input name="cons" class="form-control <?php if(isset($cons_err) && !empty($cons_err)) echo "is-invalid"; ?>" style="width: 700px;" cols="10" rows="10" id="exampleInputokul1" placeholder=" Use as an AI (say 'Merhaba') or Programming lang( try print_b(Hello World!) )" required>
    <div class="invalid-feedback">
        <?php echo isset($cons_err) ? $cons_err : ""; ?>
    </div>
    <br>
    <button type="submit" name="gonder" style="font-size: 15px;" class="btn btn-primary">Gönder</button>
</form>
<br><br>

<br><br>

<?php
$cons_err = "";
if (isset($_POST["gonder"])) {
    // İnput
    if (empty($_POST["cons"])) {
        $cons_err = "Input boş geçilemez.";
    }
    if (!empty($cons_err)) {
        echo "<div class='alert alert-danger'>Form gönderilemedi. Lütfen gerekli alanları doldurunuz.</div>";
    } else {
        // Cons girdisi birden fazla satıra bölünmüşse her bir satırı çalıştır ve çıktıları alt alta yazdır
        $lines = explode(PHP_EOL, $_POST["cons"]);
        foreach ($lines as $line) {
            $sonuc = "";

            // Eğer input içerisinde print_b(yazı) varsa, yazıyı ekrana yazdır
            if (strpos($line, "print_b(") !== false) {
                $yazi = substr($line, 8, -1);
                
                if (strpos($yazi, "https://www.youtube.com/") !== false) {
                  // Eğer yazı içerisinde YouTube bağlantısı bulunuyorsa
                  $video_id = getYoutubeVideoId($yazi);
                  if ($video_id !== false) {
                      $embed_url = "https://www.youtube.com/embed/" . $video_id;
                      $sonuc = "<center><iframe width='460' height='315' src='$embed_url' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe></center>";
                    
                  } 
              } elseif (strpos($yazi, "+") !== false && strpos($yazi, "*") !== false) {
                    // Hem çarpma hem de toplama işlemi varsa
                    $temp = explode("+", $yazi);
                    $toplam = 0;
                    $carpim = 1;
                    foreach ($temp as $value) {
                        if (strpos($value, "*") !== false) {
                            $degerler = explode("*", $value);
                            foreach ($degerler as $deger) {
                                $carpim *= $deger;
                            }
                        } else {
                            $toplam += intval(trim($value));
                        }
                    }
                    $sonuc = $toplam + $carpim;
                } elseif (strpos($yazi, "+") !== false) {
                    // Sadece toplama işlemi varsa
                    $temp = explode("+", $yazi);
                    $sonuc = 0;
                    foreach ($temp as $value) {
                        $sonuc += intval(trim($value));
                    }
                } elseif (strpos($yazi, "*") !== false) {
                    // Sadece çarpma işlemi varsa
                    $degerler = explode("*", $yazi);
                    $sonuc = 1;
                    foreach ($degerler as $deger) {
                        $sonuc *= intval(trim($deger));
                    }
                } else {
                    // Sadece sayı ya da yazı varsa
                    $sonuc = trim($yazi);
                }
                echo "<script>
                    setTimeout(function() {
                        printWithTypewriting('" . addslashes($sonuc) . "');
                    }, 0);
                </script>";
            } else {
                // print_b ifadesi yoksa ve direkt bir ifade varsa
                $yazi = trim($line);
                if ($yazi == "Merhaba") {
                    $sonuc = "Merhaba ".$_SESSION["username"]." nasılsın?";
                } else {
                    $sonuc = $yazi;
                }
                
                echo "<script>
                    setTimeout(function() {
                        printWithTypewriting('" . addslashes($sonuc) . "');
                    }, 0);
                </script>";
            }
        }
    }
}

function getYoutubeVideoId($url) {
    $video_id = false;
    $url_parts = parse_url($url);
    if (isset($url_parts['query'])) {
        parse_str($url_parts['query'], $query_params);
        if (isset($query_params['v'])) {
            $video_id = $query_params['v'];
        }
    } elseif (strpos($url_parts['path'], 'embed/') === 0) {
        $path_parts = explode('/', $url_parts['path']);
        if (isset($path_parts[2])) {
            $video_id = $path_parts[2];
        }
    }
    return $video_id;
}
?>

<script>
    function typeWriter(text, i, speed) {
        if (i < text.length) {
            document.getElementById("output").innerHTML += text.charAt(i);
            i++;
            setTimeout(function () {
                typeWriter(text, i, speed);
            }, speed);
        }
    }

    // Sonuçları typewriting animasyonuyla yazdırma
    function printWithTypewriting(result) {
        var outputDiv = document.getElementById("output");
        outputDiv.innerHTML = ""; // Temizleme
        typeWriter(result, 0, 50); // 50ms gecikme ile yazdırma hızı
    }
</script>
<div id="output" style="font-family: monospace; background-color:black; color:limegreen; height:auto; width:auto;"></div><br><br><br><br1>
<h3>Documentation</h3><details>
<style>
  @import "https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap";

.animation_text h6 {
font-family:"Poppins",Sans-serif;
text-align:center;
color:#373150;
font-size:60px;
font-weight:500;
line-height:70px;
}

.animation_text h6 span {
color:#56A274
}

@media(max-width:768px) {
.animation_text h6 {
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
<div class="animation_text" style="font-size:45px;">
         <h6>
             <span class="typewrite"
                   data-period="2000"
                   data-words='[" print_b ile basit işlemler." ]'>
             </span>
         </h6>
     </div>

</details>
 

<br><br><br>






