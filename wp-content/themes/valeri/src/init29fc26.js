var POPULAR = function (id, count) {
/*
    $.ajax({
        type: "POST",
        url: '/cart/addtocart',
        data: {id: id, q: count},
    });
*/
}
// правка на el-postel

$(document).ready(function () {

    document.mobile = false;

    bg = $(".DarkBg");
    popup = $(".Popup");
    var block = $(".PopupBlock", popup);
    // info size
    $(".btnsize").click(function () {
        hideFlash();
        var msg = $(this).attr('rel');
        var linkpage = $(this).attr('href');
        block.load(linkpage, {}, function () {
            //initOrderForm(block);
            //block.find("textarea[name='message']").val(msg);
            bg.fadeIn(300);
            popup.css({'top': (getBodyScrollTop() + 50) + 'px'});
            popup.show();
            $(".CloseButton", popup).add(bg).unbind().click(function () {
                bg.fadeOut(300);
                popup.hide();
                showFlash();
            });
        });
        return false;
    });
    // Форма заказа звонка
    // Форма заказа
    $(".button.order").click(function () {
        hideFlash();
        var msg = $(this).attr('rel');
        block.load('order/' + $(this).attr('id'), {}, function () {
            initOrderForm(block);
            block.find("textarea[name='message']").val(msg);
            bg.fadeIn(300);
            popup.css({'top': (getBodyScrollTop() + 50) + 'px'});
            popup.show();
            $(".CloseButton", popup).add(bg).unbind().click(function () {
                bg.fadeOut(300);
                popup.hide();
                showFlash();
            });
        });
    });
    // Форма отзыва

    var hideFlash = function () {
        $("iframe,object,embed").not("#vk_groups iframe, #ok_group_widget iframe").hide();
    }
    var showFlash = function () {
        $("iframe,object,embed").not("#vk_groups iframe, #ok_group_widget iframe").show();
    }
    // Fancybox
    $("a.fancybox").fancybox({
        'transitionIn': 'elastic',
        'transitionOut': 'elastic',
        'speedIn': 600,
        'speedOut': 200,
        'overlayShow': false,
        'hideOnOverlayClick': true
    });

    // Корзина
    cart = new Cart('cart');
    var cartButton = $(".top_button");


    function sendMessage(text){
        var wpcf = $('#wpcf7-f49-o1');
        var area = $('.wpcf7-textarea', wpcf);
        var button = $('.wpcf7-submit', wpcf);

        area.val(text);
        button.click();

        $('.modal_contain').fadeOut(200);
        $('.modal_contain_clbk').fadeOut(200);

        $('.modal_contain_success').fadeIn(200);


    }


    // добавляем  товар в корзину
    $(".add_to_cart").click(function () {

        var price = $(this).parents('.main').find('.product_price').text();
        var price_old = $(this).parents('.main').find('.price_old').text();
		var name = $(this).parents('.main').find('h3').text();
		var _src = $(this).parents('li').find('.image').find('img').attr('src');
        var code = $(this).parents('li').find('.image').find('[name="code"]').val();
        var crm_id = $(this).parents('li').find('.image').find('[name="crm_id"]').val();

        var reg = /\s*,\s*/;
        var sizes = $(this).parents('li').find('.sizes-in-product').attr('val');
        sizes = sizes ? sizes.split(reg) : false;
        var sizes_line = '';
        
        for (var i = 0; i < sizes.length; i++) {
            var size = sizes[i];
            sizes_line += '<option value="Размер ' + size + '"> ' + size + ' </option>';
        }

        //get sizes-to-id array
        var sizes_to_id = $(this).parents('li').find('.sizes-in-product-to-id').attr('val');

		$('.order_modal .image img').attr('src', _src);
		$('.order_modal .price_span_old').text(price_old);
		$('.order_modal .p-price .price_span').text(price);
		$('.order_modal .form [name="price"]').val(price);
		$('.order_modal .form [name="artikul"]').val(code);

		$('.order_modal .form [name="bitrix_id"]').val(crm_id);
		$('.order_modal .form [name="sizes_to_id"]').val(sizes_to_id);

        $('.order_modal .form [name="product"]').val(name);
        if(sizes){
            $('.order_modal .form .select-size').html(sizes_line);
        } else {
            $('.order_modal .form .select-size').parent().remove();
        }
		
		$('.shadow_site, .modal_contain').fadeIn();
		
        return false;
    });

    $('.send_product_but').click(function(){

        //Проверим чтобы номер телефона начинался с 9-ки или 4-ки
        $('.error-novalid-phone').hide();
        $('.error-empty-phone').hide();
        //Проверим чтобы номер телефона начинался с 9-ки или 4-ки КОНЕЦ

        var wrap = $(this).parents('.modal_contain');
        var price_old = $('.price_span_old', wrap).text();
        var price = $('.price_span', wrap).text();
		var name = $('[name="product"]', wrap).val();
        var code = $('[name="artikul"]', wrap).val();

        var product_id = $('[name="bitrix_id"]', wrap).val();
        var sizes_to_id = $('[name="sizes_to_id"]', wrap).val();
        //alert(sizes_to_id);

        //utm
        var utm_source = $('[name="utm_source"]').val();
        var utm_medium = $('[name="utm_medium"]').val();
        var utm_content = $('[name="utm_content"]').val();
        var utm_campaign = $('[name="utm_campaign"]').val();
        var utm_term = $('[name="utm_term"]').val();
        //utm END

        var size = $('[name="FormLanding[comment]"]', wrap).val();
        var fioInput = $('[name="FormLanding[fio]"]', wrap);
        var phoneInput = $('[name="FormLanding[phone]"]', wrap);
        var fio = fioInput.val();
        var phone = phoneInput.val();

        var message = 'Форма заказа товара: \n';
        message += 'Наименование: ' + name + '\n';
        message += 'Артикул: ' + code + '\n';
        if(size){
            message += 'Размер: ' + size + '\n';
        }
        message += 'Цена: ' + price_old + '\n';
        message += 'Цена по скидке: ' + price + '\n\n';
        message += 'Имя: ' + fio + '\n';
        message += 'Телефон: ' + phone + '\n';

        var error = false;

        if(fio.length == 0){
            fioInput.css({border: '2px solid red'});
            error = true;
        }

        //Проверим чтобы номер телефона начинался с 9-ки или 4-ки
        if(phone.length == 0){
            phoneInput.css({border: '2px solid red'});
            $('.error-empty-phone').show();
            error = true;
        }else if(phone[3] != 4 && phone[3] != 9){
            phoneInput.css({border: '2px solid red'});
            $('.error-novalid-phone').show();
            error = true;
        }
        //Проверим чтобы номер телефона начинался с 9-ки или 4-ки КОНЕЦ

        if(error){
            return false;
        }


        $.ajax({
            type: "POST",
            url: '/bitrix/add_lead.php',
            data: {
                product_id: product_id,
                product: name,
                artikul: code,
                size: size,
                price: price,
                fio: fio,
                phone: phone,
                sizes_to_id: sizes_to_id,
                utm_source: utm_source,
                utm_medium: utm_medium,
                utm_content: utm_content,
                utm_campaign: utm_campaign,
                utm_term: utm_term,
                message: message
            },
        });

        sendMessage(message);

    });

    //Проверим чтобы номер телефона начинался с 9-ки или 4-ки
    $('[name="FormLanding[phone]"]').on('focus', function(){
        $('input').on('[name="FormLanding[phone]"] keyup', function(e) {
            var wrap = $(this).parents('.modal_window');
            var phoneInput = $('[name="FormLanding[phone]"]', wrap);
            $('.error-novalid-phone').hide();
            $('.error-empty-phone').hide();
            phoneInput.css({border: '1px solid #CDCDCD'});
            var checkPhone = phoneInput.val();
            //console.log(checkPhone[3]);
            if(checkPhone[3]){
                if(checkPhone[3] != 4 && checkPhone[3] != 9 && checkPhone[3] != '*' && checkPhone[3] != ''){
                    phoneInput.css({border: '2px solid red'});
                    $('.error-novalid-phone').show();
                }
            }
        });
    });
    //Проверим чтобы номер телефона начинался с 9-ки или 4-ки КОНЕЦ

    $('.send_phone_but').click(function(){
        var wrap = $(this).parents('.modal_window');

        //Проверим чтобы номер телефона начинался с 9-ки или 4-ки
        $('.error-novalid-phone').hide();
        $('.error-empty-phone').hide();
        //Проверим чтобы номер телефона начинался с 9-ки или 4-ки КОНЕЦ

        var fioInput = $('[name="FormLanding[fio]"]', wrap);
        var phoneInput = $('[name="FormLanding[phone]"]', wrap);
        var fio = fioInput.val();
        var phone = phoneInput.val();
        //utm
        var utm_source = $('[name="utm_source"]').val();
        var utm_medium = $('[name="utm_medium"]').val();
        var utm_content = $('[name="utm_content"]').val();
        var utm_campaign = $('[name="utm_campaign"]').val();
        var utm_term = $('[name="utm_term"]').val();
        //utm END

        var message = 'Форма заказа звонка: \n';
        message += 'Имя: ' + fio + '\n';
        message += 'Телефон: ' + phone + '\n';


        var error = false;

        if(fio.length == 0){
            fioInput.css({border: '2px solid red'});
            error = true;
        }

        //Проверим чтобы номер телефона начинался с 9-ки или 4-ки
        if(phone.length == 0){
            phoneInput.css({border: '2px solid red'});
            $('.error-empty-phone').show();
            error = true;
        }else if(phone[3] != 4 && phone[3] != 9){
            phoneInput.css({border: '2px solid red'});
            $('.error-novalid-phone').show();
            error = true;
        }
        //Проверим чтобы номер телефона начинался с 9-ки или 4-ки КОНЕЦ

        if(error){
            return false;
        }
        console.log(message);

        $.ajax({
            type: "POST",
            url: '/bitrix/add_lead.php',
            data: {
                fio: fio,
                phone: phone,
                message: message,
                utm_source: utm_source,
                utm_medium: utm_medium,
                utm_content: utm_content,
                utm_campaign: utm_campaign,
                utm_term: utm_term
            },
        });

        sendMessage(message);
    });
	
	// $(".order-form").on('submit', function(e){
	// 	e.preventDefault();
	// 	$.ajax({
	// 		type: 'POST',
	// 		url: '/send_lead.php',
	// 		data: $(this).serialize(),
	// 	}).done(function(response) {
	// 		if(response == 1){
	// 			$('.modal_contain').hide();
	// 			$('.order_success p').text('Ваш заказ успешно оформлен. Наш менеджер перезвонит вам в ближайшее время!');
	// 			$('.modal_contain_success').show();
	// 			window.location.replace('/thanks.html'); 
	// 		}else{
	// 			alert('Заказ не был отправлен из за технической ошибки. Пожалуйста, позвоните по номеру телефону указанному в шапке сайта, для подтверждения заказа');
	// 		}
	// 	});
	// });
	
	// $(".callback-form").on('submit', function(e){
	// 	e.preventDefault();
	// 	$.ajax({
	// 		type: 'POST',
	// 		url: '/send.php',
	// 		data: $(this).serialize(),
	// 	}).done(function(response) {
	// 		if(response == 1){
	// 			$('.modal_contain_clbk').hide();
	// 			$('.order_success p').text('Ваша заявка принята! Наш менеджер перезвонит вам в ближайшее время');
	// 			$('.modal_contain_success').show();
	// 		}else{
	// 			alert('Заказ не был отправлен из за технической ошибки. Пожалуйста, позвоните по номеру телефону указанному в шапке сайта, для подтверждения заказа');
	// 		}
	// 	});
	// });
	
	$(".contacts a").click(function () {
		
		/*
        price=$(this).parents('.main').find('.product_price').text();
        price_old=$(this).parents('.main').find('.price_old').text();
        position=$(this).parents('.main').find('.active_button').data('pos');


        cart.add($(this).data('id')+':'+position, 1);
        cartButton.click();
		*/
		
		$('.shadow_site, .modal_contain_clbk').fadeIn();
		
        return false;
    });

    // Всплывающее окно
    if ($("body").attr('rel') == 'popup' && !$.cookie('no_exit')) {
        var exitsplashmessage = $("body").attr('name');

        function addLoadEvent(func) {
            var oldonload = window.onload;
            if (typeof window.onload != 'function') {
                window.onload = func;
            } else {
                window.onload = function () {
                    if (oldonload) {
                        oldonload();
                    }
                    func();
                }
            }
        }

        function addClickEvent(a, i, func) {
            if (typeof a[i].onclick != 'function') {
                a[i].onclick = func;
            }
        }

        var PreventExitSplash = false;

        function DisplayExitSplash() {
            if (PreventExitSplash == false) {
                //$.cookie('no_exit', 1, {expires: 1,path: "/"});//ставим куки
                //$(".button.call:eq(0)").click();
                return exitsplashmessage;
            }
        }

        var a = document.getElementsByTagName('A');
        for (var i = 0; i < a.length; i++) {
            if (a[i].target !== '_blank') {
                addClickEvent(a, i, function () {
                    PreventExitSplash = true;
                });
            } else {
                addClickEvent(a, i, function () {
                    PreventExitSplash = false;
                });
            }
        }
        disablelinksfunc = function () {
            var a = document.getElementsByTagName('A');
            for (var i = 0; i < a.length; i++) {
                if (a[i].target !== '_blank') {
                    addClickEvent(a, i, function () {
                        PreventExitSplash = true;
                    });
                } else {
                    addClickEvent(a, i, function () {
                        PreventExitSplash = false;
                    });
                }
            }
        }

        addLoadEvent(disablelinksfunc);
        disableformsfunc = function () {
            var f = document.getElementsByTagName('FORM');
            for (var i = 0; i < f.length; i++) {
                if (!f[i].onclick) {
                    f[i].onclick = function () {
                        PreventExitSplash = true;
                    }
                } else if (!f[i].onsubmit) {
                    f[i].onsubmit = function () {
                        PreventExitSplash = true;
                    }
                }
            }
        }
        addLoadEvent(disableformsfunc);
        window.onbeforeunload = DisplayExitSplash;
    }
});

