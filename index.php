<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';
$auth = new Auth();
include 'includes/header.php';
?>

<h2>Welcome to <?php echo APP_NAME; ?>!</h2>
<p>This is the home page of your To-Do List App.</p>

<?php if ($auth->isLoggedIn()): ?>
    <p>Hello, <strong><?php echo $_SESSION['name']; ?></strong>! 
    You can go to your <a href="<?php echo BASE_URL; ?>user/dashboard.php">Dashboard</a>.</p>
<?php else: ?>
    <p><a href="<?php echo BASE_URL; ?>auth/login.php">Login</a> or 
    <a href="<?php echo BASE_URL; ?>auth/register.php">Register</a> to start managing your tasks.</p>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
