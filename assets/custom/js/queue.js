let QUEUE = [];
let QUEUE_FLAG = false;
let QUEUE_CURRENT = "";
let QUEUE_FOLDER_KEYS = {};




$('#upload-files').on('click', function () {
    $('#file-input').trigger('click');
});
$('#upload-folder').on('click', function () {
    $('#folder-input').trigger('click');
});


function getRelativePath(path_array, pop_count) {

    let p_array = [];
    path_array.forEach((entry, index) => {
        p_array[index] = entry;
    });


    for (let i = 0; i < pop_count; i++) {
        p_array.pop();
    }
    return "/" + p_array.join("/");
}

function getParent(full_path, level) {
    let this_parent = PARENT;

    let path_array = full_path.split("/");
    let relative_path = getRelativePath(path_array, level);

    if (path_array.length > 1) {
        //this includes a folder
        this_parent = QUEUE_FOLDER_KEYS[relative_path];

        //console.log(relative_path);
        //console.log(this_parent);
    }

    return this_parent;
}


$('#file-input, #folder-input').on('change', function () {

    let queue_parent = PARENT;
    let html = "";

    const files = this.files;
    $("#queue-toast").addClass("show");
    let path_array;
    let full_path;
    let file;
    let relative_path;
    let file_parent;
    let file_name;

    for (let i = 0; i < files.length; i++) {

        file_parent = "";
        if (!PARENT) file_parent = PARENT;

        file = files.item(i);
        console.log(file); continue;
        file_name = file.webkitRelativePath;
        if (!file_name) file_name = file.name;
        path_array = file_name.split("/");

        relative_path = getRelativePath(path_array, 1);


        if (queue_parent) {
            full_path = queue_parent + file_name;
            relative_path = queue_parent + relative_path;
        } else full_path = file_name;

        if (path_array.length > 1) {
            //this includes a folder
            //does the full path exists in the queue folder keys?

            file_parent = QUEUE_FOLDER_KEYS[relative_path];

            //console.log(relative_path);
            //console.log(QUEUE_FOLDER_KEYS);
            //console.log(file_parent);


            if (!file_parent) {
                //this full path is not in the queue folder keys
                //we hope that a step above it is tho
                relative_path = getRelativePath(path_array, 1);
                if (queue_parent) relative_path = queue_parent + relative_path;
                file_parent = QUEUE_FOLDER_KEYS[relative_path];
                console.log(relative_path);
                console.log(file_parent);
            } else {
                full_path = file.name;
            }
        }

        if (!file_parent) file_parent = "";


        let local_id = randomString(20);
        let this_file = {
            id: local_id,
            name: file.name,
            full_path: full_path,
            size: file.size,
            mime: file.type,
            status: "waiting",
            resource: file,
            type: "file",
            parent: file_parent
        };


        QUEUE.push(this_file);


        html +=
            `<a id="` + local_id + `" href="#" class="list-group-item  d-flex align-items-center gap-3 pt-1 pb-3 border-0 p-0">
            <i class="status-icon fa-solid fa-circle-pause text-secondary fs-2"></i>
                    <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                    <p class="mb-0">${truncate(file.name, 28)}</p>
                        <small class="status-text mb-0 opacity-50">Waiting ...</small>
                    </div>

                </div>
            </a>`;

    }




    $(".download-queue").append(html);

    processQueue();

});




function processQueue() {
    if (QUEUE_FLAG == true) return;



    let job = getPendingJob();

    if (job == false) return;

    QUEUE_FLAG = true;

    updateJobStatus(job.id, "uploading");

    upload(job);

}

function stopQueue() {
    QUEUE_FLAG = false;
}





function getPendingJob() {
    for (let i = 0; i < QUEUE.length; i++) {
        if (QUEUE[i].status == "waiting") {
            return QUEUE[i];
        }
    }

    return false;

}

function updateJobStatus(local_id, status) {
    for (let i = 0; i < QUEUE.length; i++) {
        if (QUEUE[i].id == local_id) {
            QUEUE[i].status = status;
            updateJobView(local_id, status);
        }
    }
}

function updateJobProgress(id, perc) {
    $("#" + id + " .status-text").text("Uploading ... (" + perc + "%)");
}


function updateJobView(id, status) {
    $("#" + id + " .status-icon").removeClass("text-secondary text-primary text-danger text-success fa-circle-pause fa-circle-play fa-circle-check fa-circle-exclamation");

    if (status == "uploading") {
        $("#" + id + " .status-icon").addClass("text-primary fa-circle-play");
        $("#" + id + " .status-text").text("Uploading ...");
    }

    if (status == "complete") {
        $("#" + id + " .status-icon").addClass("text-success fa-circle-check");
        $("#" + id + " .status-text").text("Upload complete");
    }

    if (status == "failed") {
        $("#" + id + " .status-icon").addClass("text-danger fa-circle-exclamation");
        $("#" + id + " .status-text").text("Upload failed");
    }
}


function upload(job) {

    if (!job.parent) {
        let parent = getParent(job.full_path, 1);

        if (!parent) {
            job.name = job.full_path;
            parent = getParent(job.full_path, 2);
            if(parent){
                job.parent = parent; //the grand parent
            }
        } else {
            job.parent = parent;
        }
    }


    var form_data = new FormData();
    form_data.append('file', job.resource);
    form_data.append('local_id', job.id);
    form_data.append('name', job.name);
    form_data.append('size', job.size);
    form_data.append('mime', job.mime);
    form_data.append('type', job.type);
    form_data.append('parent', job.parent);

    QUEUE_CURRENT = job.id;

    $.ajax({
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = (evt.loaded / evt.total) * 100;
                    updateJobProgress(job.id, Math.round(percentComplete))

                }
            }, false);
            return xhr;
        },
        url: '/drive/upload',
        type: 'post',
        enctype: 'multipart/form-data',
        data: form_data,
        contentType: false,
        processData: false,
        dataType: 'json',
        timeout: 600000, //10 minutes
        cache: false,
        success: function (response) {
            if (response.status == "complete") {

                $.each(response.data, function (key, item) {
                    registerQueueFolderKey(item["full_path"], item["parent_id"])
                    insertItem(key, item)
                });

                updateJobStatus(response.id, "complete");

                stopQueue();
                processQueue();
            } else {
                updateJobStatus(response.id, "failed");
                stopQueue();
                processQueue();
            }
        },
        error: function (jqXHR, status) {
            updateJobStatus(QUEUE_CURRENT, "failed");
            stopQueue();
            processQueue();

        },
    });
}

function registerQueueFolderKey(full_path, id) {
    let relative_path = getRelativePath(full_path.split("/"), 1);

    if (relative_path && !QUEUE_FOLDER_KEYS[relative_path]) QUEUE_FOLDER_KEYS[relative_path] = id;

    //console.log(QUEUE_FOLDER_KEYS);


}




var create_folder_callback = function (data, status_text) {
    if (status_text) {
        //show the error
    }

    //insert the folder into the tree
    $.each(data.data, function (key, item) {
        insertItem(key, item);
    });
    closeModal();
}