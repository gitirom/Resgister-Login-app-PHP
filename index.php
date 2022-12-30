<?php 
//all thes working only if we loged in

  session_start();   //after you creat the sessions you need to put session_start function 
  if(isset($_SESSION['userId'])){
    require('./config/db.php');   //if the user loged in require the connection 

    $userId = $_SESSION['userId']; // 6

    $stmt = $pdo -> prepare('SELECT * FROM users WHERE id = ?');
    $stmt -> execute([ $userId ]);

    $user = $stmt -> fetch();

    if($user -> role === 'geust'){
      $message = "your role is a Geust" ;
    }
    
  }
  
?>

<?php require('./includes/header.html'); ?>

<div class="container">
  <div class="card bg-light mb-3">
    <div class="card-header">
      <?php if(isset($user)){ ?>
        <h5>Welcom <?php echo $user->name ?></h5> 

        
        <?php }else { // if is not log in?>
          <h5>Welcom Geust</h5>
          <?php } ?>
      
    </div>
    <div class="card-body">
      
      <?php if(isset($user)){ ?>
        <h5>this is a super secret content only for logged peaple</h5> 

           <?php }else { ?>
            <h4>Please Login/Resgister to unlock all content</h4>
          <?php } ?>
    </div>
  </div>
</div>

<?php require('./includes/foter.html') ?>
    
   