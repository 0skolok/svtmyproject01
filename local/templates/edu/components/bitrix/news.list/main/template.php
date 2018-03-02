<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>
<? if ($arResult['ITEMS']): ?>
	<? if (strlen($arParams['TITLE']) > 3): ?>
		<!-- Portfolio Section -->
		<h2 class="my-4"><?=$arParams['TITLE']?></h2>
	<? endif; ?>

	<div class="row">
		<? foreach ($arResult['ITEMS'] as $arItemId => $arItem): ?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<!-- Marketing Icons Section -->
			<div class="col-lg-4 mb-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="card h-100">
					<h4 class="card-header"><?=$arItem['NAME']?></h4>
					<div class="card-body">
						<p class="card-text">
							<?=TruncateText($arItem['PREVIEW_TEXT'], 230)?>
						</p>
					</div>
					<div class="card-footer">
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="btn btn-primary">Читать далее</a>
					</div>
				</div>
			</div>
			<!-- /.row -->
		<? endforeach; ?>
	</div>
<? endif; ?>