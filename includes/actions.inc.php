<?php

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    
    switch ($action) {
        case 'registeraccount':
            registerAccount($_POST);
            break;
        case 'addofficial':
            addOfficial($_POST);
            break;
        case 'editofficial':
            editOfficial($_POST);
            break;
        case 'deleteofficial':
            deleteOfficial($_POST);
            break;
        case 'addproject':
            addProject($_POST);
            break;
        case 'editproject':
            editProject($_POST);
            break;
        case 'deleteproject':
            deleteProject($_POST);
            break;
        case 'addactivity':
            addActivity($_POST);
            break;
        case 'editactivity':
            editActivity($_POST);
            break;
        case 'deleteactivity':
            deleteActivity($_POST);
            break;
        case 'addaccomplishment':
            addAccomplishment($_POST);
            break;
        case 'editaccomplishment':
            editAccomplishment($_POST);
            break;
        case 'deleteaccomplishment':
            deleteAccomplishment($_POST);
            break;
        case 'addrequesttype':
            addRequestType($_POST);
            break;
        case 'editrequesttype':
            editRequestType($_POST);
            break;
        case 'deleterequesttype':
            deleteRequestType($_POST);
            break;
        case 'adminupdateuser':
            adminUpdateUser($_POST);
            break;
        case 'deleteuser':
            deleteUser($_POST);
            break;
        case 'userupdateprofile':
            userUpdateProfile($_POST);
            break;
        case 'cancelrequest':
            cancelRequest($_POST);
            break;
        case 'approverequest':
            approveRequest($_POST);
            break;
        case 'disapproverequest':
            disapproveRequest($_POST);
            break;
        case 'requestdocument':
            requestDocument($_POST);
            break;
        case 'downloadattachment':
            downloadAttachment($_POST);
            break;
        default:
            echo "Unknown action";
    }
}

// Account Registration Action

function registerAccount() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $user_valid_id = $_FILES["user_valid_id"];
        $user_selfie_image = $_FILES["user_selfie_image"];
        $user_residency_file = $_FILES["user_residency_file"];
        
        if (handleFile($user_valid_id) && handleFile($user_selfie_image) && handleFile($user_residency_file)) {
            try {

                require_once 'connect.inc.php';

                $user_fname = $_POST["user_fname"];
                $user_mname = $_POST["user_mname"];
                $user_lname = $_POST["user_lname"];
                $user_gender = $_POST["user_gender"];
                $user_civil_status = $_POST["user_civil_status"];
                $user_date_of_birth = $_POST["user_date_of_birth"];
                $user_address = $_POST["user_address"];
                $user_contact_number = $_POST["user_contact_number"];
                $user_email = $_POST["user_email"];
                $user_pword = $_POST["user_pword"];
                
                $query = "INSERT INTO users (user_fname, user_mname, user_lname, user_gender, user_civil_status, user_date_of_birth, user_address, user_contact_number, user_email, user_pword, user_valid_id, user_selfie_image, user_residency_file) 
                         VALUES (:user_fname, :user_mname, :user_lname, :user_gender, :user_civil_status, :user_date_of_birth, :user_address, :user_contact_number, :user_email, :user_pword, :user_valid_id, :user_selfie_image, :user_residency_file)";

                $stmt = $conn->prepare($query);
        
                $stmt->bindParam(":user_fname", $user_fname);
                $stmt->bindParam(":user_mname", $user_mname);
                $stmt->bindParam(":user_lname", $user_lname);
                $stmt->bindParam(":user_gender", $user_gender);
                $stmt->bindParam(":user_civil_status", $user_civil_status);
                $stmt->bindParam(":user_date_of_birth", $user_date_of_birth);
                $stmt->bindParam(":user_address", $user_address);
                $stmt->bindParam(":user_contact_number", $user_contact_number);
                $stmt->bindParam(":user_email", $user_email);
                $stmt->bindParam(":user_pword", $user_pword); 
                $stmt->bindParam(":user_valid_id", $user_valid_id["name"]);
                $stmt->bindParam(":user_selfie_image", $user_selfie_image["name"]);
                $stmt->bindParam(":user_residency_file", $user_residency_file["name"]); 

                $stmt->execute();
                
                $stmt = null;
                $conn = null;

                echo "<script>
                        alert('You have successfully registered an account. We will notify you once your account is activated!');
                        window.location.href='../login.php';
                     </script>";

                die();
            } catch (PDOException $e) {
                echo "Query failed: " . $e->getMessage();
            }
        }
    } else {
        header("Location: ../login.php");
        die();
    }
}

