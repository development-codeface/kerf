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
        var bookingArr = JSON.parse(jsonArray);
        console.log(bookingArr);
       
const obj = {
  date: '2024-09-17',
  amt: 340,
  time: '09:20:am',
  name: 'dfdfd'
};

$('.detailspay').append(Object.keys(bookingArr).map(key => {
  const value = bookingArr[key];
  return `<div>${key}: ${value}</div>`;
}).join(''));

});
</script>
@endpush