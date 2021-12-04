// JavaScript Document
// Function to allow one JavaScript file to be included by another.
// Copyright (C) 2006-08 www.cryer.co.uk
function IncludeJavaScript(jsFile){
	document.write('<script type="text/javascript" src="' + jsFile + '"></scr' + 'ipt>');
}

// Modifikasi fungsi IncludeJavaScript untuk memuat file CSS.
// Copyright (C) 2011 alexsibero
function IncludeCSS(cssFile){
	document.write('<link type="text/css" href="'+ cssFile + '" rel="stylesheet">');
}

// Memuat file Javascript
IncludeJavaScript('SpryAssets/xpath.js');
IncludeJavaScript('SpryAssets/SpryData.js');
IncludeJavaScript('SpryAssets/SpryEffects.js');
IncludeJavaScript('SpryAssets/SpryDOMUtils.js');
IncludeJavaScript('SpryAssets/SpryUtils.js');
IncludeJavaScript('SpryAssets/SpryPagedView.js');
IncludeJavaScript('SpryAssets/SpryValidationTextField.js');
IncludeJavaScript('SpryAssets/SpryValidationSelect.js');
IncludeJavaScript('SpryAssets/SpryValidationPassword.js');
IncludeJavaScript('SpryAssets/SpryValidationTextarea.js');

// Memuat file Cascading Style Sheets
IncludeCSS('css/SpryMenuBarHorizontal.css');
IncludeCSS('css/SpryValidationTextField.css');		   
IncludeCSS('css/SpryValidationTextarea.css');
IncludeCSS('css/SpryValidationSelect.css');
IncludeCSS('css/SpryValidationPassword.css');
IncludeCSS('css/layout.css');
IncludeCSS('css/login.css');
IncludeCSS('css/form.css');
IncludeCSS('css/header.css');
IncludeCSS('css/overwrite.css');
IncludeCSS('css/footer.css');


// Fungsi Javascript
function formSubmit(form,callback){
	if(Spry.Widget.Form.validate(Spry.$(form))==true){
		if(form.getAttribute('enctype')=='multipart/form-data'){
			var target = form.getAttribute('target');
			Spry.$(target).addEventListener('load',callback,true);
			form.submit();
			return false;
		}
		else {
			Spry.Utils.submitForm(Spry.$(form),callback);
			return false;
		}
	}
	else
		return false;	
}

function toDecimal(value){
	value = value.replace(',','');
	
	if(value.indexOf(',')!=-1)
		value = toDecimal(value);

	return value;
}

function toCurrency(value){
	value += '';
  	x = value.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}

	return x1 + x2;
}