<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Simple Sidebar - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/profile/profile.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />

    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">

</head>

<body style="font-family: Rubik;">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="" id="sidebar-wrapper" style="background-color: #1c45ef">
            <div class="
                sidebar-heading
                fw-bold
                text-white
                d-flex
                justify-content-center
                fs-2
              ">
                IPOS
            </div>
            <div class="list-group list-group-flush pt-5">
                <a class="
                  list-group-item list-group-item-action list-group-item-light
                  p-3
                " href="#!" style="background-color: #1c45ef; color: white">Dashboard</a
              >
              <a
                class="
                  list-group-item list-group-item-action list-group-item-light
                  p-3
                "
                href="#!"
                style="background-color: #1c45ef; color: white"
                >Shortcuts</a
              >
              <a
                class="
                  list-group-item list-group-item-action list-group-item-light
                  p-3
                "
                href="#!"
                style="background-color: #1c45ef; color: white"
                >Overview</a
              >
              <a
                class="
                  list-group-item list-group-item-action list-group-item-light
                  p-3
                "
                href="#!"
                style="background-color: #1c45ef; color: white"
                >Events</a
              >
              <a
                class="
                  list-group-item list-group-item-action list-group-item-light
                  p-3
                "
                href="#!"
                style="background-color: #1c45ef; color: white"
                >Profile</a
              >
              <a
                class="
                  list-group-item list-group-item-action list-group-item-light
                  p-3
                "
                href="#!"
                style="background-color: #1c45ef; color: white"
                >Status</a
              >
            </div>
          </div>
          <!-- Page content wrapper-->
          <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav
              class="
                navbar navbar-expand-lg navbar-light
                bg-light
                border-bottom
              "
            >
              <div class="container-fluid">
                <button class="btn btn-primary" id="sidebarToggle">
                  Toggle Menu
                </button>
                <button
                  class="navbar-toggler"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent"
                  aria-expanded="false"
                  aria-label="Toggle navigation"
                >
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div
                  class="collapse navbar-collapse"
                  id="navbarSupportedContent"
                >
                  <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                      <a class="nav-link" href="#!">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#!">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a
                      >
                      <div
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="navbarDropdown"
                      >
                        <a class="dropdown-item" href="#!">Action</a>
                    <a class="dropdown-item" href="#!">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#!">Something else here</a
                        >
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
            <!-- Page content-->
           <div class="container">
             <div class="row pt-5">
                      
                    <div class="col"></div>
                    <div class="col">
                      <div class="card border-1">
                      <div class="card-body" style="width: 30rem;">
                        <img
                            id="profileImage"
                            src="{{ asset('assets/images/proile/samanbrembo.jpg') }}"
                            class="rounded-circle mx-auto d-block"
                            alt="Cinque Terre"
                            width="150"
                            height="150"
                          />
                          <input
                          id="imageUpload"
                          type="file"
                          name="profile_photo"
                          placeholder="Photo"
                          required=""
                          capture
                          style="display: none"
                        />

                        <label for="disabledTextInput" class="form-label">Name</label>
      <input type="text" id="disabledTextInput" class="form-control border-bottom" placeholder="Saman Brembo">
    
      <label for="disabledTextInput" class="form-label">Email</label>
      <input type="text" id="disabledTextInput" class="form-control border-bottom" placeholder="saman@gmail.com">
    
      <label for="disabledTextInput" class="form-label">Role</label>
      <input type="text" id="disabledTextInput" class="form-control border-bottom" placeholder="Benteng besi">
    <label for="disabledTextInput" class="form-label">Outlite</label>
      <input type="text" id="disabledTextInput" class="form-control border-bottom" placeholder="CV.brembo">
                         <a href="#" class="btn btn-primary mt-3 mx-auto d-block">Edit</a>
            </div>
        </div>
    </div>
    <div class="col"></div>
    </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{ asset('js/profile/scripts.js') }}"></script>
</body>

</html>