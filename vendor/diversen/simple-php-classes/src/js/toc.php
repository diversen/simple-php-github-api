<?php

namespace diversen\js;

use diversen\template;
/**
 * file conatins php code for setting toc js in templates
 * @package js
 */

/**
 * class conatins php code for setting toc js in templates
 * @package js
 */
class toc {
    
    /**
     * function to create a easy TOC for any module. 
     * @param array $options e.g. array ('exclude' => 'h1', 'content' => '#content_article'); 
     */
    public static function set ($options = array ()) {
        template::setJs('/bower_components/toc/dist/toc.min.js');
        if (!isset($options['selectors'])) {
            $options['selectors'] = 'h1,h2,h3,h4';
        }
        if (!isset($options['container'])) {
            $options['container'] = '#content';
        }
        $str = <<<EOF
    $(document).ready(function() {
        $('#toc').toc({selectors: '{$options['selectors']}' , container: '{$options['container']}', prefix: 'toc', 'smoothScrolling': false});
    });
EOF;
        template::setStringJs($str);
    }
}
