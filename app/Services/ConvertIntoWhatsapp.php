<?php

namespace App\Services;

class ConvertIntoWhatsapp
{
    function convertQuillHtmlToWhatsappFormat($html)
    {
        // Load HTML into DOMDocument
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true); // Suppress HTML5 warnings
        $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

        $xpath = new \DOMXPath($dom);

        // Define replacements
        $replacements = [
            'strong|b'    => '*%s*',
            'em|i'        => '_%s_',
            'u'           => '__%s__',
            's|del'       => '~%s~',
            'code'        => '`%s`',
            'pre'         => "```\n%s\n```",
            'blockquote'  => "> %s\n",
            'a'           => '%s (%s)',
            'li'          => '* %s',
            'p'           => "%s\n",
            'br'          => "\n"
        ];

        foreach ($replacements as $tag => $format) {
            $tags = explode('|', $tag);
            foreach ($tags as $t) {
                foreach ($xpath->query("//$t") as $node) {
                    $content = $node->textContent;

                    if ($t === 'a') {
                        $href = $node->getAttribute('href');
                        $replacement = sprintf($format, $content, $href);
                    } elseif ($t === 'li') {
                        $isOrdered = $node->parentNode->nodeName === 'ol';
                        $replacement = ($isOrdered ? '1. ' : '* ') . $content . "\n";
                    } elseif ($t === 'br') {
                        $replacement = "\n";
                    } else {
                        $replacement = sprintf($format, $content);
                    }

                    $newNode = $dom->createTextNode($replacement);
                    $node->parentNode->replaceChild($newNode, $node);
                }
            }
        }

        // Get only the body content
        $body = $dom->getElementsByTagName('body')->item(0);
        $text = '';
        foreach ($body->childNodes as $child) {
            $text .= $dom->saveHTML($child);
        }

        // Strip remaining tags and decode HTML entities
        return html_entity_decode(strip_tags($text));
    }
}
