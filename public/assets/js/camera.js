var latLong = "";
var image = "";
var shutter = new Audio();

function openCamera() {

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    } else {
        swal({ title: 'Oops!', text: 'Maaf, browser Anda tidak mendukung geolokasi HTML5.', icon: 'error', timer: 3000, });
    }

    function successCallback(position) {
        getCurrentPosition(position);
        return latLong = "" + position.coords.latitude + "," + position.coords.longitude + "";
    }

    function errorCallback(error) {
        if (error.code == 1) {
            swal({ title: 'Oops!', text: 'Mohon untuk mengaktifkan lokasi Anda', icon: 'error', timer: 3000, });
        } else if (error.code == 2) {
            swal({ title: 'Oops!', text: 'Jaringan tidak aktif atau layanan penentuan posisi tidak dapat dijangkau.', icon: 'error', timer: 3000, });
        } else if (error.code == 3) {
            swal({ title: 'Oops!', text: 'Waktu percobaan habis sebelum bisa mendapatkan data lokasi.', icon: 'error', timer: 3000, });
        } else {
            swal({ title: 'Oops!', text: 'Waktu percobaan habis sebelum bisa mendapatkan data lokasi.', icon: 'error', timer: 3000, });
        }
    }

    // //radius
    var currentLocation = { lat: -4.5284175, lng: 105.1522242 };
    var radius = 100;
    function getCurrentPosition(position) {
        var userLocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
        };

        var distance = google.maps.geometry.spherical.computeDistanceBetween(
            new google.maps.LatLng(currentLocation),
            new google.maps.LatLng(userLocation)
        );

        // Jika jarak kurang dari radius
        if (distance < radius) {
            setCamera();
        } else {
            swal({ title: 'Oops!', text: 'Mohon Maaf Sepertinya Anda Diluar Radius!', icon: 'error', timer: 3000, }).then(() => {
                window.location.href = '/user/dashboard';
            });

        }
    }

    function setCamera() {
        //set camera
        Webcam.set({
            width: 490, height: 450,
            image_format: 'jpeg',
            jpeg_quality: 90,
        });

        var cameras = new Array();
        navigator.mediaDevices.enumerateDevices()
            .then(function (devices) {
                devices.forEach(function (device) {
                    var i = 0;
                    if (device.kind === "videoinput") {
                        cameras[i] = device.deviceId;
                        i++;
                    }
                });
            })

        Webcam.set('constraints', {
            width: 490,
            height: 450,
            image_format: 'jpeg',
            jpeg_quality: 90,
            sourceId: cameras[0]
        });

        Webcam.attach('.webcam-capture');
        shutter.autoplay = false;
        shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : '/assets/pegawai/shutter.mp3';
        document.getElementById('x-absent').setAttribute('onclick', 'captureimage()');
    }
}

function captureimage() {
    shutter.play();
    Webcam.snap(function (data_uri) {
        submitFile(data_uri);
        document.getElementById('results').innerHTML =
            `
                <img class="x-img-fluid" id="imageprev" style="border-radius: 15px" src="${data_uri}"/>
            `
        $('#x-action').removeClass('d-none');
        Webcam.reset();
        document.getElementById('x-resetCamera').setAttribute('onclick', 'resetCamera()');
        return image = data_uri;
    });

}

function resetCamera() {
    removeFile(image);
    window.location.reload('/user/presensi');
}

async function absenStore() {
    $('#x-action').addClass('d-none');
    var param = {
        method: 'POST',
        url: '/user/presensi/store',
        data: {
            latLong: latLong,
            file: image,
        }
    }

    loadingsubmit(true);
    await transAjax(param).then((res) => {
        swal({ text: res.message, icon: 'success', timer: 3000, }).then(() => {
            loadingsubmit(false);
            window.location.href = '/user/dashboard';
        });
    }).catch((err) => {
        loadingsubmit(false);
        swal({ text: err.responseJSON.message, icon: 'error', timer: 3000, }).then(() => {
        });
    });
}

function loadingsubmit(state) {
    if (state) {
        $('#loadingSubmit').removeClass('d-none');
    } else {
        $('#loadingSubmit').addClass('d-none');
        $('#x-action').removeClass('d-none');
    }
}

async function submitFile(file) {
    var param = {
        method: 'POST',
        url: '/user/presensi/store_file',
        data: {
            image: file,
        }
    }

    await transAjax(param).then((res) => {
        return image = res.data;
    }).catch((err) => {
        console.log(err);
    });
}

async function removeFile(file) {
    var param = {
        method: 'POST',
        url: '/user/presensi/remove_file',
        data: {
            file: file,
        }
    }

    await transAjax(param).then((res) => {
        console.log(res);
    }).catch((err) => {
        console.log(err);
    });
}