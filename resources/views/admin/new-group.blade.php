@extends('layouts.admin')

@php
    $organisationId = $organisation->id;
    $reformatted_org_name = strtolower(join("-", explode(" ", $organisation->name)))
@endphp
@section('content')
    <livewire:groups.new-group-multi-step :orgId="$organisationId" :orgName="$reformatted_org_name"/>
@endsection