<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Parent / Approved</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #6dd5fa, #2980b9);
      min-height: 100vh;
    }
    .layout-flex {
      display: flex;
      min-height: 100vh;
      width: 100vw;
    }
    .sidebar {
      width: 260px;
      min-height: 100vh;
      padding: 1rem;
      color: white;
      flex-shrink: 0;
      z-index: 2;
      position: relative;
    }
    .main-container {
      flex: 1;
      padding: 2rem;
      min-width: 0;
      background: transparent;
      z-index: 1;
      position: relative;
    }
    .main-content {
      background-color: rgba(252, 252, 252, 1);
      color: #333;
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
      min-height: 80vh;
    }
    .dashboard-header {
      background-color: #0d6efd;
      padding: 1rem;
      color: white;
      border-radius: 0.5rem;
      margin-bottom: 1.5rem;
    }
    @media (max-width: 900px) {
      .layout-flex {
        flex-direction: column;
      }
      .sidebar {
        width: 100%;
        min-height: unset;
        border-radius: 0 0 1rem 1rem;
      }
      .main-container {
        padding: 1rem;
      }
    }
    @media (max-width: 600px) {
      .main-content {
        padding: 1rem;
      }
      .main-container {
        padding: 0.5rem;
      }
    }
  </style>
</head>
<body>
  <div class="layout-flex">
    <!-- Sidebar -->
    <nav class="sidebar">
      <?php include 'include/sidebar.php'; ?>
    </nav>

    <!-- Main Content Area -->
    <div class="main-container">
      <?php include 'include/maincontent.php'; ?>
      <div class="main-content">
        <div class="mb-3 d-flex justify-content-between align-items-center">
          <button type="button" class="btn btn-primary" id="showAddModalBtn">Add Parent</button>
          <input type="text" id="searchInput" class="form-control w-auto " placeholder="Search guardian..." style="max-width: 250px;">
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Profile Picture</th>
              <th scope="col">Student's ID</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Phone</th>
              <th scope="col">Address</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Add Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="addForm">
        <div class="modal-content">
          <div class="modal-header"><h5 class="modal-title">Add Guardian</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-2">
              <label>Name</label>
              <input type="text" class="form-control" id="addName" required>
            </div>
            <div class="mb-2">
              <label>Email</label>
              <input type="email" class="form-control" id="addEmail" required>
            </div>
            <div class="mb-2">
              <label>Password</label>
              <input type="password" class="form-control" id="addPassword" required>
            </div>
            <div class="mb-2">
              <label>Phone</label>
              <input type="text" class="form-control" id="addPhone" required>
            </div>
            <div class="mb-2">
              <label>Address</label>
              <input type="text" class="form-control" id="addAddress" required>
            </div>
            <div class="mb-2">
              <label>Student's ID</label>
              <input type="text" class="form-control" id="addStudentId">
            </div>
            <div class="mb-2">
              <label>Profile Picture</label>
              <input type="file" class="form-control" id="addProfile" accept="image/*">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Add Guardian</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- View Modal -->
  <div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Guardian Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p><strong>Profile Picture:</strong></p>
          <img src="" id="viewProfilePicture" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
          <p><strong>Student's ID:</strong> <span id="viewStudentId"></span></p>
          <p><strong>Name:</strong> <span id="viewName"></span></p>
          <p><strong>Email:</strong> <span id="viewEmail"></span></p>
          <p><strong>Phone:</strong> <span id="viewPhone"></span></p>
          <p><strong>Address:</strong> <span id="viewAddress"></span></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="editForm">
        <div class="modal-content">
          <div class="modal-header"><h5 class="modal-title">Edit Guardian</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="editId">
            <div class="mb-2">
              <label>Name</label>
              <input type="text" class="form-control" id="editName" required>
            </div>
            <div class="mb-2">
              <label>Email</label>
              <input type="email" class="form-control" id="editEmail" required>
            </div>
            <div class="mb-2">
              <label>Phone</label>
              <input type="text" class="form-control" id="editPhone" required>
            </div>
            <div class="mb-2">
              <label>Address</label>
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
document.addEventListener('DOMContentLoaded', function () {
  let allGuardians = [];

  // Fetch and display guardians
  function loadGuardians(searchTerm = '') {
    fetch('http://localhost:8000/api/guardians')
      .then(res => res.json())
      .then(data => {
        allGuardians = data;
        renderTable(data, searchTerm);
      });
  }

  function renderTable(guardians, searchTerm = '') {
    const tbody = document.querySelector('table tbody');
    tbody.innerHTML = '';
    let filtered = guardians;
    if (searchTerm) {
      const term = searchTerm.toLowerCase();
      filtered = guardians.filter(parent =>
        Object.values(parent).some(val =>
          String(val).toLowerCase().includes(term)
        )
      );
    }
    filtered.forEach(parent => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${parent.id}</td>
        <td><img src="http://127.0.0.1:8000/storage/${parent.profile}" style="width: 50px; height: 50px; border-radius: 50%;"></td>
        <td>${parent.student_id ?? ''}</td>
        <td>${parent.full_name}</td>
        <td>${parent.email}</td>
        <td>${parent.phone}</td>
        <td>${parent.address}</td>
        <td>
          <button class="btn btn-success btn-sm approve-btn" data-id="${parent.id}">Approve</button>
          <button class="btn btn-info btn-sm view-btn" data-id="${parent.id}">View</button>
          <button class="btn btn-warning btn-sm edit-btn" data-id="${parent.id}">Edit</button>
          <button class="btn btn-danger btn-sm delete-btn" data-id="${parent.id}">Delete</button>
        </td>
      `;
      tbody.appendChild(tr);
    });
  }

  loadGuardians();

  // Show Add Modal
  document.getElementById('showAddModalBtn').addEventListener('click', function() {
    document.getElementById('addForm').reset();
    new bootstrap.Modal(document.getElementById('addModal')).show();
  });

  // Add Guardian
  document.getElementById('addForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const full_name = document.getElementById('addName').value;
    const email = document.getElementById('addEmail').value;
    const password = document.getElementById('addPassword').value;
    const phone = document.getElementById('addPhone').value;
    const address = document.getElementById('addAddress').value;
    const student_id = document.getElementById('addStudentId').value;
    const profile = document.getElementById('addProfile').files[0];

    const formData = new FormData();
    formData.append('full_name', full_name);
    formData.append('email', email);
    formData.append('password', password);
    formData.append('phone', phone);
    formData.append('address', address);
    formData.append('student_id', student_id);
    if (profile) {
      formData.append('profile', profile);
    }

    fetch('http://localhost:8000/api/guardians', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(() => {
      Swal.fire('Added!', 'Guardian added successfully.', 'success');
      bootstrap.Modal.getInstance(document.getElementById('addModal')).hide();
      loadGuardians();
    })
    .catch(() => {
      Swal.fire('Error', 'Failed to add guardian.', 'error');
    });
  });

  // Search/filter function
    $('#searchInput').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('#activitiesTable tbody tr').filter(function() {
            $(this).toggle(
                $(this).text().toLowerCase().indexOf(value) > -1
            );
        });
    });

  

  // Table actions (Approve, View, Edit, Delete)
  document.querySelector('table').addEventListener('click', function(e) {
    const id = e.target.dataset.id;
    if (!id) return;

    if (e.target.classList.contains('approve-btn')) {
      Swal.fire({
        title: 'Approve Guardian?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Approve'
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(`http://localhost:8000/api/guardians/${id}/approve`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' }
          })
          .then(res => res.json())
          .then(() => {
            Swal.fire('Approved!', 'Guardian has been approved.', 'success');
            loadGuardians();
          })
          .catch(() => {
            Swal.fire('Error', 'Failed to approve guardian.', 'error');
          });
        }
      });
    }

    if (e.target.classList.contains('view-btn')) {
      fetch(`http://localhost:8000/api/guardians/${id}`)
        .then(res => res.json())
        .then(parent => {
          document.getElementById('viewName').textContent = parent.full_name;
          document.getElementById('viewEmail').textContent = parent.email;
          document.getElementById('viewPhone').textContent = parent.phone;
          document.getElementById('viewAddress').textContent = parent.address;
          document.getElementById('viewStudentId').textContent = parent.student_id ?? '';
          document.getElementById('viewProfilePicture').src = parent.profile_picture ? `http://127.0.0.1:8000/storage/${parent.profile_picture}` : '';
          new bootstrap.Modal(document.getElementById('viewModal')).show();
        })
        .catch(() => {
          Swal.fire('Error', 'Failed to fetch guardian details.', 'error');
        });
    }

    if (e.target.classList.contains('edit-btn')) {
      fetch(`http://localhost:8000/api/guardians/${id}`)
        .then(res => res.json())
        .then(parent => {
          document.getElementById('editId').value = parent.id;
          document.getElementById('editName').value = parent.full_name;
          document.getElementById('editEmail').value = parent.email;
          document.getElementById('editPhone').value = parent.phone;
          document.getElementById('editAddress').value = parent.address;
          new bootstrap.Modal(document.getElementById('editModal')).show();
        })
        .catch(() => {
          Swal.fire('Error', 'Failed to fetch guardian details.', 'error');
        });
    }

    if (e.target.classList.contains('delete-btn')) {
      Swal.fire({
        title: 'Delete Guardian?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete'
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(`http://localhost:8000/api/guardians/${id}`, {
            method: 'DELETE'
          })
          .then(res => res.json())
          .then(() => {
            Swal.fire('Deleted!', 'Guardian has been deleted.', 'success');
            loadGuardians();
          })
          .catch(() => {
            Swal.fire('Error', 'Failed to delete guardian.', 'error');
          });
        }
      });
    }
  });

  // Edit (submit modal)
  document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('editId').value;
    const full_name = document.getElementById('editName').value;
    const email = document.getElementById('editEmail').value;
    const phone = document.getElementById('editPhone').value;
    const address = document.getElementById('editAddress').value;
    fetch(`http://localhost:8000/api/guardians/${id}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ full_name, email, phone, address })
    })
    .then(res => res.json())
    .then(() => {
      Swal.fire('Updated!', 'Guardian updated successfully.', 'success');
      bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
      loadGuardians();
    })
    .catch(() => {
      Swal.fire('Error', 'Failed to update guardian.', 'error');
    });
  });

});
</script>
</body>
</html>