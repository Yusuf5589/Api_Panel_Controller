<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ Session::get('token') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>Home</title>
</head>
<body style="width: 100%; height: 100vh; padding: 0px; margin: 0px;">
    <header class="container-fluid bg-dark p-1 mb-4 d-flex justify-content-center">
        <form action=" {{ route('homepost') }} " method="post">
            @csrf
            <button class="fa-solid fa-right-from-bracket text-white bg-danger p-3 rounded-circle"></button>
        </form>

        <form action=" {{ route('refresh') }} " method="post">
          @csrf
          <button class="fa-solid fa-arrow-rotate-left text-white bg-danger p-3 rounded-circle mx-2"></button>
      </form>
    </header>

    <div class="w-100 my-3 d-flex justify-content-center">
      <button class="btn btn-success" id="create" data-bs-toggle="modal" data-bs-target="#createmodal">Add Product</button>
    </div>


    @if (Session::has("deletesucces"))
    <div class="w-100 d-flex justify-content-center" id="deletesucces">
      <div class="alert alert-danger text-center">{{ Session::get("deletesucces") }}</div>
    </div>
    @endif

    

    @if (Session::has("updatesucces"))
    <div class="w-100 d-flex justify-content-center" id="updatesucces">
      <div class="alert alert-success text-center">{{ Session::get("updatesucces") }}</div>
    </div>
    @endif
    
    @if (Session::has("loginsucces"))
    <div class="w-100 d-flex justify-content-center" id="loginsucces">
      <div  class="alert alert-success text-center">{{ Session::get("loginsucces") }}</div>
    </div>
    @endif


    @if (Session::has("addsucces"))
    <div class="w-100 d-flex justify-content-center" id="addsucces">
      <div  class="alert alert-success text-center">{{ Session::get("addsucces") }}</div>
    </div>
    @endif


    <div class="table-responsive">
    <table class="table container">
        <thead>
          <tr>
            <th class="text-center" scope="col">Id</th>
            <th class="text-center" scope="col">Name</th>
            <th class="text-center" scope="col">Description</th>
            <th class="text-center" scope="col">Piece</th>
            <th class="text-center" scope="col">Price</th>
            <th class="text-center" scope="col">Control</th>
          </tr>
        </thead>
        <tbody id="viewinglist">
          @foreach (Session::get('getapiall') as $item)
          <form action="{{ route('deletepost') }}" method="post" onsubmit="deletefunction(event);">
            @csrf
          <tr>
            <td class="text-center">
              <input id="id" type="hidden" name="id" value="{{ $item['id'] }}">
              {{ $item['id'] }}
            </td>
            <td id="name" class="text-center">{{ $item['name'] }}</td>
            <td id="description" class="text-center">{{ $item['description'] }}</td>
            <td id="piece" class="text-center">{{ $item['piece'] }}</td>
            <td id="price" class="text-center">{{ $item['price'] }}</td>
            <td class="text-center">
            <button class="fas fa-trash-alt delete-btn" data-bs-toggle="modal" data-bs-target="#deletemodal" ></button></form>
              <button class="fa-solid fa-eye delete-btn" id="viewing"></button>
              <button type="button" class="fa-solid fa-pen-to-square delete-btn" id="edit" data-bs-toggle="modal" data-bs-target="#editmodal" onsubmit="createeditform(event);"></button>
            </td>
          </tr>
        @endforeach
        

        </tbody>
      </table>
    </div>

      
      <form id="editForm" action="{{ route('edit') }}" method="post" onsubmit="update(event);">
        @csrf
        <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title" id="editmodalLabel">Update</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat" onclick="close2();"></button>
              </div>
              <div class="modal-body">
                <div class="container-fluid">
                  <div class="row mb-3">
                    <label for="inputid" class="col-4 col-form-label">Id</label>
                    <div class="col-8">
                      <input id="inputid" name="id" type="text" class="form-control" value="" readonly>
                      <div class="small text-danger"></div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputname" class="col-4 col-form-label">Name</label>
                    <div class="col-8">
                      <input id="inputname" name="name" type="text" class="form-control" value="">
                      <div id="inputnameerror" class="small text-danger"  style="font-size: 11px; color: red;">
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputdescription" class="col-4 col-form-label">Description</label>
                    <div class="col-8">
                      <input id="inputdescription" name="description" type="text" class="form-control" value="">
                      <div id="inputdescriptionerror" class="small text-danger"  style="font-size: 11px; color: red;">
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputpiece" class="col-4 col-form-label">Piece</label>
                    <div class="col-8">
                      <input id="inputpiece" name="piece" type="number" class="form-control" value="" min="0">
                      <div id="inputpieceerror" class="small text-danger"  style="font-size: 11px; color: red;">
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputprice" class="col-4 col-form-label">Price</label>
                    <div class="col-8">
                      <input id="inputprice" name="price" type="number" class="form-control" value="" min="0">
                      <div id="inputpriceerror" class="small text-danger"  style="font-size: 11px; color: red;">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="close2();">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      




      <form id="createForm" method="POST" action="{{ route('add') }}">
        @csrf
        <div class="modal fade" id="createmodal" tabindex="-1" aria-labelledby="createmodallabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title" id="editmodalLabel">Create</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat" onclick="close3();"></button>
              </div>
              <div class="modal-body">
                <div class="container-fluid">
                  <div class="row mb-3">
                    <label for="inputname2" class="col-4 col-form-label">Name</label>
                    <div class="col-8">
                      <input id="inputname2" name="name" type="text" class="form-control" value="">
                      <div id="inputnameerror2" class="small text-danger"  style="font-size: 11px; color: red;">
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputdescription2" class="col-4 col-form-label">Description</label>
                    <div class="col-8">
                      <input id="inputdescription2" name="description" type="text" class="form-control" value="">
                      <div id="inputdescriptionerror2" class="small text-danger"  style="font-size: 11px; color: red;">
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputpiece" class="col-4 col-form-label">Piece</label>
                    <div class="col-8">
                      <input id="inputpiece2" name="piece" type="number" class="form-control" value="" min="0">
                      <div id="inputpieceerror2" class="small text-danger"  style="font-size: 11px; color: red;">
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputprice" class="col-4 col-form-label">Price</label>
                    <div class="col-8">
                      <input id="inputprice2" name="price" type="number" class="form-control" value="" min="0">
                      <div id="inputpriceerror2" class="small text-danger"  style="font-size: 11px; color: red;">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="close3();">Close</button>
                <button type="submit" class="btn btn-primary" id="add" >Add</button>
              </div>
            </div>
          </div>
        </div>
      </form>


      <div id="viewpopupadd">
        
      </div>