function handleFile($file) {
    if ($file["error"] === UPLOAD_ERR_OK) {
        $filename = $file["name"];
        $tmp_name = $file["tmp_name"];
        $destination = "../assets/user_files/" . $filename;

        if (move_uploaded_file($tmp_name, $destination)) {
            return true; // Return true to indicate success
        } else {
            echo "Error uploading the file: $filename.<br>";
        }
    } else {
        echo "File upload error for '$file[name]'. Error code: $file[error]<br>";
    }

    return false; // Return false to indicate failure
}

// Officials Actions

function addOfficial() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $file = $_FILES["official_image"];

        if ($file["error"] === UPLOAD_ERR_OK) {

            $filename = $file["name"];
            $tmp_name = $file["tmp_name"];
            $destination = "../assets/officials/" . $filename;

            if (move_uploaded_file($tmp_name, $destination)) {

                try {

                    require_once 'connect.inc.php';

                    $official_name = $_POST["official_name"];
                    $official_position = $_POST["official_position"];
                    
                    $query = "INSERT INTO officials (official_name, official_position, official_image) VALUES (:official_name, :official_position, :official_image)";
        
                    $stmt = $conn->prepare($query);
        
                    $stmt->bindParam(":official_name", $official_name);
                    $stmt->bindParam(":official_position", $official_position);
                    $stmt->bindParam(":official_image", $filename);
        
                    $stmt->execute();
        
                    $stmt = null;
                    $conn = null;
        
                    header("Location: ../admin-page/admin-officials.php");
                    die();

                } catch (PDOException $e) {
                    echo "Query failed: " . $e->getMessage();
                }

            } else {
                echo "Error uploading the file.";
            }

        } else {
            echo "File upload error. Error code: " . $file["error"];
        }

    } else {
        header("Location: ../admin-page/admin-projects.php");
        die();
    }
}

// Officials Actions

function editOfficial() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $file = $_FILES["official_image"];

        if ($file["error"] === UPLOAD_ERR_OK) {

            $filename = $file["name"];
            $tmp_name = $file["tmp_name"];
            $destination = "../assets/officials/" . $filename;

            if (move_uploaded_file($tmp_name, $destination)) {

                try {

                    require_once 'connect.inc.php';

                    $official_name = $_POST["official_name"];
                    $official_position = $_POST["official_position"];
                    $official_id = $_POST["official_id"];
                    
                    $query = "UPDATE officials SET official_name = :official_name, official_position = :official_position, official_image = :official_image WHERE official_id = :official_id";
        
                    $stmt = $conn->prepare($query);
        
                    $stmt->bindParam(":official_name", $official_name);
                    $stmt->bindParam(":official_position", $official_position);
                    $stmt->bindParam(":official_image", $filename);
                    $stmt->bindParam(":official_id", $official_id);
        
                    $stmt->execute();
        
                    $stmt = null;
                    $conn = null;

                    header("Location: ../admin-page/admin-officials.php");
                    die();
                    
                } catch (PDOException $e) {
                    echo "Query failed: " . $e->getMessage();
                }

            } else {
                echo "Error uploading the file.";
            }

        } else {
            echo "File upload error. Error code: " . $file["error"];
        }

    } else {
        header("Location: ../admin-page/admin-officials.php");
        die();
    }
}

function deleteOfficial() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        try {
                
            require_once 'connect.inc.php';

            $official_id = $_POST['official_id'];

            $query = "UPDATE officials set active = '0' WHERE official_id = :official_id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":official_id", $official_id, PDO::PARAM_INT);

            $stmt->execute();

            $stmt = null;
            $conn = null;

            header("Location: ../admin-page/admin-officials.php");

            die();

        } catch(PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }
}

// Projects Actions

