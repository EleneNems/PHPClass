<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HW2</title>
    <style>
        .container form{
            display: flex;
            flex-direction: column;
            justify-self: center;
        }

        form input{
            width: 250px;
            margin: 5px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            text-align: left;
        }

        th, td{
            border: 1px solid black;
            padding: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="Post">
            <input type="text" name="name" placeholder="Enter your name">
            <input type="text" name="lastname" placeholder="Enter your last name">
            <input type="text" name="course" placeholder="Enter your course">
            <input type="text" name="semester" placeholder="Enter your semester">
            <input type="text" name="faculty" placeholder="Enter your faculty">
            <input type="number" name="mark" placeholder="Enter your mark">

            <input type="text" name="lecturerName" placeholder="Enter your lecturer's name">
            <input type="text" name="lecturerLastName" placeholder="Enter your lecturer's last name">
            <input type="text" name="dean" placeholder="Enter your dean's first and last name">

            <button>Create</button>
        </form>
    </div>

    <?php
        $firstname = $_POST["name"] ?? "";
        $lastname = $_POST["lastname"] ?? "";
        $course = $_POST["course"] ?? "";
        $semester = $_POST["semester"] ?? "";
        $faculty = $_POST["faculty"] ?? "";

        $mark = is_numeric($_POST["mark"] ?? null) ? (float)$_POST["mark"] :0;

        $lecturerName = $_POST["lecturerName"]??"";
        $lecturerLastName = $_POST["lecturerLastName"]??"";
        $dean = $_POST["dean"]??"";

        $alphabetMark = '';
        if($mark<51){
            $alphabetMark = 'F';
        }
        else if($mark>=51 && $mark< 61){
            $alphabetMark = 'E';
        }
        else if($mark>= 61 && $mark< 71){
            $alphabetMark = 'D';
        }
        else if($mark>= 71 && $mark< 81){
            $alphabetMark = 'C';
        }
        else if($mark>= 81 && $mark< 91){
            $alphabetMark = 'B';
        }
        else{
            $alphabetMark = 'A';
        }
    ?>

    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Course Name</th>
            <th>Semester Name</th>
            <th>Faculty Name</th>
            <th>Mark</th>
            <th>Alphabet equivalent</th>
            <th>Lecturer's Name</th>
            <th>Lecturer's Last Name</th>
            <th>Dean</th>
        </tr>

        <tr>
            <td><?=htmlspecialchars($firstname)?></td>
            <td><?=htmlspecialchars($lastname)?></td>
            <td><?=htmlspecialchars($course)?></td>
            <td><?=htmlspecialchars($semester)?></td>
            <td><?=htmlspecialchars($faculty)?></td>
            <td><?=$mark?></td>
            <td><?=htmlspecialchars($alphabetMark)?></td>
            <td><?=htmlspecialchars($lecturerName)?></td>
            <td><?=htmlspecialchars($lecturerLastName)?></td>
            <td><?=htmlspecialchars($dean)?></td>
        </tr>
    </table>

</body>
</html>