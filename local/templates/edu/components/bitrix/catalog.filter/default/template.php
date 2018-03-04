<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="form-horizontal">
    <fieldset>
        <?foreach($arResult["ITEMS"] as $arItem):
            if(array_key_exists("HIDDEN", $arItem)):
                echo $arItem["INPUT"];
            endif;
        endforeach;?>

        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?if(!array_key_exists("HIDDEN", $arItem)):?>
                <div class="form-group">
                    <label class="control-label col-md-3" for="<?=$arItem["INPUT_NAME"]?>"><?=$arItem["NAME"]?></label>
                    <div class="col-md-9">
                        <?=$arItem["INPUT"]?>
                    </div>
                </div>
            <?endif?>
        <?endforeach;?>

        <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
                <button type="submit" name="set_filter" class="btn btn-primary"><?=GetMessage("IBLOCK_SET_FILTER")?></button>
                <input type="hidden" name="set_filter" value="Y" />
                <button type="submit" class="btn btn-default" name="del_filter"><?=GetMessage("IBLOCK_DEL_FILTER")?></button>
            </div>
        </div>
    </fieldset>
</form>
