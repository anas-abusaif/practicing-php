<?php
require('./config/connect-db.php');
$errors = ['email' => '', 'title' => '', 'content' => ''];
$email = '';
$title = '';
$content = '';
if (isset($_POST['submit'])) {
    // check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be a valid email address';
        }
    }

    // check title
    if (empty($_POST['title'])) {
        $errors['title'] = 'A title is required';
    } else {
        $title = $_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] = 'Title must be letters and spaces only';
        }
    }

    // check content
    if (empty($_POST['content'])) {
        $errors['content'] = 'At least one ingredient is required';
    } else {
        $content = $_POST['content'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $content)) {
            $errors['content'] = 'content must be a comma separated list';
        }
    }
    if (array_filter($errors)) {
        //echo 'errors in form';
    } else {
        $email = mysqli_real_escape_string($conn, $email);
        $title = mysqli_real_escape_string($conn, $title);
        $content = mysqli_real_escape_string($conn, $content);

        if(mysqli_query($conn, "INSERT INTO general(email, title, content) VALUES('$email', '$title', '$content')")){
            // success
        }else{
            echo 'query error: '.mysqli_error($conn); 
        }

        header('Location: index.php');
    }
} // end POST check



?>


<?php include('./templates/header.php') ?>
<link rel="stylesheet" href="add.css">
<section>
    <h4 class="center">Add Content</h4>
    <form class="white" action="add.php" method="POST">
        <label for="email"> e-mail</label>
        <input type="email" name="email" value=<?php echo htmlspecialchars($email) ?>>
        <p class="red-text"><?php echo $errors['email'] ?></p>
        <label for="title">title</label>
        <input type="text" name="title" value=<?php echo htmlspecialchars($title) ?>>
        <p class="red-text"><?php echo $errors['title'] ?></p>
        <label for="content">Content (separate by comma)</label>
        <input type="text" name="content" value=<?php echo htmlspecialchars($content) ?>>
        <p class="red-text"><?php echo $errors['content'] ?></p>
        <div class="container center">
            <input type="submit" class="btn brand" name="submit" value="submit">
        </div>
    </form>
</section>

<?php include('./templates/footer.php') ?>










<!-- <?php
        include("templates/header.php");
        $errors = ['email' => '', 'title' => '', 'content' => ''];
        $email = '';
        $title = '';
        $content = '';
        if (!isset($_POST['email'])) {
            $errors['email'] = 'email field is required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'email must be valid';
        } else {
            $email = $_POST['email'];
        }

        if (!isset($_POST['title'])) {
            $errors['title'] = 'title field is required';
        } elseif (!preg_match('/^(a-zA-Z\s)+$/', $title)) {
            $errors['title'] = 'title must contain only letters and spaces';
        } else {
            $title = $_POST['title'];
        }

        if (!isset($_POST['content'])) {
            $errors['content'] = 'content field is required';
        } elseif (!preg_match('/^(a-zA-Z\s)+(,*a-zA-Z\s*)*$/', $content)) {
            $errors['content'] = 'content must contain only letters and spaces';
        } else {
            $content = $_POST['content'];
        }


        ?>
<link rel="stylesheet" href="add.css">
<section>
    <h4 class="center">Add Content</h4>
    <form class="white" action="add.php" method="POST">
        <label for="email"> e-mail</label>
        <input type="email" name="email" value=<?php echo htmlspecialchars($email); ?>>
        <p class="red-text"><?php echo $errors['email'] ?></p>
        <label for="title">title</label>
        <input type="text" name="title" value=<?php echo htmlspecialchars($title); ?>>
        <p class="red-text"><?php echo $errors['title'] ?></p>
        <label for="content">Content (separate by comma)</label>
        <input type="text" name="content" value=<?php echo htmlspecialchars($content); ?>>
        <p class="red-text"><?php echo $errors['content'] ?></p>
        <div class="container center">
            <input type="submit" class="btn brand" value="submitted">
        </div>
    </form>
</section>
<?php
if ($email) {
    echo htmlspecialchars($email);
}
if ($title) {
    echo htmlspecialchars($title);
}
if ($content) {
    echo htmlspecialchars($content);
}
?>

<?php include('templates/footer.php') ?> -->