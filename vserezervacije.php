<?php

include("connection.php");
include("functions.php");


?>
<!DOCTYPE html>
<html lang="sl" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Vse rezervacije</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="banner">
        <div class="navbar">
            <?php
            include("navbar.php");
            ?>
        </div>
    </div>
    <div class="content">
        <div style="background-color:transparent; width: 80%; margin: auto; border: 3px #00d2be solid; border-radius: 25px;">
            <h1 style="margin-top:10px">Vse rezervacije</h1>
            <div>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ime rezervacije</th>
                            <th scope="col">Termin</th>
                            <th scope="col">Email</th>
                            <th scope="col">Prostor</th>
                            <?php
                            if (isset($_SESSION["admin"])) {
                              if($_SESSION["admin"] == 1) {
                            ?>
                            <th scope="col">Remove</th>
                          <?php }}?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $sql = "SELECT r.id, r.ime, r.termin, u.email, p.ime AS pime FROM rezervacije r INNER JOIN uporabniki u ON u.id = r.uporabnik_id INNER JOIN prostori p ON p.id = r.prostor_id";
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <form action="functions.php" method="post">
                                    <th scope="row"><?php echo $count ?></th>
                                    <input hidden name="id" value="<?php echo $row["id"] ?>" type="text">
                                    <td><?php echo $row["ime"] ?></td>
                                    <td><?php echo $row["termin"] ?></td>
                                    <td><?php echo $row["email"] ?></td>
                                    <td><?php echo $row["pime"] ?></td>
                                    <?php
                                    if (isset($_SESSION["admin"])) {
                                      if($_SESSION["admin"] == 1) {



                                    ?>
                                        <td><button name="delete" type="submit" class="btn-close btn-close-white" aria-label="Close"></button></td>
                                    <?php }} ?>
                                </form>
                            </tr>
                        <?php $count = $count + 1;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