<div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Delete this product?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Ok</button>
      </div>
    </div>
  </div>
</div>


{{-- <script>
  document.getElementById('createForm').addEventListener('submit', function(event) {
      event.preventDefault();

      const form = this;

      const formData = new FormData(form);

      fetch(form.action, {
          method: 'POST',
          body: formData,
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
      })
      .then(response => response.json())
      .then(data => {
          if (data.errors) {
              for (const fieldName in data.errors) {
                  const errorMessages = data.errors[fieldName].join(', ');
                  const errorElement = document.getElementById('input' + fieldName + 'error2');
                  if (errorElement) {
                      errorElement.textContent = errorMessages;
                  }
              }
          } else {
              form.submit();
          }
      })
      .catch(error => {
          console.error('Error occurred:', error);
      });
  });
</script> --}}






<script>
  function deletefunction(event){
    event.preventDefault();

    const deleteBtn = event.target;
    const form = deleteBtn.closest('form');

    $('#deletemodal').modal('show');

    const okBtn = document.querySelector('#deletemodal .btn-primary');
    okBtn.addEventListener('click', () => {
      form.submit();
    });

    const closeBtn = document.querySelector('#deletemodal .btn-secondary');
    closeBtn.addEventListener('click', () => {
      $('#deletemodal').modal('hide');
    });
  }
  
</script>

      <script>
          setTimeout(() => {
            let updatesucces = document.getElementById("updatesucces");
            updatesucces.remove();
          }, 2500);

          setTimeout(() => {
            let succesadd = document.getElementById("addsucces");
            succesadd.remove();
          }, 2500);

          setTimeout(() => {
            let deletesucces = document.getElementById("deletesucces");
            deletesucces.remove();
          }, 2500);

          setTimeout(() => {
            let loginsucces = document.getElementById("loginsucces");
            loginsucces.remove();
          }, 2500);

          document.getElementById("inputname").addEventListener("focus", function () {
          document.getElementById("inputnameerror").textContent = "";
      });

          document.getElementById("inputdescription").addEventListener("focus", function () {
          document.getElementById("inputdescriptionerror").textContent = "";
      });

          document.getElementById("inputpiece").addEventListener("focus", function () {
          document.getElementById("inputpieceerror").textContent = "";
      });

          document.getElementById("inputprice").addEventListener("focus", function () {
          document.getElementById("inputpriceerror").textContent = "";
      });

          document.getElementById("inputname2").addEventListener("focus", function () {
          document.getElementById("inputnameerror2").textContent = "";
      });

          document.getElementById("inputdescription2").addEventListener("focus", function () {
          document.getElementById("inputdescriptionerror2").textContent = "";
      });

          document.getElementById("inputpiece2").addEventListener("focus", function () {
          document.getElementById("inputpieceerror2").textContent = "";
      });

          document.getElementById("inputprice2").addEventListener("focus", function () {
          document.getElementById("inputpriceerror2").textContent = "";
      });
      </script>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/js/poppup.js') }}"></script>
    <script src="{{ asset('/js/edit.js') }}"></script>
    <script src="{{ asset('/js/add.js') }}"></script>
</body>
</html>