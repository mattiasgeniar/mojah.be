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

    // Encapsulate strings in backtics in <code> tags
    $body = preg_replace("/`(.*?)`/s", '<code class="bg-grey-lighter pl-1 pr-1 leading-tight text-red-dark rounded-sm font-mono text-sm">$1</code>', $body);

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
