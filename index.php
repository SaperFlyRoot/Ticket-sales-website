<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Туры</title>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body data-page="catalog">
  <div class="bg">
    <div class="container">
        <ul class="nav nav-pills">
            <li class="active"><a href="/">Все предложения</a></li>
            <li><a href="catalog.php">Подобрать тур</a></li>
            <li><a href="cart.php">Корзина<span id="total-cart-count" class="badge"></span></a></li>
            <li><a href="order.php">Оформление заказа</a></li>
        </ul>
        <ul id="goods" class="list-unstyled in_goods">
            <img src="img/loading.gif" alt="" />
        </ul>
    </div>
    <script id="catalog-template" type="text/template">
        <% _.each(goods, function(good) { %>
            <li class="good-item row">
                <div class="col-md-4">
                    <img height="200px" width="200px" class="good-item__img" src="<%- good.img %>" />
                </div>
                <div class="col-md-4">
                    <div class="good-item__id">Преложение № <%= good.id %></div>
                    <div class="good-item__name"><%- good.name %></div>
                    <div class="good-item__price"><%= good.price %> руб.</div>
                    <button
                        class="good-item__btn-add btn btn-info btn-sm js-add-to-cart"
                        data-id="<%= good.id %>"
                        data-name="<%- good.name %>"
                        data-price="<%= good.price %>"
                    >Забронировать</button>
                </div>
                <div class="col-md-4">
                <div id="test_desc" class="good-item__desc"><%= good.desc %></div>
              </div>
            </li>
        <% }); %>
    </script>
    <script src="js/vendor/jquery.min.js" type="text/javascript"></script>
    <script src="js/vendor/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/vendor/underscore.min.js" type="text/javascript"></script>
    <script src="js/modules/catalog.js" type="text/javascript"></script>
    <script src="js/modules/cart.js" type="text/javascript"></script>
    <script src="js/modules/compare.js" type="text/javascript"></script>
    <script src="js/modules/main.js" type="text/javascript"></script>
  </div>
</body>
</html>
