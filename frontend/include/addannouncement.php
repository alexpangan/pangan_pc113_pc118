<!-- filepath: c:\wamp64\www\parentportal\frontend\include\announcement.php -->
<div class="announcement-section">
  
  <ul id="announcementList">
    <!-- Announcements will be dynamically loaded here -->
  </ul>
  <button onclick="openAnnouncementModal()">Add Announcement</button>

  <!-- Announcement Modal -->
  <div id="announcementModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeAnnouncementModal()">&times;</span>
      <h2>Add Announcement</h2>
      <form id="announcementForm" method="POST" action="/add-announcement">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required />
        <label for="who">Who:</label>
        <input type="text" id="who" name="who" required />
        <label for="what">What:</label> 
        <input type="text" id="what" name="what" required />
        <label for="when">When:</label>
        <input type="datetime-local" id="when" name="when" required />
        <label for="where">Where:</label>
        <input type="text" id="where" name="where" required />
        <label for="why">Why:</label>
        <input type="text" id="why" name="why" required />
        <label for="organizer">Organizer:</label>
        <input type="text" id="organizer" name="organizer" required />
        <button type="submit">Submit</button>
      </form>
    </div>
  </div>
</div>

<style>
  .announcement-section {
  padding: 20px;
  border-radius: 8px;
  color: black; /* Make all text black inside section */
}

.announcement-section h2 {
  margin-bottom: 15px;
}

.announcement-section ul {
  list-style-type: none;
  padding: 0;
}

.announcement-section ul li {
  background-color: #fff;
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  color: black; /* Black text in list items */
}

.announcement-section button {
  background-color: white;
  color: black;
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

/* .announcement-section button:hover {
  background-color: #1273c4;
} */

.modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
  background-color: #fff;
  margin: 10% auto;
  padding: 20px;
  border-radius: 8px;
  width: 50%;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  color: black; /* Make all modal text black */
}

.modal-content h2 {
  margin-bottom: 20px;
  color: black;
}

.modal-content label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
  color: black;
}

.modal-content input,
.modal-content textarea {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
  color: black; /* Make input text black */
}

.modal-content button {
  background-color: #185a9d;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.modal-content button:hover {
  background-color: #1273c4;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover {
  color: black;
}

</style>

<script>
  function openAnnouncementModal() {
    document.getElementById("announcementModal").style.display = "block";
  }

  function closeAnnouncementModal() {
    document.getElementById("announcementModal").style.display = "none";
  }

  window.onclick = function (event) {
    const modal = document.getElementById("announcementModal");
    if (event.target === modal) {
      modal.style.display = "none";
    }
  };

  // Example: Fetch announcements dynamically (replace with your API endpoint)
  document.addEventListener("DOMContentLoaded", function () {
    fetch('/api/announcements') // Replace with your API endpoint
      .then(response => response.json())
      .then(data => {
        const announcementList = document.getElementById("announcementList");
        data.forEach(announcement => {
          const li = document.createElement("li");
          li.textContent = `${announcement.title}: ${announcement.body}`;
          announcementList.appendChild(li);
        });
      })
      .catch(error => console.error('Error fetching announcements:', error));
  });
</script>