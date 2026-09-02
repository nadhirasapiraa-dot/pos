<?php

namespace App\Policies;

use App\Models\Penjualan;
use App\Models\User;

class PenjualanPolicy
{
    /**
     * Menentukan apakah user bisa mengedit data penjualan.
     */
    public function update(User $user, Penjualan $penjualan): bool
    {
        return in_array($user->role->name, ['admin', 'kasir'], true)
            && $penjualan->status === 'OPEN';
    }

    /**
     * Menentukan apakah user bisa menghapus data penjualan.
     */
    public function delete(User $user, Penjualan $penjualan): bool
    {
        return in_array($user->role->name, ['admin', 'kasir'], true)
            && $penjualan->status === 'OPEN';
    }

    /**
     * Menentukan apakah user bisa melihat detail penjualan.
     */
    public function view(User $user, Penjualan $penjualan): bool
    {
        return in_array($user->role->name, ['admin', 'kasir'], true);
    }
}