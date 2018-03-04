<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="bx-voting-result" id="vote-form-<?=$arResult["VOTE"]["ID"]?>">
    <legend><?=GetMessage("RESULTS_CAPTION")?></legend>

    <?if (!empty($arResult["ERROR_MESSAGE"]))
        echo ShowError($arResult["ERROR_MESSAGE"]);

    if (empty($arResult["VOTE"]) || empty($arResult["QUESTIONS"]) )
        return true;

    $i = 1; //порядковый номер вопроса
    ?>
    <?foreach ($arResult["QUESTIONS"] as $arQuestion):?>
        <div>
            <?if ($arQuestion["IMAGE"] !== false):?>
                <div><img src="<?=$arQuestion["IMAGE"]["SRC"]?>" width="30" height="30" /></div>
            <?endif;?>
            <strong><?=$i?>. <?=$arQuestion["QUESTION"]?></strong>
        </div>
        <?if ($arQuestion["DIAGRAM_TYPE"] == "circle"):?>
            <div>
                <img width="300" height="300" class="img-responsive" src="<?=$componentPath?>/draw_chart.php?qid=<?=$arQuestion["ID"]?>&dm=300" />
                <table class="table table-striped">
                    <?foreach ($arQuestion["ANSWERS"] as $arAnswer):?>
                        <tr width="50">
                            <td><div style="background-color:#<?=$arAnswer["COLOR"]?>"></div></td>
                            <td><nobr><?=$arAnswer["COUNTER"]?> (<?=$arAnswer["PERCENT"]?>%)</nobr></td>
                            <td><?=$arAnswer["MESSAGE"]?></td>
                        </tr>
                    <?endforeach?>
                </table>
            </div>
        <?else://histogram?>
            <?foreach ($arQuestion["ANSWERS"] as $arAnswer):?>
                <?=$arAnswer["MESSAGE"]?> &mdash; <?=$arAnswer["COUNTER"]?> (<?=$arAnswer["PERCENT"]?>%)
                <div class="progress">
                    <div class="progress-bar <?=$arAnswer["PROGRESS_BAR_CLASS"]?>" role="progressbar" aria-valuenow="<?=$arAnswer["BAR_PERCENT"]?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$arAnswer["BAR_PERCENT"]?>%">
                        <span class="sr-only"><?=$arAnswer["PERCENT"]?>%</span>
                    </div>
                </div>
            <?endforeach?>
        <?endif;?>
        <?$i++?>
    <?endforeach;?>
</div>
