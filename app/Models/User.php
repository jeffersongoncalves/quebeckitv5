<?php

namespace App\Models;

use JeffersonGoncalves\Filament\User\Models\User as BaseUser;
use JeffersonGoncalves\Quebec\Attributes\PersonalData;
use JeffersonGoncalves\Quebec\Concerns\InteractsWithPersonalData;
use JeffersonGoncalves\Quebec\Contracts\HasPersonalData;
use JeffersonGoncalves\Quebec\Enums\AnonymizeStrategy;

/**
 * Columns, casts, factory, observer, Filament panel access and avatar come from
 * jeffersongoncalves/laravel-user + jeffersongoncalves/filament-user.
 * Add traits, relations or overrides here.
 *
 * Personal data declared for Quebec's Law 25: add a #[PersonalData] line for every column you add.
 */
#[PersonalData('name', purpose: 'Account identification', anonymize: AnonymizeStrategy::Mask)]
#[PersonalData('email', purpose: 'Login and account notices', anonymize: AnonymizeStrategy::Hash)]
class User extends BaseUser implements HasPersonalData
{
    use InteractsWithPersonalData;
}
