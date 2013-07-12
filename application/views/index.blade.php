<!DOCTYPE html>
<html>
  <head>
    <title>Система управления контентом</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="/css/all.css" rel="stylesheet" media="screen">
      <script src="http://code.jquery.com/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="navbar">
      <div class="navbar-inner">
        <a class="brand" href="/">Вебпортфолио</a>
        <ul class="nav">
          @if($navActive == 'articles')   <li class="active"> @else <li> @endif <a href="/articles">Статьи</a></li>
          @if($navActive == 'categories') <li class="active"> @else <li> @endif <a href="/categories">Категории статей</a></li>          
          @if($navActive == 'gallery')    <li class="active"> @else <li> @endif <a href="/gallery">Галерея</a></li>
          @if($navActive == 'catalog')    <li class="active"> @else <li> @endif<a href="/catalog">Каталог товаров</a></li>
          @if($navActive == 'blocks')     <li class="active"> @else <li> @endif<a href="/blocks">Статичные HTML блоки</a></li>
        </ul>
      </div>

    </div>

    <div class="row-fluid">
      <div class="span1"></div> 
      <div class="span10">
        @yield('content')
      </div>
      <div class="span1"></div> 
    </div>
  </body>
</html>