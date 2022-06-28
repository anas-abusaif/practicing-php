<?php
require('./config/connect-db.php');
$result = mysqli_query($conn, "SELECT * FROM general");
$general = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
include('templates/header.php');
?>
<div class="container">
    <div class="row">
        <?php foreach ($general as $value) { ?>
            <div class="col s6 md3">
                <div class=" card">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($value['title']); ?></h6>
                        <ul>
                            <?php
                            foreach (explode(',', $value['content']) as $v) { ?>
                                <li>
                                    <?php echo htmlspecialchars($v) ?>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    </div>
                    <div class="card-action right-align">
                        <a href="./details.php?id=<?php echo $value['id'] ?>" class="">more info</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</div>

<?php
include('templates/footer.php');
?>