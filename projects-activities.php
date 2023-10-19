<?php
    include_once 'header.php';
    include_once 'includes/connect.inc.php';
?>

<div class="container-fluid" style="background-color: #3f7652">     
    <h1 class="display-3 fw-bold p-4 text-center text-white">BARANGAY PROJECTS</h1>
</div>

<section class="projects-section">

    <?php
        try {
            $sql = "SELECT * FROM projects WHERE active='1'";
            $q = $conn->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    ?>
    
    <div class="container p-4 mb-5">
    <?php while ($row = $q->fetch()): 
        $projectImageURL = 'assets/projects/'.$row["project_image"];
    ?>
        <div class="row flex-row g-5 align-items-center mb-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-5 fw-bold mb-4"><?php echo $row['project_name']; ?></h1>
                <p class="mb-1" style="font-size: 16px;"> 
                    <?php echo $row['project_description']; ?>
                </p>
            </div>
            <div class="col-lg-6">
                <img src="<?php echo $projectImageURL; ?>" class="img-fluid shadow-lg p-3 bg-body rounded" alt="Barangay Image">
            </div>
        </div>
    <?php 
        endwhile; 
    ?> 
    </div>
</section>

<div class="container-fluid" style="background-color: #3f7652">     
    <h1 class="display-3 fw-bold p-4 text-center text-white">BARANGAY ACTIVITIES</h1>
</div>

<section class="activities-section">

    <?php
        try {
            $sql = "SELECT * FROM activities WHERE active='1'";
            $q = $conn->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    ?>
    
    <div class="container p-4 mb-5">
    <?php while ($row = $q->fetch()): 
        $activityImageURL = 'assets/activities/'.$row["activity_image"];
    ?>
        <div class="row flex-row-reverse g-5 align-items-center mb-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-5 fw-bold mb-4"><?php echo $row['activity_name']; ?></h1>
                <p class="mb-1" style="font-size: 16px;"> 
                    <?php echo $row['activity_description']; ?>
                </p>
            </div>
            <div class="col-lg-6">
                <img src="<?php echo $activityImageURL; ?>" class="img-fluid shadow-lg p-3 bg-body rounded" alt="Barangay Image">
            </div>
        </div>
    <?php 
        endwhile; 
    ?> 
    </div>
</section>

<?php
    include_once 'footer.php';
?> 