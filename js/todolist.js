// 定義する定数
work_name_length = 20;
max_description_length = 150;

// 文字制限カウント

function ShowLength1( str ) {
   document.getElementById("inputlength1").innerHTML = str.length + "/" + work_name_length;
   document.getElementById("inputlength1").style.color = '#696969';
  
   if (str.length > work_name_length) {
       document.getElementById("inputlength1").style.color = 'red';
       document.getElementById("inputlength1").innerHTML = '-' + (str.length - work_name_length);
  }
}

function ShowLength2( str ) {
   document.getElementById("inputlength2").innerHTML = str.length + "/" + max_description_length;
   document.getElementById("inputlength2").style.color = '#696969';
  
   if (str.length > max_description_length) {
       document.getElementById("inputlength2").style.color = 'red';
       document.getElementById("inputlength2").innerHTML = '-' + (str.length - max_description_length);
  }
}


// 文字制限カウントここまで

// リアルタイム検索表示

// window.addEventListener('DOMContentLoaded', function () {
//     searchWord = function(){
//         var searchResult,
//         searchText = $(this).val(), // 検索ボックスに入力された値
//         targetText,
//         hitNum;

//         // 検索結果を格納するための配列を用意
//         searchResult = [];
        
//         // 検索結果エリアの表示を空にする
//         $('#search-result__list').empty();
//         $('.search-result__hit-num').empty();
        
//         // 検索ボックスに値が入ってる場合
//         if (searchText != '') {
//             $('.target-area td').each(function() {
//                 targetText = $(this).text();

//                 // 検索対象となるリストに入力された文字列が存在するかどうかを判断
//                 if (targetText.indexOf(searchText) != -1) {
//                 // 存在する場合はそのリストのテキストを用意した配列に格納
//                 searchResult.push(targetText);
//                 }
//             });
            
//             // 検索結果をページに出力
//             for (var i = 0; i < searchResult.length; i ++) {
//             $('<span>').html('<p>' + searchResult[i] + '</p>').appendTo('#search-result__list');
//             }
            
//             // ヒットの件数をページに出力
//             hitNum = '<p>検索結果:' + searchResult.length + '件見つかりました。</p>';
//             $('.search-result__hit-num').append(hitNum);
//         }
//     };
    
//     // searchWordの実行
//     $('#search-text').on('input', searchWord);
// });
// リアルタイム検索表示ここまで

