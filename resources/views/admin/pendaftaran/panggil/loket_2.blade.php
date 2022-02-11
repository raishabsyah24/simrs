
@extends('layouts.admin.master', ['title' => $title])

@push('css')

@endpush

@section('admin-content')
   <div> 
       <div>LOKET 2</div>
       <h1>
           UMUM
       </h1>
       <h1>
           ASURANSI
       </h1>
       <h1>
           BPJS
       </h1>
   </div>
@endsection

@push('js')
    <script src="{{ asset('backend/pages/pendaftaran.js') }}"></script>
@endpush

