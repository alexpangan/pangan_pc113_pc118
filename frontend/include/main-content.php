<?php include 'include/styles.php'; ?>
<div class="main-content">
  
  <!-- Dashboard Cards -->
  <div class="dashboard-cards">
    <div class="card" onclick="openAnnouncementModal()">
      <h3>Announcement</h3>
    </div>
  </div>

  <!-- Announcement Modal -->
  <div id="announcementModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeAnnouncementModal()">&times;</span>
      <h2>Add Announcement</h2>
      <form id="announcementForm" method="POST" action="/add-announcement">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required />
        <label for="body">Body:</label>
        <textarea id="content" name="content" rows="5" required></textarea>
        <button type="submit">Submit</button>
      </form>
    </div>
  </div>
</div>