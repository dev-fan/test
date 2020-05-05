<?php

define('SITEPATH', __DIR__);

function import(string $сlass)
{
    $сlass = \ltrim($сlass, '\\');
    $file = $namespace = '';
    if ($lastNsPos = \strrpos($сlass, '\\')) {
        $namespace = \substr($сlass, 0, $lastNsPos);
        $сlass = \substr($сlass, $lastNsPos + 1);
        $file = \str_replace('\\', \DIRECTORY_SEPARATOR, $namespace) . \DIRECTORY_SEPARATOR;
    }
    $file .= \str_replace('_', \DIRECTORY_SEPARATOR, $сlass) . '.php';

    if (\file_exists(SITEPATH . '/lib/' . $file)) {
        require_once SITEPATH . '/lib/' . $file;
    }
}

\spl_autoload_register('import', true, true);
