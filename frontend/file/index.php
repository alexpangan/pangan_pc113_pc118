<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>File Upload Navigation</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

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
      min-width: 140px;
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
</head>
<body class="bg-light py-5">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-lg rounded-4">
          <div class="card-body">
            <h4 class="card-title mb-4 text-center">Upload a File</h4>

            <form id="uploadForm" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="fileInput" class="form-label">Choose file</label>
                <input class="form-control" type="file" id="fileInput" name="file">
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Upload</button>
              </div>
            </form>

            <div id="uploadStatus" class="mt-3"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById("uploadForm").addEventListener("submit", function (e) {
      e.preventDefault();
      const fileInput = document.getElementById("fileInput");
      const formData = new FormData();
      formData.append("file", fileInput.files[0]);

      fetch("/upload-endpoint", {
        method: "POST",
        body: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      })
      .then(response => response.text())
      .then(data => {
        document.getElementById("uploadStatus").innerHTML =
          `<div class="alert alert-success mt-3">Upload successful: ${data}</div>`;
      })
      .catch(error => {
        document.getElementById("uploadStatus").innerHTML =
          `<div class="alert alert-danger mt-3">Upload failed: ${error}</div>`;
      });
    });
  </script>

</body>

</html>