var img1 = new Image();
img1.src = 'images/Popup1.png';
var img2 = new Image();
img2.src = 'images/Popup2.png';

// Всплывающая информация
$(".popinfo").click(function () {
    hideFlash();
    block.load($(this).attr('href'), {}, function () {
        bg.fadeIn(300);
        popup.css({'top': (getBodyScrollTop() + 50) + 'px'});
        popup.show();
        $(".CloseButton", popup).add(bg).unbind().click(function () {
            bg.fadeOut(300);
            popup.hide();
            showFlash();
        });
    });
    return false;
});

var bg, popup, cart, filter;

// объект корзина
function Cart(name) {
    this.name = name;
    var counter = $("#cartCounter");

    this._init = function () {
        var cookie = $.cookie(this.name);
        this.items = cookie ? $.parseJSON(cookie) : {};
        if (!this.items) {
            $.cookie(this.name, null);
        }
        counter.text(this.count());
    };

    this.count = function () {
        var i = 0;
        $.each(this.items, function (j, item) {
            i++;
        });
        return i;
    };

    this.add = function (val, count) {
        this.items[val] = this.items[val] ? parseInt(this.items[val]) + parseInt(count) : count;
        this._refresh();
    };

    this.edit = function (val, count) {
        this.items[val] = count;
        this._refresh();
    };

    this.del = function (val) {
        delete this.items[val];
        this._refresh();
    };

    this._refresh = function () {
        $.cookie(this.name, $.toJSON(this.items), {expires: 30, path: '/'});
        counter.text(this.count());
    };

    this.clear = function () {
        this.items = {};
        $.cookie(this.name, null, {expires: 30, path: '/'});
        counter.text(0);
    };

    this._init();
}

