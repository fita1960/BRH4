<?php
    include_once 'header.php';
    include_once 'includes/connect.inc.php';
?>

<section class="projects-activities-section">
    <div class="container-fluid" style="background-color: #3f7652">     
        <h1 class="display-3 fw-bold p-4 text-center text-white">BARANGAY ACCOMPLISHMENTS</h1>
    </div>

    <?php
        try {
            $sql = "SELECT * FROM accomplishments WHERE active='1'";
            $q = $conn->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    ?>
    
    <div class="container p-4 mb-5">
    <?php while ($row = $q->fetch()): 
        $accomplishmentImageURL = 'assets/accomplishments/'.$row["accomplishment_image"];
    ?>
        <div class="row flex-row-reverse g-5 align-items-center mb-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-5 fw-bold mb-4"><?php echo $row['accomplishment_name']; ?></h1>
                <p class="mb-1" style="font-size: 16px;"> 
                    <?php echo $row['accomplishment_description']; ?>
                </p>
            </div>
            <div class="col-lg-6">
                <img src="<?php echo $accomplishmentImageURL; ?>" class="img-fluid shadow-lg p-3 bg-body rounded" alt="Barangay Image">
            </div>
        </div>
    <?php 
        endwhile; 
    ?> 
    </div>
    <br>
</section>

<?php
    include_once 'footer.php';
?> 