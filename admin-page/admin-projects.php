<?php
    include_once 'admin-header.php';
    include_once '../includes/connect.inc.php';
?>


<div class="main">
    <div class="container-fluid mb-5" style="background-color: #3f7652">     
        <h1 class="display-3 fw-bold p-3 text-center text-white">BARANGAY PROJECTS</h1>
    </div>

    <div class="container mb-4">
        <button type="button" class="btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#newProjectModal">Add Record</button>
    </div>
    
    <div class="container p-5 border rounded-3">
        <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Featured</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        try {
                                $sql = "SELECT * FROM projects WHERE active='1'";
                                $q = $conn->query($sql);
                                $q->setFetchMode(PDO::FETCH_ASSOC);
                                
                            } catch (PDOException $e) {
                                die("Could not connect to the database $dbname :" . $e->getMessage());
                            }

                            while ($row = $q->fetch()): 
                            $projectImageURL = '../assets/projects/'.$row["project_image"];
                    ?>
                    <tr>
                        <td><?php echo $row['project_id']?></td>
                        <td><img src="<?php echo '../assets/projects/'.$row["project_image"]; ?>" alt="..." style="width: 100px;"></td>
                        <td><?php echo $row['project_name']?></td>
                        <td><?php echo $row['project_description']?></td>
                        <td><?php 
                            $ft;

                            if ($row['featured']=='1') {
                                $ft = "YES";
                            } else {
                                $ft = "NO";
                            }  
                            echo $ft?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success p-2" data-bs-toggle="modal" data-bs-target="#editProject<?php echo $row['project_id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"></path>
                                </svg>
                            </button>
                            <a href="#" onclick="document.getElementById('deleteProject<?php echo $row['project_id']; ?>').submit();">
                                <button type="button" class="btn-danger rounded p-2" data-bs-toggle="modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
                                    </svg>
                                </button>
                            </a>
                            <form id="deleteProject<?php echo $row['project_id']; ?>" action="../includes/actions.inc.php" method="post">
                                <input type="hidden" name="action" value="deleteproject">
                                <input type="hidden" name="project_id" value="<?php echo $row["project_id"]; ?>">
                            </form>
                        </td>
                    </tr>
                 

    <div class="modal fade" id="newProjectModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newProjectModalLabel">New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../includes/actions.inc.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="addproject">
                        <div class="mb-3">
                            <label for="project_name" class="form-label">Project Name:</label>
                            <input type="text" class="form-control" name="project_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="project_description" class="form-label">Project Description:</label>
                            <textarea class="form-control" id="project_description" name="project_description" rows="8" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="project_image">Image:</label>
                            <input type="file" class="form-control" name="project_image" required/>
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

    <div class="modal fade" id="editProject<?php echo $row['project_id'] ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProjectLabel">Edit Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../includes/actions.inc.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="editproject">
                        <input type="hidden" class="form-control" id="project_id" name="project_id" value="<?php echo $row['project_id']; ?>">
                        <div class="mb-3">
                            <label for="project_name" class="form-label">Project Name:</label>
                            <input type="text" class="form-control" id="project_name" name="project_name" value="<?php echo $row['project_name']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="project_description" class="form-label">Project Description:</label>
                            <textarea class="form-control" id="project_description" name="project_description" rows="15" value=""><?php echo $row['project_description']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="project_image">Image:</label>
                            <input type="file" class="form-control" name="project_image" required/>
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