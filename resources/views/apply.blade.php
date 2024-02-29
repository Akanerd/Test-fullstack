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
                        <form action="{{ route('store') }}" method="POST" id="store">
                            @csrf
                            <div class="row gy-3 gy-md-4 overflow-hidden">
                                <div class="col-12">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="required form-control" name="name" id="name"
                                        placeholder="Masukkan Nama" data-required-message="Entry nama tidak boleh kosong">
                                </div>
                                <div class="col-12">
                                    <label class="col-sm-3 col-form-label">Jabatan <span
                                            class="text-danger">*</span></label>
                                    <select class="required form-control jabatan" name="job_id" id="job"
                                        data-required-message="Entry job tidak boleh kosong">
                                        @foreach ($job as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Telepon <span class="text-danger">*</span></label>
                                    <input type="text" class="number form-control " name="phone" id="phone"
                                        placeholder="Masukkan Nomor"
                                        data-number-message="Entry telepon harus bersifat numeric dengan 12 digit">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="email form-control" name="email" id="email"
                                        placeholder="Masukkan Email"
                                        data-email-message="Email tidak sesuai, sertakan @ pada alamat email">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tahun Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="required form-control datepicker" id="year"
                                        name="year" data-required-message="Entry tahun lahir tidak boleh kosong" />
                                </div>
                                <div class="col-12">
                                    <label class="col-sm-3 col-form-label">Skill <span class="text-danger">*</span></label>
                                    <select class="required skill form-control" id="skill"
                                        data-required-message="Pilih minimal 1 skill" multiple name="skill[]">
                                        @foreach ($skill as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
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
                minViewMode: "years",
            });
            $('#store').niceform({

                postFormEnabled: false,
            });

            $('#store').validate({
                rules: {
                    // Aturan validasi untuk setiap input
                    'name': {
                        required: true,
                        minlength: 2
                    },
                    'phone': {
                        required: true,
                    },
                    'job': {
                        required: true,
                    },
                    'email': {
                        required: true,
                    },
                    'year': {
                        required: true,
                        minlength: 2
                    },
                    'skill[]': {
                        required: true,
                        minlength: 1
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();

                    // Ambil data formulir
                    var formData = new FormData(form);

                    // Lakukan pengiriman AJAX
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,

                        success: function(response) {
                            console.log(response); // Log the response to the console
                            $('#result').text(JSON.stringify(response)); // Optionally display response in a DOM element
                            if (response.status == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'BERHASIL!',
                                    text: 'Lamaran berhasil dikirim!',
                                    showConfirmButton: false,
                                    timer: 3000
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'GAGAL!',
                                    text: 'Lamran gagal dikirim! ' + JSON.stringify(response), // Include response data in the error message
                                    showConfirmButton: false,
                                    timer: 3000
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            
                            Swal.fire({
                                icon: 'error',
                                title: 'GAGAL!',
                                text: 'Terjadi kesalahan: ' +
                                xhr.responseText, // Include error message in the alert
                                showConfirmButton: true
                            });
                        }

                    });
                }
            });
        });
    </script>
@endpush



</html>
