### About

Very simple github API for PHP using OAuth

### Example

Make an github app under your github account -> edit profile -> apps

For my example I used: 

URL:
    
    http://cos/test/github/github.php

Callback URL:

    http://cos/test/github/callback.php

### Usage

Clone the source or download it into a web directory

    git clone git://github.com/diversen/simple-php-github-api.git github

copy config.php-dist to config.php

    cp config.php-dist config.php

Edit the 3. constants according to your setup. 

    define('GITHUB_ID', 'github_id');
    define('GITHUB_SECRET', 'github_secret');
    define('GITHUB_CALLBACK_URL', 'http://cos/test/github/callback.php');

Test id: 

go to http://cos/test/github/github.php (or the path you have choosen). 

This will example log yourself in and show your basic profile info. 

### More info

For full listing of all api calls check: 

http://developer.github.com/

I have not tested all calls, but all I have testet works - even PATCH, PUT, and
DELETE.
