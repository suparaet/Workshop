<?php include 'template/header.php' ?>
<?php
    if ($_SESSION['username']) {
        header('Location:login.php');
        exit();
}
?>
<?php
    $action = $_GET['action'];
    if ($action){
        if ($action==='register'){

            $username = $_POST['username'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $lname = $_POST['lastName'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $hashPassword = hash('SHA256', $password);

            echo $sql = "INSERT INTO table_member (member_username,
                                                member_password,
                                                member_role,
                                                member_name,
                                                member_lastName,
                                                member_email,
                                                member_gender) 
                    VALUES ('$username',
                            '$hashPassword',
                            '0',
                            '$name',
                            '$lname',
                            '$email',
                            '$gender')";
                            
            $result = $conn ->exec($sql);

            if($result){
                echo"<script>alert('ลงทะเบียนสำเร์จ !') </script>";
                echo "<script>window.location = 'login.php'</script>";
            }else {
                echo"<script>alert('ลงทะเบียนไม่สำเร์จ !') </script>";
                echo "<script>window.history.back()</script>";
            }
        }
    }

?>
<div class="container"> 
<h2>Register</h2>
    <form action="register.php?action=register" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Username" id="username" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password"  placeholder="Password" id="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name"  placeholder="Name" id="name" class="form-control">
    </div>

    <div class="form-group">
    <label for="lastName">lastName</label>
        <input type="text" name="lastName"  placeholder="LastName" id="lastName" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">email</label>
        <input type="email" name="email"  placeholder="email" id="email" class="form-control">
    </div>

    <div class="form-check">
    <input type="radio" name="gender" id="m" value = "m" class="form-check-input">
    <label class="form-check-label" for="m">Male</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="gender" id="f" value = "f" class="form-check-input">
    <label class="form-check-label" for="f">female</label>
    </div>
        
    <div class="form-check">
    <input class="btn btn-primary" type="submit" value="Register">
    </div>
    </form>
</div>