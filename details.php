<?php
require('./config/connect-db.php');

if (isset($_POST['delete'])) {

    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM `general` WHERE `general`.`id` = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        header('Location: index.php');
    } else {
        echo 'query error: ' . mysqli_error($conn);
    }
}

include('./templates/header.php');
?>

<div class="container center">
    <?php
    if (isset($_GET['id'])) :
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $result = mysqli_query($conn, "SELECT * FROM general WHERE id = $id");
        $value = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($conn);
    ?>
        <h4><?php echo htmlspecialchars($value['title']); ?></h4>
        <p>Created by: <?php echo htmlspecialchars($value['email']); ?></p>
        <p><?php echo date($value['created-at']); ?></p>
        <h5>Ingredients :</h5>
        <p><?php echo htmlspecialchars($value['content']); ?></p>
        <form action="details.php" method="post">
            <input type="hidden" name='id_to_delete' value="<?php echo $value['id'] ?>">
            <input type="submit" name="delete" value="delete" class="btn brand">
        </form>
    <?php else : ?>
        <h5>No such value exists ! </h5>
    <?php endif; ?>
</div>
<?php
include('./templates/footer.php');
?>