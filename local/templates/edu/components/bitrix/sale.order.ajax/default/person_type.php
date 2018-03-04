<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="sale-order-ajax-persontype">

	<? if (count($arResult["PERSON_TYPE"]) > 1): ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><?=GetMessage("SOA_TEMPL_PERSON_TYPE")?></h4>
			</div>
			<div class="panel-body">
				<div class="row">
					<?foreach($arResult["PERSON_TYPE"] as $v):?>
						<div class="col-sm-3">
							<label class="radio-inline" for="PERSON_TYPE_<?= $v["ID"] ?>">
								<input name="PERSON_TYPE" type="radio" id="PERSON_TYPE_<?= $v["ID"] ?>" value="<?= $v["ID"] ?>"<?if ($v["CHECKED"]=="Y") echo " checked=\"checked\"";?> onClick="submitForm()">
								<?=$v["NAME"] ?>
							</label>
						</div>
					<?endforeach;?>
				</div>
			</div>
			<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$arResult["USER_VALS"]["PERSON_TYPE_ID"]?>">
		</div>
	<? else:
		//for IE 8, problems with input hidden after ajax?>
		<span class="hidden">
			<? if (IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"]) > 0): ?>
				<input type="hidden" name="PERSON_TYPE" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>">
				<input type="hidden" name="PERSON_TYPE_OLD" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>">
			<? else: ?>
				<? foreach ($arResult["PERSON_TYPE"] as $v):?>
					<input type="hidden" id="PERSON_TYPE" name="PERSON_TYPE" value="<?=$v["ID"]?>">
					<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$v["ID"]?>">
				<?endforeach?>
			<?endif ?>
		</span>
	<?endif ?>

</div>