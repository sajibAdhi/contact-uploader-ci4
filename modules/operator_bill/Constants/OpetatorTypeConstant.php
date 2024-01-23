<?php

namespace OperatorBill\Constants;

class OpetatorTypeConstant {
    const MOBILE = 'mobile';
    const ISO = 'iso';
    const IGW = 'igw';
    const ICX = 'icx';

    public static function all() : array {
        return [
            self::MOBILE,
            self::ISO,
            self::IGW,
            self::ICX,
        ];
    }
}

