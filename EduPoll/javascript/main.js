$(document).ready(function() {
	$(".inline-editable-button.exam-name").click(function() {
		editTextField(
				$(this).parent().find(".inline-editable-text"),
				"name",
				function(inputElement) {
					return inputElement.val().length > 0;
				},
				examNameEditCallback
				);
		return false;
	});
	$(".inline-editable-button.exam-description").click(function() {
		editTextareaField(
				$(this).parent().find(".inline-editable-text"),
				"name",
				function(inputElement) {
					return inputElement.val().length > 0;
				},
				examDescriptionEditCallback
				);
		return false;
	});
	$("form.delete-exam").submit(function() {
		return confirm("Are you sure you want to delete this exam? This action cannot be undone.");
	});
});

function validateField(field, condition) {
	if (field.val().length === 0 && !field.hasClass('error') && !field.hasClass('valid'))
		field.removeClass('valid error');
	else if (condition()) // Valid
		field.removeClass('error').addClass('valid');
	else // Invalid
		field.removeClass('valid').addClass('error');
}

function editField(field, name, inputHTML, inputSelector, condition, submitCondition, submitCallback) {
	var inputElement = $(inputHTML);
	inputElement.val(br2nl(decodeEntities(field.html())));
	field.next().hide();
	field.hide();
	field.after(inputElement);
	var conditionFunc = function() {
		return condition(inputElement);
	};
	validateField(inputElement, conditionFunc);
	field.parent().on("keyup", inputSelector, function (e) {
		validateField(inputElement, conditionFunc);
	});
	field.parent().on("keydown", inputSelector, function (e) {
		if (e.keyCode == 27) {
			editFieldFinish(field, field.html(), inputElement, inputSelector);
		}
		else if (submitCondition(e))
		{
			var valid = inputElement.hasClass('valid');
			if (valid)
				submitCallback(field, name, inputElement, inputSelector);
			return false;
		}
	});
}

function editTextField(field, name, condition, submitCallback) {
	var inputHTML = '<input class="edit ' + name + '" name="' + name + '" type="text" />';
	var inputSelector = "input.edit." + name;
	var submitCondition = function(event) {
		return event.keyCode == 13;
	}
	return editField(field, name, inputHTML, inputSelector, condition, submitCondition, submitCallback);
}

function editTextareaField(field, name, condition, submitCallback) {
	var inputHTML = '<textarea class="edit ' + name + '" name="' + name + '" /></textarea>';
	var inputSelector = "textarea.edit." + name;
	var submitCondition = function(event) {
		return event.keyCode == 13 && !event.shiftKey;
	}
	return editField(field, name, inputHTML, inputSelector, condition, submitCondition, submitCallback);
}

function editFieldFinish(field, html, inputElement, inputSelector) {
	field.html(html);
	field.show();
	inputElement.parent().off("keyup keydown", inputSelector);
	inputElement.remove();
	field.next().toggle();
}

function nl2br (str, is_xhtml) {
	return str.replace(/\n/g, "<br />");
}

function br2nl(str) {
	return str.replace(/<br\s*\/?>/mg,"\n");
}

function decodeEntities(encodedString) {
	var textArea = document.createElement('textarea');
	textArea.innerHTML = encodedString;
	return textArea.value;
}

function htmlspecialchars(string, quote_style, charset, double_encode) {
	//       discuss at: http://phpjs.org/functions/htmlspecialchars/
	//      original by: Mirek Slugen
	//      improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	//      bugfixed by: Nathan
	//      bugfixed by: Arno
	//      bugfixed by: Brett Zamir (http://brett-zamir.me)
	//      bugfixed by: Brett Zamir (http://brett-zamir.me)
	//       revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	//         input by: Ratheous
	//         input by: Mailfaker (http://www.weedem.fr/)
	//         input by: felix
	// reimplemented by: Brett Zamir (http://brett-zamir.me)
	//             note: charset argument not supported
	//        example 1: htmlspecialchars("<a href='test'>Test</a>", 'ENT_QUOTES');
	//        returns 1: '&lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;'
	//        example 2: htmlspecialchars("ab\"c'd", ['ENT_NOQUOTES', 'ENT_QUOTES']);
	//        returns 2: 'ab"c&#039;d'
	//        example 3: htmlspecialchars('my "&entity;" is still here', null, null, false);
	//        returns 3: 'my &quot;&entity;&quot; is still here'

	var optTemp = 0,
	i = 0,
	noquotes = false;
	if (typeof quote_style === 'undefined' || quote_style === null) {
		quote_style = 2;
	}
	string = string.toString();
	if (double_encode !== false) { // Put this first to avoid double-encoding
		string = string.replace(/&/g, '&amp;');
	}
	string = string.replace(/</g, '&lt;')
	.replace(/>/g, '&gt;');

	var OPTS = {
			'ENT_NOQUOTES': 0,
			'ENT_HTML_QUOTE_SINGLE': 1,
			'ENT_HTML_QUOTE_DOUBLE': 2,
			'ENT_COMPAT': 2,
			'ENT_QUOTES': 3,
			'ENT_IGNORE': 4
	};
	if (quote_style === 0) {
		noquotes = true;
	}
	if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
		quote_style = [].concat(quote_style);
		for (i = 0; i < quote_style.length; i++) {
			// Resolve string input to bitwise e.g. 'ENT_IGNORE' becomes 4
			if (OPTS[quote_style[i]] === 0) {
				noquotes = true;
			} else if (OPTS[quote_style[i]]) {
				optTemp = optTemp | OPTS[quote_style[i]];
			}
		}
		quote_style = optTemp;
	}
	if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
		string = string.replace(/'/g, '&#039;');
	}
	if (!noquotes) {
		string = string.replace(/"/g, '&quot;');
	}

	return string;
}