<?php
    include_once 'user-header.php';
    include_once '../includes/connect.inc.php';
    
    $user_id = $_SESSION["user_id"];

?>

<div class="container-fluid mb-5" style="background-color: #3f7652">     
    <h1 class="display-3 fw-bold p-3 text-center text-white">PERSONAL DETAILS</h1>
</div>

<div class="container mb-3">
    <button class="btn btn-primary" type="submit" data-bs-toggle="modal" data-bs-target="#editProfile">Edit Profile</button>
</div>

<div class="container border rounded p-4 mt-4 mb-5">
    <form class="row g-3 needs-validation" novalidate>
            
        <?php
        
            try {
                $sql = "SELECT * FROM users WHERE user_id=$user_id";
                $q = $conn->query($sql);
                $q->setFetchMode(PDO::FETCH_ASSOC);
                
            } catch (PDOException $e) {
                die("Could not connect to the database $dbname :" . $e->getMessage());
            }
            
            $row = $q->fetch();

        ?>
        <div class="col-md-4">
            <label for="user_fname" class="form-label">First name</label>
            <input type="text" class="form-control" id="user_fname" name="user_fname" value="<?php echo $row['user_fname']; ?>" disabled>
            <div class="valid-feedback">Looks good!</div>
            <div class="invalid-feedback">Please enter first name!</div>
        </div>
        <div class="col-md-4">
            <label for="user_mname" class="form-label">Middle name</label>
            <input type="text" class="form-control" id="user_mname" name="user_mname" value="<?php echo $row['user_mname']; ?>" disabled>
            <div class="valid-feedback">Looks good!</div>
            <div class="invalid-feedback">Please enter middle name!</div>
        </div>
        <div class="col-md-4">
            <label for="user_lname" class="form-label">Last name</label>
            <input type="text" class="form-control" id="user_lname" name="user_lname" value="<?php echo $row['user_lname']; ?>" disabled>
            <div class="valid-feedback">Looks good!</div>
            <div class="invalid-feedback">Please enter last name!</div>
        </div>
        <div class="col-md-4">
            <label for="user_gender" class="form-label">Gender</label>
            <select class="form-select" name="user_gender" disabled>
                <option value="Male" <?php if ($row['user_gender'] == "Male") echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($row['user_gender'] == "Female") echo 'selected'; ?>>Female</option>
                <option value="LGBTQ+" <?php if ($row['user_gender'] == "LGBTQ+") echo 'selected'; ?>>LGBTQ+</option>
            </select>
            <div class="valid-feedback">Looks good!</div>
            <div class="invalid-feedback">Please enter gender!</div>
        </div>
        <div class="col-md-4">
            <label for="user_civil_status" class="form-label">Civil Status</label>
            <select class="form-select" name="user_civil_status" disabled>
                <option value="Single" <?php if ($row['user_civil_status'] == "Single") echo 'selected'; ?>>Single</option>
                <option value="Married" <?php if ($row['user_civil_status'] == "Married") echo 'selected'; ?>>Married</option>
                <option value="Living in" <?php if ($row['user_civil_status'] == "Living in") echo 'selected'; ?>>Living in</option>
                <option value="Widow" <?php if ($row['user_civil_status'] == "Widow") echo 'selected'; ?>>Widow</option>
                <option value="Legally Separated" <?php if ($row['user_civil_status'] == "Legally Separated") echo 'selected'; ?>>Legally Separated</option>
                <option value="Separated" <?php if ($row['user_civil_status'] == "Separated") echo 'selected'; ?>>Separated</option>
                <option value="Divorced" <?php if ($row['user_civil_status'] == "Divorced") echo 'selected'; ?>>Divorced</option>
            </select>
            <div class="valid-feedback">Looks good!</div>
            <div class="invalid-feedback">Please enter civil status!</div>
        </div>
        <div class="col-md-4">
            <label for="user_date_of_birth" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="user_date_of_birth" name="user_date_of_birth" value="<?php echo $row['user_date_of_birth']; ?>" disabled>
            <div class="valid-feedback">Looks good!</div>
            <div class="invalid-feedback">Please enter date of birth!</div>
        </div>
        <div class="col-md-12">
            <label for="user_date_of_birth" class="form-label">Address</label>
            <input type="text" class="form-control" id="user_date_of_birth" name="user_date_of_birth" value="<?php echo $row['user_address']; ?>" disabled>
            <div class="valid-feedback">Looks good!</div>
            <div class="invalid-feedback">Please enter address!</div>
        </div>
        <div class="col-md-4">
            <label for="validationCustom03" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="validationCustom03" value="<?php echo $row['user_contact_number']; ?>" disabled>
            <div class="valid-feedback">Looks good!</div>
            <div class="invalid-feedback">Please enter contact number!</div>
        </div>
        <div class="col-md-4">
            <label for="validationCustom03" class="form-label">Email</label>
            <input type="text" class="form-control" id="validationCustom03" value="<?php echo $row['user_email']; ?>" disabled>
            <div class="valid-feedback">Looks good!</div>
            <div class="invalid-feedback">Please enter email!</div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationCustom03" class="form-label">Password</label>
            <input type="password" class="form-control" id="validationCustom03" value="<?php echo $row['user_pword']; ?>" disabled>
            <div class="valid-feedback">Looks good!</div>
            <div class="invalid-feedback">Please enter password!</div>
        </div>
    </form>
