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

namespace App\Modules\Shield\Config;

use App\Modules\Shield\Authentication\Passwords\ValidationRules as PasswordRules;
use App\Modules\Shield\Collectors\Auth;
use App\Modules\Shield\Filters\AuthRates;
use App\Modules\Shield\Filters\ChainAuth;
use App\Modules\Shield\Filters\ForcePasswordResetFilter;
use App\Modules\Shield\Filters\GroupFilter;
use App\Modules\Shield\Filters\HmacAuth;
use App\Modules\Shield\Filters\JWTAuth;
use App\Modules\Shield\Filters\PermissionFilter;
use App\Modules\Shield\Filters\SessionAuth;
use App\Modules\Shield\Filters\TokenAuth;

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
                'shield:model' => 'App\Modules\Shield\Commands\Generators\Views\usermodel.tpl.php',
            ],
        ];
    }
}
