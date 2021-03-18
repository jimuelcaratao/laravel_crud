<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Students</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

         <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Navbar</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                  </li>
                </ul>
              </div>
            </div>
        </nav>


        <div class="container">
            <div class="row py-5">
              <div class="col">
                <h3>Students</h3>
              </div>
              <div class="col float-right">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    ADD
                  </button>
              </div>
            </div>
            
            <div class="row">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Section</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                     @forelse ($students as $student)
                      <tr>
                        <th scope="row">{{ $student->student_id }}</th>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->section }}</td>
                        <td col="2">
                          <!-- update modal triggerer -->
                         
                   
                           {{-- edit icon --}}
                           <a
                           class="float-left"
                           data-bs-toggle="modal" 
                           data-bs-target="#edit-modal"
                           data-tooltip="tooltip"
                           data-placement="top"
                           title="Edit"
                           data-community="{{ json_encode($student) }}"
                           data-item-student_id="{{ $student->student_id }}"
                           id="edit-item"
                           ><button type="button" class="btn btn-primary">
                            Edit
                          </button></a>
                            
                         

                          {{-- delete method in laravel putaingina nyo --}}
                          <form method="POST" action="{{ route('students.destroy', [$student->student_id]) }}">
                            @method('DELETE')
                            @csrf

                            <button type="submit" class="btn btn-danger">
                              Delete
                            </button>
                          </form>
                        
                        </td>
                      </tr>
                     @empty
                         <p>walang laman</p>
                     @endforelse
                   
                      
                    </tbody>
                  </table>
            </div>
        </div>



<!-- Update Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
           {{-- Form --}}
           <form method="POST" action="students">
            @csrf

                {{-- ID --}}
                <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">First name</label>
                <input type="text" class="form-control" id="editID" name="editID" >
              </div>
            
            {{-- FIRSTNAME --}}
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">First name</label>
              <input type="text" class="form-control" id="editFirstName" name="editFirstName" placeholder="Type ur firstname">
            </div>
            {{-- LAST --}}
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Last</label>
              <input type="text" class="form-control" id="editLastName" name="editLastName" placeholder="Type ur last">
            </div>
            {{-- SECTION --}}
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Section</label>
              <input type="text" class="form-control" id="editSection" name="editSection" placeholder="Type ur section">
            </div>
            
            {{-- modal footer --}}
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
      </div>
     
    </div>
  </div>
</div>



    <!-- Add modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add modal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            
            {{-- Form --}}
            <form method="POST" action="{{ route('students.store') }}">
              @csrf
              
              {{-- FIRSTNAME --}}
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">First name</label>
                <input type="text" class="form-control" id="inputFirstName" name="inputFirstName" placeholder="Type ur firstname">
              </div>
              {{-- LAST --}}
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Last</label>
                <input type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="Type ur last">
              </div>
              {{-- SECTION --}}
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Section</label>
                <input type="text" class="form-control" id="inputSection" name="inputSection" placeholder="Type ur section">
              </div>
              
              {{-- modal footer --}}
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>


          </div>
        </div>
      </div>
    </div>

    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
         <script>
         $(document).ready(function() {
            $(document).on("click", "#edit-item", function() {
                $(this).addClass("edit-item-trigger-clicked"); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
                var options = {
                    backdrop: "static"
                };
                $("#edit-modal").modal(options);
                var el = $(".edit-item-trigger-clicked"); // See how its usefull right here?
                var row = el.closest(".data-row");
                // get the data
                var student_id = el.data("item-student_id");
                var product_name = el.data("item-product_name");
                var description = el.data("item-description");
 
                // var description = row.children("item-email").text();
                // fill the data in the input fields
                $("#editID").val(student_id);
                $("#editProductName").val(product_name);
                $("#editDescription").val(description);

           
            });
            // on modal hide
            $("#edit-modal").on("hide.bs.modal", function() {
                $(".edit-item-trigger-clicked").removeClass(
                    "edit-item-trigger-clicked"
                );
                $("#edit-form").trigger("reset");
            });
        });
      </script>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
 
    </body>
</html>
