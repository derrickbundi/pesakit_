<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class assignroleseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);
        $role = Role::find(1);
        $permissions = [2];
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
