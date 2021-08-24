<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>

    <h1 class="text-center mb-4">Data page Products</h1>

    <table id="customers">
        <thead>
            <tr>
                <th>#</th>
                <!-- <th scope="col">img</th> -->
                <th >name</th>
                <th >price</th>
                <th >quantity</th>
                <th >date</th>
                <!-- <th scope="col">create ago</th> -->
                <!-- <th scope="col">date</th> -->
                <!-- <th scope="col">action</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach($pdfproduct as $K => $row)
            <tr>
                <th scope="row">{{$K+1}}</th>
                <td>{{$row->name}}</td>
                <td>{{$row->price}}$</td>
                <td>{{$row->quantity}} quantity </td>
                <td>{{$row->created_at->format('D M Y')}}</td>
            </tr>
            @endforeach
    </table>

</body>

</html>
