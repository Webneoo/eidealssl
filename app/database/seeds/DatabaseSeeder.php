<?php
class DatabaseSeeder
 extends Seeder {

	protected $tables = [
        'users',
        'ta_income_ref',
        'ta_professions',
        'ta_profiles',
        'ta_promo_const',
        'ta_secret_questions',
        'ta_tickets_ref',
        'ta_ticket_status'
    ];

    protected $seeders = [
        'UsersTableSeeder',
        'IncomeRefTableSeeder',
        'ProfessionsTableSeeder',
        'ProfilesTableSeeder',
        'PromoConstTableSeeder',
        'SecretQuestionsTableSeeder',
        'TicketsRefTableSeeder',
        'TicketStatusTableSeeder'
    ];

    /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->cleanDatabase();

        foreach ($this->seeders as $seedClass)
        {
            $this->call($seedClass);
        }
	}

    private function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach($this->tables as $table)
        {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }

}
