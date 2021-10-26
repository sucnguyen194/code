<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('cache:clear');
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $discount = Permission::create(['name' => 'discount', 'title' => 'Mã giảm giá','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'discount.view', 'title' => 'Xem mã giảm giá','parent_id' => $discount->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'discount.create', 'title' => 'Tạo mã giảm giá','parent_id' => $discount->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'discount.edit', 'title' => 'Sửa mã giảm giá','parent_id' => $discount->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'discount.destroy', 'title' => 'Xóa mã giảm giá','parent_id' => $discount->id,'guard_name' => 'admin']);

        $dashboard = Permission::create(['name' => 'dashboard', 'title' => 'Điều hướng','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'media', 'title' => 'Media','parent_id' => $dashboard->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'menu', 'title' => 'Menu','parent_id' => $dashboard->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'comment', 'title' => 'Bình luận','parent_id' => $dashboard->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'contact', 'title' => 'Liên hệ','parent_id' => $dashboard->id,'guard_name' => 'admin']);

        $blog = Permission::create(['name' => 'blog', 'title' => 'Blog','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'blog.view', 'title' => 'Xem nội dung','parent_id' => $blog->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'blog.create', 'title' => 'Thêm nội dung','parent_id' => $blog->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'blog.edit', 'title' => 'Sửa nội dung','parent_id' => $blog->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'blog.destroy', 'title' => 'Xóa nội dung','parent_id' => $blog->id,'guard_name' => 'admin']);

        $product = Permission::create(['name' => 'product', 'title' => 'Sản phẩm','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'product.view', 'title' => 'Xem sản phẩm','parent_id' => $product->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'product.create', 'title' => 'Thêm sản phẩm','parent_id' => $product->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'product.edit', 'title' => 'Sửa sản phẩm','parent_id' => $product->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'product.destroy', 'title' => 'Xóa sản phẩm','parent_id' => $product->id,'guard_name' => 'admin']);

        $order = Permission::create(['name' => 'order', 'title' => 'Bán hàng','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'order.view', 'title' => 'Xem đơn hàng','parent_id' => $order->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'order.destroy', 'title' => 'Xóa đơn hàng','parent_id' => $order->id,'guard_name' => 'admin']);

        $admin = Permission::create(['name' => 'admin', 'title' => 'Tài khoản quản trị','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'admin.view', 'title' => 'Xem quản trị','parent_id' => $admin->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'admin.create', 'title' => 'Thêm quản trị','parent_id' => $admin->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'admin.edit', 'title' => 'Sửa quản trị','parent_id' => $admin->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'admin.destroy', 'title' => 'Xóa quản trị','parent_id' => $admin->id,'guard_name' => 'admin']);

        $user = Permission::create(['name' => 'user', 'title' => 'Tài khoản khách hàng','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'user.view', 'title' => 'Xem tài khoản','parent_id' => $user->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'user.create', 'title' => 'Thêm tài khoản','parent_id' => $user->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'user.edit', 'title' => 'Sửa tài khoản','parent_id' => $user->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'user.destroy', 'title' => 'Xóa tài khoản','parent_id' => $user->id,'guard_name' => 'admin']);

        $video = Permission::create(['name' => 'video', 'title' => 'Video','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'video.view', 'title' => 'Xem video','parent_id' => $video->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'video.create', 'title' => 'Thêm video','parent_id' => $video->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'video.edit', 'title' => 'Sửa video','parent_id' => $video->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'video.destroy', 'title' => 'Xóa video','parent_id' => $video->id,'guard_name' => 'admin']);

        $gallery = Permission::create(['name' => 'gallery', 'title' => 'Gallery','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'gallery.view', 'title' => 'Xem gallery','parent_id' => $gallery->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'gallery.create', 'title' => 'Thêm gallery','parent_id' => $gallery->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'gallery.edit', 'title' => 'Sửa gallery','parent_id' => $gallery->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'gallery.destroy', 'title' => 'Xóa gallery','parent_id' => $gallery->id,'guard_name' => 'admin']);

        $permission = Permission::create(['name' => 'permission', 'title' => 'Permission','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'permission.view', 'title' => 'Xem permission','parent_id' => $permission->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'permission.create', 'title' => 'Thêm permission','parent_id' => $permission->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'permission.edit', 'title' => 'Sửa permission','parent_id' => $permission->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'permission.destroy', 'title' => 'Xóa permission','parent_id' => $permission->id,'guard_name' => 'admin']);

        $role = Permission::create(['name' => 'role', 'title' => 'Role','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'role.view', 'title' => 'Xem role','parent_id' => $role->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'role.create', 'title' => 'Thêm role','parent_id' => $role->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'role.edit', 'title' => 'Sửa role','parent_id' => $role->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'role.destroy', 'title' => 'Xóa role','parent_id' => $role->id,'guard_name' => 'admin']);

        $setting = Permission::create(['name' => 'setting', 'title' => 'Setting','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'setting.update', 'title' => 'Cập nhật hệ thống','parent_id' => $setting->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'setting.source', 'title' => 'Sửa website','parent_id' => $setting->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'setting.language', 'title' => 'Ngôn ngữ','parent_id' => $setting->id,'guard_name' => 'admin']);

        $module = Permission::create(['name' => 'module', 'title' => 'Bảng phụ','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'module.view', 'title' => 'Xem bảng phụ','parent_id' => $module->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'module.create', 'title' => 'Thêm bảng phụ','parent_id' => $module->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'module.edit', 'title' => 'Sửa bảng phụ','parent_id' => $module->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'module.destroy', 'title' => 'Xóa bảng phụ','parent_id' => $module->id,'guard_name' => 'admin']);
    }
}
