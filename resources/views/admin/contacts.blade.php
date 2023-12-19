@extends('layouts.admin')

@php
    $organisationId = $organisation->id;
@endphp
@section('content')
    <livewire:contacts-data-table :orgId="$organisationId"/>
@endsection
