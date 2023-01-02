<?php
  session_start();

  if(isset( $_POST['login'])) {
    require('./config/db.php');
    
    $userEmail = filter_var( $_POST["userEmail"], FILTER_SANITIZE_EMAIL);
    $password = filter_var( $_POST["password"], FILTER_SANITIZE_STRING );
   

    $stmt = $pdo -> prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$userEmail]);
    $user = $stmt -> fetch();

    if( isset($user) ) {
      if( password_verify($password, $user -> password )) {
        echo "The password is correct";
        $_SESSION['userId'] = $user->id;
        header('Location: http://localhost/login-project/index.php');
      } else {
        // echo "The login email or password is wrong";
        $wrongLogin = "The login email or password is wrong";
      }
    }
    // if( filter_var($userEmail, FILTER_VALIDATE_EMAIL) ) {
    //   $stmt = $pdo -> prepare('SELECT * from users WHERE email = ? ');
    //   $stmt -> execute([$userEmail]);
    //   $totalUsers = $stmt -> rowCount();

    //   // echo $totalUsers . '<br >';

    //   if( $totalUsers > 0 ) {
    //     // echo "Email already been taken <br>";
    //     $emailTaken = "Email already been taken";
    //   } else {
    //     $stmt = $pdo -> prepare('INSERT into users(name, email, password) VALUES(? , ?, ? ) ');
    //     $stmt -> execute( [ $userName, $userEmail, $passwordHashed] );
    //   }
    // }


    // echo $userName . " " . $userEmail . " " . $password;
  }
?>

  <?php require('./includes/header.html'); ?>


  <div class="container">
    <div class="card">
      <div class="card-header bg-light mb-3">Register</div>
      <div class="card-body">
        <form action="login.php" method="POST">
          <div class="form-group">
            <label for="userEmail">User Email</label>
            <input required type="email" name="userEmail" class="form-control" />
            <br />
            <?php if(isset($wrongLogin)) { ?>
              <p style="background-color: red"><?php echo $wrongLogin ?></p>
            <?php } ?>
          </div>
          <div class="form-group">
            <label for="password">User Password</label>
            <input required type="password" name="password" class="form-control" />
          </div>
          <button name="login" type="submit" class="btn btn-primary">Login</button>
        </form>
      </div>
    </div>
  </div>

  <?php require('./includes/foter.html'); ?>