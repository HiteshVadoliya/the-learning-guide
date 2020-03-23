$(function () {
	$('.elOrderProductOptions:not(:has(input,select), [data-de-type="ors"] div.elOrderProductOptions), [data-de-type="ors"]').attr('data-title','cf-order-summary');

	$('#bump-offer').off();

	rebuildOrderSummary();
	$('.qty_select, .o2step_step2 [name="purchase[product_id]"], [data-de-type="orpo"] [name="purchase[product_id]"], #bump-offer').on("change", function (ev) {

		$('#bump-offer, [id*="bump_offer_"]').each(function () {
			var bumpId = $(this).val();

			if ($(this).is(':checked')) {
				$('#cfAR [name="purchase[product_ids][]"][value="'+bumpId+'"]').attr('checked', true);
			} else {
				$('#cfAR [name="purchase[product_ids][]"][value="'+bumpId+'"]').attr('checked', false);
			}
		});
		rebuildOrderSummary();
	});
	$('#bump-offer').on("change", function (ev) {
		var bumpId = $(this).data('value');
		if ($(this).is(':checked')) {
			rebuildOrderSummary();
		}
		
	});
});

function getcalculation() {
	var prodSelParent = '[data-de-type="orpo"]';
	var appendTo = 'prise-tab';
	var cartMode = ($('.qty_select').length) ? true : false;
	cartMode = true;

	var $summTemplate = $("#prise-tab");

	var orderTotal = 0.00;
	var orderCurrency = "USD"; //default

	$('[data-title="cf-order-summary"] .elOrderProductOptinProducts').remove();

	var cartProds = {};
	window.qtySelected
	$('#cfAR [name="purchase[product_ids][]"]:checked').each(function () {
		var prodId = $(this).val();

		if (cartProds.hasOwnProperty(prodId)) {
			cartProds[prodId].qty++;
			cartMode = true;
		} else {
			cartProds[prodId] = {qty: 1};
		}
	});

	//$('#cfAR [name="purchase[product_ids][]"]:checked').each(function () {
	$.each(cartProds, function (index, value) {
		var qty = value.qty;
		var prodId = index;

		var $prodItem = $(prodSelParent+' [name="'+prodId+'_qty"]');
		if (!$prodItem.length) {
			$prodItem = $(prodSelParent+' [name="purchase[product_id]"][value="'+prodId+'"]');
		}

		var prodDesc = $prodItem.nextAll('label').html();
		var prodPriceStr = $prodItem.nextAll('.elOrderProductOptinPrice').html();
		if (prodPrices.hasOwnProperty(prodId)) {
			var prodPriceNum = prodPrices[prodId].toFixed(2);
		} else {
			var prodPriceNum = parseFloat(prodPriceStr.replace(/[^0-9\.]+/g, "")).toFixed(2);
		}

		if (!$.isNumeric(prodPriceNum)) {
			prodPriceNum = 0;
		}
		var subTotal = qty * prodPriceNum;
		var currency = $prodItem.nextAll('.elOrderProductOptinPrice').attr("taxamo-currency");
		orderCurrency = currency;

		$currTemplate = $summTemplate.clone();

		var currProdDescObj = $('<div>'+prodDesc+'</div>');
		currProdDescObj.find('br, span.best-seller-head').remove();
		prodDesc = currProdDescObj.text();
		var prodName = prodDesc;
		if (cartMode) {
			prodName = '<span class="prodQty">'+qty+'</span>'+prodDesc;
		}
		
		$currTemplate.find('.product-name').html(prodName);
		var subTotalString = prodPriceStr;
		if (subTotal > 0) {
			subTotalString = subTotal.toLocaleString('fullwide', {style: 'currency', currency: currency});
		}
		$currTemplate.find('.product-price').attr("taxamo-currency",currency).html(subTotalString);

		$currTemplate.appendTo($(appendTo));

		orderTotal += subTotal;
	});

	if (orderTotal) {
		$ttlTemplate = $summTemplate.clone();

		$ttlTemplate.css({'border-top': '1px solid #DDD', 'margin-top': '.5em'});
		$ttlTemplate.find('.product-name').html("<strong>Order Total:</strong>");
		$ttlTemplate.find('.product-price').attr("taxamo-currency",orderCurrency).html(orderTotal.toLocaleString('fullwide', {style: 'currency', currency: orderCurrency}));
		$ttlTemplate.appendTo($(appendTo));

		$('[data-title="cf-order-summary"]').show();
	} else {
		//$('[data-title="cf-order-summary"]').hide();
	}
}