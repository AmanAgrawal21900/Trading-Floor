// Fetching data from API
async function get_price(sym){
    //  GET request using fetch()
    var data = [];
    var symb = sym.toLowerCase();
    fetch_url = "https://cloud.iexapis.com/stable/stock/"+symb+"/quote?token=pk_3251b0d4b1fc472aaaf9a03643ed5b40";
    //console.log(fetch_url);

    var response = await fetch(fetch_url);
    var response = await response.json();
    
    var sname = response['companyName'];
    var price = response['iexClose'];

    data['sname'] = sname;
    data['price'] = price;
    //console.log(data);
    return data;
}

// ALL Controllers
// app.controller('shareCtrl', function($scope){

//     //console.log(Array.from($scope.share_obj));

//     //console.log($scope.share_obj);

//     $scope.getGrandTotal = function(){
//         var gtotal = 0;
//         for(var i = 0; i < $scope.share_obj.length; i++){
//             var tot = $scope.share_obj[i];
//             gtotal += tot.total;
//         }
//         return gtotal + $scope.getWallet();
//     }

//     $scope.getWallet = function(){
//         var walletAmount = 10000;
//         return walletAmount
//     }
// });
