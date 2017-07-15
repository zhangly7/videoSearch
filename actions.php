<?php
    if ($_GET['action'] == "suggestion") {
        if ($_POST['typing']) {
            $typing = $_POST['typing'];
            $phrasesArray = file("keywordphrases.txt", FILE_IGNORE_NEW_LINES);
            $returnArray = array();

            if (strlen($typing) > 0) {
                foreach ($phrasesArray as $value) {
                    if (count($returnArray) < 10) {
                        if (strtolower(substr($value, 0, strlen($typing))) == $typing) {
                            array_push($returnArray, $value);
                        }
                    } else {
                        break;
                    }
                }
            }
            echo json_encode($returnArray);
        }
        else {
            echo 2;
        }
    }
?>