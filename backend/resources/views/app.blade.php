<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="title" content"LarVueShop">
        <title>LarVueShop</title>
        <!-- Fonts and Icons -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">

    </head>
    <body>
        <div id="app"></div>
        <!-- Autoinjected Vue Components -->
  <script async src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript" src="{{ mix('js/app.js')}}"></script>

    </body>
</html>
