<?php
    include_once 'header.php';
?>

<section class="register-section">

    <div class="container-fluid" style="background-color: #3f7652">     
        <h1 class="display-3 fw-bold p-4 text-center text-white">REGISTRATION FORM</h1>
    </div>

    <div class="container border rounded p-4 mt-5 mb-5">
        <form class="row g-3 needs-validation" action="includes/actions.inc.php" method="post" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="action" value="registeraccount">
            <div class="col-md-4">
                <label for="user_fname" class="form-label">First name</label>
                <input type="text" class="form-control" id="user_fname" name="user_fname" required>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter first name!</div>
            </div>
            <div class="col-md-4">
                <label for="user_mname" class="form-label">Middle name</label>
                <input type="text" class="form-control" id="user_mname" name="user_mname" required>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter middle name!</div>
            </div>
            <div class="col-md-4">
                <label for="user_lname" class="form-label">Last name</label>
                <input type="text" class="form-control" id="user_lname" name="user_lname" required>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter last name!</div>
            </div>
            <div class="col-md-4">
                <label for="user_gender" class="form-label">Gender</label>
                <select class="form-select" name="user_gender" required>
                    <option selected value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="LGBTQ+">LGBTQ+</option>
                </select>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter gender!</div>
            </div>
            <div class="col-md-4">
                <label for="user_civil_status" class="form-label">Civil Status</label>
                <select class="form-select" name="user_civil_status" required>
                    <option selected value="">Select Civil Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Living in">Living in</option>
                    <option value="Widow">Widow</option>
                    <option value="Legally Separated">Legally Separated</option>
                    <option value="Separated">Separated</option>
                    <option value="Divorced">Divorced</option>
                </select>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter civil status!</div>
            </div>
            <div class="col-md-4">
                <label for="user_date_of_birth" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="user_date_of_birth" name="user_date_of_birth" required>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter date of birth!</div>
            </div>
            <div class="col-md-12">
                <label for="user_address" class="form-label">Address</label>
                <input type="text" class="form-control" id="user_address" name="user_address" required>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter address!</div>
            </div>
            <div class="col-md-4">
                <label for="user_contact_number" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="user_contact_number" name="user_contact_number" required>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter contact number!</div>
            </div>
            <div class="col-md-4">
                <label for="user_email" class="form-label">Email</label>
                <input type="text" class="form-control" id="user_email" name="user_email" required>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter email!</div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="user_pword" class="form-label">Password</label>
                <input type="password" class="form-control" id="user_pword" name="user_pword" required>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter password!</div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="official_image">Photo of 1 valid ID<span class="fst-italic"> Please upload 1 valid id for confimation</span></label>
                <input type="file" class="form-control" name="user_valid_id" required/>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please upload file!</div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="official_image">Selfie with valid ID<span class="fst-italic"> Please upload 1 valid id for confimation</span></label>
                <input type="file" class="form-control" name="user_selfie_image" required/>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please upload file!</div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="official_image">Proof of Residency<span class="fst-italic"> Please upload 1 proof of residency with current address details (electric bill, water bill, etc.)</span></label>
                <input type="file" class="form-control" name="user_residency_file" required/>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please upload file!</div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
    
</section>

<?php
    include_once "scripts.php";
?>

