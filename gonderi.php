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
$sql7 = "SELECT * FROM mesajs WHERE gonderen='$ide'";
$result5 = $baglanti->query($sql7);

if ($result5->num_rows > 0) {
    // Mesajları bir tablo içinde listeleyelim
    echo '<table><tr style="color:white;"><th>Alıcı</th><th>Mesaj</th><th>Tarih</th></tr>';
    while ($row = $result5->fetch_assoc()) {
        $alici_id = $row["alici"];
        $msj = $row["msja"];
        $tarih = $row["tarih"];

        // Alıcının kullanıcı adını alalım
        $sql8 = "SELECT kullanici_adi FROM kullanicilar WHERE ide='$alici_id'";
        $result6 = $baglanti->query($sql8);
        
        // Alıcının kullanıcı adı varsa, ekrana yazdırın
        if ($result6->num_rows > 0) {
            $row2 = $result6->fetch_assoc();
            $alici_adi = $row2["kullanici_adi"];
            // Her mesaj için bir satır gösterelim
            echo '<tr style="color:black;"><td>'.$alici_adi.'</td><td> '.$msj.'</td><td> '.$tarih.'</td></tr>';
        }
    }
    echo '</table>';
} else {
    echo 'Hiç mesaj göndermediniz';
}
?>