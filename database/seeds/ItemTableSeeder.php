class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call('ItemTableSeeder');

        $this->command->info('Item table seeded!');
    }

}

class ItemTableSeeder extends Seeder {

    public function run()
    {
        DB::table('students')->delete();

        Student::create(['first_name' => 'James',
                      'last_name' => 'Bond',
                      'id_number' => '007',
                    ]);
        Student::create(['first_name' => 'Bob',
                      'last_name' => 'Marquis',
                      'id_number' => '001',
                    ]);
        Student::create(['first_name' => 'Jose',
                      'last_name' => 'Garcia',
                      'id_number' => '12345',
                    ]);
    }

}