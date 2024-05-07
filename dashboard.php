<?php
  session_start();
  require_once('config/db.php');
  $email_loggin = $_SESSION['email'];
  $sql = "SELECT * FROM topic";
  $sql_wishsheet = "SELECT * FROM wishsheet WHERE email='$email_loggin'";
  $result = mysqli_query($conn, $sql);
  $result_wisheet = mysqli_query($conn, $sql_wishsheet);
  // Récupérer les résultats de la requête SQL
  $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $whishsheet = mysqli_fetch_all($result_wisheet, MYSQLI_ASSOC);
  // Vérifier si des données ont été récupérées
  if (!$topics) {
      throw new Exception("Aucune donnée n'a été récupérée de la base de données.");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Code</title>
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
  <link rel="stylesheet" href="css/topics-style.css">
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
      <a href="#" onclick="showPFEList()">
        <i class='bx bx-list-ul'></i>
        <span class="links_name">  The Subjects</span>
      </a>
      <span class="tooltip"> The Subjects </span>
    </li>
    <li>
      <a href="#" onclick="toggleWishSheet()">
        <i class='bx bx-notepad'></i>
        <span class="links_name">Wish Sheet</span>
      </a>
      <span class="tooltip">Wish sheet</span>
    </li>
    
    <li>
      <a href="#">
        <i class='bx bx-check-square'></i>
        <span class="links_name"> Assignment </span>
      </a>
      <span class="tooltip"> Assignment </span>
    </li>
    <li>
      <a href="#">
        <i class='bx bx-cog'></i>
        <span class="links_name">Setting</span>
      </a>
      <span class="tooltip">Setting</span>
    </li>
    <li>
      <a href="index.php" class="back-btn">
        <i class='bx bx-arrow-back'></i>
        <span class="links_name" >Back</span>
      </a>
      <span class="tooltip" >Back</span>
    </li>
  </ul>
</div>
<section class="home-section" id="topics" style="display: none;">
    <div class="text">List of topics : </div>
    <p>     Please Choose Your Topics In Order 
       <span>&#x1F4CB;</span>
    </p>
    <!-- جدول البيانات -->
    <table class="-table">
        <thead>
          <tr>
            <th>Id</th>
            <th>TITLE</th>
            <th>Description</th>
            <th>SPECIALITY</th>
            <th>Professor</th>
            <th>OPTION</th>
          </tr> 
        </thead>
        <?php foreach ($topics as $topic): ?>
        <tr>
            <td><?php echo $topic['id']; ?></td>
            <td><?php echo $topic['title']; ?></td>
            <td><?php echo $topic['resume']; ?></td>
            <td><?php echo $topic['speciality']; ?></td>
            <td><?php echo $topic['professeur']; ?></td>
            <td>
                <a href="#" onclick="addToWishList(this)"><i class='bx bx-plus'></i></a></td>
    
        </tr>
    <?php endforeach; ?>
              </table>
        </section>
    </div>
<section class="home-section" id="wishSheetSection" style="display: none;">
      <div class="text">Wish Sheet</div>
      <table class="-table">
      <thead>
          <tr>
           
            <th>TITLE</th>
            <th>Description</th>
            <th>Professor</th>
            <th>Priority</th>
            <th>Operation</th>
          </tr>
        </thead>
        <tbody id="wishListTable">
        <?php foreach ($whishsheet as $w): ?>
<tr>

    <td><?php echo $w['theme']; ?></td>
    <td><?php echo $w['description']; ?></td>
    <td><?php echo $w['professor']; ?></td>
    <td><?php echo $w['priority']; ?></td>
    <td>
    <button onclick="deleteFromWishList(<?php echo $w['id']; ?>)"><i class='bx bx-trash'></i></button>
</td>
</tr>
<?php endforeach; ?>

        </tbody>
      </table>
</section>

<!-- الجزء الجديد لمربع البحث -->
<div id="searchModal" class="search-modal" style="display: none;">
  <div class="search-box">
    <input type="text" id="searchInput" placeholder="Enter search keyword...">
    <button onclick="searchTopics(document.getElementById('searchInput').value)">Search</button>
    <button onclick="hideSearchBox()">Close</button>
  </div>
</div>

<script src="js/dashboard.js"></script>
</body>
</html>