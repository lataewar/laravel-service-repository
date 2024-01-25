const urx = $("#urx").val();
const loader = function (type, delay = 250) {
  if (type === "show") {
    $("#status_").fadeIn("fast");
    $("#preloader_").fadeIn("fast");
  } else {
    $("#status_").fadeOut();
    $("#preloader_").delay(delay).fadeOut("slow");
  }
};

const toggleMBD = function () {
  if ($(".check-id:checked").length) {
    $(".btn-multdelete").show();
  } else {
    $(".btn-multdelete").hide();
  }
};

const sweetAlert = function (title, text, icon) {
  Swal.fire({
    title,
    html: text,
    icon,
    buttonsStyling: false,
    confirmButtonText: "Ya, Saya Mengerti!",
    customClass: {
      confirmButton: "btn btn-primary",
    },
    timer: 10000,
  });
};

const succeedRes = function (response) {
  if (response.sukses) {
    showData();
    sweetAlert("Sukses", response.sukses, "success");
  } else {
    sweetAlert("Gagal", response.gagal, "error");
  }
};

const ajaxCall = function (
  url,
  type,
  data,
  dataType,
  beforeSend,
  complete,
  success
) {
  $.ajax({
    url,
    type,
    data,
    dataType,
    beforeSend,
    complete,
    success,
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    error: function (xhr, ajaxOptions, thrownError) {
      loader("hide", 400);
      if (xhr.status === 422) {
        validate(JSON.parse(xhr.responseText).errors);
      } else if (xhr.status === 419) {
        alert("Sesi anda telah habis, silahkan login kembali");
      } else {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    },
  });
};

const formatRupiah = function (objek, separator) {
  a = objek.value;
  b = a.replace(/[^\d]/g, "");
  c = "";
  panjang = b.length;
  j = 0;
  for (i = panjang; i > 0; i--) {
    j = j + 1;
    if (j % 3 == 1 && j != 1) {
      c = b.substr(i - 1, 1) + separator + c;
    } else {
      c = b.substr(i - 1, 1) + c;
    }
  }
  objek.value = c;
};

$(document).ready(function () {
  loader("hide", 400);
});
