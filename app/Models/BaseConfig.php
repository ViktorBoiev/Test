<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BaseConfig
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseConfig whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseConfig whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseConfig whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseConfig whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseConfig whereValue($value)
 * @mixin \Eloquent
 */
class BaseConfig extends Model
{
    const MIN_LOYALTY_WIN = 'min loyalty points win';
    const MAX_LOYALTY_WIN = 'max loyalty points win';
    const MIN_MONEY_WIN = 'min money win';
    const MAX_MONEY_WIN = 'max money win';
    const MONEY_WIN_LIMIT = 'money win limit';
    const CONVERSION_RATIO = 'conversion ratio';

    public function getKeyForFormAttribute()
    {
        return str_replace(' ', '_', $this->key);
    }
}
