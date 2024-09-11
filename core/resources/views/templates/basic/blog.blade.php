@extends($activeTemplate.'layouts.frontend')
@section('content')
    <section class="blog-section ptb-80">
        <div class="container">
            <div class="row justify-content-center">
                @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-6 col-sm-8 mrb-30">
                    <div class="blog-item">
                        <div class="blog-thumb">
                            <img src="{{ getImage('assets/images/frontend/blog/'. $blog->data_values->blog_image) }}" alt="@lang('blog')">
                            <span class="blog-cat">{{ __($blog->data_values->category) }}</span>
                        </div>
                        <div class="blog-content">
                            <h4 class="title"><a href="{{ route('blog.details',[slug($blog->data_values->title), $blog->id]) }}">{{ Str::limit(strip_tags(__($blog->data_values->title)),50) }} </a></h4>
                            <p>{{ Str::limit(strip_tags(__($blog->data_values->description_nic)),100) }}</p>
                            <div class="blog-btn">
                                <a href="{{ route('blog.details',[slug($blog->data_values->title), $blog->id]) }}" class="custom-btn cmn--text">@lang('Continue Reading')<i class="las la-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $blogs->links() }}
        </div>
    </section>
@endsection
