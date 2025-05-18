<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Parent Portal Dashboard</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(to right, #6dd5fa, #2980b9);
      margin: 0;
      font-family: Arial, sans-serif;    }

    .sidebar {
      width: 260px;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      padding: 2rem 1rem;
      color: white;
      overflow-y: hidden;
    }

    .sidebar h4 {
      margin-bottom: 2rem;
    }

    .main-container {
      margin-left: 260px;
      padding: 2rem;
    }

    .dashboard-header {
      background-color: #0d6efd;
      color: white;
      padding: 1rem 1.5rem;
      border-radius: 0.5rem;
      margin-bottom: 2rem;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .main-content {
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
      .sidebar {
        position: relative;
        width: 100%;
        height: auto;
      }

      .main-container {
        margin-left: 0;
        padding: 1rem;
      }
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <nav class="sidebar">
    <?php include 'include/sidebar.php'; ?>
  </nav>

  <!-- Main Area -->
  <div class="main-container">
    <!-- Header -->
      <?php include 'include/maincontent.php'; ?>

    <!-- Main Content Section -->
    <section class="main-content">
      <?php include 'include/announcement.php'; ?>
    </section>
  </div>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
