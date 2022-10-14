<?php
session_start();
$self_url = $_SERVER['PHP_SELF'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todoアプリ</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
    <form action="<?php echo $self_url; ?>" method="post">
        <div class="create-area">
            <input type="text" name="title" required>
            <input type="submit" name="type" value="create">
        </div>
    </form>
</body>
</html>

<?php
// var_dump($_POST['title']);
if(isset($_POST['type'])){
    if($_POST['type'] === 'create' && !empty($_POST['title'])){
        $_SESSION['todos'][] = $_POST['title'];
        echo '新しいタスク：' . $_POST['title'] . 'が追加されました。';
    }elseif($_POST['type'] === 'delete'){
        array_splice($_SESSION['todos'], $_POST['id'], 1);
        echo "タスク{$_POST['title']}を削除しました。";
    }elseif($_POST['type'] === 'update'){
        $_SESSION['todos'][$_POST['id']] = $_POST['title'];
        echo "タスク{$_POST['title']}を変更しました。";
    }
}
// var_dump($_SESSION['todos']);
if(empty($_SESSION['todos'])){
    $_SESSION['todos'] = [];
    echo 'タスクを入力しましょう！';
    die();
}
?>

<ul>
    <?php for($i = 0; $i < count($_SESSION['todos']); $i++) :?>
    <li>
    <form action="<?php echo $self_url; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $i; ?>">
        <input type="text" name="title" value="<?php echo $_SESSION['todos'][$i]; ?>" ><br>
        <input type="submit" name="type" value="delete">
        <input type="submit" name="type" value="update">
    </form>
    </li>
    <?php endfor; ?>
</ul>



