<?php

namespace diversen;
class alias {
    public static function set () {
        class_alias('diversen\conf', 'conf');
        class_alias('diversen\session', 'session');
        class_alias('diversen\db', 'db');
        class_alias('diversen\db\q', 'q');
        class_alias('diversen\html', 'html');
        class_alias('diversen\template', 'template');
        class_alias('diversen\template\assets', 'assets');
        class_alias('diversen\template\meta', 'meta');
        class_alias('diversen\strings', 'strings');
        class_alias('diversen\moduleloader', 'moduleloader');
        class_alias('diversen\moduleinstaller', 'moduleinstaller');
        class_alias('diversen\layout', 'layout');
        class_alias('diversen\lang', 'lang');
        class_alias('diversen\view', 'view');
        class_alias('diversen\uri', 'uri');
        class_alias('diversen\date', 'date');
        class_alias('diversen\event', 'event');
        class_alias('diversen\file', 'file');
        class_alias('diversen\http', 'http');
        class_alias('diversen\intl', 'intl');
        class_alias('diversen\log', 'log');
        class_alias('diversen\profile', 'profile');
        class_alias('diversen\user', 'user');
        class_alias('diversen\time', 'time');
        class_alias('diversen\filter\markdown', 'cosmarkdown');
        class_alias('diversen\filter\media', 'cosmedia');
        class_alias('diversen\uri\dispatch', 'dispatch');
    }
}
