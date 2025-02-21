<h1>GET Method</h1>

<?php
    $salary = $_GET['salary'];
    $percentage = $_GET['tax'];

    $taxed = $salary * ($percentage / 100);
    $fixedSalary = $salary - $taxed;

    echo "<div>" .$taxed."</div>";
    echo "<div>" .$fixedSalary."</div>";
?>