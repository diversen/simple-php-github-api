<?php

// Step two: check if user has autorized our app

// autoload
include_once "../../../autoload.php";

// very small boot file. Starts session. Defines constants. 
include_once "boot.php";

// use the githubapi
use diversen\githubapi;


/*
 * We are back from github and the user has accepted our
 * request. We can now request an access token, 
 * The simple-php-github-api will just set this as a SESSION var found in
 * $_SESSION['access_token'], when we return from github
 * 
 * We check if everything is fine, and redirect to app_call.php
 * Here we will we make api calls using the $_SESSION['access_token']
 * 
 * Next step: 
 * 
 * /api_call.php
 * 
 */
$access_config  = array (
    'redirect_uri' => GITHUB_CALLBACK_URL,
    'client_id' => GITHUB_ID,
    'client_secret' => GITHUB_SECRET,
);

$api = new githubapi();
$res = $api->setAccessToken($access_config );

if ($res) {
    header("Location: /api_call.php");
} else {
    echo "Could not get access token. Errors: <br />";
    print_r($api->errors);
}
  