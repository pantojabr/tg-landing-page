<?php
    session_start();
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');
    unset($_SESSION['session_id']);
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_surname']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_info']);
    unset($_SESSION['user_groups']);
    unset($_SESSION['user_logged']);
    unset($_SESSION['user_redirect']);
    unset($_SESSION['user_redirect_attempt']);
    header('Location: ./');
