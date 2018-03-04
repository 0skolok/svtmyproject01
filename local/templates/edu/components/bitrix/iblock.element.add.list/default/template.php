<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (strlen($arResult["MESSAGE"]) > 0) {
	echo ShowNote($arResult["MESSAGE"]);
}?>

<table class="table">
    <?if($arResult["NO_USER"] == "N"):?>
        <thead>
            <tr>
                <th>#</th>
                <th><?=GetMessage("IBLOCK_ADD_LIST_TITLE")?></th>
                <th><?=GetMessage("IBLOCK_ADD_LIST_ACTIVE")?></th>
                <th>
                    <?if ($arParams["MAX_USER_ENTRIES"] > 0 && $arResult["ELEMENTS_COUNT"] < $arParams["MAX_USER_ENTRIES"]):?>
                        <a class="btn btn-primary" href="<?=$arParams["EDIT_URL"]?>?edit=Y"><?=GetMessage("IBLOCK_ADD_LINK_TITLE")?></a>
                    <?else:?>
                        <?=GetMessage("IBLOCK_LIST_CANT_ADD_MORE")?>
                    <?endif?>
                </th>
            </tr>
        </thead>
    	<tbody>
            <?if (count($arResult["ELEMENTS"]) > 0):?>
                <?foreach ($arResult["ELEMENTS"] as $arElement):?>
                <tr>
                    <td><?=$arElement["ID"]?></td>

                    <?if ($arResult["CAN_EDIT"] == "Y"):?>
                        <td><a href="<?=$arParams["EDIT_URL"]?>?edit=Y&amp;CODE=<?=$arElement["ID"]?>"><?=$arElement["NAME"]?></a></td>
                    <?else:?>
                        <td><?=$arElement["NAME"]?></td>
                    <?endif?>

                    <td><?=is_array($arResult["WF_STATUS"]) ? $arResult["WF_STATUS"][$arElement["WF_STATUS_ID"]] : $arResult["ACTIVE_STATUS"][$arElement["ACTIVE"]]?></td>

                    <td>
                        <?if ($arElement["CAN_DELETE"] == "Y"):?>
                            <a href="?delete=Y&amp;CODE=<?=$arElement["ID"]?>&amp;<?=bitrix_sessid_get()?>" onClick="return confirm('<?echo CUtil::JSEscape(str_replace("#ELEMENT_NAME#", $arElement["NAME"], GetMessage("IBLOCK_ADD_LIST_DELETE_CONFIRM")))?>')"><?=GetMessage("IBLOCK_ADD_LIST_DELETE")?></a>
                        <?endif?>
                    </td>
                </tr>
                <?endforeach?>
            <?else:?>
                <tr>
                    <td colspan="4"><?=GetMessage("IBLOCK_ADD_LIST_EMPTY")?></td>
                </tr>
            <?endif?>
	    </tbody>
    <?endif?>
</table>

<?if (strlen($arResult["NAV_STRING"]) > 0):?>
    <?=$arResult["NAV_STRING"]?>
<?endif?>