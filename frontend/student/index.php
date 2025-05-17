<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <style>
        /* Your existing styles here (unchanged for brevity) */
        body { margin: 0; font-family: Arial, sans-serif; }
        .content { margin-left: 200px; padding: 80px 20px 20px; }
        .content h1 { color: #333; }
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 90%; overflow: auto; background-color: rgba(0, 0, 0, 0.4); padding-top: 60px; }
        .modal-content { background-color: #fff; margin: auto; padding: 20px; border: 1px solid #888; width: 40%; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); }
        .close-btn { color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer; }
        .close-btn:hover, .close-btn:focus { color: black; text-decoration: none; cursor: pointer; }
        .modal-content form { display: flex; flex-direction: column; gap: 10px; }
        .modal-content form label { font-weight: bold; }
        .modal-content form input { padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 5px; }
        .modal-content form .button1 { background-color: #2563EB; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
        .modal-content form .button1:hover { background-color: #1E40AF; }
    </style>
</head>
<body>
    <?php include '../includes/navbar.php'; ?>

    <div class="content">
        <h1>Students List</h1>
        <button id="addStudentBtn" style="background-color: #10B981; color: white; padding: 0.6em 1.4em; font-size: 1em; font-weight: bold; border: none; border-radius: 8px; cursor: pointer; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: background-color 0.3s ease, transform 0.2s;">Add Student</button>
        <table id="studentsTable" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Profile Picture</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Add/Edit Student Modal -->
    <div id="addStudentModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" id="closeAddModal">&times;</span>
            <h2 id="modalTitle">Add Student</h2>
            <form id="addStudentForm">
                <label for="addName">Name:</label>
                <input type="text" id="addName" name="name" required>

                <label for="addCourse">Course:</label>
                <input type="text" id="addCourse" name="course" required>

                <label for="addYearLevel">Year Level:</label>
                <input type="text" id="addYearLevel" name="year_level" required>

                <label for="addEmail">Email:</label>
                <input type="email" id="addEmail" name="email" required>

                <label for="addPassword">Password:</label>
                <input type="password" id="addPassword" name="password" required>

                <label for="addPhone">Phone:</label>
                <input type="text" id="addPhone" name="phone" required>

                <label for="addAddress">Address:</label>
                <input type="text" id="addAddress" name="address" required>

                <label for="addProfilePicture">Profile Picture:</label>
                <input type="file" id="addProfilePicture" name="profile_picture" accept="image/*">

                <img id="profilePreview" style="max-width: 100px; display: none; border-radius: 8px; margin-top: 10px;" />

                <button type="submit" class="button1">Save</button>
            </form>
        </div>
    </div>

    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            let editingStudentId = null;
            let table = null;

            function fetchStudents() {
                $.ajax({
                    url: 'http://localhost:8000/api/students',
                    method: 'GET',
                    success: function (data) {
                        let tableBody = '';
                        data.forEach((student, index) => {
                            tableBody += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${student.name}</td>
                                    <td>${student.email}</td>
                                    <td>${student.course}</td>
                                    <td>${student.year_level}</td>
                                    <td>${student.phone}</td>
                                    <td>${student.address}</td>
                                    <td><img src="${student.profile_picture}" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                                    <td>
                                        <button class="edit-btn" data-id="${student.id}" style="background-color: #3B82F6; color: white; padding: 0.5em 1em; border: none; border-radius: 8px; cursor: pointer; font-weight: bold;">Edit</button>
                                        <button class="delete-btn" data-id="${student.id}" style="background-color: #EF4444; color: white; padding: 0.5em 1em; border: none; border-radius: 8px; cursor: pointer; font-weight: bold;">Delete</button>
                                    </td>
                                </tr>`;
                        });

                        if (table) {
                            table.clear().destroy();
                        }

                        $('#studentsTable tbody').html(tableBody);
                        table = $('#studentsTable').DataTable();
                    },
                    error: function (error) {
                        console.error('Error fetching students:', error);
                    }
                });
            }

            fetchStudents();

            $('#addStudentBtn').on('click', function () {
                editingStudentId = null;
                $('#modalTitle').text('Add Student');
                $('#addStudentForm')[0].reset();
                $('#profilePreview').hide().attr('src', '');
                $('#addStudentModal').show();
            });

            $('#closeAddModal').on('click', function () {
                $('#addStudentModal').hide();
                $('#profilePreview').hide().attr('src', '');
            });

            $('#addStudentForm').on('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);
                if (editingStudentId) {
                    formData.append('_method', 'PUT'); // For Laravel-style APIs
                }

                const url = editingStudentId
                    ? `http://localhost:8000/api/students/update/${editingStudentId}`
                    : 'http://localhost:8000/api/students/create';

                $.ajax({
                    url: url,
                    method: 'POST', // Always POST if using FormData and _method override
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function () {
                        alert(editingStudentId ? 'Student updated successfully!' : 'Student added successfully!');
                        $('#addStudentModal').hide();
                        fetchStudents();
                    },
                    error: function (error) {
                        console.error('Error saving student:', error);
                        alert('Failed to save student.');
                    }
                });
            });

            $('#addProfilePicture').on('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#profilePreview').attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#profilePreview').hide().attr('src', '');
                }
            });

            $(document).on('click', '.edit-btn', function () {
                editingStudentId = $(this).data('id');

                $.ajax({
                    url: `http://localhost:8000/api/students/${editingStudentId}`,
                    method: 'GET',
                    success: function (student) {
                        $('#modalTitle').text('Edit Student');
                        $('#addName').val(student.name);
                        $('#addCourse').val(student.course);
                        $('#addYearLevel').val(student.year_level);
                        $('#addEmail').val(student.email);
                        $('#addPassword').val(student.password);
                        $('#addPhone').val(student.phone);
                        $('#addAddress').val(student.address);
                        $('#profilePreview').hide().attr('src', '');
                        $('#addStudentModal').show();
                    },
                    error: function (error) {
                        console.error('Error fetching student details:', error);
                    }
                });
            });

            $(document).on('click', '.delete-btn', function () {
                const studentId = $(this).data('id');
                if (confirm('Are you sure you want to delete this student?')) {
                    $.ajax({
                        url: `http://localhost:8000/api/students/delete/${studentId}`,
                        method: 'DELETE',
                        success: function () {
                            alert('Student deleted successfully!');
                            fetchStudents();
                        },
                        error: function (error) {
                            console.error('Error deleting student:', error);
                            alert('Failed to delete student.');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