function addProject() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $file = $_FILES["project_image"];

        if ($file["error"] === UPLOAD_ERR_OK) {

            $filename = $file["name"];
            $tmp_name = $file["tmp_name"];
            $destination = "../assets/projects/" . $filename;

            if (move_uploaded_file($tmp_name, $destination)) {

                try {

                    require_once 'connect.inc.php';

                    $project_name = $_POST["project_name"];
                    $project_description = $_POST["project_description"];
                    $featured = $_POST["featured"];

                    $query = "INSERT INTO projects (project_name, project_description, project_image, featured) VALUES (:project_name, :project_description, :project_image, :featured)";
        
                    $stmt = $conn->prepare($query);

                    $stmt->bindParam(":project_name", $project_name);
                    $stmt->bindParam(":project_description", $project_description);
                    $stmt->bindParam(":project_image", $filename);
                    $stmt->bindParam(":featured", $featured);
        
                    $stmt->execute();
        
                    $stmt = null;
                    $conn = null;
        
                    header("Location: ../admin-page/admin-projects.php");
                    die();

                } catch (PDOException $e) {
                    echo "Query failed: " . $e->getMessage();
                }

            } else {
                echo "Error uploading the file.";
            }

        } else {
            echo "File upload error. Error code: " . $file["error"];
        }

    } else {

        header("Location: ../admin-page/admin-projects.php");
        die();

    }
}

function editProject() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $file = $_FILES["project_image"];

        if ($file["error"] === UPLOAD_ERR_OK) {

            $filename = $file["name"];
            $tmp_name = $file["tmp_name"];
            $destination = "../assets/projects/" . $filename;

            if (move_uploaded_file($tmp_name, $destination)) {

                try {

                    require_once 'connect.inc.php';

                    $project_name = $_POST["project_name"];
                    $project_description = $_POST["project_description"];
                    $featured = $_POST["featured"];
                    $project_id = $_POST["project_id"];
        
                    $query = "UPDATE projects SET project_name = :project_name, project_description = :project_description, project_image = :project_image, featured = :featured WHERE project_id = :project_id";

                    $stmt = $conn->prepare($query);
        
                    
                    $stmt->bindParam(":project_name", $project_name);
                    $stmt->bindParam(":project_description", $project_description);
                    $stmt->bindParam(":project_image", $filename);
                    $stmt->bindParam(":featured", $featured);
                    $stmt->bindParam(":project_id", $project_id);
        
                    $stmt->execute();
        
                    $stmt = null;
                    $conn = null;

                    header("Location: ../admin-page/admin-projects.php");
                    die();
                    
                } catch (PDOException $e) {
                    echo "Query failed: " . $e->getMessage();
                }

            } else {
                echo "Error uploading the file.";
            }

        } else {
            echo "File upload error. Error code: " . $file["error"];
        }
        
    } else {
        header("Location: ../admin-page/admin-projects.php");
        die();
    }
}

function deleteProject() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        try {
                
            require_once 'connect.inc.php';

            $project_id = $_POST['project_id'];

            $query = "UPDATE projects set active = '0' WHERE project_id = :project_id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":project_id", $project_id, PDO::PARAM_INT);

            $stmt->execute();

            $stmt = null;
            $conn = null;

            header("Location: ../admin-page/admin-projects.php");

            die();

        } catch(PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }
}

// Activities Actions

function addActivity() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $file = $_FILES["activity_image"];

        if ($file["error"] === UPLOAD_ERR_OK) {

            $filename = $file["name"];
            $tmp_name = $file["tmp_name"];
            $destination = "../assets/activities/" . $filename;

            if (move_uploaded_file($tmp_name, $destination)) {

                try {

                    require_once 'connect.inc.php';

                    $activity_name = $_POST["activity_name"];
                    $activity_description = $_POST["activity_description"];
                    $featured = $_POST["featured"];

                    $query = "INSERT INTO activities (activity_name, activity_description, activity_image, featured) VALUES (:activity_name, :activity_description, :activity_image, :featured)";

                    $stmt = $conn->prepare($query);
                    
                    $stmt->bindParam(":activity_name", $activity_name);
                    $stmt->bindParam(":activity_description", $activity_description);
                    $stmt->bindParam(":activity_image", $filename);
                    $stmt->bindParam(":featured", $featured);

        
                    $stmt->execute();
        
                    $stmt = null;
                    $conn = null;
        
                    header("Location: ../admin-page/admin-activities.php");
                    die();

                } catch (PDOException $e) {
                    echo "Query failed: " . $e->getMessage();
                }

            } else {
                echo "Error uploading the file.";
            }

        } else {
            echo "File upload error. Error code: " . $file["error"];
        }

    } else {
        header("Location: ../admin-page/admin-activities.php");
        die();
    }
}

