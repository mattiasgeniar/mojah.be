<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MailingList;
use App\MailingListMessage;
use App\MailingListTopic;
use App\MailingListAuthor;
use App\MailingListList;
use Carbon\Carbon;

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
            dd('First add this mailing list to the DB: ' . $listName);
        }

        for ($n = 0; $n < $list->size(); $n++) {
            $message = $list->get($n);

            if (! $message) {
                continue;
            }

            $mailingListMessage = new MailingListMessage();
            $mailingListMessage->setRawMessage($message);

            // Thread: a message is part of the same thread if:
            // - The sender is part of the thread OR in-reply-to mis used
            // - It's a relatively recent reply to the last message
            // - The subject is similar

            // Fetch the subject
            $subject = trim($mailingListMessage->getSubject());

            // Skip mailing list membership reminders, contains sensitive info
            if (strpos($subject, 'mailing list memberships reminder') !== false) {
                continue;
            }

            // Remove everything before the [bitcoin-dev] prefix, we match the first found '[' char
            // This usually contains the 'Re: ', 'Fwd: ', ... prefixes
            if (strpos($subject, '[') !== false) {
                $subject = substr($subject, strpos($subject, '['));
            }

            // Remove the [bitcoin-dev] prefix from the subject
            $subject = preg_replace('/\[[a-zA-Z0-9-]+\] /', '', $subject);

            $email = $mailingListMessage->getFromEmail();
            $emailName = $mailingListMessage->getFromName();
            $date = Carbon::parse($mailingListMessage->getDate());
            $body = trim($mailingListMessage->getBodyText());

            $messageHash = md5($date . $email . $subject);

            if ($email) {
                $mailingListAuthor = mailingListAuthor::firstOrCreate(
                    [
                        'email' => $email,
                    ],
                    [
                        'email' => $email,
                        'display_name' => $emailName,
                    ]
                );

                $mailingListAuthorId = $mailingListAuthor->id;
            } else {
                // Somehow couldn't parse author, skip this message
                // Might lead to missed emails, but going for speed over complexity for now
                continue;
            }

            // Subject matching: find the topic that has the same subject and was updated
            // at most 1 month ago. If it's older, assume it's a new topic and create a new one.
            $topicDateMin = $date->copy()->subDays(30);
            $topicDateMax = $date->copy()->addDays(30);
            $mailingListTopic = MailingListTopic::where('topic', $subject)
                ->whereBetween('updated_at', [$topicDateMin, $topicDateMax])->first();

            if (!$mailingListTopic) {
                $mailingListTopic = new MailingListTopic();
                $mailingListTopic->mailing_list_list_id = $mailingList->id;
                $mailingListTopic->topic = $subject;
                $mailingListTopic->mailing_list_author_id = $mailingListAuthorId;
                $mailingListTopic->created_at = $date;
                $mailingListTopic->save();
            }

            // Update the mailinglist's "last updated at" timestamp
            $mailingList->updated_at = $mailingListTopic->created_at;
            $mailingList->save();

            $mailingListMessage = MailingListMessage::firstOrCreate(
                [
                    'hash' => $messageHash,
                ],
                [
                    'mailing_list_topic_id' => $mailingListTopic->id,
                    'mailing_list_author_id' => $mailingListAuthorId,
                    'hash' => $messageHash,
                    'content' => $body,
                    'created_at' => $date,
                ]
            );

            // Update the topic's "last updated at" timestamp
            $mailingListTopic->updated_at = $mailingListMessage->created_at;
            $mailingListTopic->save();
        }

        $list->close();
    }
}
