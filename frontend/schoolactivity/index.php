<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School Activities</title>
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
      padding: 2rem;
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
    <div class="schoolactivity mb-3">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add School Activity</button>
      <span class="ms-3">search pero wapa</span>
    </div>
    <table class="table table-bordered table-striped bg-white">
      <thead>
        <tr>
          <th scope="col">Title</th>
          <th scope="col">Who</th>
          <th scope="col">What</th>
          <th scope="col">When</th>
          <th scope="col">Where</th>
          <th scope="col">Why</th>
          <th scope="col">Organizer</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <!-- Dynamic rows go here -->
      </tbody>
    </table>
  </div>

  <!-- Add Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="addForm">
        <div class="modal-content">
          <div class="modal-header"><h5 class="modal-title">Add School Activity</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-2">
              <label>Title</label>
              <input type="text" class="form-control" id="addTitle" required>
            </div>
            <div class="mb-2">
              <label>Who</label>
              <input type="text" class="form-control" id="addWho" required>
            </div>
            <div class="mb-2">
              <label>What</label>
              <input type="text" class="form-control" id="addWhat" required>
            </div>
            <div class="mb-2">
              <label>When</label>
              <input type="date" class="form-control" id="addWhen" required>
            </div>
            <div class="mb-2">
              <label>Where</label>
              <input type="text" class="form-control" id="addWhere" required>
            </div>
            <div class="mb-2">
              <label>Why</label>
              <input type="text" class="form-control" id="addWhy" required>
            </div>
            <div class="mb-2">
              <label>Organizer</label>
              <input type="text" class="form-control" id="addOrganizer" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Add Activity</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- View Modal -->
  <div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Activity Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p><strong>Title:</strong> <span id="viewTitle"></span></p>
          <p><strong>Who:</strong> <span id="viewWho"></span></p>
          <p><strong>What:</strong> <span id="viewWhat"></span></p>
          <p><strong>When:</strong> <span id="viewWhen"></span></p>
          <p><strong>Where:</strong> <span id="viewWhere"></span></p>
          <p><strong>Why:</strong> <span id="viewWhy"></span></p>
          <p><strong>Organizer:</strong> <span id="viewOrganizer"></span></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="editForm">
        <div class="modal-content">
          <div class="modal-header"><h5 class="modal-title">Edit Activity</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="editId">
            <div class="mb-2">
              <label>Title</label>
              <input type="text" class="form-control" id="editTitle" required>
            </div>
            <div class="mb-2">
              <label>Who</label>
              <input type="text" class="form-control" id="editWho" required>
            </div>
            <div class="mb-2">
              <label>What</label>
              <input type="text" class="form-control" id="editWhat" required>
            </div>
            <div class="mb-2">
              <label>When</label>
              <input type="date" class="form-control" id="editWhen" required>
            </div>
            <div class="mb-2">
              <label>Where</label>
              <input type="text" class="form-control" id="editWhere" required>
            </div>
            <div class="mb-2">
              <label>Why</label>
              <input type="text" class="form-control" id="editWhy" required>
            </div>
            <div class="mb-2">
              <label>Organizer</label>
              <input type="text" class="form-control" id="editOrganizer" required>
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
    function loadActivities() {
      fetch('http://localhost:8000/api/schoolactivities')
        .then(res => res.json())
        .then(data => {
          // If using Laravel pagination, use data.data
          const activities = data.data ? data.data : data;
          const tbody = document.querySelector('table tbody');
          tbody.innerHTML = '';
          activities.forEach(activity => {
            tr = document.createElement('tr');
            tr.innerHTML = `
              <td>${activity.title}</td>
              <td>${activity.who}</td>
              <td>${activity.what}</td>
              <td>${activity.when}</td>
              <td>${activity.where}</td>
              <td>${activity.why}</td>
              <td>${activity.organizer}</td>
              <td>
                <button class="btn btn-info btn-sm view-btn" data-id="${activity.id}">View</button>
                <button class="btn btn-warning btn-sm edit-btn" data-id="${activity.id}">Edit</button>
                <button class="btn btn-danger btn-sm delete-btn" data-id="${activity.id}">Delete</button>
              </td>
            `;
            tbody.appendChild(tr);
          });
        })
        .catch(() => {
          Swal.fire('Error', 'Failed to load activities.', 'error');
        });
    }

    loadActivities();

    // Add Activity (submit modal)
    document.getElementById('addForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const title = document.getElementById('addTitle').value;
      const who = document.getElementById('addWho').value;
      const what = document.getElementById('addWhat').value;
      const when = document.getElementById('addWhen').value;
      const where = document.getElementById('addWhere').value;
      const why = document.getElementById('addWhy').value;
      const organizer = document.getElementById('addOrganizer').value;
      fetch('http://localhost:8000/api/schoolactivities', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ title, who, what, when, where, why, organizer })
      })
      .then(res => res.json())
      .then(() => {
        Swal.fire('Added!', 'Activity added successfully.', 'success');
        bootstrap.Modal.getInstance(document.getElementById('addModal')).hide();
        document.getElementById('addForm').reset();
        loadActivities();
      })
      .catch(() => {
        Swal.fire('Error', 'Failed to add activity.', 'error');
      });
    });

    // View
    document.querySelector('table').addEventListener('click', function(e) {
      if (e.target.classList.contains('view-btn')) {
        const id = e.target.dataset.id;
        fetch(`http://localhost:8000/api/schoolactivities/${id}`)
          .then(res => res.json())
          .then(activity => {
            document.getElementById('viewTitle').textContent = activity.title;
            document.getElementById('viewWho').textContent = activity.who;
            document.getElementById('viewWhat').textContent = activity.what;
            document.getElementById('viewWhen').textContent = activity.when;
            document.getElementById('viewWhere').textContent = activity.where;
            document.getElementById('viewWhy').textContent = activity.why;
            document.getElementById('viewOrganizer').textContent = activity.organizer;
            new bootstrap.Modal(document.getElementById('viewModal')).show();
          })
          .catch(() => {
            Swal.fire('Error', 'Failed to fetch activity details.', 'error');
          });
      }
    });

    // Edit (open modal)
    document.querySelector('table').addEventListener('click', function(e) {
      if (e.target.classList.contains('edit-btn')) {
        const id = e.target.dataset.id;
        fetch(`http://localhost:8000/api/schoolactivities/${id}`)
          .then(res => res.json())
          .then(activity => {
            document.getElementById('editId').value = activity.id;
            document.getElementById('editTitle').value = activity.title;
            document.getElementById('editWho').value = activity.who;
            document.getElementById('editWhat').value = activity.what;
            document.getElementById('editWhen').value = activity.when;
            document.getElementById('editWhere').value = activity.where;
            document.getElementById('editWhy').value = activity.why;
            document.getElementById('editOrganizer').value = activity.organizer;
            new bootstrap.Modal(document.getElementById('editModal')).show();
          })
          .catch(() => {
            Swal.fire('Error', 'Failed to fetch activity details.', 'error');
          });
      }
    });

    // Edit (submit modal)
    document.getElementById('editForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const id = document.getElementById('editId').value;
      const title = document.getElementById('editTitle').value;
      const who = document.getElementById('editWho').value;
      const what = document.getElementById('editWhat').value;
      const when = document.getElementById('editWhen').value;
      const where = document.getElementById('editWhere').value;
      const why = document.getElementById('editWhy').value;
      const organizer = document.getElementById('editOrganizer').value;
      fetch(`http://localhost:8000/api/schoolactivities/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ title, who, what, when, where, why, organizer })
      })
      .then(res => res.json())
      .then(() => {
        Swal.fire('Updated!', 'Activity updated successfully.', 'success');
        bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
        loadActivities();
      })
      .catch(() => {
        Swal.fire('Error', 'Failed to update activity.', 'error');
      });
    });

    // Delete
    document.querySelector('table').addEventListener('click', function(e) {
      if (e.target.classList.contains('delete-btn')) {
        const id = e.target.dataset.id;
        Swal.fire({
          title: 'Delete Activity?',
          text: 'This action cannot be undone!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Delete'
        }).then((result) => {
          if (result.isConfirmed) {
            fetch(`http://localhost:8000/api/schoolactivities/${id}`, {
              method: 'DELETE'
            })
            .then(res => res.json())
            .then(() => {
              Swal.fire('Deleted!', 'Activity has been deleted.', 'success');
              loadActivities();
            })
            .catch(() => {
              Swal.fire('Error', 'Failed to delete activity.', 'error');
            });
          }
        });
      }
    });
  });
  </script>
</body>
</html>