@include('inc.home.head', ['title' => trans('main.Portfolio')])
<section class="section p-150 bread-crumbs">
    <div class="container">
        <a href="{{ url('/') }}" class="text-muted">{{trans('main.Home')}}</a> / <a href="{{ url('profiles/'.auth()->user()->id) }}" class="text-primary">{{trans('main.Profile')}}</a>
    </div>
</section>

    <div class="worker-profile pt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="left-sidebar ">
                        <ul class="nav nav-pills nav nav-pills bg-white rounded mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item d-block col-12">
                                <a class="nav-link" href="{{ url('profiles/'. auth()->user()->id) }}">{{trans('main.General Information')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link" href="{{ url('profiles/'. auth()->user()->id. '/edit/experience') }}">{{trans('main.Experiences')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/education') }}">{{trans('main.Education')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/skills') }}">{{trans('main.Skills')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/languages') }}">{{trans('main.Languages')}}</a>
                            </li>
                            <li class="nav-item d-block col-12">
                                <a class="nav-link"  href="{{ url('profiles/'. auth()->user()->id. '/edit/social') }}">{{trans('main.Online Presence')}}</a>
                            </li>
                            <li class="nav-item d-block col-12 ">
                                <a class="nav-link active"  href="{{ url('profiles/'. auth()->user()->id. '/edit/gallery') }}">{{trans('main.Portfolio')}}</a>
                            </li>
                            <li class="nav-item d-block col-12 ">
                                <a class="nav-link"  href="{{ url('chat') }}">{{trans('main.Chat')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
        
                <div class="col-lg-9 col-md-12 profile-edit">
                    <div class="tab-content mt-2" id="pills-tabContent">
                        <div class="tab-pane fade show active general" id="general" role="tabpanel" aria-labelledby="general-tab">
                        </div>
                        <div class="tab-pane fade experiences" id="experiences" role="tabpanel" aria-labelledby="experiences-tab">
                        </div>
                        <div class="tab-pane fade education" id="education" role="tabpanel" aria-labelledby="education-tab">
                        </div>
                        <div class="tab-pane fade skills" id="skills" role="tabpanel" aria-labelledby="skills-tab">
                        </div>
                        <div class="tab-pane fade languages" id="languages" role="tabpanel" aria-labelledby="languages-tab">
                        </div>
                        <div class="tab-pane fade social" id="social" role="tabpanel" aria-labelledby="social-tab">
                        </div>
                        <div class="tab-pane fade show active gallery" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                            @if (count(Helper::galleryByUser(auth()->user()->id)) > 0)
                                <div class="gallery pt-2">
                                    @foreach(Helper::galleryByUser(auth()->user()->id) as $image)
                                        <div class="image-box">
                                            <img src="{{ asset('uploads/images/gallery_images/'.$image->gallery_image) }}" alt="" class="img-fluid gallery_image" id ="preview_image" data-toggle="modal" data-target="#gallery-{{$image->id}}">
                                            <span class="delete-image" aria-hidden="true" data-toggle="modal" data-target="#gallery-{{ $image->id }}-delete">&times;</span>
                                        </div>
                                        <!-- View Modal -->
                                        <div class="modal modal-view fade" id="gallery-{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <img src="{{ asset('uploads/images/gallery_images/'.$image->gallery_image) }}" alt="" class="img-fluid" id ="preview_image" data-toggle="modal" data-target="#gallery-{{$image->id}}">
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="gallery-{{ $image->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Delete Image')}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                {!! Form::open(['action'=> ['ProfileController@update', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'w-100'])!!}
                                                    <div class="modal-body">
                                                        {{trans('main.Are You Sure To Delete The Photo?')}}
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.Close')}}</button>
                                                        {!! Form::submit(trans('main.Delete'), ['class' => "btn btn-primary", 'name' => 'delete-gallery-image']) !!}
                                                    </div>
                                                {!! Form::text('image_id', $image->id, ['hidden']) !!}
                                                {!! Form::hidden('_method', 'PUT') !!}
                                                {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="clearfix"></div>
                                </div>
                            @endif
                            {!! Form::open(['action'=> ['ProfileController@store', $user->id], 'method'=>'POST', 'enctype' =>'multipart/form-data' ])!!}
                                            
                                <div class="row">
                                    <div class="form-group app-label mt-2 w-100">
                                        {!! Form::file('gallery_image[]', [ 'hidden', 'id' => 'gallery_image', 'multiple', 'required'])!!}
                                        <label  class="empty-to-show box mx-4" for="gallery_image">
                                            {{trans('main.Upload Photos')}}
                                        </label>
                                        <div class="previewer"></div>
                                        
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-12 mt-2">
                                        {!! Form::submit(trans('main.Add'), ['class' => "btn btn-primary mt-2 btn-sm", 'name' => 'create-gallery']) !!}
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>


    @include('inc.home.foot')
  
@include('inc.home.scripts')

<script>
    $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview) {
    
            if (input.files) {
                $('.empty-to-show').css('display', 'none');
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $('#gallery_image').on('change', function() {
            imagesPreview(this, 'div.previewer');
        });
    });
</script>
</body>
</html>