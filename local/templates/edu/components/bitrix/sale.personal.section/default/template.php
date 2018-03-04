<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

$APPLICATION->SetTitle(Loc::getMessage("SPS_TITLE_MAIN"));
if (strlen($arParams["MAIN_CHAIN_NAME"]) > 0)
{
	$APPLICATION->AddChainItem(htmlspecialcharsbx($arParams["MAIN_CHAIN_NAME"]), $arResult['SEF_FOLDER']);
}

if (empty($arResult['AVAILABLE_PAGES']))
{
	ShowError(Loc::getMessage("SPS_ERROR_NOT_CHOSEN_ELEMENT"));
}
else
{
	?>
	<div class="row">
		<?
		foreach ($arResult['AVAILABLE_PAGES'] as $blockElement)
		{
			?>
			<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<div class="jumbotron sale-personal-section-index-block">
					<a class="sale-personal-section-index-block-link" href="<?=htmlspecialcharsbx($blockElement['path'])?>">
					<span class="sale-personal-section-index-block-ico">
						<?=$blockElement['icon']?>
					</span>
						<h3><?=htmlspecialcharsbx($blockElement['name'])?></h3>
					</a>
				</div>
			</div>
			<?
		}
		?>
	</div>
	<?
}
?>
