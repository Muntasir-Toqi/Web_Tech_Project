<!DOCTYPE html>
<html>
<head>
    <title>To Do List</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/styles.css">
</head>
<body>
<header>
    <h1>To Do List</h1>
     <nav>
        <?php if (!isset($_SESSION['user'])): ?>
            <a href="<?= BASE_URL ?>/public/index.php?p=auth/login">Login</a>
            <a href="<?= BASE_URL ?>/public/index.php?p=auth/signup">Sign Up</a>
        <?php else: ?>
            <a href="<?= BASE_URL ?>/public/index.php?p=home/index">Dashboard</a>
            <a href="<?= BASE_URL ?>/public/index.php?p=user/profile">Profile</a>
            <a href="<?= BASE_URL ?>/public/index.php?p=auth/logout">Logout</a>
        <?php endif; ?>
    </nav>
</header>
<main>
