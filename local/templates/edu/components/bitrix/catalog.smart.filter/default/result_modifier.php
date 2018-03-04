<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if ($this->GetPageName() == "" || $this->GetPageName() == "template")
{
	// Названия всех фильтров
	$arNames = array("set_filter", "del_filter");
	// Собрать все примененные фильтры
	$arResult["APPLIED_FILTERS"] = array();

	foreach ($arResult["ITEMS"] as $i => $arItem)
	{
		if ($arItem["CONTROL_NAME"])
		{
			$arNames[] = $arItem["CONTROL_NAME"];
		} // Цена не выводится в списке примененных фильтров, только свойства

		elseif ($arItem["PROPERTY_TYPE"] == "N" || $arItem["PRICE"])
		{
			// Запомнить названия фильтров по цене и числовым свойствам
			if ($arItem["VALUES"]["MAX"]["CONTROL_NAME"])
			{
				$arNames[] = $arItem["VALUES"]["MAX"]["CONTROL_NAME"];
			}
			if ($arItem["VALUES"]["MIN"]["CONTROL_NAME"])
			{
				$arNames[] = $arItem["VALUES"]["MIN"]["CONTROL_NAME"];
			}
			if ($arItem["PROPERTY_TYPE"] == "N")
			{
				if (strlen($arItem["VALUES"]["MIN"]["HTML_VALUE"]) > 0 || strlen($arItem["VALUES"]["MAX"]["HTML_VALUE"]) > 0)
				{
					$arResult["APPLIED_FILTERS"][$arItem["NAME"]][] = array(
						"NAME" => $arItem["NAME"],
						"VALUE" => array(
							"MIN" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
							"MAX" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
						),
						"DELETE_URL" => $APPLICATION->GetCurPageParam("", array($arItem["VALUES"]["MAX"]["CONTROL_NAME"], $arItem["VALUES"]["MIN"]["CONTROL_NAME"])),
					);
				}
			}
		} elseif (!empty($arItem["VALUES"]))
		{
			foreach ($arItem["VALUES"] as $j => $arValue)
			{
				if ($arValue["CONTROL_NAME"])
				{
					$arNames[] = $arValue["CONTROL_NAME"];
				}
				if ($arValue["CHECKED"])
				{
					$arResult["APPLIED_FILTERS"][$arItem["NAME"]][] = array(
						"NAME" => $arItem["NAME"],
						"LABEL" => $arValue["VALUE"],
						"VALUE" => $arValue["HTML_VALUE"],
						"DELETE_URL" => $APPLICATION->GetCurPageParam("", array($arValue["CONTROL_NAME"])),
					);
				}
			}
		}
	}
	$arResult["CLEAN_URL"] = $APPLICATION->GetCurPageParam("", $arNames);
}

// Посчитать количество товаров, если не задан раздел
if ($this->GetPageName() == "ajax" && $arResult["ELEMENT_COUNT"] == 0 && !$arParams["SECTION_ID"])
{
	$FILTER_NAME = (string)$arParams["FILTER_NAME"];
	$arFilter = $this->__component->makeFilter($FILTER_NAME);
	if ($arFilter["SECTION_ID"] == 0)
	{
		unset($arFilter["SECTION_ID"]);
	}
	$arResult["ELEMENT_COUNT"] = CIBlockElement::GetList(array(), $arFilter, array(), false);

	if ($arResult["FILTER_URL"])
	{
		// Фильтр должен вести на первую страницу поиска
		$arResult["FILTER_URL"] = preg_replace("/PAGEN_[0-9]+=[0-9]+&amp;/", "", $arResult["FILTER_URL"]);
	}
}
?>