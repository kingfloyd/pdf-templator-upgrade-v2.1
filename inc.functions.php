<?php 
ob_start();

// 
require_once( pdftvtpl2_plugin_path."/inc/include-pdfgenerator.php");
require pdftvtpl2_plugin_path . '/class/page.builder.class.php';
require pdftvtpl2_plugin_path . '/class/page.builder.popup.php';
require_once( pdftvtpl2_plugin_path."/inc/include-customposts.php");
require_once( pdftvtpl2_plugin_path."/inc/include-functions.php");
require_once( pdftvtpl2_plugin_path."/inc/include-metabox.php");
require_once( pdftvtpl2_plugin_path."/inc/include-hooks.php");
require_once( pdftvtpl2_plugin_path."/inc/include-shortcodes.php");

 
// letter codes
require_once( pdftvtpl2_plugin_path."/inc/letter-tool/include-shortcodes-letter-tool.php");


