/*
David
*/ 


var UIAjax = function () {
 

    var initCalls = function () {  

        

        var operation = function(event){
            event.preventDefault();
            // let model = $(this).data('model');
            // let models = $('.' + model + ':last-child').children()[0];

            $.post(this.href,function(data){
                /*hardcode de momento para pedidos*/ 
                if(data.id)
                $('.pedidos_listado')
                .prepend('<tr><td>'+data.id+'</td><td>'+data.fechaCreacion.date+'</td><td>0</td><td><a class="btn blue" >agregar a este pedido</a></td></tr>');
            });
            return false;
        }

        


		$('.ajax_btn').on('click', operation );

        $('.ajax_btn_confirmation').confirmation({
            onConfirm:operation,
            popout:true,
            btnOkLabel:'<i class="icon-ok-sign icon-white"></i> Si',
            btnOkClass: 'btn green',
            btnCancelClass: 'btn red'
        });

		return false;    
    }

    return {
        //main function to initiate the module
        init: function () {
            initCalls();
        }
    };

}();