<?php
// Connect to the database
$dbhost = 'yourdbip';
$dbname = 'yourdbname';
$dbuser = 'yoursqluser';
$dbpass = 'yoursqlpassword';
$db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the form data
  $title = $_POST['title'];
  $content = $_POST['content'];
  $password = $_POST['password'];

  // Check if the password is correct
  if ($password !== 'yourblogpasswordhere') {
    die('Incorrect password');
  }

  // Upload the image file
  $image = null;
  if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $image = $_FILES['image'];
    $allowed_exts = array('jpg', 'jpeg', 'png', 'gif');
    $image_ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    $image_name = uniqid() . '.' . $image_ext;

    if (!in_array($image_ext, $allowed_exts)) {
        die('Error: Invalid file format. Only JPG, JPEG, PNG and GIF files are allowed.');
    }

    if ($image['size'] > 89712398712398712398721398712983605712305) {
        die('Error: File size is too large. Maximum file size allowed is 2 MB.');
    }

    if (!is_writable('uploads/')) {
        die('Error: Destination folder is not writable by the server.');
    }

    if (move_uploaded_file($image['tmp_name'], 'uploads/' . $image_name)) {
        echo 'File was uploaded successfully!';
    } else {
        die("Error: Failed to move uploaded file. Either due to no permissions for the uploads/ folder or the folder isn't created");
    }
    } else {
    die('Error: No file was uploaded or an error occurred during file upload.');
}


  // Insert the blog post into the database
  $stmt = $db->prepare('INSERT INTO posts (title, content, image) VALUES (:title, :content, :image)');
  $stmt->execute([
    'title' => $title,
    'content' => $content,
    'image' => $image_name
  ]);

  // Redirect to the home page
  header('Location: index.php');
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>New Post</title>
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
    form {
      margin: 20px;
    }
    input, textarea {
      display: block;
      margin-bottom: 10px;
      padding: 5px;
      border: 1px solid #ccc;
      width: 100%;
      box-sizing: border-box;
    }
    button {
      display: block;
      margin-top: 20px;
      padding: 10px;
      background-color: #333;
      color: #fff;
      border: none;
      cursor: pointer;
    }
    button:hover {
      background-color: #555;
    }
  </style>
</head>
<body>
  <header>
    <h1>Abhidjt</h1>
  </header>
  <form method="post" enctype="multipart/form-data">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" required>

    <label for="content">Content</label>
    <textarea name="content" id="content" rows="10" required></textarea>

    <label for="image">Image</label>
    <input type="file" name="image" id="image">

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>

    <button type="submit">Submit</button>
  </form>
  <footer>
    <p>&copy; DJT INC</p>
  </footer>
</body>
</html>