/*
var initCart = function (block) {
    // Сохранение
    $("form .Buttons .send", block).click(function () {
        $(this).unbind();
        $("form", block).submit(function () {

            $(this).ajaxSubmit({
                success: function (data) {
                    if (data == 'ok') {
                        $(".successHide", block).hide();
                        $(".successShow", block).show();
                        cart.clear();
                    } else {
                        block.html(data);
                        initOrderForm(block);
                    }
                }
            });
            return false;
        }).submit();
        return false;
    });
    // Отмена
    $("form .Buttons .cancel", block).click(function () {
        bg.click();
        return false;
    });
    // Очистить
    $("form .Buttons .clear", block).click(function () {
        bg.click();
        cart.clear();
        return false;
    });
    // Удалить
    $("form .button.delete", block).click(function () {
        var id;
        var value;

        if ($(this).parents('tr').find("input[name^='count']").val()) {
            value = $(this).parents('tr').find("input[name^='count']").val();
        } else {
            value = $(this).parent().prev().find("input[name^='count']").val();
        }

        if ($(this).parents("tr").attr('rel')) {
            id = $(this).parents("tr").attr('rel');
            cart.del(id);
        } else {
            id = $(this).parent().attr('rel');
            cart.del(id);
        }



        POPULAR(
            id.split(':')[0],
            -value
        );


        //cart.del($(this).parents("tr").attr('rel'));
        //$(this).parents("tr").remove();

        var cart_item = $('*[data-product-id="' + id + '"]');
        $(cart_item).remove();


        if (cart.count() == 0) {
            $("tr[rel='shipping']", block).remove();
        }
        $("#cartTotalPrice, #cartTotalPrice2").load('cart/total');
        return false;
    });


    // Кол-во

    $("form input[name^='count'], .cart-product-count input[name^='count']", block).change(function () {

        var id = $(this).data('product-id');
        var price = $(this).data('product-price');


        cart.edit(id, $(this).val());

        $("#cartTotalPrice, #cartTotalPrice2").load('cart/total', {}, function () {
            total = intval(+$("#cartTotalPrice").text());
            if (total > freeShipping && freeShipping) {
                $("tr[rel='shipping']", block).hide();
            } else {
                $("#cartTotalPrice, #cartTotalPrice2").text(total + shipping);
                $("tr[rel='shipping']", block).show();
            }
        });
    })
    ;
    // Free shipping check
    var total = intval($("#cartTotalPrice").text());
    var freeShipping = intval($("#freeShippingPrice").text());
    var shipping = intval($("#shippingPrice").text());
    if (total > freeShipping && freeShipping) {
        $("tr[rel='shipping']", block).hide();
    } else {
        $("#cartTotalPrice, #cartTotalPrice2").text(total + shipping);
        $("tr[rel='shipping']", block).show();
    }
    // Смежные товары
    $(".catalog .button.cart", block).click(function () {
        cart.add($(this).attr('id'), 1);
        $(".topbutton.cart").click();
    });
}
*/


