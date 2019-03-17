<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MailingList;
use App\MailingListMessage;
use App\MailingListTopic;
use App\MailingListAuthor;
use App\MailingListList;

class MailingListImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailing-list:import {list-name} {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import new mails sent to the Bitcoin mailing list archives.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = $this->argument('file');
        $listName = $this->argument('list-name');

        $list = new MailingList($file);
        $list->open();

        $mailingList = MailingListList::where(['slug' => $listName])->firstOrFail();

        if (!$mailingList) {
            dd('First add this mailing list to the DB');
        }

        for ($n = 0; $n < $list->size(); $n++) {
            $message = $list->get($n);

            $mailingListMessage = new MailingListMessage();
            $mailingListMessage->setRawMessage($message);

            // Thread: a message is part of the same thread if:
            // - The sender is part of the thread OR in-reply-to mis used
            // - It's a relatively recent reply to the last message
            // - The subject is similar

            $subject = trim($mailingListMessage->getSubject());
            $email = $mailingListMessage->getFromEmail();
            $emailName = $mailingListMessage->getFromName();
            $date = $mailingListMessage->getDate();
            $body = $mailingListMessage->getBodyText();

            $messageHash = md5($date . $email . $body);

            $mailingListAuthor = mailingListAuthor::firstOrCreate(
                [
                    'email' => $email,
                ],
                [
                    'email' => $email,
                    'display_name' => $emailName,
                ]
            );

            $mailingListTopic = MailingListTopic::firstOrCreate(
                [
                    'topic' => $subject
                ],
                [
                    'mailing_list_list_id' => $mailingList->id,
                    'topic' => $subject,
                    'mailing_list_author_id' => $mailingListAuthor->id,
                ]
            );

            $mailingListMessage = MailingListMessage::firstOrCreate(
                [
                    'hash' => $messageHash,
                ],
                [
                    'mailing_list_topic_id' => $mailingListTopic->id,
                    'mailing_list_author_id' => $mailingListAuthor->id,
                    'hash' => $messageHash,
                    'raw' => $message,
                    'content' => $body,
                ]
            );
        }

        $list->close();
    }
}
