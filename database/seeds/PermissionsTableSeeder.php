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
        $roleUser  = Role::create(['name' => 'User']);

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

        // Directs BuyController
        Permission::create(['name' => 'buys_tickets', 'group' => 'raffles']);
        $roleAdmin->givePermissionTo(['buys_tickets']);
        $roleUser->givePermissionTo(['buys_tickets']);

        // Referrals Buys
        Permission::create(['name' => 'referrals_buys_tickets', 'group' => 'raffles']);
        $roleAdmin->givePermissionTo(['referrals_buys_tickets']);
        $roleUser->givePermissionTo(['referrals_buys_tickets']);

        // Raffles Controller (Front)
        Permission::create(['name' => 'raffles_list', 'group'       => 'raffles']);
        Permission::create(['name' => 'raffles_create', 'group'     => 'raffles']);
        Permission::create(['name' => 'raffles_edit', 'group'       => 'raffles']);
        Permission::create(['name' => 'raffles_follow', 'group'     => 'raffles']);
        $roleAdmin->givePermissionTo(['raffles_list', 'raffles_create', 'raffles_edit', 'raffles_follow']);
        $roleUser->givePermissionTo(['raffles_list', 'raffles_create', 'raffles_edit', 'raffles_follow']);

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
        Permission::create(['name' => 'user_destroy', 'group' => 'user']);
        $roleAdmin->givePermissionTo(['user_list', 'user_update', 'user_edit', 'user_updateadmin', 'user_destroy']);

        // User Controller (Front)
        Permission::create(['name' => 'user_front_getprofile', 'group'  => 'user']);
        Permission::create(['name' => 'user_front_edit', 'group'        => 'user']);
        Permission::create(['name' => 'user_front_update', 'group'      => 'user']);
        $roleAdmin->givePermissionTo(['user_front_getprofile', 'user_front_edit', 'user_front_update']);
        $roleUser->givePermissionTo(['user_front_getprofile', 'user_front_edit', 'user_front_update']);

        // Comments (Front)
        Permission::create(['name' => 'comments_store', 'group'  => 'comments']);
        Permission::create(['name' => 'comments_delete', 'group'  => 'comments']);
        Permission::create(['name' => 'comments_edit', 'group'  => 'comments']);
        $roleAdmin->givePermissionTo(['comments_store', 'comments_delete', 'comments_edit']);
        $roleUser->givePermissionTo(['comments_store']);

        $user = \App\User::find(1);
        $role = \App\Role::find(1);
        $user->assignRole($role->name);
    }
}
