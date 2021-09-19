<?php include('./config/constant.php') ?>

<?php
    $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<?php 
    include('../config/constant.php');
    include('login-check.php');
?>
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="<?php echo HOMEURL;?>css/font-awesome.css">
    <!-- <link rel="stylesheet" href="<?php echo HOMEURL;?>css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
    <!-- Navbar Section Starts Here -->
<section class="navigation">
  <div class="nav-container">
    <div class="brand">
                <a href="<?php echo HOMEURL; ?>" title="Logo">
                    <img src="<?php echo HOMEURL; ?>images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
    </div>
    <nav>
      <div class="nav-mobile"><a id="nav-toggle" href="#!"><span></span></a></div>
      <ul class="nav-list">
        <li>
          <a href="<?php echo HOMEURL; ?>">Home</a>
        </li>
        <li>
          <a href="<?php echo HOMEURL; ?>categories.php">categories</a>
        </li>
        <li>
          <a href="<?php echo HOMEURL; ?>foods.php">foods</a>
        </li>
        <li>
          <a href="#!"><?php echo $username;?></a>
          <ul class="nav-dropdown">
            <li>
              <a href="<?php echo HOMEURL; ?>user-order.php">My order</a>
            </li>
            <li>
              <a href="<?php echo HOMEURL; ?>/logout.php">logout</a>
            </li>
          </ul>
        </li>
        <!-- <li>
          <?php
          $count_item = 0;
          if(isset($_SESSION['cart'])){
            $count_item = count($_SESSION['cart']);
          }
          ?>
          <a href="<?php echo HOMEURL; ?>mycart.php"><i class="fa fa-shopping-bag"></i><span id="cart-item" class="badge"><?php echo $count_item; ?></span></a>
        </li> -->
      </ul>
    </nav>
  </div>
</section>
    <!-- Navbar Section Ends Here -->


<script src="<?php echo HOMEURL; ?>partials/jquery.min.js"></script>

<script defer>
    (function($) { // Begin jQuery
  $(function() { // DOM ready
    // If a link has a dropdown, add sub menu toggle.
    $('nav ul li a:not(:only-child)').click(function(e) {
      $(this).siblings('.nav-dropdown').toggle();
      // Close one dropdown when selecting another
      $('.nav-dropdown').not($(this).siblings()).hide();
      e.stopPropagation();
    });
    // Clicking away from dropdown will remove the dropdown class
    $('html').click(function() {
      $('.nav-dropdown').hide();
    });
    // Toggle open and close nav styles on click
    $('#nav-toggle').click(function() {
      $('nav ul').slideToggle();
    });
    // Hamburger to X toggle
    $('#nav-toggle').on('click', function() {
      this.classList.toggle('active');
    });
  }); // end DOM ready
})(jQuery); // end jQuery
</script>