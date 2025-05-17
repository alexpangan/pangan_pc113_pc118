<div class="store">
    <div class="container">
        <h2>Announcement</h2>
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add Announcement</button>
            <input type="text" id="searchInput" class="form-control w-auto" placeholder="Search..." style="max-width: 250px;">
        </div>
        <table id="activitiesTable" class="table table-bordered table-striped bg-white">
            <thead>
                <tr>
                    <th>Activity Title</th>
                    <th>Who</th>
                    <th>What</th>
                    <th>When</th>
                    <th>Where</th>
                    <th>Why</th>
                    <th>Organizer</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated dynamically -->
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="addForm">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Add Announcement</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-2"><label>Title</label><input type="text" class="form-control" name="title" required></div>
          <div class="mb-2"><label>Who</label><input type="text" class="form-control" name="who" required></div>
          <div class="mb-2"><label>What</label><input type="text" class="form-control" name="what" required></div>
          <div class="mb-2"><label>When</label><input type="date" class="form-control" name="when" required></div>
          <div class="mb-2"><label>Where</label><input type="text" class="form-control" name="where" required></div>
          <div class="mb-2"><label>Why</label><input type="text" class="form-control" name="why" required></div>
          <div class="mb-2"><label>Organizer</label><input type="text" class="form-control" name="organizer" required></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Announcement Details</h5>
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
        <div class="modal-header"><h5 class="modal-title">Edit Announcement</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="editId">
          <div class="mb-2"><label>Title</label><input type="text" class="form-control" name="title" id="editTitle" required></div>
          <div class="mb-2"><label>Who</label><input type="text" class="form-control" name="who" id="editWho" required></div>
          <div class="mb-2"><label>What</label><input type="text" class="form-control" name="what" id="editWhat" required></div>
          <div class="mb-2"><label>When</label><input type="date" class="form-control" name="when" id="editWhen" required></div>
          <div class="mb-2"><label>Where</label><input type="text" class="form-control" name="where" id="editWhere" required></div>
          <div class="mb-2"><label>Why</label><input type="text" class="form-control" name="why" id="editWhy" required></div>
          <div class="mb-2"><label>Organizer</label><input type="text" class="form-control" name="organizer" id="editOrganizer" required></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function loadAnnouncements() {
    $.ajax({
        url: 'http://localhost:8000/api/announcements',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            let announcements = data.data ? data.data : data;
            let tbody = $('#activitiesTable tbody');
            tbody.empty();
            announcements.forEach(activity => {
                const row = `
                    <tr>
                        <td>${activity.title ?? 'N/A'}</td>
                        <td>${activity.who ?? 'N/A'}</td>
                        <td>${activity.what ?? 'N/A'}</td>
                        <td>${activity.when ?? 'N/A'}</td>
                        <td>${activity.where ?? 'N/A'}</td>
                        <td>${activity.why ?? 'N/A'}</td>
                        <td>${activity.organizer ?? 'N/A'}</td>
                        <td>
                            <button class="btn btn-info btn-sm view-btn" data-id="${activity.id}">View</button>
                            <button class="btn btn-warning btn-sm edit-btn" data-id="${activity.id}">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="${activity.id}">Delete</button>
                        </td>
                    </tr>
                `;
                tbody.append(row);
            });
        },
        error: function(err) {
            console.error('Failed to fetch announcements:', err);
            alert('Error loading announcements. Please check the console for details.');
        }
    });
}

$(document).ready(function () {
    loadAnnouncements();

    // Add
    $('#addForm').submit(function(e) {
        e.preventDefault();
        const data = {
            title: $(this).find('[name="title"]').val(),
            who: $(this).find('[name="who"]').val(),
            what: $(this).find('[name="what"]').val(),
            when: $(this).find('[name="when"]').val(),
            where: $(this).find('[name="where"]').val(),
            why: $(this).find('[name="why"]').val(),
            organizer: $(this).find('[name="organizer"]').val()
        };
        $.ajax({
            url: 'http://localhost:8000/api/announcements',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function() {
                $('#addModal').modal('hide');
                $('#addForm')[0].reset();
                Swal.fire('Added!', 'Announcement added successfully.', 'success');
                loadAnnouncements();
            },
            error: function() {
                Swal.fire('Error', 'Failed to add announcement.', 'error');
            }
        });
    });

    // View
    $('#activitiesTable').on('click', '.view-btn', function() {
        const id = $(this).data('id');
        $.get(`http://localhost:8000/api/announcements/${id}`, function(activity) {
            $('#viewTitle').text(activity.title);
            $('#viewWho').text(activity.who);
            $('#viewWhat').text(activity.what);
            $('#viewWhen').text(activity.when);
            $('#viewWhere').text(activity.where);
            $('#viewWhy').text(activity.why);
            $('#viewOrganizer').text(activity.organizer);
            $('#viewModal').modal('show');
        }).fail(function() {
            Swal.fire('Error', 'Failed to fetch announcement details.', 'error');
        });
    });

    // Edit (open modal)
    $('#activitiesTable').on('click', '.edit-btn', function() {
        const id = $(this).data('id');
        $.get(`http://localhost:8000/api/announcements/${id}`, function(activity) {
            $('#editId').val(activity.id);
            $('#editTitle').val(activity.title);
            $('#editWho').val(activity.who);
            $('#editWhat').val(activity.what);
            $('#editWhen').val(activity.when);
            $('#editWhere').val(activity.where);
            $('#editWhy').val(activity.why);
            $('#editOrganizer').val(activity.organizer);
            $('#editModal').modal('show');
        }).fail(function() {
            Swal.fire('Error', 'Failed to fetch announcement details.', 'error');
        });
    });

    // Edit (submit)
    $('#editForm').submit(function(e) {
        e.preventDefault();
        const id = $('#editId').val();
        const data = {
            title: $('#editTitle').val(),
            who: $('#editWho').val(),
            what: $('#editWhat').val(),
            when: $('#editWhen').val(),
            where: $('#editWhere').val(),
            why: $('#editWhy').val(),
            organizer: $('#editOrganizer').val()
        };
        $.ajax({
            url: `http://localhost:8000/api/announcements/${id}`,
            method: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function() {
                $('#editModal').modal('hide');
                Swal.fire('Updated!', 'Announcement updated successfully.', 'success');
                loadAnnouncements();
            },
            error: function() {
                Swal.fire('Error', 'Failed to update announcement.', 'error');
            }
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

    // Delete
    $('#activitiesTable').on('click', '.delete-btn', function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Delete Announcement?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `http://localhost:8000/api/announcements/${id}`,
                    method: 'DELETE',
                    success: function() {
                        Swal.fire('Deleted!', 'Announcement has been deleted.', 'success');
                        loadAnnouncements();
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to delete announcement.', 'error');
                    }
                });
            }
        });
    });
});
</script>