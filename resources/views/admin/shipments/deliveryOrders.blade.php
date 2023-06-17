<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Buana Megah</title>
        <style>
            @page
                {
                    margin: 0 !important;
                    margin-top: 0 !important;
                    /* padding: 5px !important; */
                    size: auto;  /*  auto is the current printer page size */

                }
                *

                    /** Define the header rules **/
                    header {
                        position: fixed;
                        top: 10px;
                        left: 20px;
                        right: 20px;
                        /* height: 3cm; */
                    }

                    /** Define the footer rules **/
                    footer {
                        position:relative;
                        top: 26cm;
                        bottom: 0cm;
                        left: 0cm;
                        /* right: 1cm; */
                        height: 1cm;
                        text-align: right;
                        margin-right: 20px;
                    }


                    #footer .page::before {
                        /* counter-increment: page; */
                        content: counter(page);
                    }

                    /* p{
                        counter-reset: page;
                    } */

            body{
                font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                color:#333;
                text-align:left;
                font-size:12;
                margin-left: 20px;
                margin-right: 20px;
                font-size: 11px;
            }

            .margin{
                margin-top: 2cm;
            }
            .container{
                /* to centre page on screen*/
                /* border:1px solid #333; */
            }
            table{
                width: 100%;
                padding-left: 0;
                padding: 10px;
                border-collapse: collapse;
            }
            th{
                /* padding-right:3px; */
                padding:10px;
                width: auto;
                border-top: 1px solid #000000;
                border-bottom: 1px solid #000000;
            }
            th{
                /* background-color: #E5E4E2; */
                font-size:11px;
                /* width: 98%; */
                margin:10px;
                text-align: center;
            }
            h4,p{
                margin:0px;
                font-size:14px;
            }
            td{
                width: auto;
                padding:2px;
                font-size:12px;
            }
            table.table-content td{
                /* vertical-align: text-top; */
                padding: 5px;
                border-bottom: 1px dashed  #cacaca;
            }
            .table-footer{
                margin-top: 5% !important;
                text-align: center;
                font-size:14px;
                object-position: center bottom !important;
            }
            .bg{
                background-color: #E5E4E2;
            }
            tfoot{
                margin-top: 5% !important;
                border-top:    1px solid  #cacaca;
                border-bottom: 1px dashed  #cacaca;
            }
            .page_break {
            page-break-before: always;
            }
            hr{
                color: green;
            }
            .table-content{
                padding: 15px !important;
            }

        </style>
    </head>

<body>


<div class="container ">
    <table>
        <tr >
            <td colspan="4"><h3 style="text-align: center"><b>Delivery Order</b></h3></td>
        </tr>
        <tr >
            <td><h4><b>Delivery ID</b></h4></td>
            <td><p>: {{$head->delivery_id}}</p></td>
        </tr>
        <tr>
            <td style="vertical-align: text-top; !important">
                <h4>User</h4>
            </td>
            <td style="vertical-align: text-top; text-transform:uppercase !important">
                <p>: PPIC
                </p>
            </td>
            <td style="width: 100px; vertical-align: text-top; !important">
                <h4>Sales Number</h4>
            </td>
            <td style="vertical-align: text-top; !important">
                <p>: {{$head->detail->source_header_number ?? ''}}
                </p>
            </td>
        </tr>
        <tr>
            <td style="width: 120px; !important">
                <h4>No Order</h4>
            </td>
            <td >
                <p>: </p>
            </td>
            <td>
                <h4> Customer PO</h4>
            </td>
            <td  >
                <p>: {{$head->detail->cust_po_number ?? ''}}</p>
            </td>
        </tr>
        <tr>
            <td>
                <h4 style="text-align: top">Date</h4>
            </td>
            <td >
                <p>: {{date('d F Y')}}</p>
            </td>
            <td>
                <h4> Customer</h4>
            </td>
            <td >
                <p>: {{$head->customer->party_name}}</p>
            </td>
        </tr>
    </table>
    <table class="table-content">
        <tbody>
            <tr class="tr">
                <th colspan="">Item</th>
                <th>Roll</th>
                <th>Weight</th>
                <th>Location</th>
                <th>Src</th>
                <th>G</th>
                <th>Q</th>
                <th>S1</th>
                <th>S2</th>
            </tr>

            @foreach ($roll as $key =>$r)
                @php $no = 0; $rowspan=0; $weight=0; @endphp
                @foreach ($line as $key => $l)
                    @if ($r->load_item_id == $l->load_item_id && $r->attribute1 == $l->attribute1 && $r->attribute3 == $l->attribute3)
                    @php $no++; $rowspan=$r->roll; @endphp
                        <tr>
                        @if ($no == 1)
                            <td rowspan="{{$rowspan}}" width="auto">{{$l->ItemMaster->item_code  ?? ''}} {{$l->attribute1}} GSM {{$l->attribute3}} CM</td>
                        @endif
                            <td >{{$l->container_item_id}}</td>
                            <td align="right">{{number_format($l->attribute_number1,'1','.')}}</td>
                            <td align="center">{{$l->attribute_location ?? '-'}}</td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                        </tr>
                        @endif
                        @php $weight += $l->attribute_number1 @endphp
                    @endforeach
            @endforeach
       </tbody>
       <tfoot >
        <tr class="tr">
            <td align="center"><strong>Total</strong></td>
            <td align="center">{{$totalRoll}}</td>
            <td align="right">{{number_format($weight,'1','.')}}</td>
            <td colspan="6" align="right"></td>
        </tr>
    </tfoot>
    </table>

    <table class="table-footer">
        <tr >
            <td >Prepared By,</td>
            <td >WH Manager</td>
            <td >PPIC</td>
            <td >Receive By,</td>
        </tr>
        <tr><td style="height: 50px"></td></tr>
        <tr >
            <td > __________________  </td>
            <td > __________________  </td>
            <td > __________________  </td>
            <td > Customer </td>
        </tr>
    </table>
 </div>
</body>
</html>
