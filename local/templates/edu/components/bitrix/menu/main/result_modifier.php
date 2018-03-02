<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

if ($arResult)
{
	$maxDepth = 0;
	foreach ($arResult as $menuItem)
	{
		if ($menuItem["DEPTH_LEVEL"] > $maxDepth)
		{
			$maxDepth = $menuItem["DEPTH_LEVEL"];
		}
	}

	for ($i = $maxDepth; $i > 1; $i--)
	{
		$lastParent = 0;
		foreach ($arResult as $k => $menuItem)
		{
			if ($menuItem["DEPTH_LEVEL"] == $i - 1)
			{
				$lastParent = $k;
			}
			elseif ($menuItem["DEPTH_LEVEL"] == $i)
			{
				$arResult[$lastParent]["ITEMS"][] = $menuItem;
				if ($menuItem["SELECTED"])
				{
					$arResult[$lastParent]["SELECTED"] = "Y";
				}
				unset($arResult[$k]);
			}
		}
	}
}
