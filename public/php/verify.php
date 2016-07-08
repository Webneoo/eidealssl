<?php
//CAPTCHA Matching code
session_start();
if ($_SESSION["code"] == $_POST["captcha"]) {
    echo "Form Submitted successfully....!";
} else {
	$err = 1;
	echo json_encode($err);
   // die("Wrong TEXT Entered");
}
?>
