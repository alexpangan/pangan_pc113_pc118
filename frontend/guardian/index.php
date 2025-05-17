<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Parent / Approved</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Bootstrap JS (already included if you use Bootstrap modals) -->
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
      padding: 2rem;
    }

    .main-content {
      background-color: rgba(252, 252, 252, 1);
      color: white;
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
  </style>
</head>
<body>

  <!-- Sidebar -->
  <nav class="sidebar">
    <?php include '../include/sidebar.php'; ?>
  </nav>

  <!-- Main Content Area -->
  <div class="main-container">
    <?php include '../include/maincontent.php'; ?>
    <div class="addparent">
      <button type="button">Add Parent</button>
      search pero wapa
    </div>
    <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
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
  <!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Guardian Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
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
  // Fetch and display guardians
  function loadGuardians() {
    fetch('http://localhost:8000/api/guardians')
      .then(res => res.json())
      .then(data => {
        const tbody = document.querySelector('table tbody');
        tbody.innerHTML = '';
        data.forEach(parent => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td>${parent.id}</td>
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
      });
  }

  loadGuardians();

  // Approve
  document.querySelector('table').addEventListener('click', function(e) {
    if (e.target.classList.contains('approve-btn')) {
      const id = e.target.dataset.id;
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
          });
        }
      });
    }
  });

  // View
  document.querySelector('table').addEventListener('click', function(e) {
    if (e.target.classList.contains('view-btn')) {
      const id = e.target.dataset.id;
      fetch(`http://localhost:8000/api/guardians/${id}`)
        .then(res => res.json())
        .then(parent => {
          document.getElementById('viewName').textContent = parent.full_name;
          document.getElementById('viewEmail').textContent = parent.email;
          document.getElementById('viewPhone').textContent = parent.phone;
          document.getElementById('viewAddress').textContent = parent.address;
          new bootstrap.Modal(document.getElementById('viewModal')).show();
        });
    }
  });

  // Edit (open modal)
  document.querySelector('table').addEventListener('click', function(e) {
    if (e.target.classList.contains('edit-btn')) {
      const id = e.target.dataset.id;
      fetch(`http://localhost:8000/api/guardians/${id}`)
        .then(res => res.json())
        .then(parent => {
          document.getElementById('editId').value = parent.id;
          document.getElementById('editName').value = parent.full_name;
          document.getElementById('editEmail').value = parent.email;
          document.getElementById('editPhone').value = parent.phone;
          document.getElementById('editAddress').value = parent.address;
          new bootstrap.Modal(document.getElementById('editModal')).show();
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
    });
  });

  // Delete
  document.querySelector('table').addEventListener('click', function(e) {
    if (e.target.classList.contains('delete-btn')) {
      const id = e.target.dataset.id;
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
          });
        }
      });
    }
  });
});
</script>

</body>
</html>
