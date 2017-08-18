<?php

/**
 * Prints debugging to the screen
 * @param string $t a message to print
 * @param var $v a variable to print
 */
function uri_console($t=false, $v='\0') {
    $out = '<div style="background: #222; color: #fff; border-top: 1px solid #444; font-weight: bold; font-family: monospace; padding: 5px 2rem 15px; text-indent: -1.5rem; max-width: 600px;">';
    
    if ($t) {
        $out .= '> ' . $t;
    } else {
        $out .= '> [print var]';
    }
    
    if ($v != '\0') {
        $out .= ' &mdash; <span style="color: #ccc; font-weight: normal;">';
        $out .= uri_console_get_type( $v, print_r($v, true) );
        $out .= '</span>';
    }
    $out .= '</div>';
    echo $out;
}

/**
 * Get the variable type
 */
function uri_console_get_type($var, $print) {
    switch (getType($var)) {
        case 'boolean':
            return '<span style="color: #c97d25">boolean</span> ' . $print;
        case 'integer':
            return '<span style="color: #5da8ff">integer</span> ' . $print;
        case 'double':
            return '<span style="color: #1f9cde">double</span> ' . $print;
        case 'string':
            return "<span style='color: #75eb75'>string '</span>" . $print . "<span style='color: #75eb75'>'</span>";
        case 'array':
            $out = '<span style="color: #ff5a5a">array</span>';
            $out .= uri_console_parse_array($var);
            return $out;
        case 'object':
            return '<span style="color: #c753d6">object</span> ' . $print;
        case 'resource':
            return '<span style="color: #ded844">resource</span> ' . $print;
        case 'NULL':
            return '<span style="color: #888">null</span> ' . $print;
        default:
            return '<span style="color: #888">unknown type</span> ' . $print;
    }
}

/**
 * Parse arrays
 */
function uri_console_parse_array($array) {
    $out = '';
    foreach($array as $key => $val) {
        $out .= '<br /><span style="color: #9cd1e5">' . $key . '</span> <span style="color: #ffeb00">=></span> ' . uri_console_get_type($val, $val);
    }
    return $out;
}