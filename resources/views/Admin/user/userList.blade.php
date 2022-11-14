@extends('Admin.layouts.master')

@section('title', 'User List')

@section('myContent')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="table-responsive table-responsive-data2">
                @if (count($users) != 0 )
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th class="col-1 text-center">Image</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="col-2 text-center">
                                @if ($user->image == null)
                                    @if ($user->gender == 'male')
                                        <img src="{{asset('image/unknown.jpg'. $user->image)}}" class="img-thumbnail">
                                    @else
                                        <img src="{{asset('image/unknown_female.jpg'. $user->image)}}" class="img-thumbnail">
                                    @endif
                                @else
                                    <img src="{{asset('storage/'. $user->image)}}" class="img-thumbnail">
                                @endif
                            </td>
                            <input type="hidden" class="userId" value="{{$user->id}}">
                            <td >{{$user->name}}</td>
                            <td >{{$user->email}}</td>
                            <td >{{$user->phone}}</td>
                            <td >
                                <select class="form-control genderStatus">
                                    <option value="male" @if ($user->gender == 'male') selected @endif>Male</option>
                                    <option value="female" @if ($user->gender == 'female') selected @endif>Female</option>
                                </select>
                            </td>
                            <td >{{$user->address}}</td>
                            <td >
                                <select class="form-control orderStatus">
                                    <option value="admin" @if ($user->role == 'admin') selected @endif>Admin</option>
                                    <option value="user" @if ($user->role == 'user') selected @endif>User</option>
                                </select>
                            </td>
                            <td>
                                <a href="{{route('admin#userdetail', $user->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="view">
                                        <i class="zmdi zmdi zmdi-eye fs-3 me-3"></i>
                                    </button>
                                </a>
                                <a href="{{route('admin#deleteUser', $user->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete fs-3"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <h3 class="text-secondary mt-5 text-center">There is no Users in this list!</h3>
                @endif
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
</div>
@endsection

@section('adminjs')
    <script>
        $('.orderStatus').change(function(){
            $parentNode = $(this).parents("tr");
            $userId = $parentNode.find('.userId').val();
            $currentStatus = $parentNode.find('.orderStatus').val();
            console.log($userId, $currentStatus);

            $data = {
                'role' : $currentStatus,
                'userId' : $userId,
            }

            console.log($data);

            $.ajax({
                    type : 'get',
                    url : '/user/change/role',
                    data : $data,
                    dataType : 'json',
            })
            location.reload()

        })

        $('.genderStatus').change(function(){
            $parentNode = $(this).parents("tr");
            $userId = $parentNode.find('.userId').val();
            $currentStatus = $parentNode.find('.genderStatus').val();

            $data = {
                'gender' : $currentStatus,
                'userId' : $userId,
            }

            console.log($data);

            $.ajax({
                    type : 'get',
                    url : '/user/change/gender',
                    data : $data,
                    dataType : 'json',
            })
            location.reload();

        })
    </script>
@endsection
