<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Welcome Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #6dd5fa, #2980b9);
      height: 100vh;
    }
  </style>
</head>
<body class="d-flex justify-content-center align-items-center text-white">

  <div class="container text-center bg-dark bg-opacity-50 p-5 rounded-4 shadow-lg" style="max-width: 500px;">
    <h1 class="mb-3">Welcome Parent!</h1>
    <p class="mb-4">We're glad to have you here. Click below to continue.</p>
    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
      <a href="login.php" class="btn btn-light text-primary px-4">Log In</a>
      <a href="signup.php" class="btn btn-light text-primary px-4">Sign Up</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
