@extends('layouts.admin')

@section('content')
    <section class="section main-section">
        <div class="my-6 flex flex-col items-center sm:flex-row sm:justify-end">
            <form>
                <div class="field">
                <div class="control icons-left">
                    <input class="input" type="text" placeholder="Search Bounced Emails....">
                    <span class="icon left"><i class="mdi mdi-magnify mdi-24px"></i></span>
                </div>
                </div>
            </form>
        </div>
        <div class="card has-table mb-6">
            <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                Bounced Emails
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
            </header>
            <div class="card-content">
            <table>
                <thead>
                <tr>
                    <th></th>
                    <th>Email</th>
                    <th>Campaign ID</th>
                    <th>Created</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="image-cell">
                    <div class="image">
                        <img
                        src="img/avatar.svg"
                        class="rounded-full"
                        />
                    </div>
                    </td>
                    <td data-label="Email">
                        folushoayomide11@gmail.com
                    </td>
                    <td data-label="Campaign ID">10</td>
                    <td data-label="Created">
                    3 weeks ago
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
                        <a href="#" >4</a>
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
        <div class="card empty hidden">
            <div class="card-content">
            <div>
                <span class="icon large text-green-500"><i class="mdi mdi-emoticon-sad mdi-48px"></i></span>
            </div>
            <p>Nothing's here…</p>
            </div>
        </div>
    </section>
@endsection