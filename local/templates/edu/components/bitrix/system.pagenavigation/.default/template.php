<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>
<?
if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<!-- Pagination -->
<ul class="pagination justify-content-center mb-4">
	<?if ($arResult["NavPageNomer"] > 1):?>
		<?if($arResult["bSavePage"]):?>
			<li class="page-item">
				<a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult
				["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">&larr; Назад</a>
			</li>
		<?else:?>
			<?if ($arResult["NavPageNomer"] > 2):?>
				<li class="page-item">
					<a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">&larr; Назад</a>
				</li>
			<?else:?>
				<li class="page-item">
					<a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">&larr; Назад</a>
				</li>
			<?endif?>
		<?endif?>
	<?else:?>
		<li class="page-item disabled">
			<span class="page-link">&larr; Назад</span>
		</li>
	<?endif?>

	<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
		<?if($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
			<li class="page-item">
				<a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
			</li>
		<?else:?>
			<li class="page-item">
				<a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
			</li>
		<?endif?>
		<?$arResult["nStartPage"]++?>
	<?endwhile?>

	<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<li class="page-item">
			<a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum
		"]?>=<?=($arResult["NavPageNomer"]+1)?>">Вперед &rarr;</a>
		</li>
	<?else:?>
		<li class="page-item disabled">
			<span class="page-link">Вперед &rarr;</span>
		</li>
	<?endif?>
</ul>