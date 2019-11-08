<?php

namespace RechnenWebzeugNet;

class ApplicationVersion
{
    public static function get()
    {
        $currentVersion = trim(exec('git describe --tags --abbrev=0'));
        $commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
        $commitDate->setTimezone(new \DateTimeZone('UTC'));
        return sprintf('Version %s (%s)', $currentVersion, $commitDate->format('Y-m-d H:i:s'));
    }
}