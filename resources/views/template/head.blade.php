<!doctype html>

<html lang="en">

<head>
    <title>{{ $title }}</title>
    <!-- Required meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Material Kit CSS -->
    <link href="{{url('public/assets/css/material-dashboard.css')}}" rel="stylesheet" />
    <link href="{{url('public/assets/css/sweetalert2.min.css')}}" rel="stylesheet" />
    <link href="{{url('public/assets/fontawesome/css/all.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{url('public/assets/datatables/datatables.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('public/assets/date_picker_range/daterangepicker.css')}}" />
    <link rel="icon" href="{{ url('public/assets/img/logo_sekolah.png')}}">
    <link href="{{url('public/assets/css/custom.css')}}" rel="stylesheet" />
</head>