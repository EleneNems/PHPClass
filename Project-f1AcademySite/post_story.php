<?php
include "includes/connect.php";
include "includes/layout.php";
include "includes/user_profile_box.php";
include "includes/post_story.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post A Story</title>
    <link rel="stylesheet" href="Css/layout.css?v=8">
    <link rel="stylesheet" href="Css/post_story.css?v=2">
</head>

<body>
    <header>
        <a href="index.php">
            <img src="Assets/Layout/F1AcademyLogo.svg" alt="A F1 academy logo" class="academy_logo">
        </a>
    </header>

    <form method="post" enctype="multipart/form-data">
        <h1>Post a Story</h1>

        <?php if (!empty($errors['form'])) { ?>
            <p style="color: #c3047c;"><?= $errors['form'] ?></p>
        <?php } ?>

        <label for="title">Title *</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">
        <?php if (!empty($errors['title'])){ ?>
            <p style="color: #c3047c;"><?= $errors['title'] ?></p>
        <?php } ?>

        <label for="type">Type *</label>
        <select id="type" name="type">
            <option value="">-- Select Type --</option>
            <option value="story" <?= ($_POST['type'] ?? '') === 'story' ? 'selected' : '' ?>>Story</option>
            <option value="report" <?= ($_POST['type'] ?? '') === 'report' ? 'selected' : '' ?>>Report</option>
            <option value="interview" <?= ($_POST['type'] ?? '') === 'interview' ? 'selected' : '' ?>>Interview</option>
        </select>
        <?php if (!empty($errors['type'])){ ?>
            <p style="color: #c3047c;"><?= $errors['type'] ?></p>
        <?php } ?>

        <label for="story_content">Story Content *</label>
        <textarea id="story_content" name="story_content" class="story_content" rows="5"
            placeholder="Write your story here..."><?= htmlspecialchars($_POST['story_content'] ?? '') ?></textarea>

        <p style="margin: 10px 0; text-align: center;">OR</p>

        <div class="file-upload-wrapper">
            <label for="content_file" class="custom-upload-btn">Upload .txt File</label>
            <input type="file" name="content_file" id="content_file" class="hidden-input" accept=".txt">
            <span id="content-file-name" class="file-name">No file chosen</span>
        </div>
        <?php if (!empty($errors['content'])){ ?>
            <p style="color: #c3047c;"><?= $errors['content'] ?></p>
        <?php } ?>


        <label for="main_picture">Main Picture *</label>
        <div class="file-upload-wrapper">
            <label for="main_picture" class="custom-upload-btn">Choose File</label>
            <input type="file" name="main_picture" id="main_picture" class="hidden-input">
            <span id="main-file-name" class="file-name">No file chosen</span>
        </div>
        <?php if (!empty($errors['main_picture'])){ ?>
            <p style="color: #c3047c;"><?= $errors['main_picture'] ?></p>
        <?php } ?>


        <div id="extra-photos">
            <h3>Additional Photos (Optional)</h3>
            <div class="photo-set">
                <div class="file-upload-wrapper">
                    <label class="custom-upload-btn">Choose File
                        <input type="file" name="photos[]" class="hidden-input additional-photo">
                    </label>
                    <span class="file-name">No file chosen</span>
                </div>
                <input type="text" name="captions[]" placeholder="Caption">
            </div>
        </div>

        <button type="button" onclick="addPhotoField()">Add Another Photo</button>
        <button class="submit-btn" type="submit" name="post_story">POST STORY</button>
    </form>


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

    <script src="JS/Delete_account.js?v=2"></script>
    <script src="JS/AddPhoto.js"></script>
</body>

</html>