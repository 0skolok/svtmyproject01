<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arTemplateParameters = array(
	"SHOW_SUBMIT_BUTTONS" => Array(
		"NAME" => GetMessage("SMART_FILTER_SHOW_SUBMIT_BUTTONS"),
		"TYPE" => "CHECKBOX",
	),
	"SLIDER_STEPS" => Array(
		"NAME" => GetMessage("SMART_FILTER_SLIDER_STEPS"),
		"TYPE" => "STRING",
		"DEFAULT" => 100,
	),
);
?>