function editActivity() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $file = $_FILES["activity_image"];

        if ($file["error"] === UPLOAD_ERR_OK) {

            $filename = $file["name"];
            $tmp_name = $file["tmp_name"];
            $destination = "../assets/activities/" . $filename;

            if (move_uploaded_file($tmp_name, $destination)) {

                try {

                    require_once 'connect.inc.php';

                    $activity_name = $_POST["activity_name"];
                    $activity_description = $_POST["activity_description"];
                    $featured = $_POST["featured"];
                    $activity_id = $_POST["activity_id"];

                    $query = "UPDATE activities SET activity_name = :activity_name, activity_description = :activity_description, activity_image = :activity_image, featured = :featured WHERE activity_id = :activity_id";

                    $stmt = $conn->prepare($query);
                    
                    $stmt->bindParam(":activity_name", $activity_name);
                    $stmt->bindParam(":activity_description", $activity_description);
                    $stmt->bindParam(":activity_image", $filename);
                    $stmt->bindParam(":featured", $featured);
                    $stmt->bindParam(":activity_id", $activity_id);

                    $stmt->execute();
        
                    $stmt = null;
                    $conn = null;

                    header("Location: ../admin-page/admin-activities.php");
                    die();
                    
                } catch (PDOException $e) {
                    echo "Query failed: " . $e->getMessage();
                }

            } else {
                echo "Error uploading the file.";
            }

        } else {
            echo "File upload error. Error code: " . $file["error"];
        }
        
    } else {
        header("Location: ../admin-page/admin-activities.php");
        die();
    }
}

function deleteActivity() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        try {
                
            require_once 'connect.inc.php';

            $activity_id = $_POST['activity_id'];

            $query = "UPDATE activities set active = '0' WHERE activity_id = :activity_id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":activity_id", $activity_id, PDO::PARAM_INT);

            $stmt->execute();

            $stmt = null;
            $conn = null;

            header("Location: ../admin-page/admin-activities.php");

            die();

        } catch(PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }
}

// Accomplishments Actions

function addAccomplishment() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $file = $_FILES["accomplishment_image"];

        if ($file["error"] === UPLOAD_ERR_OK) {

            $filename = $file["name"];
            $tmp_name = $file["tmp_name"];
            $destination = "../assets/accomplishments/" . $filename;

            if (move_uploaded_file($tmp_name, $destination)) {

                try {

                    require_once 'connect.inc.php';

                    $accomplishment_name = $_POST["accomplishment_name"];
                    $accomplishment_description = $_POST["accomplishment_description"];
                    $featured = $_POST["featured"];

                    $query = "INSERT INTO accomplishments (accomplishment_name, accomplishment_description, accomplishment_image, featured) VALUES (:accomplishment_name, :accomplishment_description, :accomplishment_image, :featured)";

                    $stmt = $conn->prepare($query);
                    
                    $stmt->bindParam(":accomplishment_name", $accomplishment_name);
                    $stmt->bindParam(":accomplishment_description", $accomplishment_description);
                    $stmt->bindParam(":accomplishment_image", $filename);
                    $stmt->bindParam(":featured", $featured);
        
                    $stmt->execute();
        
                    $stmt = null;
                    $conn = null;
        
                    header("Location: ../admin-page/admin-accomplishments.php");
                    die();

                } catch (PDOException $e) {
                    echo "Query failed: " . $e->getMessage();
                }

            } else {
                echo "Error uploading the file.";
            }

        } else {
            echo "File upload error. Error code: " . $file["error"];
        }

    } else {

        header("Location: ../admin-page/admin-accomplishments.php");
        die();

    }
}

