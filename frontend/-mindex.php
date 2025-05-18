<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #1E3A8A; 
        }
        .form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 2em;
            background-color: #3B82F6; 
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: 0.3s ease-in-out;
            text-align: center;
            width: 300px;
        }
        .form:hover {
            transform: scale(1.05);
        }
        #heading {
            color: white;
            font-size: 1.5em;
            font-weight: bold;
        }
        .field {
            display: flex;
            align-items: center;
            gap: 0.5em;
            border-radius: 10px;
            padding: 0.7em;
            background-color: #1E40AF; /* Dark blue for contrast */
            box-shadow: inset 2px 5px 10px rgba(5, 5, 5, 0.5);
        }
        .input-icon {
            height: 1.5em;
            width: 1.5em;
            fill: white;
        }
        .input-field {
            background: none;
            border: none;
            outline: none;
            width: 100%;
            color: white;
            font-size: 1em;
        }
        .btn {
            margin-top: 1.5em;
        }
        .button1 {
            padding: 0.6em 1.8em;
            border-radius: 5px;
            border: none;
            transition: 0.3s ease-in-out;
            background-color: #2563EB;
            color: white;
            cursor: pointer;
            font-size: 1em;
            text-decoration: none;
            display: inline-block;
        }
        .button1:hover {
            background-color: #1E40AF;
        }
    </style>
</head>
<body>
    <form class="form" id="loginForm">
        <p id="heading">Login</p>
        <div class="field">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643z"></path>
            </svg>
            <input autocomplete="off" placeholder="Username" class="input-field" type="text" id="username" name="username" required>
        </div>
        <div class="field">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
            </svg>
            <input placeholder="Password" class="input-field" type="password" id="password" name="password" required>
        </div>
        <div class="btn">
            <button type="button" id="submit" class="button1">Login</button>
        
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#loginForm').on('click', '#submit', function (e) {
                e.preventDefault();

                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;

                // Send login request to the backend API using AJAX
                $.ajax({
                    url: 'http://localhost:8000/api/login',
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept' : 'application/json'
                    },  
                    data: JSON.stringify({
                        email: username,
                        password: password,
                    }),
                    success: function (data) {
                        if (data.token) {
                            // Store the token in localStorage or sessionStorage
                            localStorage.setItem('authToken', data.token);

                            // Redirect to the dashboard
                            window.location.href = 'dashboard.php';
                        } else {
                            alert(data.message || 'Login failed. Please try again.');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    },
                });
            });
        });
    </script>
</body>
</html>