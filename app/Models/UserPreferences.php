<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserPreferences
 *
 * @property int $id
 * @property int $user_id
 * @property string $delivery_country
 * @property string $delivery_city
 * @property string|null $delivery_state
 * @property string $delivery_zip
 * @property string $delivery_street
 * @property string $delivery_building
 * @property string $delivery_apartment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPreferences whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPreferences whereDeliveryApartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPreferences whereDeliveryBuilding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPreferences whereDeliveryCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPreferences whereDeliveryCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPreferences whereDeliveryState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPreferences whereDeliveryStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPreferences whereDeliveryZip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPreferences whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPreferences whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPreferences whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\User $user
 */
class UserPreferences extends Model
{
    protected $table = 'user_preferences';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
