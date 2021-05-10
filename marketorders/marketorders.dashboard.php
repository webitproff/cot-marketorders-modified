<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=dashboard.include
 * [END_COT_EXT]
 */

/**
 * Events for user
 *
 * @package notify
 * @version 0.0.1
 * @author Attar
 * @copyright Copyright (c) Pluginspro.ru
 */

defined('COT_CODE') or die('Wrong URL.');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = cot_auth('market', 'any');

require_once cot_incfile('marketorders', 'plug');
require_once cot_langfile('marketorders', 'plug', 'ru');


if ($usr['auth_read']) {
    $dashboardmenu['purchases']['title'] = $L['marketorders_mypurchases'];
    $dashboardmenu['purchases']['url'] = cot_url('dashboard', 'm=purchases');
}
if ($usr['auth_write']) {
    $dashboardmenu['sales']['title'] = $L['marketorders_mysales'];
    $dashboardmenu['sales']['url'] = cot_url('dashboard', 'm=sales');
}


if (in_array($m, array('sales', 'purchases', 'addclaim'))) {
    // Mode choice
    if (!in_array($m, array('sales', 'purchases', 'addclaim'))) {

        if (isset($_GET['id'])) {
            $m = 'order';
        } else {
            $m = 'neworder';
        }
    }
    require_once cot_incfile('marketorders', 'plug', $m);

    $t1->parse('MAIN');
    $t->assign('DASH_CONTENT', $t1->text('MAIN'));
}