function ConfirmLink(Link, Action) {
	if(typeof(window.opera) != 'undefined') {
		return true;
		}

	var is_confirmed = confirm(Action);
	if(is_confirmed) {
		Link.href += '&confirmed=1';
		}

	return is_confirmed;
	}