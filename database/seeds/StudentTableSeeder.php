class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call('StudentTableSeeder');

        $this->command->info('Student table seeded!');
    }

}

class StudentTableSeeder extends Seeder {

    public function run()
    {
        DB::table('students')->delete();

        Student::create(['first_name' => 'James', 'last_name' => 'Bond', 'id_number' => '007']);
        Student::create(['first_name' => 'Bob', 'last_name' => 'Marquis', 'id_number' => '001']);
        Student::create(['first_name' => 'Jose', 'last_name' => 'Garcia', 'id_number' => '0505']);
    }

}