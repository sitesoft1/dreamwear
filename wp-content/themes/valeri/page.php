<?php get_header(); ?>

<body>
  
  <script type="text/javascript">
  /*<![CDATA[*/
    lvjq1(document).ready(function () {lvjq1(".lv-form-timezone").val(new Date().getTimezoneOffset());});
  /*]]>*/
  </script>



  <header class="first_color">
    <div class="wrapper row">
      <div class="logo">
        <a href="/"><img src="<?=DIR?>/src/logo.png" alt="Dream Wear — Одежда для женщин с пышными формами"><br>
          <span>• Одежда для женщин с пышными формами •</span>
        </a>
      </div>
    </div>
    
    <div class="hline">
      <ul class="headline">
        <li>
          100% качество продукции
        </li>
        <li>
          Постоянные покупатели по всему миру
        </li>
        <li>
          Собственное фабричное производство
        </li>
      </ul>
    </div>
  </header>

<div class="contact mob">Связаться с отделом по дружбе с клиентами: <a href="tel:+74991319687 ">+7 (499) 113-69-78 </a></div>

<div class="backcall" onclick="$(&#39;.contacts a&#39;).click();">Заявка на звонок</div>

<div class="contact pc">Связаться с отделом по дружбе с клиентами: <a href="tel:+74991319687 ">+7 (499) 113-69-78 </a></div>

<div class="container-fluid">
	<div class="row dblock">
		<div class="col-md-6 green">
			<div class="title">СЕЗОННАЯ<br><span>ЛИКВИДАЦИЯ</span><br><span>КОЛЛЕКЦИИ</span></div>
			<!--<div class="title">СЕЗОННАЯ<br><span>ЕВРОПЕЙСКАЯ</span><br><span>КОЛЛЕКЦИЯ</span></div>-->
			<div class="to-catalog">перейти в каталог</div>
			<div class="to-buttons">
        <?php
          $category = get_terms( 'category_products', [
            'hide_empty' => false,
          ] );

          $category = (array) $category;
          
          foreach($category as $val){
            echo '<a href="#' . $val->slug . '" class="to-anch">' . $val->name . '</a>';
          }
          
        ?>
			</div>
			
			<div class="delivery">Быстрая доставка по всей России</div>
		</div>
		
		<div class="col-md-6 un-green">
			<div class="title">Только сегодня<br><span>Скидки до 50%</span><br>на всю продукцию!</div>
			<div class="title"><span>Платья</span><br>из Европы!</div>
			<div class="row">
				<div class="col-xs-4">
					 <div class="timer">
						<div class="hours">14<div class="snd-b"></div></div>
						<div class="legend">часы</div>
					</div>
				</div>
				
				<div class="col-xs-4">
					<div class="timer">
						<div class="minutes">51<div class="snd-b"></div></div>
						<div class="legend">минуты</div>
					</div>
				</div>
				
				<div class="col-xs-4">
					<div class="timer">
						<div class="seconds">29<div class="snd-b"></div></div>
						<div class="legend">секунды</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="catalog_box second_color">

</div>

<?php
  $category = get_terms( 'category_products', [
    'hide_empty' => false,
  ] );

  $category = (array) $category;
  
  foreach($category as $val){
?>
  <div class="catalog_box second_color">
    <div class="wrapper">
      <h3 id="<?=$val->slug?>"><?=$val->name?></h3>
      <ul class="list_items list_items1">
        <?php
          $posts = get_posts( array(
            'numberposts' => -1,
            'post_type'   => 'products',
            'tax_query' => array(
              array(
                'taxonomy' => 'category_products',
                'terms' => $val->term_id
              )
            )
          ) );
          
          foreach( $posts as $post ){
            setup_postdata($post);
            require 'templates/product.php';
          }

          wp_reset_postdata();
        ?>
      </ul>
    </div>
  </div>
<?php
  }
?>

</div>
<div class="sale_box first_color">
    <div class="wrapper row">
        <div class="text">Только сегодня<span>Скидки до 50%</span>на всю продукцию!</div>
        <div class="row" style="margin-top: 50px;">
			<div class="col-md-3"></div>
			<div class="col-md-6">

        <div class="row">
					<div class="col-xs-4">
						<div class="timer">
							<div class="hours">14<div class="snd-b"></div></div>
							<div class="legend">часы</div>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="timer">
							<div class="minutes">51<div class="snd-b"></div></div>
							<div class="legend">минуты</div>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="timer">
							<div class="seconds">29<div class="snd-b"></div></div>
							<div class="legend">секунды</div>
						</div>
          </div>
        </div>
        
			</div>
		</div>
		
	</div>
