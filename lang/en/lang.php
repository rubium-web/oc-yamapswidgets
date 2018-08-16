<?php
return [
    'plugin' => [
        'name' =>  'YaMaps Widget',
        'description' => 'It provides functionality for the Backend Forms that allows to save maps of YaMaps in an easy and fast way.',
    ],
    'settings' => [
        'tab' => 'YaMaps Widget',
        'label' => 'YaMaps Widget',
        'description' => 'Configuring YaMaps',
        'address_map' => 'YaMaps',
        'address_map_comment' => 'An example of using the YaMaps widget. You can display the map using the yaMap component, specifying the required parameters.'
    ],
    'permissions' => [
        'tab' => 'YaMaps Widget',
        'label' => 'Modify plug-in configurations'
    ],
    'widget' => [
        'name' => 'YaMaps Widget Widget'
    ],
    'marker' => [
        'standart' => 'Standart',
        'dot' => 'Dot',
        'circle' => 'Circle',
        'circle_dot' => 'Circle Dot'
    ],
    'component' => [
        'name' => 'Frontend YaMaps',
        'description' => 'Display a simple YaMaps on the website frontend.',
        'width' => 'Width',
        'width_description' => 'It can be use px or %',
        'height' => 'Height',
        'height_description' => 'It can be use px or %',
        'mapType' => 'Map type',
        'zoom' => 'Zoom',
        'showMarker' => 'Show Marker',
        'fitToView' => 'Fit marks to view',
        'animateMarker' => 'Animate Marker'
    ],
    'maps' => [
        'name' => 'Name',
        'address' => 'Address',
        'description_location' => 'You can pick location on map or insert address and select in dropdown menu',
        'description_address' => 'This field auto update with Yandex API. Please insert address and select option in dropdown menu. Address automaticaly inserted to map',
        'description_marker_type' => 'Marker type for frontend map',
        'description_enable_balloon' => 'Show ballon after click to marker',
        'description_info_window' => 'This text insert in balloon content',        
        'marker_type' => 'Marker type',
        'marker_color' => 'Marker color',
        'enable_balloon' => 'Show balloon',
        'info_window' => 'Information window',
    ]
];
