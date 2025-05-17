<nav class="sidebar" aria-label="Sidebar Navigation">
    <a href="../dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : '' ?>">Dashboard</a>
    <!-- <a href="../user/index.php">User</a> -->
    <a href="../student/index.php">Student</a>
    <a href="../employee/index.php">Employee</a>
    <!-- <a href="../file/index.php">File Upload</a> -->

</nav>

<style>
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

    .sidebar a.active {
    background-color: #1D4ED8;
    font-weight: bold;
    }

</style>