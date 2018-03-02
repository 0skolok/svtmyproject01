<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

if ($arResult['ITEMS'])
{
	// image
	foreach ($arResult['ITEMS'] as $arItemId => $arItem)
	{
		$picture = array();
		/*if ($arItem['PREVIEW_PICTURE'])
		{
			$picture = CFile::ResizeImageGet(
				$arItem['PREVIEW_PICTURE'],
				array(
					'width' => 282,
					'height' => 158,
				),
				BX_RESIZE_IMAGE_EXACT,
				true,
				false
			);
		}
		else*/
		{
			$picture['src'] = SITE_TEMPLATE_PATH . '/struct/images/pic0' . rand(1, 4) . '.jpg';
		}

		$arResult['ITEMS'][$arItemId]['RESIZE_PICTURE'] = $picture;
	}
	unset($picture, $intRand);

	// chunk
	$arResult['ITEMS'] = array_chunk($arResult['ITEMS'], 4);
}
