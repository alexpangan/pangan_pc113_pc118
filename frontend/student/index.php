<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <title>Student Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
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
        }
        .sidebar a:hover {
            background-color: #87CEEB;
        }
        .content {
            margin-left: 200px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="user.php">User</a>
        <a href="index.php">Student</a>
        <a href="employee.php">Employee</a>
        <a href="#">Logout</a>
    </div>
    <div class="content">
        <h1>Students List</h1>
        <div class="addstudent">
        <h3 style="cursor: pointer; color: #2563eb;" id="openAddModal">+ Add New</h3>
    </div>
        <table id="studentsTable" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
    
    <!-- Edit Modal -->
    <div id="editModal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: skyblue; padding: 50px; border: 1px solid #ccc; z-index: 1000;">
        <h2>Edit Student</h2>
        <form id="editForm">
            <input type="hidden" id="editStudentId">
            <label for="editName">Name:</label>
            <input type="text" id="editName" required><br><br>
            <label for="editCourse">Course:</label>
            <input type="text" id="editCourse" required><br><br>
            <label for="editYearLevel">Year Level:</label>
            <input type="text" id="editYearLevel" required><br><br>
            <label for="editEmail">Email:</label>
            <input type="email" id="editEmail" required><br><br>
            <label for="editPhone">Phone:</label>
            <input type="text" id="editPhone" required><br><br>
            <label for="editAddress">Address:</label>
            <textarea id="editAddress" required></textarea><br><br>
            <button type="button" id="saveEdit">Save</button>
            <button type="button" id="closeModal">Cancel</button>
        </form>
    </div>

    <!-- Add Modal -->
    <div id="addModal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #f0f8ff; padding: 40px; border: 1px solid #ccc; z-index: 1000;">
        <h2>Add New Student</h2>
        <form id="addForm">
            <label for="addName">Name:</label>
            <input type="text" id="addName" required><br><br>
            <label for="addCourse">Course:</label>
            <input type="text" id="addCourse" required><br><br>
            <label for="addYearLevel">Year Level:</label>
            <input type="text" id="addYearLevel" required><br><br>
            <label for="addEmail">Email:</label>
            <input type="email" id="addEmail" required><br><br>
            <label for="addPhone">Phone:</label>
            <input type="text" id="addPhone" required><br><br>
            <label for="addAddress">Address:</label>
            <textarea id="addAddress" required></textarea><br><br>
            <button type="button" id="saveAdd">Add</button>
            <button type="button" id="closeAddModal">Cancel</button>
        </form>
    </div>


    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Fetch data from the students API
            fetch('http://localhost:8000/api/students') 
                .then(response => response.json())
                .then(data => {
                    let tableBody = '';
                    data.forEach((student, index) => {
                        tableBody += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${student.name}</td>
                                <td>${student.course}</td>
                                <td>${student.year_level}</td>
                                <td>${student.email}</td>
                                <td>${student.phone}</td>
                                <td>${student.address}</td>
                                <td style="text-align: center;">
                                    <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                        <button class="editBtn" data-id="${student.id}" data-name="${student.name}" 
                                            data-course="${student.course}" data-year_level="${student.year_level}" 
                                            data-email="${student.email}" data-phone="${student.phone}" data-address="${student.address}" 
                                            style="border: none; background: none; cursor: pointer; color: blue;">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none" 
                                            stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon 
                                            icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" />
                                            </svg> Edit
                                        </button>

                                        <button class="deleteBtn" data-id="${student.id}" 
                                            style="border: none; background: none; cursor: pointer; color: red;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" 
                                            d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                    document.querySelector('#studentsTable tbody').innerHTML = tableBody;
                    $('#studentsTable').DataTable(); // Initialize DataTables
                })
                .catch(error => {
                    console.error('Error fetching students:', error);
                });

            // Open Edit Modal
            document.addEventListener('click', function (event) {
                if (event.target.classList.contains('editBtn')) {
                    const studentId = event.target.getAttribute('data-id');
                    document.querySelector('#editStudentId').value = studentId;
                    document.querySelector('#editName').value = event.target.getAttribute('data-name');
                    document.querySelector('#editCourse').value = event.target.getAttribute('data-course');
                    document.querySelector('#editYearLevel').value = event.target.getAttribute('data-year_level');
                    document.querySelector('#editEmail').value = event.target.getAttribute('data-email');
                    document.querySelector('#editPhone').value = event.target.getAttribute('data-phone');
                    document.querySelector('#editAddress').value = event.target.getAttribute('data-address');
                    document.querySelector('#editModal').style.display = 'block';
                }
            });
            // Close Edit Modal
            document.querySelector('#closeModal').addEventListener('click', function () {
                document.querySelector('#editModal').style.display = 'none';
            });
            // Save Edited Data
            document.querySelector('#saveEdit').addEventListener('click', function () {
                const studentId = document.querySelector('#editStudentId').value;
                const updatedData = {
                    name: document.querySelector('#editName').value,
                    course: document.querySelector('#editCourse').value,
                    year_level: document.querySelector('#editYearLevel').value,
                    email: document.querySelector('#editEmail').value,
                    phone: document.querySelector('#editPhone').value,
                    address: document.querySelector('#editAddress').value,
                };

                fetch(`http://localhost:8000/api/students/update/${studentId}`, { 
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(updatedData),
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to update student');
                        }
                        return response.json();
                    })
                    .then(data => {
                        alert('Student updated successfully!');
                        location.reload(); // Reload the page to reflect changes
                    })
                    .catch(error => {
                        console.error('Error updating student:', error);
                        alert('Failed to update student.');
                    });
            });
            // Delete Student
            document.addEventListener('click', function (event) {
                if (event.target.classList.contains('deleteBtn')) {
                    const studentId = event.target.getAttribute('data-id');
                    if (confirm('Are you sure you want to delete this student?')) {
                        fetch(`http://localhost:8000/api/students/delete/${studentId}`, { // Replace with your API endpoint
                            method: 'DELETE',
                        })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Failed to delete student');
                                }
                                return response.json();
                            })
                            .then(data => {
                                alert('Student deleted successfully!');
                                location.reload(); // Reload the page to reflect changes
                            })
                            .catch(error => {
                                console.error('Error deleting student:', error);
                                alert('Failed to delete student.');
                            });
                    }
                }
            });
            // Open Add Modal
            document.querySelector('#openAddModal').addEventListener('click', function () {
                document.querySelector('#addModal').style.display = 'block';
            });

            // Close Add Modal
            document.querySelector('#closeAddModal').addEventListener('click', function () {
                document.querySelector('#addModal').style.display = 'none';
            });

            // Save New Student
            document.querySelector('#saveAdd').addEventListener('click', function () {
                const newStudent = {
                    name: document.querySelector('#addName').value,
                    course: document.querySelector('#addCourse').value,
                    year_level: document.querySelector('#addYearLevel').value,
                    email: document.querySelector('#addEmail').value,
                    phone: document.querySelector('#addPhone').value,
                    address: document.querySelector('#addAddress').value,
                };

                fetch('http://localhost:8000/api/students/create', { 
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(newStudent),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to add student');
                    }
                    return response.json();
                })
                .then(data => {
                    alert('Student added successfully!');
                    location.reload();
                })
                .catch(error => {
                    console.error('Error adding student:', error);
                    alert('Failed to add student.');
                });
            });

        });
    </script>   
</body>
</html>