<?php
    require_once "Connection.php";
    if(isset($_POST['submit'])){
        $db=new Insertion();
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $age=$_POST['age'];
        $gender=$_POST['gender'];
        $address=$_POST['address'];
        if($db->insertData("${fname}","${lname}",$age,"${gender}","${address}")){
            ?>
            <script>alert("Data Entered Successfully.");</script>
            <?php
        }else{
            ?>
            <script>alert("Something Went wrong in Insertion Process!");</script>
            die;
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
        }
        h1{
            text-align: center;
            color: #868686;
        }
        input[type='radio']{
            margin-left:30px;
        }
    </style>
</head>
<body>
    <h1>Insert Your Data</h1>
    <div class="container">
        <form method="post" novalidate>
            <div class="mb-3">
              <label for="fname" class="form-label">First Name:</label>
              <input type="text" class="form-control" name="fname"  id="fname" aria-describedby="emailHelp">
              
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name:</label>
                <input type="text" class="form-control" name="lname" id="lname" aria-describedby="emailHelp">
                
            </div>
            <div class="mb-3">
                <label class="form-label">Gender:</label>
                <input type="radio" id="Male" name="gender" value="Male">
                <label for="Male">Male</label>
                <input type="radio" id="Female" name="gender" value="Female">
                <label for="Female">Female</label>
                <input type="radio" id="Other" name="gender" value="Other">
                <label for="Other">Other</label>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age:</label>
                <input type="number" class="form-control" name="age" id="age" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">address:</label>
                <textarea class="form-control" name="address" id="address" cols="30" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
          </form>
    </div>
    
</body>
</html>