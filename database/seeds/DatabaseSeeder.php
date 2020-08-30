<?php

use App\User;
use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // Ask for db migration refresh, default is no
        if($this->command->confirm('Do you wish to refresh migration before seeding, it would clear old data?')){
            $this->command->call('migrate:refresh');
            $this->command->warn('Data cleared, starting from blank database');
        }

        // seed default permissions
        $permissions = Permission::defaultPermissions();
        foreach($permissions as $perms){
            Permission::firstOrCreate(['name' => $perms, 'guard_name' => 'web']);
        }
        $this->command->info('Default Permissions added.');

        // Confirm roles needed
        if($this->command->confirm('Create Roles for user, default is super admin, admin and user? [y/N]', true)){
            // Ask for roles from input
            $input_roles = $this->command->ask('Enter roles in a comma seperate format.', 'Admin, User');
            // explode roles
            $roles_array = explode(',', $input_roles);
            // add roles
            foreach($roles_array as $role)
            {
                $role = Role::firstOrCreate(['name' => trim($role), 'guard_name' => 'web']);
                if($role->name == 'Admin'){
                    // assign all permissions
                    $role->syncPermissions(Permission::all());
                    $this->command->info('Admin granted all permissions');
                }else{
                    // for others by default only read access
                    $role->syncPermissions(Permission::where('name', 'LIKE', 'view_%')->get());
                }

                // create one user for each role
                $this->createUser($role);
            }

            $this->command->info('Roles' . $input_roles . ' added successfully');
        }else{
            Role::firstOrCreate(['name' => 'User']);
            $this->command->info('Added only default user role.');
        }

        // now lets seed some posts for demo
        factory(\App\Post::class, 30)->create();
        $this->command->info('Some post data seeded...');
        $this->command->warn('All done');
    }

    private function createUser($role)
    {
        $user = factory(User::class)->create();
        $user->assignRole($role->name);
        if($role->name == 'Admin'){
            $this->command->info('Here is your admin details to login: ');
            $this->command->warn($user->email);
            $this->command->warn('Password is "secret"');
        }
    }
}
