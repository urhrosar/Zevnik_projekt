
<img src="logo.png" class="logo">
<ul><?php
    if (isset($_SESSION["prijavljen"])) {
    ?>
        <li><p style="color: #009688"><?php echo $_SESSION["username"]; if($_SESSION["admin"] == 1){ echo " (Admin)";}?></p></li>
        <li><a href="index2.php">Domov</a></li>
        <li><a href="rezervacija.php">Rezervacija</a></li>
        <li><a href="vserezervacije.php">Vse rezervacije</a></li>
        <li><a href="logout.php">Odjava</a></li>
        <?php
                                            } else {
                                                ?>
        <li><a href="index.php">Domov</a></li>
        <li> <a href="prijava.php">Prijava</a></li>
        <li><a href="vserezervacije.php">Vse rezervacije</a></li>
        <?php }?>
</ul>
