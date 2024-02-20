<?php

namespace App\Modules\OperatorBill\Constants;

use App\Traits\CountableConstants;

class OperatorTypeConstant
{
    use CountableConstants;

    const MOBILE = 'mobile';
    const IOS = 'ios';
    const IGW = 'igw';
    const ICX = 'icx';
    const LANDLINE = 'landline';
    const ANS = 'ans';
    const VENDOR = 'vendor';
}

