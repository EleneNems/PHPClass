<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table{
            border-collapse: collapse;
        }

        table tr th, tr td{
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <p>ააგეთ ნიშნების უწყისის ფორმა PHP-ის საშუალებით მოახდინეთ ველებში ჩაწერილი მონაცემების გამოტანა ცხრილის სახით $_POST მეთოდის საშუალებით: აუცილებელი ველები: სტუდენტის სახელი, გვარი, კურსი, სემესტრი, სასწავლო კურსი, მიღებული ნიშანი, მიღებული ნიშნის მიხედვით შესაბამისი შეფასება A-ფრიადი, B-ძალიან კარგი ... და ა.შ., ლექტორის სახელი, გვარი, დეკანის სახელი გვარი.</p>

    <form action="" method="post">
        <input type="text" name="S_name" placeholder="student name">
        <br>
        <input type="text" name="S_lastname" placeholder="student lastname"> 
        <br>
        <input type="text" name="S_course" placeholder="student course">
        <br>
        <input type="text" name="S_semester" placeholder="student semester">
        <br>
        <input type="text" name="S_mark" placeholder="student's mark">
        <br>
        <button name="enter">Enter</button>
    </form>

    <?php
        if(isset($_POST['enter'])){
            if(empty($_POST['S_name'])||empty($_POST['S_lastname'])||empty($_POST['S_course'])||empty($_POST['S_semester'])||empty($_POST['S_mark'])){
                echo "Please input all the data";
            }
            else{
                $S_name = $_POST['S_name'];
                $S_lastname = $_POST['S_lastname'];
                $S_course = $_POST['S_course'];
                $S_semester = $_POST['S_semester'];
                $S_mark = $_POST['S_mark'];

                if($S_mark >= 91 || $S_mark <= 100){
                    $S_grade = 'A';
                }
                elseif($S_mark >= 81 && $S_mark <= 90){
                    $S_grade = 'B';
                }
                elseif ($S_mark >= 71 && $S_mark <= 80) {
                    $S_grade = 'C';
                }
                elseif($S_mark >= 61 && $S_mark <= 70) {
                    $S_grade = 'D';
                }
                elseif($S_mark >= 51 && $S_mark <= 60) {
                    $S_grade = 'E';
                }
                elseif($S_mark <= 50) {
                    $S_grade = 'F';
                }
                else{
                    echo "Wrong Input";
                }

                echo "<table>";
                echo "<tr>";
                echo "<th>Student's Name</th>";
                echo "<th>Student's Lastname</th>";
                echo "<th>Students Course</th>";
                echo "<th>Student's Semester</th>";
                echo "<th>Student's Mark</th>";
                echo "<th>Student's Mark(Letter)</th>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>".$S_name."</td>";
                echo "<td>".$S_lastname."</td>";
                echo "<td>".$S_course."</td>";
                echo "<td>".$S_semester."</td>";
                echo "<td>".$S_mark."</td>";
                echo "<td>".$S_grade."</td>";


                echo "</tr>";
                echo "</table>";
            }
        }
    ?>
</body>
</html>