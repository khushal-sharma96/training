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
            color: goldenrod;
            font-weight: bold;
            scale: 1.1;
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

        #navbarList {
            display: flex;
            justify-content: space-around;
            width: 100%;
        }

        #navbarList li {
            cursor: pointer;
        }
    </style>
    <script script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="navbar">
        <div class="items">
            <!-- <div class="span"><a href="./index.php">Home</a></div>
            <div class="span"><a href="./contact.php">About</a></div>
            <div class="span"><a href="./about.php">Contact</a></div> -->
            <ul type=none id='navbarList'>
                <li class="highlight">Home</li>
                <li>Contact</li>
                <li>About</li>
            </ul>
        </div>
    </div>
    <iframe src="http://localhost/Training/PHP/tempProject/home.php" allowfullscreen='true' frameborder="0" scrolling="no" height="100 vh" width="100%" id='myFrame'></iframe>
    <script>
        let fileName = window.location.href;
        $('#navbarList li').click(function() {
            action = ($(this).text()).toLowerCase();
            $('#myFrame').attr('src', `http://localhost/Training/PHP/tempProject/${action}.php`);
            $('.highlight').removeClass('highlight');
            $('#navbarList li').each(function() {
                if ($(this).text().toLowerCase() == action) {
                    $(this).addClass('highlight');
                }
            })
        })
    </script>
</body>

</html>