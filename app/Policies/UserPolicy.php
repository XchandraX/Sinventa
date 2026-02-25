<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * ? menentukan siapa yang bisa melihat semua data user (index)
     */
    public function viewAny(User $user): bool
    {
        // ? yang bisa melihat semua role user (index) hanya admin
        return $user->role === 'admin';
    }

    /**
     * ? menentukan siapa yang bisa melihat detail user (show )
     */
    public function view(User $user, User $model): bool
    {
        
        // ? yang bisa melihat semua data detail user (show) hanya admin
        if ($user->role === 'admin') {
            return true; 
        }

        // ? Pengguna hanya dapat melihat profilnya sendiri
        return $user->id === $model->id; 
    }

    /**
     * ? menentukan siapa yang bisa membuat data user (create)
     */
    public function create(User $user): bool
    {
        // ? yang bisa membuat data user (create) hanya admin
         return $user->role === 'admin';
    }

    /**
     * ? menentukan siapa yang bisa mengubah data user (update)
     */
    public function update(User $user, User $model): bool
    {
        // ? hanya admin yang bisa mengubah data semua user
        if ($user->role === 'admin') {
            return true; 
        }

        // ? Pengguna hanya dapat mengubah profilnya sendiri
        return $user->id === $model->id;
    }

    /**
     * ? menentukan siapa yang bisa menghapus data user (delete)
     */
    public function delete(User $user, User $model): bool
    {
        // ? hanya admin yang bisa menghapus data user
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
