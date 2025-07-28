<div>
    @if (session()->has('success'))
    <div class='alert alert-sucess alert dimissable fade show' role="alert">
        {{session('success')}}
        <button type='button' class='btn-close' data-bs-dimiss="alert" aria-label="close"></button>
    </div>
    @endif
</div>
