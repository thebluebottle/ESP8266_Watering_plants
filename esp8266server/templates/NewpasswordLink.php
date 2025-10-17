<?php





?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create New Password - Watering App</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f7f8;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      background: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }
    h2 {
      margin-bottom: 1.5rem;
      text-align: center;
      color: #333;
    }
    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: bold;
    }
    input[type="password"], input[type="hidden"] {
      width: 100%;
      padding: 0.75rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }
    button {
      width: 100%;
      padding: 0.75rem;
      border: none;
      border-radius: 5px;
      background: #28a745;
      color: #fff;
      font-size: 1rem;
      cursor: pointer;
    }
    button:hover {
      background: #218838;
    }
    .note {
      margin-top: 1rem;
      font-size: 0.9rem;
      color: #666;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Create New Password</h2>
    <form method="POST" action="<?php $_SERVER["PHP_SELF"];?>">
      <!-- Hidden field with token -->
      <input type="password" name="password_1" placeholder="new password" class="password_field">

      <input type="password" name="password_2" placeholder="confirm password" class="password_field">

      <input type="submit" value="save" class="button">

      <input type="hidden" value="<?php echo $_GET["token"];?>" name="token">

    </form>
    <div class="note">
      Please choose a strong password that you haven’t used before.
    </div>
  </div>
</body>
</html>
