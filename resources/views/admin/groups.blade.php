@extends('layouts.admin')

@php
    $organisationId = $organisation->id;
    $reformatted_org_name = strtolower(join("-", explode(" ", $organisation->name)))
@endphp
@section('content')
    <livewire:groups.groups-data-table :orgId="$organisationId" :orgName="$reformatted_org_name"/>
@endsection

@section('action-scripts')
  @if (session('success'))
    <script>
        toastr.success("{{ session('success')}}", 'Success');
    </script>
  @endif
@endsection