@php
    $blogContent = getContent('blog.content',true);
    $blogElement =  getContent('blog.element',false,3);
@endphp
<!-- blog-section start -->
<section class="blog-section ptb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="section-header">
                    <h2 class="section-title">{{ __($blogContent->data_values->heading) }}</h2>
                    <p>{{ __($blogContent->data_values->subheading) }}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($blogElement as $blog)

            <div class="col-lg-4 col-md-6 col-sm-8 mrb-30">
                <div class="blog-item">
                    <div class="blog-thumb">
                        <img src="{{ getImage('assets/images/frontend/blog/'. @$blog->data_values->blog_image, '730x400') }}" alt="@lang('blog-image')">
                        <span class="blog-cat">{{ __($blog->data_values->category) }}</span>
                    </div>
                    <div class="blog-content">
                        <h4 class="title">
                            <a href="{{ route('blog.details',[slug($blog->data_values->title),$blog->id]) }}">{{ StrLimit(strip_tags(__($blog->data_values->title)),35) }} </a>
                        </h4>
                        <p>{{ StrLimit(strip_tags(__($blog->data_values->description_nic)),80) }}</p>
                        <div class="blog-btn">
                            <a href="{{ route('blog.details',[slug($blog->data_values->title),$blog->id]) }}" class="custom-btn text-primary cmn--text">@lang('Continue Reading')<i class="las la-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- blog-section end -->

