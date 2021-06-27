@if (session('successMessage'))
<div class="alert alert-success gutter-b" role="alert">
    {!! session('successMessage') !!}
</div>
@endif

@if (session('dangerMessage'))
<div class="alert alert-danger gutter-b" role="alert">
    {!! session('dangerMessage') !!}
</div>
@endif

@if (session('warningMessage'))
<div class="alert alert-warning gutter-b" role="alert">
    {!! session('warningMessage') !!}
</div>
@endif

@if (session('infoMessage'))
<div class="alert alert-info gutter-b" role="alert">
    {!! session('infoMessage') !!}
</div>
@endif
