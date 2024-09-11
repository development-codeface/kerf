@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="blog-section blog-details-section ptb-80">
        <div class="container">
            <div class="row justify-content-center ml-b-20">
                <div class="col-lg-8 mrb-60">
                    <div class="blog-item">
                        <div class="blog-thumb">
                            <img src="{{ getImage('assets/images/frontend/blog/' . @$blog->data_values->blog_image) }}"
                                alt="@lang('blog-image')">
                        </div>
                        <div class="blog-content">
                            <div
                                class="blog-details-content-header d-flex flex-wrap align-items-center justify-content-between">
                                <h3 class="title">{{ __($blog->data_values->title) }}</h3>
                                <span class="blog-details-date"><i class="fas fa-calendar-alt"></i>
                                    {{ \Carbon\Carbon::parse( diffForHumans( $blog->created_at)) }}</span>
                                <span class="blog-details-date"><i class="fas fa-eye"></i> {{ $blog->views }}</span>
                            </div>
                            <p> @php echo trans($blog->data_values->description_nic) @endphp </p>
                        </div>
                    </div>


                    <ul class="post-share d-flex align-items-center mt-5 flex-wrap">
                        <li class="caption fw-bold">@lang('Share On') : </li>
                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('Facebook')">
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('Linkedin')">
                            <a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}&amp;title=my share text&amp;summary=dit is de linkedin summary" title="@lang('Linkedin')"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('Pinterest')">
                            <a target="_blank" href="http://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&description={{ __(@$blog->data_values->title) }}&media={{ getImage('assets/images/frontend/blog/' . $blog->data_values->blog_image, '1000x700') }}" title="@lang('Pinterest')"><i class="fab fa-pinterest"></i></a>
                        </li>
                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('Twitter')">
                            <a target="_blank" href="https://twitter.com/intent/tweet?text={{ __(@$blog->data_values->title) }}%0A{{ url()->current() }}" title="@lang('Twitter')"><i class="fab fa-twitter"></i></a>
                        </li>
                    </ul>

                    <div class="fb-comments" data-href="{{ url()->current() }}" data-width="" data-numposts="5"></div>


                </div>
                <div class="col-lg-4 mrb-60">
                    <div class="sidebar">
                        <div class="widget-box mrb-30">
                            <h5 class="widget-title">@lang('Latest Blogs')</h5>
                            <div class="popular-widget-box">
                                @foreach ($latestPosts as $post)
                                    <div class="single-popular-item d-flex flex-wrap">
                                        <div class="popular-item-thumb">
                                            <img src="{{ getImage('assets/images/frontend/blog/' . @$post->data_values->blog_image) }}"
                                                alt="@lang('blog-image')">
                                        </div>
                                        <div class="popular-item-content">
                                            <h5 class="title">
                                                <a href="{{ route('blog.details', [slug($post->data_values->title), $post->id]) }}">{{ StrLimit(strip_tags(__($post->data_values->title)), 20) }}</a>
                                            </h5>
                                            <span class="blog-date">
                                                <i class="fas fa-calendar-alt"></i>
                                                {{ diffForHumans($post->created_at) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('fbComment')
    @php echo loadExtension('fb-comment') @endphp
@endpush
