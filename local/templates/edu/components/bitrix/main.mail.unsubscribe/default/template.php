<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div>
	<?if($arResult["ERROR"]):?>
		<div class="alert alert-danger" role="alert"><?=$arResult["ERROR"];?></div>
	<?endif;?>
	<?
	if ($arResult['DATA_SAVED'] == 'Y')
	{
		?><div class="alert alert-success" role="alert"><?= GetMessage('MAIN_MAIL_UNSUBSCRIBE_SUCCESS'); ?></div><?
	}
	?>
	<?if(!empty($arResult['LIST'])):?>
		<form method="POST" action="<?=$arResult['FORM_URL']?>">
			<p><?=GetMessage('MAIN_MAIL_UNSUBSCRIBE_TEMPL_DEFAULT_LIST')?></p>
				<?foreach($arResult['LIST'] as $arSub):?>
					<div class="checkbox">
						<label for="MAIN_MAIL_UNSUB_<?=$arSub['ID']?>">
							<input type="checkbox" name="MAIN_MAIL_UNSUB[]" id="MAIN_MAIL_UNSUB_<?=$arSub['ID']?>" value="<?=$arSub['ID']?>" <?=($arSub['SELECTED'] ? 'checked' : '')?> /> <?=htmlspecialcharsbx($arSub['NAME'])?>
						</label>
						<p><?=htmlspecialcharsbx($arSub['DESC'])?></p>
					</div>
				<?endforeach;?>
			<p><?=GetMessage('MAIN_MAIL_UNSUBSCRIBE_TEMPL_DEFAULT_SELECT')?></p>

			<button class="btn btn-primary" type="submit"><?=GetMessage('MAIN_MAIL_UNSUBSCRIBE_TEMPL_DEFAULT_BUTTON')?></button>

			<input type="hidden" value="Y" name="MAIN_MAIL_UNSUB_BUTTON">
			<?=bitrix_sessid_post()?>
		</form>
	<?elseif(empty($arResult["ERROR"])):?>
	<div class="alert alert-info" role="alert"><?=GetMessage('MAIN_MAIL_UNSUBSCRIBE_TEMPL_DEFAULT_EMPTY')?></div>
	<?endif;?>
</div>