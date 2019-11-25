@php
	use App\Http\Traits\app_manager\NavigationTraits;
@endphp

@extends('main_layouts.app')

@section('content')

<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
	<h5 class="page-header" style="color:blue;"><i class="fa fa-cog"></i> Navigation Category Settings</h5>
</div>

@include('main_layouts.messages')	
<div class="row" style="margin-top: 10px;">
	
	<div class="col-lg-12">

		<div class="panel panel-default" style=" font-size: 12px;">
			
			<div class="panel-body tab-content" style="height: auto;background-color: white;">

				{{ Form::open(array('route' => array('post.navigation.category'))) }}

			 	<table class="table table-bordered" style="width: 100%;margin-top: 10px;" id="table_category">
			 		<thead>
			 			<tr style="font-weight: bold;">
			 				<td>WINDOW CODE</td>
			 				<td>NAV DESCRIPTION</td>
	                        <td>ICON</td>
	                        <td>PARENT</td>
	                        <td>CHILD</td>
	                        <td style="width: 200px;">ROUTE</td>
	                        <td style="width: 60px;">ORDER</td>
	                        <td align="center" style="width: 40px;"><i class="fa fa-trash" style="color:red;"></i></td>
			 			</tr>
			 		</thead>

			 		<tbody>

			 				@if (!empty($navigation))
			 					
			 					@foreach ($navigation as $key => $element)

                                   <tr id="trList">

                                   	<td style="padding: 0px;">
                                       	<input type="text" class="form-control" name="window_code[]" value="{{ $element['NAV_ID'] }}" required readonly>
                                      </td>

                                       <td style="padding:0px;">

                                         <input type="text" class="form-control" name="nav_desc[]" value="{{ $element['NAV_DESCRIPTION'] }}" required>

                                         <input type="hidden" name="nav_id[]" value="{{ $element['NAV_ID'] }}">

                                        </td>

                                        <td style="padding:0px;">

                                            <select name="icon[]" class="fa form-control" style="size:15px;">

                                                @foreach ($icons as $icon_element)
                                                    
                                                    <option value="{{ $icon_element['id'] }}" @if($element['ICON'] == $icon_element['id']) selected @endif >{{ $icon_element['icon_class'] }}</option>

                                                @endforeach

                                            </select>

                                        </td>

                                        <td style="padding:0px;">

                                            <select name="parent[]" class="form-control" style="size:15px;">

                                                @foreach (NavigationTraits::getParentItems() as $parent_element)
                                                    
                                                    <option value="{{ $parent_element['NAV_ID'] }}" @if($element['PARENT'] == $parent_element['NAV_ID']) selected @endif >{{ $parent_element['NAV_DESCRIPTION'] }}</option>

                                                @endforeach

                                            </select>

                                        </td>

                                        <td style="padding: 0px;">

                                            <select name="with_child[]" class="form-control" id="with_child{{ $key }}" onchange="changeWithChild(this.id)" @if(NavigationTraits::hasChild($element['NAV_ID']) > 0) style="pointer-events: none;background-color: #EEEEEE;" @endif>


                                                <option value="0" @if($element['CHILD'] == 0) selected @endif >NO</option>

                                                <option value="1" @if($element['CHILD'] == 1) selected @endif >YES</option>

                                            </select>

                                        </td>


                                        <td style="padding:0px;">
                                            
                                            <input type="text" id="route{{ $key }}" class="form-control" name="route[]" value="{{ $element['ROUTE'] }}" @if($element['CHILD'] == 1) readonly @endif>
                                        </td>

                                        <td style="padding:0px;width: 80px;">
                                            
                                            <input type="text" id="order{{ $key }}" class="form-control" placeholder="Order" name="order[]" value="{{ $element['ORDER'] }}">
                                        </td>

                                        <td style="padding:0px;">
                                            <a class="btn btn-xs" data-id="{{ $element['NAV_ID'] }}" data-id2="{{ $element['NAV_DESCRIPTION'] }}" style="text-align: center;margin-top: 0px;margin-left: 0px;color:red;" @if(NavigationTraits::hasChild($element['NAV_ID']) > 0) disabled @else onclick="deleteRow(this)" @endif><i class="fa fa-times" ></i></a>
                                        </td>

                                   </tr>

                                @endforeach

			 				@endif
			 				
			 			
			 		</tbody>

			 		<tr>
			 			{{-- <td colspan="6"></td> --}}
			 			<td colspan="7" align="right">
			 				<button type="button" class="btn btn-primary" id="addRow" data-toggle="tooltip" data-placement="top" title="Add Row"><i class="fa fa-plus"></i></button>
			 				<button type="submit" class="btn btn-success"  data-toggle="tooltip" data-placement="top" title="Save"><i class="fa fa-save"></i></button>
			 			</td>
			 		</tr>
			 	</table>

			 	{{ Form::close() }}
			 	
			 </div>

		</div>
	</div>
</div>
</div>

@include('POS.app_manager.navigation.scripts.navigation_parent_modal')

@include('POS.app_manager.navigation.scripts.navigation_category_script')

@endsection