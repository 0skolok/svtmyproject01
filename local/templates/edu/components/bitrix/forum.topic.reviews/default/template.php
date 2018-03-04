<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="forum-topic-reviews">

    <?if (!empty($arResult["MESSAGES"])):?>
        <?foreach ($arResult["MESSAGES"] as $res):?>
            <div class="media" id="message<?=$res["ID"]?>">
                <?if (intVal($res["AUTHOR_ID"]) > 0 && !empty($res["AUTHOR_URL"])):?>
                    <a class="pull-left" href="<?=$res["AUTHOR_URL"]?>">
                <?else:?>
                    <span class="pull-left">
                <?endif;?>

                <?if($arParams["SHOW_AVATAR"] == "Y"):?>
                    <?if(isset($res["AVATAR"]["HTML"]) > 0) {echo str_replace("img ", "img class='media-object'", $res["AVATAR"]["HTML"]);}
                    else echo '<img class="media-object" src="'.$templateFolder.'/images/noavatar.gif" border="0" />';?>
                <?endif;?>

                <?if (intVal($res["AUTHOR_ID"]) > 0 && !empty($res["AUTHOR_URL"])):?>
                    </a>
                <?else:?>
                    </span>
                <?endif;?>

                <div class="media-body">
                    <h5 class="media-heading">
                        <?if (intVal($res["AUTHOR_ID"]) > 0 && !empty($res["AUTHOR_URL"])):?>
                            <a href="<?=$res["AUTHOR_URL"]?>"><?=$res["AUTHOR_NAME"]?></a>
                        <?else:?>
                            <?=$res["AUTHOR_NAME"]?>
                        <?endif;?>
                        <small><?=$res["POST_DATE"]?></small>
                    </h5>

                    <div class="reviews-text" id="message_text_<?=$res["ID"]?>"><?=$res["POST_MESSAGE_TEXT"]?></div>
                </div>
            </div>
        <?endforeach;?>

        <?if (strlen($arResult["NAV_STRING"]) > 0 && $arResult["NAV_RESULT"]->NavPageCount > 1):?>
            <?=$arResult["NAV_STRING"]?>
        <?endif;
    endif;

    if (empty($arResult["ERROR_MESSAGE"]) && !empty($arResult["OK_MESSAGE"])) {
        echo ShowNote($arResult["OK_MESSAGE"]);
    }

    if ($arResult["SHOW_POST_FORM"] != "Y") return false;?>


    <!--noindex-->
        <div class="reviews-reply-form">
            <?if(!empty($arResult["ERROR_MESSAGE"])) {
                echo ShowError($arResult["ERROR_MESSAGE"]);
            }?>

            <form name="REPLIER<?=$arParams["form_index"]?>" id="postform" action="<?=POST_FORM_ACTION_URI?>#postform" method="POST" class="form-horizontal">
                <fieldset>
                    <legend><?=GetMessage("NEW_COMMENT")?></legend>

                    <input type="hidden" name="back_page" value="<?=$arResult["CURRENT_PAGE"]?>" />
                    <input type="hidden" name="ELEMENT_ID" value="<?=$arParams["ELEMENT_ID"]?>" />
                    <input type="hidden" name="SECTION_ID" value="<?=$arResult["ELEMENT_REAL"]["IBLOCK_SECTION_ID"]?>" />
                    <input type="hidden" name="save_product_review" value="Y" />
                    <input type="hidden" name="preview_comment" value="N" />
                    <?=bitrix_sessid_post()?>

                    <?if (!$arResult["IS_AUTHORIZED"]):/* GUEST PANEL */?>
                        <div class="form-group">
                            <label class="control-label col-md-3 required" for="REVIEW_AUTHOR<?=$arParams["form_index"]?>"><?=GetMessage("OPINIONS_NAME")?></label>
                            <div class="col-md-9">
                                <input name="REVIEW_AUTHOR" id="REVIEW_AUTHOR<?=$arParams["form_index"]?>" class="form-control" size="30" type="text" value="<?=$arResult["REVIEW_AUTHOR"]?>" placeholder="<?=GetMessage("OPINIONS_NAME")?>" />
                            </div>
                        </div>

                        <?if ($arResult["FORUM"]["ASK_GUEST_EMAIL"]=="Y"):?>
                            <div class="form-group">
                                <label class="control-label col-md-3" for="REVIEW_EMAIL<?=$arParams["form_index"]?>"><?=GetMessage("OPINIONS_EMAIL")?></label>
                                <div class="col-md-9">
                                    <input type="text" name="REVIEW_EMAIL" id="REVIEW_EMAIL<?=$arParams["form_index"]?>" class="form-control" size="30" value="<?=$arResult["REVIEW_EMAIL"]?>" placeholder="<?=GetMessage("OPINIONS_EMAIL")?>" />
                                </div>
                            </div>
                        <?endif;?>
                    <?endif;?>

                    <div class="form-group">
                        <label class="control-label col-md-3 required" for="REVIEW_TEXT"><?=$arParams["MESSAGE_TITLE"]?></label>
                        <div class="col-md-9">
                            <textarea name="REVIEW_TEXT" id="REVIEW_TEXT" class="form-control" placeholder="<?=$arParams["MESSAGE_TITLE"]?>"><?=$arResult["REVIEW_TEXT"]?></textarea>
                        </div>
                    </div>

                    <?if (strLen($arResult["CAPTCHA_CODE"]) > 0):/* CAPTHCA */?>
                        <div class="form-group">
                            <label class="control-label col-md-3 required" for="inputCaptcha"><?echo GetMessage("F_CAPTCHA_TITLE")?></label>
                            <div class="col-md-9">
                                <input type="hidden" name="captcha_code" value="<?=$arResult["CAPTCHA_CODE"]?>"/>
                                <p><img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></p>
                                <input type="text" name="captcha_word" maxlength="50" value="" id="inputCaptcha" class="form-control" placeholder="<?echo GetMessage("F_CAPTCHA_PROMT")?>">
                            </div>
                        </div>
                    <?endif;?>

                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <button class="btn btn-primary pull-right" name="send_button" type="submit" value="<?=GetMessage("OPINIONS_SEND")?>" tabindex="<?=$tabIndex++;?>" onclick="this.form.preview_comment.value = 'N';"><?=GetMessage("OPINIONS_SEND")?></button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    <!--/noindex-->
</div>
