<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>

<? if ($arResult): ?>
	<nav id="nav">
		<ul>
			<? foreach ($arResult as $arItem): ?>
				<li <? if ($arItem["SELECTED"]): ?>class="current"<? endif; ?>>
					<a href="<?=$arItem["LINK"]; ?>"><?=$arItem["TEXT"]; ?></a>
					<? if ($arItem['ITEMS']): ?>
						<ul>
						<? foreach ($arItem['ITEMS'] as $itemId => $item): ?>
							<li <? if ($item["SELECTED"]): ?>class="current"<? endif; ?>>
								<a href="<?=$item['LINK']; ?>"><?=$item['TEXT']; ?></a>
							</li>
						<? endforeach ?>
						</ul>
					<? endif; ?>
				</li>
			<? endforeach ?>
		</ul>
	</nav>
<? endif; ?>