</div>



<!-- Edit Profile Modal -->

<div class="modal fade" id="editProfile" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../includes/actions.inc.php" method="post" class="was-validated">
                    <input type="hidden" name="action" value="userupdateprofile">
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $row['user_id']; ?>">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="user_fname" class="form-label">First name</label>
                            <input type="text" class="form-control" id="user_fname" name="user_fname" value="<?php echo $row['user_fname']; ?>" required>
                            <div class="invalid-feedback">Please enter first name!</div>
                        </div>
                        <div class="col-md-4">
                            <label for="user_mname" class="form-label">Middle name</label>
                            <input type="text" class="form-control" id="user_mname" name="user_mname" value="<?php echo $row['user_mname']; ?>" required>
                            <div class="invalid-feedback">Please enter middle name!</div>
                        </div>
                        <div class="col-md-4">
                            <label for="user_lname" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="user_lname" name="user_lname" value="<?php echo $row['user_lname']; ?>" required>
                            <div class="invalid-feedback">Please enter last name!</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="user_gender" class="form-label">Gender</label>
                            <select class="form-select" name="user_gender" required>
                                <option value="Male" <?php if ($row['user_gender'] == "Male") echo 'selected'; ?>>Male</option>
                                <option value="Female" <?php if ($row['user_gender'] == "Female") echo 'selected'; ?>>Female</option>
                                <option value="LGBTQ+" <?php if ($row['user_gender'] == "LGBTQ+") echo 'selected'; ?>>LGBTQ+</option>
                            </select>
                            <div class="invalid-feedback">Please enter gender!</div>
                        </div>
                        <div class="col-md-4">
                            <label for="user_civil_status" class="form-label">Civil Status</label>
                            <select class="form-select" name="user_civil_status" required>
                                <option value="Single" <?php if ($row['user_civil_status'] == "Single") echo 'selected'; ?>>Single</option>
                                <option value="Married" <?php if ($row['user_civil_status'] == "Married") echo 'selected'; ?>>Married</option>
                                <option value="Living in" <?php if ($row['user_civil_status'] == "Living in") echo 'selected'; ?>>Living in</option>
                                <option value="Widow" <?php if ($row['user_civil_status'] == "Widow") echo 'selected'; ?>>Widow</option>
                                <option value="Legally Separated" <?php if ($row['user_civil_status'] == "Legally Separated") echo 'selected'; ?>>Legally Separated</option>
                                <option value="Separated" <?php if ($row['user_civil_status'] == "Separated") echo 'selected'; ?>>Separated</option>
                                <option value="Divorced" <?php if ($row['user_civil_status'] == "Divorced") echo 'selected'; ?>>Divorced</option>
                            </select>
                            <div class="invalid-feedback">Please enter civil status!</div>
                        </div>
                        <div class="col-md-4">
                            <label for="user_date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="user_date_of_birth" name="user_date_of_birth" value="<?php echo $row['user_date_of_birth']; ?>" required>
                            <div class="invalid-feedback">Please enter date of birth!</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="user_address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="user_address" name="user_address" value="<?php echo $row['user_address']; ?>" required>
                            <div class="invalid-feedback">Please enter address!</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="user_contact_number" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="user_contact_number" name="user_contact_number" value="<?php echo $row['user_contact_number']; ?>" required>
                            <div class="invalid-feedback">Please enter contact number!</div>
                        </div>
                        <div class="col-md-4">
                            <label for="user_email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="user_email" name="user_email" value="<?php echo $row['user_email']; ?>" required>
                            <div class="invalid-feedback">Please enter email!</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="user_pword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="user_pword" name="user_pword" value="<?php echo $row['user_pword']; ?>" required>
                            <div class="invalid-feedback">Please enter password!</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

<!-- Request History -->

