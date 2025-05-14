<?php
include "../includes/connect.php";
include "../includes/layout.php";
include "../includes/user_profile_box.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../Css/admin_dashboard.css?v=3">
</head>

<body>
    <header>
        <a href="admin_dashboard.php">
            <img src="../Assets/Layout/F1AcademyLogo.svg" alt="F1Academy-logo" class="academy_logo">
        </a>
        <div class="profile" onclick="toggleLogout()">
            <p class="username"><?= $fullName ?></p>

            <div class="logout-menu" id="logoutMenu">
                <a href="../index.php">View As User</a>
                <a href="../includes/logout.php">Logout</a>
            </div>
        </div>
    </header>


    <div class="admin-container">
        <aside>
            <ul>
                <li><a href="?page=users">Users</a></li>
                <li><a href="?page=teams">Teams</a></li>
                <li><a href="?page=drivers">Drivers</a></li>
                <li><a href="?page=news">News</a></li>
                <li><a href="?page=races">Races</a></li>
                <li><a href="?page=results">Upload Results</a></li>
            </ul>
        </aside>

        <main>
            <?php
            if (!isset($_GET['page'])) {
                function getCount($conn, $query)
                {
                    $query = mysqli_prepare($conn, $query);
                    mysqli_stmt_execute($query);
                    mysqli_stmt_bind_result($query, $count);
                    mysqli_stmt_fetch($query);
                    mysqli_stmt_close($query);
                    return $count;
                }

                $userCount = getCount($conn, "SELECT COUNT(*) FROM users WHERE role = 'user'");
                $adminCount = getCount($conn, "SELECT COUNT(*) FROM users WHERE role = 'admin'");
                $teamCount = getCount($conn, "SELECT COUNT(*) FROM teams");
                $driverCount = getCount($conn, "SELECT COUNT(*) FROM drivers");
                $newsCount = getCount($conn, "SELECT COUNT(*) FROM news");
                $raceCount = getCount($conn, "SELECT COUNT(*) FROM race_events");
                $storiesCount = getCount($conn, "SELECT COUNT(*) FROM Stories");


                echo "
                <div class='dashboard-stats'>
                    <div class='card'><h3>Users</h3><p>$userCount</p></div>
                    <div class='card'><h3>Admins</h3><p>$adminCount</p></div>
                    <div class='card'><h3>Teams</h3><p>$teamCount</p></div>
                    <div class='card'><h3>Drivers</h3><p>$driverCount</p></div>
                    <div class='card'><h3>News Articles</h3><p>$newsCount</p></div>
                    <div class='card'><h3>Stories by Users</h3><p>$storiesCount</p></div>
                    <div class='card'><h3>Races In the schedule</h3><p>$raceCount</p></div>
                </div>
                ";

                $commentedTypes = [];
                $commentCounts = [];
                $result = mysqli_query($conn, "
                    SELECT s.type, COUNT(c.id) AS comment_count
                    FROM comments c
                    JOIN stories s ON c.story_id = s.id
                    GROUP BY s.type
                ");
                while ($row = mysqli_fetch_assoc($result)) {
                    $commentedTypes[] = $row['type'];
                    $commentCounts[] = $row['comment_count'];
                }

                $storyTypes = [];
                $typeCounts = [];
                $result = mysqli_query($conn, "SELECT type, COUNT(*) as count FROM stories GROUP BY type");
                while ($row = mysqli_fetch_assoc($result)) {
                    $storyTypes[] = $row['type'];
                    $typeCounts[] = $row['count'];
                }

                $roles = [];
                $roleCounts = [];
                $result = mysqli_query($conn, "SELECT role, COUNT(*) as count FROM users GROUP BY role");
                while ($row = mysqli_fetch_assoc($result)) {
                    $roles[] = ucfirst($row['role']);
                    $roleCounts[] = $row['count'];
                }

                echo '<div class="canvas-wrapper">
                <div class="canvas-box"><canvas id="mostCommentedChart"></canvas></div>
                <div class="canvas-box"><canvas id="storyTypesChart"></canvas></div>
                <div class="canvas-box full-row"><canvas id="userRolesChart"></canvas></div>
            </div>';
            } elseif (isset($_GET['page']) && $_GET['page'] == 'users') {
                include "manage_users.php";
            }
            ?>

        </main>
    </div>

    <script>
        const commentedTypes = <?= json_encode($commentedTypes) ?>;
        const commentCounts = <?= json_encode($commentCounts) ?>;
        const storyTypes = <?= json_encode($storyTypes) ?>;
        const typeCounts = <?= json_encode($typeCounts) ?>;
        const userRoles = <?= json_encode($roles) ?>;
        const userCounts = <?= json_encode($roleCounts) ?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../JS/Charts.js"></script>
    <script src="../JS/Delete_account.js?v=2"></script>
</body>

</html>