<?php
function email_validation($email){

    // $email = "example@hotmail.com";

// Remove all illegal characters from email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

// Extract domain name from email
    $domain = substr(strrchr($email, "@"), 1);

// Validate domain name
    if (in_array($domain, array("gmail.com", "yahoo.com", "outlook.com","hotmail.com","fastmail.com"))) {
    return true;
    } 
    else {
        return false;
    }
}

function password_validation($password){

    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long";
      } elseif (!preg_match('/[A-Z]/', $password)) {
        return "Password must contain at least one capital letter";
      } elseif (!preg_match('/\W/', $password) || !preg_match('/\d/', $password)) {
        return "Password must contain at least one special character and one number";
      } elseif (strpos($password, " ") !== false) {
        return "Password cannot contain spaces";
      } else {
        return "accepted";
      }
}

function check_confirm_password($password,$confirm_password){
    if ($password == $confirm_password){
        return true;
    }
}

function name_validation($name){
    $name = filter_var($name, FILTER_SANITIZE_STRING);

// Check if name meets requirements

        if (empty($name)) {
            return "Name is required";
        }
        elseif(strlen($name) < 3) {
            return "Name must be at least 3 characters long";
        } 
        elseif (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            return "Name can only contain letters and spaces";
        } 
        else {
            return "accepted";
        }   
}
function mobile_validation($phone){
    $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);

// Validate phone number
if (strlen($phone) != 10) {
  return "Phone number must be 10 digits long";
} elseif (!preg_match('/^[6789]\d{9}$/', $phone)) {
  return "Phone number is not valid";
} else {
  return "accepted";
}
}



function validatePrice($price) {
  

  if (preg_match("/^[0-9]+(\.[0-9]{2})?$/", $price)) {
    return true;  
}
return false;

}
function validatePrice1($price) {
  // Remove any thousand separators (e.g., comma)
  $price = str_replace(',', '', $price);

  // Check if the price is a valid numeric value with up to 2 decimal places
  if (preg_match('/^\d+(\.\d{1,2})?$/', $price)) {
      return true; // Valid price
  } else {
      return false; // Invalid price
  }
}

function product_title_validation($title){
  $title = filter_var($title, FILTER_SANITIZE_STRING);

// Check if name meets requirements
    if(strlen($title) < 6) {
          return "Title must be at least 6 characters long";
      } 
      else {
          return "accepted";
      }   
}

function product_detail_validation($title){
  $title = filter_var($title, FILTER_SANITIZE_STRING);

// Check if name meets requirements
    if(strlen($title) < 10) {
          return "Product details must be at least 10 characters long";
      } 
      else {
          return "accepted";
      }   
}

function product_more_detail_validation($title){
  $title = filter_var($title, FILTER_SANITIZE_STRING);

// Check if name meets requirements
    if(strlen($title) < 20) {
          return "Product details must be at least 20 characters long";
      } 
      else {
          return "accepted";
      }   
}

function file_validation($file){
  // Assuming the file is uploaded via a file input field

// Get the file extension
$fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

// Define allowed file extensions
$allowedExtensions = array('jpg', 'jpeg', 'png');

// Check if the file extension is allowed
if (in_array($fileExtension, $allowedExtensions)) {
    // Valid file type
    return "accepted";
} else {
    // Invalid file type
    return "Invalid file type. Please upload a JPG, JPEG, or PNG file.";
}
}




?>
