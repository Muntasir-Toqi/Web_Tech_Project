<h2>Organization Dashboard</h2>

<h3>Pending Join Requests</h3>
<ul>
    <?php foreach ($requests as $req): ?>
        <li>
            <?= htmlspecialchars($req['username']) ?> - <?= $req['status'] ?>
            <?php if ($req['status'] === 'pending'): ?>
                <a href="<?= BASE_URL ?>/public/index.php?p=org/updateRequest&id=<?= $req['id'] ?>&status=approved">Approve</a>
                <a href="<?= BASE_URL ?>/public/index.php?p=org/updateRequest&id=<?= $req['id'] ?>&status=rejected">Reject</a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>

<h3>Assign Task</h3>
<form method="post" action="<?= BASE_URL ?>/public/index.php?p=org/assignTask">
    <label>Select Member:</label>
    <select name="user_id" required>
        <?php foreach ($members as $m): ?>
            <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['username']) ?> (<?= $m['email'] ?>)</option>
        <?php endforeach; ?>
    </select>
    <input type="text" name="title" placeholder="Task Title" required>
    <textarea name="description" placeholder="Task Description"></textarea>
    <select name="priority">
        <option value="low">Low</option>
        <option value="medium">Medium</option>
        <option value="high">High</option>
    </select>
    <input type="date" name="due_date" required>
    <button type="submit">Assign</button>
</form>

<h3>Member Task Report</h3>
<ul>
    <?php foreach ($report as $userId => $stats): ?>
        <li>User ID <?= $userId ?> → Completed <?= $stats['completed'] ?? 0 ?>/<?= $stats['total'] ?></li>
    <?php endforeach; ?>
</ul>
