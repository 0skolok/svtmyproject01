<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="bx-voting-form">
	<?
    if (!empty($arResult["ERROR_MESSAGE"]))
		echo ShowError($arResult["ERROR_MESSAGE"]);
	if (!empty($arResult["OK_MESSAGE"]))
		echo ShowNote($arResult["OK_MESSAGE"]);

	if (empty($arResult["VOTE"]))
		return false;
	elseif (empty($arResult["QUESTIONS"]))
		return true;
	?>
	<form role="form" action="<?=POST_FORM_ACTION_URI?>#vote-form-<?=$arResult["VOTE"]["ID"]?>" method="post" name="vote-form-<?=$arResult["VOTE"]["ID"]?>" id="vote-form-<?=$arResult["VOTE"]["ID"]?>">
		<input type="hidden" name="vote" value="Y">
		<input type="hidden" name="PUBLIC_VOTE_ID" value="<?=$arResult["VOTE"]["ID"]?>">
		<input type="hidden" name="VOTE_ID" value="<?=$arResult["VOTE"]["ID"]?>">
		<?=bitrix_sessid_post()?>
		<? $i = 1; ?>
        <legend><?=$arResult["VOTE"]["TITLE"]?></legend>
        <p class="text-muted"><?=$arResult["VOTE"]["DESCRIPTION"]?></p>
		<?
        foreach ($arResult["QUESTIONS"] as $arQuestion)
        {
            ?>
            <strong <?=$arQuestion["REQUIRED"]=="Y" ? "class='required'" : ""?>>
				<?=$i?>. <?=$arQuestion["QUESTION"]?>
            </strong>
            <?
            foreach ($arQuestion["ANSWERS"] as $arAnswer)
            {
                switch ($arAnswer["FIELD_TYPE"])
                {
                    case 0://radio
                        $value=(isset($_REQUEST['vote_radio_'.$arAnswer["QUESTION_ID"]]) &&
                            $_REQUEST['vote_radio_'.$arAnswer["QUESTION_ID"]] == $arAnswer["ID"]) ? 'checked="checked"' : '';
                    break;
                    case 1://checkbox
                        $value=(isset($_REQUEST['vote_checkbox_'.$arAnswer["QUESTION_ID"]]) &&
                            array_search($arAnswer["ID"],$_REQUEST['vote_checkbox_'.$arAnswer["QUESTION_ID"]])!==false) ? 'checked="checked"' : '';
                    break;
                    case 2://select
                        $value=(isset($_REQUEST['vote_dropdown_'.$arAnswer["QUESTION_ID"]])) ? $_REQUEST['vote_dropdown_'.$arAnswer["QUESTION_ID"]] : false;
                    break;
                    case 3://multiselect
                        $value=(isset($_REQUEST['vote_multiselect_'.$arAnswer["QUESTION_ID"]])) ? $_REQUEST['vote_multiselect_'.$arAnswer["QUESTION_ID"]] : array();
                    break;
                    case 4://text field
                        $value = isset($_REQUEST['vote_field_'.$arAnswer["ID"]]) ? htmlspecialcharsbx($_REQUEST['vote_field_'.$arAnswer["ID"]]) : '';
                    break;
                    case 5://memo
                        $value = isset($_REQUEST['vote_memo_'.$arAnswer["ID"]]) ?  htmlspecialcharsbx($_REQUEST['vote_memo_'.$arAnswer["ID"]]) : '';
                    break;
                }
                switch ($arAnswer["FIELD_TYPE"])
                {
                    case 0://radio
                        ?>
                        <div class="radio">
                            <label for="vote_radio_<?=$arAnswer["QUESTION_ID"]?>_<?=$arAnswer["ID"]?>">
                                <input type="radio" <?=$value?> name="vote_radio_<?=$arAnswer["QUESTION_ID"]?>" <?
                                       ?>id="vote_radio_<?=$arAnswer["QUESTION_ID"]?>_<?=$arAnswer["ID"]?>" <?
                                       ?>value="<?=$arAnswer["ID"]?>" <?=$arAnswer["~FIELD_PARAM"]?> />
                                <?=$arAnswer["MESSAGE"]?>
                            </label>
                        </div>
                        <?
                    break;
                    case 1://checkbox
                        ?>
                        <div class="checkbox">
                            <label for="vote_checkbox_<?=$arAnswer["QUESTION_ID"]?>_<?=$arAnswer["ID"]?>">
                                <input <?=$value?> type="checkbox" name="vote_checkbox_<?=$arAnswer["QUESTION_ID"]?>[]" value="<?=$arAnswer["ID"]?>" <?
                                    ?> id="vote_checkbox_<?=$arAnswer["QUESTION_ID"]?>_<?=$arAnswer["ID"]?>" <?=$arAnswer["~FIELD_PARAM"]?> />
                                <?=$arAnswer["MESSAGE"]?>
                            </label>
                        </div>
                        <?
                    break;
                    case 2://dropdown
                        ?>
                         <div class="form-group">
                            <select class="form-control" name="vote_dropdown_<?=$arAnswer["QUESTION_ID"]?>" <?=$arAnswer["~FIELD_PARAM"]?>>
                                <?foreach ($arAnswer["DROPDOWN"] as $arDropDown):?>
                                    <option value="<?=$arDropDown["ID"]?>" <?=($arDropDown["ID"] === $value)?'selected="selected"':''?>><?=$arDropDown["MESSAGE"]?></option>
                                <?endforeach?>
                            </select>
                        </div>
                        <?
                    break;
                    case 3://multiselect
                        ?>
                        <div class="form-group">
                            <select class="form-control" name="vote_multiselect_<?=$arAnswer["QUESTION_ID"]?>[]" <?=$arAnswer["~FIELD_PARAM"]?> multiple="multiple">
                                <?foreach ($arAnswer["MULTISELECT"] as $arMultiSelect):?>
                                    <option value="<?=$arMultiSelect["ID"]?>" <?=(array_search($arMultiSelect["ID"], $value)!==false)?'selected="selected"':''?>><?=$arMultiSelect["MESSAGE"]?></option>
                                <?endforeach?>
                            </select>
                        </div>
                        <?
                    break;
                    case 4://text field
                        ?>
                        <div class="form-group">
                            <label for="vote_field_<?=$arAnswer["ID"]?>"><?=$arAnswer["MESSAGE"]?></label>
                                <input
                                    class="form-control"
                                    type="text"
                                    name="vote_field_<?=$arAnswer["ID"]?>"
                                    id="vote_field_<?=$arAnswer["ID"]?>"
                                    value="<?=$value?>"
                                    placeholder="<?=$arAnswer["MESSAGE"]?>"
                                    size="<?=$arAnswer["FIELD_WIDTH"]?>" <?=$arAnswer["~FIELD_PARAM"]?> />
                        </div>
                        <?
                    break;
                    case 5://memo
                        ?>
                        <div class="form-group">
                            <label for="vote_memo_<?=$arAnswer["ID"]?>"><?=$arAnswer["MESSAGE"]?></label>
                            <textarea
                                class="form-control"
                                name="vote_memo_<?=$arAnswer["ID"]?>"
                                id="vote_memo_<?=$arAnswer["ID"]?>"
                                <?=$arAnswer["~FIELD_PARAM"]?>
                                cols="<?=$arAnswer["FIELD_WIDTH"]?>"
                                rows="<?=$arAnswer["FIELD_HEIGHT"]?>"
                                placeholder="<?=$arAnswer["MESSAGE"]?>"
                            ><?=$value?>
                            </textarea>
                        </div>
                        <?
                    break;
                }
            }
			$i++;
		}
		if (isset($arResult["CAPTCHA_CODE"]))
        {?>
            <div class="row">
                <div class="col-md-12">
                    <label class="control-label required" for="captcha_word">
                        <?=GetMessage("F_CAPTCHA_TITLE")?>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <img src="/bitrix/tools/captcha.php?captcha_code=<?=$arResult["CAPTCHA_CODE"]?>" alt="<?=GetMessage("F_CAPTCHA_TITLE")?>" />
                </div>
                <div class="col-md-9">
                    <input type="text" name="captcha_word" id="captcha_word"  size="20" class="form-control" placeholder="<?=GetMessage("F_CAPTCHA_PROMT")?>" />
                    <input type="hidden" name="captcha_code" value="<?=$arResult["CAPTCHA_CODE"]?>"/>
                </div>
            </div>
		<?}?>

	    <button type="submit" class="btn btn-default pull-right" name="vote" value="<?=GetMessage("VOTE_SUBMIT_BUTTON")?>"><?=GetMessage("VOTE_SUBMIT_BUTTON")?></button>

		<?
        if ($arParams["SHOW_RESULT_LINK"] == "Y")
        {
			if ($arParams["RESULT_LINK"])
                {?><a id="show_result" href="<?=$arParams["RESULT_LINK"]?>"><?=GetMessage("VOTE_RESULTS")?></a><?}
			else
                {?><a id="show_result" href="<?=$arResult["URL"]["RESULT"]?>"><?=GetMessage("VOTE_RESULTS")?></a><?}
		}
        ?>
	</form>
</div>