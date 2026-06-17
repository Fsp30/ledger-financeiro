<?php
    echo "<h1>LEDGER FINANCEIRO - docker Tester - beba agua, coma legumes</h1>";

    for($i = 0; $i < 10; $i++) {
        echo "<p>Beba agua $i x ao dia, coma legumes <?php ${$i % 2}?> ao dia</p>";
    }
?>