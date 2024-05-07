<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Code</title>
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
  <link rel="stylesheet" href="css/prof-style.css">
</head>
<body>
<div class="sidebar">
  <div class="logo-details">
    <div class="logo_name"> Options </div>
    <i class='bx bx-menu' id="btn"></i>
  </div>
  <ul class="nav-list">
    <li>
      <button onclick="showSearchBox()"><i class='bx bx-search'></i> Search</button>
      <span class="tooltip">Search</span>
    </li> 
    <li>
        <a href="#" onclick="addTopic()">
          <i class='bx bx-plus'></i>
          <span class="links_name">Add a Subject</span>
        </a>
        <span class="tooltip">Add a Subject</span>
      </li>
      
    <li id="subjectsLink"> <!-- Added id attribute -->
      <a href="#" onclick="showSubjects()">
        <i class='bx bx-list-ul'></i>
        <span class="links_name"> The Subjects </span>
      </a>
      <span class="tooltip"> The Subjects </span>
    </li>      
    
    <li>
      <a href="#">
        <i class='bx bx-cog'></i>
        <span class="links_name">Setting</span>
      </a>
      <span class="tooltip">Setting</span>
    </li>
    <li>
      <a href="#" class="back-btn">
        <i class='bx bx-arrow-back'></i>
        <span class="links_name">Back</span>
      </a>
      <span class="tooltip">Back</span>
    </li>
  </ul>
</div>
<section class="home-section">
    <div class="text">List of topics : </div>
    <table id="topicsTable" class="-table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Theme</th>
            <th>Professor</th>
            <th>Description</th>
            <th>Operations</th>
          </tr>
        </thead>
        <tbody>
          <!-- Topics will be displayed here -->
        </tbody>
    </table>
</section>

<!-- Form to add a new subject -->
<div id="addSubjectForm" style="display: none;">
  <h2>Add a New Subject</h2>
  <form id="subjectForm">

    <label for="theme">Theme:</label><br>
    <input type="text" id="theme" name="theme" required><br>
    <label for="professor">Professor:</label><br>
    <input type="text" id="professor" name="professor" required><br>
    <label for="description">Description:</label><br>
    <textarea id="description" name="description" required></textarea><br><br>
    <input type="button" value="Submit" onclick="submitTopic()">
    <input type="button" value="Cancel" onclick="hideAddSubjectForm()">
  </form>
</div>

<div id="searchModal" class="search-modal">
    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Enter search keyword...">
        <button onclick="searchTopics(document.getElementById('searchInput').value)">Search</button>
        <button onclick="hideSearchBox()">Close</button>
    </div>
</div>
   
<script src="js/prof.js"></script>
</body>
</html>