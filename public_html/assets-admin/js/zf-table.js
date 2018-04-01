(function(jQuery) {
      jQuery.fn.zfTable = function(url , options) {

        var initialized = false;

        var defaults = {


            beforeSend: function($obj){
                $obj.append('<div class="processing" style=""></div>');
            },
            success: function($obj){},
            error: function(){},
            complete: function(){
                $('.icheck').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });

                //When unchecking the checkbox
                $("#check-all").on('ifUnchecked', function (event) {
                    //Uncheck all checkboxes
                    $(".check_acao", ".table").iCheck("uncheck");

                });

                //When checking the checkbox
                $("#check-all").on('ifChecked', function (event) {
                    //Check all checkboxes
                    $(".check_acao", ".table").iCheck("check");

                });

            },

            onInit: function(){},
            sendAdditionalParams: function(){ return '';}


        };

        var options = $.extend(defaults, options);

        function strip(html){
            var tmp = document.createElement("DIV");
            tmp.innerHTML = html;
            return tmp.textContent || tmp.innerText || "";
        }

        function init($obj) {
            options.onInit();
            ajax($obj);
        }
        function ajax($obj) {

            jQuery.ajax({
                url: url,
                data: $obj.find(':input').serialize() + options.sendAdditionalParams(),
                type: 'POST',
                beforeSend: options.beforeSend( $obj ) ,
                success: function(data) {
                    $obj.html('');
                    $obj.html(data);
                    initNavigation($obj,options);
                    initBtnRange($obj,options);
                    initBtnDelete($obj,options);
                    options.success($obj);
                },
                error : function(e){ options.error( e )},
                complete : function(e){ options.complete( e )},
                dataType: 'html'
            });

        }

          function initBtnRange($obj,options){
              if($('#daterange-btn').length){
                  moment.locale('pt-br');
                  $('#daterange-btn').daterangepicker(
                      {
                          ranges   : {
                              'Hoje'       : [moment(), moment()],
                              'Ontem'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                              'Ultimos 7 Dias' : [moment().subtract(6, 'days'), moment()],
                              'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
                              'Este Mês'  : [moment().startOf('month'), moment().endOf('month')],
                              'Ultimo Mês'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                          },
                          locale : {
                              applyLabel: 'Aplicar',
                              cancelLabel: 'Cancelar',
                              customRangeLabel: 'Perssonalizado'
                          },
                          startDate: moment().subtract(29, 'days'),
                          endDate  : moment()
                      },
                      function (start, end) {
                          $('#daterange-btn span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
                          $obj.find('input[name="zfTableStartDate"]').val(start.format('YYYY-MM-DD'));
                          $obj.find('input[name="zfTableEndDate"]').val(end.format('YYYY-MM-DD'));
                          ajax($obj);
                      }
                  )
              }
          }
        function initNavigation($obj,options){
            var _this = this;

            $obj.find('table th.sortable').on('click',function(e){
                $obj.find('input[name="zfTableColumn"]').val(jQuery(this).data('column'));
                $obj.find('input[name="zfTableOrder"]').val(jQuery(this).data('order'));
                ajax($obj);
            });
            $obj.find('.pagination').find('a').on('click',function(e){
                $obj.find('input[name="zfTablePage"]').val(jQuery(this).data('page'));
                e.preventDefault();
                ajax($obj);
            });
            $obj.find('.itemPerPage').on('change',function(e){
                $obj.find('input[name="zfTableItemPerPage"]').val(jQuery(this).val());
                ajax($obj);
            });

            $obj.find('.valuesState').on('change',function(e){
                $obj.find('input[name="zfTableStatus"]').val(jQuery(this).val());
                ajax($obj);
            });

            $obj.find('input.filter').on('keypress',function(e){
                if(e.which === 13) {
                    e.preventDefault();
                    ajax($obj);
                }
            });
            $obj.find('select.filter').on('change',function(e){
                e.preventDefault();
                ajax($obj);
            });
            $obj.find('.quick-search').on('keypress',function(e){
                if(e.which === 13) {
                    e.preventDefault();
                    $obj.find('input[name="zfTableQuickSearch"]').val(jQuery(this).val());
                    ajax($obj);
                }
            });

            $obj.find('a.actions').on('click', function (e) {
                e.preventDefault();
                var checked = 0;
                $(".table input[type='checkbox']").each(function (i, element) {
                    // Aplica a cor de fundo
                    if (element.checked) {
                        checked = 1;
                    }
                });
                if (checked) {
                    jQuery.ajax({
                        url: $(this).attr('href'),
                        data: $obj.find("input[type='checkbox']").serialize(),
                        type: 'POST',
                        beforeSend: options.beforeSend($obj),
                        success: function (data) {
                            if(data.type=="success"){
                                toastr.success(data.msg);
                            }
                            if(data.type=="error"){
                                toastr.error(data.msg);
                            }
                            ajax($obj);
                        },
                        dataType: 'json'
                    });
                }
            });

        }


          function initBtnDelete($obj,options) {

              if ($('.j_confirm_delete').length) {
                  $('.j_confirm_delete').click(function () {
                      $this = $(this);
                      $.confirm({
                          columnClass: 'col-md-6 col-xs-12 col-md-offset-3 col-xs-offset-0',
                          icon: 'fa fa-warning',
                          title: "Deletar Item",
                          content: "Tem certeza que deseja excluir este registro?",
                          type: 'red',
                          buttons: {
                              info: {
                                  text: 'Enviar p/ lixeira',
                                  btnClass: 'btn btn-blue btn-flat btn-xs',
                                  action: function(){
                                      excluirDefinitivamente($this,$obj,options,$this.attr('href').replace('action','state').replace('id','3'));
                                   }
                              },
                              danger: {
                                  text: 'Excluir?',
                                  btnClass: 'btn btn-red btn-flat  btn-xs', // multiple classes.
                                  action: function(){
                                      excluirDefinitivamente($this,$obj,options,$this.attr('href').replace('action','delete').replace('id',$this.attr('data-state')));

                                  }
                              },
                              cancelAction: {
                                  text: 'Fechar',
                                  btnClass: 'btn btn-warning btn-flat  btn-xs',
                                  action: function(){

                                  }
                              },
                          }
                      });

                      return false;
                  });
              }
          }

          function excluirDefinitivamente($this,$obj,options,$action) {
              $.ajax({
                  url:$action,
                  data: {'id':$this.attr('data-state')},
                  type:'post',
                  beforeSend:options.beforeSend($obj),
                  success:function (data) {
                      ajax($obj);
                  }
              });
          }
        return this.each(function() {
            var $this = jQuery( this );
            if(!initialized){
                init($this);
            }

        });
    };

})(jQuery);
