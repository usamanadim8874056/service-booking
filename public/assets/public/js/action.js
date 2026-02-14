// const { countBy } = require("lodash");

$(document).ready(function(){

    var uRL = $('.demo').val();

    function show_formAjax_error(data){
        if (data.status == 422) {
            $('.error').remove();
            $.each(data.responseJSON.errors, function (i, error) {
                var el = $(document).find('[name="' + i + '"]');
                el.after($('<span class="error">' + error[0] + '</span>'));
            });
        }
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // ========================================
    // script for User Login module
    // ========================================

    $('#user-login').validate({
        rules: {
            email: { required: true },
            password: { required: true }
        },
        messages: {
            email: { required: "Email Address is required" },
            password: { required: "Password is required" }
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/login',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                   if (dataResult == '1') {
                        $('.message').html('<div class="alert alert-success">Logged In Succesfully.</div>');
                        setTimeout(function(){ window.location.href = uRL; }, 3000);
                    } else {
                       $('.message').html('<div class="alert alert-danger">'+dataResult+'</div>');
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                }
            });
        }
    });

    // ========================================
    // script for User SignUp module
    // ========================================

    $('#user-signup').validate({
        rules: {
            user_name: { required: true },
            phone: { required: true },
            email: { required: true },
            password: { required: true },
        },
        messages: {
            user_name: { required: "Name is required" },
            phone: { required: "Phone Number is required" },
            email: { required: "Email Address is required" },
            password: { required: "Password is required" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL+'/signup',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        $('.message').append('<div class="alert alert-success">Your Account Created Successfully. Please Login with Email and Password.</div>');
                        setTimeout(function(){ window.location.href = uRL+'/login'; }, 3000);
                    } else {
                       $('.message').append('<div class="alert alert-danger">'+dataResult+'</div>');
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                }
            });
        }
    });

    // ========================================
    // script for Update Profile module
    // ========================================

    $('.browse-user').click(function(){
        $('#user-image').trigger('click');
    })

    $(document).on('click', '.ShowProfile', function () {
        $('#exampleModal').modal('show');
    });

    $('#update-profile').validate({
        rules: {
            user_name: { required: true },
            user_phone: { required: true },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('.message').empty();
            $.ajax({
                url: uRL + '/profile',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        console.log(dataResult);
                        $('.message').append('<div class="alert alert-success">Profile Updated Succesfully.</div>');
                        setTimeout(function () { $('.message').remove(); }, 1500);
                    } else {
                        $('.message').append('<div class="alert alert-danger">' + dataResult + '</div>');
                    }
                },
                error: function (dataResult) {
                    show_formAjax_error(dataResult);
                }
            });
        }
    });

   // ========================================
    // script for User ContactUs module
    // ========================================

    $('#addContact').validate({
        rules: {
            user_name: { required: true },
            email: { required: true },
            phone: { required: true },
            description: { required: true }
        },
        messages: {
            user_name: { required: "Please Enter Your Name" },
            email: { required: "Please Enter Your Email address" },
            phone: { required: "Please Enter Your Phone" },
            description: { required: "Please Enter Your Message" }
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/contact',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        $('.message').append('<div class="alert alert-success"> Your Message Sended Successfully.</div>');
                        setTimeout(function () { window.location.href = uRL + '/contact'; }, 3000);
                    } else {
                        $('.message').append('<div class="alert alert-danger">' + dataResult + '</div>');
                    }
                },
                error: function (data) {
                    show_formAjax_error(data)
                }
            });
        }
    });


    // ========================================
    // script for Change Password User module
    // ========================================
    $('#updatePassword').validate({
        rules: {
            password: { required: true },
            new_pass: { required: true },
            new_confirm: { required: true }
        },
        messages: {
            password: { required: "Password is required" },
            new_pass: { required: "New Password is required" },
            new_confirm: { required: "New Confirm Password is required" }
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('.message').empty();
            $.ajax({
                url: uRL + '/change-password',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        $('.message').append('<div class="alert alert-success">Password Changed Succesfully.</div>');
                        setTimeout(function(){ window.location.href = uRL + '/profile'; }, 3000);
                    }
                    else {
                       $('.message').append('<div class="alert alert-danger">'+dataResult+'</div>');
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                }
            });
        }
    });

    // function search_filter(){
    //      alert(1);



    //     var sort = $('select[name=sort] option:selected').val();
    //     var min_price = $('input[name=price_min]').val();
    //     var max_price = $('input[name=price_max]').val();

    //     if(max_price < min_price){
    //         alert('Please Enter Correct Min - Max Price');
    //     }else{
    //         $('.search-res-list').append(loader);
    //         $.ajax({
    //             url: uRL + '/search-filter',
    //             type: "POST",
    //             data: {sort:sort,min_price:min_price,max_price:max_price},
    //             cache: false,
    //             success: function (dataResult) {
    //                 console.log(dataResult['count']);
    //                 setTimeout(function(){
    //                     $('.search-res-list').html(dataResult['data']);
    //                     // $('.count').html(dataResult['count']);
    //                 },2000)
    //             }
    //         });
    //     }
   // }


   $('#add-service').validate({
        rules: {
            s_title: { required: true },
            s_cat: { required: true },
            s_amount: { required: true },
            s_location: { required: true },
            s_desc: { required: true },
        },
        messages: {
            s_title: { required: "Title is Required" },
            s_cat: { required: "Category is Required" },
            s_amount: { required: "Amount is Required" },
            s_location: { required: "Location is Required" },
            s_desc: { required: "Description is Required" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            formdata.append('gallery', $('input[name^=gallery]').prop('files'));
            $.ajax({
                url: uRL+'/add-service',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Swal.fire({
                            icon: 'success',
                            html: 'Added Successfully',
                            timer: 1500,
                            showConfirmButton: false,
                        })
                        setTimeout(function(){ window.location.href = uRL+'/my-services'; }, 1500);
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            html: dataResult,
                            timer: 4000,
                            showConfirmButton: true,
                        })
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                }
            });
        }
    });


    $('#edit-service').validate({
        rules: {
            s_title: { required: true },
            s_cat: { required: true },
            s_amount: { required: true },
            s_location: { required: true },
            s_desc: { required: true },
        },
        messages: {
            s_title: { required: "Title is Required" },
            s_cat: { required: "Category is Required" },
            s_amount: { required: "Amount is Required" },
            s_location: { required: "Location is Required" },
            s_desc: { required: "Description is Required" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            formdata.append('gallery1', $('input[name^=gallery1]').prop('files'));
            $.ajax({
                url: uRL+'/update-service',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Swal.fire({
                            icon: 'success',
                            html: 'Updated Successfully',
                            timer: 1500,
                            showConfirmButton: false,
                        })
                        setTimeout(function(){ window.location.href = uRL+'/my-services'; }, 1500);
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            html: dataResult,
                            timer: 4000,
                            showConfirmButton: true,
                        })
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                }
            });
        }
    });

    $('.service-status').click(function(){
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        $.ajax({
            url: uRL+'/service-status',
            type: 'POST',
            data: {service_status:status,id:id},
            success: function (dataResult) {
                console.log(dataResult);
                if (dataResult == '1') {
                    Swal.fire({
                        icon: 'success',
                        html: 'Status Changed',
                        timer: 1500,
                        showConfirmButton: false,
                    })
                    setTimeout(function(){ window.location.reload(); }, 1500);
                } else {
                    Swal.fire({
                        icon: 'warning',
                        html: dataResult,
                        timer: 4000,
                        showConfirmButton: true,
                    })
                }
            },
            error: function(data){
                show_formAjax_error(data)
            }
        });
    })

    $('#submit-service').validate({
        rules: {
            location: { required: true },
            date: { required: true },
        },
        messages: {
            location: { required: "Select Location" },
            date: { required: "Select Date" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL+'/submit-booking',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Swal.fire({
                            icon: 'success',
                            html: 'Service Booked Successfully',
                            timer: 1500,
                            showConfirmButton: false,
                        })
                        setTimeout(function(){ window.location.href = uRL+'/my-bookings'; }, 1500);
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            html: dataResult,
                            timer: 4000,
                            showConfirmButton: true,
                        })
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                }
            });
        }
    });

    $(".checkAllday").click(function () {
        if($(this).prop('checked') == true){
            $(".daycheck").prop('disabled', true);
            $(".from-time").prop('disabled', true);
            $(".to-time").prop('disabled', true);
        }else{
            $(".daycheck").prop('disabled', false);
            $(".from-time").prop('disabled', false);
            $(".to-time").prop('disabled', false);
        }
    });

    $('.save-availability').click(function(){

        if($('input[name=day_all]').prop('checked') == true){
            var days = 'all';
            var from_time = $('input[name=from_time_all]').val();
            var to_time = $('input[name=to_time_all]').val();
        }else{

            var days = [];
            $('input[name="day[]"]').each(function(){
                if($(this).prop('checked') == true){
                    days.push($(this).val());
                }
            });

            var from_time = [];
            var to_time = [];

            for(var i=0;i<days.length;i++){
                from_time.push($('input[name="from_time['+days[i]+']"]').val());
                to_time.push($('input[name="to_time['+days[i]+']"]').val());
            }
        }

        if(days.length < 1 || days == ''){
            Swal.fire({
                icon: 'warning',
                html: "Kindly Select Minimum Day",
                timer: 4000,
                showConfirmButton: true,
            })
        }else{
            $.ajax({
                url: uRL+'/availability',
                type: 'POST',
                data: {days:days,from_time:from_time,to_time:to_time},
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Swal.fire({
                            icon: 'success',
                            html: 'Saved Successfully',
                            timer: 1500,
                            showConfirmButton: false,
                        })
                        setTimeout(function(){ window.location.href = uRL+'/availability'; }, 1500);
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            html: dataResult,
                            timer: 4000,
                            showConfirmButton: true,
                        })
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                }
            });
        }
    });



    $('.reject-service').click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url: uRL+'/reject-booking',
            type: 'POST',
            data: {id:id},
            success: function (dataResult) {
                console.log(dataResult);
                if (dataResult == '1') {
                    Swal.fire({
                        icon: 'success',
                        html: 'Booking Rejected Successfully',
                        timer: 1500,
                        showConfirmButton: false,
                    })
                    setTimeout(function(){ window.location.reload(); }, 1500);
                } else {
                    Swal.fire({
                        icon: 'warning',
                        html: dataResult,
                        timer: 4000,
                        showConfirmButton: true,
                    })
                }
            },
            error: function(data){
                show_formAjax_error(data);
            }
        });
    })

    $('.accept-service').click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url: uRL+'/accept-booking',
            type: 'POST',
            data: {id:id},
            success: function (dataResult) {
                console.log(dataResult);
                if (dataResult == '1') {
                    Swal.fire({
                        icon: 'success',
                        html: 'Booking Accepted Successfully',
                        timer: 1500,
                        showConfirmButton: false,
                    })
                    setTimeout(function(){ window.location.reload(); }, 1500);
                } else {
                    Swal.fire({
                        icon: 'warning',
                        html: dataResult,
                        timer: 4000,
                        showConfirmButton: true,
                    })
                }
            },
            error: function(data){
                show_formAjax_error(data);
            }
        });
    })

    $('.cancel-booking').click(function(){
        var id = $(this).attr('data-id');
        var user = $(this).attr('data-user');
        $.ajax({
            url: uRL+'/cancel-booking',
            type: 'POST',
            data: {id:id,user:user},
            success: function (dataResult) {
                if (dataResult == '1') {
                    Swal.fire({
                        icon: 'success',
                        html: 'Booking Cancelled Successfully',
                        timer: 1500,
                        showConfirmButton: false,
                    })
                    setTimeout(function(){ window.location.reload(); }, 1500);
                } else {
                    Swal.fire({
                        icon: 'warning',
                        html: dataResult,
                        timer: 4000,
                        showConfirmButton: true,
                    })
                }
            },
            error: function(data){
                show_formAjax_error(data);
            }
        });
    })

    $('.complete-booking').click(function(){
        var id = $(this).attr('data-id');
        var user = $(this).attr('data-user');
        $.ajax({
            url: uRL+'/complete-booking',
            type: 'POST',
            data: {id:id,user:user},
            success: function (dataResult) {
                if (dataResult == '1') {
                    Swal.fire({
                        icon: 'success',
                        html: 'Booking Completed Successfully',
                        timer: 1500,
                        showConfirmButton: false,
                    })
                    setTimeout(function(){ window.location.reload(); }, 1500);
                } else {
                    Swal.fire({
                        icon: 'warning',
                        html: dataResult,
                        timer: 4000,
                        showConfirmButton: true,
                    })
                }
            },
            error: function(data){
                show_formAjax_error(data);
            }
        });
    })

    $('#updatePay-settings').validate({
        rules: {
            bank_name: { required: true },
            account_no: { required: true },
            iban: { required: false },
            bank_address: { required: false },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL+'/payout-settings',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1' || dataResult == '0') {
                        Swal.fire({
                            icon: 'success',
                            html: 'Updated Successfully',
                            timer: 1500,
                            showConfirmButton: false,
                        })
                        setTimeout(function(){ window.location.reload(); }, 1500);
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            html: dataResult,
                            timer: 4000,
                            showConfirmButton: true,
                        })
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                }
            });
        }
    });

    $('#withdraw-wallet').validate({
        rules: {
            amount: { required: true },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL+'/withdraw-wallet',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Swal.fire({
                            icon: 'success',
                            html: 'Request Added Successfully',
                            timer: 1500,
                            showConfirmButton: false,
                        })
                        setTimeout(function(){ window.location.reload(); }, 1500);
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            html: dataResult,
                            timer: 4000,
                            showConfirmButton: true,
                        })
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                }
            });
        }
    });










});