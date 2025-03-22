<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <title>Dashboard</title>
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
        <a href="#">Dashboard</a>
        <a href="#">User</a>
        <a href="#">Logout</a>
    </div>
    <div class="content">
        <h1>Students List</h1>
        <table id="studentsTable" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
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
                url: 'http://localhost:8000/api/students',
                method: 'GET',
                success: function (data) {
                    let tableBody = '';
                    data.forEach((student, index) => {
                        tableBody += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${student.name}</td>
                                <td>${student.course}</td>
                                <td>${student.year_level}</td>
                                <td>${student.email}</td>
                                <td>${student.phone}</td>
                                <td>${student.address}</td>
                            </tr>
                        `;
                    });
                    $('#studentsTable tbody').html(tableBody);
                    $('#studentsTable').DataTable(); 
                },
                error: function (error) {
                    console.error('Error fetching students:', error);
                }
            });
        });
    </script>
</body>
</html>