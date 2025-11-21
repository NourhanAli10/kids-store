<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['fixed', 'percentage']);
            $table->decimal('value', 10, 2);
            // the minimum order price to apply the coupon
            $table->decimal('min_order_amount', 10, 2)->nullable();
            // maximum discount given by the coupon in large orders
            $table->decimal('max_discount', 10, 2)->nullable();
            // Total number of times the coupon can be used by all users
            $table->integer('usage_limit')->nullable();
            // number of times coupons have been used
            $table->integer('usage_count')->default(0);
            // Max times each user can use this coupon
            $table->integer('max_usage_per_user')->nullable();
            $table->enum('status', ['active', 'inactive', 'expired'])->default('active');
            $table->text('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('expire_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
