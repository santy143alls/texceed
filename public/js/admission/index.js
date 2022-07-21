var Admission = function (config) {
    console.log(config);
    var t = this;
    t.config = config;
    t.content = $(".content");
    
    t.addAdmissionModal = t.content.find('#newAdmissionModal');
    t.addAdmissionForm = t.addAdmissionModal.find('.admissionForm');
    t.saveBtn = t.addAdmissionForm.find('.save');
    t.admissionDtbl = t.content.find("#admissionDtbl");

    t.dtbl = t.admissionDtbl.DataTable({
        autoWidth: false,
        aoColumnDefs: [{
                targets: 5,
                render: function (d) {
                    var x = d;
                    var a = [];
                        a.push("<button class='btn dtActbtn open-delete' data-toggle='tooltip' data-original-title='Delete Details' id='"+d+"'><i class=\"fa fa-trash\"></i></button>");
                        a.push("<a style='color:black' class='btn dtActbtn' data-toggle='tooltip' data-original-title='Manage Users' id='"+d+"'><i class=\"fa fa-user\"></i></a>");
                        a.push("<button class='btn dtActbtn open-edit-modal' data-toggle='tooltip' data-original-title='Edit Details' id='"+d+"'><i class=\"fa fa-pencil\"></i></button>");
                    return a.join("");
                }
            }
        ],
        order: [
            [1, 'asc']
        ],
        deferLoading: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: t.config.url.getAllAdmissions,
            type: "POST",
            data: function (d) {
                d._token = t.addAdmissionForm.find('#csrfToken').val();
            }
        },
        columns: [
            { data: 'student_name' },
            { data: 'email' },
            { data: 'phone' },
            { data: 'course' },
            { data: 'admission_status' },
            { data: '' },
        ],
        fnInitComplete: function(oSettings, json) {
            var api = this.api();
            var searchBox = '<div class="input-group table-search-btns"><input type="text" class="form-control input-sm" placeholder="Press enter with search text" style="width: 210px;" aria-controls="mytable" /></div>';
            $("#mytable_filter").empty().html(searchBox);
            $("#mytable_filter input").on("keyup.DT", function(e) {
                if (e.keyCode == 13 || this.value.length == 0) {
                    var v = $(this).validate_str_param();
                    if(v === false) {
                        alert("Please enter a valid value for search");
                        return false;
                    }
                    api.search(this.value).draw();
                }
            });
        }
    })

    t.handlesubmit = function (e) {
        e.preventDefault();
        var formdata = new FormData(t.addAdmissionForm[0]);
        formdata.append('_token', t.addAdmissionForm.find('#csrfToken').val());
        $.ajax({
            url : t.config.url.create,
            method : 'post',
            processData: false,
            contentType: false,
            data: formdata,
            success : function(res){
                if(res.status == 'success'){
                    swal({
                        title: res.msg,
                        icon: "success",
                    });
                    window.location.reload();
                }else{
                    swal({
                        title: res.msg,
                        icon: "error",
                    });
                }
            },

        })
    }

    t.saveBtn.on('click',t.handlesubmit);
    t.dtbl.ajax.reload();
}
