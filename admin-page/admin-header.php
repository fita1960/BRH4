<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay RH IV</title>

    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">

    <!--Local CSS-->
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <!--Bootstrap 5 Plugins-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!--Data Table CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top border-bottom">
        <div class="container">
            <div class="col-6 col-sm-4 pt-1">
              <a class="navbar-brand" href="admin-index.php"><img class="logo img-fluid mb-2" src="../assets/logo-1.png" alt="RH IV Logo"></a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-center" aria-current="page" href="admin-index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-center active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Maintenance
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-center" href="admin-officials.php">Officials</a></li>
                            <li><a class="dropdown-item text-center" href="admin-projects.php">Projects</a></li>
                            <li><a class="dropdown-item text-center" href="admin-activities.php">Activities</a></li>
                            <li><a class="dropdown-item text-center" href="admin-accomplishments.php">Accomplishments</a></li>
                            <li><a class="dropdown-item text-center" href="admin-request_types.php">Request Types</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-center active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Requests
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-center" href="admin-requestlist.php">Pending Requests</a></li>
                            <li><a class="dropdown-item text-center" href="admin-request_history.php">History</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-center" aria-current="page" href="admin-userlist.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-center" aria-current="page" href="../includes/logout.inc.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>