/*
var initOrderForm = function (block) {
    // Сохранение
    $("form .Buttons .send", block).click(function () {
        $(this).unbind();
        if ($(this).attr('rel')) {
            $("form", block).attr('action', $("form", block).attr('action') + '/' + $(this).attr('rel'));
        }
        $("form", block).submit(function () {
            $(this).ajaxSubmit({
                success: function (data) {

                    //Гдето то тут запускаем транзакцию

                    if (data == 'ok') {
                        //eval('dataLayer.push({'+ data+'});');
                        $(".successHide", block).hide();
                        $(".successShow", block).show();
                        cart.clear();
                    } else {
                        block.html(data);
                        initOrderForm(block);
                    }
                }
            });
            return false;
        }).submit();
        return false;
    });
    // Отмена
    $("form .Buttons .cancel", block).click(function () {
        $(".DarkBg").click();
        block.load($("form", block).attr('action'), {}, function (data) {
            block.html(data);
            initOrderForm(block);
        });

        return false;
    });
    // Оплата
    $("form .Buttons .pay", block).click(function () {
        //$(this).unbind();
        $("form", block).attr('action', $("form", block).attr('action') + '/pay');
        $("form .Buttons .send", block).click();
        return false;
    });
    // mask

        $('.phone_number', block).each(function (i, item) {
            var mask = $(item).attr('rel');
            $(this).mask("+7(999)999-99-99");
        });

}
*/


function getBodyScrollTop() {
    return self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
}

function intval(mixed_var, base) {    // Get the integer value of a variable
    var tmp;
    if (typeof(mixed_var) == 'string') {
        tmp = parseInt(mixed_var);
        if (isNaN(tmp)) {
            return 0;
        } else {
            return tmp;
        }
    } else if (typeof(mixed_var) == 'number') {
        return Math.floor(mixed_var);
    } else {
        return 0;
    }
}
