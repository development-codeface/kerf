@extends($activeTemplate . 'layouts.frontend')
@section('content')
<section class="banner">
    <div class="successsPayment">
        <div class="detailspay"></div>
        <h2>Payment success!!</h2>
        <div style="text-align: center;">
        <a href="{{ route('doctors.all') }}" class="btn btn-primary">Go to Doctors List</a>
        </div>
    </div>
</section>
@endsection
@push('script')
<script>
    $(()=>{
        var jsonArray = localStorage.getItem('bookingArr');
        var originalObject = JSON.parse(jsonArray);
        
        const reorderedObject = {
        name: originalObject.name,
        amt: originalObject.amt,
        date: originalObject.date,
        time: originalObject.time
        };
        // var reorderedObject = { name, amt, date, time } = bookingArr;
        console.log(reorderedObject);
$('.detailspay').append(Object.keys(reorderedObject).map(key => {
  const value = reorderedObject[key];
  return `<div>${key}: ${value}</div>`;
}).join(''));

});
</script>
@endpush