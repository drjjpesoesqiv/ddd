#!/usr/bin/php
<?php

function underscore($word)
{
  echo $word . PHP_EOL;
  for ($i = 0; $i < strlen($word); $i++)
    echo '-';
  echo PHP_EOL;
}

if (empty($argv[1]))
  exit('forgot word to define');

define('API_KEY', 'api key');
define('URL', "http://www.dictionaryapi.com/api/v1/references/collegiate/xml/#{word}?key=#{key}");

$url = str_replace('#{word}', $argv[1], URL);
$url = str_replace('#{key}', API_KEY, $url);

$xml  = file_get_contents($url);
$data = new SimpleXMLElement($xml);

echo PHP_EOL;
foreach ($data->entry as $entry)
{
  underscore($entry->fl); 
  foreach ($entry->def->dt as $def)
    echo "  $def" . PHP_EOL;
  echo PHP_EOL;
}