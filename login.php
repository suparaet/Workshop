<?php include 'template/header.php'; ?>
<?php
        if ($_SESSION['username']) {
        header('Location:home.php');
        exit();
}
?>
<?php 
$action = $_GET['action'];
if ($action){
    if($action === 'login'){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $hashPassword = hash('SHA256', $password);

        $sql = "SELECT * FROM table_member 
        WHERE member_username = '$username'
        AND member_password = '$hashPassword'";
         echo $sql;
        var_dump($conn);
        $query = $conn->query($sql);
        $result = $query->fetch();

        if($result){
            print_r($result);
            // echo "<script>alert('เข้าสู่ระบบสำเร์จ')</script>";
            $_SESSION['username'] = $result['member_username'];
            $_SESSION['user_id'] = $result['member_id'];
            echo "<script>alert('เข้าสู่ระบบสำเร็จ')</script>";
            echo "<script>window.locaton= 'home.php'</script>";
        } else {
            echo "<script>alert('ชื่อผู้ใช้ไม่ถูกต้อง')</script>";
            echo "<script>window.history.back()</script>";
        }
        exit();

    }
}
?>

<div class="container">
<div style="width: 300px; margin: 0 auto;">
        <h1> Login Page.</h1>
        <form action="login.php?action=login" method="post">
        <div class="form-group">
        <label for="username">Username</label>
        <input
            type="text"
            name="username"
            id="username"
            class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input
            type="password"
            name="password"
            id="password"
            class="form-control">


    <div class="form-group">
    <input class="btn btn-primary" type="submit" value="Login">
    
    </div>
</form>