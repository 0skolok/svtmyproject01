function addFileElement(Name, thisButton)
{
    if (document.getElementById('main_' + Name))
    {
        var element = document.getElementById('main_' + Name).getElementsByClassName('form-group');
        if (element && element.length > 0 && element[0])
        {
            var parentElement = element[0].parentNode,// parent
                childElement = element[element.length-1].cloneNode(true);

            var filenames = childElement.getElementsByClassName('choose');
            filenames[0].innerHTML = filenames[0].getAttribute('data-default');
            //filenames[0].style.display = 'none';

            var files = childElement.getElementsByTagName('input');
            files[0].value = '';
            files[1].value = '';

            var img = childElement.getElementsByTagName('img');
            if (img && img.length > 0 && img[0]) {
                img[0].parentNode.removeChild(img[0]);
            }
            var label = childElement.getElementsByClassName('checkbox');
            if (label && label.length > 0 && label[0]) {
                label[0].parentNode.removeChild(label[0]);
            }

            var items = childElement.getElementsByClassName('icon-remove-circle');
            items[0].style.display = 'inline';

            parentElement.appendChild(childElement);
        }
    }
    return;
}

function removeFileElement(thisButton)
{
    var el = thisButton.parentNode.parentNode;
    el.parentNode.removeChild(el);

    return;
}