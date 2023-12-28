@extends('layouts.admin')

@php
    $selectedGroup = $selectedGroup;
    $organisationId = $organisation->id;
@endphp
@section('content')
    <livewire:groups.view-group :orgId="$organisationId" :selectedGroup="$selectedGroup"/>
@endsection