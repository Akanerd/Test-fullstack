@extends('layouts.master')
@section('content')
    @include('sweetalert::alert')
    <!-- Registration 2 - Bootstrap Brain Component -->
    <div class="bg-light py-3 py-md-5">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="text-center my-5">
                    <img src="{{ asset('energeek.png') }}" alt="logo" width="250px">
                </div>
                <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
                    <div class="bg-white p-4 p-md-5 rounded shadow-sm">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5">
                                    <h2 class="h3 text-center">Apply Lamaran</h2>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-3 gy-md-4 overflow-hidden">
                                <div class="col-12">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" placeholder="Masukkan Nama">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="col-sm-3 col-form-label">Jabatan <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control jabatan @error('job_id') is-invalid @enderror"
                                        name="job_id">
                                        @foreach ($job as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('job_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Telepon <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" id="phone" placeholder="Masukkan Nomor">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" placeholder="Masukkan Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tahun Lahir <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control datepicker @error('year') is-invalid @enderror"
                                        name="year" />
                                    @error('year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="col-sm-3 col-form-label">Skill <span class="text-danger">*</span></label>
                                    <select class="skill form-control @error('skill') is-invalid @enderror" multiple
                                        name="skill[]">
                                        @foreach ($skill as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('skill')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-lg btn-danger" type="submit">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $(".jabatan").select2({
                placeholder: "Pilih Posisi kerja",
                theme: "classic",
                allowClear: true,
                
            });

            $('.skill').select2({
                theme: "classic",
                placeholder: 'Pilih skill',
            });

            $(".datepicker").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years"
            });
        });
    </script>
@endpush



</html>
