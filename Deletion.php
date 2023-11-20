<?php
    require_once "Connection.php";
    if(isset($_POST['submit'])){
        $access=new DeleteAll();
        if($access->deleteData()){
            ?>
            <script>alert("Whole Data has been Deleted.");</script>
            <?php
        }
        else{
            ?>
            <script>alert("Something went wrong in Deletion !!.");</script>
            <?php
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertion Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container{
            width: 80vw;
            height: 100vh;
            margin:auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        form{
            border:2px solid black;
            padding: 2%;
            width: 60%;
            display:flex;
            flex-direction:column;
        }
        h1{
            text-align: center;
            color: #868686;

        }
        label{
            text-align:center;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="post" novalidate>
            <h1>Delete the Record of Employee</h1>
            <div class="mb-3">
              <label  class="form-label">Press on Submit button </label><br>
              <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
