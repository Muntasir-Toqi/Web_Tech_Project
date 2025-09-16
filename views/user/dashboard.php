<h2>User Dashboard</h2>

<h3>Personal Tasks</h3>
<form method="post" action="<?= BASE_URL ?>/public/index.php?p=user/addTask">
    <input type="text" name="title" placeholder="Task Title" required>
    <textarea name="description" placeholder="Description"></textarea>
    <select name="priority">
        <option value="low">Low</option>
        <option value="medium">Medium</option>
        <option value="high">High</option>
    </select>
    <input type="date" name="due_date">
    <button type="submit">Add Task</button>
</form>

<ul>
    <?php foreach ($personalTasks as $t): ?>
        <li>
            <strong><?= htmlspecialchars($t['title']) ?></strong>
            (<?= $t['priority'] ?>, due <?= $t['due_date'] ?>)  
            <?= htmlspecialchars($t['description']) ?>

            <!-- Mark complete toggle -->
            <?php if ($t['completed']): ?>
                <a href="<?= BASE_URL ?>/public/index.php?p=user/completeTask&id=<?= $t['id'] ?>&done=0">✅ Completed</a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>/public/index.php?p=user/completeTask&id=<?= $t['id'] ?>&done=1">Mark Complete</a>
            <?php endif; ?>

            <!-- Edit -->
            <form method="post" action="<?= BASE_URL ?>/public/index.php?p=user/editTask" style="display:inline;">
                <input type="hidden" name="id" value="<?= $t['id'] ?>">
                <input type="text" name="title" value="<?= htmlspecialchars($t['title']) ?>">
                <textarea name="description"><?= htmlspecialchars($t['description']) ?></textarea>
                <select name="priority">
                    <option value="low" <?= $t['priority']=='low'?'selected':'' ?>>Low</option>
                    <option value="medium" <?= $t['priority']=='medium'?'selected':'' ?>>Medium</option>
                    <option value="high" <?= $t['priority']=='high'?'selected':'' ?>>High</option>
                </select>
                <input type="date" name="due_date" value="<?= $t['due_date'] ?>">
                <button type="submit">Update</button>
            </form>

            <!-- Delete -->
            <a href="<?= BASE_URL ?>/public/index.php?p=user/deleteTask&id=<?= $t['id'] ?>" onclick="return confirm('Delete this task?');">Delete</a>
        </li>
    <?php endforeach; ?>
</ul>


<h3>Organization Tasks</h3>
<ul>
    <?php foreach ($orgTasks as $t): ?>
        <li>
            <strong><?= htmlspecialchars($t['title']) ?></strong> (<?= $t['priority'] ?>, due <?= $t['due_date'] ?>)  
            <?= htmlspecialchars($t['description']) ?>  
            <em>Assigned by: <?= htmlspecialchars($t['org_name']) ?></em>
            <!-- Mark complete toggle -->
            <?php if ($t['completed']): ?>
                <a href="<?= BASE_URL ?>/public/index.php?p=user/completeTask&id=<?= $t['id'] ?>&done=0">✅ Completed</a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>/public/index.php?p=user/completeTask&id=<?= $t['id'] ?>&done=1">Mark Complete</a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>

<h3>Join an Organization</h3>
<form method="post" action="<?= BASE_URL ?>/public/index.php?p=user/joinOrg">
    <select name="org_id" required>
        <?php foreach ($orgs as $org): ?>
            <option value="<?= $org['id'] ?>"><?= htmlspecialchars($org['name']) ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Request to Join</button>
</form>

