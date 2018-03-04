<?
//Navigation chain template
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$result = "<ul class=\"breadcrumb\">";

$arChainBody = array();
foreach($arCHAIN as $item)
{
	if(strlen($item["LINK"])<strlen(SITE_DIR))
		continue;
	if($item["LINK"] <> "")
        $result .= '<li><a href="'.$item["LINK"].'">'.htmlspecialcharsex($item["TITLE"]).'</a></li>';
	else
        $result .= "<li class=\"active\">".htmlspecialcharsex($item["TITLE"])."</li>";
}

$result .= "</ul>";
return $result;
?>
