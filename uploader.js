var handleUpload = function(ev){
    ev.preventDefault();
    ev.stopPropagation();

    var fileInput = document.getElementById('file');

    var data = new FormData();

    data.append('ajax',true);
    
    for (var i = 0;i<fileInput.files.length;++i){
        data.append('file[]',fileInput.files[i]);
    }

    var request = new XMLHttpRequest();
    request.upload.addEventListener('progress',function(ev){
        if (ev.lengthComputable){
            var percent = ev.loaded / ev.total;
            
            document.getElementById("progress").setAttribute('style','width:'+Math.round(percent * 100)+'%');
            document.getElementById("progress").innerHTML = Math.round(percent * 100)+'%';
        }
    });

    request.upload.addEventListener('load',function(ev){
        document.getElementById('upload_progress').style.display = "none";
    });

    request.upload.addEventListener('error',function(ev){
        alert('Uplaod failed');
    });

    request.addEventListener('readystatechange',function(ev){
        if(this.readyState == 4 ){
            if (this.status == 200){
                document.getElementById("progress").setAttribute('style','width:0%');
            }else{
                console.log('Error: ' + this.status);
            }
        }
    })

    request.open('POST','index.php');
    request.setRequestHeader('Cache-Control', 'no-cache');
    document.getElementById('upload_progress').style.display = "block";
    request.send(data);
}
 
window.addEventListener('load',function(ev){
    var submit = document.getElementById('submit');
    submit.addEventListener('click',handleUpload);
})