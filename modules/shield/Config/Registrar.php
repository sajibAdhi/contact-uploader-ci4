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

use Modules\Shield\Authentication\Passwords\ValidationRules as PasswordRules;
use Modules\Shield\Collectors\Auth;
use Modules\Shield\Filters\AuthRates;
use Modules\Shield\Filters\ChainAuth;
use Modules\Shield\Filters\ForcePasswordResetFilter;
use Modules\Shield\Filters\GroupFilter;
use Modules\Shield\Filters\HmacAuth;
use Modules\Shield\Filters\JWTAuth;
use Modules\Shield\Filters\PermissionFilter;
use Modules\Shield\Filters\SessionAuth;
use Modules\Shield\Filters\TokenAuth;

class Registrar
{
    /**
     * Registers the Shield filters.
     */
    public static function Filters(): array
    {
        return [
            'aliases' => [
                'session'     => SessionAuth::class,
                'tokens'      => TokenAuth::class,
                'hmac'        => HmacAuth::class,
                'chain'       => ChainAuth::class,
                'auth-rates'  => AuthRates::class,
                'group'       => GroupFilter::class,
                'permission'  => PermissionFilter::class,
                'force-reset' => ForcePasswordResetFilter::class,
                'jwt'         => JWTAuth::class,
            ],
        ];
    }

    public static function Validation(): array
    {
        return [
            'ruleSets' => [
                PasswordRules::class,
            ],
        ];
    }

    public static function Toolbar(): array
    {
        return [
            'collectors' => [
                Auth::class,
            ],
        ];
    }

    public static function Generators(): array
    {
        return [
            'views' => [
                'shield:model' => 'Modules\Shield\Commands\Generators\Views\usermodel.tpl.php',
            ],
        ];
    }
}
