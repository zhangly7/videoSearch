<link rel="stylesheet" type="text/css" href="css/main-styles.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<?php
    include "functions.php";
    include "dbconn.php";
    if (isset($_POST['user']) && isset($_POST['pw'])){          // $_POST must be capital words!!!

        $username = injProtect($conn,$_POST['user']);
        $sha1pw = sha1($_POST['pw']);
        $sql = "SELECT * FROM p3users WHERE id = '$username' AND password = '$sha1pw'";

        if ($result = mysqli_query($conn,$sql)){
            $rowNum = mysqli_num_rows($result);
            if ($rowNum > 0){
                session_start();
                $_SESSION['loginUser']=$username;

            }
        }
    }
?>


<?php
    session_start();
    $curUser = $_SESSION['loginUser'];
    if (isset($curUser)) {
        echo "<div id='userInfo' align='right'>Hello, " . $curUser .
             " (<a href='logout.php' style='font-size: small; color:black'>logout</a>)</div>";

        $keyWords = isset($_GET['input']) ? $_GET['input'] : '';
        $keyWords = injProtect($conn, $keyWords);
        $query = "SELECT * FROM p3records WHERE MATCH(title, description, keywords) AGAINST ('$keyWords')";
        $result = mysqli_query($conn, $query);
    ?>

        <div class="container">
            <div class="searchBox">     <!-- main block #1 -->
                <form action="search.php" method="get">
                    <input type="text" placeholder=" Search..." name="input" required><br>
                    <input type="submit" value="Search">
                </form>

                <div class="suggestion">
                </div>
            </div>

            <div class="results">       <!-- main block #2 -->
                <h2>Open Video</h2>

        <?php
            $showDetail = 0;
            if ($result) {
              //  print_r(mysqli_fetch_assoc($result));
                $numResults = mysqli_num_rows($result);
                echo '<div class="result border1">
                            <p id="result-info">Showing '.$numResults.' results for: ' . $keyWords . '</p><br>';

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="re" vID="' . $row['videoid'] . '">
                              <strong>' . $row['title'] . ' (' . $row['creationyear'] . ')</strong><br>'
                              .substr($row['description'], 0, 200) .
                         '</div><br><br>';
                }
                echo '</div>';

                $showDetail = 1;
            }

            echo '</div>';
            if ($showDetail == 1){
                echo '<div class="details border1"></div>'; // main block 3
            }
            echo '</div>';


    } else {
            if (isset($_POST['user'])) {
                echo "<h2 style='margin: 0 auto'>Incorrect Username or Password</h2><br>";
                include "index.html";
            } else {
                echo "<h2 style='margin: 0 auto'>Please enter your user information.</h2><br>";
                include "index.html";
            }
        }
?>

<script src="main.js"></script>
