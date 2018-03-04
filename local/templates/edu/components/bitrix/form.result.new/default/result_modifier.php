<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult['COLUMNS'] = array(
	'LEFT' => 'col-md-8',
	'RIGHT' => 'col-md-4',
	'LABELS' => 'col-sm-4',
	'CONTROLS' => 'col-sm-8',
);

if (!strlen($arResult["FORM_IMAGE"]["URL"]))
{
	$arResult["isFormImage"] = 'N';
}

if ($arResult["isFormImage"] == "N" && strlen(trim(strip_tags($arResult["FORM_DESCRIPTION"]))) == 0)
{
	$arResult['COLUMNS']['LEFT'] = 'col-md-12';
	$arResult['COLUMNS']['RIGHT'] = 'hidden';
	$arResult['COLUMNS']['LABELS'] = 'col-md-3';
	$arResult['COLUMNS']['CONTROLS'] = 'col-md-9';
}


$arResult["FORM_HEADER"] = str_replace('<form ', '<form class="form-horizontal" ', $arResult["FORM_HEADER"]);


foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
{
	if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
	{
		continue;
	}


	$html = $arQuestion['HTML_CODE'];
	$html = str_replace('name =', 'name=', $html);
	$html = preg_replace('/id="\S+"/', '', $html);
	$html = preg_replace('/name=/', 'id="' . $FIELD_SID . '"' . ' name=', $html, 1);
	$html = str_replace('size="0"', '', $html);

	switch ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'])
	{
		case "radio":
			$html = preg_replace('/<\/label>\s*?<label\s+for=[^>]*>/', ' ', $html);
			$html = str_replace('<br>', '<br />', $html);
			$answers = explode('<br />', $html);
			if (count($answers))
			{
				foreach ($answers as $i => $a) // bitrix bug: double "checked" attr
				{
					if (!strpos($a, 'checked'))
						continue;

					$a = str_replace(' checked', '', $a);
					$a = str_replace('<input ', '<input checked ', $a);
					$answers[$i] = $a;
				}

				$html = '<div class="radio">' . implode('</div><div class="radio">', $answers) . '</div>';
			}
			break;

		case "checkbox":
			$html = preg_replace('/<label[^>]*>/', ' ', $html);
			$html = str_replace('</label>', '', $html);
			$html = str_replace('<br>', '<br />', $html);
			$answers = explode('<br />', $html);
			if (count($answers))
			{
				$html = '<div class="checkbox"><label>' . implode('</label></div><div class="checkbox"><label>', $answers) . '</label></div>';
			}
			break;

		case "dropdown":
		case "multiselect":
			$html = str_replace('class="inputselect"', 'class="form-control"', $html);
			break;

		case "text":
		case "password":
		case "email":
		case "url":
			$html = str_replace('class="inputtext"', 'class="form-control"', $html);
			break;

		case "textarea":
			$html = str_replace('class="inputtextarea"', 'class="form-control"', $html);
			break;


		case "date":
			$html = preg_replace('/field:\'[^\']+\'/', 'field:\'' . $FIELD_SID . '\'', $html, 1);
			$html = str_replace(" (" . CSite::GetDateFormat("SHORT") . ")", '', $html);
			if (preg_match("/<input[^>]*>/", $html, $matches))
			{
				$html = str_replace($matches[0], '', $html);

				$html = '<div class="input-group">' . str_replace('<input ', '<input class="form-control" ',
						$matches[0]) . '<span class="input-group-addon">' . $html . '</span></div>';
			}
			break;

		case "image":
		case "file":
			$html = parseFileInputFromHTML($html);
			$html = preg_replace('/size="\d+"/', '', $html);
			break;
	}
	$arResult["QUESTIONS"][$FIELD_SID]['HTML_CODE'] = $html;
}