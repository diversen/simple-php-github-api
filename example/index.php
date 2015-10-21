<?php

// Step one: Creating a authorisation URL for github

// autoload

include_once "../../../autoload.php";

// very small boot file. Starts session. Defines constants. 
include_once "boot.php";

// use the githubapi
use diversen\githubapi;

/**
 * This is the config we use when creating a url to github.com
 * 
 * Click the link, and we browser to the github site, 
 * and asks for the user to accept the scope of our application. 
 * 
 * 
 * Scope is set to 'user', but you could e.g. set it empty for the
 * lowest privileges 
 * 
 * We press the url, and we move to the github site where
 * the user will be able to accept that this app uses some
 * priviligies. If the user accepts, we return to callback.php 
 * 
 * Next /callback.php
 */


$access_config = array (
    'redirect_uri' => GITHUB_CALLBACK_URL,
    'client_id' => GITHUB_ID,
    'state' =>  md5(uniqid()),
    'scope' => GITHUB_SCOPE
);

$api = new githubapi();

$url = $api->getAccessUrl($access_config);
echo "<a href=\"$url\">Github Login</a>";

