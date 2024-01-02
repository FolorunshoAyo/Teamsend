@extends('layouts.admin')

@php
    $organisationId = $organisation->id;
@endphp
@section('content')
    <livewire:email-templates.email-templates-list :orgId="$organisationId" />
@endsection
