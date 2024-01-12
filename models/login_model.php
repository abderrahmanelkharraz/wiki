<?php

class UserLogin
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function loginUser($email, $password)
    {
        // Validate input data
        // || (!$this->validatePassword($password))
        if ((!$this->validateEmail($email)) )  {
            return "Invalid Email";
        }

        // Retrieve user data from the database
        $query = "SELECT user_id, password FROM users WHERE email = '$email'";
        $result = $this->db->query($query);

        if (!$result) {
            die('Query failed: ' . $this->db->error);
        }

        $userData = $result->fetch_assoc();

        // Check if the username exists
        if (!$userData) {
            return "Email not registered";
        }

        // Verify the password
        if (!password_verify($password, $userData['password'])) {
            return "Invalid password";
        }

        // Set user session or token for authentication
        // For simplicity, we'll just return the user ID in this example
        return intval($userData['user_id']);
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
