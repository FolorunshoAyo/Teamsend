@extends('layouts.admin')

@section('content')
<section class="section main-section">
    <div class="bg-white rounded-sm p-4 shadow-sm">
      <form class="mb-4">
        <div class="field">
          <div class="control icons-left">
            <input class="input" type="text" placeholder="Search contacts ...." />
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
            All Mails Logs
          </p>
          <a href="#" class="card-header-icon">
            <span class="icon"><i class="mdi mdi-reload"></i></span>
          </a>
        </header>
        <div class="card-content">
          <table>
            <thead>
              <tr>
                <th>Log ID</th>
                <th>Contact Name</th>
                <th>Contact Email</th>
                <th>Message</th>
                <th>Sent at</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td data-label="Log ID">20</td>
                <td data-label="Contact Name">Adebisi Emmanuel</td>
                <td data-label="Contact Email">adebisiemmanuel@gmail.com</td>
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