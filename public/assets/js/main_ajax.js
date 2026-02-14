$(function () {
    var uRL = $('.demo').val();

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.modal').on('hidden.bs.modal', function(e) {
        $(this).find('form')[0].reset();
      });

    $('.change-logo').click(function () {
        $('.change-com-img').click();
    });

    // delete data common function
    function destroy_data(name, url) {
        var el = name;
        var id = el.attr('data-id');
        var dltUrl = url + id;
        if (confirm('Are you Sure Want to Delete This')) {
            $.ajax({
                url: dltUrl,
                type: "DELETE",
                cache: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        el.parent().parent('tr').remove();
                    } else {
                        Toast.fire({
                            icon: 'danger',
                            title: dataResult
                        })
                    }
                }
            });
        }
    }

    function show_formAjax_error(data) {
        console.log(data);
        if (data.status == 422) {
             $('.error').remove();
            $.each(data.responseJSON.errors, function (i, error) {
                var el = $(document).find('[name="' + i + '"]');
                el.after($('<span class="error">' + error[0] + '</span>'));
                console.log(error[0]);
            });
        }
    }

    // ========================================
    // script for Admin Logout
    // ========================================

    $('.admin-logout').click(function () {
        $.ajax({
            url: uRL + '/admin/logout',
            type: "GET",
            cache: false,
            success: function (dataResult) {
                if (dataResult == '1') {
                    setTimeout(function () {
                        window.location.href = uRL + '/admin';
                    }, 500);
                    Toast.fire({
                        icon: 'success',
                        title: 'Logged Out Succesfully.'
                    })
                }
            }
        });
    });

    // ========================================
    // script for Users module
    // ========================================
    $(document).on("click", ".block-user", function () {
        var status = $(this).attr('data-status');
        var id = $(this).attr('data-id');
        var user = $(this).attr('data-user');
        $.ajax({
            url: uRL + '/admin/users/change-status', 
            type: "POST",
            data:  {status:status, id:id },
            cache: false,
            success: function (dataResult) {
                if (dataResult == '1') {
                    setTimeout(function () {
                        if(user == 'provider'){
                            window.location.href = uRL + '/admin/providers';
                        }else{
                            window.location.href = uRL + '/admin/users';
                        }
                    }, 1000);
                    Toast.fire({
                        icon: 'success',
                        title: 'Status Changed Succesfully.'
                    })
                }
            }
        });
    });

    // ========================================
    // script for Category module
    // ========================================

    $('#add_category').validate({
        rules: { category: { required: true }, },
        messages: { category: { required: "Please Enter Category Name" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/category',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        $('#modal-default').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Category Added Succesfully.'
                        });
                        setTimeout(function () { window.location.reload(); }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on('click', '.edit_category', function () {
        var id = $(this).attr('data-id');
        var dltUrl = 'category/' + id + '/edit';
        $.ajax({
            url: dltUrl,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info  #edit_category').html(dataResult);
                $('#modal-info').modal('show');
            }, error: function (dataResult) {
                show_formAjax_error(dataResult);
            }
        });
    });

    $("#edit_category").validate({
        rules: { 
            category: { required: true }, 
            category_slug: { required: true }, 
            status: { required: true }, 
        },
        messages:{ 
            category: { required: "Please Enter Category Name" }, 
            category_slug: { required: "Please Enter Category Slug" }, 
            status: { required: "Please Enter Status" }, 
        },
        submitHandler: function (form) {
            var id = $('#modal-info input[name=id]').val();
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/category' + '/' + id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        $('#modal-info').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Category Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.reload(); }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-category", function () {
        destroy_data($(this), ' category/')
    });

       // ========================================
    // script for Provider Type module
    // ========================================

    $('#add_providerType').validate({
        rules: { provider_type: { required: true } },
        messages: { provider_type: { required: "Please Enter Provider Type Name" } },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/provider_types',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        $('#modal-default').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Succesfully.'
                        });
                        setTimeout(function () { window.location.reload(); }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on('click', '.edit_providerType', function () {
        var id = $(this).attr('data-id');
        var dltUrl = 'provider_types/' + id + '/edit';
        $.ajax({
            url: dltUrl,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=id]').val(dataResult[0].type_id);
                $('#modal-info input[name=provider_type]').val(dataResult[0].provider_type);
                $("#modal-info select[name=status] option").each(function () {
                    if ($(this).val() == dataResult[0].status) {
                        $(this).attr('selected', true);
                    }
                });
                $('#modal-info .u-url').val($('#modal-info .u-url').val() + '/' + dataResult[0].type_id);
                $('#modal-info').modal('show');
            }
        });
    });

    $("#edit_providerType").validate({
        rules: {
            provider_type: { required: true },
            status: { required: true }, 
        },
        messages: { 
            provider_type: { required: "Please Enter Provider Type Name" },
            status: { required: "Please Enter Status" }, 
        },
        submitHandler: function (form) {
            var id = $('#modal-info input[name=id]').val();
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/provider_types' + '/' + id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        $('#modal-info').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.reload(); }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-providerType", function () {
        destroy_data($(this), ' provider_types/')
    });

     // ========================================
    // script for Providers module
    // ========================================
    $('#addProvider').validate({
        rules: {
            provider_name: { required: true },
            email: { required: true },
            phone: { required: true },
            city: { required: true },
            provider_type: { required: true },
            "service": { required: true },
        },
        messages: {
            provider_name: { required: "Please Enter Provider Name" },
            email: { required: "Please Enter Email address" },
            phone: { required: "Please Enter Phone Number" },
            city: { required: "Please Select City" },
            provider_type: { required: "Please Select Type" },
        },

        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/providers',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/providers'; }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $('#updateProvider').validate({
        rules: {
            provider_name: { required: true },
            email: { required: true },
            phone: { required: true },
            city: { required: true },
            provider_type: { required: true },
            service: { required: true },
            status: { required: true },
        },
        messages: {
            provider_name: { required: "Please Enter Provider Name" },
            email: { required: "Please Enter Email address" },
            phone: { required: "Please Enter Phone Number" },
            city: { required: "Please Select City" },
            provider_type: { required: "Please Enter Provider Type Name" },
            service: { required: "Please Select Service" },
            status: { required: "Please Enter Status" },
        },

        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/providers'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-provider", function () {
        destroy_data($(this), 'providers/')
    });

    // ========================================
    // script for Service module
    // ========================================
    $('#addService').validate({
        rules: {
            service: { required: true },
            category: { required: true },
            service_description: { required: true },
        },
        messages: {
            service: { required: "Please Enter Service Name" },
            category: { required: "Please Enter Category Name" },
            service_description: { required: "Please Enter Service Description" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/services',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Service Added Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/services'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $('#EditService').validate({
        rules: {
            service: { required: true },
            service_slug: { required: true },
            category: { required: true },
            service_description: { required: true },
            status: { required: true },
        },
        messages: {
            service: { required: "Please Enter Service Name" },
            service_slug: { required: "Please Enter Service Slug Name" },
            category: { required: "Please Enter Category Name" },
            service_description: { required: "Please Enter Service Description" },
            status: { required: "Please Enter Service Status" },
        },

        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Service Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/services'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-service", function (){
        destroy_data($(this), 'services/')
    });

    $(document).on('click','.approve-service',function(){
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        $.ajax({
            url: 'services/approve',
            type: 'POST',
            data: {id:id,status:status},
            success: function (dataResult) {
                console.log(dataResult);
                if (dataResult == '1'){
                    Toast.fire({
                        icon: 'success',
                        title: 'Saved Succesfully.'
                    });
                    setTimeout(function () { window.location.href = uRL + '/admin/services'; }, 1000);
                }
            },
            error: function (error) {
                show_formAjax_error(error);
            }
        });
    });



      // ========================================
    // script for City module
    // ========================================

    $('#add_city').validate({
        rules: { city: { required: true } },
        messages: { city: { required: "Please Enter City Name" } },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/city',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        $('#modal-default').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Succesfully.'
                        });
                        setTimeout(function () { window.location.reload(); }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on('click', '.edit_city', function () {
        var id = $(this).attr('data-id');
        var dltUrl = 'city/' + id + '/edit';
        $.ajax({
            url: dltUrl,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=id]').val(dataResult[0].city_id);
                $('#modal-info input[name=city_1]').val(dataResult[0].city_name);
                $('#modal-info .u-url').val($('#modal-info .u-url').val() + '/' + dataResult[0].city_id);
                $('#modal-info').modal('show');
            },
            error: function (error) {
                show_formAjax_error(error);
            }
        });
    });

    $("#edit_city").validate({
        rules: { city_1: { required: true } },
        messages: { city_1: { required: "Please Enter City Name" } },
        submitHandler: function (form) {
            var id = $('#modal-info input[name=id]').val();
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/city' + '/' + id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        $('#modal-info').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.reload(); }, 1000);
                    }
                },
                error: function (error) {
                    console.log(error);
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-city", function () {
        destroy_data($(this), ' city/')
    });

    
    // ========================================
    // script for General Setting module
    // ========================================

    $('#updateGeneralSetting').validate({
        rules: {
            com_name: { required: true },
            com_email: { required: true },
            address: { required: true },
            phone: { required: true },
            copyright: { required: true },
            cur_format: { required: true },
            min_add: { required: true },
        },
        messages: {
            com_name: { required: "Company Name is Required" },
            com_email: { required: "Company Email is Required" },
            address: { required: "Company Address is Required" },
            phone: { required: "Company Phone is Required" },
            copyright: { required: "Copyright Text is Required" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/general-settings',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/general-settings'; }, 1000);
                    }else if (dataResult == '0') {
                        Toast.fire({
                            icon: 'info',
                            title: 'Already Updated.'
                        });
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    // ========================================
    // script for Admin  module
    // ========================================

    $('#updateProfileSetting').validate({
        rules: {
            admin_name: { required: true },
            email: { required: true },
            username: { required: true },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/profile-settings',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/profile-settings'; }, 1000);
                    }else if(dataResult == '0'){
                        Toast.fire({
                            icon: 'info',
                            title: 'Already Updated'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/profile-settings'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });


    $('#updatePassword').validate({
        rules: {
            password: { required: true },
            new: { required: true },
            new_confirm: { required: true,equalTo:'#password' },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/change-password',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/profile-settings'; }, 1000);
                    }else if(dataResult == '0'){
                        Toast.fire({
                            icon: 'info',
                            title: 'Already Updated'
                        });
                    }else{
                        Toast.fire({
                            icon: 'warning',
                            title: dataResult
                        });
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    // ========================================
    // script for Banner Setting module
    // ========================================

    $('#updateBannerSetting').validate({
        rules: {
            title: { required: true },
            sub_title: { required: true },
        },
        messages: {
            title: { required: "Title Name is Required" },
            sub_title: { required: "Banner Sub Title is Required" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/banner',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/banner'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    // ========================================
    // script for Social Links  module
    // ========================================

    $('#updateSocialSetting').validate({
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/social-settings',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Social Setting Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/social-settings'; }, 1000);
                    }else if (dataResult == '0') {
                        Toast.fire({
                            icon: 'info',
                            title: 'Already Updated.'
                        });
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });
    // ========================================
    // script for Commission  module
    // ========================================

    $('#updateCommission').validate({
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/commission',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/commission'; }, 1000);
                    }else if (dataResult == '0') {
                        Toast.fire({
                            icon: 'info',
                            title: 'Already Updated.'
                        });
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    // ========================================
    // script for Page module
    // ========================================
    $('#addPage').validate({
        rules: {
            page_title: { required: true },
            page_content: { required: true },
        },
        messages: {
            page_title: { required: "Please Enter Page Title Name" },
            page_content: { required: "Please Enter Page Content Description" },
           
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/pages',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Page Added Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/pages'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $('#EditPage').validate({
        rules: {
            page_title: { required: true },
            page_slug: { required: true },
            page_content: { required: true },
            status: { required: true },
        },
        messages: {
            page_title: { required: "Please Enter Page Title Name" },
            service_slug: { required: "Please Enter Page Slug Name" },
            page_content: { required: "Please Enter Page Content Description" },
            status: { required: "Please Enter Page Status" },
        },

        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Page Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/pages'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-page", function (){
        destroy_data($(this), 'pages/')
    });




    $(document).on('click','.complete-payout-request',function(){
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        if(confirm('Are you Sure Want to Complete This Request.')){
            $.ajax({
                url: uRL+'/admin/complete_payout_request',
                type: 'POST',
                data: {id:id,status:status},
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.reload(); }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    })

    $(document).on('click','.change-pay-method-status',function(){
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        $.ajax({
            url: uRL+'/admin/payment_methods',
            type: 'POST',
            data: {id:id,status:status},
            success: function (dataResult) {
                console.log(dataResult);
                if (dataResult == '1') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Updated Succesfully.'
                    });
                    setTimeout(function () { window.location.reload(); }, 1000);
                }
            },
            error: function (error) {
                show_formAjax_error(error);
            }
        });
    })

});