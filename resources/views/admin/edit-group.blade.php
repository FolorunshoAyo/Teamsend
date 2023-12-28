@extends('layouts.admin')

@php
    // The reformmated_org_name is for component redirect within an organisation
    $organisationId = $organisation->id;
    $reformatted_org_name = strtolower(join("-", explode(" ", $organisation->name)));
    $list_details = $groupDetails;
    $list_contacts = $groupDetails->contacts()->pluck('contacts.id')->toArray();
@endphp
@section('content')
    <livewire:groups.edit-group-multi-step :orgId="$organisationId" :orgName="$reformatted_org_name" :step1FormData="$list_details" :step2FormData="$list_contacts"/>
@endsection