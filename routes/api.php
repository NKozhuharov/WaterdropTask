<?php

// Create Dingo Router
$api = app('Dingo\Api\Routing\Router');

// Create a Dingo Version Group
$api->version(
    'v1',
    static function ($api) {
        $api->get(
            '',
            function () {
                return 'success';
            }
        );

        $api->group(
            ['namespace' => 'App\Http\Controllers'],
            static function ($api) {
                $api->group(
                    ['middleware' => 'auth'],
                    static function ($api) {
                        $api->post('adddog', 'DogController@add');
                        $api->get('listdogs', 'DogController@list');
                    }
                );
            }
        );
    }
);