function editAccomplishment() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $file = $_FILES["accomplishment_image"];

        if ($file["error"] === UPLOAD_ERR_OK) {

            $filename = $file["name"];
            $tmp_name = $file["tmp_name"];
            $destination = "../assets/accomplishments/" . $filename;

            if (move_uploaded_file($tmp_name, $destination)) {

                try {

                    require_once 'connect.inc.php';

                    $accomplishment_name = $_POST["accomplishment_name"];
                    $accomplishment_description = $_POST["accomplishment_description"];
                    $featured = $_POST["featured"];
                    $accomplishment_id = $_POST["accomplishment_id"];

                    $query = "UPDATE accomplishments SET accomplishment_name = :accomplishment_name, accomplishment_description = :accomplishment_description, accomplishment_image = :accomplishment_image, featured = :featured WHERE accomplishment_id = :accomplishment_id";

                    $stmt = $conn->prepare($query);
                    
                    $stmt->bindParam(":accomplishment_name", $accomplishment_name);
                    $stmt->bindParam(":accomplishment_description", $accomplishment_description);
                    $stmt->bindParam(":accomplishment_image", $filename);
                    $stmt->bindParam(":featured", $featured);
                    $stmt->bindParam(":accomplishment_id", $accomplishment_id);

                    $stmt->execute();
        
                    $stmt = null;
                    $conn = null;

                    header("Location: ../admin-page/admin-accomplishments.php");
                    die();
                    
                } catch (PDOException $e) {
                    echo "Query failed: " . $e->getMessage();
                }

            } else {
                echo "Error uploading the file.";
            }

        } else {
            echo "File upload error. Error code: " . $file["error"];
        }
        
    } else {
        header("Location: ../admin-page/admin-accomplishments.php");
        die();
    }
}


function deleteAccomplishment() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        try {
                
            require_once 'connect.inc.php';

            $accomplishment_id = $_POST['accomplishment_id'];

            $query = "UPDATE accomplishments set active = '0' WHERE accomplishment_id = :accomplishment_id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":accomplishment_id", $accomplishment_id, PDO::PARAM_INT);

            $stmt->execute();

            $stmt = null;
            $conn = null;

            header("Location: ../admin-page/admin-accomplishments.php");

            die();

        } catch(PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }
}

// Request Type Actions

function addRequestType() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $request_type_name = $_POST["request_type_name"];
        $request_type_description = $_POST["request_type_description"];

        try {
            
            require_once 'connect.inc.php';

            $query = "INSERT INTO request_type (request_type_name, request_type_description) VALUES 
            (:request_type_name, :request_type_description)";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":request_type_name", $request_type_name);
            $stmt->bindParam(":request_type_description", $request_type_description);

            $stmt->execute();

            $stmt = null;
            $conn = null;

            header("Location: ../admin-page/admin-request_types.php");

            die();

        } catch(PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }

    } else  {

    header("Location: ../admin-page/admin-request_types.php");
    die();

    }
}

function editRequestType() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $request_type_name = $_POST["request_type_name"];
        $request_type_description = $_POST["request_type_description"];
        $request_type_id = $_POST["request_type_id"];

        try {
            
            require_once 'connect.inc.php';

            $query = "UPDATE request_type SET request_type_name = :request_type_name, request_type_description = :request_type_description WHERE request_type_id = :request_type_id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":request_type_name", $request_type_name);
            $stmt->bindParam(":request_type_description", $request_type_description);
            $stmt->bindParam(":request_type_id", $request_type_id);

            $stmt->execute();

            $stmt = null;
            $conn = null;

            header("Location: ../admin-page/admin-request_types.php");

            die();

        } catch(PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }

    } else  {

    header("Location: ../admin-page/admin-request_types.php");
    die();

    }
}

function deleteRequestType() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        try {
                
            require_once 'connect.inc.php';

            $request_type_id = $_POST['request_type_id'];

            $query = "UPDATE request_type set active = '0' WHERE request_type_id = :request_type_id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":request_type_id", $request_type_id, PDO::PARAM_INT);

            $stmt->execute();

            $stmt = null;
            $conn = null;

            header("Location: ../admin-page/admin-request_types.php");

            die();

        } catch(PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }
}

// Admin User Actions

