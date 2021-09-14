var barang = [];

(function($) {
  $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  };
}(jQuery));

$(".number-input").inputFilter(function(value) {
  return /^-?\d*$/.test(value); 
});

$(document).on('input propertychange paste', '.input-notzero', function(e){
  var val = $(this).val()
  var reg = /^0/gi;
  if (val.match(reg)) {
      $(this).val(val.replace(reg, ''));
  }
});

$(function() {
  $("form[name='transaction_form']").validate({
    rules: {
      diskon: "required",
      bayar: "required"
    },
    errorPlacement: function(error, element) {
        var name = element.attr("name");
        $('input[name='+ name +']').addClass('is-invalid');
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

function subtotalBarang() {
  var subtotal_barang = 0;
  $('.total_barang').each(function(){
    subtotal_barang += parseInt($(this).val());
  });
  $('.nilai-subtotal1-td').html('Rp. ' + parseInt(subtotal_barang).toLocaleString());
  $('.nilai-subtotal2-td').val(subtotal_barang);
}

function diskonBarang() {
  var subtotal = parseInt($('input[name=subtotal]').val());
  var diskon = parseInt($('input[name=diskon]').val());
  var total = subtotal - (subtotal * diskon / 100);
  $('.nilai-total1-td').html('Rp. ' + parseInt(total).toLocaleString());
  $('.nilai-total2-td').val(total);
}

function diskonPerBarang(kode) {
  var index = barang.findIndex(p => {
    return p.kode == kode;
  });
  if(index!=-1){
    var harga = barang[index].harga;
    var total_barang = (harga * barang[index].jumlah_barang) - (barang[index].diskon / 100) * harga * barang[index].jumlah_barang;
    $("#total-barang-input-"+ kode).val(total_barang);
    $("#total-barang-text-"+ kode).html('Rp. ' + parseInt(total_barang).toLocaleString());
  }
  // var subtotal = parseInt($('input[name=subtotal]').val());
  // var diskon = parseInt($('input[name=diskon]').val());
  // var total = subtotal - (subtotal * diskon / 100);
  // $('.nilai-total1-td').html('Rp. ' + parseInt(total).toLocaleString());
  // $('.nilai-total2-td').val(total);
}

function jumlahBarang(){
  var jumlah_barang = 0;
  $('.jumlah_barang_text').each(function(){
    jumlah_barang += parseInt($(this).text());
  });
  $('.jml-barang-td').html(jumlah_barang + ' Barang');
}

function tambahData(kode, nama, harga, stok, status) {
  barang.push({
    kode: kode,
    nama: nama,
    harga: harga,
    jumlah_barang:1,
    stok: stok,
    status: status,
    diskon: 0
  })
  var tambah_data = '<tr id="barang-'+kode+'">' +
    '<td>' +
      '<input type="text" name="kode_barang[]" hidden="" value="'+ kode +'">' +
      '<span class="nama-barang-td">'+ nama +'</span>' +
      '<span class="kode-barang-td">'+ kode +'</span>' +
    '</td>' +
    '<td>' +
      '<input type="text" name="harga_barang[]" hidden="" value="'+ harga +'">'+
      '<span>Rp. '+ parseInt(harga).toLocaleString() +'</span>' +
    '</td>' +
    '<td>' +
      '<div class="d-flex justify-content-start align-items-center">' +
        '<input type="text" class="jumlah-barang-input" id="jumlah-barang-input-'+ kode +'" name="jumlah_barang[]" hidden="" value="1">' +
        '<a href="#" onclick="btnTambah(&#39;'+kode+'&#39;)" class="btn-operate mr-2 btn-tambah">' +
          '<i class="mdi mdi-plus"></i>' +
        '</a>' +
        '<span class="ammount-product mr-2" unselectable="on" onselectstart="return false;" onmousedown="return false;">' +
          '<p class="jumlah_barang_text" id="jumlah-barang-text-'+ kode +'">1</p>' +
        '</span>' +
        '<a href="#" onclick="btnKurang(&#39;'+kode+'&#39;)" class="btn-operate btn-kurang">' +
          '<i class="mdi mdi-minus"></i>' +
        '</a>' +
      '</div>' +
    '</td>' +
    '<td>' +
      '<input style="width:80px;" oninput="diskonInputBarang(this, &#39;'+kode+'&#39;)" type="number" class="form-control diskon-input-barang-' +kode+ ' mr-2" min="0" max="100" name="diskon_per_barang[]" value="0" hidden="">' +
      '<span class="nilai-diskon-barang-' +kode+ ' mr-1">0</span>' +
      '<span>%</span>' +
      '<div>' +
        '<a href="#" class="ubah-diskon-barang-' +kode+ '" onclick="ubahDiskonBarang(this, &#39;'+kode+'&#39;)">Ubah diskon</a>' +
        '<a href="#" class="simpan-diskon-barang-' +kode+ '" onclick="simpanDiskonBarang(this, &#39;'+kode+'&#39;)" hidden="">Simpan</a>' +
      '</div>' +
    '</td>' +
    '<td>' +
      '<input type="text" id="total-barang-input-'+ kode +'" class="total_barang" name="total_barang[]" hidden="" value="'+ harga +'">' +
      '<span id="total-barang-text-'+ kode +'">Rp. '+ parseInt(harga).toLocaleString() +'</span>' +
    '</td>' +
    '<td>' +
      '<a href="#" onclick="hapusBarang(&#39;'+kode+'&#39;)" class="btn btn-icons btn-rounded btn-secondary ml-1 btn-hapus">' +
        '<i class="mdi mdi-close"></i>' +
      '</a>' +
    '</td>' +
    '<td hidden="">' +
      '<span>'+ stok +'</span>' +
      '<span>'+ status +'</span>' +
    '</td>' +
  '</tr>';
  $('.table-checkout').append(tambah_data);
    diskonPerBarang(kode);
    subtotalBarang();
    diskonBarang();
    jumlahBarang();
  $('.close-btn').click();
}

function btnTambah(kode){
  var index = barang.findIndex(p => {
    return p.kode==kode;
  })
  if(index!=-1){
    var stok = parseInt(barang[index].stok);
    var status = parseInt(barang[index].status);
    var jumlah_barang = parseInt(barang[index].jumlah_barang);
    if((stok > jumlah_barang && status == 1) || status == 0){
      var tambah_barang = jumlah_barang + 1;
      $('#jumlah-barang-input-'+ kode).val(tambah_barang);
      $('#jumlah-barang-text-'+ kode).html(tambah_barang);
      barang[index].jumlah_barang = tambah_barang
      var harga = barang[index].harga;
      var total_barang = harga * tambah_barang;
      $("#total-barang-input-"+ kode).val(total_barang);
      $("#total-barang-text-"+ kode).html('Rp. ' + parseInt(total_barang).toLocaleString());
      diskonPerBarang(kode);
      subtotalBarang();
      diskonBarang();
      // jumlahBarang();
    }
  }
}

function btnKurang(kode){
  var index = barang.findIndex(p => {
    return p.kode==kode;
  })
  if(index!=-1){
    var jumlah_barang = parseInt(barang[index].jumlah_barang);
    if(jumlah_barang > 1){
      var tambah_barang = jumlah_barang - 1;
      $('#jumlah-barang-input-'+ kode).val(tambah_barang);
      $('#jumlah-barang-text-'+ kode).html(tambah_barang);
      barang[index].jumlah_barang = tambah_barang
      var harga = barang[index].harga;
      var total_barang = harga * tambah_barang;
      $("#total-barang-input-"+ kode).val(total_barang);
      $("#total-barang-text-"+ kode).html('Rp. ' + parseInt(total_barang).toLocaleString());
      diskonPerBarang(kode);
      subtotalBarang();
      diskonBarang();
      // jumlahBarang();
    }
  }
}

function hapusBarang(kode){
  var index = barang.findIndex(p => {
    return p.kode == kode
  })
  if(index!=-1){
    barang.splice(index, 1);
    $('#barang-' + kode).remove();
    subtotalBarang();
    diskonBarang();
  }
}


$(document).on('click', '.ubah-diskon-td', function(e){
  e.preventDefault();
  $('.diskon-input').prop('hidden', false);
  $('.nilai-diskon-td').prop('hidden', true);
  $('.simpan-diskon-td').prop('hidden', false);
  $(this).prop('hidden', true);
});

$(document).on('click', '.simpan-diskon-td', function(e){
  e.preventDefault();
  $('.diskon-input').prop('hidden', true);
  $('.nilai-diskon-td').prop('hidden', false);
  $('.ubah-diskon-td').prop('hidden', false);
  $(this).prop('hidden', true);
  diskonBarang();
});

function ubahDiskonBarang(self, kode_barang){
  // e.preventDefault();
  $('.diskon-input-barang-' + kode_barang).prop('hidden', false);
  $('.nilai-diskon-barang-' + kode_barang).prop('hidden', true);
  $('.simpan-diskon-barang-' + kode_barang).prop('hidden', false);
  $(self).prop('hidden', true);
}

function simpanDiskonBarang(self, kode_barang){
  $('.diskon-input-barang-' + kode_barang).prop('hidden', true);
  $('.nilai-diskon-barang-' + kode_barang).prop('hidden', false);
  $('.ubah-diskon-barang-' + kode_barang).prop('hidden', false);
  $(self).prop('hidden', true);
  var index = barang.findIndex(p => {
    return p.kode == kode_barang;
  })
  if(index!=-1){
    barang[index].diskon = $('.diskon-input-barang-' + kode_barang).val().trim() == "" ? 0 : $('.diskon-input-barang-' + kode_barang).val()
  }
  diskonPerBarang(kode_barang);
  subtotalBarang();
  diskonBarang();
}

// $(document).on('click', '.simpan-diskon-barang', function(e){
//   e.preventDefault();
//   $('.diskon-input-barang').prop('hidden', true);
//   $('.nilai-diskon-barang').prop('hidden', false);
//   $('.ubah-diskon-barang').prop('hidden', false);
//   $(this).prop('hidden', true);

//   diskonPerBarang();
// });

$(document).on('input', '.diskon-input', function(){
  $('.nilai-diskon-td').html($(this).val());
  if($(this).val().length > 0){
    $(this).removeClass('is-invalid');
  }else{
    $(this).addClass('is-invalid');
  }
});

function diskonInputBarang(self, kode_barang){
  $('.nilai-diskon-barang-' + kode_barang).html($(self).val());
  if($(self).val().length > 0){
    $(self).removeClass('is-invalid');
  }else{
    $(self).addClass('is-invalid');
  }
}
$(document).on('input', '.diskon-input-barang', function(){
  
});

$(document).on('input', '.bayar-input', function(){
  if($(this).val().length > 0){
    $(this).removeClass('is-invalid');
    $('.nominal-error').prop('hidden', true);
  }else{
    $(this).addClass('is-invalid');
  }
});

function stopScan(){
  Quagga.stop();
}

$('#scanModal').on('hidden.bs.modal', function(e) {
  $('#area-scan').prop('hidden', true);
  $('#btn-scan-action').prop('hidden', true);
  $('.barcode-result').prop('hidden', true);
  $('.barcode-result-text').html('');
  $('.kode_barang_error').prop('hidden', true);
  stopScan();
});

$(document).ready(function(){
  $('input[name=search]').on('keyup', function(){
    var searchTerm = $(this).val().toLowerCase();
    $(".product-list li").each(function(){
      var lineStr = $(this).text().toLowerCase();
      console.log(lineStr);
      if(lineStr.indexOf(searchTerm) == -1){
        $(this).addClass('non-active-list');
        $(this).removeClass('active-list');
      }else{
        $(this).addClass('active-list');
        $(this).removeClass('non-active-list');
      }
    });
  });
});