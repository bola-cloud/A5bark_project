
<div style="display: none" id="createObjectCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>اضافة تسليم</h5>
        </div>
        <div class="col-6 text-right">
            <div class="toggle-btn btn btn-default btn-sm" data-current-card="#createObjectCard" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div><!-- /.row -->
    
    <hr/>

    <form action="/" id="objectForm">
        <div class="form-group row">
            <label for="family_id" class="col-sm-3 col-form-label">الأسرة</label>
            <div class="col-sm-9">
                <select type="text" class="form-control" id="family_id"></select>
                <div style="padding: 5px 7px; display: none" id="family_idErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.form-group -->

        <div class="form-group row">
            <label for="family_code" class="col-sm-3 col-form-label">كود الأسرة</label>
            <div class="col-sm-9">
                <input id="family_code" class="form-control" disabled="disabled">
                <div style="padding: 5px 7px; display: none" id="family_codeErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.form-group -->

        <div class="form-group row">
            <label for="project_name" class="col-sm-3 col-form-label" disabled="disabled">نوع المشروع</label>
            <div class="col-sm-9">
                <input type="hidden" id="project_id">
                <input id="project_name" class="form-control" disabled="disabled">
                <div style="padding: 5px 7px; display: none" id="project_idErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.form-group -->

        <div class="form-group row">
            <label for="delivery_date" class="col-sm-3 col-form-label">تاريخ التسليم</label>
            <div class="col-sm-9">
                <input type="date" class="form-control" id="delivery_date">
                <div style="padding: 5px 7px; display: none" id="delivery_dateErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.form-group -->
        
        <div class="form-group row mb-4">
            <input type="hidden" id="delivery_content">
            <label for="nom_dayes" class="col-sm-3 col-form-label">محتوي المشروع</label>
            <div class="col-sm-9" style="overflow-y: scroll; height: 250px;">
                <div style="padding: 5px 7px; display: none" id="delivery_contentErr" class="err-msg mt-2 alert mb-2 alert-danger">
                </div>

                <table class="table table-sm text-center">
                    <thead>
                        <tr>
                            <td>البند</td>
                            <td>الكمية</td>
                            <td>التحكم</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input id="contentTitle" type="text" class="form-control" placeholder="البند">
                                </div>
                                <div style="padding: 5px 7px; display: none" id="contentTitleErr" class="err-content-msg mt-2 alert alert-danger"></div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input id="contentQuantity" type="number" min="0" class="form-control" placeholder="الكمية">
                                </div>
                                <div style="padding: 5px 7px; display: none" id="contentQuantityErr" class="err-content-msg mt-2 alert alert-danger"></div>
                            </td>
                            <td>
                                <button class="add-project-content btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="projectContentTable"></tbody>
                </table>
            </div>
        </div><!-- /.form-group -->

        <div class="form-group row">
            <input type="hidden" id="mediaFiles">
            <label for="media_files" class="col-sm-3 col-form-label">ملفات</label>
            <div class="col-sm-9" style="overflow-y: scroll; height: 250px">
                <table class="table table-striped table-sm text-center">
                    <thead>
                        <tr>
                            <td>أسم الملف</td>
                            <td>الملف</td>
                            <td>التحكم</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="mediaTitle" class="form-control" placeholder="اسم الملف">
                                </div>
                                <div style="padding: 5px 7px; display: none" id="mediaTitleErr" class="err-file-msg mt-2 alert alert-danger"></div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="mediaFile" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="mediaFile">حدد الملف</label>
                                    </div>
                                </div>
                                <div style="padding: 5px 7px; display: none" id="mediaFileErr" class="err-file-msg mt-2 alert alert-danger"></div>
                            </td>
                            <td>
                                <button id="uploadMediaFile" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="mediaTable">
                        
                    </tbody>
                </table>
            </div>
        </div><!-- /.form-group --> 

        <div class="form-group row">    
            <label for="delivery_file" class="col-sm-3 col-form-label">نموذج استلام أصول</label>
            <div class="col-sm-9">
                <div>
                    <input type="file" id="delivery_file">
                </div>
                <div style="padding: 5px 7px; display: none" id="delivery_fileErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.form-group -->
    
        <button class="create-object btn btn-primary float-right">اضافة تسليم</button>
    </form>
