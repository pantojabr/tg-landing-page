<?php
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');

    session_start();
    $_SESSION['session_test'] = 1;
    session_write_close();

    session_start();
    if($_SESSION['session_test']) {
        unset($_SESSION['session_test']);
    } else {
        print "Sparkle requires a fully functional PHP session. Contact your web host to fix this.<br>";
        exit();
    }

    if(!isset($_POST['username']) || !isset($_POST['password'])) {
        exit;
    }
    session_start();
    include 'users-503e59.php';
    unset($_SESSION['session_id']);
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_surname']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_info']);
    unset($_SESSION['user_groups']);
    unset($_SESSION['user_logged']);
    $username = strtolower($_POST['username']);
    $password = $_POST['password'];
    $password_hash = crypt($password, $salt);
    if(isset($users[$username]) && $users[$username]['pwd'] === substr($password_hash, 28)) {
        $_SESSION['session_id'] = 'AE793CBE-06BA-4F57-B49C-9B57394B245B';
        $_SESSION['user_id'] = $users[$username]['id'];
        $_SESSION['username'] = $username;
        $_SESSION['user_name'] = $users[$username]['name'];
        $_SESSION['user_surname'] = $users[$username]['surname'];
        $_SESSION['user_email'] = $users[$username]['email'];
        $_SESSION['user_info'] = $users[$username]['info'];
        $_SESSION['user_groups'] = $users[$username]['groups'];
        $_SESSION['user_logged'] = new DateTimeImmutable();
        if(isset($_SESSION['user_redirect']) && !isset($_SESSION['user_redirect_attempt'])) {
            $_SESSION['user_redirect_attempt'] = 1;
            $redirect = $_SESSION['user_redirect'];
            unset($_SESSION['user_redirect']);
            header('Location: ' . $redirect);
        }
        else {
            unset($_SESSION['user_redirect_attempt']);
            $homeURL = 'index.html';
            $homeURLs = array();
            foreach($_SESSION['user_groups'] as $group) {
                if(isset($homeURLs[$group])) {
                    $homeURL = $homeURLs[$group];
                    break;
                }
            }
            header('Location: ' . $homeURL);
        }
    }
    else {
        sleep(3);
        header('Location: user-login.html?err=99');
    }
