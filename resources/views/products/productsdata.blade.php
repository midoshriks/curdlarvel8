<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>CRUD larvel 8</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/datapage">empolyees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/productsdata">Products</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <h1 class="text-center mb-4">Data page Productsdata</h1>
    <div class="container">

        <!-- defult message Error -->
        {{--
        @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{$message}}
    </div>
    @elseif($message = Session::get('delete'))
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @endif
    --}}


    <a href="/plusproduct" class="btn btn-success mb-5">plues product +</a>
    <!-- search box -->
    <form action="/productsdata" method="get">
        <div class="row g-3 align-items-center">

            <label for="inputPassword6" class="col-xform-label">search employee</label>
            <div class="col-auto">
                <input type="search" name="search" class="form-control">
            </div>

            <div class="col-auto">
                <span id="passwordHelpInline" class="form-text">
                    loading...
                </span>
            </div>

            <div class="col-auto">
                <a href="/exportpdf_product" class="btn btn-info">Export PDF</a>
            </div>

            <div class="col-auto">
                <a href="/exportexcel_products" class="btn btn-success">Export Excel</a>
            </div>

            <div class="col-auto">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Import Data
                </button>
            </div>

            <div class="col-auto">
            </div>

        </div>
    </form>
    <!-- search box -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/importexcel_products" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="from-group">
                            <input type="file" name="file" require>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">import excel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">img</th>
                    <th scope="col">name</th>
                    <th scope="col">price</th>
                    <th scope="col">Tax</th>
                    <th scope="col">quantity</th>
                    <th scope="col">create ago</th>
                    <th scope="col">date</th>
                    <th scope="col">Add quantity</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productsdata as $K => $row)
                <tr>
                    <th scope="row">{{$K +1 }}</th>
                    <td>
                        <img src="{{ asset('fotoproducts/'.$row->foto) }}" alt="img" style="width: 40px;">
                    </td>
                    <td>{{$row->name}}</td>
                    <td>${{$row->price}}</td>
                    <td>${{$row->tax}}</td>
                    <td>{{$row->quantity }} <i class="fas fa-sort-amount-up-alt" style="color: blue;"></i></td>
                    <td>{{$row->created_at->diffForHumans()}}</td>
                    <td>{{$row->created_at->format('D M Y')}}</td>
                    <td>
                        <a href="/addproduct/{{ $row->id }}" class="btn btn-primary">Add quantity +</a>
                    </td>
                    <td>
                        <a href="/editproduct/{{ $row->id }}" class="btn btn-info">Edit</a>
                        <!-- <a href="" class="btn btn-danger">Delete</a> -->
                        <a href="#" class="btn btn-danger delete" data-id="{{ $row->id }}" data-name="{{ $row->name }}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $productsdata->links() }}
    </div>
    </div>

    <!-- <button class="btn btn-danger">tets</button> -->











    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    <!-- Option cdn  code & sweetalert -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Option cdn  toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

<script>
    // test
    // swal("Hello world!");

    // is function delete row
    $('.delete').click(function() {
        var datapageid = $(this).attr('data-id');
        var dataname = $(this).attr('data-name');
        swal({

                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file your " + dataname + "!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/delete/" + datapageid + ""
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    });
</script>

<script>
    // Set a success toast, with a title
    // toastr.success('Have fun storming the castle!', 'Miracle Max Says')
    @if(Session::has('success'))
    toastr.success(" {{ Session::get('success') }} ")
    @endif

    @if(Session::has('delete'))
    toastr.warning(" {{ Session::get('delete') }} ")
    @endif
</script>

</html>
