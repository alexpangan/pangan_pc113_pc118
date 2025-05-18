<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Profile</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #6dd5fa, #2980b9);
      min-height: 100vh;
      display: flex;
    }
    .sidebar {
      width: 250px;
      min-height: 100vh;
      padding: 1rem;
      color: white;
    }
    .main-container {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      min-height: 100vh;
    }
    .profile-container {
      max-width: 800px;
      width: 100%;
      background: #fff;
      margin: 32px 0;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      overflow: hidden;
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .profile-header {
      background-color: #3f51b5;
      color: #fff;
      padding: 16px 24px;
      font-size: 20px;
      font-weight: bold;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .profile-section {
      padding: 24px;
    }
    .section-title {
      font-size: 18px;
      margin-bottom: 16px;
      font-weight: 600;
    }
    .info-group {
      display: flex;
      flex-wrap: wrap;
      margin-bottom: 16px;
    }
    .info-item {
      flex: 1 1 45%;
      margin: 8px 0;
    }
    .info-label {
      font-size: 14px;
      color: #666;
    }
    .info-value {
      font-size: 16px;
      font-weight: 500;
    }
    .divider {
      border-top: 1px solid #ccc;
      margin: 20px 0;
    }
    @media (max-width: 900px) {
      .profile-container {
        margin: 24px 0;
        max-width: 100%;
      }
      .profile-section {
        padding: 18px;
      }
      .sidebar {
        display: none;
      }
    }
    @media (max-width: 600px) {
      .info-group {
        flex-direction: column;
        gap: 0;
      }
      .info-item {
        min-width: 0;
      }
      .profile-header {
        padding: 14px 10px;
        font-size: 18px;
      }
      .profile-section {
        padding: 10px;
      }
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <?php include '../include/sidebar.php'; ?>
  </div>
  <div class="main-container">
    <?php include '../include/maincontent.php'; ?>
    <div class="profile-container">
      <div class="profile-header">
        Profile
        <button class="btn btn-warning btn-sm" id="editBtn">Edit Information</button>
      </div>
      <div class="profile-section">
        <div class="section-title">Personal Information</div>
        <div class="info-group">
          <div class="info-item">
            <div class="info-label">Student's ID</div>
            <div class="info-value" id="studentId"></div>
          </div>
          <div class="info-item">
            <div class="info-label">Name</div>
            <div class="info-value" id="name"></div>
          </div>
          <div class="info-item">
            <div class="info-label">Email</div>
            <div class="info-value" id="email"></div>
          </div>
          <div class="info-item">
            <div class="info-label">Contact</div>
            <div class="info-value" id="contact"></div>
          </div>
          <div class="info-item">
            <div class="info-label">Birth Date</div>
            <div class="info-value" id="birthdate"></div>
          </div>
          <div class="info-item" style="flex: 1 1 100%;">
            <div class="info-label">Address</div>
            <div class="info-value" id="address"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="editForm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Information</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-2">
              <label class="form-label">Student's ID</label>
              <input type="text" class="form-control" id="editStudentId" required>
            </div>
            <div class="mb-2">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" id="editName" required>
            </div>
            <div class="mb-2">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" id="editEmail" required>
            </div>
            <div class="mb-2">
              <label class="form-label">Contact</label>
              <input type="text" class="form-control" id="editContact" required>
            </div>
            <div class="mb-2">
              <label class="form-label">Birth Date</label>
              <input type="date" class="form-control" id="editBirthdate" required>
            </div>
            <div class="mb-2">
              <label class="form-label">Address</label>
              <input type="text" class="form-control" id="editAddress" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Dummy data for demonstration. Replace with AJAX fetch if needed.
    let userData = {
      student_id: "22-003248",
      name: "Alex Luzares Pangan",
      email: "alexpangan1234@gmail.com",
      contact: "09300828082",
      birthdate: "2004-01-27",
      address: "Kabaw Tagnate Hilongos Leyte, 6524"
    };

    function renderProfile() {
      document.getElementById('studentId').textContent = userData.student_id;
      document.getElementById('name').textContent = userData.name;
      document.getElementById('email').textContent = userData.email;
      document.getElementById('contact').textContent = userData.contact;
      document.getElementById('birthdate').textContent = userData.birthdate;
      document.getElementById('address').textContent = userData.address;
    }

    document.addEventListener('DOMContentLoaded', function () {
      renderProfile();

      document.getElementById('editBtn').addEventListener('click', function() {
        // Populate modal fields
        document.getElementById('editStudentId').value = userData.student_id;
        document.getElementById('editName').value = userData.name;
        document.getElementById('editEmail').value = userData.email;
        document.getElementById('editContact').value = userData.contact;
        document.getElementById('editBirthdate').value = userData.birthdate;
        document.getElementById('editAddress').value = userData.address;
        new bootstrap.Modal(document.getElementById('editModal')).show();
      });

      document.getElementById('editForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Update userData with new values
        userData.student_id = document.getElementById('editStudentId').value;
        userData.name = document.getElementById('editName').value;
        userData.email = document.getElementById('editEmail').value;
        userData.contact = document.getElementById('editContact').value;
        userData.birthdate = document.getElementById('editBirthdate').value;
        userData.address = document.getElementById('editAddress').value;

        renderProfile();
        bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
        Swal.fire('Success', 'Information updated successfully!', 'success');
      });
    });
  </script>
</body>
</html>