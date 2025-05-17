<?php include 'sidebar.php'; ?>

<header class="topnav">
    <div class="profile">
        <div class="dropdown">
            <span class="dropdown-toggle">Admin &#9662;</span>
            <div class="dropdown-menu">
                <a href="#" id="logoutBtn">Logout</a>
            </div>
        </div>
    </div>
</header>

<style>
    .topnav {
        position: fixed;
        left: 200px;
        right: 0;
        top: 0;
        height: 60px;
        background-color: #ffffff;
        border-bottom: 1px solid #ddd;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 0 20px;
        z-index: 1000;
    }

    .profile {
        display: flex;
        align-items: center;
        gap: 10px;
        position: relative;
    }

    .dropdown {
        position: relative;
        cursor: pointer;
    }

    .dropdown-toggle {
        font-weight: bold;
        color: #333;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        top: 100%;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        padding: 10px 0;
        border-radius: 5px;
        min-width: 120px;
    }

    .dropdown-menu a {
        display: block;
        padding: 8px 16px;
        color: #333;
        text-decoration: none;
    }

    .dropdown-menu a:hover {
        background-color: #f0f0f0;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }
</style>

<script>
    // Logout button script
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("logoutBtn").addEventListener("click", function (e) {
            e.preventDefault();
            if (confirm("Are you sure you want to logout?")) {
                // Perform logout (redirect to PHP logout script)
                window.location.href = "../index.php";
            }
        });
    });
</script>