function adminUpdateUser() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $user_fname = $_POST["user_fname"];
        $user_mname = $_POST["user_mname"];
        $user_lname = $_POST["user_lname"];
        $user_gender = $_POST["user_gender"];
        $user_civil_status = $_POST["user_civil_status"];
        $user_date_of_birth = $_POST["user_date_of_birth"];
        $user_address = $_POST["user_address"];
        $user_contact_number = $_POST["user_contact_number"];
        $user_email = $_POST["user_email"];
        $user_pword = $_POST["user_pword"];
        $user_status = $_POST["user_status"];
        $user_id = $_POST["user_id"];

        try {
            
            require_once 'connect.inc.php';

            $query = "UPDATE users 
            SET user_fname = :user_fname, 
                user_mname = :user_mname, 
                user_lname = :user_lname, 
                user_gender = :user_gender, 
                user_civil_status = :user_civil_status, 
                user_date_of_birth = :user_date_of_birth, 
                user_address = :user_address, 
                user_contact_number = :user_contact_number, 
                user_email = :user_email, 
                user_pword = :user_pword, 
                user_status = :user_status
            WHERE user_id = :user_id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":user_fname", $user_fname);
            $stmt->bindParam(":user_mname", $user_mname);
            $stmt->bindParam(":user_lname", $user_lname);
            $stmt->bindParam(":user_gender", $user_gender);
            $stmt->bindParam(":user_civil_status", $user_civil_status);
            $stmt->bindParam(":user_date_of_birth", $user_date_of_birth);
            $stmt->bindParam(":user_address", $user_address);
            $stmt->bindParam(":user_contact_number", $user_contact_number);
            $stmt->bindParam(":user_email", $user_email);
            $stmt->bindParam(":user_pword", $user_pword); 
            $stmt->bindParam(":user_status", $user_status); 
            $stmt->bindParam(":user_id", $user_id);

            $stmt->execute();

            $stmt = null;
            $conn = null;

            header("Location: ../admin-page/admin-userlist.php");

            die();

        } catch(PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }

    } else  {

    header("Location: ../admin-page/admin-userlist.php");
    die();

    }
}

function deleteUser() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        try {
                
            require_once 'connect.inc.php';

            $user_id = $_POST['user_id'];

            $query = "UPDATE users set active = '0' WHERE user_id = :user_id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);

            $stmt->execute();

            $stmt = null;
            $conn = null;

            header("Location: ../admin-page/admin-userlist.php");

            die();

        } catch(PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }
}

// User Edit Profile

function userUpdateProfile() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $user_fname = $_POST["user_fname"];
        $user_mname = $_POST["user_mname"];
        $user_lname = $_POST["user_lname"];
        $user_gender = $_POST["user_gender"];
        $user_civil_status = $_POST["user_civil_status"];
        $user_date_of_birth = $_POST["user_date_of_birth"];
        $user_address = $_POST["user_address"];
        $user_contact_number = $_POST["user_contact_number"];
        $user_email = $_POST["user_email"];
        $user_pword = $_POST["user_pword"];
        $user_id = $_POST["user_id"];

        try {
            
            require_once 'connect.inc.php';

            $query = "UPDATE users 
            SET user_fname = :user_fname, 
                user_mname = :user_mname, 
                user_lname = :user_lname, 
                user_gender = :user_gender, 
                user_civil_status = :user_civil_status, 
                user_date_of_birth = :user_date_of_birth, 
                user_address = :user_address, 
                user_contact_number = :user_contact_number, 
                user_email = :user_email, 
                user_pword = :user_pword
            WHERE user_id = :user_id";
            
            $stmt = $conn->prepare($query);

            $stmt->bindParam(":user_fname", $user_fname);
            $stmt->bindParam(":user_mname", $user_mname);
            $stmt->bindParam(":user_lname", $user_lname);
            $stmt->bindParam(":user_gender", $user_gender);
            $stmt->bindParam(":user_civil_status", $user_civil_status);
            $stmt->bindParam(":user_date_of_birth", $user_date_of_birth);
            $stmt->bindParam(":user_address", $user_address);
            $stmt->bindParam(":user_contact_number", $user_contact_number);
            $stmt->bindParam(":user_email", $user_email);
            $stmt->bindParam(":user_pword", $user_pword); 
            $stmt->bindParam(":user_id", $user_id);

            $stmt->execute();

            $stmt = null;
            $conn = null;

            header("Location: ../user-page/user-profile.php");

            die();

        } catch(PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }

    } else  {

    header("Location: ../user-page/user-profile.php");
    die();

    }
}

//Cancel Request

function cancelRequest() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $request_id = $_POST["request_id"];

        try {
            
            require_once 'connect.inc.php';

            $query = "UPDATE request_list SET request_status = '3' WHERE request_id = :request_id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":request_id", $request_id);

            $stmt->execute();

            $stmt = null;
            $conn = null;

            header("Location: ../user-page/user-profile.php");

            die();

        } catch(PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }

    } else  {

    header("Location: ../user-page/user-profile.php");
    die();

    }
}

