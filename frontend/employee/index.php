<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <title>Employee Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .content {
            margin-left: 200px;
            padding: 80px 20px 20px;
        }

        .content h1 {
            color: #333;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-content form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .modal-content form label {
            font-weight: bold;
        }

        .modal-content form input {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modal-content form .button1 {
            background-color: #2563EB;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .modal-content form .button1:hover {
            background-color: #1E40AF;
        }
    </style>
</head>
<body>
    <?php include '../includes/navbar.php'; ?>

    <div class="content">
        <h1>Employees List</h1>
        <button id="addEmployeeBtn" style="
            background-color: #10B981; /* Emerald green */
            color: white;
            padding: 0.6em 1.4em;
            font-size: 1em;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: background-color 0.3s ease, transform 0.2s;">
             Add Employee
        </button>
        <table id="employeesTable" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>

    <!-- Add/Edit Employee Modal -->
    <div id="addEmployeeModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" id="closeAddModal">&times;</span>
            <h2 id="modalTitle">Add Employee</h2>
            <form id="addEmployeeForm">
                <label for="addName">Name:</label>
                <input type="text" id="addName" name="name" required>

                <label for="addEmail">Email:</label>
                <input type="email" id="addEmail" name="email" required>

                <label for="addPassword">Password:</label>
                <input type="password" id="addPassword" name="password" required>

                <label for="addPhone">Phone:</label>
                <input type="text" id="addPhone" name="phone" required>

                <label for="addAddress">Address:</label>
                <input type="text" id="addAddress" name="address" required>

                <button type="submit" class="button1">Save</button>
            </form>
        </div>
    </div>

    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            let editingEmployeeId = null;

            // Fetch and display employees
            function fetchEmployees() {
                $.ajax({
                    url: 'http://localhost:8000/api/employees',
                    method: 'GET',
                    success: function (data) {
                        let tableBody = '';
                        data.forEach((employee, index) => {
                            tableBody += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${employee.name}</td>
                                    <td>${employee.email}</td>
                                    <td>${employee.password}</td>
                                    <td>${employee.phone}</td>
                                    <td>${employee.address}</td>
                                    <td>
                                        <div style="display: flex; gap: 0.5em;">
                                            <button class="edit-btn" data-id="${employee.id}" style="
                                                background-color: #3B82F6;
                                                color: white;
                                                padding: 0.5em 1em;
                                                border: none;
                                                border-radius: 8px;
                                                cursor: pointer;
                                                font-weight: bold;
                                                transition: background-color 0.3s ease;">
                                                Edit
                                            </button>
                                            <button class="delete-btn" data-id="${employee.id}" style="
                                                background-color: #EF4444;
                                                color: white;
                                                padding: 0.5em 1em;
                                                border: none;
                                                border-radius: 8px;
                                                cursor: pointer;
                                                font-weight: bold;
                                                transition: background-color 0.3s ease;">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#employeesTable tbody').html(tableBody);
                        $('#employeesTable').DataTable();
                    },
                    error: function (error) {
                        console.error('Error fetching employees:', error);
                    }
                });
            }

            fetchEmployees();

            // Open Add Employee Modal
            $('#addEmployeeBtn').on('click', function () {
                editingEmployeeId = null;
                $('#modalTitle').text('Add Employee');
                $('#addEmployeeForm')[0].reset();
                $('#addEmployeeModal').show();
            });

            // Close Modal
            $('#closeAddModal').on('click', function () {
                $('#addEmployeeModal').hide();
            });

            // Add or Edit Employee
            $('#addEmployeeForm').on('submit', function (e) {
                e.preventDefault();

                const employeeData = {
                    name: $('#addName').val(),
                    email: $('#addEmail').val(),
                    password: $('#addPassword').val(),
                    phone: $('#addPhone').val(),
                    address: $('#addAddress').val(),
                };

                const url = editingEmployeeId
                    ? `http://localhost:8000/api/employees/update/${editingEmployeeId}`
                    : 'http://localhost:8000/api/employees/create';

                const method = editingEmployeeId ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    method: method,
                    contentType: 'application/json',
                    data: JSON.stringify(employeeData),
                    success: function (response) {
                        alert(editingEmployeeId ? 'Employee updated successfully!' : 'Employee added successfully!');
                        $('#addEmployeeModal').hide();
                        fetchEmployees();
                    },
                    error: function (error) {
                        console.error('Error saving employee:', error);
                        alert('Failed to save employee.');
                    }
                });
            });

            // Edit Employee
            $(document).on('click', '.edit-btn', function () {
                editingEmployeeId = $(this).data('id');

                $.ajax({
                    url: `http://localhost:8000/api/employees/update/${editingEmployeeId}`,
                    method: 'PUT',
                    success: function (employee) {
                        $('#modalTitle').text('Edit Employee');
                        $('#addName').val(employee.name);
                        $('#addEmail').val(employee.email);
                        $('#addPassword').val(employee.password);
                        $('#addPhone').val(employee.phone);
                        $('#addAddress').val(employee.address);
                        $('#addEmployeeModal').show();
                    },
                    error: function (error) {
                        console.error('Error fetching employee details:', error);
                    }
                });
            });

            // Delete Employee
            $(document).on('click', '.delete-btn', function () {
                const employeeId = $(this).data('id');

                if (confirm('Are you sure you want to delete this employee?')) {
                    $.ajax({
                        url: `http://localhost:8000/api/employees/delete/${employeeId}`,
                        method: 'DELETE',
                        success: function (response) {
                            alert('Employee deleted successfully!');
                            fetchEmployees();
                        },
                        error: function (error) {
                            console.error('Error deleting employee:', error);
                            alert('Failed to delete employee.');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>