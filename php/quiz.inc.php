<?php
    header('Content-Type: application/json');

    function storeQuizScore($userID, $userScore, $quizID)
    {                
        require_once 'dbh.inc.php';
        $sql;
        $checkIfExists = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tblquizresults WHERE userID=$userID AND resourceID=$quizID"));
        if ($checkIfExists == 0) {
            $sql = "INSERT INTO tblquizresults (userID, resourceID, score) VALUES (?, ?, ?);";
        }
        else {
            $sql = "UPDATE tblquizresults SET score = ? WHERE userID = ? AND resourceID = ?";
        }
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: enrol.php?error=stmtfailed");
            exit();
        }
        
        if ($checkIfExists == 0) {
            mysqli_stmt_bind_param($stmt, "sss", $userID, $quizID, $userScore);
        }
        else {
            mysqli_stmt_bind_param($stmt, "sss", $userScore, $userID, $quizID);
        }

        if (mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            return true;
        }
        else{
            mysqli_stmt_close($stmt);
            return false;
        }
    };


    function getQuizScores($userID)
    {
        require_once 'dbh.inc.php';
        $result = mysqli_query($conn, "SELECT * FROM tblquizresults WHERE userID = $userID");
        $rows = array();
        while ($r = mysqli_fetch_assoc($result)){
            array_push($rows, $r);
        }

        return $rows;
    };


    function getLevelQuizzes($userLevel)
    {
        require_once 'dbh.inc.php';
        $result = mysqli_query($conn, "SELECT * FROM tblresource WHERE resourceType = 'quizText'");
        // return mysqli_fetch_assoc($result);

        $rows = array();
        while ($r = mysqli_fetch_assoc($result)) {
            $visibleLevels = json_decode($r['visibleToLevelTypes'], true);
            if ($visibleLevels[$userLevel] == true){
                array_push($rows, $r);
            }
        }
        return $rows;
    };

    function getAllQuizzes()
    {
        require_once 'dbh.inc.php';
        $result = mysqli_query($conn, "SELECT * FROM tblresource WHERE resourceType = 'quizText'");
        $rows = array();
        

        while ($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;            
        }
        return $rows;
    }
    
    function getQuizFile($resourceID)
    {
        require_once 'dbh.inc.php';
        $sql = "SELECT resourcePath FROM tblresource WHERE resourceID = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: assignmentsTutor.php?error=stmtfailed");
            echo mysqli_error($conn);
            exit();
        }

        mysqli_stmt_bind_param($stmt, "i", $resourceID);
        mysqli_stmt_execute($stmt);
        $resultsData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultsData)) {
            return $row;
        }
        else {        
            return false;
        }
        mysqli_stmt_close($stmt);
    }

    // https://stackoverflow.com/a/15758129
    $aResult = array();    
    if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

    if( !isset($aResult['error']) ) {
        switch($_POST['functionname']) {
            case 'getAllQuizzes':
                $aResult = getAllQuizzes();
                break;   

            case 'getLevelQuizzes':
                if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }
                else { $aResult['result'] = getLevelQuizzes($_POST['arguments'][0]); }
                break;

            case 'getQuizFile':
                if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }
                else { $aResult['result'] = getQuizFile($_POST['arguments'][0]); }
                break;

            case 'storeQuizScore':
                if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }
                else {
                    $aResult['result'] = storeQuizScore($_POST['arguments'][0], $_POST['arguments'][1],
                                                        $_POST['arguments'][2]);
                    }
                break;
            
            case 'getQuizScores':
                if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }
                else { $aResult['result'] = getQuizScores($_POST['arguments'][0]); }
                break;

            default:
                $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
                break;
        }
    }

    echo json_encode($aResult);    
?>