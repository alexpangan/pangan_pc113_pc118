<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100vh;
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #3B82F6;
            color: white;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 15px;
            text-decoration: none;
            color: white;
            display: block;
        }
        .sidebar a:hover {
            background-color: #87CEEB;
        }
        .content {
            margin-left: 200px;
            padding: 20px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            width: 40%;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="user.php">User</a>
        <a href="student/index.php">Student</a>
        <a href="employee.php">Employee</a>
        <a href="#">Logout</a>
    </div>

    <div class="content">
        <h1>User List</h1>
        <button id="addUserBtn">Add User</button>
        <table id="usersTable" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Add User Modal -->
    <div id="addUserModal" class="modal">
        <div class="modal-content">
            <h2>Add User</h2>
            <form id="addUserForm">
                <label for="addName">Name:</label><br>
                <input type="text" id="addName" required><br>
                <label for="addEmail">Email:</label><br>
                <input type="email" id="addEmail" required><br>
                <label for="addRole">Role:</label><br>
                <input type="text" id="addRole" required><br><br>
                <button type="submit">Save</button>
                <button type="button" id="closeAddModal">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editUserModal" class="modal">
        <div class="modal-content">
            <h2>Edit User</h2>
            <form id="editUserForm">
                <input type="hidden" id="editUserId">
                <label for="editName">Name:</label><br>
                <input type="text" id="editName" required><br>
                <label for="editEmail">Email:</label><br>
                <input type="email" id="editEmail" required><br>
                <label for="editRole">Role:</label><br>
                <input type="text" id="editRole" required><br><br>
                <button type="submit">Update</button>
                <button type="button" id="closeEditModal">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            let dataTable;

            function fetchUsers() {
                $.ajax({
                    url: 'http://localhost:8000/api/users',
                    method: 'GET',
                    success: function (response) {
                        let tableBody = '';
                        response.users.forEach((user, index) => {
                            tableBody += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${user.name}</td>
                                    <td>${user.email}</td>
                                    <td>${user.role || 'N/A'}</td>
                                    <td>
                                        <button class="editBtn" data-id="${user.id}" data-name="${user.name}" data-email="${user.email}" data-role="${user.role}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none" 
                                            stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon 
                                            icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                            Edit</button>
                                        <button class="deleteBtn" data-id="${user.id}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" 
                                            d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                            Delete</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#usersTable tbody').html(tableBody);

                        if ($.fn.DataTable.isDataTable('#usersTable')) {
                            $('#usersTable').DataTable().destroy();
                        }
                        $('#usersTable').DataTable();
                    },
                    error: function (error) {
                        console.error('Error fetching users:', error);
                    }
                });
            }

            fetchUsers();

            $('#addUserBtn').on('click', function () {
                $('#addUserModal').show();
            });

            $('#closeAddModal').on('click', function () {
                $('#addUserModal').hide();
            });

            $('#addUserForm').on('submit', function (e) {
                e.preventDefault();
                const newUser = {
                    name: $('#addName').val(),
                    email: $('#addEmail').val(),
                    role: $('#addRole').val(),
                };
                $.ajax({
                    url: 'http://localhost:8000/api/users',
                    method: 'POST',
                    data: newUser,
                    success: function () {
                        alert('User added successfully!');
                        $('#addUserModal').hide();
                        fetchUsers();
                        $('#addUserForm')[0].reset();
                    },
                    error: function (error) {
                        console.error('Error adding user:', error);
                    }
                });
            });

            $(document).on('click', '.editBtn', function () {
                const btn = $(this);
                $('#editUserId').val(btn.data('id'));
                $('#editName').val(btn.data('name'));
                $('#editEmail').val(btn.data('email'));
                $('#editRole').val(btn.data('role'));
                $('#editUserModal').show();
            });

            $('#closeEditModal').on('click', function () {
                $('#editUserModal').hide();
            });

            $('#editUserForm').on('submit', function (e) {
                e.preventDefault();
                const userId = $('#editUserId').val();
                const updatedUser = {
                    name: $('#editName').val(),
                    email: $('#editEmail').val(),
                    role: $('#editRole').val(),
                };
                $.ajax({
                    url: `http://localhost:8000/api/users/${userId}`,
                    method: 'PUT',
                    data: updatedUser,
                    success: function () {
                        alert('User updated successfully!');
                        $('#editUserModal').hide();
                        fetchUsers();
                    },
                    error: function (error) {
                        console.error('Error updating user:', error);
                    }
                });
            });

            $(document).on('click', '.deleteBtn', function () {
                const userId = $(this).data('id');
                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: `http://localhost:8000/api/users/${userId}`,
                        method: 'DELETE',
                        success: function () {
                            alert('User deleted successfully!');
                            fetchUsers();
                        },
                        error: function (error) {
                            console.error('Error deleting user:', error);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
