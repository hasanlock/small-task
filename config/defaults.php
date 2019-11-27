<?php
return [
    'class' => [
        'models' => [
            'task' => '\App\Models\Task',
        ],
    ],
    'configs' => [
        'max_depth' => env('CHILDREN_MAX_DEPTH_LIMIT'),
    ],
];
