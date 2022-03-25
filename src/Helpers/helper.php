<?php

function loadConfigData()
{
    if (function_exists('config_path')) {
        if (file_exists(config_path('salesbinder.php'))) {
            $configuration = include(config_path('salesbinder.php'));
            return $configuration;
        }
    }

    $configuration = include(__DIR__ . '/../Config/salesbinder.php');

    return $configuration;
}