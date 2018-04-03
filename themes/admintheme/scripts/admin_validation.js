$(document).ready(function() {
        $("#add_user").validate({
            rules: {
                user_type: {
                    required: true
                },
                first_name: {
                    required: true
                },
                last_name:{
                    required: true
                },
                email:{
                    required: true,
                    email:true
                },
                mobile_no:{
                    required: true,
                    minlength:10,
                    maxlength:10
                }
                // password:{
                //     required: true
                // }
//                    user_type_id:{
//                        required: true
//                    }
            },
        });
        $("#add_cms").validate({
            rules: {
                    title: {
                        required: true
                    }
            },
        });
        $("#add_banner").validate({
            rules: {
                    banner_name: {
                        required: true
                    }
            },
        });
        $("#frm_subs").validate({
            rules: {
                pre_title: {
                    required: true
                }
            },
        });

});