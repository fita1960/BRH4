<?php
    include_once 'header.php';
    include_once 'includes/connect.inc.php';
?>

<div class="main" >
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/carousel-1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="assets/carousel-2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="assets/carousel-3.jpg" class="d-block w-100" alt="...">
                </div>
        
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <section class="description-section">
            <div class="container mt-5 mb-5">
                <div class="row align-items-center py-5">
                    <div class="col-lg-6 text-center">
                        <h1 class="display-4 fw-bold mb-3 text-lg-start">ROSARY HEIGHTS IV</h1>
                        <p class="mb-4 fs-4 text-center text-lg-start"> 
                            Rosary Heights IV is a barangay in Cotabato City. 
                            Its population as determined by the 2020 Census was 4,627. 
                            This represented 1.42% of the total population of Cotabato City.
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <img src="assets/hero-1.jpg" class="img-fluid shadow-lg p-3 bg-body rounded" alt="Barangay Image">
                    </div>
                </div>
            </div>
        </section>
    

        <section class="featured-projects-section">

            <?php
                try {
                    $sql = "SELECT * FROM projects WHERE featured='1' AND active='1'";
                    $q = $conn->query($sql);
                    $q->setFetchMode(PDO::FETCH_ASSOC);
                    
                } catch (PDOException $e) {
                    die("Could not connect to the database $dbname :" . $e->getMessage());
                }
            ?>
            
            <div class="container-fluid" style="background-color: #3f7652">
                <h1 class="display-3 fw-bold p-4 text-center text-white">FEATURED PROJECTS</h1>
            </div>

            <div class="container py-5">
                <div class="row row-cols-1 row-cols-md-3 g-4 pt-2">
                    <?php while ($row = $q->fetch()): 
                        $projectImageURL = 'assets/projects/'.$row["project_image"];
                    ?>
                        <div class="col">
                            <div class="card p-3 h-100">
                                <img src="<?php echo $projectImageURL; ?>" class="card-img-top h-30" alt="...">
                                <div class="card-body h-70">
                                    <h3 class="card-title fw-bold text-center"><?php echo $row['project_name']; ?></h3>
                                    <p class="card-text text-lg-start text-center"><?php echo $row['project_description']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php 
                        endwhile; 
                    ?>                
                </div>
            </div>
        </section>

        <section class="mvg-section my-1 pt-5 pb-1 px-3" style="background-color: #3f7652">
            <div class="col-md-10 mx-auto col-lg-4 mb-5 border-3" style="border: solid 1px; border-color: black; border-radius: 50px; background-color: white">
                <div class="text-center mt-3">
                    <img src="assets/logo-1.png" class="img-fluid w-30" alt="">
                </div>
                <ul class="nav nav-pills justify-content-center mt-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fs-5" id="mission-tab" data-bs-toggle="tab" data-bs-target="#mission" type="button" role="tab" aria-selected="false" tabindex="-1">Our Mission</button>
                    </li>
                    <li class="nav-item" role="presentation" style="font-family: Poppins;">
                        <button class="nav-link fs-5" id="vision-tab" data-bs-toggle="tab" data-bs-target="#vision" type="button" role="tab" aria-selected="false" tabindex="-1">Our Vision</button>
                        </li>
                    <li class="nav-item" role="presentation" style="font-family: Poppins;">
                        <button class="nav-link fs-5" id="goal-tab" data-bs-toggle="tab" data-bs-target="#goal" type="button" role="tab" aria-selected="true">Our Goal</button>
                    </li>
                </ul>
                <div class="text-center p-4">
                    <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade align-items-center" id="mission" role="tabpanel" aria-labelledby="mission-tab">
                        <p class="mt-4">
                        A Barangay that is God-centered, competent, orderly, honest, peaceful, credible, gender responsive and abides the Code of Conduct.</p>
                    </div>
                    <div class="tab-pane fade" id="vision" role="tabpanel" aria-labelledby="vision-tab">
                        <p class="mt-4">
                        We exercise transparency, integrity, professionalism, efficiency and most of all we conduct free services because as Public 
                        Servants. We are accountable to the residents of Barangay Rosary Heights IV.
                        </p>
                    </div>
                    <div class="tab-pane fade active show" id="goal" role="tabpanel" aria-labelledby="goal-tab">
                        <p class="mt-4">
                        Barangay Rosary Heights IV aims to be efficient in serving the public because Public Office is a Public Trust and must at all times 
                        be accountable to the people, serve them with utmost responsibility, loyalty and efficiency, act with patriotism and justice 
                        and lead modest lives. Thus, Barangay Rosary Heights IV is determined to address everything that hinder its way to be the best.
                        </p>
                    </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="message pt-5">
            <div class="container mb-5">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-center">
                        <img src="assets/kapitan.png" class="img-fluid p-3 mb-3" alt="Barangay Image" width="400">
                    </div>
                    <div class="col-lg-6 text-center">
                        <h1 class="display-5 fw-bold mb-3">MESSAGE FROM OUR PUNONG BARANGAY</h1>
                        <p class="message mb-3">
                        "Binibigyan po natin ng kahalagahan sa araw na ito ang lahat ng dakilang ina ng ating komunidad. 
                        Sa panahon ng krisis dulot NG COVID19 kayo ang tunay na naging frontliner para sa inyong pamilya upang sila ay maprotektahan laban sa sakit, 
                        kayo ang nagbigay nutrisyon sa inyong pamilya upang siguruhin may sapat silang resistensya at lakas ng pangangatawan. 
                        Bagamat mahirap ang ating sitwasyon kayo ay nagpakatatag sa pagsubok at sa inyong katatagan ating maitatawid ang krisis patungo sa isang magandang bukas."
                        </p>
                        <h2 class="fw-bold">ANTHONY "TONY" A. ABA</h2>
                        <p class="fw-bold">PUNONG BARANGAY 2023</p>
                    </div>
                </div>
            </div>                
        </section>
    </div>
   
<?php
    include_once 'footer.php';
?> 
    
</body>
</html>