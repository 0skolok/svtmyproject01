<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($USER->IsAuthorized() || $arParams["ALLOW_AUTO_REGISTER"] == "Y")
{
	if ($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
	{
		if (strlen($arResult["REDIRECT_URL"]) > 0)
		{
			$APPLICATION->RestartBuffer();
			?>
			<script type="text/javascript">
				window.top.location.href = '<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
			</script>
			<?
			die();
		}
	}
}?>


<div id="order_form_div" class="sale-order-ajax">

	<?if (!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N")
	{
		if (!empty($arResult["ERROR"]))
		{
			echo ShowError(implode("\n", $arResult["ERROR"]));
		}
		elseif (!empty($arResult["OK_MESSAGE"]))
		{
            echo ShowNote(implode("\n", $arResult["OK_MESSAGE"]));
		}
		include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/auth.php");
	}
	else
	{
		if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
		{
			if(strlen($arResult["REDIRECT_URL"]) == 0)
			{
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
			}
		}
		else
		{
		?>
			<script type="text/javascript">
				function submitForm(val) {
					if (val != 'Y')
						BX('confirmorder').value = 'N';

					var orderForm = BX('ORDER_FORM');

					BX.ajax.submitComponentForm(orderForm, 'order_form_content', true);
					BX.submit(orderForm);

					return true;
				}

				function SetContact(profileId) {
					BX("profile_change").value = "Y";
					submitForm();
				}
			</script>
			<? if ($_POST["is_ajax_post"] != "Y") { ?>
				<form action="<?= $APPLICATION->GetCurPage(); ?>" method="POST" name="ORDER_FORM" id="ORDER_FORM">
					<?= bitrix_sessid_post() ?>
					<div id="order_form_content">
			<?
			}
			else
			{
				$APPLICATION->RestartBuffer();
			}

			if (!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y")
			{
				echo ShowError(implode("\n", $arResult["ERROR"]));
				?>

				<script type="text/javascript">
					top.BX.scrollToNode(top.BX('ORDER_FORM'));
				</script>

			<?
			}

			include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/person_type.php");
			include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/props.php");

			if ($arParams["DELIVERY_TO_PAYSYSTEM"] == "p2d")
			{
				include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/paysystem.php");
				include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/delivery.php");
			}
			else
			{
				include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/delivery.php");
				include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/paysystem.php");
			}

			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/related_props.php");

			include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/summary.php");
			if (strlen($arResult["PREPAY_ADIT_FIELDS"]) > 0)
				echo $arResult["PREPAY_ADIT_FIELDS"];

			if ($_POST["is_ajax_post"] != "Y")
			{?>
					</div>
					<input type="hidden" name="confirmorder" id="confirmorder" value="Y">
					<input type="hidden" name="profile_change" id="profile_change" value="N">
					<input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">

					<div class="text-center">
						<a href="javascript:void();" onClick="submitForm('Y'); return false;"
						   class="btn btn-primary btn-lg"><?= GetMessage("SOA_TEMPL_BUTTON") ?></a>
					</div>
				</form>

				<?if ($arParams["DELIVERY_NO_AJAX"] == "N"):?>
					<div style="display:none;">
						<?$APPLICATION->IncludeComponent("bitrix:sale.ajax.delivery.calculator",
							"default",
							array(), null, array('HIDE_ICONS' => 'Y'));?>
					</div>
				<?endif;
			}
			else
			{?>
				<script type="text/javascript">
					top.BX('confirmorder').value = 'Y';
					top.BX('profile_change').value = 'N';
				</script>
				<?die();
			}
		}
	}?>
</div>