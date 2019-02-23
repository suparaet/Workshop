<?php include 'template/header.php'; ?>

<?php
    $action = $_GET['action'];
    $boardId = $_GET['boardId'];
    $userId = $_SESSION['user_id'];
    if($action) {
        if($action === 'comment') {
            $comment = $_POST['comment'];
            $sql = "INSERT INTO table_comment 
                    (
                        comment_content,
                        comment_board_id,
                        comment_member_id
                    ) VALUES (
                        '$comment',
                        '$boardId',
                        '$userId'
                    ) ";
            $result = $conn->exec($sql);
            if($result) {
                echo "<script>alert('คอมเม้นเสร็จแล้ว')</script>";
                echo "<script>
                        window.location = 'board.php?boardId=$boardId'
                    </script>";
            } else {
                echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                echo "<script>window.history.back()</script>";
            }
            exit();
        } else if($action === 'deleteComment') {
            $commentId = $_GET['commentId'];
            $boardId = $_GET['boardId'];
            
            $sql = "DELETE FROM table_comment WHERE comment_id = '$commentId'";
            $result = $conn->exec($sql);
            if($result) {
                echo "<script>alert('ลบคอมเมนต์สำเร็จ')</script>";
                echo "<script>window.location = 'board.php?boardId=$boardId'</script>";
            } else {
                echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                echo "<script>window.history.back()</script>";
            }
            exit();
        }
    }
?>

<?php 
    $boardId = $_GET['boardId'];
    
    $sql = "SELECT * FROM table_board 
            WHERE board_id = '$boardId' ";
    $query = $conn->query($sql);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $sqlComment = "SELECT * FROM table_comment 
                    WHERE comment_board_id = '$boardId'";
    $queryComment = $conn->query($sqlComment);
    $resultsComment = $queryComment->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h2>board ID: <?php echo $_GET['boardId']; ?></h2>

    <h3><?php echo $result['board_topic']; ?></h3>
    <p><?php echo $result['board_content']; ?></p>
    <hr />
    <div class="wrap-comment">
    <?php foreach($resultsComment as $key => $comment): ?>
        <div>Comment #<?php echo $key+1 ?></div>
        <p><?php echo $comment['comment_content'] ?></p>
        <?php if($_SESSION['user_id'] === $comment['comment_member_id']): ?>
            <a href="#" onClick="deleteComment(<?php echo $comment['comment_id']; ?>, <?php echo $boardId ?>)">delete comment</a>
        <?php endif; ?>
        <hr>
    <?php endforeach; ?>
    </div>
    <hr />
    <div class="wrap-form">
        <form action="board.php?action=comment&boardId=<?php echo $result['board_id']; ?>" method="post">
            <textarea class="form-control" name="comment" id="" cols="30" rows="10"></textarea>
            <input class="btn btn-primary" type="submit" value="Comment">
        </form>
    </div>
</div>

<?php include 'template/footer.php'; ?>

<script>
    function deleteComment(commentId, boardId) {
        const cf = confirm('จะลบคอมเม้นนี้จริงหรอ');
        if(cf) {
            window.location = 'board.php?action=deleteComment&commentId=' + commentId + '&boardId=' + boardId;
        }
    }  
</script>