<?php
    include_once 'user-header.php';
    include_once '../includes/connect.inc.php';
?>

<div class="container-fluid" style="background-color: #3f7652">     
    <h1 class="display-3 fw-bold p-4 text-center text-white mb-0">REQUEST A DOCUMENT</h1>
</div>

<section class="register-section">

    <div class="container border rounded p-4 mt-5 mb-5">
        <form class="row g-3 needs-validation" action="../includes/actions.inc.php" method="post" novalidate>
            <input type="hidden" name="action" value="requestdocument">
            <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <div class="col-md-4">
                <label for="request_type_id" class="form-label">Request Type</label>
                <select class="form-select" name="request_type_id" required>
                    <option selected value="">Select</option>
                    <?php
                        try {
                                $sql = "SELECT * FROM request_type WHERE active='1'";
                                $q = $conn->query($sql);
                                $q->setFetchMode(PDO::FETCH_ASSOC);
                                
                            } catch (PDOException $e) {
                                die("Could not connect to the database $dbname :" . $e->getMessage());
                            }

                            while ($row = $q->fetch()): 
                    ?>
                    <option value="<?php echo $row['request_type_id']; ?>"><?php echo $row['request_type_name']; ?></option>
                    <?php 
                        endwhile; 
                    ?> 
                </select>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please select request type!</div>
            </div>
            <div class="mb-3">
                <label for="request_remarks" class="form-label">Request Remarks:</label>
                <textarea class="form-control" id="request_remarks" name="request_remarks" rows="8" required></textarea>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter request remarks!</div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Proceed</button>
            </div>
        </form>
    </div>
    
</section>

<?php
    include_once "../scripts.php";
?>