</div>
<div class="privilege_box second_color">
    <div class="wrapper">
        <ul>
            <li>
                <div class="icon_border">
                    <div class="icon price"></div>
				</div>
                <div class="text">
					<span>
						ЦЕНЫ ПРОИЗВОДИТЕЛЯ БЕЗ ПОСРЕДНИКОВ
					</span>
                    вся одежда, представленная на сайте, присутствуюет в наличии у нас на складе. 
				</div>
			</li>
            <li>
                <div class="icon_border">
                    <div class="icon quality"></div>
				</div>
                <div class="text">
					<span>
						ЕВРОПЕЙСКОЕ КАЧЕСТВО
					</span>
                    на одежду 100% гарантия, не рвется, не усаживается, не линяет. проверено временем, нашими клиентами
                    и нашей службой контроля качества.
				</div>
			</li>
            <li>
                <div class="icon_border">
                    <div class="icon guarantee"></div>
				</div>
                <div class="text">
					<span>
						ГАРАНТИЯ ВОЗВРАТА ДЕНЕГ
					</span>
                    если вам не подойдет размер, вы захотите обменять его на другой, или попросту сдать - мы вернем вам
                    100% денег. вы ничем не рискуете.
				</div>
			</li>
            <li>
                <div class="icon_border">
                    <div class="icon pay"></div>
				</div>
                <div class="text">
					<span>
						ОПЛАТА ПРИ ПОЛУЧЕНИИ 
					</span>
					вы оплачиваете заказ при получении в пункте выдачи.
				</div>
			</li>
            <li>
                <div class="icon_border">
                    <div class="icon production"></div>
				</div>
                <div class="text">
					<span>
						СВОЕ ПРОИЗВОДСТВО В ЕВРОПЕ
					</span>
                    поэтому мы можем предложить вам самые выгодные цены, а также самое высокое качество одежды в россии
				</div>
			</li>
            <li>
                <div class="icon_border">
                    <div class="icon delivery"></div>
				</div>
                <div class="text">
					<span>
						БЫСТРАЯ ДОСТАВКА
					</span>
                    Экспресс доставка по всей России
				</div>
			</li>
		</ul>
	</div>
</div>

<div class="chart_box first_color" style="padding-top: 50px;">
    <div class="wrapper">
        <h2>Схема работы</h2>
        <ul class="row">
            <li>
                <span>1</span>
                <div class="text">
                    Сделайте заказ<br> на сайте
				</div>
			</li>
            <li>
                <span>2</span>
                <div class="text">Наши менеджеры свяжутся<br>
                    с вами для уточнения деталей
				</div>
			</li>
            <li>
                <span>3</span>
                <div class="text">Мы отправим Ваш заказ<br>
                    Почтой России или курьером
				</div>
			</li>
            <li>
                <span>4</span>
                <div class="text">Вы наслаждаетесь<br>
                    стильной одеждой!<br>
				</div>
			</li>
		</ul>
	</div>
</div>

