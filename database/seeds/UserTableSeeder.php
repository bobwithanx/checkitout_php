class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call('UserTableSeeder');

        $this->command->info('User table seeded!');
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(['email' => 'marquis@phoenixunion.org',
                      'password' => '123456',
                      'name' => 'Bob Marquis',
                    ]);
    }

}
