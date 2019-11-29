<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <!-- <div class="flex-center position-ref full-height"> -->
        <div>
            <!-- <div class="content"> -->
            <div>
            @foreach ($userTaskList as $userTask)
                <!-- 1-->
                <div style="border: 1px black solid; padding: 3px; margin: 1px;">
                <div>
                    {{ $userTask['user_name'] }} ({{$userTask['points_done']}}/{{$userTask['points_total']}})
                </div>
                @foreach ($userTask['task_info'] as $task)
                    <!-- 2-->
                    <li>({{$task->is_done ? 'V' : 'X'}}) {{ $task->id }} {{ $task->title }} ({{ $task->points }})</li>
                    @if ($task->children->count() > 0)
                        <ul>
                        @foreach ($task->children as $task_child_1)
                            <!-- 3-->
                            <li>({{$task_child_1->is_done ? 'V' : 'X'}}) {{ $task_child_1->id }} {{ $task_child_1->title }} ({{ $task_child_1->points }})</li>
                            @if ($task_child_1->children->count() > 0)
                                <ul>
                                @foreach ($task_child_1->children as $task_child_2)
                                    <li>({{$task_child_2->is_done ? 'V' : 'X'}}) {{ $task_child_2->id }} {{ $task_child_2->title }} ({{ $task_child_2->points }})</li>
                                    @if ($task_child_2->children->count() > 0)
                                        <ul>
                                        @foreach ($task_child_2->children as $task_child_3)
                                            <li>({{$task_child_3->is_done ? 'V' : 'X'}}) {{ $task_child_3->id }} {{ $task_child_3->title }} ({{ $task_child_3->points }})</li>
                                        @endforeach
                                        </ul>
                                    @endif

                                @endforeach
                                </ul>
                            @endif
                            <!-- 3-->
                        @endforeach
                        </ul>
                    @endif
                    <!-- 2-->
                @endforeach
                </div>
                <!-- 1-->
            @endforeach
            </div>
        </div>
    </body>
</html>
