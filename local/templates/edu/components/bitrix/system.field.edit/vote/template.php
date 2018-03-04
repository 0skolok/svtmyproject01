<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (IsModuleInstalled("vote"))
{
	$GLOBALS["APPLICATION"]->IncludeComponent(
		"bitrix:voting.vote.edit",
		"",
		array(
			"bVarsFromForm" => $arParams["bVarsFromForm"],
			"CHANNEL_ID" => $arParams["~arUserField"]["SETTINGS"]["CHANNEL_ID"],
			"MULTIPLE" => $arParams["~arUserField"]["MULTIPLE"],
			"INPUT_NAME" => $arParams["~arUserField"]["FIELD_NAME"],
			"INPUT_VALUE" => $arParams["~arUserField"]["VALUE"]
		),
		null,
		array("HIDE_ICONS" => "Y")
	);
}
?>