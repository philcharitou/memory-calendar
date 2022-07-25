<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Happy Birthday Bubs</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}"/>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;500;600;700&display=swap" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>

        <script src="https://kit.fontawesome.com/a37dd41aa0.js" crossorigin="anonymous"></script>

        <!-- JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <script>
            var original_month = {{ $month_number }};
            var original_year = {{ $year }};

            var month = {{ $month_number }};
            var year = {{ $year }};

            var months_away = {{ $number_of_months }} - 1;
            var value = months_away * 100;
        </script>

        <!-- Custom Styles -->
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    </head>

    <body>

        <div class="animation-area">
            <ul class="box-area">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>

        <div class="sub-body">
            <div id="fixed-content" class="relative max-w-6xl mx-auto">

                <div class="fixed-header">
                    <img class="image-one" src="{{ asset('/img/together.jpg') }}" alt="icon">
                </div>

                <div id="header-container">
                    <div id="month-move">
                        <div id="month-left" class="month-selector">&#x21E6;</div>
                        <div id="month">{{ $month }} {{ $year }}</div>
                        <div id="month-right" class="month-selector">&#x21E8;</div>
                    </div>
                </div>

                <div id="content" class="mt-4 bg-white dark:bg-gray-800 overflow-hidden medium-shadow sm:rounded-lg">
                    @foreach($total_array as $index => $month)
                        <div class="calendar-grid" @if($index == 0)id="move-calendar"@endif>
                            @foreach($month as $day)
                                @if(!$day[1])
                                    <div class="date inactive unselectable">
                                        <div class="date-number">{{ \Carbon\Carbon::parse($day[0])->format('d') }}</div>
                                    </div>
                                @else
                                    <div id="{{ $day[0] }}" class="date active">
                                        <div class="date-number">{{ \Carbon\Carbon::parse($day[0])->format('d') }}</div>
                                        <div>{{ $day[3] }}</div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <div class="container-footer">
                    <div></div>
                    <div id="thanks">
                        Thanks for being mine &#10084;
                    </div>
                </div>

            </div>
        </div>

        <div id="modal-background" class="opacity"></div>

        <div class="modal-container">
            <div id="event-modal" class="modal">
                <div class="exit-modal"><i class="fa-solid fa-xmark"></i></div>
                <div class="modal-warning">
                    <h3>Missing something?</h3>
                    <a href="{{ route('events.create') }}">
                        <button class="btn btn-add">Add an Event</button>
                    </a>
                </div>
            </div>
        </div>
    </body>

    <!-- Custom Scripts -->
    <script type="text/javascript" src="{{ url('/js/custom.js') }}"></script>
</html>
