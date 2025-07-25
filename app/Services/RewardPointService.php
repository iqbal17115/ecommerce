<?php

namespace App\Services;

use App\Models\RewardPointRule;
use App\Models\RewardPointTransaction;
use App\Models\UserRewardPoint;
use Illuminate\Support\Facades\DB;

class RewardPointService
{
    public function awardPoints(int $event, $user, $context = [])
    {
        $rule = RewardPointRule::where('event', $event)->where('is_active', true)->first();

        if (!$rule || !$user) {
            return;
        }

        // Calculate points
        $points = $rule->points;

        // Example: if multiplier applies to amount (e.g., order total)
        if (!empty($rule->multiplier) && isset($context['amount'])) {
            $points = round($context['amount'] * $rule->multiplier);
        } elseif (!empty($rule->multiplier)) {
            $points = round($points * $rule->multiplier);
        }

        DB::transaction(function () use ($user, $event, $points, $rule) {
            // Update/Create total points
            $userPoint = UserRewardPoint::firstOrNew(['user_id' => $user->id]);
            $userPoint->total_points += $points;
            $userPoint->save();

            // Store transaction
            RewardPointTransaction::create([
                'user_id' => $user->id,
                'reward_point_rule_id' => $rule->id,
                'type' => 'earn',
                'event' => $event,
                'points' => $points,
                'description' => 'Points earned from event ' . $event,
            ]);
        });
    }
}
