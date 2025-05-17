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

        .content {
            margin-left: 200px; /* Adjust for the sidebar width */
            padding: 80px 20px 20px; /* Leave space for the top navbar */
        }

        .content h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <?php include '../includes/navbar.php'; ?> <!-- Include the navbar -->

    <div class="content">
        <h1>Users List</h1>
        <button id="addUserBtn" style="
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
             Add User
        </button>
        <table id="studentsTable" class="table">
            <thead>
                
            </thead>
            <tbody>
                <!-- Data will be dynamically populated -->
            </tbody>
        </table>
    </div>

    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        
    </script>
</body>
</html>