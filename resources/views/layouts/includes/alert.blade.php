@if (count($errors) > 0)
        <div class="info-box card-outline card-danger">
            <span class="info-box-icon bg-danger"><i class="fas fa-bomb"></i></span>


            <div class="info-box-content">
                <span class="info-box-text font-weight-bold text-lg mb-2">Error</span>
                @foreach ($errors->all() as $error)
                    <span class="info-box-text"> {{ $error }}</span>
                @endforeach
            </div>
        </div>
@endif

<div class="d-none info-box card-outline card-info">
    <span class="info-box-icon bg-info"><i class="fas fa-exclamation-circle text-white"></i></span>

    <div class="info-box-content">
        <span class="info-box-text font-weight-bold text-lg mb-2">Info</span>
        <span class="info-box-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, animi aspernatur
            distinctio dolor dolorum eaque</span>
    </div>
</div>


@if (session('success'))
    <div class="info-box card-outline card-success">
        <span class="info-box-icon bg-success"><i class="fas fa-check-circle text-white"></i></span>


        <div class="info-box-content">
            <span class="info-box-text font-weight-bold text-lg mb-2">Success</span>
            <span class="info-box-text">{{ session('success') }}</span>
        </div>
    </div>
@endif
