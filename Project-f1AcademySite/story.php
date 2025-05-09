<?php
include 'Includes/connect.php';
include "includes/layout.php";


$storyId = intval($_GET['id']);

$query = "SELECT s.title, s.type, s.content, u.firstname, u.lastname, s.story_pic_path, s.created_at FROM stories s JOIN users u ON s.author_id = u.id WHERE s.id = $storyId";

$result = mysqli_query($conn, $query);
$story = mysqli_fetch_assoc($result);

$imgQuery = "SELECT image_path, caption FROM story_photos WHERE story_id = $storyId";
$imgResult = mysqli_query($conn, $imgQuery);

$images = [];
while ($img = mysqli_fetch_assoc($imgResult)) {
    $images[] = $img;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $story['title'] ?></title>
    <link rel="stylesheet" href="Css/layout.css">
    <link rel="stylesheet" href="Css/story-news.css?v=1">
</head>

<body>
    <header>
        <a href="index.php">
            <img src="Assets/Layout/F1AcademyLogo.svg" alt="A F1 academy logo" class="academy_logo">
        </a>
        <div class="list">
            <ul>
                <li><a href="teams.php">Teams</a></li>
                <li><a href="drivers.php">Drivers</a></li>
                <li><a href="standings_team.php">Standings</a></li>
                <li><a href="schedule.php">Schedule</a></li>
            </ul>
        </div>
        <a href="SignIn.php">
            <div class="sign_in">
                <i class="fas fa-user"></i> Sign In
            </div>
        </a>
        <div class="menu-toggle" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </header>

    <main>
        <div class="story-page">

            <h1><?= $story['title'] ?></h1>

            <span><?= $story['type'] ?></span>
            <p class="name">By: <?= $story['firstname'] . ' ' . $story['lastname'] ?></p>
            <?php
            $date = new DateTime($story['created_at']);
            $formattedDate = $date->format('F j, Y');
            ?>
            <p class="news-date"><?= $formattedDate ?></p>


            <img src="<?= $story['story_pic_path'] ?>" alt="Main Story Image">


            <div class="story-content">
                <?php
                $content = $story['content'];
                $rawParagraphs = preg_split('/\r\n|\r|\n/', $content);
                $paragraphs = array_filter(array_map('trim', $rawParagraphs));
                $imgIndex = 0;
                $realParaCount = 0;

                foreach ($paragraphs as $para) {
                    echo "<p>" . $para . "</p>";
                    $realParaCount++;

                    if ($realParaCount % 4 === 0 && isset($images[$imgIndex])) {
                        $imagePath = $images[$imgIndex]['image_path'];
                        $caption = htmlspecialchars($images[$imgIndex]['caption']);
                        echo "
                    <div class='inline-photo'>
                        <img src='$imagePath' alt='Story image'>
                        <p class='photo-caption'>$caption</p>
                    </div>
                    ";
                        $imgIndex++;
                    }
                }
                ?>
            </div>
        </div>

        <div class="comments-section">
            <h2>Comments</h2>
            <?php
            $commentQuery = "SELECT c.comment_text, c.created_at, u.firstname, u.lastname FROM comments c JOIN users u ON c.user_id = u.id WHERE c.story_id = $storyId ORDER BY c.created_at DESC";
            $commentResult = mysqli_query($conn, $commentQuery);

            if ($commentResult && mysqli_num_rows($commentResult) > 0) {
                while ($comment = mysqli_fetch_assoc($commentResult)) {
                    $commentDate = (new DateTime($comment['created_at']))->format('F j, Y H:i');
                    ?>
                    <div class="comment">
                        <p class="comment-author"><?= $comment['firstname'] . ' ' . $comment['lastname'] ?>
                            <span class="comment-date"><?= $commentDate ?></span>
                        </p>
                        <p class="comment-text"><?= $comment['comment_text'] ?></p>
                    </div>
                    <?php
                }
                ?>
            <?php
            } else { ?>
                <p>No comments yet. Be the first to comment!</p>
            <?php
            } ?>
        </div>
    </main>

    <footer>
        <div class="footer_list">
            <ul>
                <li><a href="">TERMS OF USE</a></li>
                <li><a href="">COOKIES POLICY</a></li>
                <li><a href="">PRIVACY NOTICE</a></li>
                <li><a href="">CREDITS</a></li>
                <li><a href="">CONTACT US</a></li>
                <li><a href="">FAQ</a></li>
                <li><a href="">PRIVACY MANAGER GDPR</a></li>
            </ul>

            <div class="social-icons">
                <div class="icon_con"><a href="https://instagram.com" target="_blank"><i
                            class="fab fa-instagram"></i></a></div>
                <div class="icon_con"><a href="https://twitter.com" target="_blank"><i class="fab fa-x-twitter"></i></a>
                </div>
                <div class="icon_con"><a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <hr>

        <div class="footer_text">OUR PARTNERS</div>

        <div class="partner_cont">
            <div class="partners_row">
                <a href="https://www.tagheuer.com/int/en/" class="partner_logo"><img src="Assets/Layout/TagHeuer.svg"
                        alt="Tag Heuer"></a>
                <a href="https://www.americanexpress.com/" class="partner_logo"><img
                        src="Assets/Layout/AmericanExpress.svg" alt="American Express"></a>
                <a href="https://www.charlottetilbury.com/uk/secrets/charlotte-tilbury-f1-academy"
                    class="partner_logo"><img src="Assets/Layout/CharlotteTilbury.svg" alt="Charlotte Tilbury"></a>
                <a href="https://www.morethanequal.com/" class="partner_logo"><img src="Assets/Layout/MoreThanEqual.svg"
                        alt="More Than Equal"></a>
            </div>
            <div class="partners_row">
                <a href="https://www.morganstanley.com/" class="partner_logo"><img src="Assets/Layout/MorganStanley.svg"
                        alt="Morgan Stanley"></a>
                <a href="https://uk.puma.com/uk/en/sports/motorsport" class="partner_logo"><img
                        src="Assets/Layout/Puma.svg" alt="Puma"></a>
                <a href="https://www.teamviewer.com/en-cis/" class="partner_logo"><img
                        src="Assets/Layout/TeamViewer.svg" alt="TeamViewer"></a>
                <a href="https://uk.tommy.com/" class="partner_logo"><img src="Assets/Layout/TommyHilfiger.svg"
                        alt="Tommy Hilfiger"></a>
                <a href="https://www.pirelli.com/tyres/en-ww/motorsport/home" class="partner_logo"><img
                        src="Assets/Layout/Pirelli.svg" alt="Pirelli"></a>
            </div>
            <hr class="dec_line">
            <div class="partners_row">
                <a href="https://www.tatuus.it/en" class="partner_logo"><img src="Assets/Layout/Tatuus.svg"
                        alt="Tatuus"></a>
                <a href="https://www.autotecnicamotori.it/" class="partner_logo"><img src="Assets/Layout/ATM.svg"
                        alt="ATM"></a>
                <a href="https://www.aramco.com/en" class="partner_logo"><img src="Assets/Layout/Aramco.svg"
                        alt="Aramco"></a>
            </div>
        </div>
        <hr>
        <div class="footer_con">
            <img src="Assets/Layout/F1AcademyLogo.svg" alt="A F1 academy logo" class="academy_logo">
            <p>© 2025 F1 Academy Limited</p>
        </div>
    </footer>
    <script src="JS/Slider&Menu.js"></script>

</body>

</html>