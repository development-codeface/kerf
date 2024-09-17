@extends($activeTemplate . 'layouts.frontend')
@section('content')
<section class="banner">
    <div class="successsPayment">
        <h2>Payment success!!</h2>
    </div>
</section>
@endsection
@push('script')
<script>
    setTimeout(function() {
        window.location.href = "{{ route('doctors.all') }}";
    }, 3500); // 3000 milliseconds = 3 seconds
</script>
@endpush