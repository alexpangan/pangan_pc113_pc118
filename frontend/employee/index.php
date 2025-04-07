<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <title>Employee Dashboard</title>
    <!-- <style>
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
    </style> -->
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
        <h1>Employees List</h1>
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
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
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
                                    <button>
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none" 
                                    stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon 
                                    icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" />
                                    </svg>
                                    Edit</button>
                                    <button>
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
                    $('#employeesTable tbody').html(tableBody);
                    $('#employeesTable').DataTable(); 
                },
                error: function (error) {
                    console.error('Error fetching employee:', error);
                }
            });
        });
    </script>
</body>
</html>