<?php
    include_once 'admin-header.php';
    include_once '../includes/connect.inc.php';
?>

<div class="main">
    <div class="container p-5">
        <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    try {
                            $sql = "SELECT * FROM users WHERE active='1'";
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
                        <td><?php echo $row['user_id']?></td>
                        <td><?php echo $row['user_fname']?></td>
                        <td><?php echo $row['user_lname']?></td>
                        <td><?php echo $row['user_email']?></td>
                        <td><?php 
                        $type;

                        if ($row['user_type']=='1') {
                            $type = "Admin";
                        } else {
                            $type = "User";
                        }  

                        echo $type?></td>
                        <td><?php 
                         $status;

                         if ($row['user_status']=='0') {
                            $status = "PENDING";
                         } else if ($row['user_status']=='1'){
                            $status = "ACTIVE";
                         }  else {
                            $status = "DISAPPROVED";
                         }

                        echo $status?>
                        
                        </td>
                        <td>
                            <button type="button" class="btn btn-success p-2" data-bs-toggle="modal" data-bs-target="#adminUpdateUser<?php echo $row['user_id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"></path>
                                </svg>
                            </button>
                            <a href="#" onclick="document.getElementById('deleteUser<?php echo $row['user_id']; ?>').submit();">
                                <button type="button" class="btn-danger rounded p-2" data-bs-toggle="modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
                                    </svg>
                                </button>
                            </a>
                            <form id="deleteUser<?php echo $row['user_id']; ?>" action="../includes/actions.inc.php" method="post">
                                <input type="hidden" name="action" value="deleteuser">
                                <input type="hidden" name="user_id" value="<?php echo $row["user_id"]; ?>">
                            </form>
                        </td>
                    </tr>

                    <!-- Edit user modal -->

                    <div class="modal fade" id="adminUpdateUser<?php echo $row['user_id'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateUserLabel">Update User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3" action="../includes/actions.inc.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="action" value="adminupdateuser">
                                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $row['user_id']; ?>">
                                        <div class="row mt-4 mb-3">
                                            <div class="col-md-4">
                                                <label for="user_fname" class="form-label">First name</label>
                                                <input type="text" class="form-control" id="user_fname" name="user_fname" value="<?php echo $row['user_fname']; ?>" required>
                                                <div class="valid-feedback">Looks good!</div>
                                                <div class="invalid-feedback">Please enter first name!</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="user_mname" class="form-label">Middle name</label>
                                                <input type="text" class="form-control" id="user_mname" name="user_mname" value="<?php echo $row['user_mname']; ?>" required>
                                                <div class="valid-feedback">Looks good!</div>
                                                <div class="invalid-feedback">Please enter middle name!</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="user_lname" class="form-label">Last name</label>
                                                <input type="text" class="form-control" id="user_lname" name="user_lname" value="<?php echo $row['user_lname']; ?>" required>
                                                <div class="valid-feedback">Looks good!</div>
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
                                                <div class="valid-feedback">Looks good!</div>
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
                                                <div class="valid-feedback">Looks good!</div>
                                                <div class="invalid-feedback">Please enter civil status!</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="user_date_of_birth" class="form-label">Date of Birth</label>
                                                <input type="date" class="form-control" id="user_date_of_birth" name="user_date_of_birth" value="<?php echo $row['user_date_of_birth']; ?>" required>
                                                <div class="valid-feedback">Looks good!</div>
                                                <div class="invalid-feedback">Please enter date of birth!</div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="user_address" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="user_address" name="user_address" value="<?php echo $row['user_address']; ?>" required>
                                                <div class="valid-feedback">Looks good!</div>
                                                <div class="invalid-feedback">Please enter address!</div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label for="user_contact_number" class="form-label">Contact Number</label>
                                                <input type="text" class="form-control" id="user_contact_number" name="user_contact_number" value="<?php echo $row['user_contact_number']; ?>" required>
                                                <div class="valid-feedback">Looks good!</div>
                                                <div class="invalid-feedback">Please enter contact number!</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="user_email" class="form-label">Email</label>
                                                <input type="text" class="form-control" id="user_email" name="user_email" value="<?php echo $row['user_email']; ?>" required>
                                                <div class="valid-feedback">Looks good!</div>
                                                <div class="invalid-feedback">Please enter email!</div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="user_pword" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="user_pword" name="user_pword" value="<?php echo $row['user_pword']; ?>" required>
                                                <div class="valid-feedback">Looks good!</div>
                                                <div class="invalid-feedback">Please enter password!</div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label for="user_status" class="form-label">User Account Status</label>
                                                <select class="form-select" name="user_status">
                                                    <option value="0" <?php if ($row['user_status'] == 0) echo 'selected'; ?>>PENDING</option>
                                                    <option value="1" <?php if ($row['user_status'] == 1) echo 'selected'; ?>>ACTIVATE</option>
                                                    <option value="2" <?php if ($row['user_status'] == 2) echo 'selected'; ?>>DISAPPROVE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mb-3">
                                            <div class="col-md-4 p-2 border text-center">
                                                <label for="user_valid_id" class="form-label">Valid ID Photo:</label><br>
                                                <img class="img-fluid" src="<?php echo '../assets/user_files/'.$row["user_valid_id"]; ?>" alt="..." style="width: 150px;">
                                            </div>
                                            <div class="col-md-4 p-2 border text-center">
                                                <label for="user_valid_id" class="form-label">Selfie with ID Photo:</label><br>
                                                <img class="img-fluid" src="<?php echo '../assets/user_files/'.$row["user_selfie_image"]; ?>" alt="..." style="width: 150px;">
                                            </div>
                                            <div class="col-md-4 p-2 border text-center">
                                                <label for="user_valid_id" class="form-label">Proof of Residency Photo:</label><br>
                                                <img class="img-fluid" src="<?php echo '../assets/user_files/'.$row["user_residency_file"]; ?>" alt="..." style="width: 150px;">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
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