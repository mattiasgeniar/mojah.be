<?php

use Illuminate\Database\Seeder;
use App\MailingListAuthor;
use App\MailingListTopic;
use App\MailingListMessage;
use App\MailingListList;

class MailingListListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list1 = MailingListList::create(
            [
                'name' => 'Bitcoin Core Dev',
                'slug' => 'bitcoin-core-dev',
            ]
        );

        $list2 = MailingListList::create(
            [
                'name' => 'Bitcoin Dev',
                'slug' => 'bitcoin-dev',
            ]
        );

        $list3 = MailingListList::create(
            [
                'name' => 'Bitcoin Discuss',
                'slug' => 'bitcoin-discuss',
            ]
        );

        $lists = [ $list1, $list2, $list3 ];

        // Create 5 authors
        factory(MailingListAuthor::class, 5)->create()->each(function ($author) use ($lists) {
            // Create 10 topics for each user
            factory(MailingListTopic::class, 10)->create(['mailing_list_author_id' => $author->id, 'mailing_list_list_id' => ($lists[rand(0, 2)]->id)])->each(function ($topic) use ($author) {
                // Create 5 messages in each topic
                // Known bug: this will create 5 mails in 1 topic all with the same author
                factory(MailingListMessage::class, 5)->create(['mailing_list_topic_id' => $topic->id, 'mailing_list_author_id' => $author->id]);
            });
        });
    }
}
