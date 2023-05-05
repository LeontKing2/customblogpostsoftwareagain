<?php
// Connect to the database
$dbhost = 'yourdbip';
$dbname = 'yourdbname';
$dbuser = 'yoursqluser';
$dbpass = 'yoursqlpassword';
$db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

// Get all the blog posts from the database
$stmt = $db->query('SELECT * FROM posts ORDER BY date DESC');
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Blog</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #333;
      color: #fff;
      padding: 10px;
      text-align: center;
    }
    footer {
      background-color: #333;
      color: #fff;
      padding: 10px;
      text-align: center;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
    h1 {
      margin-top: 0;
    }
    .post {
      margin-bottom: 30px;
      padding: 10px;
      border: 1px solid #ccc;
    }
    .post h2 {
      margin-top: 0;
    }
    .post small {
      font-size: 12px;
      color: #999;
    }
  </style>
</head>
<body>
  <header>
    <h1>Abhidjt</h1>
  </header>
  <div class="container">
    <?php foreach ($posts as $post): ?>
      <div class="post">
        <h2><a href="view.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
        <small><?php echo $post['date']; ?></small>
      </div>
    <?php endforeach; ?>
  </div>
  <footer>
    <p>&copy; DJT INC</p>
  </footer>
</body>
</html>
