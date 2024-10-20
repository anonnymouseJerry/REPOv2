<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- Add 'modal-dialog-centered' class -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addUserForm" action="../backend/addUser.php" method="POST">
          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input class="form-control" type="text" name="name" placeholder="Enter full name" required autocomplete="off" />
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" type="email" name="email" placeholder="Enter email" required autocomplete="new-email" />
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Enter password" required autocomplete="new-password" />
          </div>
          <div class="mb-3">
            <label class="form-label">Office ID</label>
            <select class="form-select" name="office_id" required>
              <option value="" disabled selected>Select office</option>
              <?php
              $query = "SELECT * FROM offices";
              $result = $conn->query($query);
              while ($row = $result->fetch_assoc()) {
                  echo "<option value='" . htmlspecialchars($row['office_id']) . "'>"
                   . htmlspecialchars($row['officeName']) . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Access Type ID</label>
            <select class="form-select" name="accesstype_id" required>
              <option value="" disabled selected>Select access type</option>
              <?php
              $query = "SELECT * FROM accesstype";
              $result = $conn->query($query);
              while ($row = $result->fetch_assoc()) {
                  echo "<option value='" . htmlspecialchars($row['access_id']) . "'>"
                   . htmlspecialchars($row['type_name']) . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="d-grid gap-2 mt-3">
            <button type="submit" class="btn btn-primary">Add User</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this user?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteUserForm" action="../backend/deleteUser.php" method="POST">
          <input type="hidden" name="id" id="user_id" value="" /> <!-- Use 'id' for user ID -->
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Function to set user ID in the modal
  function setDeleteUserId(userId) {
    document.getElementById('user_id').value = userId;
  }
</script>

<!-- Edit User Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editUserForm" action="../backend/editUser.php" method="POST">
          <input type="hidden" name="id" id="edit_user_id" value="" /> <!-- Hidden field for user ID -->
          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input class="form-control" type="text" name="full_name" id="edit_name" placeholder="Enter full name" required autocomplete="off" />
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" type="email" name="email" id="edit_email" placeholder="Enter email" required autocomplete="new-email" />
          </div>
          <!-- <div class="mb-3">
            <label class="form-label">Password (Leave blank to keep current password)</label>
            <input class="form-control" type="password" name="password" placeholder="Enter new password" autocomplete="new-password" />
          </div> -->
          <div class="mb-3">
            <label class="form-label">Office ID</label>
            <select class="form-select" name="office_id" id="edit_office_id" required>
              <option value="" disabled>Select office</option>
              <?php
              // Fetch offices for the dropdown
              $query = "SELECT * FROM offices";
              $result = $conn->query($query);
              while ($row = $result->fetch_assoc()) {
                  echo "<option value='" . htmlspecialchars($row['office_id']) . "'>"
                   . htmlspecialchars($row['officeName']) . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Access Type ID</label>
            <select class="form-select" name="accesstype_id" id="edit_accesstype_id" required>
              <option value="" disabled>Select access type</option>
              <?php
              // Fetch access types for the dropdown
              $query = "SELECT * FROM accesstype";
              $result = $conn->query($query);
              while ($row = $result->fetch_assoc()) {
                  echo "<option value='" . htmlspecialchars($row['access_id']) . "'>"
                   . htmlspecialchars($row['type_name']) . "</option>";
              }
              ?>
            </select>
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
  // Function to populate the edit modal with user data
  function setEditUserData(userId, fullName, email, officeId, accessTypeId) {
    document.getElementById('edit_user_id').value = userId;
    document.getElementById('edit_name').value = fullName;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_office_id').value = officeId;
    document.getElementById('edit_accesstype_id').value = accessTypeId;
  }
</script>
