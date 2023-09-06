<?php
include("baglanti.php");

  

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

// Veritabanına bağlanma kodu buraya gelecek

// Kullanıcı adına göre mesajları sorgula
$sql5 = "SELECT * FROM mesajs WHERE alici='$ide'";
$result3 = $baglanti->query($sql5);

if ($result3->num_rows > 0) {
    // Mesajları bir tablo içinde listeleyelim
    echo '<table><tr style="color:white;"><br><th>Gönderen</th><th>Mesaj</th><br><th>Tarih</th></tr>';
    while ($row = $result3->fetch_assoc()) {
        $gonderen_id = $row["gonderen"];
        $msj = $row["msja"];
        $tarih = $row["tarih"];

        // Gönderenin kullanıcı adını alalım
        $sql6 = "SELECT kullanici_adi FROM kullanicilar WHERE ide='$gonderen_id'";
        $result4 = $baglanti->query($sql6);
        $row2 = $result4->fetch_assoc();
        $gonderen_adi = $row2["kullanici_adi"];
        // Her mesaj için bir satır gösterelim
        echo '<tr style="color:black;"><td>'.$gonderen_adi.'</td><td> '.$msj.'</td><td> '.$tarih.'</td></tr>';
    }
    echo '</table>';
} else {
    echo 'Hiç mesajınız yok';
}
?>
