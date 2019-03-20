<?php

function getMessageBody($body)
{
    // Remove the body after '-------------- next part --------------'
    $markerNextPart = '-------------- next part --------------';
    if (strpos($body, $markerNextPart) !== false) {
        $body = substr($body, 0, strpos($body, $markerNextPart));
    }

    // Make URLs clickable
    $body = preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1">$1</a>', $body);

    // Set the quoted text in italic/grey
    $body = setMarkupQuotedText($body);

    // Text to HTML new lines
    $body = nl2br($body);

    return $body;
}

function setMarkupQuotedText($body)
{
    $lines = explode("\n", $body);

    $return = "";

    foreach ($lines as $line) {
        if (strlen($line) > 0 && substr($line, 0, 4) == '&gt;') {
            $return .= '<span class="text-grey-dark italic">'. $line .'</span>';
        } else {
            $return .= $line;
        }

        $return .= "\n";
    }

    return $return;
}
