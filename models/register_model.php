<?php

class UserRegistration
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function registerUser($first_name, $last_name, $email, $password)
    {
        // Validate input data
        if (!$this->validateEmail($email) || empty($first_name) || empty($last_name) || empty($email)) {
            return "Invalid input data";
        }

        // Escape input data to prevent SQL injection
        $email = $this->db->real_escape_string($email);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if the username already exists
        $checkQuery = "SELECT user_id FROM users WHERE email = '$email'";
        $checkResult = $this->db->query($checkQuery);

        if (!$checkResult) {
            die('Query failed: ' . $this->db->error);
        }

        if ($checkResult->num_rows > 0) {
            return "Username already exists";
        }

        // Insert new user into the database
        $insertQuery = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name','$email', '$hashedPassword')";
        $insertResult = $this->db->query($insertQuery);

        if (!$insertResult) {
            die('Query failed: ' . $this->db->error);
        }

        // Return success message or user ID, depending on your application needs
        return "Registration successful for username: $email";
    }

    private function validateEmail($email)
    {
        // Add your own validation rules for the email address
        return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function validatePassword($password)
    {
        // Add your own validation rules for the password
        return (bool) preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password);
    }
}
?>
