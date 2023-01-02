<?php

  if(isset( $_POST['register'])) {
    require('./config/db.php');
    
    // $userName = $_POST["userName"];
    // $userEmail = $_POST["userEmail"];
    // $password = $_POST["password"];
    $userName = filter_var( $_POST["userName"], FILTER_SANITIZE_STRING );
    $userEmail = filter_var( $_POST["userEmail"], FILTER_SANITIZE_EMAIL);
    $password = filter_var( $_POST["password"], FILTER_SANITIZE_STRING );
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    if( filter_var($userEmail, FILTER_VALIDATE_EMAIL) ) {
      $stmt = $pdo -> prepare('SELECT * from users WHERE email = ? ');
      $stmt -> execute([$userEmail]);
      $totalUsers = $stmt -> rowCount();

      // echo $totalUsers . '<br >';

      if( $totalUsers > 0 ) {
        // echo "Email already been taken <br>";
        $emailTaken = "Email already been taken";
      } else {
        $stmt = $pdo -> prepare('INSERT into users(name, email, password) VALUES(? , ?, ? ) ');
        $stmt -> execute( [ $userName, $userEmail, $passwordHashed] );
        header('Location: http://localhost/login-project/index.php');
      }
    }


    // echo $userName . " " . $userEmail . " " . $password;
  }
?>

  <?php require('./includes/header.html'); ?>


  <div class="container">
    <div class="card">
      <div class="card-header bg-light mb-3">Register</div>
      <div class="card-body">
        <form action="register.php" method="POST">

          <div class="form-group">
            <label for="userName">User Name</label>
            <input required type="text" name="userName" class="form-control" />
          </div>
          <div class="form-group">
            <label for="userEmail">User Email</label>
            <input required type="email" name="userEmail" class="form-control" />
            <br />
            <?php if(isset($emailTaken)) { ?>
              <p style="background-color: red"><?php echo $emailTaken?></p>
            <?php } ?>
          </div>
          <div class="form-group">
            <label for="password">User Password</label>
            <input required type="password" name="password" class="form-control" />
          </div>
          <button name="register" type="submit" class="btn btn-primary">Register</button>
        </form>
      </div>
    </div>
  </div>

  <?php require('./includes/foter.html'); ?>