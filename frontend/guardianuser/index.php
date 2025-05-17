<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parents Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
      body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: linear-gradient(to right, #6dd5fa, #2980b9);
        min-height: 100vh;
        display: flex;
      }
      .sidebar {
        width: 300px;
        min-height: 100vh;
        padding: 1rem;
        color: white;
      }
      .main-container {
        flex: 1;
        padding: 2rem;
      }
      .addparent {
        margin-bottom: 1rem;
      }
    </style>
</head>
<body>
  <!-- Sidebar -->
  <nav class="sidebar bg-primary">
    <?php include '../include/sidebar.php'; ?>
  </nav>

  <!-- Main Content Area -->
 
    <div class="main-container">
    <?php include '../include/maincontent.php'; ?>

    <?php
        // Example: Get user info from session or database
        // Replace with your actual data source
        $user = [
        'id' => 1,
        'full_name' => 'Maria Santos',
        'email' => 'maria@email.com',
        'phone' => '09998887777',
        'address' => '456 Sample Ave, City',
        'birthday' => '1990-05-15',
        'gender' => 'Female'
        ];
    ?>

    <div class="main-content bg-light p-4 rounded shadow mx-auto" style="max-width: 500px;">
        <h2 class="text-center mb-4">User Information</h2>
        <ul class="list-group list-group-flush">
        <li class="list-group-item"><strong>Name:</strong> <?= htmlspecialchars($user['full_name']) ?></li>
        <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></li>
        <li class="list-group-item"><strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?></li>
        <li class="list-group-item"><strong>Address:</strong> <?= htmlspecialchars($user['address']) ?></li>
        <li class="list-group-item"><strong>Birthday:</strong> <?= htmlspecialchars($user['birthday']) ?></li>
        <li class="list-group-item"><strong>Gender:</strong> <?= htmlspecialchars($user['gender']) ?></li>
        </ul>
    </div>
    </div>

    
</body>
</html>