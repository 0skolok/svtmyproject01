function addDateElement(Name, thisButton)
{
	if (document.getElementById('main_' + Name))
	{
		var element = document.getElementById('main_' + Name).getElementsByClassName('form-group');
		if (element && element.length > 0 && element[0])
		{
			var parentElement = element[0].parentNode, // parent
                newElement = element[element.length-1].cloneNode(true),
                newHTML = newElement.innerHTML;

            newHTML = newHTML.replace(/name="(.*?)\[(\d+)\]"/g, 'name="$1['+element.length+']"');
            newHTML = newHTML.replace(/id="(.*?)\[(\d+)\]"/g, 'id="$1['+element.length+']"');
            newHTML = newHTML.replace(/for="(.*?)\[(\d+)\]"/g, 'for="$1['+element.length+']"');
            newElement.innerHTML = newHTML;

            var items = newElement.getElementsByTagName('input');
            items[0].value = '';

            var items = newElement.getElementsByClassName('icon-remove-circle');
            items[0].style.display = 'inline';


            parentElement.appendChild(newElement);
		}
	}
	return;
}
function removeDateElement(thisButton)
{
    var el = thisButton.parentNode.parentNode;
    el.parentNode.removeChild(el);

    return;
}