//Approve & Disapprove Request

function approveRequest() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $request_id = $_POST["request_id"];
        $file = $_FILES["request_attachment"];

        if ($file["error"] === UPLOAD_ERR_OK) {

            $filename = $file["name"];
            $newfilename = $request_id . '-' . $filename;
            $tmp_name = $file["tmp_name"];
            $destination = "../assets/request_attachments/" . $newfilename;

            if (move_uploaded_file($tmp_name, $destination)) {

                try {

                    require_once 'connect.inc.php';

                    $request_notes = $_POST["request_notes"];
                    $approval_date = date('Y-m-d');
                    $request_status = '1';
                    
        
                    $query = "UPDATE request_list SET request_attachment = :file, request_notes = :request_notes, approval_date = :approval_date, request_status = :request_status 
                    WHERE request_id = :request_id";

                    $stmt = $conn->prepare($query);
        
                    $stmt->bindParam(":file", $newfilename);
                    $stmt->bindParam(":request_notes", $request_notes);
                    $stmt->bindParam(":approval_date", $approval_date);
                    $stmt->bindParam(":request_status", $request_status);
                    $stmt->bindParam(":request_id", $request_id);

                    $stmt->execute();
        
                    $stmt = null;
                    $conn = null;

                    header("Location: ../admin-page/admin-requestlist.php");
                    die();
                    
                } catch (PDOException $e) {
                    echo "Query failed: " . $e->getMessage();
                }

            } else {
                echo "Error uploading the file.";
            }

        } else {
            echo "File upload error. Error code: " . $file["error"];
        }

    } else {
        header("Location: ../admin-page/admin-requestlist.php");
        die();
    }
}

function disapproveRequest() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $request_notes = $_POST["request_notes"];
        $approval_date = date('Y-m-d');
        $request_status = '2';
        $request_id = $_POST["request_id"];

        try {
            
            require_once 'connect.inc.php';

            $query = "UPDATE request_list SET request_notes = :request_notes, approval_date = :approval_date, request_status = :request_status 
            WHERE request_id = :request_id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":request_notes", $request_notes);
            $stmt->bindParam(":approval_date", $approval_date);
            $stmt->bindParam(":request_status", $request_status);
            $stmt->bindParam(":request_id", $request_id);

            $stmt->execute();

            $stmt = null;
            $conn = null;

            header("Location: ../admin-page/admin-requestlist.php");

            die();

        } catch(PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }

    } else  {

    header("Location: ../admin-page/admin-requestlist.php");
    die();

    }

 }

  // Request Document Actions

function requestDocument() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $request_date = date('Y-m-d');
        $request_type_id = $_POST["request_type_id"];
        $request_remarks = $_POST["request_remarks"];
        $user_id = $_POST["user_id"];

        try {
            
            require_once 'connect.inc.php';

            $query = "INSERT INTO request_list (request_date, request_type_id, request_remarks, user_id) VALUES 
            (:request_date, :request_type_id, :request_remarks, :user_id)";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":request_date", $request_date);
            $stmt->bindParam(":request_type_id", $request_type_id);
            $stmt->bindParam(":request_remarks", $request_remarks);
            $stmt->bindParam(":user_id", $user_id);

            $stmt->execute();

            $stmt = null;
            $conn = null;

            echo "<script>
                        alert('You have successfully created a request. Please check the status of your request on Profile tab!');
                        window.location.href='../user-page/user-requestdocument.php';
                  </script>";

            die();

        } catch(PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }

    } else  {

    header("Location: ../user-page/requestdocument.php");
    die();

    }
}
 
function downloadAttachment () {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $request_attachment = $_POST["request_attachment"];

        try {

            $file_path = "../assets/request_attachments/"; // Replace with the actual path to your files
            $file_name = $request_attachment; // Replace with the name of the file you want to download
            
            if (file_exists($file_path . $file_name)) {
                header('Content-Disposition: attachment; filename="' . $file_name . '"');
                readfile($file_path . $file_name);
            } else {
                echo "File not found";
            }

        } catch(PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }

    } else  {

    header("Location: ../user-page/user-profile.php");
    die();

    }
}

