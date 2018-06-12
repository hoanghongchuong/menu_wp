@extends('admin.master')
@section('content')
@section('controller','Product')
@section('action','Edit')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
   	@yield('controller')
    <small>@yield('action')</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:">@yield('controller')</a></li>
    <li class="active">@yield('action')</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  
    <div class="box">
    	@include('admin.messages_error')
        <div class="box-body">
        	<form method="post" name="frmEditProduct" action="backend/product/edit?id={{$id}}" enctype="multipart/form-data">
        		<input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        		
      			<div class="nav-tabs-custom">
	                <ul class="nav nav-tabs">
	                  	<li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Thông tin chung</a></li>
	                  	<li><a href="#tab_2" data-toggle="tab" aria-expanded="true">Nội dung</a></li>
	                  	<li><a href="#tab_3" data-toggle="tab" aria-expanded="true">Album hình</a></li>
	                  	<li><a href="#tab_4" data-toggle="tab" aria-expanded="true">SEO</a></li>
	                </ul>
	                <div class="tab-content">
	                  	<div class="tab-pane active" id="tab_1">
	                  		<div class="row">
		                  		<div class="col-md-6 col-xs-12">
									<div class="form-group @if ($errors->first('fImages')!='') has-error @endif">
										<div class="form-group">
											<img src="{{ asset('upload/product/'.$data->photo) }}" onerror="this.src='{{asset('public/admin_assets/images/no-image.jpg')}}'" width="200"  alt="NO PHOTO" />
											<input type="hidden" name="img_current" value="{!! @$data->photo !!}">
											<!-- <a href="{!! asset('backend/product/edit?id='.$id.'&type='.@$_GET['type'].'&delete_bg='.@$data->photo) !!}" class="img_bg"><img src="{!! asset('public/admin_assets/images/del.png') !!}" alt="Xóa hình"></a> -->
										</div>
										<label for="file">Chọn File ảnh</label>
								     	<input type="file" id="file" name="fImages" >
								    	<p class="help-block">Width:225px - Height: 162px</p>
								    	@if ($errors->first('fImages')!='')
								      	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('fImages'); !!}</label>
								      	@endif
									</div>
									
									<div class="clearfix"></div>
									<div class="form-group">
								      	<label for="ten">Danh mục cha</label>
								      	<select name="txtProductCate" class="form-control">

								      		<option value="0">Chọn danh mục</option>
								      		<?php cate_parent($parent,0,"--",$data->cate_id) ?>
								      	</select>
									</div>
							    	<div class="form-group @if ($errors->first('txtName')!='') has-error @endif">
								      	<label for="ten">Tên</label>
								      	<input type="text" name="txtName" id="txtName" value="{{ $data->name }}"  class="form-control" />
								      	@if ($errors->first('txtName')!='')
								      	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('txtName'); !!}</label>
								      	@endif
									</div>
									<div class="form-group @if ($errors->first('txtAlias')!='') has-error @endif">
								      	<label for="alias">Đường dẫn tĩnh</label>
								      	<input type="text" name="txtAlias" id="txtAlias" value="{{ $data->alias }}"  class="form-control" />
								      	@if ($errors->first('txtAlias')!='')
								      	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('txtAlias'); !!}</label>
								      	@endif
									</div>
									<!-- <div class="form-group">
								      	<label for="alias">Ghi chú</label>
								      	
								      	<textarea name="txtHuongdan" rows="5" id="txtContent" class="form-control">{{ $data->huongdan }}</textarea>
									</div> -->
									
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
								      	<label for="ten">Giá bán</label>
								      	<input type="text" name="txtPrice" onkeyup="FormatNumber(this);"  onKeyPress="return isNumberKey(event)" value="{{ number_format($data->price,0,'',',') }}"  class="form-control" />
									</div>
									<!-- 
									<div class="form-group">
								      	<label for="ten">Giá cũ</label>
								      	<input type="text" name="txtPriceOld" onkeyup="FormatNumber(this);"  onKeyPress="return isNumberKey(event)" value="{{ number_format($data->price_old,0,'',',') }}"  class="form-control" />
									</div> -->
									<!-- <div class="form-group">
								      	<label for="ten">Mã SP</label>
								      	<input type="text" name="txtCode"  value="{{ $data->code }}"  class="form-control" />
									</div> -->
									<!-- <div class="form-group">
								      	<label for="alias">Bảo hành</label>
								      	<input type="text" name="txtBaohanh" id="txtBaohanh" value="{{ $data->baohanh }}"  class="form-control" />
									</div> -->
									<!-- <div class="form-group">
										<label for="">Thông số kĩ thuật</label>
										<?php $properties = explode('###', $data->properties) ?>
										@for($i=0; $i< count($properties); $i++)
										<div id="a">
											<div class="con">
											  	<input id="Text1" type="text" class="" name="properties[]" value="{{$properties[$i]}}" />
											  	<input type="button" class="btnRemove" id="btn-Remove" value="Remove"/>
										  	</div>
										</div>
										@endfor
										<input id="btnAdd"  class="add-properties" type="button" value="Add" />
									</div> -->
									<div class="form-group">
										<label for="desc">Đánh giá </label>
								      	<input type="number" name="ratedpoint" value="{{$data->ratepoint}}" max="4" min="0" placeholder="Nhập số sao đánh giá"  id="" class="form-control"></input>
									</div>
									<!-- <div class="form-group">
								      	<label for="ten">Giảm giá</label>
								      	<input type="text" name="txtSale"  value="{{ $data->sale }}"  class="form-control" />
									</div> -->
									<!-- <div class="form-group">
								      	<label for="ten">Giá cũ</label>
								      	<input type="text" name="txtPriceOld" onkeyup="FormatNumber(this);"  onKeyPress="return isNumberKey(event)" value="{{ number_format($data->price_old,0,'',',') }}"  class="form-control" />
									</div> -->
									<div class="form-group">
								      	<label for="desc">Mô tả</label>
								      	<textarea name="txtDesc" rows="5" id="txtContent" class="form-control">{{ $data->mota }}</textarea>
									</div>
									<!-- <div class="form-group">
								      	<label for="alias">Chất liệu</label>
								      	<input type="text" name="txtThuonghieu" id="txtThuonghieu" value="{{ $data->thuonghieu }}"  class="form-control" />
									</div>
									<div class="form-group">
								      	<label for="alias">Màu sắc</label>
								      	<input type="text" name="txtBaohanh" id="txtBaohanh" value="{{ $data->baohanh }}"  class="form-control" />
									</div>
									<div class="form-group">
								      	<label for="alias">Size</label>
								      	<input type="text" name="txtVanchuyen" id="txtVanchuyen" value="{{ $data->vanchuyen }}"  class="form-control" />
									</div> -->
									
									<!-- <div class="form-group">
								      	<label for="alias">Năm sản xuất</label>
								      	<input type="text" name="txtNamsanxuat" id="txtNamsanxuat" value="{{ $data->namsanxuat }}"  class="form-control" />
									</div> -->
									<!-- <div class="form-group">
								      	<label for="alias">Khuyến mại</label>
								      	<input type="text" name="txtQuatang" id="txtQuatang" value="{{ $data->quatang }}"  class="form-control" />
								      	<textarea name="txtQuatang" rows="5" id="txtContent" class="form-control">{{ $data->quatang }}</textarea>
									</div> -->
									<!-- <div class="form-group">
								      	<label for="alias">Model</label>
								      	<input type="text" name="txtModel" id="txtModel" value="{{ $data->model }}"  class="form-control" />
									</div> -->
								</div>
							</div>
							<div class="clearfix"></div>
	                  	</div><!-- /.tab-pane -->

	                  	<div class="tab-pane" id="tab_2">
	                  		<!-- <div class="box box-info">
				                <div class="box-header">
				                  	<h3 class="box-title">Mô tả chi tiết</h3>
				                  	<div class="pull-right box-tools">
					                    <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
					                </div>
				                </div>
				                <div class="box-body pad">
				        			<textarea name="txtHuongdan" id="txtContent" cols="50" rows="5">{{ $data->huongdan }}</textarea>
				        		</div>
				        	</div> -->
	                  		<div class="box box-info">
				                <div class="box-header">
				                  	<h3 class="box-title">Thông tin chi tiết</h3>
				                  	<div class="pull-right box-tools">
					                    <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
					                </div>
				                </div>
				                <div class="box-body pad">
				        			<textarea name="txtContent" id="txtContent" cols="50" rows="5">{{ $data->content }}</textarea>
				        		</div>
				        	</div>
	                    	<div class="clearfix"></div>
	                	</div><!-- /.tab-pane -->
	                  	<div class="tab-pane" id="tab_3">
	                  		<div class="form-group">
		                      @foreach($product_img as $key => $item)
		                        <div class="form-group" id="{!! $key !!}">
		                            <img src="{!! asset('upload/hasp/'.$item['photo']) !!}" style="max-width: 150px; margin: 20px;" idImg="{!! $item['id'] !!}" id="{!! $key !!}">

		                            <a href="javascript:" type="button" id="del_img" class="btn btn-danger btn-circle icon_del"><i class="fa fa-times"></i></a>
		                        </div>
		                      @endforeach


		                      <label class="control-label">Chọn ảnh</label>
		                      <input id="input-2" name="detailImg[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-allowed-file-extensions='["jpeg", "jpg", "png", "gif"]'>
		                    </div>
	                  		<!-- <div class="form-group">
								<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Thêm ảnh liên quan</button>
							</div> -->
							<!-- <div class="col-md-12">
				                <div class="dropzone" id="my-dropzone" name="myDropzone">

				                </div>
				            </div> -->
	                    	<div class="clearfix"></div>
	                	</div><!-- /.tab-pane -->
	                	<div class="tab-pane" id="tab_4">
	                  		<div class="row">
		                    	<div class="col-md-6 col-xs-12">
		                    		<div class="form-group">
								      	<label for="title">Title</label>
								      	<input type="text" name="txtTitle" value="{{ $data->title }}"  class="form-control" />
									</div>
		                    		<div class="form-group">
								      	<label for="keyword">Keyword</label>
								      	<textarea name="txtKeyword" rows="5" class="form-control">{{ $data->keyword }}</textarea>
									</div>
									<div class="form-group">
								      	<label for="description">Description</label>
								      	<textarea name="txtDescription" rows="5" class="form-control">{{ $data->description }}</textarea>
									</div>
		                    	</div>
	                    	</div>
	                    	<div class="clearfix"></div>
	                	</div><!-- /.tab-pane -->
	                </div><!-- /.tab-content -->
	            </div>
	            <div class="clearfix"></div>
			    <div class="col-md-6">
			    	<div class="form-group">
					      <label for="ten">Số thứ tự</label>
					      <input type="number" min="1" name="stt" value="{!! isset($data->status) ? $data->stt : (count($product)+1) !!}" class="form-control" style="width: 100px;">
				    </div>
				    
				    <div class="form-group">
					    <label>
				        	<input type="checkbox" name="status" {!! (!isset($data->status) || $data->status==1)?'checked="checked"':'' !!}> Hiển thị
				    	</label>
				    </div>
				    <div class="form-group">
					    <label>
				        	<input type="checkbox" name="tinhtrang" {!! (!isset($data->tinhtrang) || $data->tinhtrang==1)?'checked="checked"':'' !!}> Tình trạng
				    	</label>
				    </div>
			    	<div class="form-group">
					    <label>
				        	<input type="checkbox" name="noibat" {!! (!isset($data->noibat) || $data->noibat==1)?'checked="checked"':'' !!}> Nổi bật
				    	</label>
				    </div>
				    <!-- <div class="form-group">
					    <label>
				        	<input type="checkbox" name="spbc" {!! (!isset($data->spbc) || $data->spbc==1)?'checked="checked"':'' !!}> Sale off
				    	</label>
				    </div> -->
			    </div>
			    <div class="clearfix"></div>
			    <div class="box-footer">
			    	<div class="row">
						<div class="col-md-6">
					    	<button type="submit" class="btn btn-primary">Cập nhật</button>
					    	<button type="button" class="btn btn-danger" onclick="javascript:window.location='backend/product'">Thoát</button>
				    	</div>
			    	</div>
			  	</div>
		    </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    
