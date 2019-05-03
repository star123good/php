<?php
    // language library array
    include_once('includes/config.php');
    $sql = "SELECT * from  languages ";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll();
    foreach($results as $result){
        if(trim($result['georgian']) == '') $result['georgian'] = $result['english'];
        $languages[] = $result;
    }
    
    // currency library array
    $sql = "SELECT * from  currencies ";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $currencies=$query->fetch(PDO::FETCH_ASSOC);

    // language selection key default
    $lang_select = 'english';
    
    // currency selection key default
    $curr_select = 'USD';

    // set session values of language | currency
    session_start();
    
    if(isset($_GET['language']) && in_array($_GET['language'], array('english', 'georgian'))){
        $_SESSION['language'] = $_GET['language'];
        $lang_select = $_GET['language'];
    }
    else if(isset($_SESSION['language']) && in_array($_SESSION['language'], array('english', 'georgian'))) $lang_select = $_SESSION['language'];
    else $_SESSION['language'] = $lang_select;

    if(isset($_GET['currency']) && in_array($_GET['currency'], array('USD', 'EUR', 'GEL'))){
        $_SESSION['currency'] = $_GET['currency'];
        $curr_select = $_GET['currency'];
    }
    else if(isset($_SESSION['currency']) && in_array($_SESSION['currency'], array('USD', 'EUR', 'GEL'))) $curr_select = $_SESSION['currency'];
    else $_SESSION['currency'] = $curr_select;
