<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $this->createUser([
            'first_name' => 'Arthur',
            'last_name'  => 'Lorent',
            'email'      => 'arthur@acid.fr',
            'password'   => Hash::make('secret'),
        ], 'admin');
        $this->createUser([
            'first_name' => 'Mathieu',
            'last_name'  => 'Yactayo',
            'email'      => 'mathieu@acid.fr',
            'password'   => Hash::make('secret'),
        ], 'admin');
        $this->createUser([
            'first_name' => 'Nicolas',
            'last_name'  => 'Conrad',
            'email'      => 'nicolas.conrad@itcco.fr',
            'password'   => Hash::make('secret'),
        ], 'moderator');
    }

    /**
     * @param array $data
     * @SuppressWarnings("unused")
     */
    public function createUser(array $data)
    {
        $user = (new User)->create($data);
        $user->addMedia(database_path('seeds/files/users/default-450-450.png'))
            ->preservingOriginal()
            ->toMediaCollection('avatar');
    }
}
