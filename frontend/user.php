<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <title>User Dashboard</title>
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
            background-color: #333;
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
            background-color: rgb(132, 129, 129);
        }
        .content {
            margin-left: 200px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <!-- <a href="dashboard.php">Dashboard</a>
        <a href="user.php">User</a>
        <a href="student/index.php">Student</a>
        <a href="employee.php">Employee</a>
        <a href="#">Logout</a> -->
    </div>
    <div class="content">
        <h1>User List</h1>
        <table id="usersTable" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            // Fetch data from the students API
            $.ajax({
                url: 'http://localhost:8000/api/user', // Replace with your API endpoint
                method: 'GET',
                success: function (data) {
                    let tableBody = '';
                    data.forEach((user, index) => {
                        tableBody += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${user.name}</td>
                                <td>${user.email}</td>
                                <td>${user.password}</td>
                                <td>${user.role}</td>
                            </tr>
                        `;
                    });
                    $('#usersTable tbody').html(tableBody);
                    $('#usersTable').DataTable(); // Initialize DataTables
                },
                error: function (error) {
                    console.error('Error fetching user  s:', error);
                }
            });
        });
    </script>
</body>
</html>