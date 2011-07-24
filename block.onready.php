<?php
/**
 * Smarty plugin to collect javascript code  that will be injected later on the flow by the "readyon" function
 *
 * @package Smarty
 * @subpackage PluginsBlock
 */

/**
 * Smarty {onready}{/onready} block plugin
 * 
 * Type:     block function<br>
 * Name:     onready<br>
 * Purpose:  Collect javascript code that will be injected later on the flow by the "readyon" function
 * 
 * @link http://scalingexcellence.co.uk/onready/
 * @author Dimitrios Kouzis-Loukas (dkouzisloukas@scalingexcellence.co.uk)
 * @version 1.0
 * @param array $params parameters
 * <pre>
 * Params:   none
 *            - ns       (required) - the namespace for this block
 * </pre>
 * @param string $content contents of the block. might include {literal}
 * @param object $smarty smarty object
 * @param boolean &$repeat repeat flag
 * @return string empty
 */
function smarty_block_onready($params, $content, &$smarty, &$repeat)
{
    global $_smarty_block_onready_blocks;
    
    if (is_null($content)) {
        return;
    }
    
    if(!isset($params["ns"]))
    {
        $smarty->trigger_error("onready: expected 'ns' parameter", E_USER_NOTICE);
        return;
    }
    
    $ns = preg_replace("/[^a-zA-Z0-9]/", "", $params["ns"]);
    
    if (isset($_smarty_block_onready_blocks[$ns])) {
        $_smarty_block_onready_blocks[$ns].=trim($content);
    }
    else {
        $_smarty_block_onready_blocks[$ns]=trim($content);
    }
    $_smarty_block_onready_blocks[$ns].="\n";
    
    return "";
}
