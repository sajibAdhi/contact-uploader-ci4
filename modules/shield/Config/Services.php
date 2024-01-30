<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter Shield.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Modules\Shield\Config;

use CodeIgniter\Config\BaseService;
use Modules\Shield\Auth;
use Modules\Shield\Authentication\JWTManager;
use Modules\Shield\Authentication\Passwords;
use Modules\Shield\Config\Auth as AuthConfig;

class Services extends BaseService
{
    /**
     * The base auth class
     */
    public static function auth(bool $getShared = true): Auth
    {
        if ($getShared) {
            return self::getSharedInstance('auth');
        }

        /** @var AuthConfig $config */
        $config = config('Auth');

        return new Auth($config);
    }

    /**
     * Password utilities.
     */
    public static function passwords(bool $getShared = true): Passwords
    {
        if ($getShared) {
            return self::getSharedInstance('passwords');
        }

        return new Passwords(config('Auth'));
    }

    /**
     * JWT Manager.
     */
    public static function jwtmanager(bool $getShared = true): JWTManager
    {
        if ($getShared) {
            return self::getSharedInstance('jwtmanager');
        }

        return new JWTManager();
    }
}
