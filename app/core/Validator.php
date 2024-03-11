<?php

namespace app\core;

class Validator
{
    public function validateImg($image)
    {
        $size = $image['size'];
        $type = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $validType = ["jpg", 'png', 'img'];
        // Check if there is an image uploaded
        if ($size <= 0) {
            // echo "--No image uploaded\n";
            // file is not uploaded, set file name "null"
            return null;
        }
        // Check if the image does not exceed the specified size (3MB)
        if ($size > 3145728) {
            // echo "--Image exceeds the specified size\n";
            return false;
        }
        // Check if the image file type is valid
        if (!in_array($type, $validType)) {
            // echo "--Invalid image file extension\n";
            return false;
        }
        // Return the file name if the size and type of the image file are valid

        return $image["name"];
    }

    // upload an image, and return the image location
    public function uploadImg($image)
    {
        // Extract necessary information
        $fileName = $image['name'];
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        // Generate unique hash for the file name
        $salt = uniqid(bin2hex(random_bytes(1)), true);
        $hashName = md5($fileName . $salt);
        // Set the upload location
        $location = "public/uploaded/" . $hashName . "." . $extension;
        // Attempt to move the uploaded file to the specified location
        if (move_uploaded_file($image["tmp_name"], $location)) {
            // echo "The file "  . $hashName . " has been uploaded.";
            return  $hashName . "." . $extension; // Return the file location
        } else {
            // echo "Sorry, there was an error uploading your file.";
            return false; // Return false indicating failure
        }
    }

    function validateInput($input, string $regexType)
    {
        // Check if input is empty after trimming whitespace
        // if (strlen(trim($input)) === 0) {
        //     return false; // Return false if input is empty
        // }
        // Associative array containing regex patterns for each validation type
        $regexPatterns = [
            "1" => '/^[a-zA-Z0-9\s]+$/',
            "2" => '/^[0-9]+$/'
            // Add other regex types if needed
        ];
        // echo $input;
        // Check if the regex type exists in the array
        if (isset($regexPatterns[$regexType])) {
            // Perform regex match against the input with the specified pattern
            if (preg_match($regexPatterns[$regexType], $input) != true) {
                return false; // Return false if regex pattern doesn't match
            }
        }
        return $input; // Input passed both validations
    }
}
