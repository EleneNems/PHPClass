<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .container form{
            width: 300px;
            height: 300px;
            display: flex;
            flex-direction: column;
            margin: auto;
            justify-content: center;
            align-items: center;
            background-color: lightblue;
        }

        .container input{            
            background-color: rgb(119, 203, 231);
            border: none;
            height: 30px;
            color: white;
            padding: 4px;
            box-sizing: border-box;
            border-radius: 5px;
        }

        .container{
            margin-bottom: 80px;
        }

        .container input::placeholder{
            color: rgb(235, 234, 234);
        }

        button{
            background-color: rgb(119, 203, 231);
            color: white;
            width: 160px;
            height: 30px;
            text-align: center;
            height: 30px;
            border: none;
        }

        table{
            margin: auto;
            border-collapse: collapse;
            width: 400px;
        }
        
        table tr th, td{
            border: 1px solid black;
        }

    </style>
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <input type="text" placeholder="Name" name="name"> <br>
            <input type="text" placeholder="Last Name" name="lastName"> <br>
            <input type="text" placeholder="Email" name="email"> <br>

            <button>Enter</button>
        </form>
    </div>

    <?php
        $name = $_POST["name"] ?? "";
        $email = $_POST["email"] ?? "";
        $lastname = $_POST["lastName"] ?? "";
    ?>

    <table>
        <tr>
            <th>Name</th>
            <th>Last Name</th>
            <th>Email</th>
        </tr>

        <tr>
            <td><?=$name?></td>
            <td><?=$lastname?></td>
            <td><?=$email?></td>
        </tr>
    </table>
</body>
</html>