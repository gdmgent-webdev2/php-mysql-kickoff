<!DOCTYPE html>
<html>
  <head>
    <title>Very Simple PHP Application</title>
  </head>
  <body>
    
    <h1>Simpele zoekapplicatie</h1>

    <!-- (A) SEARCH FORM -->
    <form method="post">
      <input type="text" name="search" required/>
      <input type="submit" value="Zoeken"/>
    </form>
    <br>
    
    <!-- (B) SEARCH + SHOW RESULTS -->
    <div id="results"><?php
        // (B1) DATABASE SETTINGS - CHANGE TO YOUR OWN!
        define('DB_HOST', 'localhost');
        define('DB_NAME', 'names');
        define('DB_USER', 'root');
        define('DB_PASSWORD', 'secret');
        
        // (B2) CONNECT TO DATABASE
        $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";", DB_USER, DB_PASSWORD);
        
        // (B3) SEARCH 
        $search = (isset($_POST['search']) ? $_POST['search'] : '');
        $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `name` LIKE ?");
        $stmt->execute(["%{$search}%"]);
        $results = $stmt->fetchAll();
        
        // (B4) OUTPUT
        if (count($results)>0) { foreach ($results as $r) {
          echo "<div>{$r['id']} - {$r['name']}</div>";
        }}
    ?></div>
  </body>
</html>