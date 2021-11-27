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

        $tag = Permission::create(['name' => 'tag', 'title' => 'Tag','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'tag.view', 'title' => 'View tag','parent_id' => $tag->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'tag.create', 'title' => 'Create tag','parent_id' => $tag->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'tag.edit', 'title' => 'Edit tag','parent_id' => $tag->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'tag.destroy', 'title' => 'Destroy tag','parent_id' => $tag->id,'guard_name' => 'admin']);

        $discount = Permission::create(['name' => 'discount', 'title' => 'Discount','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'discount.view', 'title' => 'View discount','parent_id' => $discount->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'discount.create', 'title' => 'Create discount','parent_id' => $discount->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'discount.edit', 'title' => 'Edit discount','parent_id' => $discount->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'discount.destroy', 'title' => 'Destroy discount','parent_id' => $discount->id,'guard_name' => 'admin']);

        $support = Permission::create(['name' => 'support', 'title' => 'Support','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'support.view', 'title' => 'View support','parent_id' => $support->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'support.create', 'title' => 'Create support','parent_id' => $support->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'support.edit', 'title' => 'Edit support','parent_id' => $support->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'support.destroy', 'title' => 'Destroy support','parent_id' => $support->id,'guard_name' => 'admin']);

        $menu = Permission::create(['name' => 'menu', 'title' => 'MenuPosition','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'menu.view', 'title' => 'View menu','parent_id' => $menu->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'menu.create', 'title' => 'Create menu','parent_id' => $menu->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'menu.edit', 'title' => 'Edit menu','parent_id' => $menu->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'menu.destroy', 'title' => 'Destroy menu','parent_id' => $menu->id,'guard_name' => 'admin']);

        $image = Permission::create(['name' => 'photo', 'title' => 'Photo','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'photo.view', 'title' => 'View photo','parent_id' => $image->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'photo.create', 'title' => 'Create photo','parent_id' => $image->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'photo.edit', 'title' => 'Edit photo','parent_id' => $image->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'photo.destroy', 'title' => 'Destroy photo','parent_id' => $image->id,'guard_name' => 'admin']);

        $contact = Permission::create(['name' => 'contact', 'title' => 'Contact','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'contact.view', 'title' => 'View contact','parent_id' => $contact->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'contact.create', 'title' => 'Create contact','parent_id' => $contact->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'contact.edit', 'title' => 'Edit contact','parent_id' => $contact->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'contact.destroy', 'title' => 'Destroy contact','parent_id' => $contact->id,'guard_name' => 'admin']);

        $comment = Permission::create(['name' => 'comment', 'title' => 'Comment','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'comment.view', 'title' => 'View comment','parent_id' => $comment->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'comment.create', 'title' => 'Create comment','parent_id' => $comment->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'comment.edit', 'title' => 'Edit comment','parent_id' => $comment->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'comment.destroy', 'title' => 'Destroy comment','parent_id' => $comment->id,'guard_name' => 'admin']);

        $blog = Permission::create(['name' => 'blog', 'title' => 'Blog','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'blog.view', 'title' => 'View blog','parent_id' => $blog->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'blog.create', 'title' => 'Create blog','parent_id' => $blog->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'blog.edit', 'title' => 'Edit blog','parent_id' => $blog->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'blog.destroy', 'title' => 'Destroy blog','parent_id' => $blog->id,'guard_name' => 'admin']);

        $product = Permission::create(['name' => 'product', 'title' => 'Product','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'product.view', 'title' => 'View product','parent_id' => $product->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'product.create', 'title' => 'Create product','parent_id' => $product->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'product.edit', 'title' => 'Edit product','parent_id' => $product->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'product.destroy', 'title' => 'Destroy product','parent_id' => $product->id,'guard_name' => 'admin']);

        $order = Permission::create(['name' => 'order', 'title' => 'Order','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'order.view', 'title' => 'View order','parent_id' => $order->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'order.destroy', 'title' => 'Destroy order','parent_id' => $order->id,'guard_name' => 'admin']);

        $admin = Permission::create(['name' => 'admin', 'title' => 'Admin','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'admin.view', 'title' => 'View quản trị','parent_id' => $admin->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'admin.create', 'title' => 'Create admin','parent_id' => $admin->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'admin.edit', 'title' => 'Edit admin','parent_id' => $admin->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'admin.destroy', 'title' => 'Destroy admin','parent_id' => $admin->id,'guard_name' => 'admin']);

        $user = Permission::create(['name' => 'user', 'title' => 'User','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'user.view', 'title' => 'View user','parent_id' => $user->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'user.create', 'title' => 'Create user','parent_id' => $user->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'user.edit', 'title' => 'Edit user','parent_id' => $user->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'user.destroy', 'title' => 'Destroy user','parent_id' => $user->id,'guard_name' => 'admin']);

        $video = Permission::create(['name' => 'video', 'title' => 'Video','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'video.view', 'title' => 'View video','parent_id' => $video->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'video.create', 'title' => 'Create video','parent_id' => $video->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'video.edit', 'title' => 'Edit video','parent_id' => $video->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'video.destroy', 'title' => 'Destroy video','parent_id' => $video->id,'guard_name' => 'admin']);

        $gallery = Permission::create(['name' => 'gallery', 'title' => 'Gallery','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'gallery.view', 'title' => 'View gallery','parent_id' => $gallery->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'gallery.create', 'title' => 'Create gallery','parent_id' => $gallery->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'gallery.edit', 'title' => 'Edit gallery','parent_id' => $gallery->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'gallery.destroy', 'title' => 'Destroy gallery','parent_id' => $gallery->id,'guard_name' => 'admin']);

        $permission = Permission::create(['name' => 'permission', 'title' => 'Permission','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'permission.view', 'title' => 'View permission','parent_id' => $permission->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'permission.create', 'title' => 'Create permission','parent_id' => $permission->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'permission.edit', 'title' => 'Edit permission','parent_id' => $permission->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'permission.destroy', 'title' => 'Destroy permission','parent_id' => $permission->id,'guard_name' => 'admin']);

        $role = Permission::create(['name' => 'role', 'title' => 'Role','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'role.view', 'title' => 'View role','parent_id' => $role->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'role.create', 'title' => 'Create role','parent_id' => $role->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'role.edit', 'title' => 'Edit role','parent_id' => $role->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'role.destroy', 'title' => 'Destroy role','parent_id' => $role->id,'guard_name' => 'admin']);

        $setting = Permission::create(['name' => 'setting', 'title' => 'Setting','parent_id' => 0,'guard_name' => 'admin']);
        Permission::create(['name' => 'setting.update', 'title' => 'Update setting','parent_id' => $setting->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'setting.source', 'title' => 'Edit website','parent_id' => $setting->id,'guard_name' => 'admin']);
        Permission::create(['name' => 'setting.language', 'title' => 'Language','parent_id' => $setting->id,'guard_name' => 'admin']);
    }
}
