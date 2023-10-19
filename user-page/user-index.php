<?php
    include_once 'user-header.php';
    include_once '../includes/connect.inc.php';

    if(isset($_SESSION["user_email"])) {
        echo '<div class="container mt-5 text-center">
                <h4>    
                    Welcome, ' . $_SESSION["user_fname"] . ' ' . $_SESSION["user_lname"] . '!
                </h4>
              </div>';
    } else {
        // If the user is not logged in, you can display a different message or redirect them to the login page
        header("Location: ../login.php");
    }
?>

<section class="services-section">
        <div class="container p-5" id="p1">
            <div class="row g-5 pt-5">
                <div class="col-12 col-sm-4 my-auto">
                    <div class="services row my-2">
                        <a href=""></a>
                        <p class="border border-3 border-success p-4 text-center fw-bold fs-3">Barangay Clearance</p>
                    </div>
                    <div class="services row my-2">
                        <p class="border border-3 border-success p-4 text-center fw-bold fs-3">Barangay ID</p>
                    </div>
                    <div class="services row my-2">
                        <p class="border border-3 border-success p-4 text-center fw-bold fs-3">Residency</p>
                    </div>
                    <div class="services row my-2">
                        <p class="border border-3 border-success p-4 text-center fw-bold fs-3">Cohabitation</p>
                    </div>
                </div>
                <div class="col-12 col-sm-4 mb-4 mt-2">
                    <img src="../assets/services-logo.png" class="img-fluid" alt="">
                </div>
                <div class="col-12 col-sm-4 my-auto">
                    <div class="services row my-2">
                        <p class="border border-3 border-success p-4 text-center fw-bold fs-3">Good Moral</p>
                    </div>
                    <div class="services row my-2">
                        <p class="border border-3 border-success p-4 text-center fw-bold fs-3">First Time Job Seeker</p>
                    </div>
                    <div class="services row my-2">
                        <p class="border border-3 border-success p-4 text-center fw-bold fs-3">Transfer of Residency</p>
                    </div>
                    <div class="services row my-2">
                        <p class="border border-3 border-success p-4 text-center fw-bold fs-3">Solo Parent</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
