@extends('layouts.admin')

@section('content')
    <section class="main main-section">
        <div class="p-6 bg-white shadow-sm rounded-sm">
            <div class="my-6 flex flex-col items-center sm:justify-between sm:flex-row gap-4">
                <button class="button --jb-modal" data-target="new-campaign-schedule-modal">
                    <i class="mdi mdi-plus"></i>
                    Add New Campaign Schedule
                </button>
                <form>
                    <div class="field">
                        <div class="control icons-left">
                            <input class="input" type="text" placeholder="Search Scheduels....">
                            <span class="icon left"><i class="mdi mdi-magnify mdi-24px"></i></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card has-table mb-6">
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                        Campaign Schedules
                    </p>
                    <div class="tools inline-flex items-center space-x-2">
                        <span class="font-semibold">Show:</span>
                        <div class="control">
                            <div class="select">
                                <select>
                                    <option>25</option>
                                    <option>50</option>
                                    <option>100</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="card-header-icon">
                                <span class="icon"><i class="mdi mdi-reload"></i></span>
                            </a>
                        </div>
                    </div>
                </header>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Campaign Name</th>
                                <th>Schedule at</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="image-cell">
                                    <div class="image">
                                        <img src="{{ asset('images/avatar.svg') }}" class="rounded-full" />
                                    </div>
                                </td>
                                <td data-label="Campaign Name">
                                    <a class="font-medium whitespace-no-wrap inline-block" href="javascript:void(0)">
                                        Campaign Name
                                    </a>
                                    <p>Some Desc</p>
                                </td>
                                <td data-label="Schedule at">Tuesday, 31th October 2023 </td>
                                <td data-label="Status">
                                    <div class="flex items-center text-green-600">
                                        <i class="mdi mdi-check-circle-outline"></i> Delivered
                                        <!-- <i class="mdi mdi-close-circle-outline"></i> Undelivered -->
                                    </div>
                                </td>
                                <td data-label="Created">3 days ago</td>
                                <td class="actions-cell">
                                    <div class="buttons right nowrap">
                                        <a class="button green" href="javascript:void(0)">
                                            <span class="icon"><i class="mdi mdi-eye mdi-24px"></i></span>
                                        </a>
                                        <a class="button red" href="javscript:void(0)">
                                            <span class="icon"><i class="mdi mdi-trash-can mdi-24px"></i></span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="table-pagination">
                        <div class="flex items-center justify-between">
                            <nav class="pagination my-6">
                                <ul>
                                    <li>
                                        <a href="#" class="active">Previous</a>
                                    </li>
                                    <li>
                                        <a href="#">1</a>
                                    </li>
                                    <li>
                                        <a href="#">2</a>
                                    </li>
                                    <li>
                                        <a href="#">3</a>
                                    </li>
                                    <li>
                                        <a href="#">4</a>
                                    </li>
                                    <li>
                                        <a href="#">5</a>
                                    </li>
                                    <li>
                                        <a href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                            <small>Page 1 of 10</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('modals')
    <div id="new-campaign-schedule-modal" class="modal">
        <div class="modal-background --jb-modal-close"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Add New Campaign Schedule</p>
            </header>
            <section class="modal-card-body">
                <form id="new-contact-form">
                    <div class="field">
                        <label class="label">Select Campaign</label>
                        <div class="control">
                            <div class="select">
                                <select>
                                    <option>Campaign one</option>
                                    <option>Campaign two</option>
                                    <option>Campaign three</option>
                                </select>
                            </div>
                        </div>
                        <p class="help">
                            <b>NB: Only Campaigns in Draft can be selected </b>
                        </p>
                    </div>

                    <div class="field spaced">
                        <label class="label">Set Date/Time</label>
                        <div class="control icons-left">
                            <input class="fl-input" type="text" name="campaign-datetime" id="campaign-datetime"
                                placeholder="___---___" />
                            <span class="icon is-small left"><i class="mdi mdi-account"></i></span>
                        </div>
                    </div>
                </form>
            </section>
            <footer class="modal-card-foot">
                <button class="button">Save</button>
                <button class="button red --jb-modal-close">Cancel</button>
            </footer>
        </div>
    </div>
@endsection

@section('page-script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection