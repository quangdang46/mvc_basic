<?php
$routers['default_controller'] = 'home';

$routers['trang-chu'] = "home/index";
$routers['san-pham'] = "product/index";
$routers['tin-tuc/(.+)'] = "news/category/$1";
