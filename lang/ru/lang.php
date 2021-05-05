<?php
return [
    'plugin' => [
        'name' =>  'YaMaps Widget',
        'description' => 'Обеспечивает функциональность бэкэнд-форм, что позволяет легко и быстро сохранять карты YaMaps.',
    ],
    'settings' => [
        'tab'=> [
            'map' => 'Карта',
            'settings' => 'Настройки',
        ],
        'label' => 'Виджет YaMaps',
        'description' => 'Настройка карты YaMaps',
        'address_map' => 'YaMaps',
        'address_map_comment' => 'Пример использования виджета YaMaps. Вы можете вывести карту при помощи компонента yaMap, указав необходимые параметры.',
        'apikey' => 'API-ключ',
        'description_apikey' => 'API-ключ. Получить ключ можно в Кабинете разработчика',
        'lang' => 'Локаль',
        'description_lang' => 'Локаль. Задается в виде: lang=language_region',
    ],
    'permissions' => [
        'tab' => 'Виджет YaMaps',
        'label' => 'Изменение конфигураций плагина'
    ],
    'widget' => [
        'name' => 'Виджет YaMaps'
    ],
    'marker' => [
        'standart' => 'Стандартный',
        'dot' => 'Точка',
        'circle' => 'Круглый',
        'circle_dot' => 'Круглая точка'
    ],
    'component' => [
        'name' => 'Интерфейс YaMaps',
        'description' => 'Прочтое отображение YaMaps на веб-сайте.',
        'width' => 'Ширина',
        'width_description' => 'Возможно использование px или %',
        'height' => 'Высота',
        'height_description' => 'Возможно использование px или %',
        'mapType' => 'Тип карты',
        'zoom' => 'Увеличение (zoom)',
        'showMarker' => 'Показать маркер',
        'fitToView' => 'Поместить все метки для отображения',
        'animateMarker' => 'Анимация маркера'
    ],
    'maps' => [
        'name' => 'Название',
        'address' => 'Адрес',
        'description_location' => 'Вы можете выбрать местоположение на карте или указать адрес и выбрать его в выпадающем меню',
        'description_address' => 'Это поле автоматически обновляется с помощью API-интерфейса Yandex. В раскрывающемся меню укажите адрес и выберите опцию. Адрес будет автоматически вставлен на карту',
        'description_marker_type' => 'Тип маркера ля отображения на сайте',
        'description_enable_balloon' => 'Показывать балун после клика по маркеру',
        'description_info_window' => 'Этот текст будет помещен в содержимое балуна',        
        'marker_type' => 'Тип маркера',
        'marker_color' => 'Цвет маркера',
        'enable_balloon' => 'Показать балун',
        'info_window' => 'Информационное окно',
    ]
];
