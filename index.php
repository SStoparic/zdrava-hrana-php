<?php
include 'konekcija.php';
include 'model/proizvod.php';
include 'model/kategorija.php';

session_start();

$user="";

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
if (isset($_COOKIE["admin"]))
    {
        $user=$_COOKIE["admin"];
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FitGreens</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="stranica"  >

    <nav class="navbar navbar-expand-lg navbar-light" id="navCont" style="height:100px; ">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav p-lg-0 " style="margin-left: 2%; margin-top:10px;   ">
                    <li><a id="btn-Pocetna" href="index.php" type="button" class="btn btn-success btn-block" >
                        Pocetna</a></li>
                    <li><a id="btn-Dodaj" type="button" class="btn btn-success btn-block"  data-toggle="modal" data-target="#my" >
                        Nov proizvod </a></li>
                    <li><a id="btn-Prikazi" href="prikaziProizvode.php" type="button" class="btn btn-success btn-block">
                        Svi proizvodi</a></li>
                    <li><a id="btn-Pocetna" href="odjava.php" type="button" class="btn btn-success btn-block" >
                    Odjavi se</a> </li>
                    <li> <h1 class="navbar-brand " style="color:#5f7745 ; font-weight:bold; font-size:30px; margin-top:-60px; margin-left: 900px; text-decoration:underline">
                    FitGreens prodavnica</h1></li>
                </div>
            </div>
    </nav>

    <div id="ww">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 centered">
                    <div class="slikeKontejner">
                    <img src="https://parade.com/.image/t_share/MTkwNTgxMjkxNjk3NTc5OTAw/istock-1203599963-jpg.jpg" alt="pocetna" class="img img-circle">
                    <img src="https://parade.com/.image/t_share/MTkwNTgxMjkxNjk3NTc5OTAw/istock-1203599963-jpg.jpg" alt="pocetna" class="img img-circle">
                    <img src="https://parade.com/.image/t_share/MTkwNTgxMjkxNjk3NTc5OTAw/istock-1203599963-jpg.jpg" alt="pocetna" class="img img-circle">
                    </div>
                    <h2 style="color:white ; background-color:#7b9d70; padding:15px; border-radius:25px; margin-top:100px"> Dobrodošli u Bio Špajz zdrava hrana.</h2>

                </div>
            </div>
        </div>
    </div>

    <div class="container pt" style="margin-top:40px; margin-bottom: 300px; ">
    <div id="searchDiv" >
        <label for="pretraga"style="color:#7b9d70 ;font-weight:400px ;font-size:22px; padding-bottom:20px">Pretraga proizvoda na osnovu kategorije</label>
        <select id="pretraga" onchange="pretraga()" class="form-control" style=" font-size:20px ;" >
            <?php
            $rez = $conn->query("SELECT * from kategorija");

            while ($red = $rez->fetch_assoc()) {
            ?>
                <option 
                value="<?php echo $red['kategorijaId'] ?>"> <?php echo $red['imeKategorije'] ?></option>
            <?php   }
            ?>
        </select>
    </div>

    <div id="podaciPretraga"style="font-size:18px ; margin-top:-80px" ></div>
    </div>

    <div class="modal fade" id="my" role="dialog" >
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="align-items:center; justify-content: center;" >
                    <div class="container prijava-form">
                        <form action="#" method="post" id="dodajForm">
                            <h3 style="color:#7b9d70; text-align: center ">Dodaj proizvod:</h3>
                            <div class="row" >
                                <div class="col-md-11 ">
                                    <div class="form-group">
                                        <label style="color:#7b9d70" for="">Ime proizvoda:</label>
                                        <input type="text" style="border: 1px solid black" name="imeProizvoda" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label style="color:#7b9d70"for="">Nutritivna vrednost:</label>
                                        <input type="text" style="border: 1px solid black" name="nutritivnaVrednost" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label style="color:#7b9d70" for="">Cena proizvoda:</label>
                                        <input type="text" style="border: 1px solid black" name="cena" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <select id="kategorijaId" name="kategorijaId" class="form-control">
                                            <?php
                                            $rez = $conn->query("SELECT * from kategorija");
                                            while ($red = $rez->fetch_array()) {
                                            ?>
                                                <option name="value" value="<?php echo $red['kategorijaId'] ?>"> <?php echo $red['imeKategorije'] ?></option>
                                            <?php  }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button id="btnDodaj" type="submit" class="btn btn-success btn-block" style="background-color: #7b9d70">
                                            Dodaj novi proizvod</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script>
        function pretraga() {
            $.ajax({
                url: "handler/pretragaProizvoda.php",
                data: {
                    kategorijaId: $("#pretraga").val()
                },
                success: function(html) {
                    $("#podaciPretraga").html(html);
                }
            })
        }
    </script>


    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>