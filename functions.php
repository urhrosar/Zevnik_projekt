<?php
session_start();
include("connection.php");

function check_login($con)
{

  if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];
    $query = "select * from uporabniki where username = '$username' limit 1";

    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {

      $user_data = mysqli_fetch_assoc($result);
      return $user_data;
    }
  }
}

if (isset($_POST["prijava"]) && isset($_SESSION["prijavljen"]) != 1) {
  $uname = filter_input(INPUT_POST, 'username');
  $pass = filter_input(INPUT_POST, 'pass');
  $sql = "SELECT * FROM uporabniki";
  $result = mysqli_query($con, $sql);
  $yes = 0;

  while ($row = mysqli_fetch_assoc($result)) {
    //namesto ta druge v if stavku: password_verify($pass, $row["pass"]
    if ($row["username"] == $uname && password_verify($pass, $row["pass"])) {

      $_SESSION["username"] = $uname;
      $_SESSION["pass"] = $pass;
      $_SESSION["prijavljen"] = 1;
      $_SESSION["admin"] = $row["admin"];
      $_SESSION["id"] = $row["id"];
      header('Location: index2.php');
      $yes = 1;
      break;
    } else {
      header('Location: prijava.php');
    }
  }
}

if (isset($_POST["registriraj"]) && $_SESSION["prijavljen"] != 1) {
  $uname = filter_input(INPUT_POST, 'username');
  $email = filter_input(INPUT_POST, 'email');
  $pass = filter_input(INPUT_POST, 'pass');

  $passHash = password_hash($pass, PASSWORD_BCRYPT);

  $sql = "INSERT INTO uporabniki (username, email, pass, admin) VALUES ('$uname', '$email', '$passHash', 0)";
  if (mysqli_query($con, $sql)) {
    echo "New record created successfully";
    header('Location: prijava.php');
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

if(isset($_POST["rezerviraj"]) && $_SESSION["prijavljen"] == 1){
  $ime = filter_input(INPUT_POST, 'ime');
  $datum = filter_input(INPUT_POST, 'datum');
  $prostor_id = filter_input(INPUT_POST, 'prostor_id');
  $id = $_SESSION["id"];


  $sql = "INSERT INTO rezervacije (ime, termin, uporabnik_id, prostor_id) VALUES ('$ime', '$datum', '$id', '$prostor_id')";
  if (mysqli_query($con, $sql)) {
    echo "New record created successfully";
    header('Location: vserezervacije.php');
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

if(isset($_POST["delete"]) && $_SESSION["admin"] == 1){
  $id = $_POST["id"];
  $sql = "DELETE FROM rezervacije WHERE id = $id";
  mysqli_query($con, $sql);
  header('Location: vserezervacije.php');
}
