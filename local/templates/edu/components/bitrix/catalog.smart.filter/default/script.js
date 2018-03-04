var smartFilterBootstrap;

function JCSmartFilterBootstrap(ajaxURL) {
    this.ajaxURL = ajaxURL;
    this.form = null;
    this.timer = null;
}

JCSmartFilterBootstrap.prototype.keyup = function (input) {
    if (this.timer)
        clearTimeout(this.timer);
    this.timer = setTimeout(BX.delegate(function () {
        this.reload(input);
    }, this), 1000);
}

JCSmartFilterBootstrap.prototype.click = function (checkbox) {
    if (this.timer)
        clearTimeout(this.timer);
    this.timer = setTimeout(BX.delegate(function () {
        this.reload(checkbox);
    }, this), 1000);
}

JCSmartFilterBootstrap.prototype.reload = function (input) {
    this.position = BX.pos(input, true);
    this.form = BX.findParent(input, {'tag': 'form'});
    if (this.form) {
        var values = new Array;
        values[0] = {name: 'ajax', value: 'y'};
        this.gatherInputsValues(values, BX.findChildren(this.form, {'tag': 'input'}, true));
        window.curFilterinput = input;
        BX.ajax.loadJSON(
            this.ajaxURL,
            this.values2post(values),
            BX.delegate(this.postHandler, this)
        );
    }
}

JCSmartFilterBootstrap.prototype.postHandler = function (result) {
    if (result.ITEMS) {
        for (var PID in result.ITEMS) {
            var arItem = result.ITEMS[PID];
            if (arItem.PROPERTY_TYPE == 'N' || arItem.PRICE) {
            }
            else if (arItem.VALUES) {
                for (var i in arItem.VALUES) {
                    var ar = arItem.VALUES[i];
                    var control = BX(ar.CONTROL_ID);
                    if (control) {
                        control.disabled = ar.DISABLED;
                    }
                }
            }
        }
        // bootstrap
        $(window.curFilterinput).closest(".smartfilter-bootstrap").find(".form-group>label").popover("destroy");
        var tip = $(window.curFilterinput).closest(".smartfilter-bootstrap").find(".popup_result");
        tip.find(".count").html(result.ELEMENT_COUNT);
        tip.find("a").attr("href", BX.util.htmlspecialcharsback(result.FILTER_URL));
        if (result.FILTER_AJAX_URL && result.COMPONENT_CONTAINER_ID) {
            BX.bind(hrefFILTER[0], 'click', function (e) {
                var url = BX.util.htmlspecialcharsback(result.FILTER_AJAX_URL);
                BX.ajax.insertToNode(url, result.COMPONENT_CONTAINER_ID);
                return BX.PreventDefault(e);
            });
        }

        if (result.INSTANT_RELOAD && result.COMPONENT_CONTAINER_ID) {
            var url = BX.util.htmlspecialcharsback(result.FILTER_AJAX_URL);
            BX.ajax.insertToNode(url, result.COMPONENT_CONTAINER_ID);
        }
        else {
            $(window.curFilterinput).closest(".form-group").find(">label").popover({html: true, content: tip.html()}).popover("show");
        }
    }
}

JCSmartFilterBootstrap.prototype.gatherInputsValues = function (values, elements) {
    if (elements) {
        for (var i = 0; i < elements.length; i++) {
            var el = elements[i];
            if (el.disabled || !el.type)
                continue;

            switch (el.type.toLowerCase()) {
                case 'text':
                case 'textarea':
                case 'password':
                case 'hidden':
                case 'select-one':
                    if (el.value.length)
                        values[values.length] = {name: el.name, value: el.value};
                    break;
                case 'radio':
                case 'checkbox':
                    if (el.checked)
                        values[values.length] = {name: el.name, value: el.value};
                    break;
                case 'select-multiple':
                    for (var j = 0; j < el.options.length; j++) {
                        if (el.options[j].selected)
                            values[values.length] = {name: el.name, value: el.options[j].value};
                    }
                    break;
                default:
                    break;
            }
        }
    }
}

JCSmartFilterBootstrap.prototype.values2post = function (values) {
    var post = new Array;
    var current = post;
    var i = 0;
    while (i < values.length) {
        var p = values[i].name.indexOf('[');
        if (p == -1) {
            current[values[i].name] = values[i].value;
            current = post;
            i++;
        }
        else {
            var name = values[i].name.substring(0, p);
            var rest = values[i].name.substring(p + 1);
            if (!current[name])
                current[name] = new Array;

            var pp = rest.indexOf(']');
            if (pp == -1) {
                //Error - not balanced brackets
                current = post;
                i++;
            }
            else if (pp == 0) {
                //No index specified - so take the next integer
                current = current[name];
                values[i].name = '' + current.length;
            }
            else {
                //Now index name becomes and name and we go deeper into the array
                current = current[name];
                values[i].name = rest.substring(0, pp) + rest.substring(pp + 1);
            }
        }
    }
    return post;
}

/* Новые скрипты */
$(document).ready(function () {
    $(".slider-range").each(initFilterSlider);
    $(".smartfilter-bootstrap").each(function () {
        // Сворачивание-разворачивание фильтров
        $(this).find(".form-group label a").unbind("click", toggleFilter).click(toggleFilter);
        // Скрыть все фильтры кроме первого
        $(this).find(".form-group label a").not($(this).find(".form-group label a").first()).click();
        smartFilterBootstrap = new JCSmartFilterBootstrap($(this).data("ajax-url"));
    });

    $(".smartfilter-bootstrap .slider-value").change(filterInputChanged);
});

/**
 * Запустить слайдер
 */
function initFilterSlider() {
    var self = $(this),
        step = parseInt(self.data("step")),
        max = parseInt(self.data("max")),
        min = parseInt(self.data("min")),
        inputMin = self.closest(".filter-content").find(".slider-min-value"),
        inputMax = self.closest(".filter-content").find(".slider-max-value"),
        valueMax,
        valueMin;
    if (inputMin.val().length > 0) {
        valueMin = inputMin.val();
    }
    else {
        valueMin = min;
    }
    if (inputMax.val().length > 0) {
        valueMax = inputMax.val();
    }
    else {
        valueMax = max;
    }
    self.slider({
        range: true,
        min: min,
        max: max,
        step: step,
        values: [valueMin, valueMax],
        slide: function (event, ui) {
            var oldMin = inputMin.val(), oldMax = inputMax.val();
            inputMin.val(ui.values[ 0 ]);
            inputMax.val(ui.values[ 1 ]);
            if (oldMin != ui.values[ 0 ]) {
                smartFilterBootstrap.keyup(inputMin[0]);
            }
            if (oldMax != ui.values[ 1 ]) {
                smartFilterBootstrap.keyup(inputMax[0]);
            }
        }
    });
}

/**
 * Реакция на изменение значений слайдера вручную.
 */
function filterInputChanged() {
    var self = $(this),
        container = self.closest(".filter-content"),
        slider = container.find(".slider-range"),
        valueMin = container.find(".slider-min-value").val(),
        valueMax = container.find(".slider-max-value").val(),
        oldSliderValues = slider.slider("values");
    console.log(oldSliderValues);
    if (valueMin.length == 0) {
        valueMin = oldSliderValues[0];
    }
    if (valueMax.length == 0) {
        valueMax = oldSliderValues[1];
    }
    slider.slider("values", [valueMin, valueMax]);
    smartFilterBootstrap.keyup(this);
}

/**
 * Свернуть\развернуть фильтр по свойству.
 */
function toggleFilter() {
    var self = $(this);
    self.closest(".form-group").find(".filter-content").slideToggle(200);
}