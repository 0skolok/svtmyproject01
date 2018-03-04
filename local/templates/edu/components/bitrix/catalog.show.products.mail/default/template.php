<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

use Bitrix\Main\Localization\Loc;

$skuTemplate = array();
?>
<? if(!empty($arResult['ITEMS'])):?>
	<table align="center" class="wrapper float-center"><tr><td class="wrapper-inner">
	<table align="center" class="container"><tbody><tr><td>

	<table class="row"><tbody><tr>
	<th class="small-12 large-12 columns first last"><table><tr><th>
	<table align="center" class="wrapper float-center"><tr><td class="wrapper-inner">
				<table align="center" class="container"><tbody><tr><td>
							<table class="spacer"><tbody><tr><td height="50px" style="font-size:50px;line-height:50px;">&#xA0;</td></tr></tbody></table>
							<table class="row"><tbody><tr>
	<?$class = "first";
	foreach($arResult['ITEMS'] as $index=>$item): ?>
				<th class="small-12 large-6 columns <?=$class?>"><table><tr><th>
					<table class="tile" border="0" cellpadding="0" cellspacing="0">
						<tbody>
						<tr>
							<td valign="top" class="tile__name">
								<a href="<?=$item['DETAIL_PAGE_URL']?>"><b><?=$item['NAME']?></b></a>
							</td>
						</tr>
						<?if(!empty($item['PREVIEW_PICTURE'])):?>
							<tr>
								<td valign="top" class="tile__image">
									<a href="<?=$item['DETAIL_PAGE_URL']?>"><img class="img-responsive" src="<?=$item['PREVIEW_PICTURE']['SRC']?>"></a>
								</td>
							</tr>
						<?endif;?>
						<tr>
							<td valign="top" class="tile__btn">
								<table class="button small"><tr><td><table><tr><td><a href="<?=$item['DETAIL_PAGE_URL']?>">Подробнее</a></td></tr></table></td></tr></table>
							</td>
						</tr>
						</tbody>
					</table>
				</th></tr></table></th>
	<?if($class == "first")
		{
			$class = "last";
		}
		else
		{
			if ($index != count($arResult["ITEMS"])-1):?>
			</tr></tbody></table>
            <table class="row"><tbody><tr>
			<?endif;
			$class="first";
		}
	endforeach;?>
	            </tr></tbody></table>
							<table class="spacer"><tbody><tr><td height="26px" style="font-size:26px;line-height:26px;">&#xA0;</td></tr></tbody></table>
						</td></tr></tbody></table>
			</td></tr></table>
				</th>
				<th class="expander"></th></tr></table></th>
		</tr></tbody></table>
			</td></tr></tbody></table>
			</td></tr></table>
<? endif ?>