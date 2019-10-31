<?php
header("Content-Type: application/json");

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$re_password = $_POST["re_password"];
$address = $_POST["address"];
$phone = $_POST["phone"];

//check length of variables
function checkLength($name, $str, $len) {
    if(strlen($str) > $len)
        return true;
    else
        return $name . " Must More Than " . $len . " Characters";
}

//check Email
function checkEmail($email) {
    if((bool)preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/',$email) == true)
        return true;
    else
        return "Wrong Format Of Email";
}

//Check Contain Less One Character
function checkCapital($str) {
    for($i = 0; $i < strlen($str); $i++) {
        if($n = ord($str[$i]) >= 60 && $n = ord($str[$i]) <= 90){
            return true;
        }
    }

    return false;
}
 
//Check Password 
function checkPassword($str1, $str2) {
    $result = "";
    if($str1 !== $str2) {
        $result .= "Password And Re-Password Not Match. ";
        return $result;
    }
    if (strlen($str1) <= 8) {
        $result .= "Password And Re-Password Must More Than 8 Character. ";
        return $result;
    }
    if (checkCapital($str1) === false) {
        $result .= "Password Must Have Less One Capital Character. ";
        return $result;
    }

    return true;


}
//Check Phone
function checkPhone($phone) {
    if(!is_numeric($phone))
        return "Wrong Format Of Phone Number";

    elseif (strlen($phone) == 11) {
        if((int)($phone / 1000000000) !== 84)
            return "Not Viet Nam's Phone Number";
        else
            return true;
    }

    elseif (strlen($phone) == 10) {
        if((int)($phone / 1000000000) !== 0)
            return "Not Viet Nam's Phone Number";
        else
            return true;
    } else
        return "Wrong Format Of Phone Number";;
}

$errors = [
    "username" => true,
    "email" => true,
    "matchPassword" => true,
    "phone" => true
];

$errors["username"] = checkLength("User Name", $username, 3);
$errors["email"] = checkEmail($email);
$errors["password"] = checkPassword($password, $re_password);
$errors["phone"] = checkPhone($phone);

$printError = "";
foreach($errors as $e => $val) {
    if($val !== true) {
        $printError .= "<h3>" . $val . "</h3><br>";
    }
}

if($printError == "") {
    $result = true;
    sleep(3);
    echo json_encode($result);
} else {
    sleep(3);
    echo json_encode([$printError]);
}
?>
