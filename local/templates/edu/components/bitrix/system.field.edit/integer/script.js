function addIntElement(Name, thisButton)
{
	if (document.getElementById('main_' + Name))
	{
		var element = document.getElementById('main_' + Name).getElementsByClassName('form-group');
		if (element && element.length > 0 && element[0])
		{
            var parentElement = element[0].parentNode,// parent
                childElement = element[element.length-1].cloneNode(true);

            var items = childElement.getElementsByTagName('input');
            items[0].value = '';
            parentElement.appendChild(childElement);
		}
	}
	return;
}

function removeIntElement(thisButton)
{
    var el = thisButton.parentNode.parentNode;
    el.parentNode.removeChild(el);

    return;
}