<div class="reviews_box first_color">
    <div class="wrapper">
        <!--<h2>Отзывы</h2>
        <div class="tab-content" id="tab-text">
            <div class="row text-center">
                <div class="col-sm-12 col-xs-12">
                  	<hr>
                    <div class="review">
                      	<p class="lead" style=" text-align: left; font-weight: bold;">Агата, 40 лет. Краснодар.</p>
                        <p style="text-align:left">Наконец-то стали шить красивые стильные платья не только для худышек модельной внешности, но и для нас, крупных барышень. Раньше была целая проблема что-то себе подобрать. Сейчас уже второе платье покупаю на этом сайте. Доставка быстрая, идут размер в размер. И очень много интересных моделей! ТО что на мне - Стефани, есть другие расцветки, но мне очень понравился зеленый, такой летний. В общем покупкой довольна. </p>
					</div>
                    <img data-src="" alt="" class="photo" style="max-width: 300px;" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==">
				</div>
                <br><br>
                <div class="col-sm-12 col-xs-12">
                  	<hr>
                    <div class="review">
                      	<p class="lead" style=" text-align: left; font-weight: bold;">Марина, 37 лет. Москва</p>
                        <p style="text-align:left">Делюсь своим отзывом о платье Одри. В целом все хорошо, по размеру подошло, расцветка универсальная, мне очень подошла длина чуть ниже колен, скрывает полноту. Как будет носиться посмотрим. </p>
					</div>
                    <img data-src="" alt="" class="photo" style="max-width: 300px;" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==">
				</div>
                <br><br>
                <div class="col-sm-12 col-xs-12">
                  	<hr>
                    <div class="review">
                      	<p class="lead" style=" text-align: left; font-weight: bold;">Лиза, 35 лет. Сочи</p>
                        <p style="text-align:left">Теперь я знаю где всегда буду заказывать платья)) Сегодня мне пришло платье Бриджит, оно прекрасно! Ткань натуральная, приятная к телу, сидит идеально, думаю на фото видно. Смотрится очень даже празднично. Сейчас редко где можно найти действительно качественные вещи по приемлемой цене. Спасибо магазину, буду заказывать у вас еще. </p>
					</div>
                    <img data-src="" alt="" class="photo" style="max-width: 300px;" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==">
				</div>
                <br><br>
                <div class="col-sm-12 col-xs-12">
                  	<hr>
                    <div class="review">
                      	<p class="lead" style=" text-align: left; font-weight: bold;">Александра, 40 лет. Екатеринбург</p>
                        <p style="text-align:left">Никогда не писала отзывы, но здесь решила оставить, потому что реально довольна покупкой. Везде один китайский ширпотреб, а здесь фабричное производство, качественные вещи! и по хорошей цене что немаловажно. Уже надевала пару раз свое новое платье, коллеги делают комплименты, выглядит очень стильно и современно. Уже трем подругам порекомендовала этот магазин. </p>
					</div>
                    <img data-src="" alt="" class="photo" style="max-width: 300px;" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==">
				</div>
                <br><br>
                <div class="col-sm-12 col-xs-12">
                  	<hr>
                    <div class="review">
                      	<p class="lead" style=" text-align: left; font-weight: bold;">Валерия, 39 лет. Волгоград</p>
                        <p style="text-align:left">Первый раз заказала платье в этом магазине и очень довольна. Качеством не разочарована, фасон тоже удачный. Со своей нестандартной фигурой раньше приходилось постоянно шить на заказ, это дорого и долго. Теперь конечно буду здесь заказывать. Спасибо за быструю доставку. </p>
					</div>
                    <img data-src="" alt="" class="photo" style="max-width: 300px;" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==">
				</div>
              	<br><br>
              	<div class="col-sm-12 col-xs-12">
                  	<hr>
                    <div class="review">
                      	<p class="lead" style=" text-align: left; font-weight: bold;">Валентина, 55 лет. Ростов-на-дону</p>
                        <p style="text-align:left">Всех приветствую! Решила оставить отзыв о платье Стефани, потому что это первое платье за последнее время которое идеально на меня село. Долго сомневалась между двумя моделями, но в итоге выбрала все-таки ИМЯ из-за красивого цвета и очень удачного выреза декольте. Ткань обалденная, уже стирала 2 раза не полиняла и нет никаких катышек. За такую цену это просто подарок! Спасибо магазину. </p>
					</div>
                    <img data-src="" alt="" class="photo" style="max-width: 300px;" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==">
				</div>
                <br><br>
                <div class="col-sm-12 col-xs-12">
                  	<hr>
                    <div class="review">
                      	<p class="lead" style=" text-align: left; font-weight: bold;">Надежда, 60 лет. Новосибирск</p>
                        <p style="text-align:left">Долго искала платье на свадьбу к дочери, сейчас же в магазинах толком ничего не купишь, все закрыто. Подруга посоветовала этот сайт, я как открыла а тут такой огромный выбор платьев! Остановилась на Бриджит, понравилась расцветка и длина. Вообще на мою фигуру довольно трудно подобрать платье, а тут село как влитое. Буду обязательно здесь еще заказывать. </p>
					</div>
                    <img data-src="" alt="" class="photo" style="max-width: 300px;" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==">
				</div>
                <br><br>
                <div class="col-sm-12 col-xs-12">
                  	<hr>
                    <div class="review">
                      	<p class="lead" style=" text-align: left; font-weight: bold;">Екатерина, 36 лет. Санкт-Петербург.</p>
                        <p style="text-align:left">Мне очень трудно подобрать платье, потому что есть несовершенства фигуры, которые очень хочется скрыть. Бывает выберешь вещь, вроде село неплохо, а качество ужасное или наоборот качество хорошее, а фигуру просто уродует. Вот платье Летиция одно из немногих которое и село идеально и по качеству просто супер! Спасибо магазину за быструю доставку. </p>
					</div>
                    <img data-src="" alt="" class="photo" style="max-width: 300px;" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="sale_box second_color">
	<div class="wrapper row">
		<div class="text">Только сегодня<span>Скидки до 50%</span>на всю продукцию!</div>
		
		<div class="timer_box">
            
            <div class="row" style="margin-top: 50px;">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-xs-4">
							<div class="timer">
								<div class="hours">14<div class="snd-b"></div></div>
								<div class="legend">часы</div>
							</div>
						</div>
						
						<div class="col-xs-4">
							<div class="timer">
								<div class="minutes">51<div class="snd-b"></div></div>
								<div class="legend">минуты</div>
							</div>
						</div>
						
						<div class="col-xs-4">
							<div class="timer">
								<div class="seconds">29<div class="snd-b"></div></div>
								<div class="legend">секунды</div>
							</div>
						</div>
					</div>
				</div>
			</div>-->
			
		</div>
	</div>
