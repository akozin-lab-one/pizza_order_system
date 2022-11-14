@extends('Admin.layouts.master')

@section('title', 'adminList')

@section('myContent')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-md-12">

            @if (session('deleteSuccess'))
            <div class="col-4 offset-7">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="zmdi zmdi-delete"></i> <small>{{(session('deletesuccess'))}}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
            @endif

            <div class="d-flex">
                <div class="col-3">
                    <h4>Search Key : <small class="text-danger"> {{request('key')}} </small> </h4>
                </div>
                <div class="col-3 offset-5">
                    <form action="{{route('auth#accountlist')}}" method="get">
                        <div class="d-flex">
                            <input type="text" class="form-control" name="key" value="{{request('key')}}" placeholder="Search..">
                            <button type="submit" class="btn btn-dark">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-1 text-center ms-3 fw-bold bg-light">
                    <i class="zmdi zmdi-storage"></i> : {{$admins->total()}}
                </div>
            </div>

            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th class="col-1 text-center">Image</th>
                            <th class="col-1 text-center">Name</th>
                            <th class="col-1 text-center">Email</th>
                            <th class="col-1 text-center">Phone</th>
                            <th class="col-1 text-center">Gender</th>
                            <th class="col-1 text-center">Address</th>
                            <th class="col-1 text-center">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $a )
                        <tr class="tr-shadow">
                            <td class="col-1 text-center">
                                @if ($a->image == null)
                                    @if ($a->gender == 'male')
                                        <img src="{{asset('image/unknown.jpg'. $a->image)}}">
                                    @else
                                        <img src="{{asset('image/unknown_female.jpg'. $a->image)}}">
                                    @endif
                                @else
                                    <img src="{{asset('storage/'. $a->image)}}">
                                @endif
                            </td>
                            <input type="hidden" class="userId" value="{{$a->id}}">
                            <td class="col-2 text-center">{{$a->name}}</td>
                            <td class="col-2 text-center">{{$a->email}}</td>
                            <td class="col-2 text-center">{{$a->phone}}</td>
                            <td class="col-1 text-center">{{$a->gender}}</td>
                            <td class="col-1 text-center">{{$a->address}}</td>
                            <td class="col-2 text-center">
                                <div class="table-data-feature justify-content-evenly">
                                    @if (Auth::user()->id == $a->id)

                                    @else
                                        <select class="form-control userStatus">
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr class="spacer"></tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{$admins->appends(request()->query())->links()}}
                </div>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
</div>
@endsection

@section('adminjs')
    <script>
        //change status
        $('.userStatus').change(function(){
            $parentNode = $(this).parents("tr");
            $userId = $parentNode.find('.userId').val();
            $currentStatus = $parentNode.find('.userStatus').val();


            $data = {
                'role' : $currentStatus,
                'userId' : $userId,
            }

            console.log($data);

            $.ajax({
                    type : 'get',
                    url : '/admin/role/change',
                    data : $data,
                    dataType : 'json',
            })
            location.reload();

        })
    </script>
@endsection
