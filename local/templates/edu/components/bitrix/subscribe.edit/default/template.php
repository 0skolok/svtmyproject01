<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="subscibe-edit">
	<?
	echo ShowMessage(array("MESSAGE" => implode("\n", $arResult["MESSAGE"]), "TYPE" => "OK"));
	echo ShowMessage(array("MESSAGE" => implode("\n", $arResult["ERROR"]), "TYPE" => "ERROR"));

	if ($USER->IsAuthorized()) //USER is authorized
	{
		if (CSubscription::IsAuthorized($arResult["ID"])) //USER is subscribed
		{
			if (($arResult["SUBSCRIPTION"]["CONFIRMED"] == "Y")) //subscription is confirmed
			{
				include("subscribe.php");
				include("state.php");
			} else //subscription is not activated
				include("confirm.php");

		} else //USER is not subscribed
		{
			include("sendcode.php");
			include("subscribe.php");
		}
	} else //USER is not authorized
	{
		if ($arResult["ALLOW_ANONYMOUS"] == "Y" && $_REQUEST["register"] != "yes" && $_REQUEST["authorize"] != "yes") //USER can subscribe
		{
			if ($arResult["ID"]) //User is subscribed or confirmed (has GET-params)
			{
				if ($arResult["SUBSCRIPTION"]["CONFIRMED"] != "Y" || !CSubscription::IsAuthorized($arResult["ID"])) //subscription is not activated
					include("confirm.php");

				include("subscribe.php");
				include("state.php");
			} else //User is not subscribed or confirmed (no GET-params)
			{
				include("sendcode.php");
				include("subscribe.php");
			}

			if ($arResult["SHOW_AUTH_LINKS"] == "Y") //Show authorization/registration links
			{
				?>
				<div class="alert alert-info">
					<?= GetMessage("ADM_AUTH1") ?>
					<a href="<?= $arResult["FORM_ACTION"] ?>?authorize=yes"><?= GetMessage("ADM_AUTH2") ?></a>.
					<?= GetMessage("ADM_REG1") ?>
					<a href="<?= $arResult["FORM_ACTION"] ?>?register=yes"><?= GetMessage("ADM_REG2") ?></a>.
				</div>
			<?
			}
		} else if ($_REQUEST["register"] == "yes") //USER followed registration/authorization link
			include("register.php");
		else if ($_REQUEST["authorize"] == "yes")
			include("authorize.php"); //USER followed registration/authorization link
		else
			include("authorize.php"); //USER can not subscribe
	}
	?>
</div>