@extends('index')
@section('content')
<?php
    $setting = Cache::get('setting');
    $about = Cache::get('about');
?>

<style type="text/css">
.cf:after { visibility: hidden; display: block; font-size: 0; content: " "; clear: both; height: 0; }
* html .cf { zoom: 1; }
*:first-child+html .cf { zoom: 1; }
html { margin: 0; padding: 0; }
body { font-size: 100%; margin: 0; padding: 1.75em; font-family: 'Helvetica Neue', Arial, sans-serif; }
h1 { font-size: 1.75em; margin: 0 0 0.6em 0; }
a { color: #2996cc; }
a:hover { text-decoration: none; }
p { line-height: 1.5em; }
.small { color: #666; font-size: 0.875em; }
.large { font-size: 1.25em; }
/**
 * Nestable
 */
.dd { position: relative; display: block; margin: 0; padding: 0; max-width: 600px; list-style: none; font-size: 13px; line-height: 20px; }
.dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
.dd-list .dd-list { padding-left: 30px; }
.dd-collapsed .dd-list { display: none; }
.dd-item,
.dd-empty,
.dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }
.dd-handle { display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd-handle:hover { color: #2ea8e5; background: #fff; }
.dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
.dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
.dd-item > button[data-action="collapse"]:before { content: '-'; }
.dd-placeholder,
.dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
.dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
    background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                      -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                         -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                              linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-size: 60px 60px;
    background-position: 0 0, 30px 30px;
}
.dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
.dd-dragel > .dd-item .dd-handle { margin-top: 0; }
.dd-dragel .dd-handle {
    -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
            box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
}
/**
 * Nestable Extras
 */
.nestable-lists { display: block; clear: both; padding: 30px 0; width: 100%; border: 0; border-top: 2px solid #ddd; border-bottom: 2px solid #ddd; }
#nestable-menu { padding: 0; margin: 20px 0; }
#nestable-output,
#nestable2-output { width: 100%; height: 7em; font-size: 0.75em; line-height: 1.333333em; font-family: Consolas, monospace; padding: 5px; box-sizing: border-box; -moz-box-sizing: border-box; }
#nestable2 .dd-handle {
    color: #fff;
    border: 1px solid #999;
    background: #bbb;
    background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
    background:    -moz-linear-gradient(top, #bbb 0%, #999 100%);
    background:         linear-gradient(top, #bbb 0%, #999 100%);
}
#nestable2 .dd-handle:hover { background: #bbb; }
#nestable2 .dd-item > button:before { color: #fff; }
@media only screen and (min-width: 700px) {
    .dd { float: left; width: 48%; }
    .dd + .dd { margin-left: 2%; }
}
.dd-hover > .dd-handle { background: #2ea8e5 !important; }
/**
 * Nestable Draggable Handles
 */
.dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd3-content:hover { color: #2ea8e5; background: #fff; }
.dd-dragel > .dd3-item > .dd3-content { margin: 0; }
.dd3-item > button { margin-left: 30px; }
.dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
    border: 1px solid #aaa;
    background: #ddd;
    background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:         linear-gradient(top, #ddd 0%, #bbb 100%);
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.dd3-handle:before { content: '≡'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
.dd3-handle:hover { background: #ddd; }
/**
 * Socialite
 */
.socialite { display: block; float: left; height: 35px; }
    </style>

    <h1>Nestable</h1>
    
    <div class="cf nestable-lists">
        <div class="add-menu"><button type="button" class="btn btn-info btn-lg add_new_menu" data-toggle="modal" data-target="#myModal">Thêm mới</button></div>
        <div class="dd" id="nestable">
            {!!$menu!!}
        </div>
        <p id="success-indicator" style="display:none; margin-right: 10px;">
          <span class="glyphicon glyphicon-ok"></span> Menu order has been saved
        </p>
    </div>

    <br>
    <p><strong>Serialised Output (per list)</strong></p>

    <textarea id="nestable-output"></textarea>
    <textarea id="nestable2-output"></textarea>



<!-- modal create menu -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content" id="loadModalMenu">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Thêm menu</h4>
            </div>
            <form id="form_create_menu" accept-charset="utf-8">
                {{csrf_field()}}        
                <div class="modal-body">
                  <p><input type="text" name="name" id="name_modal"  class="form-control" value="" placeholder="Tên"></p>
                  <p><input type="text" name="slug" id="slug_moal" class="form-control" value="" placeholder="Đường dẫn"></p>
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-primary save_menu ">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                  
                </div>
            </form>
          </div>
          
        </div>
    </div>

<!-- end modal -->

<div class="modal fade" id="myModalEdit" role="dialog">
        <div class="modal-dialog">        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Sửa menu</h4>
            </div>
            <form id="form_edit_menu" accept-charset="utf-8">
                {{csrf_field()}}        
                <div class="modal-body edit_data">
                    <!-- <input type="hidden" name="id_menu" value=""> -->
                  <p><input type="text" name="name" id="name_modal"  class="form-control" value="" placeholder="Tên"></p>
                  <p><input type="text" name="slug" id="slug_moal" class="form-control" value="" placeholder="Đường dẫn"></p>              
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-primary save_menu ">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  
                </div>
            </form>
          </div>
          
        </div>
    </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- <script src="{{asset('public/js/jquery.nestable.js')}}"></script> -->
    
   <script type="text/javascript">
       $(function(){
        var updateOutput = function(e)
        {
            
            var order = new Array();
            $("li[data-id='"+e.destId +"']").find('ol:first').children().each(function(index,elem) {
                order[index] = $(elem).attr('data-id');
            });
             if (order.length === 0){
                var rootOrder = new Array();
                $("#nestable > ol > li").each(function(index,elem) {
                  rootOrder[index] = $(elem).attr('data-id');
                });
               }
            var data_id = window.location.hostname + '.nestable';
            var drag_data = JSON.stringify($('.dd').nestable('serialize'));
            var a = JSON.parse(drag_data);
            // alert(drag_data);
            var storage_data = localStorage.getItem(data_id);
            if (drag_data === storage_data) {
                return false;
            }
            localStorage.setItem(data_id, drag_data);
            $.ajax({
                type: 'POST',
                url: baseUrl() + '/menu/drag',
                data: {
                    // sourceId : e.sourceId,
                    // destinationId: e.destId,
                    order: order,
                    drag_data: drag_data,
                    rootOrder: rootOrder,
                    _token: window.token
                },
                success: function(res){

                }
            });
        }

            $('.dd').nestable({
                maxDepth: 5,
                
            }).on('change', updateOutput);
       });
   </script>
    




    
<script>
    function getEditMenu(id)
    {
        $.ajax({
            type: 'GET',
            url: baseUrl() + '/menu/edit/' + id,
            data: { id: id },
            cache: false,
            success: function(res){
                $('.edit_data').html(res);
            }
        });
        
    }
$(document).ready(function()
{
    // create menu
    $('#form_create_menu').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData;
        formData.append('_name', e.target.name.value);
        formData.append('_slug', e.target.slug.value);
        formData.append('_token', token);
        $.ajax({
            type: 'POST',
            url: window.createMenu,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                $('#nestable').html(res);
                $('#myModal').modal('hide');
                $('#name_modal').val('');
                $('#slug_modal').val('');
            }
          });
    });

    //getEdit menu
    

    // postEdit Menu
    $('#form_edit_menu').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData();
        formData.append('_name', e.target.name.value);
        formData.append('_slug', e.target.slug.value);
        formData.append('_id', e.target.id_menu.value);
        formData.append('_token', token);
        $.ajax({
            type: 'POST',
            url: window.postEditMenu,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                console.log(res);
                $('#myModalEdit').modal('hide');
                $('#nestable').html(res);
                $('#name_modal').val('');
                $('#slug_modal').val('');
                $('.id_menu').val('');
            }
          });
    })


// delete menu
    $('.delete_menu').click(function(){
        var id = $(this).attr('rel');
        var formData = new FormData;
        formData.append('_id', id);
        formData.append('_token', token);
        $.ajax({
            type: 'GET',
            url: 'menu/delete/' + id,
            cache: false,
            data:formData,
            contentType: false,
            processData: false,
            success:function(res){
                
            }
        });
    });



    //end create menu
    


});
</script>


@endsection