<?php
    $sunucu_adi = "localhost";
    $kullanici_adi = "root";
    $sifre = "";
    $veri_tabani = "uyelik";
    $baglanti = new mysqli($sunucu_adi, $kullanici_adi, $sifre, $veri_tabani, 3306);

    if($baglanti->connect_error)
        die("Bağlantı sağlanamadı:".$baglanti->connect_error);
    /*else
      echo "Bağlantı başarılı";*/
?>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</head>
<style>
    form {
  margin: 20px auto;
  max-width: 500px;
  padding: 20px;
  background-color: #f8f8f8;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
textarea {
  width: 100%;
  max-width: 100%;
  min-width: 100%;
  
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 3px;
  box-sizing: border-box;
  font-size: 16px;
}
textarea {
    min-height:150px;
}

input[type="submit"] {
  display: block;
  margin: 20px auto;
  padding: 10px 20px;
  background-color: #4caf50;
  border: none;
  border-radius: 3px;
  color: #fff;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
  background-color: #3e8e41;
}

.alert {
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid transparent;
  border-radius: 4px;
}

.alert-success {
  background-color: #dff0d8;
  border-color: #d6e9c6;
  color: #3c763d;
}

.alert-danger {
  background-color: #f2dede;
  border-color: #ebccd1;
  color: #a94442;
}
</style>



<br>
<center>
    <h2 style="color:blue; font-family:jurabold;">User Data System</h2>
</center>









<!-- Arama kutusu ve gösterim -->
<div style="display:flex; ">
    <form action="contact.php" method="post" style="width:100%; height:200px;">
        <label for="search_query">Arama:</label>
        <input type="text" id="search_query"  name="search_query">
        <input type="submit" name="search" value="Ara">
    </form>
</div>





<?php
// Arama işlevselliği
if(isset($_POST["search"]) && !empty($_POST["search_query"])) {
    $search_query = $_POST["search_query"];
    $arama_sorgusu1 = "SELECT * FROM `kullanicilar` WHERE `kullanici_adi` LIKE '%$search_query%'";
    $arama_sorgusu2 = "SELECT * FROM `ips` WHERE `username` LIKE '%$search_query%'";
    $arama_sonucu1 = mysqli_query($baglanti, $arama_sorgusu1);
    $arama_sonucu2 = mysqli_query($baglanti, $arama_sorgusu2);

    if(mysqli_num_rows($arama_sonucu1) > 0 || mysqli_num_rows($arama_sonucu2) > 0) {
        echo '<div style="display:flex; justify-content:center; flex-wrap: wrap;">'; // div ile ortalamaya başlıyoruz
        
        while($row1 = mysqli_fetch_assoc($arama_sonucu1)) {
            echo '<div class="card" style="width: 18rem;margin:1rem;">'; // card divi içinde verileri yazdırıyoruz
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row1["kullanici_adi"] . '</h5>';
            echo '<p class="card-text"><h6 style="color:red;">Email: </h6>' . $row1["email"] . '</p>';
            echo '<p class="card-text"><h6 style="color:red;">Tel: </h6>' . $row1["nmara"] . '</p>';
            echo '<p class="card-text"><h6 style="color:red;">Okul: </h6>' . $row1["okuladi"] . '</p>';
            if($row1["wuser"] == 1){
                echo '<p class="card-text"><h6 style="color:red;">Kullanıcı Tipi: </h6>Eğitmen</p>';
            } else {
                echo '<p class="card-text"><h6 style="color:red;">Kullanıcı Tipi: </h6>Öğrenci</p>'; 
            }
            echo '<p class="card-text"><h6 style="color:red;">Kayıt Tarihi: </h6>' . $row1["kayit_tarihi"] . '</p>';
            
            if(mysqli_num_rows($arama_sonucu2) > 0) {
                while($row2 = mysqli_fetch_assoc($arama_sonucu2)) {
                    echo '<p class="card-text"><h6 style="color:red;">İp: </h6>' . $row2["ip"] . '</p>';
                }
            } else {
                echo '<p class="card-text"><h6 style="color:red;">İp: </h6>Giriş Yapmadı</p>'; 
            }
            
            echo '</div>';
            echo '</div>';
        }
        
        echo '</div>'; // div ile ortalamayı kapatıyoruz
    } else {
        echo "Aranan isim veritabanında bulunamadı.";
    }
}
?>

