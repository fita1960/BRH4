<?php
    include_once 'header.php';
?>

<div class="main">
    <section class="message-us-section">
        <div class="container col-xl-10 col-xxl-8 px-4 py-5">
            <div class="row align-items-center g-lg-5 py-5">
                <div class="col-lg-7 text-center text-lg-start">
                    <h1 class="display-4 fw-bold lh-1 mb-3">Message Us</h1>
                    <p class="col-lg-10 fs-4">
                        Hi! Please send us your message and concers. We'll try to cater your messages as soon as we can.
                    </p>
                </div>
                <div class="msg-form col-md-10 col-lg-5 bg-white" style="border-radius: 1rem;">
                    <div class="div p-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="full_name" required>
                            <label for="floatingInput">Full Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="mobileno" required>
                            <label for="floatingInput">Phone Number</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email"required>
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="6" required></textarea>
                        </div>
                        <button type="button" class="btn btn-success" onclick="sendMail()">Send Message</button>
                        <!-- <button class="w-100 btn btn-lg btn-primary" type="submit" onclick="sendMail();">Send</button> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid" style="background-color: #3f7652">     
        <h1 class="display-3 fw-bold p-4 text-center text-white">OUR LOCATION</h1>
    </div>

    <section class="map">
        <div class="container mt-5 mb-5">
            <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 500px">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d921.8401487261274!2d124.2476563389!3d7.212912548353259!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32563bd35511f125%3A0x6b3a3ec4efb3f671!2sPhilippine%20Muslim%20Educators%20School!5e1!3m2!1sen!2sph!4v1684893694039!5m2!1sen!2sph" frameborder="0" style="border:0" allowfullscreen=""></iframe>
            </div>
        </div>
    </section>
</div>

<script src="js/email.js"></script>

<?php
    include_once 'footer.php';
?> 
