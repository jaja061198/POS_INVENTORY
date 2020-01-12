@php
 use App\Helpers\Helper;
 use App\Http\Controllers\E_COM\ShippingFeeController;
@endphp
@extends('main_layouts.app')

@section('content')
<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
  <h5 class="page-header" style="color:blue;"><i class="fa fa-cogs"></i> Shipping Fee Table</h5>
</div>

@include('main_layouts.messages')  

<div class="row" style="margin-top: 10px;">
  
  <div class="col-lg-12">

    <div class="panel panel-default" style=" font-size: 12px;">

      {{Form::open(array('route' => array('add.shipping'))) }}

      <table class="table table-bordered" id="userTable">
        <thead>
          <tr style="text-align: center;text-transform: uppercase;font-weight: bold;">
            <td style="width: 20px;">Update</td>
            <td>Shipping Location</td>
            <td>Shipping Price</td>
            <td align="center" style="width: 40px;"><i class="fa fa-trash" style="color:red;"></i></td>
          </tr>
        </thead>

        <tbody>
            @foreach($data as $key => $value)
              <tr>
                <td style="padding:0px;" align="center;">
                    <input type="checkbox" class="form-check-input" style="margin-left: 30px;margin-top: 10px;" name="update[]" value="1">
                    <input type="hidden" name="update[]" value="0">
                </td>

                <td style="padding:0px;">
                    <input type="hidden" name="code[]" class="form-control" value="{{ $value['id'] }}">
                    <input type="text" class="form-control" name="area[]" value="{{ $value['area'] }}" required>
                </td>
                <td style="padding:0px;">
                    <input type="text" id="price{{ $key }}" class="form-control" style="text-align: right;" name="price[]" value="{{ Helper::numberFormat($value['price']) }}" onclick="clickme(this)" onclick="clickme(this)" onblur="blurme(this)" oninput="this.value = this.value.replace(/[^0-9.]/g, '\'\').replace(/(\\..*)\\./g, \'$1\');">
                </td>

                <td style="padding:0px;">
                    <a class="btn btn-xs" data-id="{{ $value['id'] }}" data-id2="{{ $value['area'] }}" style="text-align: center;margin-top: 0px;margin-left: 0px;color:red;" @if(ShippingFeeController::countTransaction($value['id'])) disabled @endif onclick="deleteRow(this)"><i class="fa fa-times fa-2x" ></i></a>
                </td>

              </tr>
            @endforeach
        </tbody>
          <tr>
            <td colspan=""></td>
            <td colspan="100%" align="right">
              <button type="button" class="btn btn-primary" id="addRow" data-toggle="tooltip" data-placement="top" title="Add Row"><i class="fa fa-plus"></i></button>
              <button type="submit" class="btn btn-success"  data-toggle="tooltip" data-placement="top" title="Save"><i class="fa fa-save"></i></button>
            </td>
          </tr>

      </table>

      {{Form::close() }}
        
    </div>

  </div>
  </div>

  @include('E_COM.shippingfee.shippingfee_modal');
  @include('E_COM.shippingfee.shipping_script');

@endsection
