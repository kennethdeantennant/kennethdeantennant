<?php
    include("../journal_new/classes/Connection.php");
    include("../journal_new/classes/Journal.php");
    include("../journal_new/classes/Login.php");
    include("../journal_new/classes/User.php");

    $uid = '1';

    echo "<h1>Connection Testing</h1>";
    $conn = new Connection();
    echo $conn->getConnectionInfo();

    echo "<h1>Journal Testing</h1>";
    $journal = new Journal();
    $results = $journal->getEntries($uid);
    $rows = array();
    while($row = mysqli_fetch_assoc($results)) {
        $rows[] = $journal->convert_from_latin1_to_utf8_recursively($row);
    }
    echo json_encode($rows);
//    echo "<br>(getEntries) Entries for user $uid are ".count($rows);
//    echo "<br>(getDates) Dates for user $uid are ".count($journal->getDates($uid));
//    $selectedDate = $journal->getDates($uid)[0];
//    $entry = $journal->getSingleEntry($selectedDate, $uid)[3];
//    echo "<br>(getSingleEntry) Getting Single Entry for user $uid on date $selectedDate <blockquote>".$entry."</blockquote>";
//    echo "<br>(getYears) Getting All Years for $uid ".count($journal->getYears($uid));
//    $selectedYear = $journal->getYears($uid)[0];
//    echo "<br>(getEntriesByYear) Get Entries for user $uid on year $selectedYear ".count($journal->getEntriesByYear($selectedYear, $uid));
//    echo "<br>(getAllEntries) Existing Entries are ".count($journal->getAllEntries());
//    echo "<br>(isEntry) on $selectedDate for user $uid an entry exists ".$journal->isEntry($selectedDate, $uid);

    echo "<h1>Login Testing</h1>";
    $login = new Login();
    $login->load($uid);
    echo "<br>(load) ".$login->getLoginInfo();
    echo "<br>(checkUsername) 1-pass and 0-fail == result: ".$login->checkUsername($login->getUsername());
    echo "<br>(verifyPassword) 1-pass and 0-fail == result: ".$login->verifyPassword('ken','Esnack220!');

//    echo "<h1>User Testing</h1>";
//    $user = new User();
//    $user->load($uid);
//    echo "<br>(load) User Info ".$user->getName();
//    echo "<br>(retrieveAllUsernames) Number of Users on the system is ".count($user->retrieveAllUsernames());
?>
0