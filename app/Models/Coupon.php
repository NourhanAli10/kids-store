<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;


    protected $fillable = [
        'code',
        'type',
        'value',
        'min_order_amount',
        'max_discount',
        'usage_limit',
        'usage_count',
        'max_usage_per_user',
        'status',
        'description',
        'start_date',
        'expire_date'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'expire_date' => 'datetime',

    ];

    // Validation Methods

    public function isValid(): bool
    {
        return $this->status === 'active'
        && $this->isWithinDateRange()
        && !$this->hasReachedUsageLimit();
    }

    public function isWithinDateRange() {
        $time = Carbon::now();
        return $time->between($this->start_date, $this->expire_date);
    }

    public function hasReachedUsageLimit() {
        return $this->usage_count >= $this->usage_limit;
    }


    public function canUsedByUser($userId) {
        if ($this->max_usage_per_user === null) {
            return true;
        }
        $usageCount = CouponHistory::where('user_id', $userId)->where('coupon_id', $this->id)
        ->count();
        return  $usageCount < $this->max_usage_per_user ;
    }

    










}
