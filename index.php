<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

<?php
// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();
$conn = $db->connect();

// define variables and set to empty values
$mainErr = 0;
$nameErr = $bannerErr = $banneridErr = $interstrialErr = $interstrialidErr = $timeErr = "";
$name = $banner = $bannerid = $interstrial = $interstrialid = $time = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
    $mainErr = 1;
  } else {
    $name = test_input($_POST["name"]);
  }

  if (empty($_POST["banner"])) {
    $bannerErr = "banner type is required";
    $mainErr = 1;
  } else {
    $banner = test_input($_POST["banner"]);
  }

  if (empty($_POST["bannerid"])) {
    $banneridErr = "banner id is required";
    $mainErr = 1;
  } else {
    $bannerid = test_input($_POST["bannerid"]);
  }

  if (empty($_POST["interstrial"])) {
    $interstrialErr = "interstrial type is required";
    $mainErr = 1;
  } else {
    $interstrial = test_input($_POST["interstrial"]);
  }

  if (empty($_POST["interstrialid"])) {
    $interstrialidErr = "interstrial id is required";
    $mainErr = 1;
  } else {
    $interstrialid = test_input($_POST["interstrialid"]);
  }

  if (empty($_POST["time"])) {
    $timeErr = "time is required";
    $mainErr = 1;
  } else {
    $time = test_input($_POST["time"]);
  }

  // mysql inserting a new row
  if ($mainErr == "0") {
  // echo "INSERT INTO admobfb (`name`, `banner`, `bannerid`, `interstrial`, `interstrialid`, `time`) VALUES ('$name','$banner','$bannerid','$interstrial','$interstrialid', $time)";

  $query = "SELECT * from admobfb where name ='$name'";
  $result=mysqli_query($conn,$query);

   if(mysqli_num_rows($result) > 0)
    {
      $result = mysqli_query($conn,"UPDATE admobfb SET `name`='$name', `banner`='$banner', `bannerid`='$bannerid', `interstrial`='$interstrial', `interstrialid`='$interstrialid', `time`=$time where name ='$name'") OR die("Error:".mysql_error());
    }
  else
  {

    	$result = mysqli_query($conn,"INSERT INTO admobfb (`name`, `banner`, `bannerid`, `interstrial`, `interstrialid`, `time`) VALUES ('$name','$banner','$bannerid','$interstrial','$interstrialid', $time)") OR die("Error:".mysql_error());
  }

    	// check if row inserted or not
    	if ($result) {
        	// successfully inserted into database
        	$response["success"] = 1;
        	$response["message"] = "Ads Entry successfully created.";

        	// echoing JSON response
        	echo '<p>------------------------------------------------------------------</p>';
        	echo json_encode($response);
        	echo '<p>------------------------------------------------------------------</p>';
    	} else {
        	// failed to insert row
        	$response["success"] = 0;
        	$response["message"] = "Oops! An error occurred.";

        	// echoing JSON response
        	echo json_encode($response);
    	}

   }

}

function test_input($data) {
  $data = trim($data);
  // $data = stripslashes($data);
  // $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Admob FB ads</h2>
<p><span class="error">* required field</span></p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

  Package Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>

  <p>------------------------------------------------------------------</p>

  Banner ads:
  <input type="radio" name="banner" <?php if (isset($banner) && $banner=="admob") echo "checked";?> value="admob">Admob
  <input type="radio" name="banner" <?php if (isset($banner) && $banner=="fb") echo "checked";?> value="fb">Fb
  <span class="error">* <?php echo $bannerErr;?></span>
  <br><br>
  Banner ads id: <input type="text" name="bannerid" value="<?php echo $bannerid;?>">
  <span class="error">* <?php echo $banneridErr;?></span>
  <br><br>

  <p>------------------------------------------------------------------</p>

  Interstrial ads:
  <input type="radio" name="interstrial" <?php if (isset($interstrial) && $interstrial=="admob") echo "checked";?> value="admob">Admob
  <input type="radio" name="interstrial" <?php if (isset($interstrial) && $interstrial=="fb") echo "checked";?> value="fb">Fb
  <span class="error">* <?php echo $interstrialErr;?></span>
  <br><br>
  Interstrial ads id: <input type="text" name="interstrialid" value="<?php echo $interstrialid;?>">
  <span class="error">* <?php echo $interstrialidErr;?></span>
  <br><br>

  <p>------------------------------------------------------------------</p>

  Time: <input type="text" name="time" value="<?php echo $time;?>">
  <span class="error">* <?php echo $timeErr;?></span>
  <br><br>


  <input type="submit" name="submit" value="Submit">
</form>

<?php
echo "<h2>Your Input:</h2>";
echo "Package Name: ".$name;
echo "<br>";

echo "Banner ads type: ".$banner;
echo "<br>";
echo "Banner ads id: ".$bannerid;
echo "<br>";

echo "Interstrial ads type: ".$interstrial;
echo "<br>";
echo "Interstrial ads id: ".$interstrialid;
echo "<br>";

echo "Time: ".$time;
echo "<br>";
?>

</body>
</html>
