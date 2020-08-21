<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
       {{-- <link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"> --}}

    <!-- Script -->
    {{-- <script src="{{asset('jquery-3.4.1.min.js')}}" type="text/javascript"></script> --}}
    {{-- <script src="{{asset('DataTables/datatables.min.js')}}" type="text/javascript"></script> --}}


    <!-- Datatables CSS CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Datatables JS CDN -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</head>
<body>
     <!-- CSS -->

    <table id='empTable' width='100%' border="1" style='border-collapse: collapse;'>
        <thead>
            <tr>
                <td>Serial</td>
                <td>Username</td>
                <td>Name</td>
                <td>Email</td>
                <td>Status</td>
            </tr>
        </thead>
    </table>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#empTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('employees.getEmployees')}}",
                columns:[
                    {data: 'id'},
                    {data: 'username'},
                    {data: 'name'},
                    {data: 'email'},
                    {data: ''}
                ]
            });
        });
    </script>
</body>
</html>
