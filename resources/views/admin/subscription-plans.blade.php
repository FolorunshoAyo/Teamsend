@extends('layouts.admin')

@section('content')
<section class="main-section section">
    <div class="p-4 rounded-sm bg-white shadow-sm">
      <div id="tab-plans">
        <div class="tabs-section">
          <ul class="tab-list">
            <li class="mr-2">
              <a href="#" class="tab active" data-tab-target="1">Free</a>
            </li>
            <li class="mr-2">
              <a href="#" class="tab" data-tab-target="2">Monthly</a>
            </li>
            <li class="mr-2">
              <a href="#" class="tab" data-tab-target="3">Yearly</a>
            </li>
          </ul>
        </div>
        <div class="tab-content">
          <div data-tab-content class="active">
            <div class="flex wrap gap-2">
              <div
                class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow"
              >
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                  Free
                </h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                  Lorem Ipsum is simply a dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry
                </p>
                <div class="flex align-items-center my-3">
                  <h4 class="text-2xl">₦0.00</h4>
                  <p class="mt-2 ml-2">/Month</p>
                </div>
                <ul class="list-unstyled">
                  <li class="flex items-center mb-3">
                    <i class="mdi mdi-check text-green-600 mr-2"></i>
                    <span>500 Emails</span>
                  </li>
                  <li class="flex align-items-center mb-3">
                    <i class="mdi mdi-check text-green-600 mr-2"></i>
                    <span>5 Emails</span>
                  </li>
                </ul>
                <div>
                  <a href="#" class="button w-full"> Select Plan </a>
                </div>
              </div>
            </div>
          </div>
          <div data-tab-content>
            <div class="flex wrap gap-2">
              <div
                class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow"
              >
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                  Monthly
                </h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                  Lorem Ipsum is simply a dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry
                </p>
                <div class="flex align-items-center my-3">
                  <h4 class="text-2xl">₦20,000.00</h4>
                  <p class="mt-2 ml-2">/Month</p>
                </div>
                <ul class="list-unstyled">
                  <li class="flex items-center mb-3">
                    <i class="mdi mdi-check text-green-600 mr-2"></i>
                    <span>2,000 Emails</span>
                  </li>
                  <li class="flex align-items-center mb-3">
                    <i class="mdi mdi-check text-green-600 mr-2"></i>
                    <span>20 Agents</span>
                  </li>
                </ul>
                <div>
                  <a href="#" class="button w-full"> Select Plan </a>
                </div>
              </div>
              <div
                class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow"
              >
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                  Monthly
                </h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                  Lorem Ipsum is simply a dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry
                </p>
                <div class="flex align-items-center my-3">
                  <h4 class="text-2xl">₦50,000.00</h4>
                  <p class="mt-2 ml-2">/Month</p>
                </div>
                <ul class="list-unstyled">
                  <li class="flex items-center mb-3">
                    <i class="mdi mdi-check text-green-600 mr-2"></i>
                    <span>5,000 Emails</span>
                  </li>
                  <li class="flex align-items-center mb-3">
                    <i class="mdi mdi-check text-green-600 mr-2"></i>
                    <span>40 Agents</span>
                  </li>
                </ul>
                <div>
                  <a href="#" class="button w-full"> Select Plan </a>
                </div>
              </div>
            </div>
          </div>
          <div data-tab-content>
            <div class="flex wrap gap-2">
              <div
                class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow"
              >
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                  Yearly
                </h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                  Lorem Ipsum is simply a dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry
                </p>
                <div class="flex align-items-center my-3">
                  <h4 class="text-2xl">₦100,000.00</h4>
                  <p class="mt-2 ml-2">/Year</p>
                </div>
                <ul class="list-unstyled">
                  <li class="flex items-center mb-3">
                    <i class="mdi mdi-check text-green-600 mr-2"></i>
                    <span>10,000 Emails</span>
                  </li>
                  <li class="flex align-items-center mb-3">
                    <i class="mdi mdi-check text-green-600 mr-2"></i>
                    <span>60 Agents</span>
                  </li>
                </ul>
                <div>
                  <a href="#" class="button w-full"> Select Plan </a>
                </div>
              </div>
              <div
                class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow"
              >
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                  Yearly
                </h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                  Lorem Ipsum is simply a dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry
                </p>
                <div class="flex align-items-center my-3">
                  <h4 class="text-2xl">₦160,000.00</h4>
                  <p class="mt-2 ml-2">/Year</p>
                </div>
                <ul class="list-unstyled">
                  <li class="flex items-center mb-3">
                    <i class="mdi mdi-check text-green-600 mr-2"></i>
                    <span>15,000 Emails</span>
                  </li>
                  <li class="flex align-items-center mb-3">
                    <i class="mdi mdi-check text-green-600 mr-2"></i>
                    <span>80 Agents</span>
                  </li>
                </ul>
                <div>
                  <button disabled href="#" class="button w-full">
                    <i class="mdi mdi-pencil"></i> Active, Ex. 24 Jan, 2024.
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection