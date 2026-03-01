<?php

namespace App\Policies;

use App\Models\Bast;
use App\Models\User;

class BastPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Bast $bast): bool
    {
        return $user->role == 'admin'
            || $user->id === $bast->user_serah_id // ? atau user yang jadi user penyerah
            || $user->id === $bast->user_terima_id;// ? atau user yang jadi user penerima
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // ? hanya admin yang bisa membuka halaman buat bast baru
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Bast $bast): bool
    {
        // ? hanya admin yang bisa membuka halaman edit bast
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Bast $bast): bool
    {
        // ? hanya admin yang bisa menghapus bast
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Bast $bast): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Bast $bast): bool
    {
        return false;
    }

    /**
     * ? menentukan siapa saja yang bisa menyetujui Bast sebagai user penyerah
     */
    public function approveSerah(User $user, Bast $bast)
    {
        // ? hanya user penyerah dibast tersebut dan status bast = menunggu
        // ? yang bisa melakuakn approvel sebagai user penyerah
        return $user->id === $bast->user_serah_id
        && $bast->status_serah === 'Menunggu';
    }

    /**
     * ? menentukan siapa saja yang bisa menyetujui Bast sebagai user penerima
     */
    public function approveTerima(User $user, Bast $bast)
    {
        // ? hanya user penerima dibast tersebut dan status bast = menunggu
        // ? yang bisa melakuakn approvel sebagai user penerima
        return $user->id === $bast->user_terima_id
            && $bast->status_terima === 'Menunggu';
    }
}
