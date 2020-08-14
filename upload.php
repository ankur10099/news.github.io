<?php
   if(isset($_FILES['image'])){
      $errors= array();
      $errorsr = "";
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
    //   $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      $file_ext = strtolower(pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION));

      $expensions= array("json");

      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a json file.";
        $errorsr="extension not allowed, please choose a json file.";
      }

      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
        $errorsr='File size must be excately 2 MB';
      }

      if(empty($errors)==true){
         move_uploaded_file($file_tmp,$file_name);
         echo '<script type="text/javascript">alert("Success");</script>';
      }else{
          echo '<script type="text/javascript">alert("Alert:  '.$errorsr.'");</script>';
        //  print_r($errors);
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Newsapp</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"><!--===============================================================================================-->
	<link href="images/icons/favicon.ico" rel="icon" type="image/png" /><!--===============================================================================================-->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /><!--===============================================================================================-->
	<link href="fonts/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /><!--===============================================================================================-->
	<link href="vendor/animate/animate.css" rel="stylesheet" type="text/css" /><!--===============================================================================================-->
	<link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" type="text/css" /><!--===============================================================================================-->
	<link href="vendor/animsition/css/animsition.min.css" rel="stylesheet" type="text/css" /><!--===============================================================================================-->
	<link href="vendor/select2/select2.min.css" rel="stylesheet" type="text/css" /><!--===============================================================================================-->
	<link href="vendor/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" /><!--===============================================================================================-->
	<link href="css/util.css" rel="stylesheet" type="text/css" />
	<link href="css/main.css" rel="stylesheet" type="text/css" /><!--===============================================================================================-->
</head>
<body>
<div class="container-contact100">
<div class="wrap-contact100">
<form class="contact100-form validate-form" action="" method="POST" enctype="multipart/form-data">

<span class="contact100-form-title">News App, Config Upload.</span>
<div class="wrap-input100 validate-input" data-validate="Name is required">

<span class="label-input100">Select File</span>

<input class="input100" name="image" placeholder="select file" type="file" />
</div>

<div class="container-contact100-form-btn">
<div class="wrap-contact100-form-btn">
<div class="contact100-form-bgbtn"></div>
<button class="contact100-form-btn"><input type="submit" value="Upload File"/></button></div>
</div>
</form>

</div>
</div>
</body>
</html>
