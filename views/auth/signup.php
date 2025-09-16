<h2>Sign Up</h2>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post" action="">
    <label>Username:</label>
    <input type="text" name="username" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Password:</label>
    <input type="password" name="password" required>
    <label>Role:</label>
    <select name="role" required>
        <option value="customer">User</option>
        <option value="organization">Organization</option>
        <option value="admin">Admin</option>
    </select>
    <button type="submit">Sign Up</button>
</form>
