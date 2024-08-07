@extends('layouts.admin')

@section('content')
<section class="main-section section">
    <div class="shadow-sm bg-white p-4 rounded-sm">
      <div class="card my-6">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-chart-timeline"></i></span>
            Campaign Report
          </p>
          <a href="#" class="card-header-icon">
            <span class="icon"><i class="mdi mdi-reload"></i></span>
          </a>
        </header>
  
        <div class="card-content">
          <div class="chart-area mb-4">
            <div class="h-full">
              <div id="campaign-report-stats"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="card has-table mb-6">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
            Sent Campaigns
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
                <th>ID</th>
                <th>Campaign</th>
                <th>Emails (Count)</th>
                <th>Sent</th>
                <th>Clicks</th>
                <th>Unique Clicks</th>
                <th>Open Rate</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td data-label="ID">1</td>
                <td data-label="Campaign">Capaign Name</td>
                <td data-label="Emails (Count)">100</td>
                <td data-label="Sent">80</td>
                <td data-label="Clicks">900</td>
                <td data-label="Unique Clicks">10</td>
                <td data-label="Open Rate">3 days ago</td>
                <td class="actions-cell">
                  <div class="buttons right nowrap">
                    <a class="button green" href="javascript:void(0)">
                      <span class="icon"
                        ><i class="mdi mdi-eye mdi-24px"></i
                      ></span>
                    </a>
                    <!-- <a
                            class="button yellow"
                            href="javscript:void(0)"
                            >
                                <span class="icon"><i class="mdi mdi-square-edit-outline mdi-24px"></i></span>
                            </a>
                            <a
                              class="button red"
                              href="javscript:void(0)"
                            >
                              <span class="icon"><i class="mdi mdi-trash-can mdi-24px"></i></span>
                            </a> -->
                  </div>
                </td>
              </tr>
              <tr>
                <td data-label="ID">2</td>
                <td data-label="Campaign">Capaign Name</td>
                <td data-label="Emails (Count)">100</td>
                <td data-label="Sent">80</td>
                <td data-label="Clicks">900</td>
                <td data-label="Unique Clicks">10</td>
                <td data-label="Open Rate">3 days ago</td>
                <td class="actions-cell">
                  <div class="buttons right nowrap">
                    <a class="button green" href="javascript:void(0)">
                      <span class="icon"
                        ><i class="mdi mdi-eye mdi-24px"></i
                      ></span>
                    </a>
                    <!-- <a
                            class="button yellow"
                            href="javscript:void(0)"
                            >
                                <span class="icon"><i class="mdi mdi-square-edit-outline mdi-24px"></i></span>
                            </a>
                            <a
                              class="button red"
                              href="javscript:void(0)"
                            >
                              <span class="icon"><i class="mdi mdi-trash-can mdi-24px"></i></span>
                            </a> -->
                  </div>
                </td>
              </tr>
              <tr>
                <td data-label="ID">3</td>
                <td data-label="Campaign">Capaign Name</td>
                <td data-label="Emails (Count)">100</td>
                <td data-label="Sent">80</td>
                <td data-label="Clicks">900</td>
                <td data-label="Unique Clicks">10</td>
                <td data-label="Open Rate">3 days ago</td>
                <td class="actions-cell">
                  <div class="buttons right nowrap">
                    <a class="button green" href="javascript:void(0)">
                      <span class="icon"
                        ><i class="mdi mdi-eye mdi-24px"></i
                      ></span>
                    </a>
                    <!-- <a
                            class="button yellow"
                            href="javscript:void(0)"
                            >
                                <span class="icon"><i class="mdi mdi-square-edit-outline mdi-24px"></i></span>
                            </a>
                            <a
                              class="button red"
                              href="javscript:void(0)"
                            >
                              <span class="icon"><i class="mdi mdi-trash-can mdi-24px"></i></span>
                            </a> -->
                  </div>
                </td>
              </tr>
              <tr>
                <td data-label="ID">4</td>
                <td data-label="Campaign">Capaign Name</td>
                <td data-label="Emails (Count)">100</td>
                <td data-label="Sent">80</td>
                <td data-label="Clicks">900</td>
                <td data-label="Unique Clicks">10</td>
                <td data-label="Open Rate">3 days ago</td>
                <td class="actions-cell">
                  <div class="buttons right nowrap">
                    <a class="button green" href="javascript:void(0)">
                      <span class="icon"
                        ><i class="mdi mdi-eye mdi-24px"></i
                      ></span>
                    </a>
                    <!-- <a
                            class="button yellow"
                            href="javscript:void(0)"
                            >
                                <span class="icon"><i class="mdi mdi-square-edit-outline mdi-24px"></i></span>
                            </a>
                            <a
                              class="button red"
                              href="javscript:void(0)"
                            >
                              <span class="icon"><i class="mdi mdi-trash-can mdi-24px"></i></span>
                            </a> -->
                  </div>
                </td>
              </tr>
              <tr>
                <td data-label="ID">5</td>
                <td data-label="Campaign">Capaign Name</td>
                <td data-label="Emails (Count)">100</td>
                <td data-label="Sent">80</td>
                <td data-label="Clicks">900</td>
                <td data-label="Unique Clicks">10</td>
                <td data-label="Open Rate">3 days ago</td>
                <td class="actions-cell">
                  <div class="buttons right nowrap">
                    <a class="button green" href="javascript:void(0)">
                      <span class="icon"
                        ><i class="mdi mdi-eye mdi-24px"></i
                      ></span>
                    </a>
                    <!-- <a
                            class="button yellow"
                            href="javscript:void(0)"
                            >
                                <span class="icon"><i class="mdi mdi-square-edit-outline mdi-24px"></i></span>
                            </a>
                            <a
                              class="button red"
                              href="javscript:void(0)"
                            >
                              <span class="icon"><i class="mdi mdi-trash-can mdi-24px"></i></span>
                            </a> -->
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