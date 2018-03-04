<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>

<div class="catalog-section-list catalog-section-list-alphabet-vertical">
    <div class="row">

        <?for($col=0; $col < $arParams['ITEMS_PER_ROW']; $col++):?>
            <div class="<?=$arResult['COLUMN_CLASS']?>">
                <?if (!isset($arResult["COLUMN_GROUPS"][$col])):?>
                    </div>
                <?continue;
                endif;?>

                <?$arGroups = array_slice($arResult["GROUPS"], $arResult["COLUMN_GROUPS"][$col]['FIRST'], $arResult["COLUMN_GROUPS"][$col]['LENGTH']);

                foreach($arGroups as $group):?>
                    <div class="abc-item">
                        <div class="h3 letter"><?=$group['TITLE']?></div>
                    </div>

                    <ul class="list-unstyled">
                        <?foreach ($group['ELEMENTS'] as $arSection):?>
                            <?
                            $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
                            $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
                            ?>

                            <li id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                                <a class="title" href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
                                <?if ($arParams["COUNT_ELEMENTS"]):?>
                                    <span class="badge"><?=$arSection['ELEMENT_CNT'];?></span>
                                <?endif;?>
                            </li>
                        <?endforeach;?>
                    </ul>
                <?endforeach;?>

            </div>
        <?endfor;?>

    </div>

</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>
