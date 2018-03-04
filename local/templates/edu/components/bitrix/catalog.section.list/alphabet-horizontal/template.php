<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>

<div class="catalog-section-list catalog-section-list-alphabet-horizontal">
    <?foreach($arResult["GROUPS"] as $arGroup):?>

        <div class="abc-item">
            <div class="row">
                <div class="col-sm-2">
                    <div class="h3 letter"><?=$arGroup['TITLE']?></div>
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <?$itemsPerColumn = ceil( count($arGroup['ELEMENTS']) / $arParams['ITEMS_PER_ROW'] );

                        for($col=0; $col < $arParams['ITEMS_PER_ROW']; $col++):?>
                            <div class="<?=$arResult['COLUMN_CLASS']?>">
                                <ul class="list-unstyled">
                                    <?$arGroupItems = array_slice($arGroup['ELEMENTS'], $col * $itemsPerColumn, $itemsPerColumn);

                                    foreach($arGroupItems as $arSection):?>
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
                            </div>
                        <?endfor;?>
                    </div>
                </div>
            </div>
        </div>

    <?endforeach;?>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>
