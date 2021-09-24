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
    var total_barang;
    if(barang[index].jenis_diskon == 'persen'){
      total_barang = (harga * barang[index].jumlah_barang) - (barang[index].diskon / 100) * harga * barang[index].jumlah_barang;
    }else{
      total_barang = (harga * barang[index].jumlah_barang) - barang[index].diskon;
    }
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

function tambahData(kode, nama, harga, stok, limit, status) {
  barang.push({
    kode: kode,
    nama: nama,
    harga: harga,
    jumlah_barang:1,
    stok: stok,
    limit: limit,
    status: status,
    jenis_diskon: 'persen',
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
    '<td style="width:200px;">' +
      '<div class="d-flex flex-column">' +
        '<div class="mb-1 simpan-diskon-barang-' +kode+ '" hidden="">' +
          '<button type="button" onclick="setPersen(&#39;'+kode+'&#39;)" class="persen-'+ kode +' mr-2 btn btn-primary">%</button>' +
          '<button type="button" onclick="setRp(&#39;'+kode+'&#39;)" class="rp-'+ kode +' btn btn-outline-primary">Rp</button>' +
          '<input type="hidden" value="persen" name="jenis_diskon_per_barang[]" class="jenis-diskon-per-barang-'+ kode +'" />' +
        '</div>' +
        '<input oninput="diskonInputBarang(this, &#39;'+kode+'&#39;)" type="text" class="form-control number-input input-notzero diskon-input-barang-' +kode+ ' mr-2" name="diskon_per_barang[]" value="0" hidden="">' +
        '<span class="nilai-diskon-barang-' +kode+ ' mr-1">0 %</span>' +
        '<div class="mt-1">' +
          '<a href="#" class="ubah-diskon-barang-' +kode+ '" onclick="ubahDiskonBarang(this, &#39;'+kode+'&#39;)">Ubah diskon</a>' +
          '<a href="#" class="simpan-diskon-barang-' +kode+ '" onclick="simpanDiskonBarang(this, &#39;'+kode+'&#39;)" hidden="">Simpan</a>' +
          '<span class="text-danger error-diskon-barang-' +kode+ '" hidden=""></span>' +
        '</div>' +
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
  $(".number-input").inputFilter(function(value) {
    return /^-?\d*$/.test(value); 
  });
  $('.close-btn').click();
}

function btnTambah(kode){
  var index = barang.findIndex(p => {
    return p.kode==kode;
  })
  if(index!=-1){
    var stok = parseInt(barang[index].stok);
    // var status = parseInt(barang[index].status);
    var limit = barang[index].limit===null ? null : parseInt(barang[index].limit);
    var jumlah_barang = parseInt(barang[index].jumlah_barang);
    if((stok > jumlah_barang && limit !== null) || limit === null){
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
  if( !($('.diskon-input-barang-' + kode_barang).hasClass('is-invalid')) ){
    $('.diskon-input-barang-' + kode_barang).prop('hidden', true);
    $('.nilai-diskon-barang-' + kode_barang).prop('hidden', false);
    $('.ubah-diskon-barang-' + kode_barang).prop('hidden', false);
    $('.simpan-diskon-barang-' + kode_barang).prop('hidden', true);
    var index = barang.findIndex(p => {
      return p.kode == kode_barang;
    })
    if(index!=-1){
      $('.jenis-diskon-per-barang-' + kode_barang).val(barang[index].jenis_diskon);
      barang[index].diskon = $('.diskon-input-barang-' + kode_barang).val().trim() == "" ? 0 : $('.diskon-input-barang-' + kode_barang).val()
      if(barang[index].jenis_diskon == 'persen'){
        $('.nilai-diskon-barang-' + kode_barang).html(barang[index].diskon +' %');
      }else{
        $('.nilai-diskon-barang-' + kode_barang).html('Rp. ' + parseInt(barang[index].diskon).toLocaleString());
      }
    }
    diskonPerBarang(kode_barang);
    subtotalBarang();
    diskonBarang();
  }
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

function checkDiskonInputBarang(self, index){
  var self = self
  if(self.val().length > 0 && ((barang[index].jenis_diskon == 'persen' && self.val()<=100) || (barang[index].jenis_diskon == 'rp' && self.val()<=barang[index].jumlah_barang * barang[index].harga))){
    self.removeClass('is-invalid');
  }else{
    self.addClass('is-invalid');
  }
}

function diskonInputBarang(self, kode_barang){
  var index = barang.findIndex(p => {
    return p.kode == kode_barang;
  })
  if(index!=-1){
    $('.nilai-diskon-barang-' + kode_barang).html($(self).val());
    checkDiskonInputBarang($(self), index)
    
  }
}
$(document).on('input', '.diskon-input-barang', function(){
  
});

function setPersen(kode){
  var index = barang.findIndex(p => {
    return p.kode==kode;
  })
  if(index!=-1){
    barang[index].jenis_diskon = 'persen'
    $('.persen-' + kode).removeClass('btn-outline-primary').addClass('btn-primary');
    $('.rp-' + kode).removeClass('btn-primary').addClass('btn-outline-primary');
    checkDiskonInputBarang($('.diskon-input-barang-' + kode), index)
  }
}
function setRp(kode){
  var index = barang.findIndex(p => {
    return p.kode==kode;
  })
  if(index!=-1){
    barang[index].jenis_diskon = 'rp'
    $('.rp-' + kode).removeClass('btn-outline-primary').addClass('btn-primary');
    $('.persen-' + kode).removeClass('btn-primary').addClass('btn-outline-primary');
    checkDiskonInputBarang($('.diskon-input-barang-' + kode), index)
  }
}

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