<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <style>
        .navbar {
            height: 50px;
            background-color: #707b86;
            background-image: url('https://img.freepik.com/free-photo/abstract-luxury-gradient-blue-background-smooth-dark-blue-with-black-vignette-studio-banner_1258-54055.jpg');
        }

        .highlight {
            color: green;
            background-color: red;
            border-radius: 20px;
            width: 80px;
            justify-content: center;
        }

        .items {
            display: flex;
            width: 40%;
            height: 100%;
            margin: auto;
            border: 3px solid rgb(37, 35, 35);
            justify-content: space-evenly;
            align-items: center;
            font-size: 19px;
            font-weight: 600;
            border-radius: 30px;
        }

        .span {
            cursor: pointer;
            height: 100%;
            display: flex;
            align-items: center;
        }

        a {
            color: white;
            text-decoration: none;
        }
    </style>
    <script script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="navbar">
        <div class="items">
            <div class="span"><a href="./index.php">Home</a></div>
            <div class="span"><a href="./contact.php">About</a></div>
            <div class="span"><a href="./about.php">Contact</a></div>
            <!-- <span></span>
            <span></span>
            <span></span> -->
        </div>
    </div>
    <script>
        let fileName = "<?php
                        $actual_link = basename("$_SERVER[REQUEST_URI]");
                        echo $actual_link;
                        ?>";
        let spans = $('span');
        $('a').each(function() {
            if (($(this).attr("href")).includes(fileName))
                $(this).parent().addClass('highlight');
        })
        //console.log(filename('http://example.com/index.html?lang=ja'));
    </script>
</body>

</html>