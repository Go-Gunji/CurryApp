$(function () {
    $.ajax({
        url: '../select.php',
        type: 'POST',
        dataType: 'json'
    })
        // Ajax成功
        .done((data) => {
            // 9つ分のデータは表示
            $.each(data, function(i){
                $('.row').append('<div class="col-6 col-md-4">' + 
                '<div class="card mb-4 box-shadow">' + 
                '<img class="card-img-top" src="img/' + data[i].curry_name + '.jpg"' +'width="300" height="300" alt=' + data[i].curry_name + '>' + 
                '<div class="card-body" style="height: 20rem">' + 
                '<h4 class="card-title">' + data[i].store_name + '</h4>' + 
                '<p class="card-text">' + data[i].impression + '</p>' + 
                '<div class="form-group">' + 
                '<input class="form-control" type="hidden" id="id" value=' + data[i].id + '>' +
                '</div>' +
                '<button type="button" class="btn btn-sm btn-outline-secondary detail" value=' + data[i].id + '>詳しく</button></div></div></div>');
                });
            console.log(data);
        })
        // Ajax失敗
        .fail((data) => {
            $('.result').append('<li>通信に失敗しました。</li>');
            console.log(data);
        })
        // Ajax成功・失敗どちらでも
        .always((data) => {
    });

    $(document).on('click', '.detail', function(){
        console.log($(this).val());
        // 入力値の取得
    var id = $(this).val(); //id
    var mode = 'detail'; //mode
    $.ajax({
        url: '../select.php',
        type: 'POST',
        dataType: 'json',
        data : {id : id, mode : mode}
    })
    // Ajax成功
    .done((data) => {
        if (data === '成功') {
            window.location.href = '../confirm.php';
        }
        console.log(data);
    })
    // Ajax失敗
    .fail((data) => {
        $('.result').append('<li>通信に失敗したぞ。</li>');
        console.log(data);
    })
    // Ajax成功・失敗どちらでも
    .always((data) => {
    });
});
});