<div class="main">
    <div class="container-fluid mb-5" style="background-color: #3f7652">     
        <h1 class="display-3 fw-bold p-3 text-center text-white">REQUEST LIST</h1>
    </div>

    <div class="container p-5 border rounded-3">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Request Date</th>
                    <th>Request Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    try {
                            $sql = "SELECT request_list.request_id, request_list.request_attachment, request_list.request_date, request_list.approval_date, request_list.request_remarks, 
                            request_type.request_type_name, request_list.request_status, request_list.request_notes
                            FROM request_list 
                            JOIN request_type ON request_list.request_type_id=request_type.request_type_id
                            WHERE request_list.user_id=$user_id";
                            $q = $conn->query($sql);
                            $q->setFetchMode(PDO::FETCH_ASSOC);
                            
                        } catch (PDOException $e) {
                            die("Could not connect to the database $dbname :" . $e->getMessage());
                        }
                ?>
                <?php while ($row = $q->fetch()): 
                    // $officialImageURL = 'assets/officials/'.$row["official_image"];
                ?>
                <tr>
                    <td><?php echo $row['request_id']?></td>
                    <td><?php echo $row['request_date']?></td>
                    <td><?php echo $row['request_type_name']?></td>
                    <td><?php 
                        $status;

                        if ($row['request_status']=='0') {
                            $status = "PENDING";
                        } else if ($row['request_status']=='1') {
                            $status = "APPROVED";
                        } else if ($row['request_status']=='2') {
                            $status = "DISAPPROVED";
                        } else {
                            $status = "CANCELLED";
                        }

                        echo $status?>
                    </td>
                    <td>
                        <?php
                            if ($row['request_status']!='1') {
                                ?>
                                <button type="button" class="btn btn-primary p-2" data-bs-toggle="modal" data-bs-target="#viewRequest<?php echo $row['request_id'] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
                                    </svg>
                                </button>
                        <?php  
                            } else { ?>
                                <button type="button" class="btn btn-primary p-2" title="View Details" data-bs-toggle="modal" data-bs-target="#viewRequest<?php echo $row['request_id'] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
                                    </svg>
                                </button>
                                <a href="#" onclick="document.getElementById('downloadAttachment<?php echo $row['request_id']; ?>').submit();">
                                <button type="button" class="btn-success rounded p-2" title="Download Attachment" data-bs-toggle="modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"></path>
                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"></path>
                                    </svg>
                                </button>
                                </a>
                                <form id="downloadAttachment<?php echo $row['request_id']; ?>" action="../includes/actions.inc.php" method="POST">
                                    <input type="hidden" name="action" value="downloadattachment">
                                    <input type="hidden" name="request_id" value="<?php echo $row["request_id"]; ?>">
                                    <input type="hidden" name="request_attachment" value="<?php echo $row["request_attachment"]; ?>">
                                </form>
                        <?php    
                            }
                        ?>
                       
                    </td>
                </tr>

    <div class="modal fade" id="viewRequest<?php echo $row['request_id'] ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRequestLabel">My Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../includes/actions.inc.php" method="post" class="was-validated">
                        <input type="hidden" name="action" value="editrequest">
                        <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
                        <div class="mb-3">
                            <label for="request_type_name" class="form-label">Request Date:</label>
                            <input type="text" class="form-control" id="request_type_name" name="request_type_name" value="<?php echo $row['request_date']; ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="request_type_name" class="form-label">Request Type:</label>
                            <input type="text" class="form-control" id="request_type_name" name="request_type_name" value="<?php echo $row['request_type_name']; ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="remarks" class="form-label">Requestor Remarks:</label>
                            <textarea disabled class="form-control" id="remarks" name="remarks" rows="5" value=""><?php echo $row['request_remarks']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="request_status">Status:</label>
                            <select class="form-select" name="request_status" disabled>
                                <option value="0" <?php if ($row['request_status'] == 0) echo 'selected'; ?>>PENDING</option>
                                <option value="1" <?php if ($row['request_status'] == 1) echo 'selected'; ?>>APPROVED</option>
                                <option value="2" <?php if ($row['request_status'] == 2) echo 'selected'; ?>>DISAPPROVED</option>
                                <option value="3" <?php if ($row['request_status'] == 3) echo 'selected'; ?>>CANCELLED</option>
                            </select>
                        </div>
                        <?php
                            if ($row['request_status'] == "1") {
                                echo '<div class="mb-3">
                                        <label for="approval_date" class="form-label">Approval/Disapproval Date:</label>
                                        <input type="text" class="form-control" id="approval_date" name="approval_date" value="' . $row['approval_date'] . '" disabled>
                                      </div>';

                                echo '<div class="mb-3">
                                    <label for="request_notes" class="form-label">Notes:</label>
                                    <input type="text" class="form-control" id="request_notes" name="request_notes" value="' . $row['request_notes'] . '" disabled>
                                </div>';

                            } else if ($row['request_status'] == "2") {
                                echo '<div class="mb-3">
                                        <label for="approval_date" class="form-label">Approval/Disapproval Date:</label>
                                        <input type="text" class="form-control" id="approval_date" name="approval_date" value="' . $row['approval_date'] . '" disabled>
                                      </div>';

                                echo '<div class="mb-3">
                                        <label for="request_notes" class="form-label">Notes:</label>
                                        <input type="text" class="form-control" id="request_notes" name="request_notes" value="' . $row['request_notes'] . '" disabled>
                                      </div>';
                                      
                            } else {
                               
                            }
                        ?>
                        <?php
                            if ($row['request_status'] == "0") {
                                echo '<div class="modal-footer">
                                        <button type="submit" name="submit" class="btn btn-danger">Cancel Request</button>
                                      </div>
                                      <form id="cancelRequest"' . $row['request_id'] . '" action="../includes/actions.inc.php" method="post">
                                        <input type="hidden" name="action" value="cancelrequest">
                                        <input type="hidden" name="request_id" value="' . $row["request_id"] . '">
                                      </form>';
                                      
                            } else {
                                
                            }
                        ?>
                    </form> 
                </div>
            </div>
        </div>
    </div> 

        <?php 
                    endwhile; 
                ?> 
            </tbody>
        </table>
    </div>

</div>

<?php
    include_once "../scripts.php";
?>