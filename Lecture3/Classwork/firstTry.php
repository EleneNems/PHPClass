<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            width: 600px;
            height: 400px;
            border: solid 1px black;
            border-collapse: collapse;
        }

        table tr th, td{
            border: solid 1px black;
            text-align: center;
        }        

    </style>
</head>
<body>

    <table>
        <thead>
            <tr style="height: 50px;">
                <th>Questions</th>
                <th>Answers</th>
                <th>Max Point</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>What is HTML?</td>
                <td><input type="text"> </td>
                <td>8</td>
            </tr>

            <tr>
                <td>What is Angular?</td>
                <td><input type="text"></td>
                <td>10</td>
            </tr>

            <tr>
                <td>What is React?</td>
                <td><input type="text"></td>
                <td>9</td>
            </tr>

            <tr>
                <td>What is CSS?</td>
                <td><input type="text"></td>
                <td>10</td>
            </tr>

            <tr>
                <td>What is PHP?</td>
                <td><input type="text"></td>
                <td>10</td>
            </tr>

            <tr>
                <td>What is JS?</td>
                <td><input type="text"></td>
                <td>8</td>
            </tr>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3" style="height: 50px;">
                    Student: 
                    <input type="text" placeholder="name">
                    <input type="text" placeholder="lastname">

                    <button>Send</button>
                </td>
            </tr>
        </tfoot>
    </table>

    

</body>
</html>