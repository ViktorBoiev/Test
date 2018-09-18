<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WinnerLog
 *
 * @property int $id
 * @property int $winner_id
 * @property string $win_type
 * @property int $win_quantity
 * @property int|null $status
 * @property int $gift_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WinnerLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WinnerLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WinnerLog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WinnerLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WinnerLog whereWinQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WinnerLog whereWinType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WinnerLog whereWinnerId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Gift[] $gift
 * @property-read \App\User $winner
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WinnerLog whereGiftId($value)
 */
class WinnerLog extends Model
{
    const TYPE_MONEY = 'money';
    const TYPE_LOYALTY = 'loyalty points';
    const TYPE_GIFT = 'gift';

    const STATUS_DECLINED = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_PREPARING = 2;
    const STATUS_SENT = 3;
    const STATUS_RECEIVED = 4;

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }

    public function gift()
    {
        return $this->hasMany(Gift::class);
    }

}
