<?php
// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sujet"; // Le nom de votre base de données

try {
    // Connexion à la base de données MySQL via PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configuration des options PDO pour afficher les erreurs de requête SQL
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour sélectionner toutes les entrées de la table "topic"
    $sql = "SELECT id, title, resume, speciality, professeur FROM topic";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Récupérer les résultats de la requête SQL
    $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Vérifier si des données ont été récupérées
    if (!$topics) {
        throw new Exception("Aucune donnée n'a été récupérée de la base de données.");
    }
} catch(PDOException $e) {
    echo "Erreur PDO : " . $e->getMessage();
} catch(Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Code</title>
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
  <link rel="stylesheet" href="exx.css">
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
        <tbody id="wishListTable"></tbody>
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

<script>
  let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let searchBtn = document.querySelector(".bx-search");
closeBtn.addEventListener("click", () => {
  sidebar.classList.toggle("open");
  menuBtnChange(); //calling the function(optional)
});
searchBtn.addEventListener("click", () => {
  // Sidebar open when you click on the search iocn
  sidebar.classList.toggle("open");
  menuBtnChange(); //calling the function(optional)
});
// following are the code to change sidebar button(optional)
function menuBtnChange() {
  if (sidebar.classList.contains("open")) {
    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
  } else {
    closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
  }
}

  let wishList = [];

  function addToWishList(element) {
    const row = element.closest('tr');
    const theme = row.querySelector('td:nth-child(2)').textContent;
    const professor = row.querySelector('td:nth-child(3)').textContent;
    const description = row.querySelector('td:nth-child(5)').textContent;

    const item = {
        theme,
        professor,
        description
    };

    // أضف العنصر إلى قائمة الرغبات
    wishList.push(item);

    // إضافة العنصر إلى قاعدة البيانات
    saveWishItemToDatabase(item);

    alert('Item added to Wish sheet');
    populateWishListTable();
}

function saveWishItemToDatabase(item) {
    // إرسال العنصر المحدد إلى الخادم باستخدام AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'save_wish_item.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log('Wish item saved successfully.');
            } else {
                console.error('Error saving wish item.');
            }
        }
    };
    xhr.send(JSON.stringify(item));
}


  function populateWishListTable() {
    const tableBody = document.getElementById('wishListTable');
    tableBody.innerHTML = '';

    wishList.forEach((item, index) => {
        const row = document.createElement('tr');

        const themeCell = document.createElement('td');
        themeCell.textContent = item.theme;
        row.appendChild(themeCell);

        const professorCell = document.createElement('td');
        professorCell.textContent = item.professor;
        row.appendChild(professorCell);

        const descriptionCell = document.createElement('td');
        descriptionCell.textContent = item.description;
        row.appendChild(descriptionCell);

        const priorityCell = document.createElement('td');
        priorityCell.textContent = index + 1;
        row.appendChild(priorityCell);

        const operationCell = document.createElement('td');
        const deleteButton = document.createElement('button');
        deleteButton.innerHTML = '&#128465;'; // رمز القمامة
        deleteButton.addEventListener('click', () => {
            deleteFromWishList(index);
        });
        operationCell.appendChild(deleteButton);
        row.appendChild(operationCell);

        tableBody.appendChild(row);
    });
}

  function deleteFromWishList(index) {
    wishList.splice(index, 1);
    populateWishListTable();
  }

  function searchTopics(keyword) {
    var table = document.querySelector(".home-section#topics .-table");
    var rows = table.getElementsByTagName("tr");
    var originalDisplay = [];

    for (var i = 0; i < rows.length; i++) {
      originalDisplay[i] = rows[i].style.display;
    }

    var found = false;
    for (var i = 0; i < rows.length; i++) {
      var cells = rows[i].getElementsByTagName("td");
      var rowFound = false;
      for (var j = 0; j < cells.length; j++) {
        var cellText = cells[j].textContent || cells[j].innerText;
        if (cellText.toUpperCase().includes(keyword.toUpperCase())) {
          rows[i].style.display = "";
          rowFound = true;
          found = true;
          break;
        }
      }
      if (!rowFound) {
        rows[i].style.display = "none";
      }
    }

    if (!found) {
      alert("No matching topics found.");
      for (var i = 0; i < rows.length; i++) {
        rows[i].style.display = originalDisplay[i];
      }
    }
  }

  function showPFEList() {
    document.querySelector(".home-section#topics").style.display = "block";
    document.querySelector(".home-section#wishSheetSection").style.display = "none";
  }

  function toggleWishSheet(){
    document.querySelector(".home-section#topics").style.display = "none";
    document.querySelector(".home-section#wishSheetSection").style.display = "block";
  }

  // دالة تظهر مربع البحث
  function showSearchBox() {
    document.getElementById("searchModal").style.display = "block";
  }

  // دالة تخفي مربع البحث
  function hideSearchBox() {
    document.getElementById("searchModal").style.display = "none";
  }
</script>
</body>
</html>



