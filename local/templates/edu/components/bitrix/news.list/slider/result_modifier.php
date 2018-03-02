<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

if ($arResult['ITEMS'])
{
	foreach ($arResult['ITEMS'] as $arItemId => $arItem)
	{
		if ($arItem['PREVIEW_PICTURE'])
		{
			$arResult['ITEMS'][$arItemId]['RESIZE_PICTURE'] = CFile::ResizeImageGet(
				$arItem['PREVIEW_PICTURE'],
				array(
					'width' => 1900,
					'height' => 1080,
				),
				BX_RESIZE_IMAGE_EXACT,
				true,
				false
			);
		}

		if (!$arResult['ITEMS'][$arItemId]['RESIZE_PICTURE'])
		{
			$arResult['ITEMS'][$arItemId]['RESIZE_PICTURE']['src'] = SITE_TEMPLATE_PATH . '/images/no-photo/1900x1080.png';
		}
	}
}