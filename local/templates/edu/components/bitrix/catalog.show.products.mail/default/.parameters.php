<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
use \Bitrix\Main\Localization\Loc;

$arTemplateParameters['IMG'] = array('NAME' => Loc::getMessage('GROUP_IMG_NAME'));
$arTemplateParameters = array(
	"WIDTH" => Array(
		"NAME" => Loc::getMessage('WIDTH_NAME'),
		"TYPE" => 'STRING',
		"DEFAULT" => '200'
	),

	"HEIGHT" => Array(
		"NAME" => Loc::getMessage('HEIGHT_NAME'),
		"TYPE" => 'STRING',
		"DEFAULT" => '200'
	),

	"TYPE" => Array(
		"NAME" => Loc::getMessage('TYPE_NAME'),
		"TYPE" => 'LIST',
		'MULTIPLE' => 'N',
		'VALUES' => array(
			BX_RESIZE_IMAGE_EXACT => 'BX_RESIZE_IMAGE_EXACT',
			BX_RESIZE_IMAGE_PROPORTIONAL => 'BX_RESIZE_IMAGE_PROPORTIONAL',
			BX_RESIZE_IMAGE_PROPORTIONAL_ALT => 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT'
		),
		'DEFAULT' => 'BX_RESIZE_IMAGE_PROPORTIONAL'
	),

	"EMPTY_PICTURE" => Array(
		"NAME" => Loc::getMessage('EMPTY_PICTURE'),
		"TYPE" => 'STRING',
	)
);