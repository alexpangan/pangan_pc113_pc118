<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="store">
        <div class="container">
            <h2>Announcement</h2>
            <table id="activitiesTable" class="display">
                <thead>
                    <tr>
                        <th>Activity Title</th>
                        <th>Who</th>
                        <th>What</th>
                        <th>When</th>
                        <th>Where</th>
                        <th>Why</th>
                        <th>Organizer</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be populated dynamically -->
                </tbody>
            </table>
        </div>
    </div>

<!-- Include jQuery and DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        // Initialize DataTable
        const table = $('#activitiesTable').DataTable({
            responsive: true,
            pageLength: 10
        });

        // Fetch announcements from backend API
        $.ajax({
            url: 'http://localhost:8000/api/announcements', // Replace with actual API URL
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (Array.isArray(data)) {
                    data.forEach(activity => {
                        table.row.add([
                            activity.title ?? 'N/A',
                            activity.who ?? 'N/A',
                            activity.what ?? 'N/A',
                            activity.when ?? 'N/A',
                            activity.where ?? 'N/A',
                            activity.why ?? 'N/A',
                            activity.organizer ?? 'N/A'
                        ]).draw(false);
                    });
                } else {
                    console.warn('Invalid data format from API');
                }
            },
            error: function(err) {
                console.error('Failed to fetch announcements:', err);
                alert('Error loading announcements. Please check the console for details.');
            }
        });
    });
</script>
</body>
</html>