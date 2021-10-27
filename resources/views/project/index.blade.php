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
              <h1 class="p-4 fw-bold">Project Collaborator</h1>
              <div class="container row pt-2">
                <div class="col d-flex justify-content-center">
                  <button
                    type="button"
                    class="btn"
                    data-toggle="modal"
                    data-target="#exampleModalCenter"
                  >
                    <img
                      src="{{ asset('assets/image/project/samanbrembo.jpg') }}"
                      class="rounded-circle"
                      alt="Cinque Terre"
                      width="150"
                      height="150"
                    />
                  </button>
                </div>
                <div class="col d-flex justify-content-center">
                  <button class="btn">
                    <img
                      src="{{ asset('assets/images/project/samanbrembo.jpg') }}"
                      class="rounded-circle"
                      alt="Cinque Terre"
                      width="150"
                      height="150"
                    />
                  </button>
                </div>
                <div class="col d-flex justify-content-center">
                  <button class="btn">
                    <img
                      src="{{ asset('assets/images/project/samanbrembo.jpg') }}"
                      class="rounded-circle"
                      alt="Cinque Terre"
                      width="150"
                      height="150"
                    />
                  </button>
                </div>
                <div class="col d-flex justify-content-center">
                  <button class="btn">
                    <img
                      src="{{ asset('assets/images/project/samanbrembo.jpg') }}"
                      class="rounded-circle"
                      alt="Cinque Terre"
                      width="150"
                      height="150"
                    />
                  </button>
                </div>
              </div>
            </div>

            <div
              class="modal fade"
              id="exampleModalCenter"
              tabindex="-1"
              role="dialog"
              aria-labelledby="exampleModalCenterTitle"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                      Profile
                    </h5>
                    <button
                      type="button"
                      class="close"
                      data-dismiss="modal"
                      aria-label="Close"
                    >
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body container justify-content-center">
                    <div class="row p-4">
                      <div class="col"></div>
                      <div class="col">
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                        <div id="profile-container">
                          <img
                            id="profileImage"
                            src="{{ asset('assets/images/project/samanbrembo.jpg') }}"
                            class="rounded-circle"
                            alt="Cinque Terre"
                            width="150"
                            height="150"
                          />
                        </div>
                        <input
                          id="imageUpload"
                          type="file"
                          name="profile_photo"
                          placeholder="Photo"
                          required=""
                          capture
                          style="display: none"
                        />
                      </div>
                      <div class="col"></div>
                    </div>

                    <input
                      class="form-control text-center border-0 bg-white"
                      id="disabledInput"
                      type="text"
                      placeholder="Nama: Saman Brembo"
                      disabled
                    />
                    <input
                      class="form-control text-center border-0 bg-white"
                      id="disabledInput"
                      type="text"
                      placeholder="Email: saman@gmail.com"
                      disabled
                    />
                    <input
                      class="form-control text-center border-0 bg-white"
                      id="disabledInput"
                      type="text"
                      placeholder="Role: Benteng Besi"
                      disabled
                    />
                    <input
                      class="form-control text-center border-0 bg-white"
                      id="disabledInput"
                      type="text"
                      placeholder="Outlite: CV. Brembo"
                      disabled
                    />
                  </div>
                  <div class="modal-footer d-flex justify-content-center">
                    <button
                      type="button"
                      class="btn btn-secondary"
                      data-dismiss="modal"
                    >
                      Close
                    </button>
                    <button type="button" class="btn btn-primary">
                      Save changes
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Bootstrap core JS
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script> -->
        <!-- Core theme JS-->
        <!-- <script src="../../js/bootstrap.bundle.js"></script> -->

        <script
          src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
          integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
          crossorigin="anonymous"
        ></script>
        <script
          src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
          integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
          crossorigin="anonymous"
        ></script>
        <script
          src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
          integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
          crossorigin="anonymous"
        ></script>
        <script src="{{ asset('js/project/scripts.js') }}"></script>
      </body>
    </html>
  </body>
</html>