<h2>Profile Settings</h2>

<form method="post" action="">
    <label>Username:</label>
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

    <label>New Password (leave blank to keep current):</label>
    <input type="password" name="password">

    <button type="submit">Update Profile</button>
</form>
