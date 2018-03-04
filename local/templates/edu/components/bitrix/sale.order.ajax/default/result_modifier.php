<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arParams["TEMPLATE_LOCATION"] == '.default')
{
	$arParams['TEMPLATE_LOCATION'] = 'default';
}


uasort($arResult["DELIVERY"], 'cmpBySort');

// Resize delivery images
if ($arResult["DELIVERY"])
{
	foreach ($arResult["DELIVERY"] as $i => $arDelivery)
	{
		if ($arDelivery["LOGOTIP"])
		{
			$arImg = CFile::ResizeImageGet($arDelivery["LOGOTIP"], array("width" => 95, "height" => 55), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			if ($arImg)
			{
				$arDelivery["LOGOTIP"]["ORIGINAL_SRC"] = $arDelivery["LOGOTIP"]["SRC"];
				$arDelivery["LOGOTIP"]["SRC"] = $arImg["src"];
				$arDelivery["LOGOTIP"]["ORIGINAL_WIDTH"] = $arDelivery["LOGOTIP"]["WIDTH"];
				$arDelivery["LOGOTIP"]["WIDTH"] = $arImg["width"];
				$arDelivery["LOGOTIP"]["ORIGINAL_HEIGHT"] = $arDelivery["LOGOTIP"]["HEIGHT"];
				$arDelivery["LOGOTIP"]["HEIGHT"] = $arImg["height"];
			}
			$arResult["DELIVERY"][$i] = $arDelivery;
		}
	}
}


$arPaySystemSplit = Array("ROW" => Array(), "COL" => Array());
// Resize paysystems images
if ($arResult["PAY_SYSTEM"])
{
	foreach ($arResult["PAY_SYSTEM"] as $i => $arPaySystem)
	{
		if ($arPaySystem["PSA_LOGOTIP"])
		{
			$arImg = CFile::ResizeImageGet($arPaySystem["PSA_LOGOTIP"], array("width" => 95, "height" => 55), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			if ($arImg)
			{
				$arPaySystem["PSA_LOGOTIP"]["ORIGINAL_SRC"] = $arPaySystem["PSA_LOGOTIP"]["SRC"];
				$arPaySystem["PSA_LOGOTIP"]["SRC"] = $arImg["src"];
				$arPaySystem["PSA_LOGOTIP"]["ORIGINAL_WIDTH"] = $arPaySystem["PSA_LOGOTIP"]["WIDTH"];
				$arPaySystem["PSA_LOGOTIP"]["WIDTH"] = $arImg["width"];
				$arPaySystem["PSA_LOGOTIP"]["ORIGINAL_HEIGHT"] = $arPaySystem["PSA_LOGOTIP"]["HEIGHT"];
				$arPaySystem["PSA_LOGOTIP"]["HEIGHT"] = $arImg["height"];
			}
			$arResult["PAY_SYSTEM"][$i] = $arPaySystem;
		}
		if ($arPaySystem["DESCRIPTION"] != "")
			$arPaySystemSplit["ROW"][] = $arPaySystem;
		else
			$arPaySystemSplit["COL"][] = $arPaySystem;

	}
	$arResult["PAY_SYSTEM_SPLIT"] = $arPaySystemSplit;
	if ($arResult["PAY_SYSTEM"]["LOGOTIP"])
	{
		$arImg = CFile::ResizeImageGet($arResult["PAY_SYSTEM"]["LOGOTIP"], array("width" => 100, "height" => 100), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		if ($arImg)
		{
			$arResult["PAY_SYSTEM"]["LOGOTIP"]["ORIGINAL_SRC"] = $arResult["PAY_SYSTEM"]["LOGOTIP"]["SRC"];
			$arResult["PAY_SYSTEM"]["LOGOTIP"]["SRC"] = $arImg["src"];
			$arResult["PAY_SYSTEM"]["LOGOTIP"]["ORIGINAL_WIDTH"] = $arResult["PAY_SYSTEM"]["LOGOTIP"]["WIDTH"];
			$arResult["PAY_SYSTEM"]["LOGOTIP"]["WIDTH"] = $arImg["width"];
			$arResult["PAY_SYSTEM"]["LOGOTIP"]["ORIGINAL_HEIGHT"] = $arResult["PAY_SYSTEM"]["LOGOTIP"]["HEIGHT"];
			$arResult["PAY_SYSTEM"]["LOGOTIP"]["HEIGHT"] = $arImg["height"];
		}
	}
}


$hasDiscount = false;
$hasProps = false;
$productSum = 0;
$noPict = array( 'SRC' => $this->GetFolder() . '/images/no-photo.png' );


foreach ($arResult["GRID"]["ROWS"] as $k => &$arData)
{
	$arData["data"]["PICTURE"] = $noPict;
	if (strlen($arData["data"]["PREVIEW_PICTURE_SRC"]) > 0)
	{
		$arData["data"]["PICTURE"]["SRC"] = $arData["data"]["PREVIEW_PICTURE_SRC"];
	}
	elseif (strlen($arData["data"]["DETAIL_PICTURE_SRC"]) > 0)
	{
		$arData["data"]["PICTURE"]["SRC"] = $arData["data"]["DETAIL_PICTURE_SRC"];
	}

	if (is_readable($nPictFile = $_SERVER['DOCUMENT_ROOT'] . $arData["data"]["PICTURE"]["SRC"]))
	{
		$pictSize = getimagesize($nPictFile);
		$arData["data"]["PICTURE"]['WIDTH'] = $pictSize[0];
		$arData["data"]["PICTURE"]['HEIGHT'] = $pictSize[1];
	}

	if (floatval($arData["data"]['DISCOUNT_PRICE']))
		$hasDiscount = true;
	if (!empty($arData["data"]['PROPS']))
		$hasProps = true;

	$productSum += $arData["data"]['PRICE'] * $arData["data"]['QUANTITY'];
}
unset($arData);

$arResult['HAS_DISCOUNT'] = $hasDiscount;
$arResult['HAS_PROPS'] = $hasProps;
?>