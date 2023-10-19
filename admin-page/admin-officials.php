<?php
    include_once 'admin-header.php';
    include_once '../includes/connect.inc.php';
?>


<div class="main">
    <div class="container-fluid mb-5" style="background-color: #3f7652">     
        <h1 class="display-3 fw-bold p-3 text-center text-white">BARANGAY OFFICIALS</h1>
    </div>

    <div class="container mb-4">
        <button type="button" class="btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#newOfficialModal">Add Record</button>
    </div>
    
    <div class="container p-5 border rounded-3">
        <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        try {
                                $sql = "SELECT officials.official_id, officials.official_name, officials.official_position, officials.official_image, official_type.official_type_description 
                                FROM officials 
                                INNER JOIN official_type 
                                ON officials.official_position=official_type.official_type_id 
                                WHERE officials.active='1'";

                                $q = $conn->query($sql);
                                $q->setFetchMode(PDO::FETCH_ASSOC);
                                
                            } catch (PDOException $e) {
                                die("Could not connect to the database $dbname :" . $e->getMessage());
                            }

                            while ($row = $q->fetch()): 
                            $officialImageURL = '../assets/officials/'.$row["official_image"];
                    ?>
                    <tr>
                        <td><?php echo $row['official_id']?></td>
                        <td><img src="<?php echo '../assets/officials/'.$row["official_image"]; ?>" alt="..." style="width: 50px;"></td>
                        <td><?php echo $row['official_name']?></td>
                        <td><?php echo $row['official_type_description']?></td>
                        <td>
                            <button type="button" class="btn btn-success p-2" data-bs-toggle="modal" data-bs-target="#editOfficial<?php echo $row['official_id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"></path>
                                </svg>
                            </button>
                            <a href="#" onclick="document.getElementById('deleteOfficial<?php echo $row['official_id']; ?>').submit();">
                                <button type="button" class="btn-danger rounded p-2" data-bs-toggle="modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
                                    </svg>
                                </button>
                            </a>
                            <form id="deleteOfficial<?php echo $row['official_id']; ?>" action="../includes/actions.inc.php" method="POST">
                                <input type="hidden" name="action" value="deleteofficial">
                                <input type="hidden" name="official_id" value="<?php echo $row["official_id"]; ?>">
                            </form>
                        </td>
                    </tr>
                    
    <div class="modal fade" id="newOfficialModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newOfficialModalLabel">New Official</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="../includes/actions.inc.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="addofficial">
                        <div class="mb-3">
                            <label for="official_name" class="form-label">Name:</label>
                            <input type="text" class="form-control" name="official_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="official_position">Position:</label>
                            <select class="form-select" name="official_position" required>
                                <option selected value="">Select Item</option>
                                <option value="1">BARANGAY CHAIRPERSON (CAPTAIN)</option>
                                <option value="2">KAGAWAD (COUNCILOR)</option>
                                <option value="3">SK CHAIRPERSON</option>
                                <option value="4">BARANGAY SECRETARY</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="official_image">Image:</label>
                            <input type="file" class="form-control" name="official_image" required/>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editOfficial<?php echo $row['official_id'] ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editOfficialLabel">Edit Official</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../includes/actions.inc.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="editofficial">
                            <input type="hidden" class="form-control" id="official_id" name="official_id" value="<?php echo $row['official_id']; ?>">
                            <div class="mb-3">
                                <label for="official_name" class="form-label">Official Name:</label>
                                <input type="text" class="form-control" id="official_name" name="official_name" value="<?php echo $row['official_name']; ?>">
                            </div>
                            <div class="mb-3">
                            <label class="form-label" for="official_position">Position:</label>
                                <select class="form-select" name="official_position">
                                    <option value="1" <?php if ($row['official_position'] == 1) echo 'selected'; ?>>BARANGAY CHAIRPERSON (CAPTAIN)</option>
                                    <option value="2" <?php if ($row['official_position'] == 2) echo 'selected'; ?>>KAGAWAD (COUNCILOR)</option>
                                    <option value="3" <?php if ($row['official_position'] == 3) echo 'selected'; ?>>SK CHAIRPERSON</option>
                                    <option value="4" <?php if ($row['official_position'] == 4) echo 'selected'; ?>>BARANGAY SECRETARY</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="official_image">Image:</label>
                                <input type="file" class="form-control" name="official_image" required/>
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