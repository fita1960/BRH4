<?php
    include_once 'admin-header.php';
    include_once '../includes/connect.inc.php';
?>


<div class="main">
    <div class="container-fluid mb-5" style="background-color: #3f7652">     
        <h1 class="display-3 fw-bold p-3 text-center text-white">BARANGAY ACCOMPLISHMENTS</h1>
    </div>

    <div class="container mb-4">
        <button type="button" class="btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#newAccomplishmentModal">Add Record</button>
    </div>
    
    <div class="container p-5 border rounded-3">
        <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Accomplishment</th>
                        <th>Description</th>
                        <th>Featured</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        try {
                                $sql = "SELECT * FROM accomplishments WHERE active='1'";
                                $q = $conn->query($sql);
                                $q->setFetchMode(PDO::FETCH_ASSOC);
                                
                            } catch (PDOException $e) {
                                die("Could not connect to the database $dbname :" . $e->getMessage());
                            }

                            while ($row = $q->fetch()): 
                            $accomplishmentImageURL = 'assets/accomplishments/'.$row["accomplishment_image"];
                    ?>
                    <tr>
                        <td><?php echo $row['accomplishment_id']?></td>
                        <td><img src="<?php echo '../assets/accomplishments/'.$row["accomplishment_image"]; ?>" alt="..." style="width: 100px;"></td>
                        <td><?php echo $row['accomplishment_name']?></td>
                        <td><?php echo $row['accomplishment_description']?></td>
                        <td><?php 
                            $ft;

                            if ($row['featured']=='1') {
                                $ft = "YES";
                            } else {
                                $ft = "NO";
                            }  
                            
                            echo $ft?></td>
                        <td>
                            <button type="button" class="btn-success rounded p-1" data-bs-toggle="modal" data-bs-target="#editAccomplishment<?php echo $row['accomplishment_id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"></path>
                                </svg>
                            </button>
                            <a href="#" onclick="document.getElementById('deleteAccomplishment<?php echo $row['accomplishment_id']; ?>').submit();">
                                <button type="button" class="btn-danger rounded p-2" data-bs-toggle="modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
                                    </svg>
                                </button>
                            </a>
                            <form id="deleteAccomplishment<?php echo $row['accomplishment_id']; ?>" action="../includes/actions.inc.php" method="post">
                                <input type="hidden" name="action" value="deleteaccomplishment">
                                <input type="hidden" name="accomplishment_id" value="<?php echo $row["accomplishment_id"]; ?>">
                            </form>
                        </td>
                    </tr>

    <div class="modal fade" id="newAccomplishmentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Accomplishment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../includes/actions.inc.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="addaccomplishment">
                        <div class="mb-3">
                            <label for="accomplishment_name" class="form-label">Accomplishment Name:</label>
                            <input type="text" class="form-control" name="accomplishment_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="accomplishment_description" class="form-label">Accomplishment Description:</label>
                            <textarea required class="form-control" id="accomplishment_description" name="accomplishment_description" rows="8"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="accomplishment_image">Image:</label>
                            <input type="file" class="form-control" name="accomplishment_image" required/>
                        </div>
                        <div class="mb-5">
                            <label class="form-label" for="featured">Featured: <i>*will be displayed on home</i></label>
                            <select class="form-select" name="featured" required>
                                <option selected value="">Select</option>
                                <option value="1">YES</option>
                                <option value="0">NO</option>
                            </select>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAccomplishment<?php echo $row['accomplishment_id'] ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editActivityLabel">Edit Accomplishment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../includes/actions.inc.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="editaccomplishment">
                        <input type="hidden" class="form-control" id="accomplishment_id" name="accomplishment_id" value="<?php echo $row['accomplishment_id']; ?>">
                        <div class="mb-3">
                            <label for="accomplishment_name" class="form-label">Accomplishment Name:</label>
                            <input type="text" class="form-control" id="accomplishment_name" name="accomplishment_name" value="<?php echo $row['accomplishment_name']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="accomplishment_description" class="form-label">Accomplishment Description:</label>
                            <textarea class="form-control" id="accomplishment_description" name="accomplishment_description" rows="15" value=""><?php echo $row['accomplishment_description']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="accomplishment_image">Image:</label>
                            <input type="file" class="form-control" name="accomplishment_image" required/>
                        </div>
                        <div class="mb-3">
                        <label class="form-label" for="featured">Featured: <i>*will be displayed on home</i></label>
                            <select class="form-select" name="featured">
                                <option value="1" <?php if ($row['featured'] == 1) echo 'selected'; ?>>YES</option>
                                <option value="0" <?php if ($row['featured'] == 0) echo 'selected'; ?>>NO</option>
                            </select>
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