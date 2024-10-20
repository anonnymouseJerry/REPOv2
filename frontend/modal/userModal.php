<?php
// Fetch user details from the database using session ID
$stmt = $conn->prepare("SELECT full_name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
?>
<style>
.modal-dialog {
    max-height: 80%; /* Adjust height as needed */
    margin: auto;
}

.modal-content {
    max-height: 100%;
    overflow-y: auto; /* Enables scrolling */
}
</style>

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userModalLabel">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="profileForm">
        <div class="modal-body">
          <div class="form-group">
          <div id="uploadMessage" class="mt-2"></div>
            <label for="profile_picture">Profile Picture</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
          </div>
          <button type="button" class="btn btn-secondary" id="uploadPictureBtn">Upload Picture</button>
          <br><br>
          <label>Profile Information</label>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
          </div>
          <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
          </div>
          <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm new password">
          </div>
          <div id="message" class="mt-2"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
let originalName = "<?php echo htmlspecialchars($user['full_name']); ?>";
let originalEmail = "<?php echo htmlspecialchars($user['email']); ?>";
let originalPassword = "";

document.getElementById('profileForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Check if there are any changes
    if (name === originalName && email === originalEmail && !password) {
        // alert('No changes made.');
        return; // Prevent submission if no changes
    }

    const formData = new FormData(this);
    
    fetch('../backend/update_profile.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const messageDiv = document.getElementById('message');
        if (data.status === 'success') {
            messageDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            messageDiv.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

</script>

<script>
document.getElementById('uploadPictureBtn').addEventListener('click', function() {
    const formData = new FormData();
    const profilePictureInput = document.getElementById('profile_picture');
    
    if (profilePictureInput.files.length === 0) {
        document.getElementById('uploadMessage').innerHTML = '<div class="alert alert-warning">Please select an image to upload.</div>';
        return;
    }
    
    formData.append('profile_picture', profilePictureInput.files[0]);
    
    fetch('../backend/update_profile.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const uploadMessageDiv = document.getElementById('uploadMessage');
        if (data.status === 'success') {
            uploadMessageDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
            setTimeout(() => {
                location.reload(); // Optionally refresh to show new profile picture
            }, 1500);
        } else {
            uploadMessageDiv.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>
