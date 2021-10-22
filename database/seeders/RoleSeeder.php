<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'Administrator','guard_name' => 'admin']);
        $admin->givePermissionTo('media');
        $admin->givePermissionTo('menu');
        $admin->givePermissionTo('comment');
        $admin->givePermissionTo('contact');
        $admin->givePermissionTo('blog.view');
        $admin->givePermissionTo('blog.create');
        $admin->givePermissionTo('blog.edit');
        $admin->givePermissionTo('blog.destroy');
        $admin->givePermissionTo('product.view');
        $admin->givePermissionTo('product.create');
        $admin->givePermissionTo('product.edit');
        $admin->givePermissionTo('product.destroy');
        $admin->givePermissionTo('order.view');
        $admin->givePermissionTo('order.destroy');
        $admin->givePermissionTo('admin.view');
        $admin->givePermissionTo('admin.create');
        $admin->givePermissionTo('admin.edit');
        $admin->givePermissionTo('admin.destroy');
        $admin->givePermissionTo('user.view');
        $admin->givePermissionTo('user.create');
        $admin->givePermissionTo('user.edit');
        $admin->givePermissionTo('user.destroy');
        $admin->givePermissionTo('permission.view');
        $admin->givePermissionTo('permission.create');
        $admin->givePermissionTo('permission.edit');
        $admin->givePermissionTo('permission.destroy');
        $admin->givePermissionTo('role.view');
        $admin->givePermissionTo('role.create');
        $admin->givePermissionTo('role.edit');
        $admin->givePermissionTo('role.destroy');
        $admin->givePermissionTo('setting.update');
        $admin->givePermissionTo('setting.source');
        $admin->givePermissionTo('setting.language');
        $admin->givePermissionTo('discount.view');
        $admin->givePermissionTo('discount.create');
        $admin->givePermissionTo('discount.edit');
        $admin->givePermissionTo('discount.destroy');
    }
}
