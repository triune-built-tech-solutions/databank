 <?php
# Start a session
//session_start();
# Check if a user is logged in
function isLogged(){
    if($_SESSION['user_name']){ # When logged in this variable is set to TRUE
        return TRUE;
    }else{
        return FALSE;
    }
}

# Log a user Out
function logOut(){
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
}

# Session Logout after in activity
function sessionX(){
    $logLength = 60; # time in seconds :: 1800 = 30 minutes
    $ctime = strtotime("now"); # Create a time from a string
    # If no session time is created, create one
    if(!isset($_SESSION['user_name'])){ 
        # create session time
        $_SESSION['user_name'] = $ctime; 
    }else{
        # Check if they have exceded the time limit of inactivity
        if(((strtotime("now") - $_SESSION['user_name']) > $logLength) && isLogged()){
            # If exceded the time, log the user out
            logOut();
            # Redirect to login page to log back in
            header("Location:../index.php");
            exit;
        }else{
            # If they have not exceded the time limit of inactivity, keep them logged in
            $_SESSION['user_name'] = $ctime;
        }
    }
}
# Run Session logout check
//sessionX();
?> 