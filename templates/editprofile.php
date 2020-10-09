<?php
include("connection.php");

session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../static/edit.css">

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://kit.fontawesome.com/14d91ba717.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Navbar -->
    <div id="nav-placeholder">

    </div>
    <script>
        $(function() {
            $("#nav-placeholder").load("navbar.php");
        });
    </script>
    <!-- container -->

    <?php 
        if (isset($_POST['upload'])) {
            // print_r($_POST);
            // print_r($_FILES);

            if (isset($_FILES['file']['name']) && $_FILES['file']['name']!= "") {
                $fileName= "../profile-pics/" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'],  $fileName);

                $query = mysqli_query($db,"UPDATE user SET pfp= '$fileName' WHERE username= '{$_SESSION['username']}' ");
                // if (file_exits($fileName)) {
                   
                // }
            }

            
        }
    ?>

    <div class="container">
        <h2>User Profile</h2>
        <form action="editprofile.php" method="post" enctype="multipart/form-data">
        <div class="div-wrap">
            <div class="one">
                <div class="title">
                    <h3>Picture:</h3>
                </div>
                <div class="picture">
                <?php 
                    $sql = mysqli_query($db, "SELECT * FROM user WHERE username='{$_SESSION['username']}'");
                    $row = mysqli_fetch_array($sql);
                    $pfp = $row['pfp'];
                    
                    echo "<img src='$pfp' alt='nope'>";
                ?>
                    <div class="inputb">
                        <input type="file" name="file" class="upload-box">
                        <input type="submit" value="UPLOAD" class="btn" name="upload">
                    </div>
                       
                    
                </div>
                
            </div>
            
            <div class="one">
                <div class="title">
                    <h3>Name:</h3>
                </div>
                <div class="inputb">
                    <input type="text" placeholder="Name" class="txt">
                </div>
            </div>
            <div class="one">
                <div class="title">
                    <h3>Bio:</h3>
                </div>
                <div class="inputb">
                    <input type="text" placeholder="bio" class="txt" name="bio">
                </div>
            </div>
            <div class="one">
                <div class="title">
                    <h3>College:</h3>
                </div>
                <div class="inputb">
                    <input type="text" placeholder="College" class="txt" name="college">
                </div>
            </div>
            <div class="one">
                <div class="title">
                    <h3>Country:</h3>
                </div>
                <div class="inputb">
                    <input type="text" placeholder="Country" class="txt" name="country">
                </div>
            </div>
            <div class="one">
                <div class="title">
                    <h3>Phone:</h3>
                </div>
                <div class="inputb">
                    <input type="text" placeholder="123" class="txt">
                </div>
            </div>
            <div class="one">
                <div class="title">
                    <h3>Username:</h3>
                </div>
                <div class="inputb">
                    <input type="text" placeholder="Userame" class="un">
                </div>
            </div>
            <div class="one">
                <div class="title">
                    <h3>Password:</h3>
                </div>
                <div class="inputb">
                    <input type="password" placeholder="pw">
                </div>
            </div>
            <div class="submit-btn">
                <input type="submit" value="SUBMIT" name="submit">
            </div>
        </div>
        </form>
    </div>
    
</body>
</html>

<?php 
        if (isset($_POST['submit'])) {
            $college = $_POST['college'];
            $country = $_POST['country'];
            $bio= $_POST['bio'];
            $insert = "UPDATE user SET college= '$college' , country='$country', bio='$bio' WHERE username= '{$_SESSION['username']}' ";
            $query = mysqli_query($db, $insert);
        }

?>