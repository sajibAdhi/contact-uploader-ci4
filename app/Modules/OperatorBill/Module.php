<?php

namespace App\Modules\OperatorBill;

use Bonfire\Core\BaseModule;
use Bonfire\Menus\MenuItem;

class Module extends BaseModule
{
    public function initAdmin()
    {
        // Add to the Content menu
        $sidebar = service('menus');
        $item = new MenuItem(
            [
                'title' => lang('OperatorBill.operatorBillModTitle'),
                'namedRoute' => 'operator_bill.index',
                'fontAwesomeIcon' => 'fas fa-book',
                'permission' => 'operator_bill.view',
            ]
        );
        $sidebar->menu('sidebar')->collection('content')->addItem($item);

        // Add Users Settings
        $item = new MenuItem(
            [
                'title' => lang('OperatorBill.operatorBillModTitle'),
                'namedRoute' => 'operator_bill.settings',
                'fontAwesomeIcon' => 'fas fa-user-cog',
                'permission' => 'operator_bill.settings',
            ]
        );
        $sidebar->menu('sidebar')->collection('settings')->addItem($item);
    }
}