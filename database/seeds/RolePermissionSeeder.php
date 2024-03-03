<?php


use App\User;
use App\Role;
use App\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::truncate();
        //Create some roles
        $su = Role::firstOrcreate(['name' => 'Gerente']);
        $admin = Role::firstOrcreate(['name' => 'Administrador']);
        $moderator = Role::firstOrcreate(['name' => 'Vendedor']);
        $moderatoralmac = Role::firstOrcreate(['name' => 'Almacenista']);

        // Create permissions
        Permission::truncate();
         $permissions = [
            "admin.access" => [
                'Gerente',
                'Administrador',
            ],
            "admins.manage" => [
                'Gerente',
                'Administrador',
            ],
            "admins.create" => [
                'Gerente',
                'Administrador',
            ],
            "category.create" => [
                'Gerente',
                'Administrador',
                'Almacenista'
            ],
            "category.view" => [
                'Gerente',
                'Administrador',
                'Almacenista'
            ],
            "category.manage" => [
                'Gerente',
                'Administrador',
                'Almacenista'
            ],
            "product.create" => [
                'Gerente',
                'Administrador',
                'Almacenista'
            ],
            "product.manage" => [
                'Gerente',
                'Administrador',
                'Vendedor',
                'Almacenista'
            ],
            "product.view" => [
                'Gerente',
                'Administrador',
                'Vendedor',
                'Almacenista'
            ],
            "customer.create" => [
                'Gerente',
                'Administrador',
                'Vendedor'
            ],
            "customer.manage" => [
                'Gerente',
                'Administrador',
                'Vendedor',
            ],
            "customer.view" => [
                'Gerente',
                'Administrador',
                'Vendedor',
            ],
            "supplier.create" => [
                'Gerente',
                'Administrador',
            ],
            "supplier.manage" => [
                'Gerente',
                'Administrador'
            ],
            "supplier.view" => [
                'Gerente',
                'Administrador',
            ],
            "user.create" => [
                'Gerente',
                'Administrador'
            ],
            "user.manage" => [
                'Gerente',
                'Administrador'
            ],
            "sell.create" => [
                'Gerente',
                'Administrador',
                'Vendedor',
            ],
            "sell.view" => [
                'Gerente',
                'Administrador',
                'Vendedor',
            ],
            "sell.manage" => [
                'Gerente',
                'Administrador',
                'Vendedor',
            ],
            "purchase.create" => [
                'Gerente',
                'Administrador'
            ],
            "purchase.view" => [
                'Gerente',
                'Administrador'
            ],
            "purchase.manage" => [
                'Gerente',
                'Administrador'
            ],
            "transaction.view" => [
                'Gerente',
                'Administrador'
            ],
            "settings.manage" => [
                'Gerente',
                'Administrador'
            ],
            "acl.manage" => [
                'Gerente',
                'Administrador'
            ],
            "acl.set" => [
                'Gerente',
                'Administrador'
            ],
            "report.view" => [
                'Gerente',
                'Administrador'
            ],
            "profit.view" => [
                'Gerente',
                'Administrador'
            ],
            "cash.view" => [
                'Gerente',
                'Administrador'
            ],
            "profit.graph" => [
                'Gerente',
                'Administrador'
            ],
            "tasa.actions" => [
                'Gerente',
                'Administrador'
            ],
        ];

        foreach ($permissions as $permission => $roleName) {
            $permissionObject = Permission::createPermission($permission);
            $rolesIds = Role::whereIn('name', $roleName)->pluck('id')->toArray();
            $permissionObject->roles()->sync($rolesIds);
        }

        // Create initial user
        User::truncate();

        $su = User::firstOrCreate(
            [ 'email' => 'admin@admin.com' ],
            [
                'first_name' => 'Gerente',
                'last_name' => 'General',
                'password' => 'admin'
            ]
        );

        $su->roles()->sync([1]);

    }
}
