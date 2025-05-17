<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #4facfe, #00f2fe);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-container {
      background-color: white;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #333;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      color: #555;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
    }

    .btn {
      width: 100%;
      padding: 0.75rem;
      background-color: #4facfe;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn:hover {
      background-color: #00c6ff;
    }

    .form-footer {
      text-align: center;
      margin-top: 1rem;
      font-size: 0.9rem;
    }

    .form-footer a {
      color: #4facfe;
      text-decoration: none;
    }

    @media (max-width: 480px) {
      .login-container {
        padding: 1.5rem;
        margin: 0 1rem;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form action="dashboard.php" method="POST">
      <div class="form-group">
        <label for="username">Username or Email:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="btn">Login</button>
    </form>
    <div class="form-footer">
      <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
  </div>
</body>
</html>
