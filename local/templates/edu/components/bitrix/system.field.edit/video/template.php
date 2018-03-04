<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="fields string" id="main_<?=$arParams["arUserField"]["FIELD_NAME"]?>">
    <div class="form-group">
        <label class="control-label col-md-3<?if ($arParams["arUserField"]["MANDATORY"]=="Y"):?> required<?endif;?>"
               for="<?=$arParams["arUserField"]["FIELD_NAME"]?>">
            <?=$arParams["arUserField"]["EDIT_FORM_LABEL"]?>
        </label>
        <div class="col-md-9">



        </div>
    </div>
</div>



<?
if ($arParams["arUserField"]["MULTIPLE"] == "Y")
{
    $tmpName = "bx_tmp_field_div_name[]";
    echo "<div class='bx-tmp-field-div' style='display: none;'>".CUserTypeVideo::GetEditFormHTML(array("SETTINGS" => $arParams['arUserField']["SETTINGS"]),	array("NAME" => $tmpName, "VALUE" => ""))."</div>";

    for($i = 0, $l = count($arParams['arUserField']["VALUE"]); $i < $l; $i++)
    {
        $val = $arParams['arUserField']["VALUE"][$i];
        $name = str_replace("[]", "[".$i."]", $arParams['arUserField']["FIELD_NAME"]);
        if ($val != "")
        {
            echo CUserTypeVideo::GetEditFormHTML(
                array(
                    "SETTINGS" => $arParams['arUserField']["SETTINGS"]
                ),
                array(
                    "NAME" => $name,
                    "VALUE" => $val
                )
            );
            echo "\n<br />\n";
        }
    }
    if ($arParams["arUserField"]["MULTIPLE"] == "Y" && $arParams["SHOW_BUTTON"] != "N" && $arParams["arUserField"]["EDIT_IN_LIST"]!="N"):?>
        <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
                <a href="#" class="action" onClick="addElementVideo('<?=$arParams["arUserField"]["FIELD_NAME"]?>', this, '<?= $tmpName?>'); return false;"><?=GetMessage("USER_TYPE_PROP_ADD")?></a>
                <input type="hidden" value="<?= count($arParams['arUserField']["VALUE"]) - 1?>" />
            </div>
        </div>
    <?endif;
}
else
{
    echo CUserTypeVideo::GetEditFormHTML(
        array(
            "SETTINGS" => $arParams['arUserField']["SETTINGS"]
        ),
        array(
            "NAME" => $arParams['arUserField']["FIELD_NAME"],
            "VALUE" => $arParams['arUserField']["VALUE"]
        )
    );
}
?>
