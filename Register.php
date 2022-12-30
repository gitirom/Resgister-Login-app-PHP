<?php 
  if(isset($_POST['register'])){
    require('./config/db.php');  //include connection file


    // $userName = $_POST['userName'];
    // $userEmail = $_POST['userEmail'];
    // $Password = $_POST['password'];

    //sanitizing the data for sucurety
    $userName = filter_var( $_POST['userName'], FILTER_SANITIZE_STRING );
    $userEmail = filter_var( $_POST['userEmail'], FILTER_SANITIZE_EMAIL );
    $Password = filter_var( $_POST['password'], FILTER_SANITIZE_STRING );

    //hashed the password

    $passwordHashed = password_hash($Password, PASSWORD_DEFAULT);
    
    //validate is thes is actuly an email = true or false

    if( filter_var($userEmail, FILTER_SANITIZE_EMAIL) ){       //for no have sql injection
      $stmt = $pdo -> prepare('SELECT * from users WHERE email = ? ');     //do not put the $username value in email just put it in a execute function . 
      $stmt -> execute([$userEmail]);
      $totalUsers = $stmt -> rowCount();       //thes is for count the number of user of thes email on the first register 0
    }

    //insert part .

    if($totalUsers > 0){

      $emailtaken =  "Email alredy benn taken";       //if email exist > 0 echo
    }else{                                                                      //for no have sql injection for securety       
      $stmt = $pdo -> prepare('INSERT into users(name, email, password) VALUES(? , ? , ?) ');
      $stmt -> execute( [$userName, $userEmail, $passwordHashed] );
      header('Location: http://127.0.0.1/LOGIN-PROJECT/index.php');

    }


  }
  
?>

    <?php require('./includes/header.html'); ?>

    <div class="container"><!-- all classes is a bootsstrap  -->
    <div class="card">
      <div class="card-header bg-light mb-3"> Register  </div>
      <div class="card-body ">
        <form action="register.php" method="POST">
          <div class="form-group">
            <label for="userName">User Name </label>
            <input  type="text" name="userName" class="form-control" />

          </div>
          <div class="form-group">
            <label for="userEmail">User Email </label>
            <input required type="email" name="userEmail" class="form-control" />
            <br/>
            <?php if(isset($emailtaken)){ ?>
              <p style="color:red"><?php echo $emailtaken ?></p>
           <?php } ?>
          </div>
          <div class="form-group">
            <label for="password"> User Password</label>
            <input required type="password" name="password" class="form-control" />
          </div> <!-- required when you submit with a void form they show you an alert -->
          <button name="register" type="submit" class="btn btn-primary">Register</button>
        </form> 
      </div>

    </div>
    </div>

    <?php require('./includes/foter.html') ?>