<?php
include 'header.php';
if (isset($_SESSION['userId'])) {
?>
<div id="show-feed">
    <?php
    require 'includes/dbh.inc.php';
    $user = $_SESSION['userId'];
    $sql = "SELECT * FROM userphotos WHERE photoid order by dates DESC";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetchAll();
    if (empty($row)) {
        ?>
            <h1>There is no photos uploaded yet</h1>
        <?php
    }
    foreach ($row as $key => $value) {
    ?>
    <div class="container-gallery">
        <form action="delete.php" method="POST">
            <input type="hidden" name="uidUsers" value="<?php echo $_SESSION['uidUsers']; ?>">
            <input type="hidden" name="photo" value="<?php echo $value['photo']; ?>">
            <button class="delete" name="delete"><img src="https://img.icons8.com/emoji/32/000000/cross-mark-emoji.png"/></button>
        </form>
        <img class="img-login" src="<?php echo $value['photo']; ?>" alt="">
        <?php
        $valuephoto = $value['photo'];
        $likesql = "SELECT * FROM userphotos WHERE photo = '$valuephoto' ";
        $stmt = $pdo->query($likesql);
        $row = $stmt->fetch();
        ?>
        <form action="like.php" method="POST">
            <input type="hidden" name="photo" value="<?php echo $valuephoto; ?>">
            <input type="hidden" name="idUsers" value="<?php echo $user; ?>">
            <input type="hidden" name="uidUsers" value="<?php echo $_SESSION["uidUsers"]; ?>">
            <button class="heart" name="like"><img src="https://img.icons8.com/color/48/000000/like.png" alt="heart-like"/></button><span class="like-number"><?= $row['liked'];?></span>
        </form>
        <?php
        $commentsql = "SELECT * FROM comments WHERE photo = '$valuephoto' order by dates ASC";
        $stmt = $pdo->query($commentsql);
        $row = $stmt->fetchAll();
        ?>
        <h2 class="comment-title"> Comment </h2>
        <?php
        foreach ($row as $key => $value) {
        ?>
        <div class="comment">
            <h4 style="margin: 5px auto 0px auto;">By <?php echo $value['uidUsers'] ?></h4>
            <p style="margin-top: 0;margin: 0;">Comment: <?php echo htmlentities($value['comment']); ?> </p>
        </div>
        <?php
        }
        ?>
        <form action="comments.php" method="post">
            <input type="hidden" name="photo" value="<?php echo $valuephoto; ?>">
            <input type="hidden" name="idUsers" value="<?php echo $user; ?>">
            <input type="hidden" name="uidUsers" value="<?php echo $_SESSION['uidUsers']; ?>">
            <input type="text" name="comment" placeholder="Comment Here...">
            <button class="gallery-button">Submit</button>
        </form>
    </div>
    <?php
    }
    ?>
</div>
<?php
}
else {
    header ("Location: login.php");
}
include 'footer.php'
?>
    