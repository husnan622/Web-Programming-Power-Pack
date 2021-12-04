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
IncludeJavaScript('SpryAssets/SpryURLUtils.js');
IncludeJavaScript('SpryAssets/SpryHTMLPanel.js');
IncludeJavaScript('SpryAssets/SpryMenuBar.js');
IncludeJavaScript('SpryAssets/SpryAccordion.js');
IncludeJavaScript('SpryAssets/SpryValidationTextField.js');
IncludeJavaScript('SpryAssets/SpryValidationSelect.js');
IncludeJavaScript('SpryAssets/SpryValidationPassword.js');
IncludeJavaScript('SpryAssets/SpryValidationTextarea.js');
IncludeJavaScript('SpryAssets/SpryValidationConfirm.js');
IncludeJavaScript('SpryAssets/SpryTooltip.js');

// Memuat file Cascading Style Sheets
IncludeCSS('css/SpryMenuBarHorizontal.css');
IncludeCSS('css/SpryValidationTextField.css');		   
IncludeCSS('css/SpryValidationTextarea.css');
IncludeCSS('css/SpryValidationSelect.css');
IncludeCSS('css/SpryValidationConfirm.css');
IncludeCSS('css/SpryValidationPassword.css');
IncludeCSS('css/layout1.css');
IncludeCSS('css/layout2.css');
IncludeCSS('css/header.css');
IncludeCSS('css/konten.css');
IncludeCSS('css/kategori.css');
IncludeCSS('css/cart.css');
IncludeCSS('css/footer.css');
IncludeCSS('css/otentikasi.css');
IncludeCSS('css/checkout.css');
IncludeCSS('css/overwrite.css');

// Fungsi Javascript
function formatCurrency(ds,row,index){
	if(row['harga']){
		var harga = parseInt(row['harga'].replace(',',''));
		row['harga']=toCurrency(harga);
	}
		
	if(row['harga_spesial']){
		var harga_spesial = parseInt(row['harga_spesial'].replace(',',''));
		row['harga_spesial']=toCurrency(harga_spesial);
	}
	
	if(row['total']){
		var harga_spesial = parseInt(row['total'].replace(',',''));
		row['total']=toCurrency(harga_spesial);
	}
	
	return row;
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