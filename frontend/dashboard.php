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
            background-color: #f4f4f9;
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
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #2563EB;
        }
        .content {
            margin-left: 200px;
            padding: 20px;
        }
        .content h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <nav class="sidebar" aria-label="Sidebar Navigation">
        <a href="dashboard.php">Dashboard</a>
        <a href="user/index.php">User</a>
        <a href="student/index.php">Student</a>
        <a href="employee/index.php">Employee</a>
        <a href="index.php">Logout</a>
    </nav>
    <main class="content">
        <h1>Welcome, Admin</h1>
    </main>
</body>
</html>