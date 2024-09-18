<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            //permissions
            [
                'name' => 'permissions_create',
            ],
            [
                'name' => 'permissions_edit',
            ],
            [
                'name' => 'permissions_delete',
            ],
            [
                'name' => 'permissions_show',
            ],
            [
                'name' => 'permissions_access',
            ],

            //roles
            [
                'name' => 'role_create',
            ],
            [
                'name' => 'role_edit',
            ],
            [
                'name' => 'role_delete',
            ],
            [
                'name' => 'role_show',
            ],
            [
                'name' => 'role_access',
            ],

            //candidates
            [
                'name' => 'candidate_create',
            ],
            [
                'name' => 'candidate_edit',
            ],
            [
                'name' => 'candidate_delete',
            ],
            [
                'name' => 'candidate_show',
            ],
            [
                'name' => 'candidate_access',
            ],

            //voters
            [
                'name' => 'voter_create',
            ],
            [
                'name' => 'voter_edit',
            ],
            [
                'name' => 'voter_delete',
            ],
            [
                'name' => 'voter_show',
            ],
            [
                'name' => 'voter_access',
            ],

            //partylits
            [
                'name' => 'partylist_create',
            ],
            [
                'name' => 'partylist_edit',
            ],
            [
                'name' => 'partylist_delete',
            ],
            [
                'name' => 'partylist_show',
            ],
            [
                'name' => 'partylist_access',
            ],

            //election
            [
                'name' => 'election_create',
            ],
            [
                'name' => 'election_edit',
            ],
            [
                'name' => 'election_delete',
            ],
            [
                'name' => 'election_show',
            ],
            [
                'name' => 'election_access',
            ],

            //user
            [
                'name' => 'user_create',
            ],
            [
                'name' => 'user_edit',
            ],
            [
                'name' => 'user_delete',
            ],
            [
                'name' => 'user_show',
            ],
            [
                'name' => 'user_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
