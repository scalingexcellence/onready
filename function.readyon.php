<?php
/**
 * Smarty plugin to inject doe collected with "onready" block plugin
 * 
 * @package Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {readyon} function plugin
 * 
 * Type:     function<br>
 * Name:     readyon<br>
 * Purpose:  To inject doe collected with "onready" block plugin
 * 
 * @link http://scalingexcellence.co.uk/onready/
 * @author Dimitrios Kouzis-Loukas (dkouzisloukas@scalingexcellence.co.uk)
 * @version 1.0
 * @param array $params parameters
 * Input:<br>
 *            - mode       (required) - "embed" to include the code/"call" to include function calls
 * @param object $template template object
 * @return string
 */
function smarty_function_readyon($params, $template)
{
    global $_smarty_block_onready_blocks;
    $endv = "";
    
    if(!isset($params["mode"])||!in_array($params["mode"], array("embed","call")))
    {
        $smarty->trigger_error("readyon: expected 'mode' parameter with value 'embed' or 'call'", E_USER_NOTICE);
        return;
    }
  
    if ($params["mode"]=="embed") {
        foreach ($_smarty_block_onready_blocks as $k=>$v) {
            $endv .=  "    //".$k."\n    " . str_replace("\n", "\n    ", $v) . "\n";
        }
    }
    else {
        foreach ($_smarty_block_onready_blocks as $k=>$v) {
            $endv .= "    ".$k."();\n";
        }
    }
    return $endv;
} 
