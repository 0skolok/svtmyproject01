<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>
<? if ($arResult['ITEMS']): ?>
	<? foreach ($arResult['ITEMS'] as $arItemId => $arItem): ?>
		<?
		$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
		$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
		$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

		$uniqueId = $arItem['ID'] . '_' . md5($this->randString() . $component->getAction());
		$areaId = $this->GetEditAreaId($uniqueId);
		$this->AddEditAction($uniqueId, $arItem['EDIT_LINK'], $elementEdit);
		$this->AddDeleteAction($uniqueId, $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams);
		?>
		<div class="card mb-4" id="<?=$areaId?>">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-6">
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
							<img class="img-fluid rounded" src="<?=$arItem['RESIZE_PICTURE']['src']?>" alt="<?=$arItem['NAME']?>">
						</a>
					</div>
					<div class="col-lg-6">
						<h5 class="card-title">
							<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
						</h5>
						<?=TruncateText($arItem['PREVIEW_TEXT'], 100)?>
					</div>
				</div>
			</div>
			<div class="card-footer text-muted">
				<strong>Информация по курсу</strong>
				<div class="progress mt-2">
					<div class="progress-bar progress-bar-striped bg-warning"
					     role="progressbar" style="width: 75%" aria-valuenow="75"
					     aria-valuemin="0" aria-valuemax="100">Прогресс 75%</div>
				</div>
				<div class="progress mt-2">
					<div class="progress-bar progress-bar-striped bg-success"
					     role="progressbar" style="width: 66%" aria-valuenow="25"
					     aria-valuemin="0" aria-valuemax="100">Достижения 2/3</div>
				</div>
				<div class="mt-2">
					<div>
						<small class="text-muted">Получено баллов</small>&nbsp;&nbsp;<small class="text-muted">25</small>
					</div>
				</div>
			</div>
		</div>
	<? endforeach; ?>
<? endif; ?>