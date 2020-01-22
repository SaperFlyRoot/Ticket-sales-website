<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Туры</title>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="components/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body data-page="catalogDB">
    <div class="bg">
    <div class="container">
        <ul class="nav nav-pills">
            <li><a href="/">Все предложения</a></li>
            <li class="active"><a href="catalog.php">Подобрать тур</a></li>
            <li><a href="cart.php">Забронированые<span id="total-cart-count" class="badge"></span></a></li>
            <li><a href="order.php">Оформление заказа</a></li>
        </ul>
        <div id="filters" class="col-md-12">
            <form id="filters-form" role="form">
                <div class="col-md-2">
                    <h4>Отели</h4>
                    <div id="brands">
                        <div id="test" class="checkbox"><label><input type="checkbox" name="brands[]" value="1"> 5 звезд</label></div>
                        <div id="test" class="checkbox"><label><input type="checkbox" name="brands[]" value="2"> 4 зведы</label></div>
                        <div id="test" class="checkbox"><label><input type="checkbox" name="brands[]" value="3"> 3 звезды</label></div>

                    </div>
                </div>
                <div class="col-md-2">
                    <h4>Фильтр по ценам</h4>
                    <div id="prices-label">0 - 0 руб.</div>
                    <br />
                    <input type="hidden" id="min-price" name="min_price" value="5000">
                    <input type="hidden" id="max-price" name="max_price" value="50000">
                    <div id="prices"></div>
                </div>
                <div class="col-md-3">
                    <h4>Сортировка</h4>
                    <select id="sort" name="sort" class="form-control">
                        <option value="price_asc">По цене, сначала дешевые</option>
                        <option value="price_desc">По цене, сначала дорогие</option>
                        <option value="rating_desc">По популярности</option>
                        <option value="good_asc">По названию, A-Z</option>
                        <option value="good_desc">По названию, Z-A</option>
                    </select>
                </div>
            </form>
        </div>
        <ul id="goods" class="col-md-5 goods">
            <img src="img/loading.gif" alt="" />

        </ul>
        <div class="col-md-6">
          <form class="search_taxi" method="get">
              <h4>Поиск Отеля по названию</h4>
        		<input type="text" name="usersearch" id="usersearch"  />
        </form>
        <?php
require_once ("DB.php");
$link = mysqli_connect($host, $user, $pass, $db);
$sql = mysqli_query($link, 'SELECT * FROM `curort`');
?>
<?php
		//Поиск по фразе (по содержанию заметки)
		$user_search = $_GET['usersearch'];
		$where_list = array();
		$query_usersearch = "SELECT * FROM curort";
		$clean_search = str_replace(',', ' ', $user_search);
		$search_words = explode(' ', $user_search);
		//Создаем еще один массив с окончательными результатами
		$final_search_words = array();
		//Проходим в цикле по каждому элементу массива $search_words.
		//Каждый непустой элемент добавляем в массив $final_search_words
		if (count($search_words) > 0)
			{
				foreach($search_words as $word)
				{
					if (!empty($word))
					{
						$final_search_words[] = $word;
					}
				}
			}
//работа с использованием массива $final_search_words
	foreach ($final_search_words as $word)
	{
		$where_list[] = " hotel LIKE '%$word%'";

	}

	$where_clause = implode (' OR ', $where_list);
	if (!empty($where_clause))
	{
		$query_usersearch .=" WHERE $where_clause";
	}
		$res_query = mysqli_query($link, $query_usersearch);

    ?>

    <div class="prokrytka">
    <?php
		while ($res_array = mysqli_fetch_array($res_query))
		{
				?>
        <?php echo "Отель: ", $res_array ['hotel'],"<br>"?>
        <?php echo "Стомость отеля за 10 дней: ", $res_array['priceH'], " руб","<br>";?>
  <hr class="hr_size">   <?php }?>
</div>
        </div>
    </div>
  <div class="col-md-6">
    <script id="goods-template" type="text/template">
        <% _.each(goods, function(item) { %>
        <li class="small-good-item row">
            <div class="col-md-6">
                <img width="200px" height="200px"class="small-good-item__img" src="img/goods/<%= item.photo %>" />
            </div>
            <div class="col-md-4">
                <div class="small-good-item__id">предложение <%= item.good_id %></div>
                <div class="small-good-item__name"><%- item.good %> (рейтинг <%= item.rating %>)</div>
                <div class="small-good-item__brand">Отель: <%- item.brand %></div>
                <div class="small-good-item__price"><%= item.price %> руб.</div>
                <button
                    class="small-good-item__btn-add btn btn-info btn-sm js-add-to-cart"
                    data-id="<%= item.good_id %>"
                    data-name="<%- item.good %>"
                    data-price="<%= item.price %>"
                >Забронивать</button>
            </div>
        </li>
        <% }); %>
    </script>
</div>

</div>
    <script id="brands-template" type="text/template">
        <% _.each(brands, function(item) { %>
        <div class="checkbox"><label><input type="checkbox" name="brands[]" value="<%= item.id %>"> <%= item.brand %></label></div>
        <% }); %>
    </script>

    <script src="js/vendor/jquery.min.js" type="text/javascript"></script>
    <script src="js/vendor/jquery.cookie.js" type="text/javascript"></script>
    <script src="components/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="js/vendor/underscore.min.js" type="text/javascript"></script>
    <script src="js/modules/catalogDB.js" type="text/javascript"></script>
    <script src="js/modules/cart.js" type="text/javascript"></script>
    <script src="js/modules/compare.js" type="text/javascript"></script>
    <script src="js/modules/main.js" type="text/javascript"></script>
      </div>
</body>
</html>
