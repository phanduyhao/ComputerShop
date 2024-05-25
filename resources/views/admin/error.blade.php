@if($errors->any())
    <div class="alert alert-error alert-danger pb-1">
        <ul>
            @foreach($errors->all() as $errors)
                <li>{{$errors}}</li>
            @endforeach
        </ul>
    </div>
@endif
