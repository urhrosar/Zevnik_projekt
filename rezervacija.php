<?php

include("connection.php");
include("functions.php");

if ($_SESSION["prijavljen"] != 1) {
  header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="sl" dir="ltr">

<head>

  <meta charset="utf-8">
  <title>Rezervacija telovadnice ŠCV</title>
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <div class="banner">
    <div class="navbar">
      <?php
      include("navbar.php");
      ?>
    </div>
    <div class="form-box">
      <div class="napis">
        <h2>Rezervacija</h2>
      </div>
      <div class="prostori_dropdown">
        <div class="rezervacija">
          <form class="reservation" action="rezervacija.php" method="post">
            <p class="kraj">Kraj:</p>
            <select class="form-control" onchange="this.form.submit()" name="kraj_id" class="prostori_drop">
              <option disabled selected value></option>
              <?php
              $result = mysqli_query($con, "SELECT * FROM kraji");
              while ($row = mysqli_fetch_assoc($result)) {
                $kraj_ime = $row['ime'];
                $kraj_id = $row["id"];
                if (isset($_POST["kraj_id"])) {
                  if ($_POST["kraj_id"] == $kraj_id) {
                    echo "<option value='$kraj_id' selected>$kraj_ime</option>";
                  } else {
                    echo "<option value='$kraj_id'>$kraj_ime</option>";
                  }
                } else {
                  echo "<option value='$kraj_id'>$kraj_ime</option>";
                }
              }
              ?>
            </select>
          </form>
        </div>
      </div>

      <?php
      if (isset($_POST["kraj_id"])) {
      ?>
        <form class="reservation" action="functions.php" method="post">
          <p class="prostor">Prostor:</p>
          <select class="form-control" name="prostor_id" class="prostori_drop">
            <?php
            $kraj_id = $_POST["kraj_id"];
            $result = mysqli_query($con, "SELECT * FROM prostori WHERE kraj_id = '$kraj_id'");
            while ($row = mysqli_fetch_assoc($result)) {

              $prostor_ime = $row['ime'];
              $prostor_id = $row["id"];

              echo "<option value='$prostor_id'>$prostor_ime</option>";
            }
            ?>
          </select>
          <div class="ime">
            <p class="ime_rezervacije">Ime rezervacije:</p>
            <input required type="text" class="form-control" name="ime"> </input>
          </div>
          <div class="datum">
            <p class="date">Vnesite datum in čas rezervacije</p>
            <div class="form-group">
              <div style="width: 100%;">
                <input style="width: 100%; margin: auto; text-align: center" name="datum" class="form-control" type="date" value="2021-08-19" id="example-date-input">
              </div>
            </div>
          </div>
          <div style="margin-top: 25px" class="col text-center">
            <button style="border-radius:26px" type="submit" class="submit-btn" name="rezerviraj">Rezerviraj!</button>
          </div>
        </form>
      <?php } ?>

    </div>
  </div>


  </div>
</body>

</html>
