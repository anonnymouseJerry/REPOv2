<!-- Add Folder Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Add Folder</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addFolderForm" action="../backend/repoAdd.php" method="POST">
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input class="form-control" type="text" name="title" placeholder="Enter folder title" required autocomplete="off" />
          </div>
          <div class="d-grid gap-2 mt-3">
            <button type="submit" class="btn btn-primary">Add Folder</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete Folder Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteUserModalLabel">Delete Folder</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this folder?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteUserForm" action="../backend/repoDelete.php" method="POST">
          <input type="hidden" name="repo_id" id="repo_id" value="" /> <!-- Use 'repo_id' for folder ID -->
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Function to set folder ID in the modal
  function setDeleteFolderId(folderId) {
    document.getElementById('repo_id').value = folderId; // Set repo_id in the hidden input
  }
</script>


<!-- Edit User Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Repository Title Edit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editUserForm" action="../backend/repoEdit.php" method="POST">
          <input type="hidden" name="repo_id" id="edit_user_id" value="" /> <!-- Hidden field for repo ID -->
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input class="form-control" type="text" name="title" id="edit_name" placeholder="Enter repository title" required autocomplete="off" />
          </div>
          <div class="d-grid gap-2 mt-3">
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Function to populate the edit modal with repository data
  function setEditUserData(repoId, title) {
    document.getElementById('edit_user_id').value = repoId;
    document.getElementById('edit_name').value = title;
  }
</script>

