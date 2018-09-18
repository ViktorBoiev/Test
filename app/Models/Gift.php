<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Gift
 *
 * @property int $id
 * @property string $name
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gift whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gift whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gift whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gift whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gift whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Gift extends Model
{
    //
}
