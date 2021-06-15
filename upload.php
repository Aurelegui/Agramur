<?php
require 'header.php';
if (isset($_SESSION['userId'])) {
    $filter_array = Array (
        'cigarette',
        'hat',
        'cap'
    );
    if (isset($_GET['filter']) && in_array($_GET['filter'], $filter_array)) {
            $filter = $_GET['filter'];
    }
?>
    <script src="upload.js"></script>
    <div>
        <img id="uploaded" src="storage/tmp.png">
    </div>
    <?php
    if(isset($_GET['filter'])) {
        $disableTakePhoto = "button-photo";
    } 
    else {
            $disableTakePhoto = "button-photo-off";
    }
    if(isset($filter)) {
    ?>
        <img class="filterOnImage1" src="filter/<?=$filter?>.png" alt="">
    <?php
    }
    ?>
    <div>
        <button id="download" class="select" style="Download: ;">Download</button>
    </div>
    <div class="filters">
        <a href="upload.php?filter=cigarette"><img class="filter" id="cigarette" src="filter/cigarette.png" alt="cig filter"></a>
        <a href="upload.php?filter=hat"><img class="filter" id="hat" src="filter/hat.png" alt="hat filter"></a>
        <a href="upload.php?filter=cap"><img class="filter" id="cap" src="filter/cap.png" alt="cap filter"></a>    
    </div>
    <div id="show-feed2">
        <h2>Last Images Updated</h2>
    <?php
    require 'includes/dbh.inc.php';
    $user = $_SESSION['userId'];
    $sql = "SELECT * FROM userphotos WHERE idUsers= $user order by dates DESC";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetchAll();
    foreach ($row as $key => $value) {
    ?> 
        <div>
            <img src="<?php echo $value['photo']; ?>" alt="">
        </div>
    <?php
    }
}
else {
    header ('Location: login.php');
}
?>
</div>
<?php
    require 'footer.php';
?>