<?php
/**
 *  fiename: fish/routers.php$
 *  date: 2024/10/17 22:49:51$
 *  author: hepm<ok_fish@qq.com>$
 */
$routers[''] = 'admin/user/login';
$routers['fenxiao_jipiao_index_(\d+)_(\d+)'] = 'fenxiao/jipiao/index?page=$1&perpage=$2';
$routers['fenxiao_jipiao_test_model'] = 'fenxiao/jipiao/test_model';
$routers['fenxiao_jipiao_([a-z]+)'] = 'fenxiao/jipiao/$1';

return $routers;
