<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
if ($arParams['SILENT'] == 'Y') return;?>

<?if (strlen($arParams['INPUT_NAME_FINISH']) > 0):?>
    <?if ($arParams['SHOW_INPUT'] == 'Y'):?>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" id="<?=$arParams['INPUT_NAME']?><?=$arParams['ADD_ID']?>" name="<?=$arParams['INPUT_NAME']?>" value="<?=$arParams['INPUT_VALUE']?>" <?=(Array_Key_Exists("~INPUT_ADDITIONAL_ATTR", $arParams)) ? $arParams["~INPUT_ADDITIONAL_ATTR"] : ""?> onclick="BX.calendar({node:this, field: this.name, form: '<?if ($arParams['FORM_NAME'] != ''){echo htmlspecialcharsbx(CUtil::JSEscape($arParams['FORM_NAME']));}?>', bTime: <?=$arParams['SHOW_TIME'] == 'Y' ? 'true' : 'false'?>, currentTime: '<?=(time()+date("Z")+CTimeZone::GetOffset())?>', bHideTime: <?=$arParams['HIDE_TIMEBAR'] == 'Y' ? 'true' : 'false'?>});" />
                    <span class="input-group-addon">
                        <i class="glyphicon glyphicon-calendar fa-calendar fa fa-calendar"></i>
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" id="<?=$arParams['INPUT_NAME_FINISH']?><?=$arParams['ADD_ID']?>" name="<?=$arParams['INPUT_NAME_FINISH']?>" value="<?=$arParams['INPUT_VALUE_FINISH']?>" <?=(Array_Key_Exists("~INPUT_ADDITIONAL_ATTR", $arParams)) ? $arParams["~INPUT_ADDITIONAL_ATTR"] : ""?> onclick="BX.calendar({node:this, field: this.name, form: '<?if ($arParams['FORM_NAME'] != ''){echo htmlspecialcharsbx(CUtil::JSEscape($arParams['FORM_NAME']));}?>', bTime: <?=$arParams['SHOW_TIME'] == 'Y' ? 'true' : 'false'?>, currentTime: '<?=(time()+date("Z")+CTimeZone::GetOffset())?>', bHideTime: <?=$arParams['HIDE_TIMEBAR'] == 'Y' ? 'true' : 'false'?>});" />
                    <span class="input-group-addon">
                        <i class="glyphicon glyphicon-calendar fa-calendar fa fa-calendar"></i>
                    </span>
                </div>
            </div>
        </div>
    <?else:?>
        <i class="glyphicon glyphicon-calendar fa-calendar fa fa-calendar" onclick="BX.calendar({node:this, field:'<?=htmlspecialcharsbx(CUtil::JSEscape($arParams['INPUT_NAME']))?>', form: '<?if ($arParams['FORM_NAME'] != ''){echo htmlspecialcharsbx(CUtil::JSEscape($arParams['FORM_NAME']));}?>', bTime: <?=$arParams['SHOW_TIME'] == 'Y' ? 'true' : 'false'?>, currentTime: '<?=(time()+date("Z")+CTimeZone::GetOffset())?>', bHideTime: <?=$arParams['HIDE_TIMEBAR'] == 'Y' ? 'true' : 'false'?>});"></i>
        <span class="date-interval-hellip">&hellip;</span>
        <i class="glyphicon glyphicon-calendar fa-calendar fa fa-calendar" onclick="BX.calendar({node:this, field:'<?=htmlspecialcharsbx(CUtil::JSEscape($arParams['INPUT_NAME_FINISH']))?>', form: '<?if ($arParams['FORM_NAME'] != ''){echo htmlspecialcharsbx(CUtil::JSEscape($arParams['FORM_NAME']));}?>', bTime: <?=$arParams['SHOW_TIME'] == 'Y' ? 'true' : 'false'?>, currentTime: '<?=(time()+date("Z")+CTimeZone::GetOffset())?>', bHideTime: <?=$arParams['HIDE_TIMEBAR'] == 'Y' ? 'true' : 'false'?>});"></i>
    <?endif;?>
<?else:?>
    <?if ($arParams['SHOW_INPUT'] == 'Y'):?>
        <div class="input-group">
            <input type="text" class="form-control" id="<?=$arParams['INPUT_NAME']?><?=$arParams['ADD_ID']?>" name="<?=$arParams['INPUT_NAME']?>" value="<?=$arParams['INPUT_VALUE']?>" <?=(Array_Key_Exists("~INPUT_ADDITIONAL_ATTR", $arParams)) ? $arParams["~INPUT_ADDITIONAL_ATTR"] : ""?> onclick="BX.calendar({node:this, field: this.name, form: '<?if ($arParams['FORM_NAME'] != ''){echo htmlspecialcharsbx(CUtil::JSEscape($arParams['FORM_NAME']));}?>', bTime: <?=$arParams['SHOW_TIME'] == 'Y' ? 'true' : 'false'?>, currentTime: '<?=(time()+date("Z")+CTimeZone::GetOffset())?>', bHideTime: <?=$arParams['HIDE_TIMEBAR'] == 'Y' ? 'true' : 'false'?>});" />
            <span class="input-group-addon">
                <i class="glyphicon glyphicon-calendar fa-calendar fa fa-calendar"></i>
            </span>
        </div>
    <?else:?>
        <i class="glyphicon glyphicon-calendar fa-calendar fa fa-calendar" onclick="BX.calendar({node:this, field:'<?=htmlspecialcharsbx(CUtil::JSEscape($arParams['INPUT_NAME'.($i == 1 ? '_FINISH' : '')]))?>', form: '<?if ($arParams['FORM_NAME'] != ''){echo htmlspecialcharsbx(CUtil::JSEscape($arParams['FORM_NAME']));}?>', bTime: <?=$arParams['SHOW_TIME'] == 'Y' ? 'true' : 'false'?>, currentTime: '<?=(time()+date("Z")+CTimeZone::GetOffset())?>', bHideTime: <?=$arParams['HIDE_TIMEBAR'] == 'Y' ? 'true' : 'false'?>});"></i>
    <?endif;?>
<?endif;?>