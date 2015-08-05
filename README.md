# About

Very simple github API for PHP using OAuth. 37 LOC for the API class. And a
curl helper class with 84 LOC.

# Instal `simple-php-github-api`

    php composer.phar require diversen/simple-php-github-api:~1.0
    
Or if you have placed composer.phar in `your path` as composer

    composer require diversen/simple-php-github-api:~1.0

# Brief explantion.

There is really only tree methods you can do. Let us see those three methods first. 
(Further below is an complete example using the built-in server for easy testing). 

1) Generate an access URL to github.com

~~~.php
$access_config = array (
    'redirect_uri' => GITHUB_CALLBACK_URL,
    'client_id' => GITHUB_ID,
    'state' =>  md5(uniqid()),
    'scope' => 'user' 
);

$api = new githubapi();
$url = $api->getAccessUrl($access_config);
echo "<a href=\"$url\">Github Login</a>";
~~~

2) Callback from github.com

~~~.php
$access_config = array (
    'redirect_uri' => GITHUB_CALLBACK_URL,
    'client_id' => GITHUB_ID,
    'client_secret' => GITHUB_SECRET
);

$api = new githubapi();
$res = $api->setAccessToken($access_config);

if ($res) {
    // OK
    This is where we will call the api
    header("Location: /api_call.php");
} else {
    // Not OK. echo errors
    echo "Could not get access token. Errors: <br />";
    print_r($api->errors);
}
~~~

3) API call

For full listing see: [https://developer.github.com/v3/](https://developer.github.com/v3/)

~~~.php
// We have a access token and we can now call the api: 
$api = new githubapi();

// Simple call - API get current users credentials
// This can also be done without scope

// example
// $command = '/user', 
// $request = 'GET', 'POST' or 'PATCH' or 'DELETE' etc. Se API: 
// $post = variables to POST array

$command = "/user";
$res = $api->apiCall($command, $request = null, $post = null);
if (!$res) {
    print_r($api->errors); 
    die;
} else {
    print_r($res);
}
~~~

# Full example

Example you can run right away using the built-in PHP-server. 

## Make a github app

Log into [github.com](github.com)

Register a new application at [https://github.com/settings/developers](https://github.com/settings/developers)

You will see something like this: 

![My settings](https://raw.githubusercontent.com/diversen/simple-php-github-api/master/github-api.png "My settings")

Create your app. 

## Instal `simple-php-github-api`

    php composer.phar require diversen/simple-php-github-api:~1.0
    
Or if you have placed composer.phar in `your path` as composer

    composer require diversen/simple-php-github-api:~1.0

Enter base_dir:

    cd vendor/diversen/simple-php-github-api

## Configuration

    cp example/config.php-dist example/config.php

Edit config

Set config in `example/config.php` according to above settings and 
the screenshot above.

Run test-server with example:

    php -S localhost:8080 -t example/

### More github API info

For full listing of all API calls check: 

http://developer.github.com/

I have not tested many calls - but you should be able to use all. E.g. POST,
or PATCH, DELETE.

Let me hear if it does not work out for you.
