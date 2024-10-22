<!-- Add File Modal -->
<div class="modal fade" id="addFileModal" tabindex="-1" aria-labelledby="addFileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addFileModalLabel">Add File</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addFileForm" action="../backend/fileAdd.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="repo_id" value="<?php echo $_SESSION['repo_id']; ?>" />
          <div class="mb-3">
            <label class="form-label">File Name</label>
            <input class="form-control" type="text" name="file_name" placeholder="Enter file name" required autocomplete="off" />
          </div>
          <div class="mb-3">
            <label class="form-label">Upload File</label>
            <input class="form-control" type="file" name="file" required />
          </div>
          <div class="d-grid gap-2 mt-3">
            <button type="submit" class="btn btn-primary">Add File</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Delete File Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteUserModalLabel">Delete File</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this file?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteUserForm" action="../backend/fileDelete.php" method="POST">
          <input type="hidden" name="file_id" id="file_id" value="" /> <!-- Use 'file_id' for file ID -->
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Function to set file ID in the modal
  function setDeleteFolderId(fileId) {
    document.getElementById('file_id').value = fileId; // Set file_id in the hidden input
  }
</script>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit File Name</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../backend/fileUpdate.php" method="POST">
          <input type="hidden" name="file_id" id="file_id" value="" />
          <div class="mb-3">
            <label for="original_file_name" class="form-label">New File Name</label>
            <input type="text" class="form-control" name="original_file_name" id="original_file_name" required />
          </div>
          <button type="submit" class="btn btn-primary">Update File Name</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function setEditUserData(fileId, originalFileName) {
    console.log("File ID set for editing:", fileId); // Log the file ID
    document.getElementById('file_id').value = fileId; // Set file_id in the hidden input
    document.getElementById('original_file_name').value = originalFileName; // Set the original file name in the input
  }
</script>

