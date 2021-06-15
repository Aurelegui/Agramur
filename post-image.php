<?php
    require 'header.php';
if (isset($_SESSION['userId'])){
    $filter_array = Array (
        'cigarette',
        'hat',
        'cap'
    );
if (isset($_GET['filter']) && in_array($_GET['filter'], $filter_array)) {
    $filter = $_GET['filter'];
}
?>
<script src="camera.js"></script>
<div id="container-post-image">
    <div class="container-item1">
    <h1>Take a Picture</h1>
        <div class="camera">
            <video id="video">Video stream not available.</video>
        <?php
            if(isset($_GET['filter'])) {
                $disableTakePhoto = "button-photo";
            } 
            else {
                $disableTakePhoto = "button-photo-off";
            }
        ?>
            <button class="<?= $disableTakePhoto ?>" id="startbutton">Take photo</button>
        <?php
            if(isset($filter)) {
        ?>
                <img class="filterOnImage" src="filter/<?=$filter?>.png" alt="">
                <img class="filterOnImage2" src="filter/<?=$filter?>.png" alt="">
        <?php
            }
        ?>
        </div>
        <canvas id="canvas"></canvas>
        <div class="output">
            <img class="resultPhoto" id="photo" alt="preview">
        </div>
        <button id="download" class="select">Download</button>
        <div class="filters">
            <a href="post-image.php?filter=cigarette"><img class="filter" id="cigarette" src="filter/cigarette.png" alt="cig filter"></a>
            <a href="post-image.php?filter=hat"><img class="filter" id="hat" src="filter/hat.png" alt="hat filter"></a>
            <a href="post-image.php?filter=cap"><img class="filter" id="cap" src="filter/cap.png" alt="cap filter"></a>
        </div>
    </div>
    <div class="container-item2">
        <h1>Last Images</h1>
        <?php
        require 'includes/dbh.inc.php';
        $user = $_SESSION['userId'];
        $sql = "SELECT * FROM userphotos WHERE idUsers= $user order by dates DESC";
        $stmt = $pdo->query($sql);
        $row = $stmt->fetchAll();
        $i = 0;
        foreach ($row as $key => $value) {
            $i++;
            if($i==4) break;
        ?>
            <div>
                <img src="<?php echo $value['photo']; ?>" alt="">
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?php
} else {
header ('Location: login.php');
}
require 'footer.php';
?>