<?php

use diversen\apache2;

/**
 * File contains shell commands for apache2 on Debian systems for fast
 * creatiion of apache2 web hosts
 */

function cos_create_a2_conf($SERVER_NAME){
    return apache2::getA2Conf($SERVER_NAME);
}

function cos_a2_enable_site($options){
    apache2::enableSite($options);
}

function cos_a2_disable_site($options){
    apache2::disableSite($options);
}

function cos_a2_use_ssl ($options) {
    apache2::setUseSSL($options);
}

self::setCommand('apache2', array(
    'description' => 'Apache2 commands (For Linux). Install, remove hosts.',
));

self::setOption('cos_a2_use_ssl', array(
    'long_name'   => '--ssl',
    'description' => 'Set this flag and enable SSL mode',
    'action'      => 'StoreTrue'
));

self::setOption('cos_a2_enable_site', array(
    'long_name'   => '--enable',
    'description' => 'Will enable current directory as an apache2 virtual host. Will also add new sitename to your /etc/hosts file',
    'action'      => 'StoreTrue'
));

self::setOption('cos_a2_disable_site', array(
    'long_name'   => '--disable',
    'description' => 'Will disable current directory as an apache2 virtual host, and remove sitename from /etc/hosts files',
    'action'      => 'StoreTrue'
));

self::setArgument(
    'hostname',
    array('description'=> 'Specify the apache hostname to be used for install or uninstall. yoursite will be http://yoursite',
        'optional' => false,
));
