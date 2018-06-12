@extends('admin.master')
@section('content')
@section('controller','Product')
@section('action','Add')
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
        	
        	<form name="frmAdd" method="post" action="{!! route('admin.product.postAdd') !!}" enctype="multipart/form-data">
        		<input type="hidden" name="_token" value="{!! csrf_token() !!}" />
	      		
      			<div class="nav-tabs-custom">
	                <ul class="nav nav-tabs">
	                  	<li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Thông tin chung</a></li>
	                  	
	                  	<li><a href="#tab_2" data-toggle="tab" aria-expanded="true">Nội dung</a></li>
	                  	<li><a href="#tab_5" data-toggle="tab" aria-expanded="true">Album hình</a></li>
	                  	<li><a href="#tab_3" data-toggle="tab" aria-expanded="true">SEO</a></li>
	                </ul>
	                <div class="tab-content">
	                  	<div class="tab-pane active" id="tab_1">
	                  		<div class="row">
		                  		<div class="col-md-6 col-xs-12">
			                    	@if (count($errors) > 0)
						        		<div class="form-group has-error">
						        			@foreach ($errors->all() as $error)
						        			<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $error !!}</label><br>
						        			@endforeach
						        		</div>
						        	@endif
									<div class="form-group col-md-12 @if ($errors->first('fImages')!='') has-error @endif">
										<label for="file">File ảnh</label>
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
								      		<?php cate_parent($parent,0,"--",0) ?>
								      	</select>
									</div>
							    	<div class="form-group @if ($errors->first('txtName')!='') has-error @endif">
								      	<label for="ten">Tên</label>
								      	<input type="text" id="txtName" name="txtName" value=""  class="form-control" />
								      	@if ($errors->first('txtName')!='')
								      	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('txtName'); !!}</label>
								      	@endif
									</div>
									<div class="form-group @if ($errors->first('txtAlias')!='') has-error @endif">
								      	<label for="alias">Đường dẫn tĩnh</label>
								      	<input type="text" name="txtAlias" id="txtAlias" value=""  class="form-control" />
								      	@if ($errors->first('txtAlias')!='')
								      	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('txtAlias'); !!}</label>
								      	@endif
									</div>
									<div class="form-group">
								      	<label for="ten">Giá bán</label>
								      	<input type="text" name="txtPrice"  onkeyup="FormatNumber(this);"  onKeyPress="return isNumberKey(event)" value=""  class="form-control" />
									</div>
									<div class="form-group">
								      	<label for="ten">Giá cũ</label>
								      	<input type="text" name="txtPriceOld"  onkeyup="FormatNumber(this);"  onKeyPress="return isNumberKey(event)" value=""  class="form-control" />
									</div>
									<!-- <div class="form-group">
								      	<label for="alias">Ghi chú</label>
								      	<textarea name="txtHuongdan" rows="5" id="txtContent" class="form-control"></textarea>
									</div> -->
								</div>
								<!-- <div class="col-md-6">
									<div class="form-group">
								      	<label for="alias">Khuyến mại</label>
								      	<textarea name="txtQuatang" rows="5" id="txtContent" class="form-control"></textarea>
									</div>
								</div> -->
							</div>
							<div class="col-md-6 col-xs-12">

								
								<!-- <div class="form-group">
							      	<label for="ten">Mã SP</label>
							      	<input type="text" name="txtCode"  value=""  class="form-control" />
								</div> -->

								<!-- <div class="form-group">
									<label for="">Thông số kĩ thuật</label>
									<div id="a">
									</div>
									<input id="btnAdd"  class="add-properties" type="button" value="Add" />

								</div> -->
								<div class="form-group">
									<label for="desc">Đánh giá </label>
							      	<input type="number" name="ratedpoint" max="4" min="0" placeholder="Nhập số sao đánh giá" id="" class="form-control"></input>
								</div>
								<div class="form-group">
							      	<label for="desc">Mô tả</label>
							      	<textarea name="txtDesc" rows="5" id="txtContent" class="form-control"></textarea>
								</div>
								<!-- <div class="form-group">
							      	<label for="alias">Bảo hành</label>
							      	<input type="text" name="txtBaohanh" id="txtBaohanh" value=""  class="form-control" />
								</div> -->

								<!-- <div class="form-group">
							      	<label for="alias">Chất liệu</label>
							      	<input type="text" name="txtThuonghieu" id="txtThuonghieu" value=""  class="form-control" />
								</div>
								
								<div class="form-group">
							      	<label for="alias">Size</label>
							      	<input type="text" name="txtVanchuyen" id="txtVanchuyen" value=""  class="form-control" />
								</div> -->
								<!-- <div class="form-group">
							      	<label for="alias">Ghi chú</label>
							      	<input type="text" name="txtHuongdan" id="txtHuongdan" value=""  class="form-control" />
								</div> -->
								<!-- <div class="form-group">
							      	<label for="alias">Năm sản xuất</label>
							      	<input type="text" name="txtNamsanxuat" id="txtNamsanxuat" value=""  class="form-control" />
								</div> -->
								<!-- <div class="form-group">
							      	<label for="alias">Phụ kiện</label>
							      	<input type="text" name="txtQuatang" id="txtQuatang" value=""  class="form-control" />
								</div> -->
								<!-- <div class="form-group">
							      	<label for="alias">Model</label>
							      	<input type="text" name="txtModel" id="txtModel" value=""  class="form-control" />
								</div> -->
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
				        			<textarea name="txtHuongdan" id="txtContent" cols="50" rows="5"></textarea>
				        		</div>
				        	</div> -->
	                  		<div class="box box-info">
				                <div class="box-header">
				                  	<h3 class="box-title">Nội dung</h3>
				                  	<div class="pull-right box-tools">
					                    <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
					                </div>
				                </div>
				                <div class="box-body pad">
				        			<textarea name="txtContent" id="txtContent" cols="50" rows="5"></textarea>
				        		</div>
				        	</div>
	                    	<div class="clearfix"></div>
	                	</div><!-- /.tab-pane -->
	                	<div class="tab-pane" id="tab_5">
	                		<div class="form-group">
	                  			<label class="control-label">Chọn ảnh</label>
                      			<input id="input-2" name="detailImg[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-allowed-file-extensions='["jpeg", "jpg", "png", "gif"]'>
	                  		</div>
	                  	</div>
	                	<div class="tab-pane" id="tab_3">
	                  		<div class="row">
		                    	<div class="col-md-6 col-xs-12">
		                    		<div class="form-group">
								      	<label for="keyword">Keyword</label>
								      	<textarea name="txtKeyword" rows="5" class="form-control"></textarea>
									</div>
									<div class="form-group">
								      	<label for="description">Description</label>
								      	<textarea name="txtDescription" rows="5" class="form-control"></textarea>
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
					      <input type="number" min="1" name="stt" value="{!! count($data)+1 !!}" class="form-control" style="width: 100px;">
				    </div>
				    
				    <div class="form-group">
					    <label>
				        	<input type="checkbox" name="status" checked="checked"> Hiển thị
				    	</label>
				    </div>
				    <div class="form-group">
					    <label>
				        	<input type="checkbox" name="tinhtrang" checked="checked"> Tình trạng
				    	</label>
				    </div>
			    	<div class="form-group">
					    <label>
				        	<input type="checkbox" name="noibat"> Nổi bật
				    	</label>
				    </div>
				    <!-- <div class="form-group">
					    <label>
				        	<input type="checkbox" name="spbc"> Sale off
				    	</label>
				    </div> -->
			    </div>
			    <div class="clearfix"></div>
			    <div class="box-footer">
			    	<div class="row">
						<div class="col-md-6">
					    	<button type="submit" class="btn btn-primary">Lưu</button>
					    	<button type="button" onclick="javascript:window.location='backend/product'" class="btn btn-danger">Thoát</button>
				    	</div>
			    	</div>
			  	</div>
		    </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    
</section><!-- /.content -->

@endsection()
