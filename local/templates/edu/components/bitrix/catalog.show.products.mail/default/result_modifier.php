<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
$skuPropList = array();
$catalogs = array();
foreach($arParams['LIST_ITEM_ID'] as $itemId)
{
	foreach($arResult['CATALOGS'] as $catalog)
	{
		$offersCatalogId = (int)$catalog['OFFERS_IBLOCK_ID'];
		$offersPropId = (int)$catalog['OFFERS_PROPERTY_ID'];
		$catalogId = (int)$catalog['IBLOCK_ID'];
		$sku = false;
		if($offersCatalogId > 0 && $offersPropId > 0)
			$sku = array("IBLOCK_ID" => $offersCatalogId, "SKU_PROPERTY_ID" => $offersPropId, "PRODUCT_IBLOCK_ID" => $catalogId);

		if (!empty($sku) && is_array($sku))
		{
			$skuPropList[$itemId] = array();
			$skuPropList[$itemId] = CIBlockPriceTools::getTreeProperties(
				$sku,
				$arParams['OFFER_TREE_PROPS'][$itemId],
				array(
					'PICT' => $emptyPreview,
					'NAME' => '-'
				)
			);

			$needValues = array();
			CIBlockPriceTools::getTreePropertyValues($skuPropList[$itemId], $needValues);

			foreach($skuPropList[$itemId] as $propertyCode => &$propertyValue)
			{
				if($propertyValue['SHOW_MODE'] == 'PICT')
				{
					$count = 0;
					foreach($propertyValue['VALUES'] as $key => &$value)
					{
						if(!in_array($value['XML_ID'], $arParams['PROPERTY_VALUE'][$itemId][$propertyCode]))
							unset($propertyValue['VALUES'][$key]);
						if(!empty($arParams['PROPERTY_ITERATION_VALUE'][$itemId][$propertyCode]))
						{
							foreach($arParams['PROPERTY_ITERATION_VALUE'][$itemId][$propertyCode] as $propValue)
							{
								if($propValue == $value['XML_ID'])
								{
									$value['ALLOCATION'] = true;
								}
							}
						}
						else
						{
							if(!$count)
								$value['ALLOCATION'] = true;
						}
					}
				}
				else
				{
					$count = 0;
					foreach($propertyValue['VALUES'] as $key => &$value)
					{
						if(isset($arParams['OFFER'][$itemId]))
						{
							if(in_array($value['NAME'], $arParams['PROPERTY_VALUE'][$itemId][$propertyCode]))
								$value['ALLOCATION'] = true;
							if(isset($value['NA']))
								unset($propertyValue['VALUES'][$key]);
						}
						else
						{
							if(!empty($arParams['PROPERTY_ITERATION_VALUE'][$itemId][$propertyCode]))
							{
								foreach($arParams['PROPERTY_ITERATION_VALUE'][$itemId][$propertyCode] as $propValue)
								{
									if($propValue == $value['NAME'])
									{
										$value['ALLOCATION'] = true;
									}
								}
							}
							else
							{
								if(!$count)
									$value['ALLOCATION'] = true;
							}
							if(!in_array($value['NAME'], $arParams['PROPERTY_VALUE'][$itemId][$propertyCode]))
								unset($propertyValue['VALUES'][$key]);
						}
						$count++;
					}
				}
			}
		}
	}
}


if (!empty($arResult['ITEMS']))
{
	define("SITE_TEMPLATE_PATH","/local/templates/main");
	$newItemsList = array();
	$imgSize = array();
	if(!(empty($arParams['WIDTH']) || empty($arParams['HEIGHT']) || empty($arParams['TYPE'])))
	{
		$imgSize = array(
			"height" => $arParams['HEIGHT'],
			"width" => $arParams['WIDTH'],
			"resize_type" => $arParams['TYPE'],
		);
	}
	foreach ($arResult['ITEMS'] as $key => $item)
	{
		if($item["PREVIEW_PICTURE"] && !empty($imgSize))
		{
			$img = resizeImageIV($item["PREVIEW_PICTURE"], $imgSize);
			$item["PREVIEW_PICTURE"] = $img;
		}
		elseif ($item["DETAIL_PICTURE"] && !empty($imgSize))
		{
			$img = resizeImageIV($item["DETAIL_PICTURE"], $imgSize);
			$item["PREVIEW_PICTURE"] = $img;
		}
		elseif(!empty($arParams["EMPTY_PICTURE"]))
		{
			$img = resizeImageIV(false, $imgSize);
			$item["PREVIEW_PICTURE"]["SRC"] = $arParams["EMPTY_PICTURE"];
			$item["PREVIEW_PICTURE"]["ALT"] = $item["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"];
			$item["PREVIEW_PICTURE"]["TITLE"] = $item["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"];
		}

		\Bitrix\Main\Diag\Debug::writeToFile(
								__FILE__ . ":" . __LINE__ .
								"\n(" . date("Y-m-d H:i:s").")\n" .
								print_r($item['PREVIEW_PICTURE'], TRUE) .
								"\n\n"
							);

		if (isset($item['OFFERS']) && !empty($item['OFFERS']))
		{
			foreach($item['OFFERS']  as $ind => $offer)
				if($offer['SELECTED'])
				{
					$item['OFFERS_SELECTED'] = $ind;
					break;
				}

			$item['MIN_PRICE'] = false;
			foreach ($item['OFFERS'] as $keyOffer => $arOffer)
			{
				if (empty($item['MIN_PRICE']) && $arOffer['CAN_BUY'])
				{
					$item['MIN_PRICE'] = (isset($arOffer['RATIO_PRICE']) ? $arOffer['RATIO_PRICE'] : $arOffer['MIN_PRICE']);
				}
			}
		}

		if($arParams['SIMPLE_PRODUCT'][$item['ID']])
		{
			foreach($arParams['PRICE_CODE'] as $priceCode)
			{
				if(array_key_exists($priceCode, $item['PRICES']))
				{
					$item['MIN_PRICE']['VALUE'] = $item['PRICES'][$priceCode]['VALUE'];
					$item['MIN_PRICE']['PRINT_VALUE'] = $item['PRICES'][$priceCode]['PRINT_VALUE'];
					$item['MIN_PRICE']['DISCOUNT_VALUE'] = $item['PRICES'][$priceCode]['DISCOUNT_VALUE'];
					$item['MIN_PRICE']['PRINT_DISCOUNT_VALUE'] = $item['PRICES'][$priceCode]['PRINT_DISCOUNT_VALUE'];
				}
			}
		}
		$newItemsList[$key] = $item;
	}

	$arResult['ITEMS'] = $newItemsList;
	$arResult['SKU_PROPS'] = $skuPropList;
}
?>