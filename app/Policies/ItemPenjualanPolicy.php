<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ItemPenjualan;

class ItemPenjualanPolicy
{

    public function delete(User $user, ItemPenjualan $itempenjualan):bool {
        return $user->role->name === 'admin' ;
        
    }

    public function __construct()
    {
        //
    }
}
