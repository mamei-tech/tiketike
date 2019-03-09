<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        // Creting Role Admin
        $roleAdmin = Role::create(['name' => 'Admon']);

        // Permission
        Permission::create(['name' => 'list_roles', 'group' => 'roles']);
        Permission::create(['name' => 'create_roles', 'group' => 'roles']);
        Permission::create(['name' => 'edit_roles', 'group' => 'roles']);
        Permission::create(['name' => 'delete_roles', 'group' => 'roles']);
        $roleAdmin->givePermissionTo(['list_roles','create_roles','edit_roles','delete_roles']);

        // Configuration
        Permission::create(['name' => 'show_roles', 'group' => 'configuration']);
        Permission::create(['name' => 'save_roles', 'group' => 'configuration']);
        $roleAdmin->givePermissionTo(['show_roles','save_roles']);

        // Admin Enter Section
        Permission::create(['name' => 'enter_admin', 'group' => 'sections']);
        $roleAdmin->givePermissionTo(['enter_admin']);

        // ARaffle
        Permission::create(['name' => 'anulled_raffle_list', 'group' => 'raffles']);
        Permission::create(['name' => 'anulled_raffle_destroy', 'group' => 'raffles']);
        $roleAdmin->givePermissionTo(['anulled_raffle_list', 'anulled_raffle_destroy']);

        // PRaffleController
        Permission::create(['name' => 'list_praffles', 'group' => 'raffles']);
        Permission::create(['name' => 'shuffle_praffles', 'group' => 'raffles']);
        Permission::create(['name' => 'null_praffles', 'group' => 'raffles']);
        $roleAdmin->givePermissionTo(['list_praffles', 'list_praffles',  'null_praffles']);

        // URaffles Controller
        Permission::create(['name' => 'list_upublished_raffles', 'group' => 'raffles']);
        Permission::create(['name' => 'publish_upublished_raffles', 'group' => 'raffles']);
        Permission::create(['name' => 'store_upublished_raffles', 'group' => 'raffles']);
        Permission::create(['name' => 'edit_upublished_raffles', 'group' => 'raffles']);
        Permission::create(['name' => 'destroy_upublished_raffles', 'group' => 'raffles']);
        $roleAdmin->givePermissionTo(['list_upublished_raffles', 'publish_upublished_raffles',  'store_upublished_raffles', 'edit_upublished_raffles', 'destroy_upublished_raffles']);

        // Category Controller
        Permission::create(['name' => 'list_categories', 'group' => 'categories']);
        Permission::create(['name' => 'store_categories', 'group' => 'categories']);
        Permission::create(['name' => 'update_categories', 'group' => 'categories']);
        $roleAdmin->givePermissionTo(['list_categories', 'store_categories', 'update_categories']);

        // Payments Controller
        Permission::create(['name' => 'executed_payments', 'group' => 'payments']);
        Permission::create(['name' => 'pending_list_payments', 'group' => 'payments']);
        Permission::create(['name' => 'pending_details_payments', 'group' => 'payments']);
        $roleAdmin->givePermissionTo(['executed_payments', 'pending_list_payments', 'pending_details_payments']);

        // Promo Client Controller
        Permission::create(['name' => 'promo_c_list', 'group' => 'promos']);
        Permission::create(['name' => 'promo_c_store', 'group' => 'promos']);
        Permission::create(['name' => 'promo_c_update', 'group' => 'promos']);
        Permission::create(['name' => 'promo_c_destroy', 'group' => 'promos']);
        $roleAdmin->givePermissionTo(['promo_c_list', 'promo_c_store', 'promo_c_update', 'promo_c_destroy']);

        // Promo Controller
        Permission::create(['name' => 'promo_list', 'group' => 'promos']);
        Permission::create(['name' => 'promo_store', 'group' => 'promos']);
        Permission::create(['name' => 'promo_update', 'group' => 'promos']);
        Permission::create(['name' => 'promo_destroy', 'group' => 'promos']);
        $roleAdmin->givePermissionTo(['promo_list', 'promo_store', 'promo_update', 'promo_destroy']);

        // User Admin Controller
        Permission::create(['name' => 'user_list', 'group' => 'user']);
        Permission::create(['name' => 'user_update', 'group' => 'user']);
        Permission::create(['name' => 'user_edit', 'group' => 'user']);
        Permission::create(['name' => 'user_updateadmin', 'group' => 'user']);
        $roleAdmin->givePermissionTo(['user_list', 'user_update', 'user_edit', 'user_updateadmin']);

        //

        /*
        //

        DB::table('permissions')->insert([
            'name' => 'list users',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        //testing


        DB::table('permissions')->insert([
            'name' => 'create user',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('permissions')->insert([
            'name' => 'edit user',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('permissions')->insert([
            'name' => 'delete user',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('permissions')->insert([
            'name' => 'list raffles',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        //testing


        DB::table('permissions')->insert([
            'name' => 'create raffle',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('permissions')->insert([
            'name' => 'edit raffle',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('permissions')->insert([
            'name' => 'delete raffle',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('permissions')->insert([
            'name' => 'list promos',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        //testing


        DB::table('permissions')->insert([
            'name' => 'create promo',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('permissions')->insert([
            'name' => 'edit promo',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('permissions')->insert([
            'name' => 'delete promo',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        //Seeding roles
        DB::table('roles')->insert([
            'name' => 'admin',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('roles')->insert([
            'name' => 'moderator',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('roles')->insert([
            'name' => 'guest',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        //Seeding permissions to role


        DB::table('role_has_permissions')->insert([
            'permission_id' => '1',
            'role_id' => '1',
        ]);


        DB::table('role_has_permissions')->insert([
            'permission_id' => '2',
            'role_id' => '1',
        ]);


        DB::table('role_has_permissions')->insert([
            'permission_id' => '3',
            'role_id' => '1',
        ]);


        DB::table('role_has_permissions')->insert([
            'permission_id' => '5',
            'role_id' => '1',
        ]);


        DB::table('role_has_permissions')->insert([
            'permission_id' => '6',
            'role_id' => '1',
        ]);


        DB::table('role_has_permissions')->insert([
            'permission_id' => '7',
            'role_id' => '1',
        ]);


        DB::table('role_has_permissions')->insert([
            'permission_id' => '9',
            'role_id' => '1',
        ]);


        DB::table('role_has_permissions')->insert([
            'permission_id' => '10',
            'role_id' => '1',
        ]);


        DB::table('role_has_permissions')->insert([
            'permission_id' => '11',
            'role_id' => '1',
        ]);


        DB::table('role_has_permissions')->insert([
            'permission_id' => '13',
            'role_id' => '1',
        ]);


        DB::table('role_has_permissions')->insert([
            'permission_id' => '14',
            'role_id' => '1',
        ]);


        DB::table('role_has_permissions')->insert([
            'permission_id' => '15',
            'role_id' => '1',
        ]);
        */

        $user = \App\User::find(1);
        $role = \App\Role::find(1);
        $user->assignRole($role->name);

    }
}
