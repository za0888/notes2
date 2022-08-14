@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '666')
@section('message', __($exception->getMessage() ?: 'Nik-ZA mesage'))
