<?php

namespace App\Policies;

use App\Models\Bid;
use App\Models\User;

class BidPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isSeller(); // Sellers can view bids on their products
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Bid $bid): bool
    {
        // Seller can view bids on their products, buyer can view their own bids
        return $user->id === $bid->user_id || $user->id === $bid->product->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isBuyer(); // Only buyers can create bids
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Bid $bid): bool
    {
        return $user->id === $bid->user_id; // Only the bidder can update their bid
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Bid $bid): bool
    {
        return $user->id === $bid->user_id; // Only the bidder can delete their bid
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Bid $bid): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Bid $bid): bool
    {
        return false;
    }
}
