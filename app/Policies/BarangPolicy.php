<?php

namespace App\Policies;

use App\Models\Barang;
use App\Models\User;

class BarangPolicy
{
    /**
     * ? menentukan siapa saja yang bissa melihat list data barang (index)
     */
    public function viewAny(User $user): bool
    {
        // ? hanya user dengan role = admin yang bisa melihat data barang
        return $user->role == 'admin';
    }

    /**
     * ?menentukan siapa saja yang bisa melihat detail barang
     */
    public function view(User $user, Barang $barang): bool
    {
        // ? semua role baik admin amupun user bisa melihat detail barang
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // ? hanya user dengan role = admin yang bisa membuat data barang
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Barang $barang): bool
    {
        // ? hanya user dengan role = admin yang bisa memperbarui data barang
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Barang $barang): bool
    {
        // ? hanya user dengan role = admin yang bisa Menghapus data barang
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Barang $barang): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Barang $barang): bool
    {
        return false;
    }
}
