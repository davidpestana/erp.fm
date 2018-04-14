var UIModals = function () {

    var tableconfig = {           
            "aoColumnDefs": [
                { "aTargets": [ 0 ]}
            ],
            "aaSorting": [[0, 'asc']],
             "aLengthMenu": [
                [5, 15, 20, -1],
                [5, 10, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 10,
            "oLanguage": {
                       "sSearch": "Filtrar"
                     }
        }

    var collectionHolder = null;

    var initHolders = function(){
        if($('#fm_erpbundle_factura_misitems').length)
//        if(typeof $('#fm_erpbundle_factura_misitems') != '') return false;
        collectionHolder = $(fm_erpbundle_factura_misitems);
        else 
        collectionHolder = [];
    }   

    function addTagForm(collectionHolder,index) {
        var prototype = collectionHolder.data('prototype');
        var newForm = prototype.replace(/__name__/g, index);
        var $newFormLi = $('<div/>').append(newForm);
        collectionHolder.append($newFormLi);
        return $newFormLi;
    }
    function searchMe(id){
        var result = true;
        $.each($('.piece',collectionHolder),function(index,item){
                    if( $('input',item)[4].value === id){ 
                         $('input',item)[1].value ++;
                         result = false;
                    }     
        });
        return result;
    }

    var agregar = function(){
                if(searchMe(this.id)){
                    nuevo = addTagForm(collectionHolder,this.id);         
                    $('input',nuevo)[0].value = $('.concepto',this).html();
                    $('input',nuevo)[1].value = 1;
                    $('input',nuevo)[3].value = $('.descuento',this).html();
                    $('input',nuevo)[2].value = $('.precio',this).html();
                    $('input',nuevo)[4].value = this.id;
                }
            }   

    var initModals = function () {       
       	$.fn.modalmanager.defaults.resize = true;
		$.fn.modalmanager.defaults.spinner = '<div class="loading-spinner fade" style="width: 200px; margin-left: -100px;"><img src="/assets/img/ajax-modal-loading.gif" align="middle">&nbsp;<span style="font-weight:300; color: #eee; font-size: 18px; font-family:Open Sans;">&nbsp;Loading...</div>';
       	var $modal = $('#ajax-modal');
 
        var operation = function(){
            $('body').modalmanager('loading');
            $modal.load(this.href,'',function(){ 
                $modal.modal();
                initHolders();
                var t = initTables('#sample_modal');
                UIAjax.init();
                if(t.length) t.$('.producto').click(agregar);   

                // select2 & multiSelect
               $("select").each(function() {

                    if(this.multiple){
                            $(this).multiSelect();

                    }else{
                          var select2_options = {
                            //theme: 'bootstrap',
                            minimumResultsForSearch: 5
                          };
                          var parent = $(this).closest('.modal');
                          //console.log('a',this.multiple);
                          if (parent.length) {
                            select2_options.dropdownParent = parent;
                          }

                          $(this).select2(select2_options);
                    }
                });



            });
            return false;
        }

		$('.modal_ajax_btn').on('click', operation );

        $('.modal_ajax_btn_confirmation').confirmation({
            onConfirm:operation,
            popout:true,
            btnOkLabel:'<i class="icon-ok-sign icon-white"></i> Si',
            btnOkClass: 'btn green',
            btnCancelClass: 'btn red'

        });

		return false;    
    }


    var initTables = function(sample){
        let orderstring = $(sample).attr('data-order');
        //console.log($(sample));
        let order = (orderstring) ? JSON.parse(orderstring) : false;
        //console.log(order);

        if(order) tableconfig.aaSorting = [order,"desc"];
        var tables = $(sample).dataTable(tableconfig);
        return tables;
    }

    return {
        //main function to initiate the module
        init: function () {
            initModals();
            initTables('.table');
        }

    };

}();