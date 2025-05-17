<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Parent Portal Sign Up</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #43cea2, #185a9d);
      color: #333;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 1rem;
      margin: 0;
    }

    .signup-container {
      background-color: #fff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.2);
      max-width: 500px;
      width: 100%;
    }

    .signup-container h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #185a9d;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: bold;
    }

    input {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
    }

    button {
      width: 100%;
      padding: 0.75rem;
      background-color: #185a9d;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      margin-top: 1rem;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #1273c4;
    }

    @media (max-width: 480px) {
      .signup-container {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>

  <div class="signup-container">
    <h2>Parent Sign Up</h2>
    <form action="register.php" method="POST">
    
        <div class="form-group">
            <label for="child_name">Child's Name</label>
            <input type="text" name="child_name" id="child_name" required />
        </div>

        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" id="full_name" required />
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" required />
        </div>

        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" name="age" id="age" required />
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" required />
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required />
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" required />
        </div>

        <button type="submit">Sign Up</button>
    </form>
  </div>

</body>
</html>