</div>
<footer class="first_color">
	
	<div class="wrapper">
		<div class="logo">
			<a href="/">Dream Wear — Одежда для женщин с пышными формами
				<span>Магазин №1 в России</span>
			</a>
		</div>
		<div class="info">
			<div class="contact_footer pc">
				Связаться с отделом по дружбе с клиентами: <a href="tel:+74991319687 ">+7 (499) 113-69-78 </a>                  
			</div>
			<a target="_blank" href="https://dream-wear.ru/politika.pdf" class="color-black">Политика конфиденциальности</a> <br>
			ОГРН: 1187746734317, ООО "ДРИМ", 115088, МОСКВА ГОРОД, УЛИЦА ШАРИКОПОДШИПНИКОВСКАЯ, ДОМ 4, КОРПУС 2А
<br>
		</div>
		<div class="contacts">
			<div class="backcall inf" onclick="$(&#39;.contacts a&#39;).click();">Заявка на звонок</div>
			<a style="display:none;" href="/">Заявки на сайте 24 часа</a>
		</div>
	</div>
</footer>
<div style="margin-bottom: 0;" class="contact mob">Связаться с отделом по дружбе с клиентами: <a href="tel:+74991319687 ">+7 (499) 113-69-78 </a></div>
<div class="shadow_site"></div>


<div class="modal_contain">
	<div class="modal_window order_modal">
		<div class="close"></div>
		<h2>Заказать по акции</h2>
		<div class="image"><img src="<?=DIR?>/src/module_bed_img1c7e6.jpg" alt=""></div>
		<div class="text">
			<p class="p-title"></p>
			<p class="p-price">Цена сейчас: <span class="price_span">1990</span> <span class="price_cur">руб</span></p>
			<p class="p-old-price">Внимание! Цена завтра: <span class="price_span_old">7790</span> руб</p>
		</div>
		<div class="order-form form orderformcdn lv2-form lv2-form1" id="lv-formLanding1">
		<input type="text" name="FormLanding[fio]" class="field" placeholder="Ваше Имя" value="">
		<input class="field" placeholder="Телефон" id="lv-formLanding1-phone" name="FormLanding[phone]" type="text" maxlength="25">
            <div style="display: none" class="error error-empty-phone">Пожалуйста, введите корректный номер телефона.</div>
            <div style="display: none" class="error error-novalid-phone">Введите, пожалуйста, номер без 8-ки</div>
		<input type="hidden" name="alias" class="field" value="">
      
        <input type="hidden" name="product" class="field" value="">
        <input type="hidden" name="artikul" class="field" value="">
        
        <input type="hidden" name="bitrix_id" class="field" value="">
        <input type="hidden" name="sizes_to_id" class="field" value="">
        
        <input type="hidden" name="FormLanding[additional22]" class="field" value="">
        <input type="hidden" name="FormLanding[additional23]" class="field" value="">
        <input type="hidden" name="FormLanding[additional24]" class="field" value="">
      
		<p style="text-align: left; margin-top: 10px;">
			Размер:<br>
			<select name="FormLanding[comment]" class="field select-size">
			</select>
		</p>
		
		<div class="reolader">
			<input type="submit" value="Заказать" class="mm_button send_product_but">
			<div class="ajax_loader_block"><img class="ajax_loader" src="<?=DIR?>/src/ajax-loader.gif" alt="Идет отправка данных"> <span class="ajax_loader">Идет отправка данных</span></div>
		</div>
		
		<input class="lv-input-goods" id="lv-formLanding1-goods" type="hidden" value="" name="FormLanding[goods]"><input id="FormLanding_redirect_1" type="hidden" value="/success_order.html" name="FormLanding[redirect]"><input class="lv-form-timezone" id="FormLanding_timezone_1" type="hidden" value="-180" name="FormLanding[timezone]"><input id="lv-formLanding1-id" type="hidden" value="1" name="formID"></div>
	</div>
