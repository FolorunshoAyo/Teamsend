@extends('layouts.admin')

@section('content')
<section class="section main-section">
    <div class="bg-white rounded-sm p-4 shadow-sm">
      <form
        class="mb-4 flex flex-col gap-2 sm:flex-row sm:gap-0 sm:justify-between sm:items-center"
      >
        <div class="field">
          <div class="control">
            <div class="select">
              <select>
                <option>Campaign One</option>
                <option>Campaign Two</option>
                <option>Campaign Three</option>
              </select>
            </div>
          </div>
        </div>
        <div class="field">
          <div class="control icons-left">
            <input
              class="input"
              type="text"
              placeholder="Search campaign logs ...."
            />
            <span class="icon left"
              ><i class="mdi mdi-magnify mdi-24px"></i
            ></span>
          </div>
        </div>
      </form>
      <div class="card has-table mb-6">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
            Campaign Logs
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
                <th>Log ID</th>
                <th>Campaign Name</th>
                <th>Contact Name</th>
                <th>Contact Email</th>
                <th>Message</th>
                <th>Sent at</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td data-label="Log ID">20</td>
                <td data-label="Campaign Name">Campaign One</td>
                <td data-label="Contact Name">Adebisi Emmanuel</td>
                <td data-label="Contact Name">adebisiemmanuel@gmail.com</td>
                <td data-label="Message">
                  <a
                    href="javascript:void(0)"
                    class="flex items-center font-lg cursor-pointer hover:text-green-600 transition duration-300"
                  >
                    View Sent Mail <i class="ml-2 mdi mdi-open-in-new"></i>
                  </a>
                </td>
                <td data-label="Created">3 days ago</td>
              </tr>
              <tr>
                <td data-label="Log ID">20</td>
                <td data-label="Campaign Name">Campaign One</td>
                <td data-label="Contact Name">Adebisi Emmanuel</td>
                <td data-label="Contact Name">adebisiemmanuel@gmail.com</td>
                <td data-label="Message">
                  <a
                    href="javascript:void(0)"
                    class="flex items-center font-lg cursor-pointer hover:text-green-600 transition duration-300"
                  >
                    View Sent Mail <i class="ml-2 mdi mdi-open-in-new"></i>
                  </a>
                </td>
                <td data-label="Created">3 days ago</td>
              </tr>
              <tr>
                <td data-label="Log ID">20</td>
                <td data-label="Campaign Name">Campaign One</td>
                <td data-label="Contact Name">Adebisi Emmanuel</td>
                <td data-label="Contact Name">adebisiemmanuel@gmail.com</td>
                <td data-label="Message">
                  <a
                    href="javascript:void(0)"
                    class="flex items-center font-lg cursor-pointer hover:text-green-600 transition duration-300"
                  >
                    View Sent Mail <i class="ml-2 mdi mdi-open-in-new"></i>
                  </a>
                </td>
                <td data-label="Created">3 days ago</td>
              </tr>
              <tr>
                <td data-label="Log ID">20</td>
                <td data-label="Campaign Name">Campaign One</td>
                <td data-label="Contact Name">Adebisi Emmanuel</td>
                <td data-label="Contact Name">adebisiemmanuel@gmail.com</td>
                <td data-label="Message">
                  <a
                    href="javascript:void(0)"
                    class="flex items-center font-lg cursor-pointer hover:text-green-600 transition duration-300"
                  >
                    View Sent Mail <i class="ml-2 mdi mdi-open-in-new"></i>
                  </a>
                </td>
                <td data-label="Created">3 days ago</td>
              </tr>
              <tr>
                <td data-label="Log ID">20</td>
                <td data-label="Campaign Name">Campaign One</td>
                <td data-label="Contact Name">Adebisi Emmanuel</td>
                <td data-label="Contact Name">adebisiemmanuel@gmail.com</td>
                <td data-label="Message">
                  <a
                    href="javascript:void(0)"
                    class="flex items-center font-lg cursor-pointer hover:text-green-600 transition duration-300"
                  >
                    View Sent Mail <i class="ml-2 mdi mdi-open-in-new"></i>
                  </a>
                </td>
                <td data-label="Created">3 days ago</td>
              </tr>
            </tbody>
          </table>
          <div class="table-pagination">
            <div class="flex items-center justify-between">
              <nav class="pagination my-6">
                <ul>
                  <li>
                    <a href="#">Previous</a>
                  </li>
                  <li>
                    <a href="#" class="active">1</a>
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