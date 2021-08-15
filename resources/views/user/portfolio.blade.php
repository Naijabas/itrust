@extends('layouts.user')

@section('title')
    {{ __('Portfolio') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Portfolio</li>
@endsection

@section('style')
<link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div>
{{--            <div id="live-chart"></div>--}}
            <div class="card">
                <div class="card-body">
                    <div id="live-chart" class="apex-charts" dir="ltr"></div>
                </div>
            </div><!--end card-->
        </div>
        <div>
            <div class="card">
                <div class="card-body">
                    @if($user->passport == null || $user->drivers_license == null || $user->state_id == null)
                        <h6>Verify Your Identity</h6>
                        <p>Kindly complete your profile and upload a photo of your state ID, driver's license or passport so we can finish processing your application.</p>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">Upload Document Now</a>
                    @else
                        <h6>Identity Verified</h6>
                        <p>Documents Uploaded</p>
                    @endif
                </div>
            </div>
        </div>
        <div>
            <h4>News</h4>
            <hr>
            <div class="">
                @foreach($news as $info)
                    <div class="row">
                        <div class="col-9">
                            <h6>{{ ucfirst($info->title)  }} <small>{{ \Carbon\Carbon::make($info->date_range)->shortAbsoluteDiffForHumans() }}</small></h6>
                            <p>{!! $info->body !!}</p>
{{--                            <p>BABA &nbsp; 1.40% &nbsp;&nbsp;&nbsp; TCEHY &nbsp; 0.54%</p>--}}
                        </div>
                        <div class="col-3">
                            <img src="{{ $info->image ? asset($info->image) : '' }}" alt="" style="height: 100%; width: 100%; object-fit: contain;">
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card w-75 mx-auto">
            <div class="card-body">
                <div class="table">
                    <table class="table table-borderless">
                        <tr class="text-center">
                            <td>BTC</td>
                            <td>BTC</td>
                            <td>$20000</td>
                        </tr>
                        <tr class="text-center">
                            <td>BTC</td>
                            <td>BTC</td>
                            <td>$20000</td>
                        </tr>
                        <tr class="text-center">
                            <td>BTC</td>
                            <td>BTC</td>
                            <td>$20000</td>
                        </tr>
                        <tr class="text-center">
                            <td>BTC</td>
                            <td>BTC</td>
                            <td>$20000</td>
                        </tr>
                        <tr class="text-center">
                            <td>BTC</td>
                            <td>BTC</td>
                            <td>$20000</td>
                        </tr>
                        <tr class="text-center">
                            <td>BTC</td>
                            <td>BTC</td>
                            <td>$20000</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <img src="{{ asset('svg/upload.svg') }}" alt="">
            <div class="modal-body">
                <p>We need photos of both sides of your passport card, permanent resident card, or state ID in order to verify your identity.</p>
                <div class="form-group">
                    <label for="doc">Document Type:</label>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="formRadios"
                               id="formRadios1" value="Passport">
                        <label class="form-check-label" for="formRadios1">
                            Passport  @if($user->passport) <i class=" fas fa-check-circle text-success"></i> @endif
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="formRadios"
                               id="formRadios2" value="Driver's License">
                        <label class="form-check-label" for="formRadios2">
                            Driver's License  @if($user->drivers_license) <i class=" fas fa-check-circle text-success"></i> @endif
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="formRadios"
                               id="formRadios3" value="State ID">
                        <label class="form-check-label" for="formRadios3">
                            State ID  @if($user->state_id) <i class=" fas fa-check-circle text-success"></i> @endif
                        </label>
                    </div>
                </div>
                <button type="button" id="cont-btn" data-bs-dismiss="modal" onclick="updateModalTitle('#myLargeModalLabel')" disabled class="btn w-100 btn-block btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Continue</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Upload a photo of your </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" class="" enctype="multipart/form-data">
                <input type="hidden" name="type" id="doc-type" value="default">
                <div class="modal-body">
                    Please ensure the entire document is in the frame and information is legible.
                    <div class="row" id="modalDetails"></div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mt-5">
                                <div class="d-none" id="pass-file">
                                    <input type="file" class="dropify" id="pass-file-field" data-default-file="{{ $user->passport ? asset($user->passport) : '' }}" data-allowed-file-extensions="png jpg jpeg" data-max-file="1" data-max-file-size="1M" required />
                                </div>
                                <div class="d-none" id="drv-file">
                                    <input type="file" class="dropify" id="drv-file-field" data-default-file="{{ $user->drivers_license ? asset($user->drivers_license) : '' }}" data-allowed-file-extensions="png jpg jpeg" data-max-file="1" data-max-file-size="1M" required />
                                </div>
                                <div class="d-none" id="stt-file">
                                    <input type="file" class="dropify" id="stt-file-field" data-default-file="{{ $user->state_id ? asset($user->state_id) : '' }}" data-allowed-file-extensions="png jpg jpeg" data-max-file="1" data-max-file-size="1M" required />
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="button" id="sub-btn" class="btn btn-primary waves-effect waves-light" onclick="submitDoc()">Upload</button>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('script')
    <script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>

        function submitDoc() {
            const formData = new FormData()
            const type = $('#doc-type').val();
            formData.append('type', type)
            if (type === 'passport')
                formData.append('file', $('#pass-file-field')[0].files[0]);
            else if (type === 'drivers_license')
                formData.append('file', $('#drv-file-field')[0].files[0]);
            else if (type === 'state_id')
                formData.append('file', $('#stt-file-field')[0].files[0]);

            $.ajax({
                url: '{{ route('user.documents.upload') }}',
                type: 'POST',
                headers: { "X-CSRF-TOKEN": '{{ csrf_token() }}' },
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#sub-btn').attr('disabled', true)
                },
                success: function (res) {
                    $('#sub-btn').attr('disabled', false)
                    alertify.success(res.msg)
                    setTimeout(() => location.href = '{{ route('user.portfolio') }}',2000)
                },
                error: function (res) {
                    $('#sub-btn').attr('disabled', false)
                    if (res.status === 422)
                        if (res['responseJSON'].msg['type'])
                            alertify.error(res['responseJSON'].msg['type'][0]);
                        if (res['responseJSON'].msg['file'])
                            alertify.error(res['responseJSON'].msg['file'][0]);
                    else if (res.status === 429)
                        alertify.error(res.statusText);
                    else
                        alertify.error(res['responseJSON'].msg);
                }
            })
        }

        (chart = new ApexCharts(document.querySelector("#live-chart"), {
            chart: {height: 350, type: "area", toolbar: {show: !1}},
            dataLabels: {enabled: !1},
            stroke: {curve: "smooth", width: 3},
            series: [
                {name: "Deposit", data: {!! json_encode($data) !!}},
                // {name: "series2", data: [32, 60, 34, 46, 34, 52, 41]}
            ],
            colors: ['#5156be'],
            xaxis: {
                type: "date",
                categories: {!! json_encode($days) !!}
                // categories: ["2018-09-19T00:00:00", "2018-09-19T01:30:00", "2018-09-19T02:30:00", "2018-09-19T03:30:00", "2018-09-19T04:30:00", "2018-09-19T05:30:00", "2018-09-19T06:30:00"]
            },
            grid: {borderColor: "#f1f1f1"},
            tooltip: {x: {format: "dd/MM"}}
        })).render();

        $('.dropify').dropify({
            messages: {
                'default': '<p style="font-size: 18px">Drag and drop a file here or click</p>',
                'replace': '<p style="font-size: 18px">Drag and drop or click to replace</p>',
                'remove':  'Remove'
            },
        });

        $('input[type="radio"][name="formRadios"]').on('change', function () {
            if ($(this).is(':checked')) $('#cont-btn').attr('disabled', false)
        })

        function updateModalTitle(id) {
            const value = $('input[type="radio"][name="formRadios"]:checked').val()
            $(id).html('Upload a photo of your '+ value)
            $('input[type="hidden"][name="type"]').val(value)

            if (value === "Passport") {
                $('#doc-type').val('passport')
                $('#pass-file').removeClass('d-none')
                $('#drv-file').addClass('d-none')
                $('#stt-file').addClass('d-none')
                $('#modalDetails').html(`
                    <div class="col-md-6">
                        Your photo must:<br>
                        <i class=" fas fa-check-circle text-success"></i> Be a clear, color image<br>
                        <i class=" fas fa-check-circle text-success"></i> Show the entire page, including your face<br>
                        <i class=" fas fa-check-circle text-success"></i> Show all four corners<br>
                    </div>
                    <div class="col-md-6">
                        We can't accept:<br>
                        <i class="fas fa-times-circle text-danger"></i> Scans, copies, or screenshots<br>
                    </div>
                `);
            }

            if (value === "Driver's License") {
                $('#doc-type').val('drivers_license')
                $('#pass-file').addClass('d-none')
                $('#drv-file').removeClass('d-none')
                $('#stt-file').addClass('d-none')
                $('#modalDetails').html(`
                    <div class="col-md-6">
                        Your photo must:<br>
                        <i class=" fas fa-check-circle text-success"></i> Be a clear, color image<br>
                        <i class=" fas fa-check-circle text-success"></i> Be of a valid driver’s license or permit<br>
                        <i class=" fas fa-check-circle text-success"></i> Show all four corners<br>
                    </div>
                    <div class="col-md-6">
                        We can't accept:<br>
                        <i class="fas fa-times-circle text-danger"></i> Printed or temporary licenses<br>
                        <i class="fas fa-times-circle text-danger"></i> Scans, copies, or screenshots<br>
                        <i class="fas fa-times-circle text-danger"></i> Laminated or plastic covered cards<br>
                    </div>
                `);
            }

            if (value === "State ID") {
                $('#doc-type').val('state_id')
                $('#pass-file').addClass('d-none')
                $('#drv-file').addClass('d-none')
                $('#stt-file').removeClass('d-none')
                $('#modalDetails').html(`
                    <div class="col-md-6">
                        Your photo must:<br>
                        <i class=" fas fa-check-circle text-success"></i> Be a clear, colored image<br>
                        <i class=" fas fa-check-circle text-success"></i> Show all four corners<br>
                    </div>
                    <div class="col-md-6">
                        We can't accept:<br>
                        <i class="fas fa-times-circle text-danger"></i> U.S. military ID and trusted traveller cards<br>
                        <i class="fas fa-times-circle text-danger"></i> Employment authorization documents<br>
                        <i class="fas fa-times-circle text-danger"></i> Documents not from the U.S. government<br>
                        <i class="fas fa-times-circle text-danger"></i> Scans, copies, or screenshots<br>
                    </div>
                `);
            }
        }
    </script>
@endsection

