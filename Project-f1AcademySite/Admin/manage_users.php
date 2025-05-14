<?php
$totalUsers = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM users"))[0];
$totalAdmins = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM users WHERE role = 'admin'"))[0];
$newUsers = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)"))[0];
$users = mysqli_query($conn, "SELECT id, firstname, lastname, email, role, created_at FROM users ORDER BY id ASC");
?>

<div class="user-summary-cards">
    <div class="card">👥 Total Users: <?= $totalUsers ?></div>
    <div class="card">👑 Admins: <?= $totalAdmins ?></div>
    <div class="card">🆕 New This Week: <?= $newUsers ?></div>
</div>

<div class="user-controls">
    <input type="text" placeholder="Search by fullname or email..." id="userSearch">
    <select id="roleFilter">
        <option value="">All Roles</option>
        <option value="user">Users</option>
        <option value="admin">Admins</option>
    </select>
</div>

<table class="user-table">
    <thead>
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Joined</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($user = mysqli_fetch_assoc($users)){ ?>
            <tr>
                <td><?= $user['firstname'] ?></td>
                <td><?= $user['lastname'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= date('Y-m-d', strtotime($user['created_at'])) ?></td>
                <td><span
                        class="badge <?= $user['role'] == 'admin' ? 'admin' : 'user' ?>"><?= ucfirst($user['role']) ?></span>
                </td>
                <td>
                    <?php if ($user['role'] == 'user') { ?>
                        <form method="POST" action="Commands/promote_user.php" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <button type="submit" class="promote-btn">Promote to Admin</button>
                        </form>
                    <?php } elseif (
                        $user['role'] == 'admin' &&
                        $user['id'] != $_SESSION['user_id'] &&
                        isset($_SESSION['email']) &&
                        $_SESSION['email'] === 'elene.nemstsveridze@gau.edu.ge'
                    ) { ?>
                        <form method="POST" action="Commands/demote_user.php" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <button type="submit" class="demote-btn">Demote to User</button>
                        </form>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script src="../JS/Filter_search.js"></script>