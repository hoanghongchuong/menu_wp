$(document).ready(function($){

        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": false,
          "progressBar": false,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }

    $('.btn-addcartx').click(function(event) {
        var id = $(this).attr('data-id');
        var qty = 1;
        $.ajax({
            url: window.urlAddCart,
            type: 'POST',
            cache: false,
            data: {
                qty:qty,
                id:id,
                _token: window.token
            },
            success: function(res){
                if(res >= 0){
                    toastr["success"]("Thêm vào giỏ hàng thành công!");
                    $('#count_cart').html(res);                    
                }
            }
        });
    });

    $('.sort-by').change(function(event) {
      var queryOject = getQueryObject();
      var sortType = $(this).val();
       queryOject.query.sort = sortType;
       refreshUrl(queryOject)
    });

    window.getQueryObject = function() {
        var urlArray = window.location.href.split('?');
        var result = {
            origin: urlArray[0],
            query: {}
        };
        if (urlArray.length == 1) {
            return result;
        }
        var queryArray = urlArray[1].split('&');

        for (var i = 0; i < queryArray.length; i++) {
            var item = queryArray[i].split('=');
            if (item.length != 0) {
                result.query[item[0]] = item[1] ? item[1] : '';
            }
        }
        return result;
    }

    window.refreshUrl = function(queryObject) {
        queryObject.origin += '?';
        for (var i in queryObject.query) {
            queryObject.origin += i + '=' + queryObject.query[i] + '&';
        }
        window.location.href = queryObject.origin.replace(/.$/,"");
    }
    $(function() {
        $(".bank-input").click(function(){
            $('.toHide').hide();
            $("#input-"+$(this).val()).toggle('slow');
        });
    });



});