</div>



<div class="modal_contain_clbk">
	<div class="modal_window callback_modal">
		<div class="close"></div>
		<h2>Заказать звонок</h2>
		<div class="callback-form form orderformcdn lv2-form lv2-form2" id="lv-formLanding2">
<div style="display:none">
        <input type="hidden" value="ea3de2d3f5a558f2893bc000bfd9f0200865ed26" name="YII_CSRF_TOKEN"></div>
            <input type="hidden" name="utm_source" value="<?=$_GET['utm_source']?>">
            <input type="hidden" name="utm_medium" value="<?=$_GET['utm_medium']?>">
            <input type="hidden" name="utm_content" value="<?=$_GET['utm_content']?>">
            <input type="hidden" name="utm_campaign" value="<?=$_GET['utm_campaign']?>">
            <input type="hidden" name="utm_term" value="<?=$_GET['utm_term']?>">
        <input type="text" name="FormLanding[fio]" class="field" placeholder="Ваше Имя" value="">
		<input class="field" placeholder="Телефон" id="lv-formLanding2-phone" name="FormLanding[phone]" type="text" maxlength="25">
            <div style="display: none" class="error error-empty-phone">Пожалуйста, введите корректный номер телефона.</div>
            <div style="display: none" class="error error-novalid-phone">Введите, пожалуйста, номер без 8-ки</div>
    <input type="hidden" name="FormLanding[comment]" value="Обратный звонок">
    
    <input type="hidden" name="FormLanding[additional20]" class="field" value="">
    <input type="hidden" name="FormLanding[additional21]" class="field" value="">
    <input type="hidden" name="FormLanding[additional22]" class="field" value="">
    <input type="hidden" name="FormLanding[additional23]" class="field" value="">
    <input type="hidden" name="FormLanding[additional24]" class="field" value="">
		
		<div class="reolader">
			<input type="submit" value="Заказать" class="mm_button send_phone_but">
			<div class="ajax_loader_block"><img class="ajax_loader" src="<?=DIR?>/src/ajax-loader.gif" alt="Идет отправка данных"> <span class="ajax_loader">Идет отправка данных</span></div>
		</div>
		
		<input class="lv-input-goods" id="lv-formLanding2-goods" type="hidden" value="" name="FormLanding[goods]"><input id="FormLanding_redirect_2" type="hidden" value="/success_callback.html" name="FormLanding[redirect]"><input class="lv-form-timezone" id="FormLanding_timezone_2" type="hidden" value="-180" name="FormLanding[timezone]"><input id="lv-formLanding2-id" type="hidden" value="2" name="formID"></div>
	</div>
</div>


<div class="modal_contain_success">
	<div class="modal_window order_success">
		<div class="close"></div>
		<h2>Спасибо за заявку!</h2>
		<p>Ваш заказ успешно оформлен. Наш менеджер перезвонит вам в ближайшее время!</p>
	</div>
</div>


<script src="<?=DIR?>/src/jquery-3.4.1.min.js"></script>

<script type="text/javascript" src="<?=DIR?>/src/jquery.lazy.min.js"></script>
<script type="text/javascript" src="<?=DIR?>/src/jquery.lazy.plugins.min.js"></script>
<script>
	$(document).ready(function(){
		$('img').Lazy();
	});
