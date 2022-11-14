@extends('User.layouts.master')

@section('title', 'Contact Message')

@section('myContent')
    <div class="card col-6 offset-3">
        <h3 class="text-center mt-3">Contact To Admin</h3>
        <div class="col-6 offset-3">
            <form action="" method="get">
                <div class="mb-3">
                    <label class="text-dark" for="">User Name</label>
                    <input type="text" class="form-control" id="name">
                </div>

                <div class="mb-3">
                    <label class="text-dark" for="">E-Mail</label>
                    <input type="text" class="form-control" id="email">
                </div>

                <div class="mb-3">
                    <label class="text-dark" for="">Message</label>
                    <textarea class="form-control" cols="30" rows="10" id="message"></textarea>
                </div>

                <input class="form-control mb-3 col-4 btn btn-primary float-end sendBtn" type="button" value="Send Message">
            </form>
        </div>
    </div>
@endsection

@section('MyAjaxList')
    <script>
        $('.sendBtn').click(function(){
            $name = $('#name').val();
            $email = $('#email').val();
            $message = $('#message').val();

            $data = {
                'userName' : $name,
                'userEmail' : $email,
                'userMessage' : $message,
            }

            console.log($data);

            $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/ajax/message/data',
                    data : $data,
                    dataType : 'json',
            })

            location.reload()
        })
    </script>
@endsection
