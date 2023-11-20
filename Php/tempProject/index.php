<?php
$actual_link = basename("$_SERVER[REQUEST_URI]");
echo $actual_link;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .imageContaner h1 {
            text-align: center;
            position: absolute;
            top: 80px;
            right: 55%;
            font-family: cursive;
        }

        .imageContaner {
            position: relative;
        }

        #homeImg {
            width: 100%;
        }
    </style>
</head>

<body>
    <?php
    include('./navbar.php')
    ?>
    <div class="main">
        <div class="imageContaner">
            <h1> Welcome in the world of Coding.</h1>
            <img id="homeImg" src="
                https://media.istockphoto.com/id/1206716438/photo/persons-hand-holding-sun-in-palm-feeling-energized-spiritual-mind-body-concept.webp?b=1&s=170667a&w=0&k=20&c=CiQspv1HnhW58k_5ue22qv-nEPKDw5sqA8vnXVUl7cc=" alt=" Image">
        </div>
    </div>
</body>

</html>