</script>

<div class="DarkBg" style="display:none;">&nbsp;</div>
<div class="Popup" style="display:none">
    <div class="in">
        <div class="C">
            <div class="in">
                <div class="CloseButton">X</div>
                <div class="Block">
                    <div class="PopupBlock clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="hidden-form">
  <?php echo do_shortcode('[contact-form-7 id="49" title="special form"]') ?>
</div>

<script>
	setInterval(function(){
		var time = new Date();
		var end = new Date();
		end.setHours(23,59,59,999);
		var diff = Math.floor((end.valueOf() - time.valueOf()) / 1000);
		var hours = Math.floor(diff / 3600);
		diff -= hours * 3600;
		var minutes = Math.floor(diff / 60);
		diff -= minutes * 60;
		var seconds = diff;
		
		$('.timer .hours').html(hours + '<div class="snd-b"></div>');
		$('.timer .minutes').html(minutes + '<div class="snd-b"></div>');
		$('.timer .seconds').html(seconds + '<div class="snd-b"></div>');
	}, 1000);
</script>



        
	<script type="text/javascript" src="<?=DIR?>/src/jquery.formed0dc.js"></script>
	<script src="<?=DIR?>/src/jquery.maskedinput105fb.js"></script>
	<script src="<?=DIR?>/src/jquery.fancybox.packa6299.js"></script>
	<script src="<?=DIR?>/src/countdown.min42648.js"></script>
	<script src="<?=DIR?>/src/plugins7525e.js"></script>
	<script src="<?=DIR?>/src/main55af5.js"></script>
	<script src="<?=DIR?>/src/jquery.cookied5496.js"></script>
	<script type="text/javascript" src="<?=DIR?>/src/jqueryc32eb.jsonc32eb.js"></script>
	<script src="<?=DIR?>/src/init29fc26.js"></script>
	<script type="text/javascript" src="<?=DIR?>/src/slick.min.js"></script>
	
	<script>
		$('a.to-anch').click(function(){
			$([document.documentElement, document.body]).animate({
		        scrollTop: $($(this).attr('href')).offset().top
		    }, 500);
		});
	</script>
    
  <script>

    $( document ).ready(function() {
      let searchParams = new URLSearchParams(window.location.search)

      let needParams = [      
        {name: "sub1", value: null, formName: "FormLanding[additional1]"},
        {name: "sub2", value: null, formName: "FormLanding[additional2]"},
        {name: "sub3", value: null, formName: "FormLanding[additional3]"},
        {name: "sub4", value: null, formName: "FormLanding[additional4]"},
        {name: "sub5", value: null, formName: "FormLanding[additional5]"}
      ]

      let inputsValues = [];

      needParams.forEach(param => {
        inputsValues.push({name: param.name, value: searchParams.get(param.name), formName: param.formName})
      }); 

      $("form").each(function(){
        var form = $(this);

       // var addUrl = "?a=b"
        
        inputsValues.forEach(input => {

          if(input.value){
            form.append('<input type="hidden" class="field" name="' + input.formName + '" value="' + input.value + '" />');
            
            createCookie(input.name, input.value, 10)
            
           // addUrl = addUrl + "&" + input.name + "=" + input.value
          }
        })
        
        //console.log(form.attr('action'))
        
      });

      $('.spanclick').click(function(){
        var par = $(this).parents('.cat-info');
        console.log('test');
        $('.desc', par).fadeToggle(200);
      });
    });

    
    function createCookie(name, value, days) {
      var expires;

      if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
      } else {
        expires = "";
      }
      document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
    }

    function readCookie(name) {
      var nameEQ = encodeURIComponent(name) + "=";
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ')
          c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0)
          return decodeURIComponent(c.substring(nameEQ.length, c.length));
      }
      return null;
    }
    
     $('.slick-slider-product').slick({
         dots: true,
         responsive: [
            {
              breakpoint: 600,
              settings: {
               arrows: true
              }
            }
          ]
     });


    
  </script>
  
    <script type="text/javascript">
/*<![CDATA[*/
lvjq1("#lv-formLanding1-phone").mask("+7(999)999-99-99",{'placeholder':'*'});
lvjq1("#lv-formLanding2-phone").mask("+7(999)999-99-99",{'placeholder':'*'});
/*]]>*/
</script>
<div>

</body></html>