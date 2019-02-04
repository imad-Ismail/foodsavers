<?php
session_start();
require_once("db-connection.php");
$target_dir = "uploads/";

$imageName = bin2hex(random_bytes(10));
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$target_file = $target_dir . $imageName . "." . $imageFileType;
$fileName = $imageName . "." . $imageFileType;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Bestand is geen afbeelding.";
        $uploadOk = 0;
    }   
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Het bestand bestaat al.";
    $uploadOk = 0;
}
// Check file sizeq 
if ($_FILES["fileToUpload"]["size"] > 17000000) {
    echo "Sorry, jouw afbeelding is te groot.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, alleen JPG, JPEG, PNG & GIF bestanden zijn toegestaan";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo $fileName;

        $title = htmlspecialchars($_POST["title_input"]);
        $description = htmlspecialchars($_POST["description_input"]);
        $contact = htmlspecialchars($_POST["contact_input"]);
        $product_type = htmlspecialchars($_POST["product_category"]);
        $expire_date = htmlspecialchars($_POST["expire-date_input"]);
        $phone_number = $_SESSION["phone_number"];
        $email = $_SESSION["email"];
        $lat = $_SESSION['lat'];
        $lon = $_SESSION['lon'];
        $screenname = $_SESSION['screenname'];
        // move_uploaded_file($uploadedFile, $destinationFilename);
        correctImageOrientation($target_file);

        echo $expire_date;
        echo $title . "<br/>";
        echo $description . "<br/>";
        echo $contact . "<br/>";
        echo $product_type;

        if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];
        $sql = "INSERT INTO product (user_id, title, description , imagelist, expire_date , product_type, phone_number, email, lat, lon ,screenname)
        VALUES ('$user_id', '$title', '$description', '$fileName', '$expire_date', '$product_type' ,'$phone_number', '$email', '$lat', '$lon' , '$screenname')";

        $data = $conn->query($sql);
        }
        echo "product succesvol toegevoegd.";
        header("Location: delete-product.php");  
    } else {
        echo "Sorry, er is een fout opgetreden.";
        header("refresh:3;url=addproduct.php" );
    }
}

function correctImageOrientation($filename) {
    if (function_exists('exif_read_data')) {
      $exif = exif_read_data($filename);
      if($exif && isset($exif['Orientation'])) {
        $orientation = $exif['Orientation'];
        if($orientation != 1){
          $img = imagecreatefromjpeg($filename);
          $deg = 0;
          switch ($orientation) {
            case 3:
              $deg = 180;
              break;
            case 6:
              $deg = 270;
              break;
            case 8:
              $deg = 90;
              break;
          }
          if ($deg) {
            $img = imagerotate($img, $deg, 0);        
          }
          // then rewrite the rotated image back to the disk as $filename 
          imagejpeg($img, $filename, 95);
        } // if there is some rotation necessary
      } // if have the exif orientation info
    } // if function exists      
  }
?>