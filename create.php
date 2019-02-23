<?php include 'template/header.php'; ?>
<?php 
    if(!$_SESSION['username']){
        header("Location: login.php");
        exit();
    }
?>
<?php 
    $action = $_GET['action'];
    if($action) {
        if($action === 'create') {
            $topic = $_POST['topic'];
            $content = $_POST['content'];
            $userId = $_SESSION['user_id'];
            $sql = "INSERT INTO table_board (
                                    board_topic,
                                    board_content,
                                    board_member_id
                                ) VALUES (
                                    '$topic',
                                    '$content',
                                    '$userId'
                                )";
            $result = $conn->exec($sql);
            if($result) {
                echo "<script>alert('สร้างสำเร็จ')</script>";
                echo "<script>window.location = 'home.php'</script>";
            } else {
                echo "<script>alert('ล้มเหลว !')</script>";
                echo "<script>window.history.back()</script>";
            }
            exit();
        }
    }
?>

<div class="container">
    <h2>Create board.</h2>
    <form action="create.php?action=create" method="post">
        <div class="form-group">
            <label for="topic">Topic</label>
            <input type="text" name="topic" id="topic" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
        </div>

        <input type="submit" class="btn btn-primary" value="Create"/>
    </form>
</div>

<?php include 'template/footer.php'; ?>