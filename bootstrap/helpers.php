<?php

if (!function_exists('sidebarMarking')) {
    function sidebarMarking($mainMenu, $subMenu)
    {
        session(['mainMenu' => $mainMenu]);
        session(['subMenu' => $subMenu]);
    }
}