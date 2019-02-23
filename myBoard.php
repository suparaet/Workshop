<?php include 'template/header.php'; ?>
<?php

    $action = $_GET['action'];
    $boardId = $_GET['boardId'];
    if($action) {
      if($action === 'delete') {
      $sql = "DELETE FROM table_board WHERE board_id = '$boardId'";
      $result = $conn->exec($sql);
      if ($result) {
          echo "<script>alert('ลบสำเร็จ')</script>";
          echo "<script>window.location = 'myBoard.php'</script>";
            } else {
          echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
          echo "<script>window.history.back()</script>";
            }
            exit();
        }
    }
?>
<?php 
    $userId = $_SESSION['user_id'];
    $sql = "SELECT * FROM table_board
            WHERE board_member_id = '$userId'";
    $query = $conn->query($sql);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h1>My Board</h1>
    <table class="table">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Topic</th>
              <th scope="col">Date</th>
              <th scope="col">Options</th>
            </tr>
    </thead>
    <tbody>
    <?php foreach($results as $key => $value): ?>
      <tr>
      <th scope="row"><?php echo $key+1 ?></th>
      <td>
        <a href="board.php?boardId=<?php echo $value['board_id']; ?>">
        <?php echo $value['board_topic']; ?>
        </a>
        </td>
        <td><?php echo $value['board_date']; ?></td>
        <td>
        <a href="editBoard.php?boardId=<?php echo $value['board_id']; ?>">Edit</a> | 
        <a href="#" onClick="deleteBoard(<?php echo $value['board_id']; ?>)">Delete</a>
        </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'template/footer.php'; ?>

<script>
    function deleteBoard(boardId) {
        const cf = confirm('คุณต้องการจะลบ?');
        if(cf == true) {
            window.location = 'myBoard.php?action=delete&boardId=' + boardId;
        }
    }
</script>