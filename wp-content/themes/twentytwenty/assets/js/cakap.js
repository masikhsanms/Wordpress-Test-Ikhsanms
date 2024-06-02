$(document).ready(function(){
    form_product_cat();
    function form_product_cat(){
        $(document).on('submit','#frm-productcat-cakap',function(e){
            e.preventDefault();
            let root = $(this);
            let data = root.serializeArray();
                data.push({
                    'name' : 'action',
                    'value' : 'simpan_form_productcat'
                });
            
            if(  root.find('button[type="submit"]').data('id') != null || root.find('button[type="submit"]').data('id') != undefined ){
                data.push({
                    'name' : 'id',
                    'value' : root.find('button[type="submit"]').data('id')
                });
            }

            $.ajax({
                url:cakap.ajaxurl,
                data:data,
                type:'POST',
                cache: false,
                dataType:'JSON',
                beforeSend:function(){
                   root.find('button[type="submit"]').attr('disabled',true);
                    // $(document).find('.wrap-table').html('<p class="text-center">Sedang Proses ...</p>');
                },
                success:function(response){
                    notif(response.msg,response.txt);
                    // ajax_list();
                    $('#dt-cakap').DataTable().ajax.reload();
                    $('#frm-productcat-cakap').find('input[name="mode"]').val('add');
                    root.find(".buttonform").html('<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>');
                    $('#frm-productcat-cakap')[0].reset();

                },
                error:function(xhr){
                    alert('Sorry Problem Server ...'+xhr.status);
                    return false;
                }
            });
        }); 
    }

    editproduct();
    function editproduct(){
        $(document).on('click','.editproduct',function(e){
            e.preventDefault();
            let root = $(this);
            let data = {action:'editproduct',id:root.data('id')};

            $.ajax({
                url:cakap.ajaxurl,
                data:data,
                type:'POST',
                dataType:'JSON',
                success:function(response){
                    // console.log(response);
                    if( response != null ){
                        $('#frm-productcat-cakap').find('input[name="product_category_name"]').val(response.product_category_name);
                        $('#frm-productcat-cakap').find('textarea[name="product_category_desc"]').val(response.product_category_desc);
                        $('#frm-productcat-cakap').find('input[name="product_category_status"]').val(response.product_category_status);
                        if(response.product_category_status == 1 ){
                            $('#frm-productcat-cakap').find('input[name="product_category_status"]').attr('checked',true);
                        }else{
                            $('#frm-productcat-cakap').find('input[name="product_category_status"]').removeAttr('checked');
                        }

                        $('#frm-productcat-cakap').find('button[type="submit"]').attr('data-id',response.unique_id);
                        $('#frm-productcat-cakap').find('input[name="mode"]').val('edit');

                    }
                    // notif(response.msg,response.txt);
                    // ajax_list();
                    // root.find('button[type="submit"]').removeAttr('disabled');
                    // $("#frm-productcat-cakap")[0].reset();

                },
                error:function(xhr){
                    alert('Sorry Problem Server ...'+xhr.status);
                    return false;
                }
            });
        });
    }

    deleteproduct();
    function deleteproduct(){
        $(document).on('click','.deleteproduct',function(e){
            e.preventDefault();
            let root = $(this);
            let data = {action:'deleteproduct',id:root.data('id')};
            
            Swal.fire({
                title: "Do you want to Delete ?",
                showCancelButton: true,
                confirmButtonText: "Yes",
                showCancelButtonText: "Cancel"
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url:cakap.ajaxurl,
                        data:data,
                        type:'POST',
                        dataType:'JSON',
                        success:function(response){
                            notif(response.msg,response.txt);
                            // ajax_list();
                            $('#dt-cakap').DataTable().ajax.reload();
                        },
                        error:function(xhr){
                            alert('Sorry Problem Server ...'+xhr.status);
                            return false;
                        }
                    });
                }
              });
            
            
        }); 
    }

    ajax_list_serverside();
    function ajax_list_serverside(){
        jQuery('#dt-cakap').DataTable({
            bProcessing: true,
            autoWidth: false,
            serverSide: true,
            stateSave: true,
            paging: true,
            searching: { "regex": true },
            deferRender: true,
            columnDefs: [ 
                { 
                    'targets': 0, 
                    'orderable': true,
                    'searchable': false,
                },
                { 
                    'targets': 1, 
                    'orderable': true,
                },
                { 
                    'targets': 2, 
                    'orderable': false,
                },
                { 
                    'targets': 3, 
                    'orderable': false,
                },
             ],
            ajax: {
                url:cakap.ajaxurl + '?action=ajax_list_serverside',
                type:'post'
            },
            fnRowCallback: function (nRow, aData, iDisplayIndex) {  
                var info = $(this).DataTable().page.info();
                // $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
                return nRow;
            },
            fnInitComplete: function(oSettings, json) {
                // load_tooltip();
            }
            
        });
    }

    // var ajaxCallIsComplete = false;
    var page = 1;

    $(window).on('scroll', scroll_list);
    
    scroll_list();
    function scroll_list(){
            var end = $("#site-content").offset().top;
            var viewEnd = $(window).scrollTop() + $(window).height();
            var distance = end - viewEnd;

            if (distance < 300)  {
                // unbind to prevent excessive firing
                $(window).off('scroll', scroll_list);
                // console.log('we reached the bottom');
            
                $.ajax({
                    url:cakap.ajaxurl,
                    data:{action:'scroll_list',page:page},
                    type:'POST',
                    dataType:'JSON',
                    success:function(response){
                        console.log(response);
                        if( response != null ){
                            let html = '';
                            $.each(response, function(index, item) {
                                html += `<div class="card mb-4">
                                    <div class="card-header fw-bold">`+item.product_category_name+`</div>
                                    <div class="card-body">`+item.product_category_desc+`</div>
                                    </div>`; 
                                    
                            });
                            $('.wrap-list').append(html).fadeIn();

                            // rebind after successful update
                            $(window).on('scroll', scroll_list);
                            page++; 
                            
                        }
                    },
                    error:function(xhr){
                        alert('Sorry Problem Server ...'+xhr.status);
                        return false;
                    }
                });
            }

    }

});

function notif(msg,txt){
    Swal.fire({
        text: txt,
        icon: msg,
        showConfirmButton: false,
        timer: 1500
    });
}