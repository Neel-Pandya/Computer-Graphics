<nav class="navbar col-lg-12 col-12 p-0 d-flex flex-row">
  <div class=" navbar-brand-wrapper  d-flex justify-content-center align-items-center">

  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

    <ul class="navbar-nav mr-lg-2">
      <li class="nav-item nav-search d-none d-lg-block">
        <div class="input-group">
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">

      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle admin-image" href="{{ route('admin.dashboard') }}" data-toggle="dropdown"
          id="profileDropdown">
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="{{ route('admin.edit') }}">
            <i class="ti-user text-primary"></i>
            Edit profile
          </a>
          <a class="dropdown-item" href="{{ route('admin.change.password') }}">
            <i class="ti-power-off text-primary"></i>
            Change Password
          </a>
          <a class="dropdown-item" href="{{ route('admin.logout') }}">
            <i class="ti-power-off text-primary"></i>
            Logout
          </a>
        </div>
      </li>

    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
      data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>

<script src="{{ asset('js/jquery.js') }}"></script>
<script>
  $(document).ready(function () {
      const loadAdminProfile = () => {
        $.ajax({
          type: "GET",
          url: "{{ URL::to('/') }}/admin/getProfile",
          success: function ({status , profile} = response) {
            $(".admin-image").html('')
              if(status == 'success'){
                $('.admin-image').append(`
                    <img src="{{ URL::to('/') }}/images/admin/${profile[0].admin_profile}" alt="profile" />
                `)
              }
          }
        });
      }

      loadAdminProfile()
  });
</script>