<?php
require 'gallery.php';
?>
<div id="show-feed">
    <?php
    require 'includes/dbh.inc.php';
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
        <img class="img-login" src="<?php echo $value['photo']; ?>" alt="">
        <?php
        $valuephoto = $value['photo'];
        $likesql = "SELECT * FROM userphotos WHERE photo='$valuephoto'";
        $stmt = $pdo->query($likesql);
        $row = $stmt->fetch();
        ?>
        <form action="login.php?like=loginfirst">
            <button class="heart" name="like" type="submit"><img src="https://img.icons8.com/color/48/000000/like.png"/></button><span class="like-number"><?= $row['liked'];?></span>
        </form>
        <?php
        $commentsql = "SELECT * FROM comments WHERE photo = '$valuephoto' order by dates ASC";
        $stmt = $pdo->query($commentsql);
        $row = $stmt->fetchAll();
        echo '<h2 class="comment-title"> Comment Section</h2>';
        foreach ($row as $key => $value) {
        ?>
        <div class="comment">
            <h4>By <?php echo $value['uidUsers'] ?></h4>
            <p>Comment: <?php echo htmlentities($value['comment']) ?> </p>
        </div>
        <?php
        }
        ?>
    </div>
    <?php
    }
    ?>
</div>
<?php 
require 'footer.php'; 
?>