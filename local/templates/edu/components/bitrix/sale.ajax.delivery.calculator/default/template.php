<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (is_array($arResult["RESULT"]))
{
	if ($arResult["RESULT"]["RESULT"] == "NEXT_STEP")
		require("step.php");
	else
	{
		if ($arResult["RESULT"]["RESULT"] == "ERROR")
			echo ShowError($arResult["RESULT"]["TEXT"]);
		elseif ($arResult["RESULT"]["RESULT"] == "NOTE")
			echo ShowNote($arResult["RESULT"]["TEXT"]);
		elseif ($arResult["RESULT"]["RESULT"] == "OK")
		{
			echo "<span class=\"help-block\">";
			echo "<small>".GetMessage('SALE_SADC_RESULT')." ".(strlen($arResult["RESULT"]["VALUE_FORMATTED"]) > 0 ? $arResult["RESULT"]["VALUE_FORMATTED"] : number_format($arResult["RESULT"]["VALUE"], 2, ',', ' '))."</small>";
			if ($arResult["RESULT"]["TRANSIT"] > 0)
			{
				echo '<br />';
				echo "<small>" . GetMessage('SALE_SADC_TRANSIT').' '.$arResult["RESULT"]["TRANSIT"] . "</small>";
			}
			echo "</span>";
		}
	}
}

if ($arParams["STEP"] == 0)
	require("start.php");
?>