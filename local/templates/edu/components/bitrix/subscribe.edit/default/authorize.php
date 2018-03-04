<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><?= GetMessage("SUBSCR_TITLE_AUTH") ?></h3>
	</div>
	<div class="panel-body">
		<?$APPLICATION->IncludeComponent(
			"bitrix:system.auth.form",
			"",
			Array(
				"REGISTER_URL" => "?register=Y",
				"FORGOT_PASSWORD_URL" => "",
				"PROFILE_URL" => "",
				"SHOW_ERRORS" => "N"
			),
			false
		);?>
	</div>
</div>