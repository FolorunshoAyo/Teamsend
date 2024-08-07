<aside class="aside is-placed-left is-expanded">
    <div class="aside-tools">
      <div>
        Team<b class="font-bold">Send</b>
      </div>
    </div>
    <div class="menu is-menu-main">
      <p class="menu-label">General</p>
      <ul class="menu-list">
        <li class="{{Route::is('org-admin.dashboard')? "active" : ""}}">
          <a href="{{ route('org-admin.dashboard', ['organisation' => "$reformatted_org_name"]) }}">
            <span class="icon"><i class="mdi mdi-home-outline"></i></span>
            <span class="menu-item-label">Dashboard</span>
          </a>
        </li>
      </ul>
      <p class="menu-label">Agents</p>
      <ul class="menu-list">
        <li class="{{Route::is('org-admin.agents')? "active" : ""}}">
          <a href="{{ route('org-admin.agents', ['organisation' => "$reformatted_org_name"]) }}">
            <span class="icon"><i class="mdi mdi-account-group-outline"></i></span>
            <span class="menu-item-label">Agents</span>
          </a>
        </li>
      </ul>
      <p class="menu-label">Contacts</p>
      <ul class="menu-list">
        <li class="{{Route::is('org-admin.contacts') || Route::is('org-admin.bulk-import-export')? "active" : ""}}">
          <a class="dropdown">
            <span class="icon"><i class="mdi mdi-contactless-payment"></i></span>
            <span class="menu-item-label">Contacts</span>
            <span class="icon"><i class="mdi {{Route::is('org-admin.contacts') || Route::is('org-admin.bulk-import-export')? "mdi-minus" : "mdi-plus"}}"></i></span>
          </a>
          <ul>
            <li class="{{Route::is('org-admin.contacts-overview')? "active" : ""}}">
              <a href="{{ route('org-admin.contacts-overview', ['organisation' => "$reformatted_org_name"]) }}">
                <span class="icon"><i class="mdi mdi mdi-chart-line"></i></span>
                <span>Overview</span>
              </a>
            </li>
            <li class="{{Route::is('org-admin.contacts')? "active" : ""}}">
              <a href="{{ route('org-admin.contacts', ['organisation' => "$reformatted_org_name"]) }}">
                <span class="icon"><i class="mdi mdi mdi-format-align-left"></i></span>
                <span>All Contacts</span>
              </a>
            </li>
            <li class="{{Route::is('org-admin.bulk-import-export')? "active" : ""}}">
              <a href="{{ route('org-admin.bulk-import-export', ['organisation' => "$reformatted_org_name"]) }}">
                <span class="icon"><i class="mdi mdi mdi-format-align-left"></i></span>
                <span>Bulk Import/Export</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
      <p class="menu-label">Groups</p>
      <ul class="menu-list">
        <li class="{{Route::is('org-admin.groups') || Route::is('org-admin.new-group')? "active" : ""}}">
          <a class="dropdown">
            <span class="icon"><i class="mdi mdi-account-group"></i></span>
            <span class="menu-item-label">Groups</span>
            <span class="icon"><i class="mdi {{Route::is('org-admin.groups') || Route::is('org-admin.new-group')? "mdi-minus" : "mdi-plus"}}"></i></span>
          </a>
          <ul>
            <li class="{{Route::is('org-admin.groups')? "active" : ""}}">
              <a href="{{ route('org-admin.groups', ['organisation' => "$reformatted_org_name"]) }}">
                <span class="icon"><i class="mdi mdi mdi-format-align-left"></i></span>
                <span>All Groups</span>
              </a>
            </li>
            <li class="{{Route::is('org-admin.new-group')? "active" : ""}}">
              <a href="{{ route('org-admin.new-group', ['organisation' => "$reformatted_org_name"]) }}">
                <span class="icon"><i class="mdi mdi mdi-format-align-left"></i></span>
                <span>Add New</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
      <p class="menu-label">Subscription plans</p>
      <ul class="menu-list">
        <li class="{{Route::is('org-admin.plans')? "active" : ""}}">
          <a href="{{ route('org-admin.plans', ['organisation' => "$reformatted_org_name"]) }}">
            <span class="icon"><i class="mdi mdi-account-group-outline"></i></span>
            <span class="menu-item-label">Subscription Plans</span>
          </a>
        </li>
      </ul>
      <p class="menu-label">Email Builder</p>
      <ul class="menu-list">
        <li class="{{Route::is('org-admin.email-templates') || Route::is('org-admin.new-email-template')? "active" : ""}}">
          <a class="dropdown">
            <span class="icon"><i class="mdi mdi-xml"></i></span>
            <span class="menu-item-label">Email Builder</span>
            <span class="icon"><i class="mdi {{Route::is('org-admin.email-templates') || Route::is('org-admin.new-email-template')? "mdi-minus" : "mdi-plus"}}"></i></span>
          </a>
          <ul>
            <li class="{{ Route::is('org-admin.email-templates')? "active" : "" }}">
                <a href="{{ route('org-admin.email-templates', ['organisation' => "$reformatted_org_name"]) }}">
                  <span class="icon"><i class="mdi mdi mdi-format-align-left"></i></span>
                  <span>All Email Templates</span>
                </a>
            </li>
            <li class="{{ Route::is('org-admin.new-email-template')? "active" : "" }}">
              <a href="{{ route('org-admin.new-email-template', ['organisation' => "$reformatted_org_name"]) }}">
                <span class="icon"><i class="mdi mdi mdi-format-align-left"></i></span>
                <span>Create Email Template</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
      <p class="menu-label">Campaigns</p>
      <ul class="menu-list">
        <li class="{{Route::is('org-admin.email-campaigns') || Route::is('org-admin.new-email-campaign') || Route::is('org-admin.campaign-schedules') || Route::is('org-admin.campaign-tracker') || Route::is('org-admin.mail-logs') || Route::is('org-admin.campaign-logs')? "active" : ""}}">
          <a class="dropdown">
            <span class="icon"><i class="mdi mdi-xml"></i></span>
            <span class="menu-item-label">Campaigns</span>
            <span class="icon"><i class="mdi {{Route::is('org-admin.email-campaigns') || Route::is('org-admin.new-email-campaign') || Route::is('org-admin.campaign-schedules') || Route::is('org-admin.campaign-tracker') || Route::is('org-admin.mail-logs') || Route::is('org-admin.campaign-logs')? "mdi-minus" : "mdi-plus"}}"></i></span>
          </a>
          <ul>
            <li class="{{ Route::is('org-admin.email-campaigns')? "active" : "" }}">
              <a href="{{ route('org-admin.email-campaigns', ['organisation' => "$reformatted_org_name"]) }}">
                <span class="icon"><i class="mdi mdi mdi-format-align-left"></i></span>
                <span>All Campaigns</span>
              </a>
            </li>
            <li class="{{ Route::is('org-admin.new-email-campaign')? "active" : "" }}">
              <a href="{{ route('org-admin.new-email-campaign', ['organisation' => "$reformatted_org_name"]) }}">
                <span class="icon"><i class="mdi mdi mdi-format-align-left"></i></span>
                <span>Add New</span>
              </a>
            </li>
            <li class="{{ Route::is('org-admin.campaign-schedules')? "active" : "" }}">
              <a href="{{ route('org-admin.campaign-schedules', ['organisation' => "$reformatted_org_name"]) }}">
                <span class="icon"><i class="mdi mdi mdi-format-align-left"></i></span>
                <span>Schedules</span>
              </a>
            </li>
            <li class="{{ Route::is('org-admin.campaign-tracker')? "active" : "" }}">
              <a href="{{ route('org-admin.campaign-tracker', ['organisation' => "$reformatted_org_name"]) }}">
                <span class="icon"><i class="mdi mdi mdi-format-align-left"></i></span>
                <span>Tracker</span>
              </a>
            </li>
            <li class="{{ Route::is('org-admin.mail-logs')? "active" : "" }}">
              <a href="{{ route('org-admin.mail-logs', ['organisation' => "$reformatted_org_name"]) }}">
                <span class="icon"><i class="mdi mdi mdi-format-align-left"></i></span>
                <span>Mail Logs</span>
              </a>
            </li>
            <li class="{{ Route::is('org-admin.campaign-logs')? "active" : "" }}">
              <a href="{{ route('org-admin.campaign-logs', ['organisation' => "$reformatted_org_name"]) }}">
                <span class="icon"><i class="mdi mdi mdi-format-align-left"></i></span>
                <span>Campaign Logs</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
      <p class="menu-label">Emails</p>
      <ul class="menu-list">
        <li class="{{Route::is('org-admin.check-bounce') || Route::is('org-admin.bounced-emails')? "active" : ""}}">
          <a class="dropdown">
            <span class="icon"><i class="mdi mdi-email-multiple"></i></span>
            <span class="menu-item-label">Emails</span>
            <span class="icon"><i class="mdi {{Route::is('org-admin.check-bounce') || Route::is('org-admin.bounced-emails')? "mdi-minus" : "mdi-plus"}}"></i></span>
          </a>
          <ul>
            <li class="{{ Route::is('org-admin.check-bounce')? "active" : "" }}">
              <a href="{{ route('org-admin.check-bounce', ['organisation' => "$reformatted_org_name"]) }}">
                <span class="icon"><i class="mdi mdi mdi-format-align-left"></i></span>
                <span>Check Bounce</span>
              </a>
            </li>
            <li class="{{ Route::is('org-admin.bounced-emails')? "active" : "" }}">
              <a href="{{ route('org-admin.bounced-emails', ['organisation' => "$reformatted_org_name"]) }}">
                <span class="icon"><i class="mdi mdi mdi-format-align-left"></i></span>
                <span>Bounced Emails</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </aside>