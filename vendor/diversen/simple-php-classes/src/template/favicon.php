<?php

namespace diversen\template;
use diversen\conf as conf;



/**
 * File containing class getting favicon
 * @package template
 */

/**
 * 
 * File containing class getting favicon
 * @package template
 */

class favicon {
    
        /**
     * returns favicon html
     * @return string $html 
     */
    public static function getFaviconHTML () {
        
        $favicon = conf::getMainIni('favicon');
        $domain = conf::getDomain();
        $rel_path = "/files/$domain/favicon/$favicon";
        $full_path = conf::pathHtdocs() . "/$rel_path"; 
        if (!is_file($full_path)) {
            $rel_path = '/favicon.ico';
        }
        
        $str = "<link rel=\"shortcut icon\" href=\"$rel_path\" type=\"image/x-icon\" />\n";
        return $str;
    }
}