
<?php
// написати сценарій який:
// -- зчитає html файл 'https://www.stall.com.ua/'
// -- у всі елементи що мають атрибути "class" добавити класс "global" якщо такого там немає
// -- вивести результуючий html (echo $result_html) 

$html = file_get_contents('https://www.stall.com.ua/', false);
$dom = new DomDocument();

libxml_use_internal_errors(true);
$dom->loadHTML($html);

foreach($dom->getElementsByTagName('*') as $element ) {
    if( $element->hasAttribute('class')) {
        $oldclass = $element->getAttribute('class');
        if (!($element->getAttribute('class') == "global")) {
            $element->setAttribute('class', $oldclass.' global');
        }
    }
}

$html=$dom->saveHTML();

echo 'result_html: ' . $html;
