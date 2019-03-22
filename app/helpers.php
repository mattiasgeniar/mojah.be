<?php

function getMessageBody($body)
{
    // Remove the body after '-------------- next part --------------'
    $markerNextPart = '-------------- next part --------------';
    if (strpos($body, $markerNextPart) !== false) {
        $body = substr($body, 0, strpos($body, $markerNextPart));
    }

    // Make URLs clickable
    $body = preg_replace('!(((http|https|ftp)://)[-a-zA-Zа-яА-Я0-9_+.#?&;/]+)!i', '<a href="$1">$1</a>', $body);
    // Stupid fix: the regex above will include a '>' sign in the URL, remove that
    $body = str_replace('&gt;">', '">', $body); // Removes from <a href="https://bitcoincore.org/bin/bitcoin-core-0.17.1/&gt;">
    $body = str_replace('&gt;</a>', '</a>>', $body); // Removes from https://bitcoincore.org/bin/bitcoin-core-0.17.1/&gt;</a>

    // Encapsulate strings in backtics in <code> tags
    $body = preg_replace("/`(.*?)`/s", '<code class="bg-grey-lighter pl-1 pr-1 leading-tight text-red-dark rounded-sm font-mono text-sm">$1</code>', $body);

    // Set the quoted text in italic/grey
    $body = setMarkupQuotedText($body);

    // Find signatures in the message body and collapse them
    $body = collapseSignature($body);

    // Find multiple new lines in a row and remove them, keep one left
    $body = collapseMultipleNewLines($body);

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
            $return .= '<span class="text-grey-dark italic leading-none">'. $line .'</span>';
        } else {
            $return .= $line;
        }

        $return .= "\n";
    }

    return $return;
}

function collapseSignature($body)
{
    // Find the last occurence of the string "--", often used as a signature marker
    // Gotcha: needs to be a standalone line, not part of another sentence, so can't use strrpos()
    $lines = explode("\n", $body);
    $signaturePosition = null;

    foreach ($lines as $lineCount => $line) {
        $line = trim($line);
        if ($line == "--") {
            $signaturePosition = $lineCount;
        }
    }

    if ($signaturePosition && $signaturePosition < count($lines)) {
        $lines[$signaturePosition] = '<span class="text-grey-light">--';
        $lines[] = '</span>';
    }

    return implode("\n", $lines);
}

function collapseMultipleNewLines($body)
{
    // Find multiple new lines
    $body = preg_replace("/(\r?\n){2,}/", "\n\n", $body);

    return $body;
}
