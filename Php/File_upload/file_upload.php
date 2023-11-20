<?php
if ($_POST['submit']) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
    $uploadOK = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
    if (!$check) {
        echo "File is not an image";
        $uploadOK = 0;
    } else {
        echo "selected file is an image " . $check["mime"];
        $uploadOK = 1;
    }

    if (file_exists($target_file)) {
        echo "File alreardy existed !";
        $uploadOK = 0;
    }
    if ($uploadOK) {
        print_r($_FILES);
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
            echo "File " . $_FILES['fileToUpload']['name'], " uploaded successfully";
        } else {
            echo "File uploading failed !";
        }
    }
}
