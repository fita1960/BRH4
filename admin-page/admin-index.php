<?php
    include_once 'admin-header.php';
    include_once '../includes/connect.inc.php';

    if(isset($_SESSION["user_email"])) {
        echo '<div class="container mt-5">
                <h4>    
                    Welcome, ' . $_SESSION["user_fname"] . ' ' . $_SESSION["user_lname"] . '!
                </h4>
              </div>';
    } else {
        header("Location: ../login.php");
    }
?>

<div class="container mt-5">

    <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col">
            <div class="card text-center">
                <div class="card-body">
                    <?php

                        try {
                            $sql = "SELECT COUNT(*) as record_count FROM officials WHERE active='1'";
                            $q = $conn->query($sql);
                            $q->setFetchMode(PDO::FETCH_ASSOC);
                            $row = $q->fetch();
                            $recordCount = $row['record_count'];

                        } catch (PDOException $e) {
                            die("Could not connect to the database $dbname: " . $e->getMessage());
                        }

                        echo '<h1 class="card-title"> ' . $recordCount . ' </h1>';

                    ?>
                    <h4 class="card-title">Officials</h4>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center">
                <div class="card-body">
                    <?php

                        try {
                            $sql = "SELECT COUNT(*) as record_count FROM projects WHERE active='1'";
                            $q = $conn->query($sql);
                            $q->setFetchMode(PDO::FETCH_ASSOC);
                            $row = $q->fetch();
                            $recordCount = $row['record_count'];

                        } catch (PDOException $e) {
                            die("Could not connect to the database $dbname: " . $e->getMessage());
                        }

                        echo '<h1> ' . $recordCount . ' </h1>';
                        
                    ?>
                    <h4 class="card-title">Projects</h4>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center">
                <div class="card-body">
                    <?php

                        try {
                            $sql = "SELECT COUNT(*) as record_count FROM activities WHERE active='1'";
                            $q = $conn->query($sql);
                            $q->setFetchMode(PDO::FETCH_ASSOC);
                            $row = $q->fetch();
                            $recordCount = $row['record_count'];

                        } catch (PDOException $e) {
                            die("Could not connect to the database $dbname: " . $e->getMessage());
                        }

                        echo '<h1> ' . $recordCount . ' </h1>';

                    ?>
                    <h4 class="card-title">Activities</h4>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center">
                <div class="card-body">
                    <?php

                        try {
                            $sql = "SELECT COUNT(*) as record_count FROM accomplishments WHERE active='1'";
                            $q = $conn->query($sql);
                            $q->setFetchMode(PDO::FETCH_ASSOC);
                            $row = $q->fetch();
                            $recordCount = $row['record_count'];

                        } catch (PDOException $e) {
                            die("Could not connect to the database $dbname: " . $e->getMessage());
                        }

                        echo '<h1> ' . $recordCount . ' </h1>';

                    ?>
                    <h4 class="card-title">Accomplishments</h4>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center">
                <div class="card-body">
                    <?php

                        try {
                            $sql = "SELECT COUNT(*) as record_count FROM request_type WHERE active='1'";
                            $q = $conn->query($sql);
                            $q->setFetchMode(PDO::FETCH_ASSOC);
                            $row = $q->fetch();
                            $recordCount = $row['record_count'];

                        } catch (PDOException $e) {
                            die("Could not connect to the database $dbname: " . $e->getMessage());
                        }

                        echo '<h1> ' . $recordCount . ' </h1>';

                    ?>
                    <h4 class="card-title">Request Types</h4>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center">
                <div class="card-body">
                    <?php

                        try {
                            $sql = "SELECT COUNT(*) as record_count FROM request_list WHERE request_status='0'";
                            $q = $conn->query($sql);
                            $q->setFetchMode(PDO::FETCH_ASSOC);
                            $row = $q->fetch();
                            $recordCount = $row['record_count'];

                        } catch (PDOException $e) {
                            die("Could not connect to the database $dbname: " . $e->getMessage());
                        }

                        echo '<h1> ' . $recordCount . ' </h1>';

                    ?>
                    <h4 class="card-title">Pending Requests</h4>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center">
                <div class="card-body">
                    <?php

                        try {
                            $sql = "SELECT COUNT(*) as record_count FROM request_list WHERE request_status='1' OR request_status='2'";
                            $q = $conn->query($sql);
                            $q->setFetchMode(PDO::FETCH_ASSOC);
                            $row = $q->fetch();
                            $recordCount = $row['record_count'];

                        } catch (PDOException $e) {
                            die("Could not connect to the database $dbname: " . $e->getMessage());
                        }

                        echo '<h1> ' . $recordCount . ' </h1>';

                    ?>
                    <h4 class="card-title">Request History</h4>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center">
                <div class="card-body">
                    <?php

                        try {
                            $sql = "SELECT COUNT(*) as record_count FROM users WHERE active='1'";
                            $q = $conn->query($sql);
                            $q->setFetchMode(PDO::FETCH_ASSOC);
                            $row = $q->fetch();
                            $recordCount = $row['record_count'];

                        } catch (PDOException $e) {
                            die("Could not connect to the database $dbname: " . $e->getMessage());
                        }

                        echo '<h1> ' . $recordCount . ' </h1>';

                    ?>
                    <h4 class="card-title">Users</h4>
                </div>
            </div>
        </div>
    </div>

</div>