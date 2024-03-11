<?php
session_start();
include "../classes/db.php";

class register extends Database {

    public function __construct() {
        parent::__construct();
        $this->register();
    }

    public function register() {
        if (isset($_POST['register'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $image = $_FILES['image']['name'];  
            $tmp_name = $_FILES['image']['tmp_name'];
            $phone = $_POST['phone'];
            $designation = isset($_POST['designation']);
            $gender = isset($_POST['gender']);    

            // checking empty fields
            if (empty($username) || empty($email) || empty($password) || empty($image) || empty($phone) || empty($designation) || empty($gender)) {
                echo "<script>alert('All fields are required!')</script>";    
            }else{  

                move_uploaded_file($tmp_name, "../images/$image");

                $sql = "INSERT INTO employee(username, email, password, img, phone_no, designation, gender) 
                VALUES('$username', '$email', '$password', '$image', '$phone', '$designation', '$gender')";  
                $result = $this->conn->query($sql);

                if ($result) {
                    header("Location: ../index.php");
                } else {
                    echo "<script>alert('Registration failed!')</script>";
                }
            }
        }
    }
}


if(isset($_POST['register'])){
    $regUser= new register();
    $regUser->register();
}

