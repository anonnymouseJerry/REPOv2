<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
function confirmLogout() {
    swal({
        title: "Are you sure?",
        text: "Do you really want to logout?",
        icon: "warning",
        buttons: ["Cancel", "Logout"],
        dangerMode: true,
    }).then((willLogout) => {
        if (willLogout) {
            // If user confirms, redirect to logout.php
            window.location.href = '../backend/logout.php'; // Update with your actual logout script URL
        }
    });
}
</script>


<script>
    // Optional: Auto open modal on page load
    $(document).ready(function() {
        $('#editProfileModal').modal('show');
    });
</script>