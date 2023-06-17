@extends('layouts.admin')
@section('content')
<ul class="nav navbar-nav align-items-end ms-auto mb-2">
    <li class="nav-item dropdown dropdown-user nav-item has">
        <button type="button" class="btn btn-primary btn-icon" id="dropdown-user" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="feather-16" data-feather="settings"> </i>
        </button>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
            <a class="dropdown-item" href="javascript:if(window.print)window.print()"><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer font-small-4 me-50">
                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                        <rect x="6" y="14" width="12" height="8"></rect>
                    </svg>Print</span></a>
            <a class="dropdown-item" href="" data-toggle="modal" target="_blank"><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard font-small-4 me-50">
                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                        <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                    </svg>Export To Pdf</span></a>
            <a class="dropdown-item" href="#demoModal" data-bs-toggle="modal"> <i class="me-50 feather-16" data-feather="sliders"> </i> More Filter</a>
        </div>
    </li>
</ul>
<section>
        <div class="row card h-100">
            <div class="table-responsive">
                <table id="table" class="table w-100">
                     <thead>
                         <tr>
                             <th colspan="8" class="text-center">
                                 Period {{$period}}
                             </th>
                         </tr>
                         <tr>
                             <th>
                                 Account &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
                             </th>
                             <th class="text-center">
                                 Date
                             </th>
                             <th  class="text-center">
                                 Communication
                             </th>
                             <th  class="text-center">
                                 Patner
                             </th>
                             <th  class="text-center">
                                 Currency
                             </th>
                             <th  class="text-center">
                                 Debit
                             </th>
                             <th  class="text-center">
                                 Credit
                             </th>
                             <th  class="text-center">
                                 Balance
                             </th>
                         </tr>
                     </thead>
                     <tbody>
                        @php $subtotal_dr=0; $subtotal_cr=0; @endphp
                         @foreach ($data as $key =>$row)
                            <tr>
                                <td width="auto"><b>{{$row->code_combination_id}} {{$row->coa->description}}</b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-end"><b>{{number_format($row->entered_dr,2)}}</b></td>
                                <td class="text-end"><b>{{number_format($row->entered_cr,2)}}</b></td>
                                <td class="text-end"><b>{{number_format($row->entered_dr - $row->entered_cr, 3)}}</b></td>
                            </tr>
                            @php $subtotal_dr+=$row->entered_dr; $subtotal_cr +=$row->entered_cr ;@endphp
                            @foreach ($lines as $key =>$line)
                                @if($line->code_combination_id == $row->code_combination_id)
                                <tr>
                                    <td width="auto">&emsp; {{$line->gl->name}}</td>
                                    <td>{{$line->effective_date->format('d/m/y')}}</td>
                                    <td>{{$line->description}}</td>
                                    <td>{{$line->reference_1}}</td>
                                    <td class="text-end">{{$line->currency_code ?? 'IDR'}}</td>
                                    <td class="text-end">{{number_format($line->entered_dr,2)}}</td>
                                    <td class="text-end">{{number_format($line->entered_cr,2)}}</td>
                                    <td class="text-end">{{number_format($line->entered_dr - $line->entered_cr, 3)}}</td>
                                </tr>
                                @endif
                            @endforeach
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr>
                            <th colspan="5" class="text-center">Total</th>
                            <th>{{number_format($subtotal_dr,2)}}</th>
                            <th>{{number_format($subtotal_cr,2)}}</th>
                            <th>{{number_format(($subtotal_dr-$subtotal_cr),2)}}</th>
                        </tr>
                     </tfoot>
                 </table>
             </div>
        </div>
</section>
<!-- /.content -->
@endsection

@push('script')
    <script>

    $(document).ready(function() {
         $('#table').DataTable({
            responsive: false,
            scrollX: true,
            searching: true,
            dom: '<"card-header border-bottom"\
                                            <"head-label">\
                                            <"dt-action-buttons text-end">\
                                        >\
                                        <"d-flex justify-content-between row mt-1"\
                                            <"col-sm-12 col-md-7"Bl>\
                                            <"col-sm-12 col-md-2"f>\
                                            <"col-sm-12 col-md-2"p>\
                                        ti>',
            displayLength: 25,
            "lengthMenu": [
                [7, 25, 50, -1],
                [7, 25, 50, "All"]
            ],
            buttons: [{
                    extend: 'print',
                    text: feather.icons['printer'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Print',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'excel',
                    text: feather.icons['file'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Excel',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'pdf',
                    text: feather.icons['clipboard'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Pdf',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'copy',
                    text: feather.icons['copy'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Copy',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'colvis',
                    text: feather.icons['eye'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Colvis',
                    className: ''
                },
            ],
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            order: false
        });
    });
    </script>
@endpush
