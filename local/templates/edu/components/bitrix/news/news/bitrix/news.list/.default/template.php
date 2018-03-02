<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>
<? if ($arResult['ITEMS']): ?>
	<? foreach ($arResult['ITEMS'] as $arItemId => $arItem): ?>
		<?
		$this->AddEditAction(
			$arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")
		);
		$this->AddDeleteAction(
			$arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
			array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))
		);
		?>
		<!-- Blog Post -->
		<div class="card mb-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-6">
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
							<img class="img-fluid rounded" src="<?=$arItem['RESIZE_PICTURE']['src']?>"
							     alt="<?=$arItem['NAME']?>">
						</a>
					</div>
					<div class="col-lg-6">
						<h2 class="card-title"><?=$arItem['NAME']?></h2>
						<p class="card-text">
							<?=TruncateText($arItem['PREVIEW_TEXT'], 320)?>
						</p>
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="btn btn-primary">Читать далее &rarr;</a>
					</div>
				</div>
			</div>
			<div class="card-footer text-muted">
				Дата публикации: <?=$arItem["DISPLAY_ACTIVE_FROM"]?>
			</div>
		</div>
	<? endforeach; ?>

	<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
		<br/><?=$arResult["NAV_STRING"]?>
	<? endif; ?>
<? endif; ?>