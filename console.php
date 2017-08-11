<?php

/**
 * Prints debugging to the screen
 */
function theme_console($t=false, $v='\0') {
    $out = '<div style="background: #222; color: #fff; font-weight: bold; font-family: monospace; padding: 5px 2rem 15px; text-indent: -1rem; max-width: 600px;">';
    
    if ($t) {
        $out .= '> ' . $t;
    } else {
        $out .= '> [print var]';
    }
    
    if ($v != '\0') {
        $out .= ' &mdash; <span style="color: #ccc; font-weight: normal;">';
        switch (getType($v)) {
            case 'boolean':
                $out .= '<span style="color: #c97d25">boolean</span>';
                break;
            case 'integer':
                $out .= '<span style="color: #1f9cde">integer</span>';
                break;
            case 'double':
                $out .= '<span style="color: #1f9cde">double</span>';
                break;
            case 'string':
                $out .= '<span style="color: #5dc74a">string</span>';
                break;
            case 'array':
                $out .= '<span style="color: #ff5a5a">array</span>';
                break;
            case 'object':
                $out .= '<span style="color: #c753d6">object</span>';
                break;
            case 'resource':
                $out .= '<span style="color: #ded844">resource</span>';
                break;
            case 'NULL':
                $out .= '<span style="color: #888">null</span>';
                break;
            default:
                $out .= '<span style="color: #888">unknown type</span>';
        }
        $out .= ' ' . print_r($v, true) . '</span>';
    }
    $out .= '</div>';
    echo $out;
}