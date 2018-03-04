<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><?= GetMessage("ADM_REG_BUTT") ?></h3>
	</div>
	<div class="panel-body">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.register",
			"",
			Array(
				"USER_PROPERTY_NAME" => "",
				"SHOW_FIELDS" => array(),
				"REQUIRED_FIELDS" => array(),
				"AUTH" => "Y",
				"USE_BACKURL" => "Y",
				"SUCCESS_PAGE" => "",
				"SET_TITLE" => "Y",
				"USER_PROPERTY" => array()
			),
			false
		);?>
	</div>
</div>