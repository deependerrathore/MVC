<?php
    define('DEBUG', true);
    define('DEFAULT_CONTROLLER','Home'); // default controller if there isn't any contoller in url
    define('DEFAULT_LAYOUT', 'default'); // if no layout has ben set in contoller use this layout
    
    define('PROJECT_ROOT','/MVC/curtis/'); // set this to '/' for live server

    define('SITE_TITLE', 'MVC_FRAMEWORK'); //this will be used if no site title will be used

    //DB details
    define('DB_NAME','mvc'); //database schema
    define('DB_USER','root'); //database user
    define('DB_PASSWORD','root'); //databse password
    define('DB_HOST','127.0.0.1'); //database host *** use IP to avoid DNS lookup

    define('CURRENT_USER_SESSION_NAME','eAiZkVoDoMcdjfIUodfjIDKoAOjk'); //session name for logged in user
    define('REMEMBER_ME_COOKIE_NAME','jdFJDSLJFIOjdflsjioweljdflsFSLDJ'); //cookie name for logged in user remember me
    define('REMEMBER_ME_COOKEI_EXPIRY' , 604800); //time in seconds for remember me cookie, expiry for 7days
    

    define('ACCESS_RESTRICTED','Restricted'); //controller name for the restricted redirect
