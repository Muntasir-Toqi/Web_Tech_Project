<h2>Admin Dashboard</h2>

<h3>System Statistics</h3>
<ul>
    <li>Total Tasks: <?= $stats['total_tasks'] ?></li>
    <li>Completed Tasks: <?= $stats['completed_tasks'] ?></li>
    <li>Pending Tasks: <?= $stats['pending_tasks'] ?></li>
    <li>Active Users: <?= $stats['active_users'] ?></li>
</ul>

<h3>Manage Customers</h3>

<!-- Add Customer -->
<form method="post" action="<?= BASE_URL ?>/public/index.php?p=admin/addCustomer">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Add Customer</button>
</form>

<!-- List Customers -->
<ul>
    <?php foreach ($customers as $c): ?>
        <li>
            <?= htmlspecialchars($c['username']) ?> (<?= $c['email'] ?>) [<?= $c['status'] ?>]
            <!-- Edit -->
            <form method="post" action="<?= BASE_URL ?>/public/index.php?p=admin/editCustomer" style="display:inline;">
                <input type="hidden" name="id" value="<?= $c['id'] ?>">
                <input type="text" name="username" value="<?= htmlspecialchars($c['username']) ?>">
                <input type="email" name="email" value="<?= htmlspecialchars($c['email']) ?>">
                <select name="status">
                    <option value="active" <?= $c['status']=='active'?'selected':'' ?>>Active</option>
                    <option value="inactive" <?= $c['status']=='inactive'?'selected':'' ?>>Inactive</option>
                </select>
                <button type="submit">Update</button>
            </form>
            <!-- Delete -->
            <a href="<?= BASE_URL ?>/public/index.php?p=admin/deleteCustomer&id=<?= $c['id'] ?>" onclick="return confirm('Delete this customer?');">Delete</a>
        </li>
    <?php endforeach; ?>
</ul>

<h3>Organizations</h3>
<ul>
    <?php foreach ($orgs as $o): ?>
        <li><?= htmlspecialchars($o['name']) ?></li>
    <?php endforeach; ?>
</ul>

<h3>System Logs</h3>
<ul>
    <?php foreach ($logs as $log): ?>
        <li>[<?= $log['created_at'] ?>] <?= htmlspecialchars($log['user_email']) ?> → <?= htmlspecialchars($log['action']) ?> (<?= $log['success'] ? "✔" : "✖" ?>)</li>
    <?php endforeach; ?>
</ul>
