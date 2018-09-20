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
 * @property string|null $gift_type
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
 * @property-read \App\User $winner
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WinnerLog whereGiftType($value)
 */
class WinnerLog extends Model
{
    const TYPE_MONEY = 'money';
    const TYPE_LOYALTY = 'loyalty points';
    const TYPE_GIFT = 'gift';

    const STATUS_PENDING = 0;
    const STATUS_DECLINED = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_PREPARING = 3;
    const STATUS_SENT = 4;
    const STATUS_RECEIVED = 5;
    const STATUS_CONVERTED_TO_LOYALTY = 6;
    const STATUS_ERROR = 7;

    const ARRAY_OF_STATUSES = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_DECLINED => 'Declined',
        self::STATUS_ACCEPTED => 'Accepted',
        self::STATUS_PREPARING => 'Preparing',
        self::STATUS_SENT => 'Sent',
        self::STATUS_RECEIVED => 'Received',
        self::STATUS_CONVERTED_TO_LOYALTY => 'Converted',
        self::STATUS_ERROR => 'Error',
    ];

    protected $fillable = [
        'winner_id',
        'win_type',
        'status',
        'win_quantity',
        'gift_type'
    ];

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }

}
