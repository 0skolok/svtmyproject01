<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="search-page">
    <form action="" method="get" class="form-horizontal">
        <div class="form-group">
            <div class="col-md-12">
                <div class="input-group">
                    <?if($arParams["USE_SUGGEST"] === "Y"):
                        if(strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"]))
                        {
                            $arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
                            $obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
                            $obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
                        }
                        ?>
                        <?$APPLICATION->IncludeComponent(
                        "bitrix:search.suggest.input",
                        "",
                        array(
                            "NAME" => "q",
                            "VALUE" => $arResult["REQUEST"]["~QUERY"],
                            "INPUT_SIZE" => 40,
                            "DROPDOWN_SIZE" => 10,
                            "FILTER_MD5" => $arResult["FILTER_MD5"],
                        ),
                        $component, array("HIDE_ICONS" => "Y")
                    );?>
                    <?else:?>
                        <input type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" size="40" class="form-control" />
                    <?endif;?>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default pull-right"><?=GetMessage("SEARCH_GO")?></button>
                    </span>
                </div>
            </div>
        </div>

        <?if($arParams["SHOW_WHERE"]):?>
            <div class="form-group">
                <label class="control-label col-md-3"><?=GetMessage("SEARCH_WHERE")?></label>
                <div class="col-md-9">
                    <select name="where" class="form-control">
                        <option value=""><?=GetMessage("SEARCH_ALL")?></option>
                        <?foreach($arResult["DROPDOWN"] as $key=>$value):?>
                            <option value="<?=$key?>"<?if($arResult["REQUEST"]["WHERE"]==$key) echo " selected"?>><?=$value?></option>
                        <?endforeach?>
                    </select>
                </div>
            </div>
        <?endif;?>

        <input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
        <?if($arParams["SHOW_WHEN"]):?>
            <script>
                var switch_search_params = function()
                {
                    var sp = document.getElementById('search_params');
                    var flag;

                    if(sp.style.display == 'none')
                    {
                        flag = false;
                        sp.style.display = 'block'
                    }
                    else
                    {
                        flag = true;
                        sp.style.display = 'none';
                    }

                    var from = document.getElementsByName('from');
                    for(var i = 0; i < from.length; i++)
                        if(from[i].type.toLowerCase() == 'text')
                            from[i].disabled = flag

                    var to = document.getElementsByName('to');
                    for(var i = 0; i < to.length; i++)
                        if(to[i].type.toLowerCase() == 'text')
                            to[i].disabled = flag

                    return false;
                }
            </script>

            <div class="form-group">
                <label class="control-label col-md-3"><?=GetMessage("CT_BSP_ADDITIONAL_PARAMS")?></label>
                <div class="col-md-9">
                    <?$APPLICATION->IncludeComponent(
                        'bitrix:main.calendar',
                        '',
                        array(
                            'SHOW_INPUT' => 'Y',
                            'INPUT_NAME' => 'from',
                            'INPUT_VALUE' => $arResult["REQUEST"]["~FROM"],
                            'INPUT_NAME_FINISH' => 'to',
                            'INPUT_VALUE_FINISH' =>$arResult["REQUEST"]["~TO"],
                            'INPUT_ADDITIONAL_ATTR' => 'size="10"',
                        ),
                        null,
                        array('HIDE_ICONS' => 'Y')
                    );?>
                </div>
            </div>
        <?endif?>
    </form>

    <?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):?>
        <div class="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
        </div>
    <?endif;?>

    <?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
    <?elseif($arResult["ERROR_CODE"]!=0):?>
        <?=ShowError($arResult["ERROR_TEXT"]);?>
        <p><?=GetMessage("SEARCH_CORRECT_AND_CONTINUE")?></p>

        <?=GetMessage("SEARCH_SINTAX")?>
        <h3><?=GetMessage("SEARCH_LOGIC")?></h3>
        <table class="table">
            <thead>
                <tr>
                    <th><?=GetMessage("SEARCH_OPERATOR")?></th>
                    <th><?=GetMessage("SEARCH_SYNONIM")?></th>
                    <th><?=GetMessage("SEARCH_DESCRIPTION")?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?=GetMessage("SEARCH_AND")?></td>
                    <td>and, &amp;, +</td>
                    <td><?=GetMessage("SEARCH_AND_ALT")?></td>
                </tr>
                <tr>
                    <td><?=GetMessage("SEARCH_OR")?></td>
                    <td>or, |</td>
                    <td><?=GetMessage("SEARCH_OR_ALT")?></td>
                </tr>
                <tr>
                    <td><?=GetMessage("SEARCH_NOT")?></td>
                    <td>not, ~</td>
                    <td><?=GetMessage("SEARCH_NOT_ALT")?></td>
                </tr>
                <tr>
                    <td>( )</td>
                    <td>&nbsp;</td>
                    <td><?=GetMessage("SEARCH_BRACKETS_ALT")?></td>
                </tr>
            </tbody>
        </table>
    <?elseif(count($arResult["SEARCH"])>0):?>
        <?if($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"];?>
        <p>
            <?if($arResult["REQUEST"]["HOW"]=="d"):?>
                <a href="<?=$arResult["URL"]?>&amp;how=r<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_RANK")?></a>&nbsp;|&nbsp;<b><?=GetMessage("SEARCH_SORTED_BY_DATE")?></b>
            <?else:?>
                <b><?=GetMessage("SEARCH_SORTED_BY_RANK")?></b>&nbsp;|&nbsp;<a href="<?=$arResult["URL"]?>&amp;how=d<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_DATE")?></a>
            <?endif;?>
        </p>
        <hr />
        <?foreach($arResult["SEARCH"] as $arItem):?>
            <h4><a href="<?echo $arItem["URL"]?>"><?echo $arItem["TITLE_FORMATED"]?></a></h4>
            <p><?echo $arItem["BODY_FORMATED"]?></p>
            <small><?=GetMessage("SEARCH_MODIFIED")?> <?=$arItem["DATE_CHANGE"]?></small><br />
            <?if($arItem["CHAIN_PATH"]):?>
                <small><?=$arItem["CHAIN_PATH"]?></small>
            <?endif;?>
            <hr />
        <?endforeach;?>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"];?>
    <?else:?>
        <?=ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND"));?>
    <?endif;?>
</div>