</div>

@push('page_scripts')
<script>
$(function () {
    
    function projectContent () {
        let content = [];

        function getData () {
            let is_valied = true;
            $('.err-content-msg').slideUp(500);

            let tmp = {
                id : Math.round(Math.random() * 1000),
                title    : $('#contentTitle').val(),
                quantity : $('#contentQuantity').val(),
            };


            if (!Boolean(tmp.title)) {
                is_valied = false;
                $('#contentTitleErr').text('يرجي ادخال مسمي البند').slideDown(500);
            }

            if (!Boolean(tmp.quantity) || tmp.quantity < 0) {
                is_valied = false;
                $('#contentQuantityErr').text('يرجي ادخال كمية البند').slideDown(500);
            }

            return is_valied ? tmp : false;
        }

        function clearForm () {
            $('#contentTitle').val('')
            $('#contentQuantity').val('') 
        }

        function renderList () {
            let rows = '';

            content.forEach(el => {
                rows += `
                    <tr>
                        <td>${el.title}</td>
                        <td>${el.quantity}</td>
                        <td>
                            <button class="btn btn-danger btn-sm delete-project-content" data-target="${el.id}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });

            $('#projectContentTable').html(rows);
        }

        $('.add-project-content').click(function (e) {
            /**
             * 1- get content data (title, quantityt)
             * 2- validate data
             * 3- add to the list
             * 4- render the new list
             */

            e.preventDefault();

            let data = getData();

            if (data) {
                content.push(data);
                $('#delivery_content').val(JSON.stringify(content));

                clearForm();
                renderList();
            }

        });

        $('#objectsCard').click(function (e) {
            // clear old session
            content = [];
            $('#delivery_content').val('');
            $('#projectContentTable').html('');
        });

        $('#projectContentTable').on('click', '.delete-project-content', function () {
            let target_id = $(this).data('target');

            content = content.filter(val => val.id != target_id);
            $('#delivery_content').val(JSON.stringify(content));

            clearForm();
            renderList();
        });

        $('#delivery_content').click(function () {
            console.log('Test !');
            content = Boolean($('#delivery_content').val()) ? JSON.parse($('#delivery_content').val()) : [];
            renderList()
        });
    }

    projectContent();

    function mediaHandler (base_url = `{{ route('admin.project_actions.store') }}`) {
        let list_media = [];

        function renderFileRow (title, id = null) {
            let row_id = Boolean(id) ? id : Math.round(Math.random() * 1000);

            let row = `
            <tr id="mediaRow${row_id}">
                <td>${title}</td>
                <td id="uploadProgress${row_id}">
                    ${
                        Boolean(id) ? 
                        `
                            <span class="badge badge-success px-3 py-1 my-2">
                                <i class="fas fa-check-circle"></i>
                                <span class="mx-2">تم رفع الملف بنجاح</span>
                            </span>
                        `
                        :
                        `
                            <div class="progress mt-2" id="mediaProgress${row_id}">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
                            </div>
                        `
                    }
                </td>
                <td>
                    ${
                        Boolean(id) ? 
                        `
                            <button class="btn btn-sm btn-danger del-media" data-target="${row_id}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        `
                        :
                        `
                            <button disabled="disabled" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        `
                    }
                </td>
            </tr>
            `;

            $('#mediaTable').append(row);

            return row_id;
        }

        function updateMediaList (media_id) {
            list_media.push(media_id);
            $(`#mediaFiles`).val(JSON.stringify(list_media));
        }

        function validateMediaFile () {
            
            let is_valied = true;
            $('.err-file-msg').slideUp(500);

            if ($('#mediaTitle').val() == '') {
                $('#mediaTitleErr').text('يجب ادخال اسم الملف').slideDown(500)
                is_valied = false
            }
            
            if ($('#mediaFile').prop('files').length == 0) {
                $('#mediaFileErr').text('يرجي تحديد الملف').slideDown(500);
                is_valied = false
            } else if ($('#mediaFile').prop('files')[0].size > 100000000) {
                $('#mediaFileErr').text('حجم الملف يجب ان لا يزيد عن 12 مجيا').slideDown(500);
                is_valied = false
            }

            return is_valied;
        }

        $('#uploadMediaFile').click(function (e) {
            e.preventDefault();

            /**
             * 1- get the file
             * 2- upload a file
             * 3- after upload finish get the file id from response
             * 4- add the file upload to the uploaded files media list
             */
            

            if (validateMediaFile()) {
                let fDataObj = new FormData();
                
                fDataObj.append('_upload_media', true);
                fDataObj.append('_token', "{{ csrf_token() }}");
                fDataObj.append('title', $('#mediaTitle').val());
                fDataObj.append('media_file', $('#mediaFile').prop('files')[0])

                let dumy_id = renderFileRow(fDataObj.get('title'));
                
                const config = {
                    onUploadProgress: progressEvent => {
                        let progress = Math.round((progressEvent.loaded / progressEvent.total) * 100);
                        $(`#mediaProgress${dumy_id}`).html(`
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="${progress}" aria-valuemin="0" aria-valuemax="100" style="width: ${progress}%">${progress}%</div>
                        `);
                    }
                }

                axios.post(base_url, fDataObj, config)
                .then(res => {
                    let { data, success } = res.data;

                    if (success) {
                        $(`#mediaRow${dumy_id}`).remove();
                        updateMediaList(data.id);
                        renderFileRow(data.title, data.id);
                            
                        // clear old session
                        $('#mediaTitle').val('');
                        $('#mediaFile').val('');
                    }
                })
                .finally(() => {
                })
                .catch(err => {
                    $(`#uploadProgress${dumy_id}`).html(`
                        <span class="badge badge-danger px-3 py-1 my-2">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span class="mx-2">حدث خطاء ما !</span>
                        </span>
                    `);
                });
            }
        });

        $('#objectsCard').click(function (e) {
            // clear old session
            list_media = [];
            $('#mediaFile').val('');
            $('#mediaTitle').val('');
            $('#mediaTable').html('');
        });

        $('#mediaTable').on('click', '.del-media', function () {
            let target_id = $(this).data('target');
            list_media = list_media.filter(media_id => media_id != target_id);
            $(`#mediaFiles`).val(JSON.stringify(list_media));
            $(`#mediaRow${target_id}`).remove();
        });

        $('#family_id').change(function () {
            // get family id
            // request the familly data
            // show the and family code project data, 
            let target_id = $(this).val();

            if (Boolean(target_id)) {
                $('#loddingSpinner').show(500);
                
                axios.get(`{{ url("admin/families") }}/${target_id}`)
                .then(res => {
                    let { data, success } = res.data;
                    
                    if (success) {
                        $('#project_id').val(data.project.id);
                        $('#family_code').val(data.family_code);
                        $('#project_name').val(data.project.name);
                        
                        $('#delivery_content').val(data.project.meta).trigger('click');
                    } else {
                        throw 'error';
                    }// end :: if
                })
                .finally(() => {
                    $('#loddingSpinner').hide(500);
                })
                .catch(err => {
                    // show error message ...
                });
            } else {
                $('#family_code').val('');
                $('#project_id').val('');
                $('#project_name').val('');
            }
        });
    }

    mediaHandler(`{{ route('admin.project_actions.store') }}`);
});
</script>
@endpush