<?php
// Connect to the database
$dbhost = 'yourdbip';
$dbname = 'yourdbname';
$dbuser = 'yoursqluser';
$dbpass = 'yoursqlpassword';
$db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

// Get the post with the specified ID from the database
$id = $_GET['id'];
$stmt = $db->prepare('SELECT * FROM posts WHERE id = :id');
$stmt->execute([':id' => $id]);
$post = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $post['title']; ?></title>
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
      margin-top: 30px;
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
  <header>Abhidjt</header>
    <h1><?php echo $post['title']; ?></h1>
  <div class="container">
    <div class="post">
      <?php if(!empty($post['image'])): ?>
  <img src="uploads/<?php echo $post['image']; ?>" alt="Post Image"><br>
        <?php endif; ?>

      <small><?php echo $post['date']; ?></small>
      <p><?php echo $post['content']; ?></p>
    </div>
  </div>
  <footer>
    <p>&copy; DJT INC</p>
  </footer>
</body>
</html>