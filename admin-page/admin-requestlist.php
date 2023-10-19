<?php
    include_once 'admin-header.php';
    include_once '../includes/connect.inc.php';
?>

<div class="main">
    <div class="container-fluid mb-5" style="background-color: #3f7652">     
        <h1 class="display-3 fw-bold p-3 text-center text-white">REQUEST LIST</h1>
    </div>

    <!-- <div class="container mb-4">
        <button type="button" class="btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#newRequestModal">Add Record</button>
    </div> -->
    
    <div class="container p-5 border rounded-3">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>View</th>
                    <th>ID</th>
                    <th>Request Date</th>
                    <th>Requestor</th>
                    <th>Request Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    try {
                            $sql = "SELECT 
                            request_list.request_id, 
                            request_list.request_date, 
                            request_list.approval_date, 
                            request_list.request_remarks, 
                            request_type.request_type_name, 
                            users.user_fname, 
                            users.user_lname, 
                            request_list.request_status, 
                            request_list.request_notes
                            FROM request_list 
                            JOIN request_type ON request_list.request_type_id=request_type.request_type_id
                            JOIN users ON request_list.user_id=users.user_id
                            WHERE request_list.request_status='0'";
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
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewRequest<?php echo $row['request_id'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
                            </svg>
                        </button>
                    </td>
                    <td><?php echo $row['request_id']?></td>
                    <td><?php echo $row['request_date']?></td>
                    <td><?php 
                        $requestor = $row['user_fname'] . " " . $row['user_lname'];

                        echo $requestor?>
                    </td>
                    <td><?php echo $row['request_type_name']?></td>
                    <td><?php 
                        $status;

                        if ($row['request_status']=='1') {
                            $status = "APPROVED";
                        } else if ($row['request_status']=='0') {
                            $status = "PENDING";
                        }  else {
                            $status = "DISAPPROVED";
                        }

                        echo $status?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success p-2" data-bs-toggle="modal" data-bs-target="#approveRequest<?php echo $row['request_id'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"></path>
                            </svg>
                        </button>
                        <button type="button" class="btn btn-danger p-2" data-bs-toggle="modal" data-bs-target="#disapproveRequest<?php echo $row['request_id'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                            </svg>
                        </button>
                    </td>
                </tr>

    <div class="modal fade" id="approveRequest<?php echo $row['request_id'] ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveRequestLabel">Approve Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../includes/actions.inc.php" method="post" class="was-validated" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="approverequest">
                        <input type="hidden" class="form-control" id="request_id" name="request_id" value="<?php echo $row['request_id']; ?>">
                        <div class="mb-3">
                            <label for="attachment" class="form-label">Attachment:</label>
                            <input class="form-control" type="file" name="request_attachment" required/>
                            <div class="invalid-feedback">Example invalid form file feedback</div>
                        </div>
                        <div class="mb-3">
                            <label for="request_notes" class="form-label">Notes:</label>
                            <textarea class="form-control" id="request_notes" name="request_notes" rows="8" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <div>
                                <button type="submit" name="submit" class="btn btn-success">Approve</button>
                            </div>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 

    <div class="modal fade" id="disapproveRequest<?php echo $row['request_id'] ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="disapproveRequestLabel">Disapprove Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../includes/actions.inc.php" method="post" class="was-validated">
                        <input type="hidden" name="action" value="disapproverequest">
                        <input type="hidden" class="form-control" id="request_id" name="request_id" value="<?php echo $row['request_id']; ?>">
                        <div class="mb-3">
                            <label for="request_notes" class="form-label">Notes:</label>
                            <textarea class="form-control" id="request_notes" name="request_notes" rows="8"></textarea>
                        </div>
                        <div class="modal-footer">
                            <div>
                                <button type="submit" name="submit" class="btn btn-danger">Disapprove</button>
                            </div>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 

    <div class="modal fade" id="viewRequest<?php echo $row['request_id'] ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewRequestLabel">View Request Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#">
                        <div class="row mb-3">
                            <div class="col-md-4 mb-3">
                                <label for="request_type_name" class="form-label">Request Date:</label>
                                <input type="text" class="form-control" id="request_type_name" name="request_type_name" value="<?php echo $row['request_date']; ?>" disabled>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="user_id" class="form-label">Requestor:</label>
                                <input type="text" class="form-control" id="user_id" name="user_id" value="<?php 
                                $requestor = $row['user_fname'] . " " . $row['user_lname'];

                                echo $requestor?>" disabled>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="request_type_name" class="form-label">Request Type:</label>
                                <input type="text" class="form-control" id="request_type_name" name="request_type_name" value="<?php echo $row['request_type_name']; ?>" disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="remarks" class="form-label">Requestor Remarks:</label>
                            <textarea disabled class="form-control" id="remarks" name="remarks" rows="5" value=""><?php echo $row['request_remarks']; ?></textarea>
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