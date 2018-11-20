<html>






    {!! Form::open(['method'=>'POST', 'route'=>'phishing','files'=>true]) !!}



    <div class="form-group">
        {!! Form::label('username_label','Username:') !!}
        {!! Form::text('username',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password_label','Password:') !!}
        {!! Form::text('password',null,['class'=>'form-control']) !!}
    </div>







    <div class="form-group">
        {!! Form::submit('SUBMIT', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}


</html>
