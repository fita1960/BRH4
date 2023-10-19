<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $user_email = $_POST["user_email"];
    $user_pword = $_POST["user_pword"];

    try {
        
        require_once 'connect.inc.php';

        $query = "SELECT * FROM users WHERE user_email = :user_email AND user_pword = :user_pword AND user_status='1' AND active='1'";  

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":user_email", $user_email);
        $stmt->bindParam(":user_pword", $user_pword);

        $stmt->execute(); 

        $count = $stmt->rowCount();  

        if ($count > 0)  
        { 
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $user_type = $row['user_type'];
            $user_fname = $row['user_fname'];
            $user_lname = $row['user_lname'];
            $user_id = $row['user_id'];

            $_SESSION["user_email"] = $user_email; 
            $_SESSION["user_fname"] = $user_fname; 
            $_SESSION["user_lname"] = $user_lname; 
            $_SESSION["user_id"] = $user_id; 
            
            if ($user_type=='1') {
                header("Location: ../admin-page/admin-index.php");          
            } else {
                header("Location: ../user-page/user-index.php");  
            }
        }  else {  
            
            echo "<script>
                    alert('Unable to access user. Please try again! If you have already registered an account, a notification will be sent to you once account is activated and ready for use.');
                    window.location.href='../login.php';
                 </script>";
        } 

    } catch(PDOException $e) {
        echo "Query failed: " . $e->getMessage();
        }

    } else  {
    header("Location: ../index.php");
    die();
    }
