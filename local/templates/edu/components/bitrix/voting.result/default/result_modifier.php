<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if ($arResult["QUESTIONS"])
{
	$arProgressBarClasses = array("progress-bar-success", "progress-bar-info", "progress-bar-warning", "progress-bar-danger");
	foreach ($arResult["QUESTIONS"] as $question => $arQuestion)
	{
		if ($arQuestion["ANSWERS"])
		{
			$i = 0;
			foreach ($arQuestion["ANSWERS"] as $answer => $arAnswer)
			{
				$arAnswer["PROGRESS_BAR_CLASS"] = $arProgressBarClasses[$i % count($arProgressBarClasses)];
				$arQuestion["ANSWERS"][$answer] = $arAnswer;
				$i++;
			}
			$arResult["QUESTIONS"][$question] = $arQuestion;
		}
	}
}
?>