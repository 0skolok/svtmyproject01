<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

if ($arResult)
{
	if ($arResult['DETAIL_PICTURE'])
	{
		$arResult['RESIZE_PICTURE'] = CFile::ResizeImageGet(
			$arResult['DETAIL_PICTURE'],
			array(
				'width' => 900,
				'height' => 300,
			),
			BX_RESIZE_IMAGE_EXACT,
			true,
			false
		);
	}

	if (!$arResult['RESIZE_PICTURE'])
	{
		$arResult['RESIZE_PICTURE']['src'] = SITE_TEMPLATE_PATH . '/images/no-photo/900x300.png';
	}
}