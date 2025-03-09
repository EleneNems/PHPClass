<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        form{
            min-width: 400px;
            margin: auto;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid black;
        }

        form input,label{
            margin: 10px;
        }

        form button{
            margin: 10px;
        }

        span, p{
            color: red;
        }

        
        table{
            border-collapse: collapse;
            margin: auto;
            text-align: center;
        }

        table tr th, td{
            padding: 5px;
            border: 1px solid black;
        }

    </style>
</head>
<body>
    <form action="" method="post">
        <h2>PHP Form Validation Example</h2>
        <p>* required field</p>
        <label>Name:</label> 
        <input type="text" name="name"> <span>*</span>
        <br>
        <label>E-mail:</label>
        <input type="text" name="email"> <span>*</span>
        <br>
        <label>Website:</label>
        <input type="text" name="website">
        <br>
        <label>Comment:</label>
        <textarea name="comment" id=""></textarea>
        <br>

        <label>Gender:</label>
        <input type="radio" name="gender" value="male"> Male 
        <input type="radio" name="gender" value="female"> Female 
        <input type="radio" name="gender" value="other"> Other <span>*</span> 
        <br>

        <button name="submit">Submit</button>

        
        <?php
            if((isset($_POST['submit']))){
                if(empty($_POST['name'])||empty($_POST['email'])||empty($_POST['gender'])){
                    echo "<p>Fill out all the required fields!</p>";
                }else{
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $website = $_POST["website"]??'';
                    $comment = $_POST["comment"]??'';
                    $gender = $_POST["gender"];

                    echo "<h2>Your Input:</h2>";

                    echo"<table>";
                    echo 
                        "<tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Website</th>
                            <th>Comment</th>
                            <th>Gender</th>
                        </tr>";

                    echo "<tr>";
                    echo "<td>$name</td>";
                    echo "<td>$email</td>";
                    echo "<td>$website</td>";
                    echo "<td>$comment</td>";
                    echo "<td>$gender</td>";
                    echo "</tr>";

                    echo"</table>";

                }
            }
        ?>
    </form>

</body>
</html>