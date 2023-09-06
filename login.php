<?php
session_start();
try {
    $db = new PDO('mysql:host=localhost;dbname=uyelik', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $username_err = "";
    $parola_err = "";

    if (isset($_POST["giris"])) {
        // Kullanıcı adı doğrulama
        if (empty($_POST["kullaniciadi"])) {
            $username_err = "Kullanıcı adı boş geçilemez.";
        } else {
            $username = $_POST["kullaniciadi"];
        }

        // Parola doğrulama
        if (empty($_POST["parola"])) {
            $parola_err = "Lütfen şifre giriniz.";
        } else {
            $parola = $_POST["parola"];
        }

        if (isset($username) && isset($parola)) {
            $stmt = $db->prepare("SELECT * FROM kullanicilar WHERE kullanici_adi = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $kayitsayisi = $stmt->rowCount();

            if ($kayitsayisi > 0) {
                $ilgilikayit = $stmt->fetch(PDO::FETCH_ASSOC);
                $hashlisifre = $ilgilikayit["parola"];

                if (password_verify($parola, $hashlisifre)) {
                    $_SESSION["username"] = $ilgilikayit["kullanici_adi"];
                    $_SESSION["email"] = $ilgilikayit["email"];
                    $_SESSION["nmara"] = $ilgilikayit["nmara"];
                    $_SESSION["okuladi"] = $ilgilikayit["okuladi"];
                    $_SESSION["id"] = $ilgilikayit["id"];
                    header("location:profil.php");
                    exit;
                } else {
                    echo '<div class="alert alert-danger" role="alert">
                            Şifreniz yanlış.
                          </div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">
                        Kullanıcı adı yanlış.
                      </div>';
            }
        }
    }
} catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}
?>

<!doctype html>
<html lang="tr" dir="TR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giriş Yap</title>
    <link rel="icon" href="aicon1.png" type="image/x-icon" />
    <link rel="stylesheet" href="<https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.rtl.min.css>" integrity="sha384-dc2NSrAXbAkjrdm9IYrX10fQq9SDG6Vjz7nQVKdKcJl3pC+k37e7qJR5MVSCS+wR" crossorigin="anonymous">
    <link rel="stylesheet" href="<https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.rtl.min.css>" integrity="sha384-dc2NSrAXbAkjrdm9IYrX10fQq9SDG6Vjz7nQVKdKcJl3pC+k37e7qJR5MVSCS+wR" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <style>
        body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: lightgrey;
}

h1,
h2,
h3,
h4,
h5,
h6 {
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

.card {
    background-color: white;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);
}

.form-control.is-invalid {
    border-color: red;
    box-shadow: none;
}

.btn-primary {
    background-color: #0066cc;
    border-color: #0066cc;
    transition: all 0.3s ease 0s;
}

.btn-primary:hover {
    background-color: #0052cc;
    border-color: #0052cc;
    transition: all 0.3s ease 0s;
}

.btn-outline-danger {
    color: #dc3545;
    border-color: #dc3545;
}

.btn-outline-danger:hover {
    color: white;
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-outline-info {
    color: #17a2b8;
    border-color: #17a2b8;
}

.btn-outline-info:hover {
    color: white;
    background-color: #17a2b8;
    border-color: #17a2b8;
}

.btn-outline-secondary {
    color: #6c757d;
    border-color: #6c757d;
}

.btn-outline-secondary:hover {
    color: white;
    background-color: #6c757d;
    border-color: #6c757d;
}

.btn-outline-primary {
    color: #007bff;
    border-color: #007bff;
}

.btn-outline-primary:hover {
    color: white;
    background-color: #007bff;
    border-color: #007bff;
}

.btn-outline-success {
    color: #28a745;
    border-color: #28a745;
}

.btn-outline-success:hover {
    color: white;
    background-color: #28a745;
    border-color: #28a745;
}

#123345 img {
    width: 150px;
    margin-top: 30px;
}



@media (max-width: 576px) {
    .btn-group-vertical {
        display: block !important;
        margin-bottom: 10px;
    }

    .btn-group-vertical .btn {
        width: 100%;
    }
}

    </style>
</head>

<body style="background-color: lightgrey;">


    <center>
        <div id="123345" style="float:  center;">
            <img src="Studeel1.png" alt="Logo" />
        </div>
        <div class="" style="background-color:; border-size: 510px;" name="grup" role="group" aria-label="Basic outlined example">
            <button type="button" name="anasayfa" onclick="window.location.href = 'anasayfa.php'; " class="btn btn-outline-danger">Anasayfa</button>
  
            <button type="button" name="giris" onClick="parent.location='kayit.php'" class="btn btn-outline-secondary">Kayıt Yap</button>
            
            <button type="button" name="bizkimiz" onClick="parent.location='aboutus.php'" class="btn btn-outline-success">Biz kimiz</button>
        </div>
    </center>




    <div class="container p-5">
        <div style="box-shadow: 2px 5px 3px orange;" class="card p-5">
            <center>
                <h2 style="color: green;">Giriş Yap</h2>
            </center>



            <form action="login.php" method="POST">
                <div class="mb-3">
                    <?php
                    if (isset($_SESSION["username"])) {
                        echo "<center><h1 style='color:Brown;'>Zaten Giriş Yaptınız</h1></center>";
                    } else {
                    }
                    ?>
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" id="exampleInputEmail1" name="kullaniciadi">
                    <div class="invalid-feedback">
                        <?php echo $username_err;  ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control <?php echo (!empty($parola_err)) ? 'is-invalid' : ''; ?>" id="exampleInputPassword1" name="parola">
                    <div class="invalid-feedback">
                        <?php echo $parola_err; ?>
                    </div>
<br>

                    <?php
                    if (isset($_SESSION["username"])) {
                        echo "<div class='alert alert-danger' role='alert'><center><h3>Başka Hesaba Giriş Yapmak İçin Çıkış Yapın</h3></center></div>";
                    } else {
                        echo "<div class='d-grid gap-2 col-6 mx-auto'>
                                <button type='submit' name='giris' style='font-size: 25px;' class='btn btn-primary'>Giriş yap</button>
                            </div>";
                    }
                    ?>
                </div>
            </form>
            <center>


            </center>
        </div>
        <center>
    <div style="background-color: lightblue; box-shadow: 2px 5px 3px limegreen; font-color: white;  height:55px; text-align: center; align-items: center;" class="card p-9 " id="footer" >
        <p>2023. Studee. ©All rights reserved. Created by <a href="https://github.com/cesurh?" rel="nofollow">Cesur Huseynzade</a>.</p>
    </div></center>
    </div>

</body>

</html>
