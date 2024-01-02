@extends('layouts.admin')

@php
    $organisationId = $organisation->id;
    $reformatted_org_name = strtolower(join("-", explode(" ", $organisation->name)))
@endphp
@section('content')
    <section class="section main-section">
        <div class="flex flex-col sm:flex-row gap-4 mb-6 shadow-lg">
            <livewire:bulk-load.bulk-import :orgId="$organisationId" :orgName="$reformatted_org_name" />
            <livewire:bulk-load.bulk-export :orgId="$organisationId" :orgName="$reformatted_org_name" />
        </div>
    </section>
@endsection