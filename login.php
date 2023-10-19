<?php
    include_once 'header.php';
?>

<div class="main">
    <section class="login-page">
        <div class="container col-xl-10 col-xxl-8 px-4 py-5">
            <div class="row align-items-center g-lg-5 py-5 justify-content-center">
                <div class="msg-form col-md-10 col-lg-5 border" style="border-radius: 1rem;">
                    <form class="py-5 px-3" action="includes/login.inc.php" method="POST">
                        <h2 class="text-center mb-5">Sign In</h2>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="user_email" required>
                            <label for="floatingInput">Email</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="floatingInput" placeholder="name@example.com" name="user_pword" required>
                            <label for="floatingInput">Password</label>
                        </div>
                      
                        <div class="d-flex justify-content-around align-items-center mb-5">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked required/>
                                <label class="form-check-label" for="form1Example3"> Remember me </label>
                            </div>
                            <a href="#">Forgot password?</a>
                        </div>

                        <button class="w-100 btn btn-lg btn-primary mb-5" type="submit">LOGIN</button>

                        <div class="text-center">
                            <span>Dont have an account? </span><a href="register.php">Register Account</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>




