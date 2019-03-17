<?php

use Illuminate\Database\Seeder;

class MailingListListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mailing_list_lists')->insert([
            'name' => 'Bitcoin Core Dev',
            'slug' => 'bitcoin-core-dev',
        ]);

        DB::table('mailing_list_lists')->insert([
            'name' => 'Bitcoin Dev',
            'slug' => 'bitcoin-dev',
        ]);

        DB::table('mailing_list_lists')->insert([
            'name' => 'Bitcoin Discuss',
            'slug' => 'bitcoin-discuss',
        ]);
    }
}
