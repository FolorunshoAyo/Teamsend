@extends('layouts.admin')

@section('content')
    <section class="section main-section">
        <div class="grid gap-6 grid-cols-1 md:grid-cols-3 mb-6">
            <a href="#"
                class="card text-no-underline text-inherit hover:text-white hover:bg-green-500 transition duration-200 ease-in">
                <div class="card-content">
                    <div class="flex flex-col text-center justify-center">
                        <p class="text-2xl font-bold">103</p>
                        <p>Total contacts</p>
                        <p>Subscribed to 85 mail lists</p>
                    </div>
                </div>
            </a>

            <div
                class="card text-no-underline text-inherit hover:text-white hover:bg-green-500 transition duration-200 ease-in">
                <div class="card-content">
                    <div class="flex flex-col text-center justify-center">
                        <p class="text-2xl font-bold">100%</p>
                        <p>Active contacts ready to recieve marketing emails</p>
                    </div>
                </div>
            </div>

            <a href="#"
                class="card text-no-underline text-inherit hover:text-white hover:bg-green-500 transition duration-200 ease-in">
                <div class="card-content">
                    <div class="flex flex-col text-center justify-center">
                        <p class="text-2xl font-bold">18</p>
                        <p>Contacts are blacklisted</p>
                        <p>click to view</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Audience Statistics -->
        <div class="card mb-6">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-chart-timeline-variant-shimmer"></i></span>
                    Your Audience Growth
                </p>
                <a href="#" class="card-header-icon">
                    <span class="icon"><i class="mdi mdi-reload"></i></span>
                </a>
            </header>

            <div class="card-content">
                <div class="chart-area mb-4">
                    <div class="h-full">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div></div>
                            </div>
                        </div>
                        <canvas id="big-line-chart" width="2992" height="1000" class="chartjs-render-monitor block"
                            style="height: 400px; width: 1197px"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-sm p-4">
            <h2 class="text-xl font-bold flex border-b-2 pb-2 border-slate-300">
                <i class="mdi mdi-open-in-new mdi-24px mr-2"></i>
                <span>Quick Action</span>
            </h2>
            <div class="mt-4 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-lg">Import Contacts</h3>
                    <p class="text-gray-400 text-sm">Capture contacts and collect the data you need to grow your audience
                    </p>
                </div>
                <a href="#" class="button">Import Conatcts</a>
            </div>
        </div>
    </section>
@endsection

@section('page-script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.44.0/apexcharts.min.js"></script>
    <script type="text/javascript" src="{{asset('js/chart.sample.js')}}"></script>
@endsection
