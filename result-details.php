<?php
    include "dbconn.php";

    $a = $_POST['vID'];

    $query = "SELECT * FROM p3records WHERE videoid = $a";
    $result = mysqli_query($conn, $query);


    while ($row = $result->fetch_assoc()) {
        $reArray=array(
            'title'=>$row['title'],
            'genre'=>$row['genre'],
            'kw'=>$row['keywords'],
            'dur'=>$row['duration'],
            'color'=>$row['color'],
            'sound'=>$row['sound'],
            'sponsor'=>$row['sponsor']
        );
    }

    echo json_encode($reArray);
?>