</section><!-- /.content -->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	    <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Thêm hình ảnh liên quan</h4>
	    </div>
      	<div class="modal-body">
      		<!-- <div class="container">
			    <div class="row">
			        <div class="col-md-12">
			            <h1>Upload Multiple Images using dropzone.js and Laravel</h1>
			            {!! Form::open([ 'route' => [ 'dropzone.store' ], 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'dropzone', 'id' => 'image-upload' ]) !!}
			            <div>
			                <h3>Upload Multiple Image By Click On Box</h3>
			            </div>
			            {!! Form::close() !!}
			        </div>
			    </div>
			</div>

			<script type="text/javascript">
			        Dropzone.options.imageUpload = {
			            maxFilesize         :       1,
			            acceptedFiles: ".jpeg,.jpg,.png,.gif"
			        };
			</script> -->
      		<div class="row">
		        <div class="col-md-12">
		        
			        <form method="post" id="upload" action="{{ route('admin.uploadImg') }}" enctype="multipart/form-data">
			        	<input type="hidden" name="_token" value="{!! csrf_token() !!}" />
			            <div class="row">
			                <div class="col-md-4">
			                    <div id="drop">
			                        Kéo thả hình vào đây

			                        <a>Chọn</a>
			                        <input type="file" name="upl" multiple />
			                    </div>
			                </div>
			                <div class="col-md-8">
			                    <ul id="list_uploaded">
			                    </ul>
			                </div>
			            </div>
			        </form>
		        </div>
		    </div>
      	</div>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      	</div>
    </div>

  </div>
</div>
@endsection()
